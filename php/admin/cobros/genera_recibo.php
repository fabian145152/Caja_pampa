<?php
session_start();
include_once "../../../funciones/funciones.php";
$con = conexion();
$con->set_charset("utf8mb4");

// Incluir el archivo FPDF
require('../../../fpdf/fpdf.php');

// Crear una instancia de FPDF
$pdf = new FPDF();
$pdf->AddPage(); // Añadir una página

// Establecer el tipo de letra
$pdf->SetFont('Arial', 'B', 16);

// Añadir un texto (celda de texto)
$pdf->Cell(40, 10, '¡Hola, Mundo en PDF!');

// Generar el PDF y mostrarlo en el navegador
$pdf->Output();
