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
    <title>editar_profesor</title>
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
                $dni = $_POST['DNI'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $titulo = $_POST['titulo'];

                //Actualizamos los datos en la bbdd
                $sql = "UPDATE profesores SET nombre='$nombre', apellidos='$apellidos', titulo='$titulo' WHERE DNI LIKE '$dni'";
                $consulta = mysqli_query($bddcon, $sql);

                if (!$consulta) {
                    echo mysqli_error($bddcon) . "<br>";
                    echo "Error querry no valida " . $sql;
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='333333333;URL=gestion_profesor.php'>";
                } else {
                    echo "Profesor editado correctamente";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3333333333333;URL=gestion_profesor.php'>";
                }
            }
        } else {
            if ($_REQUEST['dni']) {
                $bddcon = mysqli_connect("localhost", "root", "", "info_bdn");
                if ($bddcon == false) {
                    mysqli_connect_error();
                } else {
                    $dni = $_REQUEST['dni'];
                    $sql = "SELECT * FROM profesores WHERE DNI LIKE '$dni'";
                    $consulta = mysqli_query($bddcon, $sql);
                    if (!$consulta) {
                        echo mysqli_error($bddcon) . "<br>";
                        echo "Error querry no valida " . $sql;
                        echo "Redirigint..";
                        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=gestion_profesor.php'>";
                    } else {
                        $profe = mysqli_fetch_assoc($consulta); ?>
                        <div class="center-contenedor-login">
                            <div class="contenedor-login">
                                <h2 class="login-header">Editar profesor</h2>
                                <form action="editar_profesor.php" class="login" method="POST">
                                    DNI: <input readonly type="text" name="DNI" value="<?php echo $profe['DNI'] ?>" /><br></br>
                                    Nombre: <input type="text" required="required" name="nombre" value="<?php echo $profe['nombre'] ?>" /><br></br>
                                    Apellidos: <input type="text" required="required" name="apellidos" value="<?php echo $profe['apellidos'] ?>" /><br></br>
                                    Titulo Academico: <input type="text" required="required" name="titulo" value="<?php echo $profe['titulo'] ?>"><br></br>
                                    Fotografía: <input type="text" required="required" name="foto" value="<?php echo $profe['foto'] ?>" /><br></br>
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
                echo "No tenemos el DNI de profesor";
            }
        }
    } else {
        echo "<p>Has d'estar valiat per veure aquesta pÃ gina</p>";
        echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=login_admin.php'>";
    }

    ?>
</body>

</html>