<?php
session_start();
include 'conf.php';
$rol = $_SESSION['Roles'];
if ($rol == "Visor") {
    header("Location: Principal.php");
}
$mensaje = "";
if (isset($_POST["nombre"])) {

    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $rolPost = $_POST["rol"];
    $queryAgg = "INSERT INTO `usuarios` (`id_usuario`, `nombre`, `apellido`, `id_rol`, `nombre_usuario`, `password`) VALUES (NULL, '$nombre', '$apellido', '$rolPost', '$user', '$pass')";
    $exect = mysqli_query($conexion, $queryAgg);


    if ($exect) {
        $mensaje = "Los datos se han insertado correctamente";
    } else {
        $mensaje = "Error al insertar los datos en la base de datos";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/styleEditar.css">
    <title>Document</title>
</head>
<body>
    <form action="agregar.php" method="post" class="form">

        <!--TITULO------------------------>
        <h1 class="titulo">Registrar Personal</h1>

        <!--CAJAS-DE-ENTRADA-DE-DATOS------------------------------------------------>

        <input class="cajas" type="text" id="nombre" name="nombre" placeholder="Nombre" required maxlength="30">
        <input class="cajas" type="text" name="apellido" id="apellido" placeholder="Apellido">
        <input class="cajas" type="text" name="dui" id="" placeholder="DUI" >
        <input class="cajas" type="text" name="telefono" id="" placeholder="Telefono" >
        <input class="cajas" type="text" name="correo" id="" placeholder="Correo" >
        <input class="cajas" type="text" name="fecha_ingreso" id="" placeholder="Fecha Ingreso" >
        <input class="cajas" type="text" name="distancia" id="" placeholder="Distancia">
        <input class="cajas" type="text" name="tiempo_estimado" id="" placeholder="Tiempo Estimado" >
        <!--BOTON-DE-REGISTRARSE-------------------------->
        <input type="submit" class="btn" value="ENVIAR">

        <!--YA-TENGO-CUENTA----------------------------------------------------------->
        <p class="tengo-cuenta"><a href="" class="tengo-cuenta">Cancelar</a></p>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <?php
    if (!empty($mensaje)) {
        echo "<script>
            Swal.fire({
                title: 'Operación completada',
                text: '$mensaje',
                icon: 'success'
            }).then((result) => {
                window.location.href = 'Principal.php';
            });
        </script>";
    }
    ?>
</body>

</html>