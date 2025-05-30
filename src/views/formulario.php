<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Aspirante</title>
  <link rel="stylesheet" href="../../styles/views/formulario.css">
</head>
<body>
<header class="main-header">
  <div class="header-left">
    <strong>Recursos Humanos</strong>
    <nav class="header-nav">
        <a href="panel_aspirante.php">Panel Aspirante</a>
    </nav>
  </div>
  <div class="header-right">
    <a href="login.php" class="logout-btn">Cerrar sesión</a>
  </div>
</header>
  <div class="container">
    <h1>Registro de Información del Aspirante</h1>
    <form id="formDatos" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
      <div class="form-group">
        <label for="cedula">Cédula o Pasaporte *</label>
        <input title="cedula" pattern="^[0-9-]{4,20}$" type="text" id="cedula" name="cedula" required>
      </div>

      <div class="form-group">
        <label for="nombre">Nombre *</label>
        <input  min="2" max="30" title="nombre" pattern="^[a-zA-Z]{2,30}$" type="text" id="nombre" name="nombre" required>
      </div>

      <div class="form-group">
        <label for="apellido">Apellido *</label>
        <input min="2" max="30" pattern="^[a-zA-Z]{2,30}$" type="text" id="apellido" name="apellido" required>
      </div>

      <div class="form-group">
        <label for="estado_civil">Estado Civil</label>
        <select id="estado_civil" name="estado_civil" required>
          <option value="">Seleccione</option>
          <option value="soltero">Soltero(a)</option>
          <option value="casado">Casado(a)</option>
          <option value="divorciado">Divorciado(a)</option>
          <option value="viudo">Viudo(a)</option>
        </select>
      </div>

      <div class="form-group">
        <label for="genero">Género *</label>
        <select id="genero" name="genero" required>
          <option value="">Seleccione</option>
          <option value="M">Masculino</option>
          <option value="F">Femenino</option>
        </select>
      </div>

      <div class="form-group">
        <label for="tipo_sangre">Tipo de Sangre</label>
        <input title="tipo de sangre" min="1" max="5" pattern="^[a-zA-Z+-]{1,5}$" type="text" id="tipo_sangre" name="tipo_sangre" placeholder="Ej. O+, A-, AB+">
      </div>

      <div class="form-group">
        <label for="fecha_nacimiento">Fecha de Nacimiento *</label>
        <input type="date" max="2007-12-31" id="fecha_nacimiento" name="fecha_nacimiento" required>
      </div>

      <div class="form-group">
        <label for="nacionalidad">Nacionalidad *</label>
        <input min="2" max="30" pattern="^[a-zA-Z ]{2,30}$" type="text" id="nacionalidad" name="nacionalidad" required>
      </div>

      <div class="form-group">
        <label for="telefono">Teléfono *</label>
        <input min="8" max="10" title="telefono" pattern="^(?=[^-]*-?[^-]*$)[0-9-]{9}$" type="tel" id="telefono" name="telefono" required>
      </div>

      <div class="form-group">
        <label for="residencia">Dirección de Residencia *</label>
        <input  min="5" max="30" title="residencia"  pattern="^[a-zA-Z0-9]{5,30}$" type="text" id="residencia" name="residencia" required>
      </div>


      <div class="form-group">
        <button type="submit">Guardar Información</button>
      </div>
    </form>
  </div>
<?php
session_start();
include_once('../auth/middleware.php');
include_once(__DIR__.'/../controllers/operacion.php');
$operacion = new Operacion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cedula        = $_POST['cedula'] ?? '';
            $nombre        = $_POST['nombre'] ?? '';
            $apellido      = $_POST['apellido'] ?? '';
            $estado_civil  = $_POST['estado_civil'] ?? '';
            $genero        = $_POST['genero'] ?? '';
            $tipo_sangre   = $_POST['tipo_sangre'] ?? '';
            $fecha_nacimiento   = $_POST['fecha_nacimiento'] ?? '';
            $nacionalidad  = $_POST['nacionalidad'] ?? '';
            $telefono      = $_POST['telefono'] ?? '';
            $residencia    = $_POST['residencia'] ?? '';
            $usuario = $_SESSION['username']??'';
            $contrasena = $_SESSION['password']??'';
            $email = $_SESSION['email']??'';

  $fecha = (new DateTime())->format('Y-m-d H:i:s');          
  $id_cuenta = $operacion->saveCuenta(['usuario'=>$usuario,'contrasena'=> $contrasena,'creadoEn'=> $fecha]);
  $id_datos = $operacion->saveDatosPersonal([
    'residencia'=> $residencia, 'nacionalidad'=> $nacionalidad, 'estado_civil'=>$estado_civil,
    'genero'=> $genero, 'tipo_sangre'=> $tipo_sangre
  ]);

  $id_aspirante = $operacion->saveAspirante([
                'cuenta_id'      => $id_cuenta, 
                'datos_id'       => $id_datos,
                'cedula'         => $cedula,
                'nombre'         => $nombre,
                'apellido'       => $apellido,
                'fecha_nacimiento' => $fecha_nacimiento,
                'telefono'       =>  $telefono,
                'email'         =>  $email
  ]);

$operacion->saveSolicitud([
    'aspirante_id' => $id_cuenta,
    'estado'       => "no revisado",
    'fecha'        => $fecha
]);


  $_SESSION['usuario'] = $usuario;
  $_SESSION['contrasena'] = $contrasena;
  $_SESSION['cedula'] = $cedula;
    setcookie('auth_token', '', time() + 3600, '/', '', false, true); 

  $token = bin2hex(random_bytes(16));
  setcookie('auth_token', $token, time() + 3600, '/', '', false, true); 

  $operacion->updateToken([':token'=>$token,':activo'=>true, ':password' => $contrasena]);

  header('Location: ./panel_aspirante.php');
  session_unset(); 
}

?>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
 const form = document.querySelector('#formDatos')

  const input = document.querySelector('input[name="fecha_nacimiento"]');
  input.addEventListener('change', () => {
    const fecha = new Date(input.value);
    const limite = new Date('2008-01-01');
  if (fecha >= limite) {
    alert('La fecha debe ser anterior a 2008');
    input.value = '';
  }
});

 form.addEventListener('submit',e=>{

    const nombre = "<?php echo $nombre; ?>";
    const cedula = <?php echo $cedula; ?>;

  e.preventDefault();
  
   Swal.fire({
     title: `Hola,${nombre}\nse guardo tus datos con exito`,
     text: "Tocar boton para ir a la siguiente pagina",
     icon: "success"
    });
  })
</script>
</body>
</html>