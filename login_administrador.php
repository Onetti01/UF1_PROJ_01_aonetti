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
    <title>Login administrador</title>
</head>

<body>
    <nav class="navbar">
        <b>Login Administrador</b>
    </nav>
    <div class="center-contenedor-login">
        <div class="contenedor-login">
            <img class="login_logo" src="img_iconos/usuario_logo.svg" />
            <form action="administrador.php" class="login" method="POST">
                <input type="text" title="text" required="required" name="usuario" placeholder="usuario" />
                <input type="password" title="password" required="required" name="password" placeholder="password" />
                <button type="submit" class="btn">Login</button>

                </a>
            </form>
        </div>
    </div>
    </div>


</body>

</html>