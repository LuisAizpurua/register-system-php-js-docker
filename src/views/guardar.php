<?php
include_once(__DIR__.'/../controllers/operacion.php');
$operacion = new Operacion();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $estado = $_POST['estado'] ?? null;

    if ($id && $estado) {
        $resultado = $operacion->ejecutarSinRetorno(
            "UPDATE solicitudes SET estado = :estado WHERE id = :id",
            [":estado" => $estado, ":id" => $id]
        );

        if ($resultado) {
            header("Location: ./panel_rh.php");
            exit;
        } else {
            echo "Error al actualizar.";
        }
    } else {
        echo "Faltan datos.";
    }
}

?>