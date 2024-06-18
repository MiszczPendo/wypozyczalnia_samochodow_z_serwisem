<?php
include("polaczenie_z_baza_danych.php");
if(!isset($_POST['klient_select']) or !isset($_POST['wybranie_wypo_auta']) or $_POST['wybranie_wypo_auta']==-1){
    header('Location: zwrot_form.php?answer=2');
}
if(isset($_POST['rodzaj_platnosci']) and !isset($_POST['dodatkowe_oplaty_opis'])){
    $dodatkowa_oplata=0;
    $dodatkowa_oplata_opis=null;
}
else{
    $dodatkowa_oplata=(int)$_POST['dodatkowe_oplaty'];
    $dodatkowa_oplata_opis=$_POST['dodatkowe_oplaty_opis'];
}
$id_klient=$_POST['klient_select'];
$id_auta=$_POST['wybranie_wypo_auta'];
$rodzaj_platnosci=$_POST['rodzaj_platnosci'];

$data_kalendarz=date('Y-m-d');





$sql = "SELECT Wypożyczenia.id_klient, Wypożyczenia.id_wypożyczenia, Wypożyczenia_Auta.id_auta, Auta.id_model, Modele.id_marka, Modele.Model_nazwa, Marki.Marka_nazwa, Modele.Model_rocznik, Auta.wypozyczenie_cena_na_dzien, Wypożyczenia.data_wypożyczenia 
FROM Marki INNER JOIN (Modele INNER JOIN (Auta INNER JOIN (Wypożyczenia INNER JOIN Wypożyczenia_Auta 
ON Wypożyczenia.id_wypożyczenia = Wypożyczenia_Auta.id_wypożyczenia) 
ON Auta.id_auta = Wypożyczenia_Auta.id_auta) 
ON Modele.id_model = Auta.id_model) 
ON Marki.id_marka = Modele.id_marka WHERE (((Wypożyczenia.id_klient)='$id_klient') 
AND ((Wypożyczenia.id_wypożyczenia)=Wypożyczenia_Auta.id_wypożyczenia) 
AND ((Wypożyczenia_Auta.id_auta)='$id_auta') AND ((Auta.id_model)=Modele.id_model) AND ((Modele.id_marka)=Marki.id_marka)); ";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $id_wypożyczenia=$row['id_wypożyczenia'];
        $data_wyp=$row['data_wypożyczenia'];
        $cena=$row['wypozyczenie_cena_na_dzien'];
    }
}

$timestamp1 = strtotime($data_kalendarz);
$timestamp2 = strtotime($data_wyp);
$cena=(int)$cena;
// Obliczanie różnicy w sekundach
$diffInSeconds = abs($timestamp1 - $timestamp2);

// Konwersja różnicy na dni
$obliczonadata = $diffInSeconds / (60 * 60 * 24);
if($obliczonadata==0){
    $obliczonadata=1;
}
$laczna_cena=($obliczonadata*$cena)+$dodatkowa_oplata;


$sql="UPDATE `wypożyczenia` SET `data_oddania` = '$data_kalendarz' WHERE `wypożyczenia`.`id_wypożyczenia` = '$id_wypożyczenia'"; 
$result = $conn->query($sql);

$sql="INSERT INTO `opłaty` (`id_opłaty`, `id_wypożyczenia`, `łączna_cena`, `rodzaj_płatności`, `dodatkowe_opłaty`, `dodatkowe_opłaty_opis`) VALUES (NULL, '$id_wypożyczenia', '$laczna_cena', '$rodzaj_platnosci', '$dodatkowa_oplata', '$dodatkowa_oplata_opis')"; 
$result = $conn->query($sql);

$sql = "UPDATE `auta` SET `auto_stan` = 'Dostępny' WHERE `auta`.`id_auta` = '$id_auta'";
$result = $conn->query($sql);

 if($result===true){
    header("Location: zwrot_form.php?answer=1&cena=$laczna_cena");
 }
    $conn->close();

?>