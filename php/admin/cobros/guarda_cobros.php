<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


$pesos = 0;
$pago_semanal = 0;


echo "Movil: " . $movil = $_POST['movil'];
echo "<br>";
echo "Total de viajes: " . $viajes = $_POST['viajes'];
echo "<br>";
echo "Debe de semanas anteriores: " . $debe_sem_ant = $_POST['debe_ant'];
echo "<br>";
echo "Deuda anterior: " . $deuda_ant = $_POST['deuda_ant'];
echo "<br>";
echo "Deposito x deuda anterior: " . $pesos = $_POST['paga_deuda'];
echo "<br>";
echo "Productos comprados: " . $prod = $_POST['prod'];
echo "<br>";
echo "Para el movil:" . $apagar = $_POST['para_movil'];
echo "<br>";
echo "Comisiones: " . $comision = $_POST['gastos'];
echo "<br>";
echo "Deposito para pagar la semana: " .  $pago_semanal = $_POST['pesos'];
echo "<br>";
echo "<br>";
echo "Total a cobrarle: " . $total_a_cobrar = $viajes + $debe_sem_ant + $deuda_ant + $prod + $comision;
echo "<br>";
echo "<br>";
echo "Total que deposito: " . $total_depositado = (int)$pesos + (int)$pago_semanal;
echo "<br>";
echo "<br>";
echo "Saldo: " . $cuenta = $total_a_cobrar - $total_depositado;
echo "<br>";
echo $fecha = date("Y-m-d");
echo "<br>";
echo $dep_pesos = (int)$deuda_ant - (int)$pesos;
echo "<br>";
echo "<br>";
echo "<br>";

$sql_comp = "SELECT * FROM completa WHERE movil=" . $movil;
$exe_sql_comp = $con->query($sql_comp);
$row_sql_comp = $exe_sql_comp->fetch_assoc();

$venta_1 = $row_sql_comp['venta_1'];
$venta_2 = $row_sql_comp['venta_2'];
$venta_3 = $row_sql_comp['venta_3'];
$venta_4 = $row_sql_comp['venta_4'];
$venta_5 = $row_sql_comp['venta_5'];


if ($venta_1 != 0) {
    $sql_venta_1 = "SELECT * FROM productos WHERE id = $venta_1";
    $res_venta_1 = $con->query($sql_venta_1);
    $row_venta_1 = $res_venta_1->fetch_assoc();
    echo $row_venta_1['precio'];
}
echo "<br>";
if ($venta_2 != 0) {
    $sql_venta_2 = "SELECT * FROM productos WHERE id = $venta_2";
    $res_venta_2 = $con->query($sql_venta_2);
    $row_venta_2 = $res_venta_2->fetch_assoc();
    echo $row_venta_2['precio'];
}
echo "<br>";
if ($venta_3 != 0) {
    $sql_venta_3 = "SELECT * FROM productos WHERE id = $venta_3";
    $res_venta_3 = $con->query($sql_venta_3);
    $row_venta_3 = $res_venta_3->fetch_assoc();
    echo $row_venta_3['precio'];
}
echo "<br>";
if ($venta_4 != 0) {
    $sql_venta_4 = "SELECT * FROM productos WHERE id = $venta_4";
    $res_venta_4 = $con->query($sql_venta_4);
    $row_venta_4= $res_venta_4->fetch_assoc();
    echo $row_venta_4['precio'];
}
echo "<br>";
if ($venta_5 != 0) {
    $sql_venta_5 = "SELECT * FROM productos WHERE id = $venta_5";
    $res_venta_5 = $con->query($sql_venta_5);
    $row_venta_5 = $res_venta_5->fetch_assoc();
    echo $row_venta_5['precio'];
}

if ($pesos != 0) {
    // Actualiza la deuda anterior carga la fecha de pago y el monto
    $sql_deuda_ant = "UPDATE completa SET pago_ant= '$pesos', fe_pago= '$fecha',deuda_anterior= '$dep_pesos' WHERE movil=" . $movil;
    $con->query($sql_deuda_ant);

    if ($con->query($sql_deuda_ant) === TRUE) {
        echo "Registro actualizado con exito";
    } else {
        echo "Error con actualizacion de registro: " . $con->errno;
        exit();
    }
}

// FIN Actualiza la deuda anterior  garca la fecha de pago y el monto 
exit();


echo "<br>";
echo "<br>";

//exit();

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