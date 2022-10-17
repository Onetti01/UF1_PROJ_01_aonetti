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
    <title>editar_alumno</title>
</head>

<body>
    <?php
    if (isset($_SESSION["alumnos"])) {
        if ($_POST) {
            $bddcon = mysqli_connect("localhost", "root", "", "info_bdn");
            if ($bddcon == false) {
                mysqli_connect_error();
            } else {
                //Declaramos las variables
                $email = $_POST['email'];
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];


                //Actualizamos la bbdd
                $sql = "UPDATE alumnos SET nombre='$nombre', apellidos='$apellidos' WHERE email LIKE '$email'";
                $consulta = mysqli_query($bddcon, $sql);

                if (!$consulta) {
                    echo mysqli_error($bddcon) . "<br>";
                    echo "Error querry no valida " . $sql;
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='333333333;URL=academia.php'>";
                } else {
                    echo "Alumno editado correctamente";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3333333333333;URL=academia.php'>";
                }
            }
        } else {
            $bddcon = mysqli_connect("localhost", "root", "", "info_bdn");
            if ($bddcon == false) {
                mysqli_connect_error();
            } else {
                $email = $_SESSION['alumnos'];
                $sql = "SELECT * FROM alumnos WHERE email LIKE '$email'";
                $consulta = mysqli_query($bddcon, $sql);
                if (!$consulta) {
                    echo mysqli_error($bddcon) . "<br>";
                    echo "Error querry no valida " . $sql;
                    echo "Redirigint..";
                    echo "<META HTTP-EQUIV='REFRESH' CONTENT='3;URL=academia.php'>";
                } else {
                    $alum = mysqli_fetch_assoc($consulta); ?>
                    <div class="center-contenedor-login">
                        <div class="contenedor-login">
                            <h2 class="login-header">Editar alumno</h2>
                            <form action="editar_alumno.php" class="login" method="POST">
                                Email: <input readonly type="text" required="required" name="email" value="<?php echo $alum['email'] ?>" /><br></br>
                                Nombre: <input type="text" required="required" name="nombre" value="<?php echo $alum['nombre'] ?>" /><br></br>
                                Apellidos: <input type="text" required="required" name="apellidos" value="<?php echo $alum['apellidos'] ?>" /><br></br>

                                <p><button type='submit'>Modificar</button></p>
                                </a>
                            </form>
                        </div>
                    </div>
                    </div><?php
                        }
                    }
                }
            }

                            ?>
</body>

</html>