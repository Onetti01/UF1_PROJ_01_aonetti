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
    <title>añadir_curso</title>
</head>

<body>
    <?php

    if ($_POST) {
        $conn = mysqli_connect('localhost', 'root', '', 'info_bdn');
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
        //Declaramos las variables
        $codigo =  intval($_POST['codigo']);
        $nombre =  $_POST['nombre'];
        $descripcion =  $_POST['descripcion'];
        $hora_total =  intval($_POST['hora_total']);
        $fecha_inicio =  $_POST['fecha_inicio'];
        $fecha_final =  $_POST['fecha_final'];
        $DNI_profesor =  $_POST['DNI_profesor'];

        //Insertamos los datos en la bbdd
        $sql = "INSERT INTO cursos VALUES ($codigo, '$nombre', '$descripcion', $hora_total, '$fecha_inicio', '$fecha_final', '$DNI_profesor', 1)";
        $result = mysqli_query($conn, $sql);
        var_dump($sql);
    } else {
    ?>
        <div class="center-contenedor-login">
            <div class="contenedor-login">
                <h2 class="login-header">Añadir cursos</h2>
                <form action="añadir_curso.php" class="login" method="POST">
                    Codigo: <input type="text" required="required" name="codigo" />
                    Nombre: <input type="text" required="required" name="nombre" />
                    Descripción: <input type="name" required="required" name="descripcion" />
                    Horas Totales: <input type="name" required="required" name="hora_total" />
                    Fecha inicio:<input type="date" name="fecha_inicio" id="fecha" required min=<?php $hoy = date("Y-m-d");
                                                                                                echo $hoy; ?> />
                    Fecha final:<input type="date" name="fecha_final" id="fecha" required min=<?php $hoy = date("Y-m-d");
                                                                                                echo $hoy; ?> />
                    DNI Profesor: <input type="text" required="required" name="DNI_profesor" />
                    <p><input type="submit" name="enviar" value="Aceptar" /></p>
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