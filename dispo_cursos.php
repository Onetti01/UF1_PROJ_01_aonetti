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
    $password =  $_POST['password'];
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
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Dispo Cursos</title>
</head>
<nav class="navbar">
    <?php
    if (isset($_SESSION["nombre"])) {
        echo "Benvenido/da: " . $_SESSION["nombre"] . " " . $_SESSION["apellidos"] . ".";
    }
    echo '<a class="b_menu" href="die.php">Cerrar session</a>';
    ?>
</nav>

<body>
    <?php
    //Conectamos con la base de datos
    $conn = mysqli_connect('localhost', 'root', '', 'info_bdn');
    if (mysqli_connect_errno()) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $auxAlumno = $_SESSION['alumnos'];
    $query = "SELECT *
              FROM cursos
              WHERE codigo NOT IN (
                  SELECT codigo_curso
                  FROM matricula
                  WHERE email_alumno = '$auxAlumno')";
    //Busqueda de cursos por su nombre
    if (isset($_GET['busqueda']) && $_GET['busqueda'] != '') {
        $query .= " and nombre LIKE '%"  . $_GET['busqueda'] . "%'";
    }
    //Añade el curso al usuario
    if (isset($_SESSION['alumnos'])) {
        if (isset($_GET['codigo'])) {
            print("Añadido el curso correctamente");
            header('Refresh: 3; URL=dispo_cursos.php');
            $tempEmail = $_SESSION['alumnos'];
            $codigo_curso = intval($_GET['codigo']);
            $sql = "INSERT INTO matricula VALUES ('$tempEmail', $codigo_curso,'/')";
            if ($result = mysqli_query($conn, $sql)) {
            }
        } else {
            echo '<div class="footer"><a class="boton-personalizado" href="academia.php">Mis cursos</a></div>';
            echo '<div class="container-fluid">
                    <form class="d-flex" action="dispo_cursos.php" method="GET">
                    <input class="buscar-form" type="search" placeholder="Busca el nombre" 
                    name="busqueda"> <br>
                    </form>
                  </div>';
            //Imprimimos la tabla
            echo '<div class="centrar-tabla"><table class = "content-table"> 
                <thead>
                        <tr> 
                            <td>Codigo</td> 
                            <td>Nombre</td> 
                            <td>Descripcion</td> 
                            <td>Hora Total</td> 
                            <td>Fecha Inicio</td> 
                            <td>Fecha Final</td> 
                            <td>Añadir curso</td>
                        </tr>
                </thead>';

            echo "<tbody>";

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
                                    <input type="hidden" value="' . $codigo . '" name="codigo">
                                    <input class="añadir_curso" type="submit" value="Añadir">
                                </form>
                                
                            </td> 
                        
                </tr>
                ';
                }
                $result->free();
                echo '</tbody></table></div>';
            }




    ?>


</body>

</html>
<?php
        }
    }
