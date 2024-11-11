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
$pdf->MultiCell(0, 10, "Duuda al: $dia");
$pdf->MultiCell(0, 10, "Abono semanal: $sem");
$pdf->MultiCell(0, 10, "Total depositado en voucher:  $voucher");
$pdf->MultiCell(0, 10, "10% de comision: $comision");

if ($otal_ventas > 0) {
    $pdf->MultiCell(0, 10, "Ventas: $ventas");
}


$pdf->MultiCell(0, 10, 'Este es un archivo generado autmoaticamente con los datos de su pago.');
//Nombre del archivo a guardar

echo "Movil" . $movil;
echo "<br>";
echo "Fecha y hora" . $fecha;
echo "<br>";
$nombre = $movil . "_" . $fecha;
echo "<br>";
echo "<br>";
echo "<br>";

//exit;
// Definir la ruta donde guardar el PDF
$nombreArchivo = $movil . '_' . date("d-m-Y") . '.pdf';
//echo $nombreArchivo = $nombre . '.pdf';
$directorioDestino = ''; // Ajusta la ruta de la carpeta destino
$pathArchivo = $directorioDestino . $nombreArchivo;

// Guardar el archivo PDF en la carpeta especificada
$pdf->Output('F', $pathArchivo);


echo "PDF generado y guardado en: " . $pathArchivo;
