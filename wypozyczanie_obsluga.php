<?php

#$klient=$_POST['klient_select'];
if(isset($_POST['klient_select'])){
    $klient=$_POST['klient_select'];
}
else{
    header('Location: wypozyczenie.php?answer=2');
    exit();
}
if(isset($_POST['model_nazwa'])){
    $model=$_POST['model_nazwa'];
}else {
    header('Location: wypozyczenie.php?answer=2');
    exit();
}
include("polaczenie_z_baza_danych.php");
$data_kalendarz=date('Y-m-d');
$sql = "INSERT INTO `wypożyczenia` (`id_wypożyczenia`, `id_klient`, `data_wypożyczenia`, `data_oddania`) VALUES (NULL, '$klient', '$data_kalendarz',NULL)";
$result = $conn->query($sql);
$sql = "UPDATE `auta` SET `auto_stan` = 'Wypożyczony' WHERE `auta`.`id_model` = '$model'"; 
$result = $conn->query($sql);
$sql = "SELECT `wypożyczenia`.`id_wypożyczenia` FROM `wypożyczenia` ORDER BY `wypożyczenia`.`id_wypożyczenia` DESC LIMIT 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        $wyp_id=$row['id_wypożyczenia'];
    }
}
$sql = "SELECT `auta`.`id_auta` FROM `auta` WHERE `auta`.`id_model` = '$model'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()){
        $auto_id=$row['id_auta'];
    }
}
$sql = "INSERT INTO `wypożyczenia_auta` (`id_auta`, `id_wypożyczenia`) VALUES ('$auto_id', '$wyp_id')";
$result = $conn->query($sql);
header('Location: wypozyczenie.php?answer=1');

?>