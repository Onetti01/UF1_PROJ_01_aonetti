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
    <title>editar_curso</title>
</head>

<body>
    <?php
    if (isset($_SESSION["administrador"])) {
        if ($_POST) {
            $bddcon = mysqli_connect("localhost", "root", "", "info_bdn");
            if ($bddcon == false) {
                mysqli_connect_error();
            } else {
                //Declaramos las variables
                $codigo = $_POST['codigo'];
                $nombre = $_POST['nombre'];
                $descripcion = $_POST['descripcion'];
                $hora_total = $_POST['hora_total'];
                $fecha_inicio = $_POST['fecha_inicio'];
                $fecha_final = $_POST['fecha_final'];
                $dni_profesor = $_POST['DNI_profesor'];

                //Actualizamos los datos en la bbdd
                $sql = "UPDATE cursos SET nombre='$nombre', descripcion='$descripcion', hora_total='$hora_total', fecha_inicio='$fecha_inicio', fecha_final='$fecha_final', dni_profesor='$dni_profesor' WHERE codigo LIKE '$codigo'";
                $consulta = mysqli_query($bddcon, $sql);

                if (!$consulta) {
                    echo mysqli_error($bddcon) . "<br>";
                    echo "Error querry no valida " . $sql;
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='333333333;URL=gestion_curso.php'>";
                } else {
                    echo "Curso editado correctamente";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3333333333333;URL=gestion_curso.php'>";
                }
            }
        } else {
            if ($_REQUEST['codigo']) {
                $bddcon = mysqli_connect("localhost", "root", "", "info_bdn");
                if ($bddcon == false) {
                    mysqli_connect_error();
                } else {
                    $codigo = $_REQUEST['codigo'];
                    $sql = "SELECT * FROM cursos WHERE codigo LIKE '$codigo'";
                    $consulta = mysqli_query($bddcon, $sql);
                    if (!$consulta) {
                        echo mysqli_error($bddcon) . "<br>";
                        echo "Error querry no valida " . $sql;
                        echo "Redirigint..";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=gestion_curso.php'>";
                    } else {
                        $curso = mysqli_fetch_assoc($consulta); ?>
                        <div class="center-contenedor-login">
                            <div class="contenedor-login">
                                <h2 class="login-header">Editar cursos</h2>
                                <form action="editar_curso.php" class="login" method="POST">
                                    Codigo: <input readonly type="text" name="codigo" value="<?php echo $curso['codigo'] ?>" /><br></br>
                                    Nombre: <input type="text" required="required" name="nombre" name="codigo" value="<?php echo $curso['nombre'] ?>" /><br></br>
                                    Descripción: <input type="name" required="required" name="descripcion" name="codigo" value="<?php echo $curso['descripcion'] ?>" /><br></br>
                                    Horas Totales: <input type="name" required="required" name="hora_total" name="codigo" value="<?php echo $curso['hora_total'] ?>" /><br></br>
                                    Fecha Inicio: <input type="date" required="required" name="fecha_inicio" name="codigo" value="<?php echo $curso['fecha_inicio'] ?>" /><br></br>
                                    Fecha Fin: <input type="date" required="required" name="fecha_final" name="codigo" value="<?php echo $curso['fecha_final'] ?>" /><br></br>
                                    DNI Profesor: <input type="text" required="required" name="DNI_profesor" name="codigo" value="<?php echo $curso['DNI_profesor'] ?>" /><br></br>
                                    <p><button type='submit'>Modificar</button></p>

                                    </a>
                                </form>
                            </div>
                        </div>
                        </div>
    <?php
                    }
                }
            } else {
                echo "No hemos podido tener el codigo de cursos";
            }
        }
    } else {
        echo "<p>Has d'estar valiat per veure aquesta pÃ gina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=login_admin.php'>";
    }

    ?>




</body>

</html>