<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo "Movil: " . $movil = $_POST['movil'];


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



echo "<br>";
echo "Deposiyo en efectivo: " . $deposito_en_ft = $_POST['dep_ft'];
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
echo "<br>";
echo "<br>";
echo "<br>";
echo "Calculo de deuda: " . $calc_deuda = $deuda_anterior + $semanas + $productos_vendidos;
echo "<br>";
$vuelto_con_decimales =  $debe_abonar - $deposito_en_ft;
$vuelto_neg = round($vuelto_con_decimales, 2);
$vuelto = abs($vuelto_neg);
echo "Vuelto en efectivo: " . $vuelto;
echo "<br>";
echo "<br>";


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
                                                pesos_a_favor,
                                                fecha
                                                ) 
                                        VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
$stmt_insert_caja_movil = $con->prepare($sql_insert_caja_movil);

$stmt_insert_caja_movil->bind_param(
    "iiiiiiiiiids",
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
    $vuelto,
    $fecha
);



if ($stmt_insert_caja_movil->execute() === TRUE) {
    echo "<br>";
    echo "<br>";
    echo "<br>";
    echo "Registro creado con exito...";
    echo "<br>";
    echo "<br>";
    echo "<br>";
}


$sql_caja_movil = "SELECT * FROM caja_movil WHERE movil= $movil LIMIT 1";
$res_caja_movil = $con->query($sql_caja_movil);
$row_caja_movil = $res_caja_movil->fetch_assoc();
echo "<br>";
echo "Leido de la tabla caja_movil: " . $row_caja_movil['movil'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

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
        <li><?php echo "Deposito en efectivo: " . $row_caja_movil['dep_ft'] ?></li>
        <li><?php echo "Porcentaje para movil: " . $depositarle = $row_caja_movil['para_el_movil'] ?></li>
        <li><?php echo "Efectivo en caja: " . $row_caja_movil['ft_en_caja'] ?></li>
        <li><?php echo "Vuelto a favor: " . $row_caja_movil['pesos_a_favor'] ?></li>
        <li><?php echo "Fecha del deposito" . $row_caja_movil['fecha'] ?></li>
    </ul>
    <?php




    ?>
</body>


</html>