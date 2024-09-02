<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");




echo "Movil: " . $movil = $_POST['movil'];

echo "<h3>Deuda anterior: " . $deuda_ant = $_POST['deuda_ant'] . "</h3>";

if (!isset($_POST['dep_ft']) == FALSE) {
    echo "<h3>Deposito en FT: " . $deposito_en_pesos = $_POST['dep_ft'] . "</h3>";
}
echo "<h3>Total de Viajes: " . $total_de_viajes = $_POST['viajes'] . "</h3>";
echo "<h3>Total en Voucher: " . $tot_voucher = $_POST['tot_voucher'] . "</h3>";
echo "<h3>Para el movil: " . $para_el_movil = $_POST['para_movil'] . "</h3>";
echo "<h3>Comisiones: " . $comisiones = $_POST['comi'] . "</h3>";
echo "<h3>Productos vendidos: " . $productos_vendidos = $_POST['prod'] . "</h3>";
echo "<br>";
echo $fecha = date("d-m-Y");
echo "<br>";
echo "<strong>Ya tengo todos los datos: </strong>";


echo "<br>";
echo "<br>";

$sql_comp = "SELECT * FROM completa WHERE movil=" . $movil;
$exe_sql_comp = $con->query($sql_comp);
$row_sql_comp = $exe_sql_comp->fetch_assoc();

echo $deuda_ant = $row_sql_comp['deuda_anterior'];

echo "<br>";

if ($deposito_en_pesos <= $deuda_ant) {
    echo "Le alcanza para pagar!!!";
    echo "<br>";
    $actualiza_deuda = $deposito_en_pesos - $deuda_ant;
    echo $actualiza_deuda;
} else {
    echo "No le alcanza!!!";
}



exit();

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


//exit();

$sql_caja_movil = "INSERT INTO caja_movil(
                                    movil, 
                                    deuda_ant,
                                    paga_deuda_ant,
                                    debe_de_viajes, 
                                    venta_de_productos, 
                                    semanas_ant,                                     
                                    diez, 
                                    noventa, 
                                    dep_efectivo,                                 
                                    dep_fecha) 
                                            VALUES (?,?,?,?,?,?,?,?,?,?)";

$stmt = $con->prepare($sql_caja_movil);
$stmt->bind_param(
    "iiiiiiiiis",
    $movil,
    $deuda_ant,
    $pesos,
    $viajes,
    $prod,
    $debe_sem_ant,
    $comision,
    $apagar,
    $pago_semanal,
    $fecha
);


if ($stmt->execute()) {
    echo "Datos guardados correctamente.";
    echo "<br>";
} else {
    echo "ERROR: No se pudo ejecutar la consulta sql_dep_caja_movil. " . $con->error;
    echo "<br>";
}


//--------------------------------------------------------------
//   ## Si no la comento me guarda un rego cada vez que refresco
//--------------------------------------------------------------

//exit();

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





exit();

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