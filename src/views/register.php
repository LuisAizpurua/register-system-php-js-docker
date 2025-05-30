<?php
session_start();

include_once('../controllers/operacion.php');
$operacion = new Operacion();

$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$repeatPassword = $_POST['repeatPassword'];

$id = $operacion->aspiranteExiste($password);
$id_email = $operacion->getAllByColumn('SELECT id FROM aspirante WHERE email = :email',[':email'=>$email])[0];
if(isset($id_email)){
    header('Location: ../../index.php');
     exit;
}

if(isset($id)){
        $_SESSION['message'] = 'ya existe';
        header('Location: ../../index.php');
        session_destroy();
        exit;
}else{

    $token = bin2hex(random_bytes(16));
    setcookie('auth_token', $token, time() + 3600, '/', '', false, true); 
    
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['email'] = $email;
    
    header('Location: ./formulario.php');
    exit;
}
?>