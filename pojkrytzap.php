<?php
include("polaczenie_z_baza_danych.php");

$poj_od = $_GET['poj_od'];
$poj_do = $_GET['poj_do'];

$pattern = '/^\d+\.\d+$/';

if (!preg_match($pattern, $poj_od) || !preg_match($pattern, $poj_do)) {
    echo "Pola nie są uzupełnione poprawnie. Podaj pojemność w formacie (liczba.liczba)<br>";
    exit();
}

$poj_od = (float)$poj_od;
$poj_do = (float)$poj_do;

if ($poj_od > $poj_do) {
    echo "Nieodpowiedni warunek.<br>";
    exit();
}

$query_base = "
    SELECT 
        Modele.Model_nazwa, 
        Marki.Marka_nazwa, 
        Auta.wypozyczenie_cena_na_dzien, 
        Modele.Model_pojemnosc_silnika,
        Modele.Model_rocznik,
        Modele.id_model
    FROM 
        Marki 
    INNER JOIN 
        Modele ON Marki.id_marka = Modele.id_marka 
    INNER JOIN 
        Auta ON Modele.id_model = Auta.id_model 
    WHERE 
        Auta.auto_stan = 'Dostępny'";

$query_conditions = [];

if ($poj_od >= 0 && $poj_do > 0 && $poj_od < $poj_do) {
    $query_conditions[] = "Modele.Model_pojemnosc_silnika BETWEEN '$poj_od' AND '$poj_do'";
} elseif ($poj_od >= 0 && empty($poj_do)) {
    $query_conditions[] = "Modele.Model_pojemnosc_silnika >= '$poj_od'";
} elseif (empty($poj_od) && $poj_do > 0) {
    $query_conditions[] = "Modele.Model_pojemnosc_silnika <= '$poj_do'";
} else {
    echo "Wprowadź poprawne wartości pojemności<br>";
    exit();
}

if (count($query_conditions) > 0) {
    $sql = $query_base . ' AND ' . implode(' AND ', $query_conditions);
    $result = $conn->query($sql);

    echo "<center><label>Dostępne pojazdy:</label>";
    echo "<select onclick=\"mojafunkcja6()\" id='model_select' name='model_nazwa' class='select1'>";

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<option value='" . $row["id_model"] . "'>" . $row["Model_nazwa"] . " " . $row["Marka_nazwa"] . " " . $row["Model_rocznik"] . "</option>";
        }
    } else {
        echo "<option value='brak'>Brak dostępnych</option>";
    }

    echo "</select></center>";
    echo "<label id='auto_cena'></label>";
}
?>
