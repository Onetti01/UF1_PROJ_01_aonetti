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
    <title>gestion_curso</title>
</head>
<aside>
    <h3>Gestión cursos</h3>
    <ul type="lista">
        <li><a class="boton-admin" href="gestion_profesor.php">Gestión Professor</a></li>
        <li><a class="boton-admin" href="gestion_curso.php">Gestión Cursos</a></li>
        <li><a class="boton-admin" href="login.php">Volver al login</a></li>
    </ul>
</aside>

<body class="container-gestion">
    <?php
    //Nos conectamos
    $conn = mysqli_connect('localhost', 'root', '', 'info_bdn');
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_GET['codigo']) && isset($_GET['actiu'])) {
        $codigo = $_GET['codigo'];
        $ACTIU = $_GET['actiu'];
        $query = "UPDATE cursos SET actiu = $ACTIU WHERE codigo = '$codigo'";
        $result = mysqli_query($conn, $query);
    }

    //Busqueda 
    if (isset($_GET['busqueda']) && $_GET['busqueda'] != '') {
        $query = "SELECT * FROM cursos WHERE nombre LIKE '%"  . $_GET['busqueda'] . "%'";
    } else {
        $query = "SELECT * FROM cursos";
    }
    //Cargamos form
    echo '<section class="tabla"><form class="d-flex" action="gestion_curso.php" method="GET">
                <input class="buscar-form" type="search" placeholder="Busca el nombre" name="busqueda">
            </form>';
    echo '<table class = "content-table"> 
        <thead>
                <tr> 
                    <td>Codigo</td> 
                    <td>Nombre</td> 
                    <td>Descripcion</td> 
                    <td>Hora Total</td> 
                    <td>Fecha Inicio</td> 
                    <td>Fecha Final</td> 
                    <td>DNI profesor</td>
                    <td>Editar</td> 
                    <td>Actividad</td> 
                </tr>
        </thead>';

    if ($result = mysqli_query($conn, $query)) {
        while ($row = $result->fetch_assoc()) {
            $codigo = $row["codigo"];
            $nombre = $row["nombre"];
            $descripcion = $row["descripcion"];
            $hora_total = $row["hora_total"];
            $fecha_inicio = $row["fecha_inicio"];
            $fecha_final = $row["fecha_final"];
            $DNI_profesor = $row["DNI_profesor"];
            $modo = $row['actiu'];

            echo '
                <tr>
                            <td>' . $codigo . '</td>
                            <td>' . $nombre . '</td> 
                            <td>' . $descripcion . '</td> 
                            <td>' . $hora_total . '</td>    
                            <td>' . $fecha_inicio . '</td> 
                            <td>' . $fecha_final . '</td> 
                            <td>' . $DNI_profesor . '</td>
                            <td><a href="editar_curso.php?codigo=' . $codigo . '"><img src="libreta_icono.svg" alt="editar"></a></td>';
            if ($modo == 1) {
                echo '<td><a href="gestion_curso.php?codigo=' . $codigo . '&actiu=0"><img src="img_iconos/tick.svg" alt="habilitar"></a></td></tr>';
            } else {
                echo '<td><a href="gestion_curso.php?codigo=' . $codigo . '&actiu=1"><img src="img_iconos/x.svg" alt="deshabilitar"></a></td></tr>';
            }
        }
        $result->free();
        echo '</tbody></table></section>';

        echo '<div class="menu-gestion">
                <a class="b_menu" href="añadir_curso.php">Añadir curso</a>
              <a class="b_menu" href="die.php">Cerrar session</a>;
            </div>';
    }

    ?>

</body>

</html>