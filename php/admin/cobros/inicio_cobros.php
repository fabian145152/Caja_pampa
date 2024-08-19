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
    <style>
        #Power-Contenedor {
            text-align: center;
        }
    </style>
</head>

<body>

    <h4 style="text-align: center; ">SEMANA: <?php echo $semana_actual ?></h4>
    <form style=" text-align:center;" method="post" action="vista_con_voucher.php">
        Ingrese Movil:
        <input type="text" id="movil" name="movil" autofocus>
        <button type="submit">Continuar</button>
    </form>
    <br><br><br>

    

    <br><br><br>

    <div id="Power-Contenedor">
        <a href="../../menu.php" id="Anyadir-Rutina-btn" class="btn btn-primary">SALIR</a>
    </div>


    <br><br><br><br>

    <form method="post" style=" text-align:center;">BORRAR TABLA
        <input type="submit" name="vaciar_tabla" value="vaciar_tabla">
    </form>
    <?php
    if ($con->connect_error) {
        die("Conexión fallida: " . $con->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vaciar_tabla'])) {
        // SQL para vaciar la tabla
        $sql = "TRUNCATE TABLE caja_movil";

        if ($con->query($sql) === TRUE) {
            echo "Tabla Vaciada con éxito";
        } else {
            echo "Error vaciando la tabla: " . $con->error;
        }
    }
    ?>
    <?php foot(); ?>
</body>

</html>