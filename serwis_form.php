<?php
include("polaczenie_z_baza_danych.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_auta = $_POST['auto_serwis'];
    $id_usterki = $_POST['usterka'];
    $termin_oddania_do_naprawy = date('Y-m-d');

    $update_auto_sql = "UPDATE auta SET auto_stan = 'W naprawie' WHERE id_auta = $id_auta";
    if ($conn->query($update_auto_sql) === TRUE) {
        $insert_serwis_sql = "INSERT INTO serwisy (id_auta, termin_oddania_do_naprawy, id_usterki, status_naprawy) 
                                VALUES ($id_auta, '$termin_oddania_do_naprawy', $id_usterki, 'W toku')";
        if ($conn->query($insert_serwis_sql) === TRUE) {
            $message = "Samochód został oddany do serwisu pomyślnie.";
        } else {
            $error_message = "Błąd przy dodawaniu wpisu do serwisu: " . $conn->error;
        }
    } else {
        $error_message = "Błąd przy aktualizacji stanu auta: " . $conn->error;
    }
}
?>

<html>
<head>
    <title>Oddaj auto do serwisu</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="modul.css?v=1">
</head>
<body>
    <header>
        <div class="container">
            <h1>Wypożyczalnia samochodów X-CARS</h1>
        </div>
    </header>
    <div class="centerdiv">
        <div class="costma">
        <h1 style="margin-bottom:5px;">Formularz oddania auta do serwisu</h1>
        <br>
        <form action="serwis_form.php" method="post" accept-charset="utf-8">
           <center><div>
            <div style="margin-bottom:2px;">
            <label>Wybierz auto:</label>
            <select name="auto_serwis" id="id_auto_serwis" class="select1">
                <?php
                $auta_sql = "SELECT auta.id_auta, marki.Marka_nazwa, modele.Model_nazwa, modele.Model_rocznik 
                            FROM auta 
                            INNER JOIN modele ON auta.id_model = modele.id_model 
                            INNER JOIN marki ON modele.id_marka = marki.id_marka 
                            WHERE auto_stan = 'Dostępny'";
                $auta_result = $conn->query($auta_sql);

                if ($auta_result->num_rows > 0) {
                    while($row = $auta_result->fetch_assoc()) {
                        echo "<option value='" . $row['id_auta'] . "'>" . $row['Marka_nazwa'] . " " . $row['Model_nazwa'] . " " . $row['Model_rocznik'] . "</option>";
                    }
                } else {
                    echo "<option value=''>Brak dostępnych samochodów</option>";
                }
                ?>
            </select>
            </div>
            <br>
            <div>
            <label>Wybierz usterkę:</label>
            <select name="usterka" id="id_usterka" class="select1">
                <?php
                $usterki_sql = "SELECT id_usterki, Nazwa_Usterki, Koszt_usterki FROM usterki";
                $usterki_result = $conn->query($usterki_sql);

                if ($usterki_result->num_rows > 0) {
                    while($row = $usterki_result->fetch_assoc()) {
                        echo "<option value='" . $row['id_usterki'] . "'>" . $row['Nazwa_Usterki'] . " " . $row['Koszt_usterki'] . " zł</option>";
                    }
                } else {
                    echo "<option value=''>Brak dostępnych usterek</option>";
                }
                ?>
            </select>
            </div>
            </div></center> 
            <br>
            <div class="button-container1">
            <div class="but1">
            <button type="submit" class="button1">Oddaj auto do serwisu</button>
            </div>
            <div class="but1">
            <button type="button" class="button3"><a href="index.php">Powrót na stronę powitalną</a></button>
            </div>
            </div>
        </form>
        <?php
        if (isset($message)) {
            echo "<center><p id='wynik_serwis'>$message</p></center>";
        } elseif (isset($error_message)) {
            echo "<center><p id='wynik_serwis'>$error_message</p></center>";
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
