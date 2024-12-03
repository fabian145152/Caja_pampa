<?php
//session_destroy();
session_start();
include_once "../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

if ($_SESSION['logueado']) {

    // Si se envía el formulario
    if (isset($_POST['actualizar'])) {
        // Consulta para actualizar todos los registros
        $sql_completa = "UPDATE completa SET deuda_anterior = 0, pago_ant = 0, venta_1 = 0, venta_2 = 0, venta_3 = 0, venta_4 = 0, venta_5 = 0";

        if ($con->query($sql_completa) === TRUE) {
            echo "<br>";
            echo "Los tabla completa se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_semanas = "UPDATE semanas SET total = 0";

        if ($con->query($sql_semanas) === TRUE) {
            echo "<br>";
            echo "Los tabla semanas se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_recibo = "UPDATE recibo set numero = 1";

        if ($con->query($sql_recibo) === TRUE) {
            echo "<br>";
            echo "El numero de recibo se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_voucher_nuevos = "TRUNCATE TABLE voucher_nuevos";
        if ($con->query($sql_voucher_nuevos) === TRUE) {
            echo "<br>";
            echo "La tabla voucher nuevos se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_voucher_temporales = "TRUNCATE TABLE voucher_temporales";
        if ($con->query($sql_voucher_temporales) === TRUE) {
            echo "<br>";
            echo "La tabla voucher temporales se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_voucher_validado = "TRUNCATE TABLE voucher_validado";
        if ($con->query($sql_voucher_validado) === TRUE) {
            echo "<br>";
            echo "La tabla voucher validado se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_user_logeado = "TRUNCATE TABLE users_logeado";
        if ($con->query($sql_user_logeado) === TRUE) {
            echo "<br>";
            echo "La tabla usuarios logeados se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_caja_movil = "TRUNCATE TABLE caja_movil";
        if ($con->query($sql_caja_movil) === TRUE) {
            echo "<br>";
            echo "La tabla caja movil se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        $sql_caja_final = "TRUNCATE TABLE caja_final";
        if ($con->query($sql_caja_final) === TRUE) {
            echo "<br>";
            echo "La tabla caja final se actualizo correctamente.";
            echo "<br>";
        } else {
            echo "Error al actualizar los registros: " . $con->error;
            exit;
        }

        // Ejemplo de uso
        $directorio = 'admin/cobros/recibos/';
        if (deleteAllFilesInDirectory($directorio)) {
            echo "<br>";
            echo "Todos los recibos se eliminaron exitosamente.";
            echo "<br>";
        } else {
            echo "Error al eliminar los archivos.";
            exit;
        }


        echo "<br></BR>";
        echo "<strong>TODOS LOS REGISTROS ACTUALIZADOS CORRECTAMENTE, NINGUNA UNIDAD DEBE NADA</strong>";
        echo "<br></BR>";
        echo "<a href='menu.php'>VOLVER</a>";
        echo "<BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR>";
        echo "<BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR>";
        echo "<BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR><BR></BR>";
    }

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <?php head() ?>
    </head>

    <body>

        <h1>INICIALIZA PROGRAMA</h1>
        <div class="col-md-3">
            <div class="list-group">
                <form method="post">
                    <button type="submit" name="actualizar" class=" btn btn-success btn-block btn-sm">BORRAR TODAS LAS DEUDAS</button>
                </form>
                <br><br><br>
                <a href="menu.php" class=" btn btn-info btn-block btn-sm">NOBORRAR NADA Y VOLVER AL MENU PRINCIPAL</a>
            </div>
        </div>

    </body>

    </html>


<?php
}
?>