<?php
session_start();
include 'conf.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = isset($_POST['user']) ? $_POST['user'] : "";
    $pass = isset($_POST['pass']) ? $_POST['pass'] : "";

    if (!empty($user) && !empty($pass)) {
        $queryUser = "SELECT id_usuario, nombre, apellido, id_rol, nombre_usuario, password FROM usuarios WHERE nombre_usuario = '$user'";
        $queryRol="SELECT rol.nombre  FROM usuarios as us join roles as rol on us.id_rol=rol.id_roles WHERE us.nombre_usuario = '$user'";
        $ejecutar = mysqli_query($conexion, $queryUser);
        $execRol=mysqli_query($conexion,$queryRol);

        if ($ejecutar === false) {
            echo "Error en la consulta: " . mysqli_error($conexion);
        } else {
            $row = mysqli_fetch_assoc($ejecutar);
            if ($row) {
                $contra = $row['password'];
                if ($contra == $pass) {
                    header('Location: Principal.php');
                    $_SESSION['NombreUsuario'] = $user;
                    $rolito=mysqli_fetch_array($execRol);
                    $_SESSION['Roles']=$rolito[0];

                } else {
                    echo "<script> alert('Contraseña incorrecta.')</script> ";
                }
            } else {
                echo "<script> alert('Ese usuario NO existe')</script> ";
            }
        }
    } else {
        echo "<script> alert('Por favor, ingrese usuario y contraseña.')</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styleLogin.css">
</head>

<body>
    <div class="container ">
        <form class="col-12" action="" method="post">
            <div class="row  centrado">

                <div class="col-6 div1">
                    <div class="izquierda">
                        <label for="">Bienvenido a .... de SV </label><br><br>
                        <img src="./img/grupo2.png" alt="" srcset=""><br><br>
                        <label style="font-size: 20px;" for="">Eres nuevo?</label>
                        <a style="font-size: 20px;" href="#">Registrate aqui!</a>

                    </div>
                </div>
                <div class="col-6 div2">
                    <div class="derecha linea">
                        <div style="text-align: center;margin-bottom: 15%; ">
                            <label style="font-size: 30px;" for="">Inicia sesión</label>
                        </div>
                        <div style="margin-bottom: 10%;">
                            <label for="">Nombre de Usuario</label>
                            <input name="user" type="text" id="" placeholder="Ingrese su nombre de usuario">

                        </div>
                        <div style="margin-bottom: 10%;">
                            <label for="">Contraseña</label>
                            <input name="pass" type="password" id="" placeholder="Ingrese su contraseña">

                        </div>
                        <div style="text-align: center;">
                            <button class="btn">Iniciar Sesion</button>
                        </div>



                    </div>

                </div>




            </div>
        </form>

    </div>
</body>

</html>