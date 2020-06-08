<?php
    $dbc = @mysqli_connect('localhost','root','','dropo_coffee_db')
        OR die('No se pudo conectar a la base de datos'.mysqli_connect_error());

    session_start();

    if (!isset($_SESSION['login']))//not logged in
    {
        echo '<script>alert("You have to be login!")</script>';
        header("Location: login/index.php");
        exit(); // NOT DIE :P
    }
?>