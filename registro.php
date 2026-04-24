<?php
session_start();
require_once "conexion.php";

$error = null;
$success = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim((string)($_POST["usuario"] ?? ""));
    $clave = (string)($_POST["clave"] ?? "");
    $confirmar = (string)($_POST["confirmar_clave"] ?? "");

    if ($usuario === "" || $clave === "" || $confirmar === "") {
        $error = "Debe completar todos los campos.";
    } elseif (strlen($usuario) < 4) {
        $error = "El usuario debe tener al menos 4 caracteres.";
    } elseif (strlen($clave) < 6) {
        $error = "La contrasena debe tener al menos 6 caracteres.";
    } elseif ($clave !== $confirmar) {
        $error = "Las contrasenas no coinciden.";
    } else {
        $sqlExiste = "SELECT id FROM usuarios WHERE usuario = :usuario LIMIT 1";
        $stmtExiste = $conexion->prepare($sqlExiste);
        $stmtExiste->bindParam(":usuario", $usuario);
        $stmtExiste->execute();

        if ($stmtExiste->fetch(PDO::FETCH_ASSOC)) {
            $error = "El usuario ya existe. Usa otro nombre de usuario.";
        } else {
            $claveHash = password_hash($clave, PASSWORD_DEFAULT);

            $sqlInsert = "INSERT INTO usuarios (usuario, clave) VALUES (:usuario, :clave)";
            $stmtInsert = $conexion->prepare($sqlInsert);
            $stmtInsert->bindParam(":usuario", $usuario);
            $stmtInsert->bindParam(":clave", $claveHash);

            if ($stmtInsert->execute()) {
                header("Location: login.php?registro=ok");
                exit();
            }

            $error = "No fue posible registrar el usuario.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro | ICiviLux Eu</title>
    <style>
        body{
            font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif;
            background:linear-gradient(135deg,#0056b3,#003366);
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
            margin:0;
        }

        .card{
            background:#fff;
            padding:36px;
            border-radius:12px;
            box-shadow:0 10px 40px rgba(0,0,0,0.2);
            width:100%;
            max-width:420px;
        }

        h2{
            color:#0056b3;
            margin:0 0 8px 0;
            text-align:center;
        }

        .subtitle{
            margin:0 0 18px 0;
            color:#6c757d;
            text-align:center;
            font-size:14px;
        }

        label{
            font-weight:600;
            color:#495057;
            margin-top:12px;
            display:block;
        }

        input{
            width:100%;
            padding:12px;
            margin-top:6px;
            border:1px solid #ced4da;
            border-radius:6px;
            font-size:14px;
            box-sizing:border-box;
        }

        input:focus{
            border-color:#0056b3;
            outline:none;
        }

        .btn{
            width:100%;
            background:#0056b3;
            color:#fff;
            padding:14px;
            border:none;
            border-radius:6px;
            margin-top:20px;
            font-size:15px;
            font-weight:bold;
            cursor:pointer;
        }

        .btn:hover{
            background:#003f82;
        }

        .link{
            display:block;
            text-align:center;
            margin-top:12px;
            color:#0056b3;
            text-decoration:none;
            font-weight:600;
        }

        .link:hover{
            text-decoration:underline;
        }

        .alert{
            margin-bottom:14px;
            padding:10px 12px;
            border-radius:6px;
            font-size:14px;
            background:#ffe3e3;
            border:1px solid #e28787;
            color:#8c2424;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>Crear usuario</h2>
        <p class="subtitle">Registra tu acceso en la tabla usuarios</p>

        <?php if ($error): ?>
            <div class="alert"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST" action="registro.php">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="usuario" required value="<?= htmlspecialchars((string)($_POST["usuario"] ?? "")) ?>">

            <label for="clave">Contrasena</label>
            <input type="password" id="clave" name="clave" required>

            <label for="confirmar_clave">Confirmar contrasena</label>
            <input type="password" id="confirmar_clave" name="confirmar_clave" required>

            <button class="btn" type="submit">Registrar</button>
        </form>

        <a class="link" href="login.php">Volver a iniciar sesion</a>
    </div>
</body>
</html>
