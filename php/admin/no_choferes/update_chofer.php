<?php
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("uth8mb4");


echo $nombre = $_POST['nombre'];
echo $apellido = $_POST['apellido'];
echo $direccion = $_POST['direccion'];
echo $dni = $_POST['dni'];
echo $cel = $_POST['cel'];


$id = $_POST['id'];

$sql = "UPDATE completa SET nombre_chof_1 = '$nombre', 
                                apellido_chof_1 = '$apellido', 
                                direccion_chof_1 = '$direccion', 
                                dni_chof_1 ='$dni',
                                cel_chof_1 = '$cel'
                                WHERE id =" . $id;

$con->query($sql);
header('Location:list_chofer.php');
