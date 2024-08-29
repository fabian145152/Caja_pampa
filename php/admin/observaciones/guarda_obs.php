<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

echo $movil = $_POST['nombre'];
echo "<br>";
echo $observaciones = $_POST['comentarios'];

$sql_obs = "UPDATE completa SET obs= '$observaciones' WHERE movil=" . $movil;
$con->query($sql_obs);

header('Location:../../menu.php');
