<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo "Movil: " . $movil = $_POST['movil'];
$deposito_en_ft = 0;
$dep_mercado = 0;


## CONSULTA PARA LA DEUDA ANTERIOR DE LA TABLA COMPETA
$sql_completa = "SELECT * FROM completa WHERE movil=" . $movil;
$res_completa = $con->query($sql_completa);
$row_completa = $res_completa->fetch_assoc();
$deuda_anterior = $row_completa['deuda_anterior'];
echo "<br>";




//echo "Deuda anterior leido de la ddbb: " . $deuda_anterior;

## CONSULTA PARA LA DEUDA DE SEMANAS DE LA TABLA SEMANAS
$sql_semanas = "SELECT * FROM semanas WHERE movil=" . $movil;
$res_semanas = $con->query($sql_semanas);
$row_semanas = $res_semanas->fetch_assoc();
echo "<br>";
$semanas = $row_semanas['total'];
echo "Debe de semanas anteriores: " . $semanas;

$deposito_en_ft = 0;
$dep_mercado = 0;


echo "<br>";
echo "Deposito en efectivo: " . $deposito_en_ft = $_POST['dep_ft'];
echo "<br>";
echo "Deposito de MP: " . $dep_mercado = $_POST['dep_mp'];
echo "<br>";
echo "Total de viajes: " . $total_de_viajes = $_POST['viajes'];
echo "<br>";
echo "Total de voucher: " . $tot_voucher = $_POST['tot_voucher'];
echo "<br>";
echo "Porcentaje para el movil: " . $para_el_movil = $_POST['para_movil'];
echo "<br>";
echo "Porcentaje para base mas cant de vajes: " . $comisiones = $_POST['comi'];
echo "<br>";
echo "Productos vendidos: " . $productos_vendidos = $_POST['prod'];
echo "<br>";
echo "Debe de semanas anteriores: " . $debe_sem_ant = $_POST['debe_ant'];
echo "<br>";
echo "Debe abonar: " . $debe_abonar = $_POST['debe_abonar'];
echo "<br>";

echo "Calculo de deuda: " . $calc_deuda = $deuda_anterior + $semanas + $productos_vendidos;
echo "<br>";
$vuelto_con_decimales =  $debe_abonar - $deposito_en_ft;
$vuelto_neg = round($vuelto_con_decimales, 2);
$vuelto = abs($vuelto_neg);
echo "Vuelto en efectivo: " . $vuelto;
echo "<br>";


if ($deposito_en_ft == 0) {
    $vuel = $dep_mercado - $debe_abonar;
    echo "Vuelto en FT: " . $vuel;
    $vueltos = round($vuel, 2);
    echo "<br>";
}
if ($dep_mercado == 0) {
    $vuel = $deposito_en_ft - $debe_abonar;
    echo "Vuelto de Mp: " . $vuel;
    $vueltos = round($vuel, 2);
    echo "<br>";
}





echo $fecha = date("Y-m-d H:i:s");


//exit;

$sql_insert_caja_movil = "INSERT INTO caja_movil (movil, 
                                                comisiones, 
                                                deuda_anterior, 
                                                debe_sem_ant, 
                                                prod_vendidos,
                                                calculo_deuda,
                                                deposito_voucher,
                                                dep_ft,
                                                para_el_movil,
                                                ft_en_caja,
                                                dep_mp,
                                                pesos_a_favor,
                                                fecha
                                                ) 
                                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt_insert_caja_movil = $con->prepare($sql_insert_caja_movil);

$stmt_insert_caja_movil->bind_param(
    "iddddddddddds",
    $movil,
    $comisiones,
    $deuda_anterior,
    $semanas,
    $productos_vendidos,
    $calc_deuda,
    $tot_voucher,
    $deposito_en_ft,
    $para_el_movil,
    $deposito_en_ft,
    $dep_mercado,
    $vuelto,
    $fecha
);



if ($stmt_insert_caja_movil->execute() === TRUE) {

    echo "<br>";
    echo "Registro creado con exito...";
    echo "<br>";
}


$sql_caja_movil = "SELECT * FROM caja_movil WHERE movil= $movil LIMIT 1";
$res_caja_movil = $con->query($sql_caja_movil);
$row_caja_movil = $res_caja_movil->fetch_assoc();
echo "<br>";
$row_caja_movil['movil'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<?php


if ($deposito_en_ft < $deuda_anterior) {
    echo "Deposite un minimo de  <strong>" . $calculo_deuda . "</strong> Para cancelar la deuda anterior: ";
?>
    <br>
    <a href="cobro_con_voucher.php" class="btn btn-danger">VOLVER</a>
<?php
    exit;
}

echo $deuda_anterior_generada = $deuda_anterior - $deposito_en_ft;
$sql_deuda_ant = "UPDATE completa SET deuda_anterior = $deuda_anterior_generada WHERE movil =" . $movil;


if ($con->query($sql_deuda_ant) == FALSE) {
    echo "Error al editar registro..." . $con->error;
    exit;
}

##------------------------------------------------------------------------------------
##------------------------------------------------------------------------------------

echo "<br>";
echo $nueva_deuda_anterior = $debe_sem_ant + $productos_vendidos;
$sql_nueva_deuda_ant = "UPDATE completa SET deuda_anterior = $nueva_deuda_anterior,
                                            venta_1 = 0,
                                            venta_2 = 0,
                                            venta_3 = 0,
                                            venta_4 = 0,
                                            venta_5 = 0
WHERE movil =" . $movil;

if ($con->query($sql_nueva_deuda_ant) == FALSE) {
    echo "Error al editar registro..." . $con->error;
    exit;
}

$sql_semanas_ant = "UPDATE semanas SET total = 0 WHERE movil =" . $movil;


if ($con->query($sql_semanas_ant) == FALSE) {
    echo "Error al editar registro..." . $con->error;
    exit;
}

?>

<body>
    <ul>
        <li><?php echo "identificador: " . $id_ant = $row_caja_movil['id'] ?></li>
        <li><?php echo "Movil: " . $movil_ant = $row_caja_movil['movil'] ?></li>
        <li><?php echo "Comisiones anteriores: " . $comi_ant = $row_caja_movil['comisiones'] ?></li>
        <li><?php echo "Deuda anterior: " . $row_caja_movil['deuda_anterior'] ?></li>
        <li><?php echo "Debe de semanas anteriores: " . $row_caja_movil['debe_sem_ant'] ?></li>
        <li><?php echo "Productos vendidos: " . $row_caja_movil['prod_vendidos'] ?></li>
        <li><?php echo "Calculo de deuda anterior: " . $calculo_deuda_ant = $row_caja_movil['calculo_deuda'] ?></li>
        <li><?php echo "Deposito en voucher: " . $row_caja_movil['deposito_voucher'] ?></li>
        <li><?php echo "Porcentaje para movil: " . $depositarle = $row_caja_movil['para_el_movil'] ?></li>
        <li><?php echo "Efectivo en caja: " . $ft_en_caja = $row_caja_movil['ft_en_caja'] ?></li>
        <li><?php echo "Deposito en efectivo: " . $efectivo = $row_caja_movil['dep_ft'] ?></li>
        <li><?php echo "Fecha del deposito" . $row_caja_movil['fecha'] ?></li>

        <li><?php echo "Deposito en MP: " . $mp = $row_caja_movil['dep_mp'] ?></li>
        <li><?php echo "Vuelto a favor: " . $vuel = $row_caja_movil['pesos_a_favor'] ?></li>
    </ul>
    <?php



    $observaciones = " ";
    if ($dep_mercado <= 0) {
        $observaciones = "Deposito en FT del móvil: " . $movil;
        echo $observaciones;
    } else {
        $observaciones = "Deposito en MP del móvil: " . $movil;
        echo "$observaciones";
    }

    $sql_caja_final = "INSERT INTO caja_final (ft, vueltos, dep_mp, fecha, observaciones) VALUES (?,?,?,?,?)";
    $stmt_caja_final = $con->prepare($sql_caja_final);

    $stmt_caja_final->bind_param("dddss", $deposito_en_ft, $vueltos, $dep_mercado, $fecha, $observaciones);


    if ($stmt_caja_final->execute() === TRUE) {
        echo "<br>";
        echo "<br>";
        echo "<br>";
        echo "Registro creado con exito...";
        echo "<br>";
        echo "<br>";
        echo "<br>";
    }


    $sql = "DELETE FROM caja_movil WHERE movil='$movil' ORDER BY id ASC LIMIT 1";

    // Ejecutar la consulta
    if ($con->query($sql) === TRUE) {
        echo "Registro eliminado correctamente.";
    } else {
        echo "Error al eliminar el registro: " . $con->error;
    }

    ?>
    <h1>Falta borrar los voucher y esta terminado el cobro con voucher</h1>
    <?php

    $movil_con_a = "A" . $movil;

    //-------------------------------habilitar esta parte que borra los voucher validados

    //$borra_voucher = "DELETE FROM `voucher_validado` WHERE movil= '$movil_con_a'";

    // Ejecutar la consulta
    if ($con->query($borra_voucher) === TRUE) {
        echo "Voucher eliminado correctamente.";
    } else {
        echo "Error al eliminar los Voucher: " . $con->error;
        exit;
    }



    header("Location:inicio_cobros.php");

    ?>
</body>


</html>