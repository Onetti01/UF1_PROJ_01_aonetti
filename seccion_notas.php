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
    <title>sección_notas</title>
</head>
<nav class="navbar">
    <a>Sección Notas</a>
    <a class="b_menu" href="die.php">Cerrar session</a>
</nav>
<div class="footer"><a class="boton-personalizado" href="seccion_cursos.php">Mis cursos</a></div>

<body>
    <?php
    //Conectamos con la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'info_bdn');
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    //Insertamos en la tabla de cursos que tenemos añadidos a nuestra academia
    if (isset($_SESSION['profesores'])) {

        //Añadimos/editamos nota (nos aseguramos que estan declaradas)
        if (isset($_POST['nota']) && isset($_POST['codigo-aux']) && isset($_POST['email-aux'])) {
            $tmpNota = $_POST['nota'];
            $tmpCodigo = $_POST['codigo-aux'];
            $tmpEmail = $_POST['email-aux'];
            $sql = "UPDATE matricula SET nota=$tmpNota WHERE email_alumno = '$tmpEmail' and codigo_curso = $tmpCodigo";
            $result = mysqli_query($conn, $sql);
        }


        $auxalumnos = intval($_GET['codigo']);
        $query = "SELECT a.email, a.nombre, a.apellidos, a.fotografia, m.nota 
                  FROM alumnos as a INNER JOIN matricula as m ON a.email = m.email_alumno
                  WHERE m.codigo_curso = $auxalumnos";

        //Busqueda de cursos por su nombre
        if (isset($_GET['busqueda']) && $_GET['busqueda'] != '') {
            $query = "SELECT * FROM alumnos WHERE nombre LIKE '%"  . $_GET['busqueda'] . "%'";
        }

        //Imprimimos la tabla
        echo '<div class="centrar-tabla" ><table class = "content-table"> 
         <thead>
                 <tr> 
                     <td>Nombre</td> 
                     <td>Apellidos</td>
                     <td>Nota</td> 

                 </tr>
         </thead>';
        echo '<div class="container-fluid">
                   <form class="d-flex">
                   <form action="gestion_curso.php" method="GET">
                   <input class="buscar-form" type="search" placeholder="Busca el nombre" 
                   name="busqueda"> <br>
                   </form>
         </form>';



        if ($result = mysqli_query($conn, $query)) {
            while ($row = $result->fetch_assoc()) {

                //Declaramos las variables
                $nombre = $row["nombre"];
                $apellidos = $row["apellidos"];
                $nota = $row["nota"];
                $email_alumno = $row["email"];

                echo '<tbody> 
        <tr>
                    <td>' . $nombre . '</td> 
                    <td>' . $apellidos . '</td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="email-aux" value="' . $email_alumno . '"/>
                            <input type="hidden" name="codigo-aux" value="' . $auxalumnos . '"/>
                            <input type="text" required="required" name="nota" value="' . $nota . '"/>
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

</html>