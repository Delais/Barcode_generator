<?php
include 'barcode.php';
require '.\fpfp\fpdf.php';
session_start();
$names = $_SESSION["dataProductsNames"];
$prices = $_SESSION["dataProductsPrices"];
$codes = $_SESSION["dataProductsCodes"];


$pdf = new FPDF('P', 'mm', 'letter', true);
$pdf->AddPage();
$pdf->SetAutoPageBreak(true, 20);
$y = 21;
$Ycell = $pdf->GetX();
$Xcell = $pdf->GetY();
$x = $pdf->GetX() + 5;
$pdf->SetFont('Arial', 'B', 10);
$i = 0;
foreach ($names as $key => $value) {
    $name = $value;
    $price = $prices[$key];
    $code = $codes[$key];


    barcode('codigos/' . $code . '.png', $code, 50, 'horizontal', 'code128', true);



    $pdf->SetFillColor(80, 150, 200);
    $pdf->SetXY($Xcell, $Ycell);
    $pdf->Cell(60, 10, $name, 1, 1, 'C'); //Celda
    $pdf->SetXY($Xcell, $Ycell + 10);
    $pdf->Cell(60, 21, $pdf->Image('codigos/' . $code . '.png', $Xcell + 5, $Ycell + 11, 50, 0, 'PNG'), 1, 1);
    $pdf->SetXY($Xcell, $Ycell + 31);
    $pdf->SetFillColor(51, 255, 199); 
    $pdf->Cell(60, 10, "$" . $price, 1, 0, 'C', true);
    $i = $i + 1;
    if ($i == 3) {
        $Xcell = -55;
        $Ycell = $Ycell + 50;
        $i = 0;
    }



    $y = $y + 20;
    $Xcell = $Xcell + 65;
    $x = $x + 15;
}

$pdf->SetY(1);
    // Arial italic 8
$pdf->SetFont('Arial','I',8);
    // Número de página
$pdf->Cell(0,10,'Page: 3  by: Delais Rafel Diaz Lopez - for: Inversiones Hemisferios Del Caribe S.A.S ',0,0,'C');


$pdf->Output('D','code.pdf');
