<?php
session_start();
$usuarioSesion = trim((string)($_SESSION['usuario'] ?? ''));
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ICiviLux Eu | Ingeniería y Remodelación</title>
  <link rel="stylesheet" href="index-style.css">
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
    <img src="img/logoICiviLux.jpeg" class="logo">
  </div>

  <div class="container">
    <div class="service">
      <img src="img/remodelaciones.jpeg">
      <div class="service-content">
        <h2>REMODELACIONES Y ACABADOS</h2>
        <p>
          Ampliaciones y reformas bajo diseño personalizado,
          enchapes, pañete, pasta y pintura, instalaciones
          de cielo raso en PVC, drywall, divisiones de vidrio,
          persianas y cubiertas.
        </p>
        <a href="solicitar.php?servicio=1" class="btn-solicitar">Solicitar este servicio</a>
      </div>
    </div>

    <div class="service reverse">
    <img src="img/carpinteria.jpg">
      <div class="service-content">
        <h2>CARPINTERÍA Y EBANISTERÍA</h2>
        <p>
          Cocinas integrales, puertas en madera,
          closets empotrados, mobiliarios de sala,
          camas y tapicería, restauración de muebles
          y superficies de madera.
        </p>
        <a href="solicitar.php?servicio=2" class="btn-solicitar">Solicitar este servicio</a>
      </div>
    </div>

    <div class="service">
      <img src="img/electricidad.jpg">
      <div class="service-content">
        <h2>SERVICIOS DE ELECTRICIDAD</h2>
        <p>
          Adecuación de tableros eléctricos,
          tomacorrientes, interruptores inteligentes,
          instalación de lámparas, reflectores,
          cintas LED, cámaras de seguridad
          y aires acondicionados.
        </p>
        <a href="solicitar.php?servicio=3" class="btn-solicitar">Solicitar este servicio</a>
      </div>
    </div>

    <div class="service reverse">
      <img src="img/sanitaria.jpg">
      <div class="service-content">
        <h2>PLOMERÍA HIDROSANITARIA</h2>
        <p>
          Destape de tuberías y desagües,
          instalación de grifería y tanques,
          reposición de tuberías, reparación
          de fugas y mantenimiento de sistemas
          hidrosanitarios.
        </p>
        <a href="solicitar.php?servicio=4" class="btn-solicitar">Solicitar este servicio</a>
      </div>
    </div>

    <div class="service">
      <img src="img/locativo.jpg">
      <div class="service-content">
        <h2>MANTENIMIENTOS LOCATIVOS</h2>
        <p>
          Mantenimiento de cubiertas,
          aires acondicionados, electricidad,
          reparación de humedades,
          grietas, impermeabilizaciones
          y mantenimiento preventivo.
        </p>
        <a href="solicitar.php?servicio=5" class="btn-solicitar">Solicitar este servicio</a>
      </div>
    </div>
  </div>

  <div class="footer">
    ING. EDUARDO URBINA<br>
    313-447-9112 | 301-661-7244<br>
    © 2026 ICiviLux Eu
  </div>
</body>
</html>
