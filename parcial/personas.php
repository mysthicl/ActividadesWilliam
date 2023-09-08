<?php
session_start();
if (!isset($_SESSION['NombreUsuario'])) {
    header('Location:Login.php');
}
include 'conf.php';

$user = $_SESSION['NombreUsuario'];
$queryRol = "SELECT usuarios.nombre AS nombre_usuario, roles.nombre AS nombre_rol FROM usuarios JOIN roles ON usuarios.id_rol=roles.id_roles WHERE usuarios.nombre_usuario = '$user'";
$query="SELECT * FROM `tbl_persona`";
$exectPerson=mysqli_query($conexion,$query);
$ejecutarRol = mysqli_query($conexion, $queryRol);

if ($ejecutarRol === false) {

    echo "Error en la consulta: " . mysqli_error($conexion);
} else {
    $row = mysqli_fetch_assoc($ejecutarRol);

    if ($row) {

        $nombreRol = $row['nombre_rol'];
    } else {

        echo "No se encontraron resultados para la consulta.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styleIndex.css">
</head>
<style>
    .eliminar {
        color: red;

    }

    .editar {
        color: rgb(255, 176, 4);
    }
</style>

<body>
    <div class="seccion-1"></div>
    <div class="seccion-2"></div>

    <div class="container">
        <div class="row centrado">
            <form style="padding: 5%;" action="" method="post">
                <div class="usuario">
                    <img style="width: 60px;" src="https://images.vexels.com/media/users/3/137047/isolated/preview/5831a17a290077c646a48c4db78a81bb-icono-de-perfil-de-usuario-azul.png" alt="" srcset="">
                    <b>Bienvenido <?php echo $user ?></b>
                    <a style="margin-left: 50%;" class="btn btn-danger" href="cerrar.php" >Cerrar Sesion</a>
                </div>
                <div class="contenedorTabla">
                    <div id="encabezado">
                        <b>Tabla de usuarios</b>
                        <a style="margin-left: 75%;" class="btn btn-primary " href="agregarPersonas.php">Agregar</a>
                    </div>
                    <div class="tabla">
                        <table class="table table-success ">
                            <thead>
                                <tr>
                                    <th hidden>Id</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>DUI</th>
                                    <th>Telefono</th>
                                    <th>Correo</th>
                                    <th>Fecha Ingreso</th>
                                    <th>Distancia</th>
                                    <th>Tiempo Estimado</th>
                                    <?php if($nombreRol=="Administrador"|| $nombreRol=="Usuario"):?>
                                    <th>Opciones</th>
                                    <?php endif;?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($datos=mysqli_fetch_array($exectPerson)) {
                                echo ("<tr>");
                                        echo("<td hidden>$datos[0]</td>");
                                        echo("<td>$datos[1]</td>");
                                        echo("<td>$datos[2]</td>");
                                        echo("<td>$datos[3]</td>");
                                        echo("<td>$datos[4]</td>");
                                        echo("<td>$datos[5]</td>");
                                        echo("<td>$datos[6]</td>");
                                        echo("<td>$datos[7]</td>");
                                        echo("<td>$datos[8]</td>");
                                        if($nombreRol=="Administrador" || $nombreRol=="Usuario"):
                                        echo("<td>");
                                         if($nombreRol=="Administrador" || $nombreRol=="Usuario"):
                                        echo("<a id='btnEditar' href='' data-nombre='$datos[1]' data-id='$datos[0]' >");
                                            echo('<i class="bi bi-pencil-square editar"></i>');
                                        echo ('</a>&nbsp;');
                                         endif;
                                         if($nombreRol=="Administrador"):
                                        echo ("<a class='btnEliminar' href='' data-nombre='$datos[1]' data-id='$datos[0]'>");
                                            echo('<i class="bi bi-trash2-fill eliminar"></i>');
                                        echo("</a>");
                                        endif;
                                    echo("</td>");
                                     endif;

                                echo ("</tr>");
                                }?>


                            </tbody>
                        </table>
                    </div>
                </div>
                <a data-id=""></a>


            </form>


        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    const btnSeleccionar = document.querySelectorAll(".btnEliminar");
        btnSeleccionar.forEach(element => {
            element.addEventListener("click", function() {
                event.preventDefault();
                const id = element.getAttribute("data-id");
                const nombre=element.getAttribute("data-nombre");
                Swal.fire({
            title: '¿Estás seguro?',
            text: 'Se eliminara el registro de '+nombre,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `eliminar.php?id=${id}`;
        }
    });
            });
        });

        const btnEditar = document.querySelectorAll("#btnEditar");
        btnEditar.forEach(element => {
            element.addEventListener("click", function() {
                event.preventDefault();
                const id = element.getAttribute("data-id");
               
                const nombre=element.getAttribute("data-nombre");
                Swal.fire({
            title: '¿Estás seguro?',
            text: 'Se editara el registro de '+nombre,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'OK',
            cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = `editar.php?id=${id}`;
        }
    });
            });
        });



    


</script>
</body>
</html>