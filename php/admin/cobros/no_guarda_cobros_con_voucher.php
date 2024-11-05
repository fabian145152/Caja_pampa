<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo '<pre>';
print_r($_POST);
echo '</pre>';

echo "Movil: " . $movil = $_POST['movil'];
echo "<br>";

$depositarle = 0;

echo "<br>";
echo "Depositarle al movil: " . $depositarle = $_POST['depo_mov'];
echo "<br>";
echo "Porcentaje para base mas cant de vajes: " . $comisiones = $_POST['comi'];
echo "<br>";
echo "Total de voucher: " . $tot_voucher = $_POST['tot_voucher'];
echo "<br>";
echo "Deposito en efectivo: " . $deposito_en_ft = $_POST['dep_ft'];
echo "<br>";
echo "Deposito de MP: " . $dep_mercado = $_POST['dep_mp'];
echo "<br>";
echo "Total ventas: " . $otal_ventas = $_POST['prod'];
echo "<br>";
echo "Deuda anterior: " . $deuda_ant = $_POST['deuda_ant'];
echo "<br>";
echo "debe de semanas anteriores: " . $semanas = $_POST['debe_ant'];
echo "<br>";
echo "Productos que compro:  " . $ventas = $_POST['prod'];
echo "<br>";
$deuda_total = $deuda_ant + $semanas + $ventas;
echo "<br>";
echo "<br>";
echo $fecha = date("Y-m-d H:i:s");
echo "<br>";


$stmt_mov_movil = $con->prepare("INSERT INTO caja_movil (movil, 
                                                                comisiones, 
                                                                deuda_anterior, 
                                                                debe_sem_ant, 
                                                                prod_vendidos,
                                                                calculo_deuda,
                                                                deposito_voucher,
                                                                dep_ft
                                                                ) VALUES (?,?,?,?,?,?,?,?)");
$stmt_mov_movil->bind_param(
    "iddiiddd",
    $movil,
    $comisiones,
    $deuda_ant,
    $semanas,
    $ventas,
    $deuda_total,
    $tot_voucher,
    $deposito_en_ft
);

if ($stmt_mov_movil->execute() === FALSE) {
    echo "Error al insertar el registro  ";
    exit;
}

/*
"INSERT INTO caja_movil(
    
    movil,
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

exit;


header("Location:inicio_cobros.php");
*/
?>
</body>


</html>