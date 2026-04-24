<?php
session_start();

$error = isset($_GET['error']);
$registroOk = isset($_GET['registro']) && $_GET['registro'] === 'ok';
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login | ICiviLux Eu</title>

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

.login-card{
    background:white;
    padding:40px;
    border-radius:12px;
    box-shadow:0 10px 40px rgba(0,0,0,0.2);
    width:100%;
    max-width:380px;
}

.header{
    text-align:center;
    margin-bottom:25px;
}

.logo{
    width:180px;
    margin-bottom:10px;
}

h2{
    color:#0056b3;
    margin:0;
}

.tagline{
    font-size:13px;
    color:#6c757d;
}

label{
    font-weight:600;
    color:#495057;
    margin-top:15px;
    display:block;
}

input{
    width:100%;
    padding:12px;
    margin-top:5px;
    border:1px solid #ced4da;
    border-radius:6px;
    font-size:14px;
    box-sizing:border-box;
}

input:focus{
    border-color:#0056b3;
    outline:none;
}

button{
    width:100%;
    background:#0056b3;
    color:white;
    padding:14px;
    border:none;
    border-radius:6px;
    margin-top:25px;
    font-size:15px;
    font-weight:bold;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#003f82;
}

.footer{
    text-align:center;
    margin-top:20px;
    font-size:12px;
    color:#adb5bd;
}

.alert{
    margin-top:12px;
    padding:10px 12px;
    border-radius:6px;
    font-size:14px;
}

.alert-error{
    background:#ffe3e3;
    border:1px solid #e28787;
    color:#8c2424;
}

.alert-success{
    background:#dff5e6;
    border:1px solid #74bf8b;
    color:#1f6a36;
}

.register-link{
    display:block;
    margin-top:14px;
    text-align:center;
    color:#0056b3;
    text-decoration:none;
    font-weight:600;
}

.register-link:hover{
    text-decoration:underline;
}

</style>
</head>

<body>

<div class="login-card">

<div class="header">
<img src="logoICiviLux.jpeg" class="logo">
<h2>ICiviLux Eu</h2>
<p class="tagline">Panel de Administración</p>
</div>

<?php if ($error): ?>
<div class="alert alert-error">Usuario o contraseña incorrectos.</div>
<?php endif; ?>

<?php if ($registroOk): ?>
<div class="alert alert-success">Usuario registrado correctamente. Ya puedes iniciar sesión.</div>
<?php endif; ?>

<form action="validar.php" method="POST">

<label>Usuario</label>
<input type="text" name="usuario" placeholder="Ingrese su usuario" required>

<label>Contraseña</label>
<input type="password" name="clave" placeholder="Ingrese su contraseña" required>

<button type="submit">Ingresar</button>

</form>

<a class="register-link" href="registro.php">Crear una cuenta</a>

<div class="footer">
© 2026 ICiviLux Eu
</div>

</div>

</body>
</html>