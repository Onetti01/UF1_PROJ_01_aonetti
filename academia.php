<?php
session_start();

if ($_POST) {

    //Variable con los datos de conexión

    $conn = new mysqli('localhost', 'root', '', 'info_bdn');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // Recogida de los datos 
    $email =  $_POST['email'];
    $password =  md5($_POST['password']);
    $sql = "SELECT * FROM alumnos WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        //Variable de sessión
        $_SESSION['alumnos'] = $_POST['email'];
        $rowResult = mysqli_fetch_row($result);
        $_SESSION['nombre'] = $rowResult[2];
        $_SESSION['apellidos'] = $rowResult[3];
    } else {
        //Control del login
        echo "El email o la password no se han introducido correctamente";
        header("Refresh:2; url=login.php");
    }
}

if (isset($_SESSION['alumnos'])) {
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
        <?php
        if (isset($_SESSION["nombre"])) {
            //Mostramos el nombre de usuario que ha iniciado sesión
            echo "Benvenido/da: " . $_SESSION["nombre"] . " " . $_SESSION["apellidos"] . ".";
            echo '<a class="b_menu" href="die.php">Cerrar session</a>';
        }
        ?>
    </nav>

    <body>
        <h3>Academia virtual, aquí podras encontrar tus cursos disponible</h3>
        <a class="boton-personalizado" href="dispo_cursos.php">Ver cursos disponibles</a>
        <a class="boton-personalizado" href="editar_alumno.php">Editar mis datos</a>

        <?php
        //Conectamos con la base de datos
        $conn = mysqli_connect('localhost', 'root', '', 'info_bdn');
        if (mysqli_connect_errno()) {
            die("Connection failed: " . mysqli_connect_error());
        }

        //Insertamos en la tabla de cursos que tenemos añadidos a nuestra academia
        if (isset($_SESSION['alumnos'])) {
            $auxAlumno = $_SESSION['alumnos'];
            $query = "SELECT c.*, m.nota
            FROM cursos as c INNER JOIN matricula as m ON c.codigo = m.codigo_curso
            WHERE m.email_alumno = '$auxAlumno'";

            //Busqueda de cursos por su nombre
            if (isset($_GET['busqueda']) && $_GET['busqueda'] != '') {
                $query .= " and c.nombre LIKE '%"  . $_GET['busqueda'] . "%'";
            }
            //Añade el curso al usuario
            if (isset($_SESSION['alumnos'])) {
                if (isset($_GET['codigo'])) {
                    print("Has eliminado el curso correctamente");
                    header('Refresh: 3; URL=academia.php');
                    $codigo_curso = intval($_GET['codigo']);
                    $sql = "DELETE FROM matricula WHERE email_alumno = '$auxAlumno' AND codigo_curso = $codigo_curso";
                    $result = mysqli_query($conn, $sql);
                } else {
                    echo '<tbody>
                   <form class="d-flex" action="academia.php" method="GET">
                   <input  type="search" placeholder="Busca el nombre" 
                   name="busqueda"> <br>
                   </form>';

                    //Imprimimos la tabla
                    echo '<div class="centrar-tabla" ><table class = "content-table"> 
         <thead>
                 <tr> 
                     <td>Codigo</td> 
                     <td>Nombre</td> 
                     <td>Descripcion</td> 
                     <td>Nota</td> 
                     <td>Hora Total</td> 
                     <td>Fecha Inicio</td> 
                     <td>Fecha Final</td> 
                     <td>Darse de baja</td>
                 </tr>
         </thead>';


                    if ($result = mysqli_query($conn, $query)) {
                        while ($row = $result->fetch_assoc()) {
                            $codigo = $row["codigo"];
                            $nombre = $row["nombre"];
                            $descripcion = $row["descripcion"];
                            $nota = $row["nota"];
                            $hora_total = $row["hora_total"];
                            $fecha_inicio = $row["fecha_inicio"];
                            $fecha_final = $row["fecha_final"];


                            echo '<tr>
                    <td>' . $codigo . '</td>
                    <td>' . $nombre . '</td> 
                    <td>' . $descripcion . '</td> 
                    <td>' . $nota . '</td>  
                    <td>' . $hora_total . '</td>    
                    <td>' . $fecha_inicio . '</td> 
                    <td>' . $fecha_final . '</td> 
                    <td>
                        <form methpd="get">
                            <input type="hidden" value="' . $codigo . '" name="codigo">
                            <input class="añadir_curso" type="submit" value="Eliminar">
                        </form> 
                    </td></tr>
        ';
                        }
                        $result->free();
                        echo '</tbody></table></div>';
                    }
                }

        ?>

    </body>

    </html>
<?php
            }
        }
    }
