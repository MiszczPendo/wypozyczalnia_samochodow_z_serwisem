<?php
require('fpdf/fpdf.php');
include("polaczenie_z_baza_danych.php");

$id_serwis = $_GET['id_serwis'];

$sql = "SELECT serwisy.*, marki.Marka_nazwa, modele.Model_nazwa, modele.Model_rocznik, modele.Model_pojemnosc_silnika, auta.auto_vin, usterki.Nazwa_Usterki, usterki.Koszt_usterki 
        FROM serwisy 
        INNER JOIN auta ON serwisy.id_auta = auta.id_auta 
        INNER JOIN modele ON auta.id_model = modele.id_model 
        INNER JOIN marki ON modele.id_marka = marki.id_marka 
        INNER JOIN usterki ON serwisy.id_usterki = usterki.id_usterki 
        WHERE serwisy.id_serwis = $id_serwis";
$result = $conn->query($sql);
$data = $result->fetch_assoc();

if ($data) {
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(0, 10, 'Raport naprawy samochodu', 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'ID Naprawy: ' . $data['id_serwis'], 0, 1);
    $pdf->Cell(0, 10, 'Termin oddania do naprawy: ' . $data['termin_oddania_do_naprawy'], 0, 1);
    $pdf->Cell(0, 10, 'Termin odbioru z naprawy: ' . $data['termin_odbioru_z_naprawy'], 0, 1);
    $pdf->Cell(0, 10, 'Marka: ' . $data['Marka_nazwa'], 0, 1);
    $pdf->Cell(0, 10, 'Model: ' . $data['Model_nazwa'], 0, 1);
    $pdf->Cell(0, 10, 'Rocznik: ' . $data['Model_rocznik'], 0, 1);
    $pdf->Cell(0, 10, 'Pojemnosc silnika: ' . $data['Model_pojemnosc_silnika'], 0, 1);
    $pdf->Cell(0, 10, 'Numer VIN: ' . $data['auto_vin'], 0, 1);
    $pdf->Cell(0, 10, 'Usterka: ' . utf8_decode($data['Nazwa_Usterki']), 0, 1);
    $pdf->Cell(0, 10, 'Koszt naprawy: ' . $data['Koszt_usterki'] . ' zl', 0, 1);

    $pdf->Output();
} else {
    echo "Nie znaleziono danych do raportu.";
}
?>
