<?php
session_start();
include_once('../controllers/operacion.php');

if ($_SERVER['REQUEST_METHOD'] == "POST") {
   
$operacion = new Operacion();

$usuario = $_POST['usuario'];
$password = $_POST['password'];

$id = $operacion->aspiranteExiste( $password);

$sql = "SELECT cedula_pasaporte FROM aspirante WHERE id = :id";
$cedula = $operacion->getAllByColumn($sql, [':id' => $id])[0]['cedula_pasaporte'];

$sqlRole = "SELECT role FROM cuenta WHERE id = :id";
$role = $operacion->getAllByColumn($sqlRole, [':id' => $id])[0]['role'];

$token = bin2hex(random_bytes(16));

$_SESSION['cedula'] = $cedula;
$_SESSION['usuario'] = $usuario;
$_SESSION['contrasena'] = $password;
$_SESSION['auth_token'] = $token;
setcookie('auth_token', $token, time() + 3600, '/', '', false, true); 
$operacion->updateToken([
    'token' => $token,
    'activo' => true,
    'password' => $password
]);

if($role == 'aspirante'){    
    header('Location: ./panel_aspirante.php');
}else{
     header('Location: ./panel_rh.php');
}
exit;
}else{
     header("Location: ../../index.php");
    exit;
}
?>