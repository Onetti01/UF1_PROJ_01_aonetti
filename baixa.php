<?php
    session_start();
    $con=mysqli_connect("localhost","root","","info_bdn");
    
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //Se guarda la variabla de sesión y consulta a la bbdd
    $email = $_SESSION['email'];
    $sql = "DELETE FROM usuarios WHERE email = '$email'";

    if (!mysqli_query($con,$sql)){
        die('Error: ' . mysqli_error($con));
    }else{

        echo "Se ha dado de alta correctamente.";
    }

    mysqli_close($con);

    //Destruimos la sesión
    session_destroy();
    echo "<META HTTP-EQUIV='REFRESH' CONTENT='2;URL=login.php'>";
?>