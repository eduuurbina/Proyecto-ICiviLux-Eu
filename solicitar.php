<?php
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

    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $db = 'icivilux_db';

    try {
      $conexion = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
      $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Solicitar servicio | ICiviLux Eu</title>
  <link rel="stylesheet" href="index-style.css">
</head>

<body>
  <div class="header">
    <a href="login.php" class="login-btn">Iniciar sesión</a>
    <a href="index.php"><img src="img/logoICiviLux.jpeg" class="logo"></a>
  </div>

  <div class="container form-container">
    <h1 class="form-title">Solicitar servicio</h1>
    <p class="form-desc">Complete el formulario y nos pondremos en contacto con usted.</p>

    <?php if ($success): ?>
      <div class="alert-success">
        ¡Solicitud enviada con éxito! Pronto nos pondremos en contacto contigo.
      </div>
    <?php elseif ($error): ?>
      <div class="alert-error">
        <?= htmlspecialchars($error) ?>
      </div>
    <?php endif; ?>

    <form class="form-solicitud" action="solicitar.php" method="post">
      <div class="form-group">
        <label for="servicio">Servicio</label>
        <select id="servicio" name="servicio" required>
          <option value="">Seleccione un servicio</option>
          <?php foreach ($servicios as $id => $nombre): ?>
            <option value="<?= $id ?>" <?= $servicioSeleccionado === $id ? 'selected' : '' ?>>
              <?= htmlspecialchars($nombre) ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>

      <div class="form-group">
        <label for="nombre">Nombre completo</label>
        <input type="text" id="nombre" name="nombre" placeholder="Ingrese su nombre" value="<?= htmlspecialchars((string)($_POST['nombre'] ?? '')) ?>" required>
      </div>

      <div class="form-group">
        <label for="correo">Correo electrónico</label>
        <input type="email" id="correo" name="correo" placeholder="ejemplo@correo.com" value="<?= htmlspecialchars((string)($_POST['correo'] ?? '')) ?>" required>
      </div>

      <div class="form-group">
        <label for="celular">Celular</label>
        <input type="tel" id="celular" name="celular" placeholder="300 123 4567" value="<?= htmlspecialchars((string)($_POST['celular'] ?? '')) ?>" required>
      </div>

      <button type="submit" class="btn-enviar">Enviar solicitud</button>
      <a href="index.php" class="btn-volver">Volver al inicio</a>
    </form>
  </div>

  <div class="footer">
    ING. EDUARDO URBINA<br>
    313-447-9112 | 301-661-7244<br>
    © 2026 ICiviLux Eu
  </div>
</body>
</html>
