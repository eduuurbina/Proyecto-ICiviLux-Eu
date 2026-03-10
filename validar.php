<?php
session_start();

$usuario = $_POST['usuario'];
$clave = $_POST['clave'];

if($usuario == "admin" && $clave == "1234"){
    
    $_SESSION['usuario'] = $usuario;
    
    header("Location: index.php");
    exit();

}else{

    echo "Usuario o contraseña incorrectos";
}
?>