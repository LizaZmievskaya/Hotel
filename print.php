<?php
require('fpdf181/fpdf.php');
$db = new PDO('mysql:host=localhost; dbname=hotels', 'root', '');
$db->exec("SET CHARACTER SET cp1251_koi8");

$stmt = $db->prepare("SELECT registration.passport, client.familia, sotrudnik.s_familia
FROM `sotrudnik` INNER JOIN (`client` INNER JOIN `registration` ON client.passport=registration.passport)
ON sotrudnik.sotrudnik_id=registration.sotrudnik_id");
$stmt->execute();
$rows = $stmt->fetchAll();

$stmt1 = $db->prepare("SELECT * FROM `titles`");
$stmt1->execute();
$title = $stmt1->fetchAll();

$pdf = new FPDF();
$pdf->AddFont('ArialMT','B','arial.php');
$pdf->AddPage();
$pdf->SetFont('ArialMT','B',14);
$pdf->Cell(60,10,$title[0]['title'],'','','C');
$pdf->Ln();
$pdf->SetFont('ArialMT','B',11);
$pdf->SetFillColor(225, 225, 208);
$pdf->Cell(60,10,$title[0]['passport'],1,0,'',1);
$pdf->Cell(60,10,$title[0]['client'],1,0,'',1);
$pdf->Cell(60,10,$title[0]['sotrudnik'],1,0,'',1);

for ($i = 0; $i < count($rows); $i++){
    $pdf->SetFont('ArialMT','B',10);
    $pdf->Ln();
    $pdf->Cell(60,10,$rows[$i]['passport'],1);
    $pdf->Cell(60,10,$rows[$i]['s_familia'],1);
    $pdf->Cell(60,10,$rows[$i]['familia'],1);
}
$pdf->Output();
