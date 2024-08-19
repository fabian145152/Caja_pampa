<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$movil = $_POST['movil'];
$semana_movil = $_POST['semana_movil'];

echo "Movil: " . $movil;
echo "<br>";
echo "Semana Movil: " . $semana_movil;
echo "<br>";
$id_movil = $_POST['id'];
echo "<br>";

#estas 2 lineas editan el movil y ya estan bien
$sql_movil = "UPDATE completa SET movil = '$movil' WHERE id =" . $id_movil;
$con->query($sql_movil);


$sql_semana = "SELECT * FROM semanas WHERE movil=" . $semana_movil;

$result_semana = $con->query($sql_semana);
$row_semana = $result_semana->fetch_assoc();

echo "ID del movil viejo: " . $id_movil_viejo = $row_semana['id'];
echo "<br>";
echo  $row_semana['movil'];

//exit();

$sql_semana = "UPDATE semanas SET movil = '$movil' WHERE id =" . $id_movil_viejo;
$con->query($sql_semana);



header('Location:list_no_movil.php');
