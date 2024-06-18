<?php
include("polaczenie_z_baza_danych.php");

$message = "";
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_auta = $_POST['auto_serwis_zwrot'];
    $termin_odbioru_z_naprawy = date('Y-m-d');

    // Pobranie ostatniego wpisu serwisowego dla wybranego auta
    $serwis_sql = "SELECT id_serwis FROM serwisy WHERE id_auta = $id_auta AND status_naprawy = 'W toku' ORDER BY id_serwis DESC LIMIT 1";
    $serwis_result = $conn->query($serwis_sql);
    $id_serwis = null;

    if ($serwis_result->num_rows > 0) {
        $row = $serwis_result->fetch_assoc();
        $id_serwis = $row['id_serwis'];
    }

    if ($id_serwis !== null) {
        $update_auto_sql = "UPDATE auta SET auto_stan = 'Dostępny' WHERE id_auta = $id_auta";
        if ($conn->query($update_auto_sql) === TRUE) {
            $update_serwis_sql = "UPDATE serwisy SET status_naprawy = 'Zakończona', termin_odbioru_z_naprawy = '$termin_odbioru_z_naprawy' WHERE id_serwis = $id_serwis";
            if ($conn->query($update_serwis_sql) === TRUE) {
                $message = "Pomyślnie odebrano auto z serwisu.";
            } else {
                $error_message = "Błąd przy aktualizacji statusu naprawy: " . $conn->error;
            }
        } else {
            $error_message = "Błąd przy aktualizacji stanu auta: " . $conn->error;
        }
    } else {
        $error_message = "Nie znaleziono aktywnej naprawy dla wybranego auta.";
    }
}
?>

<html>
<head>
    <title>Odbierz auto z serwisu</title>
    <meta charset="utf-8">
    <link rel="stylesheet"  type="text/css" href="modul.css?v=1">
</head>
<body>
<header>
        <div class="container">
            <h1>Wypożyczalnia samochodów X-CARS</h1>
        </div>
</header>
    <div class="centerdiv">
        <div class="costma">
        <h1>Formularz odbierania auta z serwisu</h1>
        <form action="serwis_odbior_form.php" method="post" accept-charset="utf-8">
           <center><label>Wybierz auto, które jest w serwisie:</label>
            <select name="auto_serwis_zwrot" id="id_auto_serwis_zwrot" class="select1" style="margin:5px;">
                <?php
                $auta_sql = "SELECT auta.id_auta, marki.Marka_nazwa, modele.Model_nazwa, modele.Model_rocznik, serwisy.termin_oddania_do_naprawy 
                            FROM auta 
                            INNER JOIN modele ON auta.id_model = modele.id_model 
                            INNER JOIN marki ON modele.id_marka = marki.id_marka 
                            INNER JOIN serwisy ON auta.id_auta = serwisy.id_auta 
                            WHERE serwisy.status_naprawy = 'W toku'";
                $auta_result = $conn->query($auta_sql);

                if ($auta_result->num_rows > 0) {
                    while($row = $auta_result->fetch_assoc()) {
                        echo "<option value='" . $row['id_auta'] . "'>" . $row['Marka_nazwa'] . " " . $row['Model_nazwa'] . " " . $row['Model_rocznik'] . "; " . $row['termin_oddania_do_naprawy'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Brak aut w serwisie</option>";
                }
                ?>
            </select></center> 
            <br>
            <div class="button-container">
                 <div class="but1">
            <button type="submit" class="button1">Odbierz auto z serwisu</button>
                 </div>
                 <div class="but1">
            <button type="button" class="button3"><a href="index.php">Powrót na stronę powitalną</a></button>
                </div>
            </div>
        </form>

        <?php
        if (!empty($message)) {
            echo "<center><p>$message</p></center>";
            echo "<center><button class='button1' onclick='window.location.href=\"generuj_raport.php?id_serwis=$id_serwis\"'>Wygeneruj raport naprawy (PDF)</button></center><br>";
        } elseif (!empty($error_message)) {
            echo "<center><p>$error_message</p></center><br>";
        }
        ?>
        </div>
    </div>
    <footer>
<div class="container">
    <h1>&#169;2024 Paweł Bakuła, Jakub Pendowski</h1>
</div>
</footer>
</body>
</html>
