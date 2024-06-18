<?php include("polaczenie_z_baza_danych.php");
if(empty($_GET['data_start']) or empty($_GET['data_start'])){
    echo "Brak uzupełnienia daty";
    exit();
}
$data_start=$_REQUEST['data_start'];
$data_end=$_REQUEST['data_end'];

$sql="SELECT SUM(Opłaty.łączna_cena), Opłaty.id_wypożyczenia, Wypożyczenia.data_oddania FROM Wypożyczenia INNER JOIN Opłaty ON Wypożyczenia.id_wypożyczenia = Opłaty.id_wypożyczenia 
WHERE (((Opłaty.id_wypożyczenia)=Wypożyczenia.id_wypożyczenia)) and Wypożyczenia.data_oddania BETWEEN '$data_start' and '$data_end'"; 
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
    $sum=$row["SUM(Opłaty.łączna_cena)"];
    if($sum == null){
        echo "Wprowadź prawidłową datę";
        exit();
    }
        echo "Suma opłat: " . $row["SUM(Opłaty.łączna_cena)"];
    }
}














?>