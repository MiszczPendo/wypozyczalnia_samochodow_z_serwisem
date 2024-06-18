<?php
session_start();
@$m = $_REQUEST["m"];
include("polaczenie_z_baza_danych.php");
if($m){
    $sql ="SELECT Auta.wypozyczenie_cena_na_dzien, Modele.Model_pojemnosc_silnika,Modele.Model_rocznik
    FROM Modele 
    INNER JOIN Auta ON Modele.id_model = Auta.id_model 
    WHERE Modele.id_model = '$m' 
    AND Auta.auto_stan = 'Dostępny'";
  
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()){
       echo "<center>Cena wypożyczenia <input type='number' value="."'".$row["wypozyczenie_cena_na_dzien"]."'"." disabled></center>";
       echo "<center>Pojemność silnika <input type='text' style='margin-top: 10px;margin-bottom: 10px;' value="."'".$row["Model_pojemnosc_silnika"]."'"." disabled></center>";
      }
    }  
    }
    if(isset($_GET['marka'])){
      $marka = $_GET['marka'];
      $sql = "SELECT Modele.Model_nazwa, Marki.Marka_nazwa, Auta.wypozyczenie_cena_na_dzien, Modele.Model_pojemnosc_silnika FROM Marki INNER JOIN (Modele INNER JOIN Auta ON Modele.id_model = Auta.id_model) ON Marki.id_marka = Modele.id_marka WHERE (((Modele.id_model)='$marka')); "; 
      $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()){
       echo "<center>Marka <input type='text' value="."'".$row["Marka_nazwa"]."'"." disabled></center><br>";
       echo "<center>Cena wypożyczenia <input type='number' value="."'".$row["wypozyczenie_cena_na_dzien"]."'"." disabled></center><br>";
       echo "<center>Pojemność silnika <input type='text' value="."'".$row["Model_pojemnosc_silnika"]."'"." disabled></center>";
      }
    }  
    }
    if(isset($_GET['auto'])){
      $auto = $_GET['auto'];
      $sql = "SELECT Modele.id_model ,Modele.Model_pojemnosc_silnika, Modele.Model_rocznik,Auta.wypozyczenie_cena_na_dzien
FROM Marki INNER JOIN (Modele INNER JOIN Auta ON Modele.id_model = Auta.id_model) ON Marki.id_marka = Modele.id_marka
WHERE (((Modele.id_model)='$auto'))"; 
      $result = $conn->query($sql);
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()){
       echo "<center>Cena wypożyczenia: <input type='number' value="."'".$row["wypozyczenie_cena_na_dzien"]."'"." disabled><br></center>";
       echo "<center>Pojemność silnika: <input type='text' value="."'".$row["Model_pojemnosc_silnika"]."'"." disabled><br></center>";
      }
    }
    }
?>