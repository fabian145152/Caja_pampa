<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$deposito_en_pesos = 0;

$movil = $_POST['movil'];

// CONSULTAS


// Lee la deuda anterior de la tabla completa
$sql_comple = "SELECT * FROM completa WHERE movil=" . $movil;
$con_co = $con->query($sql_comple);
$row_comp = $con_co->fetch_assoc();

$sql_caja_mov = "SELECT * FROM caja_movil WHERE movil =" . $movil;
$con_caja_m = $con->query($sql_caja_mov);
$row_caja_movil = $con_caja_m->fetch_assoc();

$sql_semana = "SELECT * FROM semanas WHERE movil =" . $movil;
$con_sem = $con->query($sql_semana);
$row_semanas = $con_sem->fetch_assoc();

$deuda_anterior = $row_comp['deuda_anterior'];

$deuda_ant = $_POST['deuda_ant'];

if (!isset($_POST['dep_ft']) === FALSE) {
    $deposito_en_pesos = $_POST['dep_ft'];
}





$total_de_viajes = $_POST['viajes'];
$tot_voucher = $_POST['tot_voucher'];
$para_el_movil = $_POST['para_movil'];
$comisiones = $_POST['comi'];
$productos_vendidos = $_POST['prod'];
$debe_sem_ant = $_POST['debe_ant'];



$total_de_viajes = intval($total_de_viajes);
$tot_voucher = intval($tot_voucher);
$para_el_movil = intval($para_el_movil);
$comisiones = intval($comisiones);
$productos_vendidos = intval($productos_vendidos);
$deuda_ant = intval($deuda_ant);
$deposito_en_pesos = intval($deposito_en_pesos);

$deu_total = $deuda_ant + $comisiones + $productos_vendidos + $debe_sem_ant;

echo "<br>";
echo "Movil:" . $movil;
echo "<br>";
echo $fecha = date('Y-m-d H:i:s');
echo "<br>";
echo "Comision a cobrarle: " . $comisiones;
echo "<br>";
echo "Deuda_anterior: " . $deuda_anterior;
echo "<br>";
echo "Debe de semanas anteriores: " . $debe_sem_ant;
echo "<br>";
echo "Productos que compro:" . $productos_vendidos;
echo "<br>";
echo "Calculo de deuda: " . $deu_total;
echo "<br>";
echo "Total en voucher: " . $tot_voucher;
echo "<br>";
echo "Deposito en pesos: " . $deposito_en_pesos;
echo "<br>";
echo "Depositarle al movil: " . $depositarle = $tot_voucher - $deu_total;
echo "<br>";
echo "Voucher en caja: " . $voucher_en_caja = $tot_voucher - $depositarle;
echo "<br>";
echo "Fe en caja: " . $deposito_en_pesos;
echo "<br>";
echo "<br>";




echo $row_caja_movil['comisiones'];
echo "<br>";

$stmt_caja_movil = $con->prepare("INSERT INTO caja_movil 
                                        (movil,    
                                        comisiones, 
                                        deuda_anterior,
                                        debe_sem_ant,
                                        prod_vendidos,
                                        calculo_deuda,
                                        deposito_voucher,
                                        dep_ft,
                                        para_el_movil,
                                        voucher_en_caja,
                                        ft_en_caja,
                                        fecha
                                        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

if ($stmt_caja_movil === false) {
    die('Error al preparar la consulta: ' . $con->error);
}

$stmt_caja_movil->bind_param(
    "iiiiiiiiiiis",
    $movil,
    $comisiones,
    $deuda_anterior,
    $debe_sem_ant,
    $productos_vendidos,
    $deu_total,
    $tot_voucher,
    $deposito_en_pesos,
    $depositarle,
    $voucher_en_caja,
    $deposito_en_pesos,
    $fecha
);

if ($stmt_caja_movil->execute()) {
    echo "Nuevo registro creado exitosamente";
    echo "<br>";
} else {
    echo "Error al ejecutar la consulta: " . $stmt->error;
    exit;
}

//Borra deuda anterior
$sql_borra_deuda_ant = "UPDATE `completa` SET `deuda_anterior` = 0 WHERE movil =" . $movil;

if ($con->query($sql_borra_deuda_ant) === TRUE) {
    echo "Deuda anterior editada correctamente";
    echo "<br>";
} else {
    echo "Error deuda anterior...";
    exit();
}

echo $row_semanas['total'];
echo "<br>";
if ($row_semanas['total'] > 0) {
    $sql_sem = "UPDATE 'semanas' SET 'total' = 0 WHERE movil =" . $movil;
    if ($con->query($sql_sem) === TRUE) {
        echo "Deuda de semanas anteriores borrada";
        echo "<br>";
    } else {
        echo "Error semanas...";
        
        ?>
<h1>Ver el error que hay borrando la deuda de las semanas</h1>
<?php

exit();
}
}

$row_semanas['total'];

//$sql_sem "UPDATE 'semanas' SET 'total' = "


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