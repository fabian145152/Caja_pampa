<?php

include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
echo "<br>";
echo $mov;
echo "<br>";
echo "AAAAAAAAAAA";

## CONSULTA PARA LA DEUDA ANTERIOR DE LA TABLA COMPETA
$sql_completa = "SELECT * FROM completa WHERE movil=" . $mov;
$res_completa = $con->query($sql_completa);
$row_completa = $res_completa->fetch_assoc();
$deuda_anterior = $row_completa['deuda_anterior'];
echo $deuda_anterior;
echo "<br>";


//$sql_completa = "SELECT * FROM completa WHERE movil = $mov";
