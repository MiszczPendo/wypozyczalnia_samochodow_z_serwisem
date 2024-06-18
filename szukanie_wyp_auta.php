

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


$sql = "SELECT Wypożyczenia.id_klient, Wypożyczenia.id_wypożyczenia, Wypożyczenia_Auta.id_auta, Auta.id_model, Modele.id_marka, Modele.Model_nazwa, Marki.Marka_nazwa, Modele.Model_rocznik, Auta.wypozyczenie_cena_na_dzien 
FROM Marki INNER JOIN (Modele INNER JOIN (Auta INNER JOIN (Wypożyczenia INNER JOIN Wypożyczenia_Auta 
ON Wypożyczenia.id_wypożyczenia = Wypożyczenia_Auta.id_wypożyczenia) ON Auta.id_auta = Wypożyczenia_Auta.id_auta) 
ON Modele.id_model = Auta.id_model) ON Marki.id_marka = Modele.id_marka WHERE (((Wypożyczenia.id_klient)='$m') 
AND ((Wypożyczenia.id_wypożyczenia)=Wypożyczenia_Auta.id_wypożyczenia) AND ((Wypożyczenia_Auta.id_auta)=Auta.id_auta) 
AND ((Auta.id_model)=Modele.id_model) AND ((Modele.id_marka)=Marki.id_marka)) and (auta.auto_stan= 'Wypożyczony') 
and (wypożyczenia.data_oddania is null); "; 
  
    $result = $conn->query($sql);
    echo '<select name="wybranie_wypo_auta" id="wybranie_wyp_auta" class="select1">';
    if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        
        $id = htmlspecialchars($row['id_auta']);
        $model = htmlspecialchars($row['Model_nazwa']);
        $marka = htmlspecialchars($row['Marka_nazwa']);
        $rocznik = htmlspecialchars($row['Model_rocznik']);
        echo "<option value='$id'>$model $marka $rocznik</option>";
    }
}
else{
    echo "<option value='-1'>Brak wypożyczeń</option>";
}

    echo '</select>';


    $conn->close();

?>