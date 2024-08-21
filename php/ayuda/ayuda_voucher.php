<?php
session_start();
include_once "../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AYUDA CREAR UNIDAD</title>
    <?php head() ?>
</head>

<body>
    <h1>PROCESO DE CARGA DE VOUCHER</h1>


    <button onclick="cerrarPagina()">CERRAR PAGINA</button>

    <script>
        function cerrarPagina() {
            window.close();
        }
    </script>
</body>


</html>