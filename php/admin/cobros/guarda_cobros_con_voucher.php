<?php
session_start();
include_once "../../../funciones/funciones.php";

$con = conexion();
$con->set_charset("utf8mb4");



## MUESTRA TODOS LOS POST QUE LLEGAN
/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
*/

echo "EVENTO REALIZADO POR: "  . $_SESSION['uname'] . '<br>';
$_SESSION['time'] . '<br>';
echo date("d-m-Y");
$usuario = $_SESSION['uname'];
echo "<br>";
echo "Movil: " . $movil = $_POST['movil'];
echo "<br>";


echo "Total de voucher: " . $tot_voucher = $_POST['tot_voucher'];
echo "<br>";
echo "Cantidad de viajes: " . $can_viajes = $_POST['can_viajes'];
echo "<br>";
echo "Paga x viaje: " . $paga_x_viaje = $_POST['paga_x_viaje'];
echo "<br>";
echo "Porcentaje para base mas cant de vajes: " . $comisiones = $_POST['comi'];
echo "<br>";
echo "Depositarle al movil: " . $depositarle = $_POST['depo_mov'];
echo "<br>";
echo "debe de semanas anteriores: " . $semanas = $_POST['debe_ant'];
echo "<br>";
echo "Deuda anterior: " . $deuda_ant = $_POST['deuda_ant'];
echo "<br>";

echo "<br>";
echo "Deposito en efectivo: " . $dep_ft = $_POST['dep_ft'];
echo "<br>";
echo "Deposito de MP: " . $dep_mercado = $_POST['dep_mp'];
echo "<br>";
echo "Total ventas: " . $otal_ventas = $_POST['prod'];
echo "<br>";
echo "<br>";
echo "<br>";
echo "Productos que compro:  " . $ventas = $_POST['prod'];
echo "<br>";
$deuda_total = $deuda_ant + $semanas + $ventas;
echo "<br>";
echo "Pesos a favor:  " . $pesos = $_POST['pesos'];
echo "<br>";
echo $fecha = date("Y-m-d H:i:s");
echo "<br>";

echo $usuario;
//exit;

$stmt_mov_movil = $con->prepare("INSERT INTO caja_movil (movil, 
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
                                                                fecha,
                                                                usuario                                               
                                                                ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt_mov_movil->bind_param(
    "idddddddddddss",
    $movil,
    $comisiones,
    $deuda_ant,
    $semanas,
    $ventas,
    $deuda_total,
    $tot_voucher,
    $dep_ft,
    $depositarle,
    $deuda_total,
    $dep_mercado,
    $pesos,
    $fecha,
    $usuario
);

if ($stmt_mov_movil->execute() === TRUE) {
    echo "Registro ingresado correctamente en la tabla caja_movil: ";
    echo "<br>";
} else {
    die("Error al crear registro en la tabla caja_movil: " . $con->error);
}



##-------------------------------------------------------------------
## UPDATE DEUDA ANTERIOR Y VENTAS
##-------------------------------------------------------------------

$actualiza_deuda_anterior = 0;
$venta_1 = 0;
$venta_2 = 0;
$venta_3 = 0;
$venta_4 = 0;
$venta_5 = 0;

$sql_comp = "UPDATE completa SET deuda_anterior = ?, 
                                    venta_1 = ?,
                                    venta_2 = ?,
                                    venta_3 = ?,
                                    venta_4 = ?,
                                    venta_5 = ?
                                    WHERE movil=" . $movil;

$stmt_comp = $con->prepare($sql_comp);
if ($stmt_comp === false) {
    die("Error al preparar la consulta de actualizar la deuda anterior: " . $con->error);
}

$stmt_comp->bind_param(
    "iiiiii",
    $actualiza_deuda_anterior,
    $venta_1,
    $venta_2,
    $venta_3,
    $venta_4,
    $venta_5
);

if ($stmt_comp->execute()) {
    echo "Registro de deuda anterior actualizado correctamente.";
    echo "<br>";
} else {
    echo "Error al actualizar el registro de la deuda anterior: " . $stmt_comp->error;
    exit;
}

##-------------------------------------------------
## ACTUALIZA SEMANAS
##-------------------------------------------------
$semanas_en_cero = 0;

$sql_semanas = "UPDATE semanas SET total = ? WHERE movil=" . $movil;

$stmt_semanas = $con->prepare($sql_semanas);

if ($stmt_semanas === false) {
    die("Error al preparar la consulta: " . $con->error);
}
$stmt_semanas->bind_param("i", $semanas_en_cero);

if ($stmt_semanas->execute()) {
    echo "Registro de deuda de semanas anteriores actualizado correctamente.";
    echo "<br>";
} else {
    echo "Error al actualizar el registro de actualizacion de deuda de semanas anteriores: " . $stmt_comp->error;
    exit;
}

##-------------------------------------------------
## ACTUALIZA VOUCHER
##-------------------------------------------------

$movil_con_a = "A" . $movil;


$sql_voucher = "DELETE FROM voucher_validado WHERE movil = ?";

$stmt_voucher = $con->prepare($sql_voucher);
$stmt_voucher->bind_param("s", $movil_con_a);

if ($stmt_voucher->execute()) {
    echo "Voucher validado eliminado correctamente";
    echo "<br>";
} else {
    echo "Error al eliminar los voucher validados: " . $con->error;
    exit;
}


include_once "recibo.php";

exit;

header("Location:inicio_cobros.php");

?>

</body>


</html>