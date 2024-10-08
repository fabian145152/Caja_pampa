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

echo "Deuda anterior leido de la ddbb: " . $deuda_anterior;

## CONSULTA PARA LA DEUDA DE SEMANAS DE LA TABLA SEMANAS
$sql_semanas = "SELECT * FROM semanas WHERE movil=" . $movil;
$res_semanas = $con->query($sql_semanas);
$row_semanas = $res_semanas->fetch_assoc();
echo "<br>";
echo "Debe de semanas anteriores: " . $row_semanas['total'];



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


$sql_insert_caja_movil = "INSERT INTO caja_movil (movil) VALUES (?)";
$stmt_insert_caja_movil = $con->prepare($sql_insert_caja_movil);
$stmt_insert_caja_movil->bind_param("i", $movil);



if ($stmt_insert_caja_movil->execute() === TRUE) {
     
    echo "Registro creado con exito...";
}


$sql_caja_movil = "SELECT * FROM caja_movil WHERE movil=" . $movil;
$res_caja_movil = $con->query($sql_caja_movil);
$row_caja_movil = $res_caja_movil->fetch_assoc();
echo "<br>";
echo "Leido de la tabla caja_movil: " . $row_caja_movil['movil'];
