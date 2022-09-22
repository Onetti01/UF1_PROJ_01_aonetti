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

    if ( $count == 1 ) {
        //Variable de sessión
        // $_SESSION['usuario'] = $_POST['usuario']; // Por si el admin tiene que editar algo como usuario
        $_SESSION['administrador'] = $_POST['usuario'];
    } else {
        //Control del login
        echo "El usuario o la password no se han introducido correctamente";
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

    <body>

        <div id="titulo-admin">
            <h2>Panel administrativo</h2>
        </div>
        <a class="boton-personalizado" href="gestion_profesor.php">Gestión Professor</a>
        <a class="boton-personalizado" href="gestion_curso.php">Gestión Cursos</a>
        <a class="boton-personalizado" href="login.php">Volver al login</a>

    </body>

    </html>
<?php
}
