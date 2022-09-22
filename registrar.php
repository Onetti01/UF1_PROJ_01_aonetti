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
    <title>INFO BDN</title>
</head>
<body>
    <?php

        if($_POST){
            
            $conn = new mysqli('localhost', 'root','', 'info_bdn');
            if ($conn->connect_error) {
                die("Connection failed: " 
                    . $conn->connect_error);
            }

            $email =  $_REQUEST['email'];
            $password =  $_REQUEST['password'];
            $nom =  $_REQUEST['nom'];
            $sql = "INSERT INTO usuarios VALUES ('$email','$password','$nom')";

            $result = mysqli_query($conn, $sql);

            //Comprobación si los cursos coinciden
            if($curso == $practicar){
                echo "<h3>Ya no estan disponibles estos cursos. ";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=registrar.php'>";  
    
            }else if($result){
                echo "<h3>Se ha registrado correctamente.";
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='1.5;URL=login.php'>";  
            }
            else{
                echo "Error. $sql. " . mysqli_error($conn);
                echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=registrar.php'>";  
            }
        }
        else{ 
            //Se carga el  formulario
        ?>

        <div class="center-contenedor-login">
            <div class="contenedor-login">
            <h2 class="login-header">Registrate en nuestra academia INFO BDN</h2>
                <form action="administrador.php" class="login" method="POST">
                Cuenta de mail: <input type="mail" required="required" name="email"/><br></br>
                Password: <input type="password" required="required" name="password"><br></br>
                Nombre: <input type="text" required="required" name="nom"/><br></br>
                <p><input type="submit" name="enviar" value="Aceptar"/></p>
            <a href="login.php">volver al login</a>
            </a>
                </form> 
                </div>
            </div>
        </div>
        <?php 
         } 
         ?>
</body>
</html>