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
    <title>añadir_profesor</title>
</head>

<body>
    <?php

    if ($_POST) {
        $conn = mysqli_connect('localhost', 'root', '', 'info_bdn');
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
        //Declaramos las variables
        $DNI =  $_POST['DNI'];
        $password = md5($_POST['password']);
        $nombre =  $_POST['nombre'];
        $apellidos =  $_POST['apellidos'];
        $titulo =  $_POST['titulo'];
        $ruta_imagen = "";

        //Cargamos la foto
        if (($_FILES['foto']['name'] != "")) {
            $target_dir = "img/";
            $file = $_FILES['foto']['name'];
            $path = pathinfo($file);
            $filename = $DNI; # Esta linia pone el nombre final al archivo
            $ext = $path['extension'];
            $temp_name = $_FILES['foto']['tmp_name'];
            $ruta_imagen = $target_dir . $filename . "." . $ext;
            var_dump($ruta_imagen);

            if (file_exists($ruta_imagen)) {
                echo "Lo siento, esta foto ya existe.";
            } else {
                move_uploaded_file($temp_name, $ruta_imagen);
                echo "Has subido la foto correctamente.";
            }
        }
        //Insertamos los datos en la bbdd
        $sql = "INSERT INTO profesores VALUES ('$DNI','$password','$nombre','$apellidos','$titulo','$ruta_imagen', 1)";
        $result = mysqli_query($conn, $sql);
        var_dump($sql);
    } else {
    ?>
        <div class="center-contenedor-login">
            <div class="contenedor-login">
                <h2 class="login-header">Añadir profesor</h2>
                <form action="añadir_profesor.php" class="login" method="POST" action="upload.php" enctype="multipart/form-data">
                    DNI: <input type="mail" required="required" name="DNI" /><br></br>
                    Password: <input type="password" required="required" name="password" /><br></br>
                    Nombre: <input type="name" required="required" name="nombre" /><br></br>
                    Apellidos <input type="name" required="required" name="apellidos" /><br></br>
                    Titulo Academico: <input type="text" required="required" name="titulo"><br></br>
                    Añade una foto:<input type="file" name="foto" />
                    <p><input type="submit" name="enviar" href="añadir_profesor.php" value="Aceptar" /></p>
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