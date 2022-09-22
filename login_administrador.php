
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
<div class="center-contenedor-login">
            <div class="contenedor-login">
            <h2 class="login-header">Login Administrador</h2>
                <form action="administrador.php" class="login" method="POST">
                Usuario: <input type="text" required="required" name="usuario"/><br><br>
                Password: <input type="password" required="required" name="password"><br><br>
                <p><input type="submit" name="enviar" value="Aceptar"/></p>
            <a href="login.php">volver al login</a>
            </a>
                </form> 
                </div>
            </div>
        </div>
    
       
</body>
</html>

