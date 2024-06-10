<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


echo "Identificador de completa: " . $id = $_POST['id'];
echo "<br>";
echo "movil nuevo: " . $movil = $_POST['movil'];
echo "<br>";
echo "Tropa: " . $tropa = $_POST['tropa'];
echo "<br>";

$sql_completa = "SELECT * FROM completa WHERE id=" . $id;
$res_1 = $con->query($sql_completa);
$row_completa = $res_1->fetch_assoc();

echo "<br>";
echo "Movil anterior: " . $mov_ant = $row_completa['movil'];

$sql_semana = "SELECT * FROM semanas WHERE movil=" . $mov_ant;
$res_2 = $con->query($sql_semana);
$row_semana = $res_2->fetch_assoc();


echo "<br>";
echo "<br>";
echo "<br>";

echo "<br>";
echo "<br>";
echo $row_completa['nombre_titu'];
echo "<br>";
echo "<br>";
echo $row_semana['x_semana'];
echo "<br>";

//exit();

$upd_comp = "UPDATE completa SET movil = '$movil', tropa = '$tropa' WHERE id =" . $id;
$res_completa = $con->query($upd_comp);
//$stmt_comp = $res_completa->fetch_assoc();


$upd_sem = "UPDATE semanas SET movil = '$movil' WHERE movil =" . $mov_ant;
$res_comp = $con->query($upd_sem);
//$stmt = $res_comp->fetch_assoc();

header("Location: lista_tropas.php");
