<?php
include("polaczenie_z_baza_danych.php");
$cena_od = $_GET['cena_od'];
$cena_do = $_GET['cena_do'];

$pattern = '/^\d+$/';

if (!preg_match($pattern, $cena_od) || !preg_match($pattern, $cena_do)) {
    echo "Pola nie są uzupełnione poprawnie. Podaj cenę w formacie (liczba)<br>";
    exit();
}

$cena_od = (int)$cena_od;
$cena_do = (int)$cena_do;
  
if ($cena_od >= $cena_do) {
    echo "Nieodpowiedni warunek.<br>";
    exit();
}
if(empty($cena_od) == 0 and empty($cena_do) == 0 and $cena_od < $cena_do){

    $sql ="SELECT Modele.Model_nazwa, Marki.Marka_nazwa, Auta.wypozyczenie_cena_na_dzien, Modele.Model_pojemnosc_silnika, Modele.Model_rocznik,Modele.id_model
    FROM Marki INNER JOIN (Modele INNER JOIN Auta ON Modele.id_model = Auta.id_model) ON Marki.id_marka = Modele.id_marka
    WHERE (((Auta.auto_stan)='Dostępny') AND ((Auta.wypozyczenie_cena_na_dzien) Between '$cena_od' And '$cena_do'))";
    echo "<center><label>Dostępne pojazdy:</label>";
    echo "<select onclick="."'"."mojafunkcja6()"."'"."id=".'model_select'." name='model_nazwa' class='select1'>";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()){
        echo "<option value="."'".$row["id_model"]."'".">".$row["Model_nazwa"]." ".$row["Marka_nazwa"]." ".$row["Model_rocznik"]."</option>";
        
        }
     }
     echo "</select><center><br>";
     echo "<label id="."auto_cena"."></label>";
    }
    elseif(empty($cena_od) == 0 and empty($cena_do) == 1){
        $sql ="SELECT Modele.Model_nazwa, Marki.Marka_nazwa, Auta.wypozyczenie_cena_na_dzien, Modele.Model_pojemnosc_silnika,Modele.Model_rocznik,Modele.id_model
        FROM Marki INNER JOIN (Modele INNER JOIN Auta ON Modele.id_model = Auta.id_model) ON Marki.id_marka = Modele.id_marka 
        WHERE (((Auta.auto_stan)='Dostępny') AND ((Auta.wypozyczenie_cena_na_dzien) >='$cena_od'))"; 
            echo "<center><label>Dostępne pojazdy:</label>";
            echo "<select onclick="."'"."mojafunkcja6()"."'"."id=".'model_select'."name='model_nazwa' class='select1'>";
        $result = $conn->query($sql);
         if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()){
    
            echo "<option value="."'".$row["id_model"]."'".">".$row["Model_nazwa"]." ".$row["Marka_nazwa"]." ".$row["Model_rocznik"]."</option>";
           }
         }
         echo "</select><center><br>";
         echo "<label id="."auto_cena"."></label>";
    }
    elseif(empty($cena_od) == 1 and empty($cena_do) == 0){
        $sql ="SELECT Modele.Model_nazwa, Marki.Marka_nazwa, Auta.wypozyczenie_cena_na_dzien, Modele.Model_pojemnosc_silnika,Modele.Model_rocznik,Modele.id_model
        FROM Marki INNER JOIN (Modele INNER JOIN Auta ON Modele.id_model = Auta.id_model) ON Marki.id_marka = Modele.id_marka 
        WHERE (((Auta.auto_stan)='Dostępny') AND ((Auta.wypozyczenie_cena_na_dzien) <= '$cena_do'))"; 
            echo "<center><label>Dostępne pojazdy:</label>";
            echo "<select onclick="."'"."mojafunkcja6()"."'"."id=".'model_select'." name='model_nazwa' class='select1'>";
        $result = $conn->query($sql);
         if ($result->num_rows > 0) {
         while ($row = $result->fetch_assoc()){
    
            echo "<option value="."'".$row["id_model"]."'".">".$row["Model_nazwa"]." ".$row["Marka_nazwa"]." ".$row["Model_rocznik"]."</option>";
           }
         }
         else{
            echo "<option value="."'"."brak"."'".">Brak dostępnych</option";
         }
         echo "</select><center><br>";
         echo "<label id="."auto_cena"."></label>";
    }
    else{
        echo "Wprowadź poprawne ceny";
    }
?>