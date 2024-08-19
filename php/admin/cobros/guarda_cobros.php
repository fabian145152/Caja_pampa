<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$dep_efect = 0;



?>
<h1>Falta guardar pago en efectivo y terminar de revisar los calculos</h1>
<h2></h2>
<?php

echo "Movil: " . $movil = $_POST['movil'];
echo "<br>";
if (!isset($pesos)) {
    echo "Deposito: " . $pesos = $_POST['pesos'];
}
echo "<br>";
echo "Debe de semanas anteriores: " . $debe_ant = $_POST['debe_ant'];
echo "<br>";
echo "Deuda anterior: " . $deuda_ant = $_POST['deuda_ant'];
echo "<br>";
echo "<br>";
echo "<br>";

echo $deuda_total = 



exit();

echo "<br>";
$cant_viajes = $_POST['cant_viajes'];
$paga_x_viaje = $_POST['paga_x_viaje'];
echo "<br>";
echo "Abono semanal: " . $abono_semanal = $_POST['abono_semanal'];
echo "<br>";
echo "Paga por los viajes: " . $paga_de_viajes = $cant_viajes * $paga_x_viaje;
echo "<br>";
echo "<br>";
echo "Productos comprados: " . $prod = $_POST['prod'];
echo "<br>";
echo "<br>";
echo "Suma= " . $suma = $abono_semanal + $paga_de_viajes + $debe_ant + $prod + $deuda_ant;
echo "<br>";
echo "Total de los voucher: " . $tot_voucher = $_POST['tot_voucher'];
echo "<br>";
echo "10% para base: " . $comision_base = $tot_voucher * .1;
echo "<br>";
echo "90% para movil " . $para_mov = $tot_voucher * .9;
echo "<br>";
echo $fecha = date("Y-m-d");
echo "<br>";

echo "<br>";
echo "<br>";

$sql_caja_movil = "INSERT INTO caja_movil(
                                    movil, 
                                    deuda_ant, 
                                    debe_de_viajes, 
                                    venta_de_productos, 
                                    semanas_ant,                                     
                                    diez, 
                                    noventa, 
                                    dep_efectivo, 
                                    dep_fecha) 
                                            VALUES (?,?,?,?,?,?,?,?,?)";

$stmt = $con->prepare($sql_caja_movil);
$stmt->bind_param(
    "iiiiiiiis",
    $movil,
    $deuda_ant,
    $paga_de_viajes,
    $prod,
    $debe_ant,
    $comision_base,
    $para_mov,
    $dep_efect,
    $fecha
);


//--------------------------------------------------------------
//   ## Si no la comento me guarda un rego cada vez que refresco
//--------------------------------------------------------------

if ($stmt->execute()) {
    echo "Datos guardados correctamente.";
    echo "<br>";
} else {
    echo "ERROR: No se pudo ejecutar la consulta sql_dep_caja_movil. " . $con->error;
    echo "<br>";
}



$sql_lee_caja_movil = "SELECT * from caja_movil WHERE movil = '$movil' ORDER BY id DESC LIMIT 1 ";

$sql_caja_mov = $con->query($sql_lee_caja_movil);
$row_lee = $sql_caja_mov->fetch_assoc();

echo "<br>";
echo "Estos datos son leidos desde el anteultimo registro de la tabla caja_movil";
echo "<br>";
echo "<br>";
echo "Saldo Movil: " . $row_lee['saldo_movil'];
echo "<br>";
echo "Semanas anteriores: " . $a_sem_ant = $row_lee['semanas_ant'];
echo "<br>";
echo "Debe de viajes: " . $a_viajes = $row_lee['debe_de_viajes'];
echo "<br>";
echo "Comision: " . $a_diez = $row_lee['diez'];
echo "<br>";
echo "Venta productos: " . $a_venta = $row_lee['venta_de_productos'];
echo "<br>";
echo "Total de cobros al movil " . $total = $a_sem_ant + $a_viajes + $a_diez;
echo "<br>";
echo "Depositarle al movil: " . $deuda_movil = $comision_base + $para_mov - $total;
echo "<br>";
echo "<br>";
echo "<br>";

echo "Saldo Movil: " . $saldo_movil = $deuda_movil + $pesos;
echo "<br>";

//exit();

$sql_saldo_movil = "INSERT INTO caja_movil (movil, dep_efectivo, deuda_ant, saldo_movil, dep_fecha) VALUES(?,?,?,?,?)";
$stmt_2 = $con->prepare($sql_saldo_movil);
$stmt_2->bind_param("siiid", $movil, $pesos, $deuda_movil, $saldo_movil, $fecha);


if ($stmt_2->execute()) {
    echo "Datos guardados correctamente.";
    echo "<br>";
} else {
    echo "ERROR: No se pudo ejecutar la consulta sql_dep_caja_movil. " . $con->error;
    echo "<br>";
}


echo "Saldo movil: " . $saldo_movil;
echo "<br>";
echo "Movil: " . $movil;
echo "<br>";

$ult_leida = "SELECT * FROM caja_movil WHERE movil = $movil ORDER BY id DESC";
$ult_caja = $con->query($ult_leida);
$row_ult = $ult_caja->fetch_assoc();

echo $row_ult['id'];
echo "<br>";
echo $row_ult['movil'];
echo "<br>";
echo $row_ult['saldo_movil'];
echo "<br>";

## borrar voucher validados por ahi voy

echo $mo = "A00" . $movil;
echo "<br>";
echo $mo;
echo "<br>";

// Consulta para vaciar la tabla


$borra_voucher_validados = "DELETE FROM `voucher_validado` WHERE movil= '$mo'";



if ($con->query($borra_voucher_validados) === TRUE) {
    echo "La tabla ha sido vaciada correctamente.";
} else {
    echo "Error al vaciar la tabla: " . $con->error;
}

//header("Location: inicio_cobros.php");
?>


<a href="inicio_cobros.php">Volver</a>