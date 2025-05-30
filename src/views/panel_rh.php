<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panel de RH</title>
  <link rel="stylesheet" href="../../styles/views/panel_rh.css" />
</head>

<body>
  <header class="main-header">
    <div class="header-left">
      <strong>Recursos Humanos</strong>
      <nav class="header-nav">
        <a href="formulario.php">Formulario</a>
        <a href="panel_aspirante.php">Panel Aspirante</a>
      </nav>
    </div>
    <div class="header-right">
      <a href="../../index.php" class="logout-btn">Cerrar sesión</a>
    </div>
  </header>
  <div class="container">
    <h2>Panel Recursos Humanos</h2>

    <table class="tabla-solicitudes">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Cédula</th>
          <th>Correo</th>
          <th>Estado</th>
          <th>Cambiar Estado</th>
        </tr>
      </thead>
      <tbody>
        <?php
        session_start();
        include_once(__DIR__ . '/../controllers/operacion.php');
        include_once('../auth/middleware.php');
        
        $operacion = new Operacion();
        $sql = 'SELECT * FROM aspirante a INNER JOIN solicitudes s ON s.aspirante_id = a.id';
        $data = $operacion->getAllByColumn($sql, []);

        foreach ($data as $item) {
          $nombre = $item['nombre'];
          $cedula = $item['cedula_pasaporte'];
          $email = $item['email'];
          $estado = $item['estado'];
          $id= $item['id'];
          echo <<<HTML
        <tr>
          <td>$nombre</td>
          <td>$cedula</td>
          <td>$email</td>
          <td>$estado</td>
          <td class="tdSelects">
            <form action="./guardar.php" method="post">
            <input type="hidden" name="id" value="$id">

              <select name="estado" class="select-estado">
                <option value="considerado">Considerado</option>
                <option value="no revisado">No revisado</option>
                <option value="no considerado">No considerado</option>
              </select>
              <button type='submit' class="buttonsCambiar">Cambiar</button>
            </form>
          </td>
        </tr>
        HTML;
        }
        ?>
      </tbody>
    </table>
  </div>
  <script>
    // const tbody = document.querySelector('tbody')
    

    // const estado = "<?php echo $estado; ?>";
    // childrens.forEach(el => {
    //   const selectOptions = el.querySelector('.select-estado')

    //   const estado = el.closest('tr');
    //   console.log(estado)
    //   Array.from(selectOptions.options).forEach(option => option.selected = true)

    //   const optionToSelect = Array.from(selectOptions.options).find(({
    //     value
    //   }) => value === estado.toLowerCase());
    //   if (optionToSelect) {
    //     optionToSelect.selected = true;
    //     optionToSelect.disabled = true
    //   }
    // })
  </script>
</body>
</html>