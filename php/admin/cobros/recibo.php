<!DOCTYPE html>
<html lang="es">

<?php

require "../../../funciones/fpdf/fpdf.php";
$width = 200;
$height = 150;

$user = $_SESSION['uname'];

$dia = date("d-m-Y");
$voucher = "$" . $tot_voucher . "-";
$ventas = "$" . $otal_ventas . "-";
$comision = "$" . $comisiones . "-";
$sem = "$" . $semanas . "-";
$deuda = "$" . $deuda_ant . "-";
$paga_viaje = "$" . $paga_x_viaje . "-";
$tot_via = $can_viajes * $paga_x_viaje;
$total_de_viajes = "$" . $can_viajes * $paga_x_viaje . "-";
$comi = "$" . $tot_voucher * .1 . "-";
$noventa = $tot_voucher * .9;
$total_a_depositar = $noventa - $semanas - $tot_via - $deuda_ant - $otal_ventas;
//$total_depositado = $dep_ft + $dep_mercado;


// Crear una instancia de la clase FPDF
$pdf = new FPDF();
//$pdf = new FPDF('P', 'mm', 'A2');
// Crear una nueva instancia de FPDF con tamaño personalizado
$pdf = new FPDF('L', 'mm', array($width, $height));
// Agregar una página al documento
$pdf->AddPage();
// Establecer el tipo de letra
$pdf->SetFont('Arial', 'B', 16);



// Agregar un título
$pdf->Cell(300, 10, 'Recibo No ', 0, 1, 'C');
$pdf->Cell(200, 10,  "Fecha y hora: $fecha", 0, 2, 'C');
$pdf->Cell(200, 10,  "Movil: $movil", 0, 2, 'C');


// Agregar más contenido (texto simple)
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, "Deuda al: $dia");
$pdf->MultiCell(0, 10, "Total depositado en voucher:  $noventa");

$pdf->MultiCell(0, 10, "Abono semanal: $sem");

if ($can_viajes > 0) {
    $pdf->MultiCell(0, 10, "Cantidad de viajes: $can_viajes    Paga x viaje: $paga_viaje   Total de viajes $total_de_viajes");
}
if ($deuda_ant > 0) {
    $pdf->MultiCell(0, 10, "Deuda anterior: $deuda");
}

if ($otal_ventas > 0) {
    $pdf->MultiCell(0, 10, "Ventas: $ventas");
}

if ($dep_mercado > 0) {
    $pdf->MultiCell(0, 10, "Deposito con MP: $dep_mercado");
}
if ($dep_ft > 0) {
    $pdf->MultiCell(0, 10, "Deposito en FT: $dep_ft");
}

$falta = $total_a_depositar + $dep_ft + $dep_mercado;
$fal = "$" . $falta . "-";
//$pdf->MultiCell(0, 10, "Faltan: $falta");


//$pdf->MultiCell(0, 10, "Falta:  $falta   Lo muestra siempre");

if ($falta < 0) {
    $pdf->MultiCell(0, 10, "Queda debiendo:  $fal ");
} elseif ($falta > 0) {
    $pdf->MultiCell(0, 10, "Saldo a favor:  $fal ");
} elseif ($falta == 0) {
    $pdf->MultiCell(0, 10, "Deuda cero... ");
}


$pdf->MultiCell(0, 10, "Operador: $user");


//$pdf->MultiCell(0, 10, 'Este es un archivo generado automaticamente con los datos de su pago.');
//Nombre del archivo a guardar

//echo "Movil" . $movil;
//echo "<br>";
//echo "Fecha y hora" . $fecha;
//echo "<br>";
$nombre = $movil . "_" . $fecha;
//echo "<br>";
//echo "<br>";
//echo "<br>";
$directorio = "recibos/";


//exit;
// Definir la ruta donde guardar el PDF
$nombreArchivo = $movil . '_' . date("d-m-Y") . '.pdf';
//echo $nombreArchivo = $nombre . '.pdf';
$directorioDestino = $directorio; // Ajusta la ruta de la carpeta destino
$pathArchivo = $directorioDestino . $nombreArchivo;

// Guardar el archivo PDF en la carpeta especificada
$pdf->Output('F', $pathArchivo);

echo "PDF generado y guardado en: " . $pathArchivo;
echo "<br>";






$sql_caja_final = "SELECT * FROM caja_final ORDER BY id DESC LIMIT 1";
$sql_caja = $con->query($sql_caja_final);
$sql_row = $sql_caja->fetch_assoc();


echo "Deposito en FT hoy: " . $dep_ft;
echo "<br>";
echo "Deposito de hoy en MP: " . $dep_mercado;
echo "<br>";
echo "Deposito anterior en FT: " . $deposito_ant_ft_ant = $sql_row['dep_ant_ft'];
echo "<br>";
echo "Deposito anterior en MP: " . $deposito_ant_mp_ant = $sql_row['dep_ant_mp'];

echo "<br>";

$ft_actual_ant = $sql_row['ft_actual'];
$extra_ft_ant = $sql_row['extra_ft'];
$deposito_ft_ant = $sql_row['deposito_ft'];
$dep_ant_mp_ant = $sql_row['dep_ant_mp'];
$mp_actual_ant = $sql_row['mp_actual'];
$extra_mp_ant = $sql_row['extra_mp'];
$deposito_mp_ant = $sql_row['deposito_mp'];
$fecha_mov_ant = $sql_row['fecha'];
$operador_ant = $sql_row['nombre'];
$obs_ant = $sql_row['observaciones'];

echo "aca";
echo "<br>";
echo "Saldo actual ft; " . $saldo_actual_ft = $deposito_ant_ft_ant + $dep_ft;
echo "<br>";
echo "Saldo actual mp:" . $saldo_actual_mp = $deposito_ant_mp_ant + $dep_mercado;
echo "<br>";


//exit;

// Verificar la conexión
if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
    exit;
}


$stmt = $con->prepare("INSERT INTO caja_final(
                                        
                                        dep_ft_hoy, 
                                        dep_ant_ft,

                                        ft_actual, 
                                        extra_ft, 
                                        deposito_ft, 
                                        
                                        dep_mp_hoy, 
                                        dep_ant_mp, 

                                        mp_actual,
                                        extra_mp,
                                        deposito_mp,
                                        fecha,
                                        nombre) 
VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param(
    "ddddddddddss",
    $dep_ft,
    $saldo_actual_ft,

    $ft_actual,
    $extra_ft,
    $extra_ft,

    $dep_mercado,
    $saldo_actual_mp,

    $mp_actual,
    $extra_mp,
    $deposito_mp,
    $fecha,
    $user
);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Registro creado exitosamente";
} else {
    echo "Error de creacion de registro: " . $stmt->error;
    exit;
}
