<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");
$mov = $_POST['movil'];

echo $movil = "A" . $mov;
echo "<br>";



// 3. Preparar la consulta SQL
$sql = "SELECT COUNT(*) AS total FROM voucher_validado WHERE movil = ?";

// 4. Usar consultas preparadas para evitar inyecciones SQL
$stmt = $con->prepare($sql);
$stmt->bind_param("s", $movil);

// 5. Ejecutar la consulta
$stmt->execute();

// 6. Obtener el resultado
$result = $stmt->get_result();
$row = $result->fetch_assoc();
echo $hay_voucher = $row['total'];
// 7. Mostrar el conteo
echo "Total de registros que coinciden: " . $hay_voucher;

if ($hay_voucher <= 0) {
    echo "<br>";
    echo "No tiene voucher...";
    exit;
} else {
    echo "Tiene";
    // Definir la variable en la sesión
    $_SESSION['variable'] = $movil;

    // Redireccionar
    header("Location: cobro_con_voucher.php");
    exit();
}
