<!DOCTYPE html>
<html lang="es">

<?php

require "../../../funciones/fpdf/fpdf.php";
$width = 200;
$height = 150;



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


if ($total_a_depositar > 0) {
    $pdf->MultiCell(0, 10, "Total a depositar: $total_a_depositar");
} else {
    $pdf->MultiCell(0, 10, "Debe abonar: ");
}


//$pdf->MultiCell(0, 10, 'Este es un archivo generado automaticamente con los datos de su pago.');
//Nombre del archivo a guardar

echo "Movil" . $movil;
echo "<br>";
echo "Fecha y hora" . $fecha;
echo "<br>";
$nombre = $movil . "_" . $fecha;
echo "<br>";
echo "<br>";
echo "<br>";
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
