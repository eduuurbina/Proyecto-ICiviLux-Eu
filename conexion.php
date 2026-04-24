<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "icivilux_db";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexion a la base de datos.");
}
?>
