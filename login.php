
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
    <?php

        if($_POST){
            //Variable con los datos de conexión
           
            $conn = new mysqli('localhost', 'root','', 'info_bdn');
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Recogida de los datos 
            $email =  $_POST['email'];
            $password =  $_POST['password'];
            $sql = "SELECT * FROM alumnos WHERE email = '$email' AND password = '$password'";
            $result = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($result);

            if($count == 1) { 
                //Variable de sessión
                
                $_SESSION['email'] = $_POST['email'];

                echo "hola";
            }

            //Control del login
            else{
                echo "El correo electrónico o la password no se han introducido correctamente";
               
            }
            
            //Recogida de los datos introducidos en el formulario
            $email =  $_POST['email'];
            $password =  $_POST['password'];
            $sql = "SELECT nombre FROM alumnos WHERE email = '$email' AND password = '$password'";

            $sql2 = "SELECT apellidos,nom FROM alumnos WHERE email = '$email' AND password = '$password'";      
            $result2 = mysqli_query($conn,$sql2);
            
        }
        else{ 

        ?>
           <nav class="navbar">
     <div class="logo"><a>Info BDN</a></div>
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
            <div class="contenedor-login">
                <h2 class="login-header">INFO BDN</h2>
                <form class="login" action="registrar.php">
                Cuenta de mail: <input type="mail" required="required" name="email"/><br></br>
                Password: <input type="password" required="required" name="password"><br></br>
                    <p><input type="submit" value="Log in"></p>
                    <button onclick="window.location.href='registrar.php'">Registrarse</button>
                </form> 
                <div class="footer">
                <p><a href="login_administrador.php">administrador</a></p>
                </div>
                </div>
            </div>
        </div>
        <?php } ?>
</body>
</html>