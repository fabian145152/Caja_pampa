<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$semana_actual = date("W");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COBROS</title>
    <?php head() ?>
</head>

<body>

    <a href="../../menu.php">SALIR</a>

    <h4 style="text-align: center; ">SEMANA: <?php echo $semana_actual ?></h4>
    <form style=" width: 50vw; margin : 20vw;" method="post" action="vista_cobros.php">
        Ingrese Movil:
        <input type="text" id="movil" name="movil" autofocus>
        <button type="submit">Sigue</button>
    </form>
    <?php


    ?>
    <?php foot(); ?>
</body>

</html>