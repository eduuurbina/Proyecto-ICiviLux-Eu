<?php
session_start();

$servicios = [
    1 => 'Remodelaciones y acabados',
    2 => 'Carpintería y ebanistería',
    3 => 'Servicios de electricidad',
    4 => 'Plomería hidrosanitaria',
    5 => 'Mantenimientos locativos'
];

$servicioSeleccionado = isset($_GET['servicio']) ? (int)$_GET['servicio'] : 0;
$success = false;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim((string)($_POST['nombre'] ?? ''));
    $correo = trim((string)($_POST['correo'] ?? ''));
    $celular = trim((string)($_POST['celular'] ?? ''));
    $servicioId = (int)($_POST['servicio'] ?? 0);

    if ($nombre === '' || $correo === '' || $celular === '' || !isset($servicios[$servicioId])) {
        $error = 'Por favor complete todos los campos correctamente.';
    } else {
        $servicioNombre = $servicios[$servicioId];
        require_once 'conexion.php';

        try {
            $sql = 'INSERT INTO contactos (nombre_cliente, correo, celular, servicio_interes)
                    VALUES (:nom, :cor, :cel, :ser)';
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':nom', $nombre);
            $stmt->bindParam(':cor', $correo);
            $stmt->bindParam(':cel', $celular);
            $stmt->bindParam(':ser', $servicioNombre);

            $success = $stmt->execute();
            if ($success) {
                $servicioSeleccionado = $servicioId;
            } else {
                $error = 'No se pudo guardar la solicitud. Intente nuevamente.';
            }
        } catch (PDOException $e) {
            $error = 'Error en el sistema: ' . $e->getMessage();
        }
    }
}
?>
