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

    if ($_POST) {

        $conn = new mysqli('localhost', 'root', '', 'info_bdn');
        if ($conn->connect_error) {
            die("Connection failed: "
                . $conn->connect_error);
        }
        //Declaramos las variables
        $email =  $_REQUEST['email'];
        $password = md5($_REQUEST['password']);
        $nombre =  $_REQUEST['nombre'];
        $apellidos =  $_REQUEST['apellidos'];
        $edad =  intval($_REQUEST['edad']);
        $dni =  $_REQUEST['dni'];
        $ruta_imagen = "";

        if (($_FILES['foto']['name'] != "")) {
            $target_dir = "img_alumnos/";
            $file = $_FILES['foto']['name'];
            $path = pathinfo($file);
            $filename = $email; # Esta linia pone el nombre final al archivo
            $ext = $path['extension'];
            $temp_name = $_FILES['foto']['tmp_name'];
            $ruta_imagen = $target_dir . $filename . "." . $ext;


            if (file_exists($ruta_imagen)) {
                echo "Añadido correctamente.";
            } else {
                move_uploaded_file($temp_name, $ruta_imagen);
                echo "Has subido la foto correctamente.";
            }
        }

        //Insertamos los datos
        $sql = "INSERT INTO alumnos (email, password, nombre, apellidos, edad, dni,fotografia)
                VALUES ('$email','$password','$nombre','$apellidos', $edad,'$dni','$ruta_imagen')";
        $result = mysqli_query($conn, $sql);
    } else {
        //Se carga el  formulario
    ?>
        <div class="center-contenedor-login">
            <div class="contenedor-login">
                <h2 class="login-header">Registrate en nuestra academia INFO BDN</h2>
                <form action="registrar.php" class="login" method="POST" enctype="multipart/form-data">
                    <input type="text" required="required" name="email" placeholder="Cuenta Mail" />
                    <input type="password" required="required" name="password" placeholder="Password" />
                    <input type="text" required="required" name="nombre" placeholder="Nombre" />
                    <input type="text" required="required" name="apellidos" placeholder="Apellidos" />
                    <input type="text" required="required" name="dni" placeholder="DNI" />
                    <input type="text" required="required" name="edad" placeholder="Edad" />
                    Añade una foto:<input type="file" name="foto" />
                    <button type="submit" class="btn">Aceptar</button>
                    <a href="login.php" class="btn">volver al login</a>
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