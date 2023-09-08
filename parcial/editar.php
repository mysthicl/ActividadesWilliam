<?php
include 'conf.php';
session_start();
$rol = $_SESSION['Roles'];
if ($rol == "Visor") {
    header("Location: Principal.php");
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id2 = $_POST["id"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $rolPost = $_POST["rol"];
    $queryEdit = "UPDATE `usuarios` SET `id_usuario`='$id2',`nombre`='$nombre',`apellido`='$apellido',`id_rol`='$rolPost',`nombre_usuario`='$user',`password`='$pass' WHERE id_usuario=$id2";
    $exect = mysqli_query($conexion, $queryEdit);

    if ($exect) {
        $mensaje = "Los datos se han editado correctamente";
    } else {
        $mensaje = "Error al editar los datos en la base de datos";
    }
} else {
    $id = $_GET["id"];
    $querySelect = "SELECT * FROM `usuarios` WHERE id_usuario=$id";
    $execSelect = mysqli_query($conexion, $querySelect);
    if ($execSelect) {
        $arraySelect = mysqli_fetch_array($execSelect);
        if (isset($_POST["nombre"])) {
        }
    } else {
        echo "PENDEJO";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    
    <form action="editar.php" method="post" class="form">

        <!--TITULO------------------------>
        <h1 class="titulo">Formulario de edicion</h1>

        <!--CAJAS-DE-ENTRADA-DE-DATOS------------------------------------------------>
        <input class="cajas" hidden type="text" name="id" value="<?= $arraySelect[0] ?>">
        <div class="n">
            <label for="">Nombre</label>
            <input class="cajas" type="text" name="nombre" value="<?= $arraySelect[1] ?>">
        </div>
        <div class="n">
            <label for="">Apellido</label>
            <input class="cajas" type="text" id="apellido" value="<?= $arraySelect[2] ?>" name="apellido">
        </div>
        <div class="n">
            <label for="">Usuario</label>
            <input class="cajas" type="text" id="username" value="<?= $arraySelect[4] ?>" name="username">
        </div>
        <div class="n">
            <label for="">Rol</label>
            <select name="rol" id="rol" class="form-select form-select-lg mb-3" aria-label="Large select example">

                <option value="1" <?php if ($arraySelect[3] == 1) echo "selected"; ?>>Administrador</option>
                <option value="2" <?php if ($arraySelect[3] == 2) echo "selected"; ?>>Usuario</option>
                <option value="3" <?php if ($arraySelect[3] == 3) echo "selected"; ?>>Visor</option>
            </select><br><br>
        </div >
        <div class="n">
            <label for="">Contraseña</label>
            <input class="cajas" type="password" id="password" value="<?= $arraySelect[5] ?>" name="password" required maxlength="30">
        </div>


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