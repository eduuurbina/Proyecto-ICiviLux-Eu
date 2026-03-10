<?php
session_start();
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

</style>
</head>

<body>

<div class="login-card">

<div class="header">
<img src="logoICiviLux.jpeg" class="logo">
<h2>ICiviLux Eu</h2>
<p class="tagline">Panel de Administración</p>
</div>

<form action="validar.php" method="POST">

<label>Usuario</label>
<input type="text" name="usuario" placeholder="Ingrese su usuario" required>

<label>Contraseña</label>
<input type="password" name="clave" placeholder="Ingrese su contraseña" required>

<button type="submit">Ingresar</button>

</form>

<div class="footer">
© 2026 ICiviLux Eu
</div>

</div>

</body>
</html>