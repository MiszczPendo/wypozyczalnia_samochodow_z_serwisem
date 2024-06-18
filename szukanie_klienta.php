<?php
include("polaczenie_z_baza_danych.php");


function getValueFromGet($key) {
    if (isset($_GET[$key])) {
        return $_GET[$key];
    } else {
        return null;
    }
}
$m = getValueFromGet('m');

// $sql = "SELECT `klienci`.`Klient_Nazwisko`, `klienci`.`Klient_Imie`, `klienci`.`Klient_NrTelefonu`,`klienci`.`id_klient`
//         FROM `klienci`
//         WHERE `klienci`.`Klient_Nazwisko` REGEXP '^" . $m . "';";

$sql = "SELECT `Klient_Nazwisko`, `Klient_NrTelefonu`,`klienci`.`Klient_Imie`, `klienci`.`Klient_NrTelefonu`,`klienci`.`id_klient`
        FROM `klienci` 
        WHERE `Klient_Nazwisko` REGEXP '^$m' 
        OR `Klient_NrTelefonu` REGEXP '^$m'";
  
    $result = $conn->query($sql);
    echo '<select name="klient_select" onclick="myfun1()" id="klient_select" class="select1">';

    while ($row = $result->fetch_assoc()) {
        $nazwisko = htmlspecialchars($row['Klient_Nazwisko']);
        $imie = htmlspecialchars($row['Klient_Imie']);
        $telefon = htmlspecialchars($row['Klient_NrTelefonu']);
        $id = htmlspecialchars($row['id_klient']);
        echo "<option value='$id'>$nazwisko $imie $telefon</option>";
    }

    echo '</select>';
    echo "<br>";


    $conn->close();

?>