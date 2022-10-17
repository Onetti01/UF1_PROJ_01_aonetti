<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login INFO BDN</title>
</head>

<body>
    <nav class="navbar">
        <img class="logo" src="img_iconos/logo1.svg" />
        <ul class="nav-links">
            <div class="menu">
                <li><a href="/">Home</a></li>
                <li><a href="/">Sobre nosotros</a></li>
                <li class="services">
                    <a href="/">Servicios</a>
            </div>
        </ul>
    </nav>
    <div class="center-contenedor-login">
        <div class="contenedor-login-img">
        </div>
        <div class="contenedor-login">
            <img class="login_logo" src="img_iconos/usuario_logo.svg" />
            <form class="login" action="academia.php" method="POST">
                <input type="text" title="mail" required="required" name="email" placeholder="email" />
                <input type="password" title="username" required="required" name="password" placeholder="password" />
                <button onclick="window.location.href='login_profesor.php'" class="btn">Profesor</button>
                <button type="submit" class="btn">Login</button>
                <button onclick="window.location.href='registrar.php'" class="btn">Registrarse</button>


            </form>
        </div>

    </div>
    </div>
</body>
<footer>
    <p><a href="login_administrador.php">administrador</a></p>

</footer>

</html>