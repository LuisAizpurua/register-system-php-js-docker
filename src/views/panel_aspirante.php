<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panel Aspirante</title>
  <link rel="stylesheet" href="../../styles/views/panel_aspirante.css" />
</head>
<body>
<header class="main-header">
  <div class="header-left">
    <strong>Recursos Humanos</strong>
    <nav class="header-nav">
        <a href="formulario.php">Formulario</a>
    </nav>
  </div>
  <div class="header-right">
    <a href="login.php" class="logout-btn">Cerrar sesión</a>
  </div>
</header>
  <div class="container">

  <?php

    session_start();
    include_once('../auth/middleware.php');  
  
    include_once(__DIR__.'/../controllers/operacion.php');
    $operacion = new Operacion();
    
    $usuario = $_SESSION['usuario']??'';
    $contrasena = $_SESSION['contrasena']??'';
    $cedula = $_SESSION['cedula'];

    $sql = 'SELECT * FROM aspirante a INNER JOIN solicitudes s ON s.aspirante_id = a.id where a.cedula_pasaporte = :cedula';
    $data = $operacion->getAllByColumn($sql,[':cedula'=> $cedula])[0];

    if(empty($data)){ header('Location: ./formulario.php');}
    
    $nombre = $data['nombre'];
    $apellido = $data['apellido'];
    $estado= $data['estado'];

    $iconPorEstado = ['no revisado'=>'⏳', 'considerado'=>'✅','no considerado'=>'❌'];
    $icon =  $iconPorEstado[$estado];
   
   echo <<<HTML
    <h1>Bienvenido, $nombre $apellido</h1>
    
    <div class="status-card">
      <h2>Estado de tu solicitud</h2>
      <p class="estado $estado">$icon $estado</p>
    </div>
    HTML;
    ?>
    <div class="actions">
      <a href="formulario.php" class="btn">Actualizar Información</a>
      <a href="login.php" class="logout">Cerrar sesión</a>
    </div>
  </div>
  <script>

  </script>
</body>
</html>