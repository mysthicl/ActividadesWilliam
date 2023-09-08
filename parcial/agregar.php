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
        <h1 class="titulo">Registrase</h1>

        <!--CAJAS-DE-ENTRADA-DE-DATOS------------------------------------------------>



        <input class="cajas" type="text" id="nombre" name="nombre" placeholder="Nombre" required maxlength="30">



        <input class="cajas" type="text" name="apellido" id="apellido" placeholder="Apellido">



        <input class="cajas" type="text" name="username" id="username" placeholder="Usuario" >

       
        <input class="cajas" type="password"  id="password" name="password" placeholder="Contraseña" required maxlength="30">


        <select name="rol" id="rol" class="cajas" aria-label="Large select example">
        <option selected disabled>Abre este menu</option>
            <option value="1">Administrador</option>
            <option value="2">Usuario</option>
            <option value="3">Visor</option>
        </select><br><br>

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