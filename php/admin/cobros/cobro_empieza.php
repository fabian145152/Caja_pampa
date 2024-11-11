<?php
session_start();
$_SESSION['uname'];
$_SESSION['time'];

include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$mov = $_POST['movil'];

$mov;

$movil = "A" . $mov;



## Cosulta por si no existe el movil

$sql_existe = "SELECT * FROM completa WHERE movil = " . $mov;
$stmt = $con->prepare($sql_existe);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
} else {
    echo "El registro no existe.";
    header("Location: inicio_cobros.php");
}

## ----------------------------------------------------------

// 3. Preparar la consulta SQL
$sql_voucher_validado = "SELECT COUNT(*) AS total FROM voucher_validado WHERE movil = ?";

// 4. Usar consultas preparadas para evitar inyecciones SQL
$stmt = $con->prepare($sql_voucher_validado);
$stmt->bind_param("s", $movil);

// 5. Ejecutar la consulta
$stmt->execute();

// 6. Obtener el resultado
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$hay_voucher = $row['total'];



$sql_tiene_ventas = "SELECT * FROM completa WHERE movil = " . $mov;
$resu = $con->query($sql_tiene_ventas);
$linea = $resu->fetch_assoc();
$hay_ventas = $linea['venta_1'];
$deuda_ant = $linea['deuda_anterior'];

$sql_sem = "SELECT * FROM semanas WHERE movil = " . $mov;
$sql_res = $con->query($sql_sem);
$tiene_semanas = $sql_res->fetch_assoc();
$debe_semanas = $tiene_semanas['total'];


/*
echo "Cantidad de Voucher:  " . $hay_voucher;
echo "<br>";
echo "Productos vendidos:  " . $hay_ventas;
echo "<br>";
echo "Tiene deuda anterior: " . $deuda_ant;
echo "<br>";
*/

## aca se hacen las 3 instancias de cobro
## --------------------------------------

##  INSTANCIA 1
##  COBRA CON VOUCHER - DEUDA ANTERIOR - SEMANAS ANTERIORES - PRODUCTOS VENDIDOS 




if ($hay_voucher > 0) {

    echo "INSTANCIA 1...";
    echo "<br>";
    echo "COBRA CON VOUCHER...";
    echo "<br>";
    echo "COBRA CON DEUDA ANTERIOR...";
    echo "<br>";
    echo "COBRA CON SEMANAS...";
    echo "<br>";
    echo "COBRA CON VENTAS...";
    echo "<br>";
    //exit;
    $_SESSION['variable'] = $movil;
    include_once "cobro_con_voucher.php";

    ##  INSTANCIA 2
    ##  COBRA SIN VOUCHER - DEUDA ANTERIOR - SEMANAS ANTERIORES - PRODUCTOS VENDIDOS 


} elseif ($deuda_ant > 0) {
    echo "INSTANCIA 2...";
    echo "<br>";
    echo "COBRA sin VOUCHER...";
    echo "<br>";
    echo "COBRA CON DEUDA ANTERIOR...";
    echo "<br>";
    echo "COBRA CON SEMANAS...";
    echo "<br>";
    echo "COBRA CON VENTAS...";
    echo "<br>";
    //exit;
    $_SESSION['variable'] = $movil;

    $sql_tiene_voucher = "SELECT * FROM voucher_validados WHERE movil=" . $movil;
    $sql_tiene = $con->query($sql_tiene_voucher);
    if ($sql_tiene->num_rows > 1) {
        echo "Tiene Voucher... ";
        exit;
    } else {
        echo "No tiene... ";
        include_once "cobro_con_deuda.php";
    }

    ## aca hay que hacer una consulta para saber si hay voucher validado

    ##  INSTANCIA 3
    ##  COBRA SEMANAS ANTERIORES - PRODUCTOS VENDIDOS 


} elseif ($hay_ventas > 0 || $debe_semanas > 0) {
    echo "INSTANCIA 3...";
    echo "<br>";
    echo "COBRA CON SEMANAS...";
    echo "<br>";
    echo "COBRA CON VENTAS...";
    echo "<br>";
    //exit;
    $_SESSION['variable'] = $movil;
    include_once "cobro_con_ventas.php";
}

## --------------- FIN ------------------
## --------------------------------------

header("Location:inicio_cobros.php");
