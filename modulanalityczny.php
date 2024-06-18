<?php include("polaczenie_z_baza_danych.php"); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Moduł Analityczny</title>
    <link rel="stylesheet"  type="text/css" href="modul.css?v=1">
</head>
<body>
<header>
        <div class="container">
            <h1>Wypożyczalnia samochodów X-CARS</h1>
        </div>
</header>
<div class="centerdiv">
    <h1>Moduł Analityczny</h1>
    <div class="costma">
        <label>Suma opłat, które klienci zapłacili za auta wypożyczone w przedziale czasu</label>
        <input type="date" id="start_date" name="start_date" class="date">
        <input type="date" id="end_date" name="end_date" class="date">
        <!-- <div class="button-container"> -->
        <button type="button" onclick="myfunc2()" class="button">Wyświetl sumę opłat</button>
        <!-- </div> -->
         <br>
        <label id="sum_result"></label>
        <br>
        <label>Najdroższe i najtańsze w utrzymaniu auto:</label>
        <br>
        <label><?php 
        $sql="WITH SumaKosztow AS (
    SELECT s.id_auta, SUM(u.Koszt_usterki) AS Suma_kosztów
    FROM serwisy s
    JOIN usterki u ON s.id_usterki = u.id_usterki
    GROUP BY s.id_auta)
SELECT id_auta, Suma_kosztów
FROM SumaKosztow
WHERE Suma_kosztów = (
SELECT MAX(Suma_kosztów)
FROM SumaKosztow);";  
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        $id_max_car = $row["id_auta"];
        $suma_max=$row["Suma_kosztów"];
            }
        }
        $sql="WITH SumaKosztow AS ( SELECT s.id_auta, SUM(u.Koszt_usterki) AS Suma_kosztów FROM serwisy s JOIN usterki u ON s.id_usterki = u.id_usterki GROUP BY s.id_auta ) SELECT id_auta, Suma_kosztów FROM SumaKosztow WHERE Suma_kosztów = ( SELECT MIN(Suma_kosztów) FROM SumaKosztow ); " ;  
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        $id_min_car = $row["id_auta"];
        $suma_min=$row["Suma_kosztów"];
            }
        }
        $sql="SELECT Auta.id_auta, Modele.Model_nazwa, Marki.Marka_nazwa, Modele.Model_rocznik 
        FROM (Marki INNER JOIN Modele ON Marki.id_marka = Modele.id_marka) 
        INNER JOIN Auta ON Modele.id_model = Auta.id_model WHERE (((Auta.id_auta)='$id_max_car') AND ((Modele.id_model)=Auta.id_model) 
        AND ((Modele.id_marka)=Marki.id_marka)); " ;  
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
        
            while($row = $result->fetch_assoc()) {
       echo '<label>Najdroższe auto w utrzymaniu to: '.$row["Marka_nazwa"].$row["Model_nazwa"].$row["Model_rocznik"].'. Cena utrzymania wynosi: '.$suma_max.'</label><br>';
       
            }
        }
        $sql="SELECT Auta.id_auta, Modele.Model_nazwa, Marki.Marka_nazwa, Modele.Model_rocznik 
        FROM (Marki INNER JOIN Modele ON Marki.id_marka = Modele.id_marka) 
        INNER JOIN Auta ON Modele.id_model = Auta.id_model WHERE (((Auta.id_auta)='$id_min_car') AND ((Modele.id_model)=Auta.id_model) 
        AND ((Modele.id_marka)=Marki.id_marka)); " ;  
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
       echo 'Najtańsze auto w utrzymaniu to: '.$row["Marka_nazwa"].$row["Model_nazwa"].$row["Model_rocznik"].'. Cena utrzymania wynosi: '.$suma_min.'<br>';
       
            }
        }



        ?></label>
        <label>Najczęściej psujące się auto:</label>

        <label><?php 
        $sql="SELECT a.id_auta,m.Marka_nazwa,mo.Model_nazwa,mo.Model_rocznik,COUNT(s.id_serwis) AS liczba_napraw
        FROM serwisy s JOIN auta a ON s.id_auta = a.id_auta JOIN modele mo ON a.id_model = mo.id_model
        JOIN marki m ON mo.id_marka = m.id_marka GROUP BY a.id_auta, m.Marka_nazwa, mo.Model_nazwa
        HAVING COUNT(s.id_serwis) = (SELECT MAX(liczba_napraw) FROM (SELECT COUNT(s2.id_serwis) AS liczba_napraw
        FROM serwisy s2 GROUP BY s2.id_auta) AS max_napraw);";  
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
        echo $row["Marka_nazwa"]." ".$row['Model_nazwa']." ".$row['Model_rocznik'] ." liczba napraw: ".$row['liczba_napraw'];
            }
        }
        
        
        
        
        
        
        ?></label>
        <!-- <label><?php #echo $cheapest_car; ?></label> -->
        <br>
        <label>Auta które nigdy nie były w naprawie:</label> 
        <br>
        <?php 
        $sql="SELECT auta.id_auta,marki.Marka_nazwa,modele.Model_nazwa,modele.Model_rocznik FROM auta
    INNER JOIN modele ON auta.id_model = modele.id_model
    INNER JOIN marki ON modele.id_marka = marki.id_marka
    WHERE auta.id_auta NOT IN (SELECT serwisy.id_auta FROM serwisy)"; 
        $result = $conn->query($sql);
        echo "<select class='select1'>";
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
       echo "<option>".$row["Marka_nazwa"]." ".$row['Model_nazwa']." ".$row['Model_rocznik']."</option>";
            }
        }
        echo "</select><br>";
        ?>
        </label> 
        <label>Auta, które były wypożyczane najczęściej</label>
        <br>
        <label><?php 
        $sql="SELECT a.id_auta, m.Marka_nazwa,mo.Model_rocznik, mo.Model_nazwa, liczba_wypozyczen 
        FROM ( SELECT a.id_auta, COUNT(wa.id_wypożyczenia) AS liczba_wypozyczen FROM wypożyczenia_auta wa 
        JOIN auta a ON wa.id_auta = a.id_auta GROUP BY a.id_auta ) AS subquery 
        JOIN auta a ON subquery.id_auta = a.id_auta JOIN modele mo ON a.id_model = mo.id_model 
        JOIN marki m ON mo.id_marka = m.id_marka WHERE liczba_wypozyczen = ( SELECT MAX(liczba_wypozyczen) 
        FROM ( SELECT COUNT(wa.id_wypożyczenia) AS liczba_wypozyczen FROM wypożyczenia_auta wa GROUP BY wa.id_auta ) AS max_subquery )";  
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
       echo $row["Marka_nazwa"]." ".$row['Model_nazwa']." ".$row['Model_rocznik'] ." liczba wypożyczeń: ".$row['liczba_wypozyczen']."<br>";
            }
        }
        ?></label>
        <label>Auto, które było wypożyczone najdłużej:</label>
        <br>
        <label><?php 
        $sql="SELECT a.id_auta,m.Marka_nazwa,mo.Model_nazwa,mo.Model_rocznik,wypozyczone_przez_dni FROM (SELECT a.id_auta,SUM(DATEDIFF(w.data_oddania, w.data_wypożyczenia)) AS wypozyczone_przez_dni
        FROM wypożyczenia_auta wa JOIN auta a ON wa.id_auta = a.id_auta JOIN wypożyczenia w ON wa.id_wypożyczenia = w.id_wypożyczenia
        GROUP BY a.id_auta) AS subquery JOIN auta a ON subquery.id_auta = a.id_auta JOIN modele mo ON a.id_model = mo.id_model
        JOIN marki m ON mo.id_marka = m.id_marka WHERE wypozyczone_przez_dni = (SELECT 
        MAX(wypozyczone_przez_dni) FROM (SELECT SUM(DATEDIFF(w.data_oddania, w.data_wypożyczenia)) AS wypozyczone_przez_dni
        FROM wypożyczenia_auta wa JOIN wypożyczenia w ON wa.id_wypożyczenia = w.id_wypożyczenia
        GROUP BY wa.id_auta ) AS max_subquery);";  
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
       echo $row["Marka_nazwa"]." ".$row['Model_nazwa']." ".$row['Model_rocznik'] ." wypożyczone przez dni: ".$row['wypozyczone_przez_dni'];
            }
        } ?></label>
        <br>
        <div class="button-container">
        <button type="button" class="button3"><a href="index.php">Powrót do strony głównej</a></button>
        </div>
    </div>
</div>
<footer>
<div class="container">
    <h1>&#169;2024 Paweł Bakuła, Jakub Pendowski</h1>
</div>
</footer>
<script>
    function myfunc2(){
        var xhttp3 = new XMLHttpRequest();
        var start_date = document.getElementById("start_date").value;
        var end_date = document.getElementById("end_date").value;
        xhttp3.open("GET", "suma_oplat_zap.php?data_start=" + start_date + "&data_end=" + end_date, true);
                xhttp3.send();
                xhttp3.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("sum_result").innerHTML = this.responseText;
                    }
                };
    }
</script>

</body>
</html>