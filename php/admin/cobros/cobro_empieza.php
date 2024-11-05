<?php
session_start();
echo "BIENVENIDO: "  . $_SESSION['uname'] . '<br>';
echo "Hora de conección :" . $_SESSION['time'] . '<br>';

include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$mov = $_POST['movil'];

echo $mov;
echo "<br>";
echo $movil = "A" . $mov;
echo "<br>";


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


echo "Cantidad de Voucher:  " . $hay_voucher;
echo "<br>";
echo "Productos vendidos:  " . $hay_ventas;
echo "<br>";
echo "Tiene deuda anterior: " . $deuda_ant;
echo "<br>";


echo "ACA ESTOY RESOLVIENDO LAS INSTANCIAS";
echo "<br>";
echo "PROBAR CON VOUCHER";
echo "<br>";
echo "SIN VOUCHER";
echo "<br>";
echo "pasea carteles";
echo "<br>";

## aca se hacen las 3 instancias de cobro
## --------------------------------------

if ($hay_voucher > 0) {
    echo "<br>";
    echo "<br>";
    echo "INSTANCIA 1...";
    echo "<br>";
    echo "<br>";
    echo "Tiene Voucher...";
    echo "<br>";
    $_SESSION['variable'] = $movil;
    include_once "cobro_con_voucher.php";
} elseif ($deuda_ant > 0) {
    echo "<br>";
    echo "<br>";
    echo "INSTANCIA 2...";
    echo "<br>";
    echo "<br>";
    echo "Tiene deuda anterior: ";
    echo "<br>";
    $_SESSION['variable'] = $movil;
    include_once "cobro_sin_voucher.php";
} elseif ($hay_ventas > 0) {
    echo "<br>";
    echo "<br>";
    echo "INSTANCIA 3...";
    echo "<br>";
    echo "<br>";
    echo "Tiene Solo semana y venta: ";
    echo "<br>";
    $_SESSION['variable'] = $movil;
    include_once "cobro_con_ventas.php";
} else {
    echo "<br>";
    echo "<br>";

    echo "INSTANCIA 4...";
    echo "<br>";
    echo "Tiene Solo semana: ";
    echo "<br>";
    $_SESSION['variable'] = $movil;
    include_once "cobro_solo_semanas.php";
}
## --------------- FIN ------------------
## --------------------------------------

header("Location:inicio_cobros.php");
