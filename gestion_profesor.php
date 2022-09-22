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

<body>
    <?php
        $conn = mysqli_connect('localhost', 'root', '', 'info_bdn');
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if ( isset($_GET['busqueda']) && $_GET['busqueda'] != '' ) {
            $query = "SELECT * FROM profesores WHERE nombre LIKE '%"  . $_GET['busqueda'] ."%'";
        } else {
            $query = "SELECT * FROM profesores";
        }

        echo '  <nav class="navbar">
        <b> <center>Gestión de profesor </b></center> "
        </nav>';
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
            </thead>
            <a class="boton-personalizado" href="añadir_profesor.php">Añadir profesor</a>';   
            echo '<div class="footer"><a class="boton-personalizado" href="administrador.php">Retroceder</a></div>
            <form class="d-flex">
                  <form action="gestion_profesor.php" method="GET">
                  <input class="buscar-form" type="search" placeholder="Busca el nombre" 
                  name="busqueda"> <br>
                  <input class="btn btn-outline-info" type="submit" value="Buscar"></input> 
                  </form>';
         
        
        if ($result = mysqli_query($conn, $query)) {
            while ($row = $result->fetch_assoc()) {
                $DNI = $row["DNI"];
                $nombre = $row["nombre"];
                $apellidos = $row["apellidos"];
                $titulo = $row["titulo"];
                $foto = $row["foto"]; 
                
                echo '<tbody> 
                <tr> 
                            <td>'.$DNI.'</td> 
                            <td>'.$nombre.'</td> 
                            <td>'.$apellidos.'</td> 
                            <td>'.$titulo.'</td> 
                            <td><img class="imagen_tabla" src="'.$foto.'"></img></td> 
                            <td><a href="editar_profesor.php?dni='.$DNI.'"><img src="libreta_icono.svg" alt="editar"></a></td>
                            <td><a href="eliminar_profesor.php?dni='.$DNI.'"><img src="tick.svg" alt="actividad"></a></td>  
                    </tbody> 
                </tr>';
            }
            $result->free();
        } 
    ?>

</body>
</html>