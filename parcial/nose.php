<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/styleEditar.css">
</head>

<body>
    <form action="editar.php" method="post" class="form">

        <!--TITULO------------------------>
        <h1 class="titulo">Registrarse</h1>

        <!--CAJAS-DE-ENTRADA-DE-DATOS------------------------------------------------>
        
        <input class="cajas" type="text" placeholder="Nombre" required maxlength="30">
        <input class="cajas" type="text" placeholder="Apellido" required maxlength="30">
        <input class="cajas" type="email" placeholder="Email" required maxlength="30">
        <select class="form-select form-select-lg mb-3" aria-label="Large select example">
            <option selected disabled>Open this select menu</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </select>
        <input class="cajas" type="password" placeholder="Password" required maxlength="30">

        <!--TERMINOS-Y-CONDICIONES---------------------------------------------------------------------------------->
        <p class="termino1"><input type="checkbox"> Estoy de acuerdo con <a class="termino2" href="">Terminos y Condiciones</a></p>

        <!--BOTON-DE-REGISTRARSE-------------------------->
        <input type="submit" class="btn" value="REGISTRAR">

        <!--YA-TENGO-CUENTA----------------------------------------------------------->
        <p class="tengo-cuenta"><a href="" class="tengo-cuenta">Ya tengo cuenta</a></p>

    </form>
</body>

</html>