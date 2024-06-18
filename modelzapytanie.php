<?php
session_start();
$q = $_REQUEST["q"];
$m = $_REQUEST["m"];
include("polaczenie_z_baza_danych.php");
if($q){
$sql = "SELECT DISTINCT `Modele`.`Model_nazwa` , `modele`.`id_model`,`Modele`.`Model_rocznik` FROM Marki INNER JOIN Modele ON Marki.id_marka = Modele.id_marka INNER JOIN Auta ON Modele.id_model = Auta.id_model WHERE Marki.Marka_nazwa="."'".$q."'"." AND Modele.id_model=Auta.id_model AND Marki.id_marka=Modele.id_marka AND Auta.auto_stan='Dostępny'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()){
               
               echo "<option value="."'".$row["id_model"]."'".">".$row["Model_nazwa"]." ".$row["Model_rocznik"]."</option>";
              }
            }
}
if($m){
    $sql = "SELECT Auta.wypozyczenie_cena_na_dzien FROM Modele INNER JOIN Auta ON Modele.id_model = Auta.id_model WHERE Modele.Model_nazwa="."'".$m."'"."AND Auta.auto_stan='Dostępny' AND Modele.id_model=Auta.id_model"; 
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()){

       echo $row["wypozyczenie_cena_na_dzien"];
      }
    }    
    }
?>