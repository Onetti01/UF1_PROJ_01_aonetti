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

<body>
    <?php

        $conn = mysqli_connect('localhost', 'root', '', 'info_bdn');
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }
        

        if ( isset($_GET['busqueda']) && $_GET['busqueda'] != '' ) {
            $query = "SELECT * FROM cursos WHERE nombre LIKE '%"  . $_GET['busqueda'] ."%'";
        } else {
            $query = "SELECT * FROM cursos";
        }
    
        echo '<nav class="navbar">
        <b> <center>Gestión de curso </b></center> "
        </nav>';
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
        </thead>
        <a class="boton-personalizado" href="añadir_curso.php">Añadir Curso</a>';
        echo '<div class="footer"><a class="boton-personalizado" href="administrador.php">Retroceder</a></div>';
        echo '<div class="container-fluid">
        
        <form class="d-flex">
                  <form action="gestion_curso.php" method="GET">
                  <input class="buscar-form" type="search" placeholder="Busca el nombre" 
                  name="busqueda"> <br>
                  <input class="btn btn-outline-info" type="submit" value="Buscar"></input> 
                  </form>
        </div>';
        
        if ($result = mysqli_query($conn, $query)) {
            while ($row = $result->fetch_assoc()) {
                $codigo = $row["codigo"];
                $nombre = $row["nombre"];
                $descripcion = $row["descripcion"];
                $hora_total = $row["hora_total"];
                $fecha_inicio = $row["fecha_inicio"];
                $fecha_final = $row["fecha_final"]; 
                $DNI_profesor = $row["DNI_profesor"]; 

                echo '<tbody> 
                <tr>
                            <td>'.$codigo.'</td>
                            <td>'.$nombre.'</td> 
                            <td>'.$descripcion.'</td> 
                            <td>'.$hora_total.'</td>    
                            <td>'.$fecha_inicio.'</td> 
                            <td>'.$fecha_final.'</td> 
                            <td>'.$DNI_profesor .'</td>
                            <td><a href="editar_curso.php?codigo='.$codigo.'"><img src="libreta_icono.svg" alt="editar"></a></td>
                            <td><a href="eliminar_profesor.php?codigo='.$codigo.'"><img src="tick.svg" alt="actividad"></a></td>  
                            

                        </tbody>
                </tr>
                ';
                
                
            }
            $result->free();
        } 

    ?>

</body>

</html>