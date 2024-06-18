<?php
include("polaczenie_z_baza_danych.php");
?>
<html>
    <head>
        <title>Nowy klient</title>
        <meta charset="utf-8">
        <link rel="stylesheet"  type="text/css" href="podstawa.css?v=1">
    </head>
    <body>
   
        <div>
        <?php
        $id_adres=0;
        $name = $_POST['nazwa_imie_klient'];
        $surname = $_POST['nazwa_nazwisko_klient'];
        $nip=0;
        $phone = $_POST['klient_nrtelefonu'];
        $email = $_POST['klient_adresemail'];
        $pesel = $_POST['klient_pesel'];
        $city = $_POST['adres_miasto'];
        $street = $_POST['adres_ulica'];
        $houseNumber = $_POST['adres_numerdomu'];
        $apartmentNumber = 0;
        $province = $_POST['adres_wojewodztwo'];
        if(isset($_POST['klient_nip'])){
            $nip = $_POST['klient_nip'];
        }
        else{
            $nip = null;
        }
         if(isset($_POST['adres_numermieszkania'])){
            $apartmentNumber = $_POST['adres_numermieszkania'];
        }
        else{
            $apartmentNumber = null;
        }
        $sql = "INSERT INTO `adresy` (`id_adres`, `Adres_Miasto`, `Adres_Ulica`, `Adres_NumerDomu`, `Adres_NumerMieszkania`, `Adres_Wojewodztwo`) VALUES (NULL,"."'".$city."'".","."'". $street."'".","."'".$houseNumber."'".","."'".$apartmentNumber."'".","."'".$province."'".")";
        $result = $conn->query($sql);
        $sql = "SELECT id_adres  FROM adresy ORDER BY id_adres DESC LIMIT 1;";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()){

           $id_adres=$row["id_adres"];
          }
        }
        $sql="INSERT INTO `klienci` (`id_klient`, `Klient_Nazwisko`, `Klient_Imie`, `Klient_NIP`, `Klient_NrTelefonu`, `Klient_IdAdres`, `Klient_AdresEmail`, `Klient_PESEL`) VALUES (NULL, '$name', '$surname', '$nip', '$phone', '$id_adres', '$email', '$pesel')";

        $result = $conn->query($sql);
        header('Location: wypozyczenie.php?answer=3');

            ?>
        </div>
    </body>
</html>