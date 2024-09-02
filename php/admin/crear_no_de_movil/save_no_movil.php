<?php



session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");


$movil = $_POST['id'];

// id_titu es el numero de movil

$x_semana = 150;
$x_viaje = 150;
$tropa = 50;


$sql_movil = "INSERT INTO completa (movil, x_semana, x_viaje, tropa) VALUES (?,?,?,?)";
$stmt_movil = $con->prepare($sql_movil);
$stmt_movil->bind_param("iiii", $movil, $x_semana, $x_viaje, $tropa);

$sql_semana = "INSERT INTO semanas (movil) VALUES (?)";
$stmt_semana = $con->prepare($sql_semana);
$stmt_semana->bind_param("i", $movil);




//exit();

$stmt_movil->execute();
if ($stmt_semana->execute()) {

?>

    <script>
        alert("NUEVO MOVIL CREADO CON EXITO")
        window.location = "list_no_movil.php";
    </script>
<?php

} else {
?>
    <script>
        alert("MOVIL DUPLICADO")
        window.location = "list_no_movil.php";
    </script>
<?php
}

?>