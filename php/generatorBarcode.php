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
$y = 12;
$x = 85;
$pdf->SetFont('Arial', 'B', 10);
$i = 0;
foreach ($names as $key => $value) {
    $name = $value;
    $price = $prices[$key];
    $code = $codes[$key];


    barcode('codigos/' . $code . '.png', $code, 70, 'horizontal', 'code128', true);

    if ($i < 3) {
        $pdf->Cell(50, 20, $name , 1, 0, 'C');
        $pdf->Cell(20, 20, "$".$price , 1, 0, 'C');
        $pdf->Cell(60, 20,$pdf->Image('codigos/' . $code . '.png', $x, $y, 50, 0, 'PNG'), 1, 1);

        $i = $i + 1;
    } else if ($i == 3) {
        $pdf->SetX(50);

        $pdf->Ln(20);
        $i = 0;
    }



    $y = $y + 20;
}



$pdf->Output('D','code.pdf'); 
