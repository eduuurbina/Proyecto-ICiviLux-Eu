<?php
$server = "localhost";
$user   = "root";
$pass   = "";
$db     = "icivilux_db";

try {
    $conexion = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>