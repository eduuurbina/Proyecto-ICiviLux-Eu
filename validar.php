<?php
session_start();

$usuario = trim((string)($_POST['usuario'] ?? ''));
$clave = (string)($_POST['clave'] ?? '');

if ($usuario === '' || $clave === '') {
    header("Location: login.php?error=1");
    exit();
}

require_once "conexion.php";

$sql = "SELECT id, usuario, clave FROM usuarios WHERE usuario = :usuario LIMIT 1";
$stmt = $conexion->prepare($sql);
$stmt->bindParam(":usuario", $usuario);
$stmt->execute();
$usuarioBD = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuarioBD) {
    header("Location: login.php?error=1");
    exit();
}

$claveValida = password_verify($clave, $usuarioBD['clave']) || $clave === $usuarioBD['clave'];

if ($claveValida) {
    $_SESSION['usuario'] = $usuarioBD['usuario'];
    $_SESSION['usuario_id'] = $usuarioBD['id'];
    header("Location: index.php");
    exit();
}

header("Location: login.php?error=1");
exit();
?>