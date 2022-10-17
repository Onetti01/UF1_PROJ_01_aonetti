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
    <title>gestion_profesor</title>
</head>
<aside>
    <h3>Gestión profesores</h3>
    <ul type="lista">
        <li><a class="boton-admin" href="gestion_profesor.php">Gestión Professor</a></li>
        <li><a class="boton-admin" href="gestion_curso.php">Gestión Cursos</a></li>
        <li><a class="boton-admin" href="login.php">Volver al login</a></li>
    </ul>

</aside>

<body class="container-gestion">
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'info_bdn');
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_GET['dni']) && isset($_GET['actiu'])) {
        $DNI = $_GET['dni'];
        $ACTIU = $_GET['actiu'];
        $query = "UPDATE profesores SET actiu = $ACTIU WHERE DNI = '$DNI'";
        $result = mysqli_query($conn, $query);
    }
    //Busqueda
    if (isset($_GET['busqueda']) && $_GET['busqueda'] != '') {
        $query = "SELECT * FROM profesores WHERE nombre LIKE '%"  . $_GET['busqueda'] . "%'";
    } else {
        $query = "SELECT * FROM profesores";
    }
    echo '<section class="tabla"><form class="d-flex" action="gestion_profesor.php" method="GET">
                <input class="buscar-form" type="search" placeholder="Busca el nombre" name="busqueda">
            </form>';
    echo '<table class = "content-table"> 
        <thead>
                <tr> 
                    <td>DNI</td> 
                    <td>Nombre</td> 
                    <td>Apellidos</td> 
                    <td>Titulo</td> 
                    <td>Foto</td> 
                    <td>Editar</td> 
                    <td>Actividad</td> 
                </tr>
            </thead><tbody>';


    if ($result = mysqli_query($conn, $query)) {
        while ($row = $result->fetch_assoc()) {
            $DNI = $row["DNI"];
            $nombre = $row["nombre"];
            $apellidos = $row["apellidos"];
            $titulo = $row["titulo"];
            $foto = $row["foto"];
            $modo = $row['actiu'];

            echo ' 
                    <tr> 
                        <td>' . $DNI . '</td> 
                        <td>' . $nombre . '</td> 
                        <td>' . $apellidos . '</td> 
                        <td>' . $titulo . '</td> 
                        <td><img class="imagen_tabla" src="' . $foto . '"></img></td> 
                        <td><a href="editar_profesor.php?dni=' . $DNI . '"><img src="libreta_icono.svg" alt="editar"></a></td>';
            if ($modo == 1) {
                echo '<td><a href="gestion_profesor.php?dni=' . $DNI . '&actiu=0"><img src="img_iconos/tick.svg" alt="habilitar"></a></td></tr>';
            } else {
                echo '<td><a href="gestion_profesor.php?dni=' . $DNI . '&actiu=1"><img src="img_iconos/x.svg" alt="deshabilitar"></a></td></tr>';
            }
        }
        $result->free();
        echo '</tbody></table></section>';

        echo '<div class="menu-gestion">
                <a class="b_menu" href="añadir_profesor.php">Añadir profesor</a>
              <a class="b_menu" href="die.php">Cerrar session</a>;
            </div>';
    }
    ?>

</body>

</html>