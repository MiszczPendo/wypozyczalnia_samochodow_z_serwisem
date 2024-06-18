<?php
session_start();
include("polaczenie_z_baza_danych.php");
$sql = "SELECT DISTINCT Marki.Marka_nazwa FROM Marki INNER JOIN Modele ON Marki.id_marka = Modele.id_marka INNER JOIN Auta ON Modele.id_model = Auta.id_model WHERE Modele.id_model=Auta.id_model And Marki.id_marka=Modele.id_marka And Auta.auto_stan='Dostępny' And Auta.id_auta Is Not Null";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()){
               $tab[]=$row["Marka_nazwa"];
              }
            }
            
$q = $_REQUEST["q"];
$_SESSION["marka"]=$q;
foreach ($tab as $string){
    if(strcmp($string,$q) == 0){
        echo $string;
        break;
    }
}
?>