<?php
session_start();
$rol = $_SESSION['Roles'];
if ($rol == "Usuario" || $rol == "Visor") {
    header("Location: Principal.php");
}

$id = $_GET["id"];
include 'conf.php';
$queryDelete = "DELETE FROM `usuarios` WHERE id_usuario = $id";
$exec = mysqli_query($conexion, $queryDelete);
if ($exec) {
    
    header("Location: Principal.php");
} else {
    
}
?>
