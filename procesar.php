<?php
// 1. Configuración de conexión
$host = "localhost";
$user = "root";
$pass = "";
$db   = "icivilux_db";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // 2. Recibir datos del formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre   = $_POST['nombre'];
        $correo   = $_POST['correo'];
        $servicio = $_POST['servicio'];
        $mensaje  = $_POST['mensaje'];

        // 3. Preparar la orden para insertar en la tabla 'contactos'
        $sql = "INSERT INTO contactos (nombre_cliente, correo, servicio_interes, mensaje) 
                VALUES (:nom, :cor, :ser, :msj)";
        
        $stmt = $conexion->prepare($sql);
        
        // 4. Ejecutar el guardado
        $stmt->bindParam(':nom', $nombre);
        $stmt->bindParam(':cor', $correo);
        $stmt->bindParam(':ser', $servicio);
        $stmt->bindParam(':msj', $mensaje);

        if ($stmt->execute()) {
            echo "<div style='font-family:sans-serif; text-align:center; margin-top:50px;'>";
            echo "<h2>¡Solicitud Enviada con Éxito!</h2>";
            echo "<p>Gracias $nombre, en ICiviLux Eu procesaremos tu pedido de $servicio.</p>";
            echo "<a href='index.php'>Volver al inicio</a>";
            echo "</div>";
        }
    }
} catch (PDOException $e) {
    echo "Error en el sistema: " . $e->getMessage();
}
?>