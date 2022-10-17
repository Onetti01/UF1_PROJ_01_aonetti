<?php
session_start();

if ($_POST) {

    //Variable con los datos de conexión

    $conn = new mysqli('localhost', 'root', '', 'info_bdn');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Recogida de los datos 
    $usuario =  $_POST['usuario'];
    $password =  $_POST['password'];
    $sql = "SELECT * FROM administrador WHERE usuario = '$usuario' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        //Variable de sessión
        $_SESSION['administrador'] = $_POST['usuario'];
    } else {
        //Control del login
        echo "El usuario o la password no se han introducido correctamente";
        header("Refresh:2; url=login.php");
    }
}

if (isset($_SESSION['administrador'])) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <title>administración</title>
    </head>
    <aside>
        <h3>Panel administratrivo</h3>
        <ul type="lista">
            <li><a class="boton-admin" href="gestion_profesor.php">Gestión Professor</a></li>
            <li><a class="boton-admin" href="gestion_curso.php">Gestión Cursos</a></li>
            <a href="die.php">Cerrar session</a></div>

        </ul>
    </aside>

    <body>

    </body>

    </html>
<?php
}
