<?php

$auth_token = $_COOKIE['auth_token']??'';

if (empty($auth_token)) {  
    header('Location: ../../index.php');
    session_destroy();
    exit;
}

// if(!empty($auth_token)){
//     include_once(__DIR__ . '/../controllers/operacion.php');
    
//     $operacion = new Operacion();
//     $role =$operacion->getAllByColumn("SELECT role FROM `cuenta` WHERE token = :token",[":token",$auth_token])[0]['role'];
//     if($role=='aspirante'){
//         header('Location: ../../index.php');
//         exit;
//     }
// }

?>