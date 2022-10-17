<?php
session_start();
if ($_POST) {

    //Variable con los datos de conexión

    $conn = new mysqli('localhost', 'root', '', 'info_bdn');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Recogida de los datos 
    $dni =  $_POST['dni'];
    $password =  md5($_POST['password']);
    $sql = "SELECT * FROM profesores WHERE dni = '$dni' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        //Variable de sessión
        $_SESSION['profesores'] = $_POST['dni'];
    } else {
        //Control del login
        echo "El usuario o la password no se han introducido correctamente";
        header("Refresh:2; url=login.php");
    }
}

if (isset($_SESSION['profesores'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>Academia</title>
    </head>
    <nav class="navbar">
        <a>Sección cursos</a>
        <a class="b_menu" href="die.php">Cerrar session</a>


    </nav>

    <body>

        <?php
        //Conectamos con la base de datos
        $conn = mysqli_connect('localhost', 'root', '', 'info_bdn');
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        //Insertamos en la tabla de cursos que tenemos añadidos a nuestra academia
        if (isset($_SESSION['profesores'])) {
            $auxprofesor = $_SESSION['profesores'];
            $query = "SELECT * FROM cursos WHERE DNI_profesor = '$auxprofesor'";

            //Busqueda de cursos por su nombre
            if (isset($_GET['busqueda']) && $_GET['busqueda'] != '') {
                $query .= " and nombre LIKE '%"  . $_GET['busqueda'] . "%'";
            }

            //Imprimimos la tabla
            echo '<div class="centrar-tabla" ><table class = "content-table"> 
         <thead>
                 <tr> 
                     <td>Codigo</td> 
                     <td>Nombre</td> 
                     <td>Descripcion</td> 
                     <td>Hora Total</td> 
                     <td>Fecha Inicio</td> 
                     <td>Fecha Final</td> 
                     <td>Alumnos</td> 
                 </tr>
         </thead>';
            echo '<div class="container-fluid">
         
         <form class="d-flex">
                   <form action="gestion_curso.php" method="GET">
                   <input class="buscar-form" type="search" placeholder="Busca el nombre" 
                   name="busqueda"> <br>
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

                    echo '<tbody> 
        <tr>
                    <td>' . $codigo . '</td>
                    <td>' . $nombre . '</td> 
                    <td>' . $descripcion . '</td> 
                    <td>' . $hora_total . '</td>    
                    <td>' . $fecha_inicio . '</td> 
                    <td>' . $fecha_final . '</td>  
                    <td>
                        <form methpd="get">
                           <a href="seccion_notas.php?codigo=' .  $codigo . '"><img src="libreta_icono.svg" alt="editar"></a>
                        </form>
                        
                    </td> 
                </tbody>
        </tr>
        ';
                }
                $result->free();
                echo '</tbody></table></div>';
            }
        }

        ?>

    </body>
    <footer> </footer>

    </html>
<?php
}
