<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

$id_del = $_GET['q'];


$sql = "DELETE FROM completa WHERE id=" . $id_del;
$result = $con->query($sql);


header("Location:list_uni_comp.php");
