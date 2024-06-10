<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo $id = $_POST['id'];
echo "<br>";
echo $abono = $_POST['abono'];
echo "<br>";
echo $importe = $_POST['importe'];
echo "<br>";


$sql = "UPDATE `abonos` SET `abono` = '$abono', `importe` = '$importe'
WHERE id=" . $id;

$con->query($sql);

header('Location:inicio_abonos_semanales.php');
