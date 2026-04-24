<?php require_once 'solicitar_logica.php'; ?>
<?php
$usuarioSesion = trim((string)($_SESSION['usuario'] ?? ''));
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Solicitar servicio | ICiviLux Eu</title>
  <link rel="stylesheet" href="solicitar.css">
</head>

<body>
  <div class="header">
    <?php if ($usuarioSesion !== ''): ?>
      <div class="session-box">
        <span class="user-badge">Hola, <?= htmlspecialchars($usuarioSesion) ?></span>
        <a href="logout.php" class="logout-btn">Salir</a>
      </div>
    <?php else: ?>
      <a href="login.php" class="login-btn">Iniciar sesión</a>
    <?php endif; ?>
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
        <input type="number" id="celular" name="celular" placeholder="300 123 4567" value="<?= htmlspecialchars((string)($_POST['celular'] ?? '')) ?>" required>
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
