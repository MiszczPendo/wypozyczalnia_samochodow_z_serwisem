<?php 
        require("polaczenie_z_baza_danych.php");
        session_start();
        ?>
<html>
    <head>
        <title>Nowe wypożyczenie</title>
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
<h1>Formularz wypożyczenia</h1>
                        <div class="costma">
                                    <form action="wypozyczenie.php" method="GET" id="kryteriaForm">
                                        <H2>Kryteria wyboru:</H2>
                                        <center><input type="radio" name="kryterium" value="mka">Marka
                                        <input type="radio" name="kryterium" value="mdl">Model
                                        <input type="radio" name="kryterium" value="pojemnosc">Pojemność Silnika
                                        <input type="radio" name="kryterium" value="cena">Cena
                                        <br>
                                        <input type="submit" class="button1" value="Wybierz kryterium"></center>
                                    </form>
                        <?php 
                            if(!isset($_GET['kryterium'])){
                                echo "<label>Wybierz kryterium</label>";
                            }
                            else{
                        $kryterium=$_GET['kryterium'];
                        ?>
                        </div>
 <div class="form_wypozyczenia">
    <?php if(strcmp( $kryterium, "mka")==0){ ?>
        <div class="button-container">
    <form method="post" action="wypozyczanie_obsluga.php">
    <div class="costma">
        
        <?php 
        $sql = "SELECT DISTINCT Marki.Marka_nazwa FROM Marki INNER JOIN Modele ON Marki.id_marka = Modele.id_marka INNER JOIN Auta ON Modele.id_model = Auta.id_model WHERE Auta.auto_stan='Dostępny'";
        $result = $conn->query($sql);
        ?>
       <center> <label>Marka:</label>
        <select name="marka_nazwa" id="marka_id" onclick="mojafuncja()" class="select1">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row["Marka_nazwa"]."'>".$row["Marka_nazwa"]."</option>";
            }
        } else {
            echo "<option value=''>Brak dostępnych marek</option>";
        }
        ?>
        </select>
        <br>
        
        <label>Model: </label>
        <select name="model_nazwa" id="model_id" onclick="mojafunkcja2()" class="select1" style="margin-top:10px;margin-bottom:10px;">
        </select></center>
        <label id="cos" ></label>
        <label>Wyszukaj klienta:</label>
        <input type="text" id="klient_id" name="klient_nazwa"><br>
        <button type="button" onclick="mojafunkcja3()" class="button" style="margin: 10px;">Wyszukaj klienta</button>
        <button type="button" class="button1" style="margin: 10px;" ><a href="nowy_klient_form.php" >Nowy klient</a></button>
        <br>

        <center><label id="select_klient_id"></label></center>
        <center><input type="submit" value="Dodaj wypożyczenie" class="button1" style="margin-top: 10px;"></center>
    </div>
</form>
</div>
<?php } if(strcmp( $kryterium, "mdl")==0){?>
    <div class="button-container">
    <form method="post" action="wypozyczanie_obsluga.php">
    <div class="costma">
        <?php  
        $sql = "SELECT Modele.Model_nazwa, Marki.Marka_nazwa, Auta.wypozyczenie_cena_na_dzien, Modele.Model_pojemnosc_silnika, modele.id_model,Modele.Model_rocznik FROM Marki INNER JOIN (Modele INNER JOIN Auta ON Modele.id_model = Auta.id_model) ON Marki.id_marka = Modele.id_marka WHERE (((Auta.id_model)=modele.id_model) AND ((Auta.auto_stan)='Dostępny'))"; 
        $result = $conn->query($sql);
        ?>
        <center><label>Model:</label>
        <select id="model_auto" onclick="mojafunkcja4()" name="model_nazwa" class="select1">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row["id_model"]."'>".$row["Model_nazwa"]." ".$row["Model_rocznik"]."</option>";
            }
        } else {
            echo "<option value=''>Brak dostępnych modeli</option>";
        }
        ?>
        </select></center>
        <br>
        <label id="polemarkacenapoj"></label><br>
        <label>Wyszukaj klienta:</label>
        <input type="text" id="klient_id" name="klient_nazwa"><br>
        <button type="button" onclick="mojafunkcja3()" class="button" style="margin: 10px;">Wyszukaj klienta</button>
        <button type="button" class="button1" style="margin: 10px;"><a href="nowy_klient_form.php" >Nowy klient</a></button>
        <br>

        <center><label id="select_klient_id"></label>
        <input type="submit" value="Dodaj wypożyczenie" class="button1" style="margin-top: 10px;"></center>
    </div>
</form>
</div>
<?php }?>
<?php if(strcmp( $kryterium, "pojemnosc")==0){?>
    <div class="button-container">
    <form method="post" action="wypozyczanie_obsluga.php">
    <div class="costma">
        <label>Pojemność Silnika</label>
        <br>
        <label>Objętość skokowa od:</label><input type="text" name="liczba_od" id="liczba_od" pattern="[0-9].[0-9]">
        <label>Objętość skokowa do:</label><input type="text" name="liczba_do" id="liczba_do" pattern="[0-9].[0-9]">
        <br>
        <center><button type="button" onclick="mojafunkcja7()" class="button" style="margin: 10px;">Wybierz pojemność silnika</button></center>
        <label id="pojkrytzap"></label>
        <center><label>Wyszukaj klienta:</label>
        <input type="text" id="klient_id" name="klient_nazwa"><br></center>
       <center> <button type="button" onclick="mojafunkcja3()" class="button" style="margin: 10px;">Wyszukaj klienta</button>
        <button type="button" class="button1" style="margin: 10px;"><a href="nowy_klient_form.php">Nowy klient</a></button></center>
        <center><label id="select_klient_id"></label>
        <input type="submit" value="Dodaj wypożyczenie" class="button1" style="margin-top: 10px;"></center>
    </div>
</form>
</div>
<?php }?>
<?php if(strcmp( $kryterium, "cena")==0){?>
    <div class="button-container">
    <form method="post" action="wypozyczanie_obsluga.php">
    <div class="costma">
        <label>Cena wypożyczenia</label>
        <br>
        <label>Cena od:</label><input type="number" name="liczba_od" id="liczba_od" pattern="[0-9]">
        <label>Cena do:</label><input type="number" name="liczba_do" id="liczba_do" pattern="[0-9]">
        <br>
        <center><button type="button" onclick="mojafunkcja5()" class="button" style="margin: 10px;">Wybierz cenę wypożyczenia</button>
        <br>
        <label id="cenakrytzap"></label>
        <label>Wyszukaj klienta:</label>
        <input type="text" id="klient_id" name="klient_nazwa"><br></center>
        <center><button type="button" onclick="mojafunkcja3()" class="button1" style="margin: 10px;">Wyszukaj klienta</button>
        <button type="button" class="button1" style="margin: 10px;"><a href="nowy_klient_form.php" >Nowy klient</a></button></center>
        

        <center> <label id="select_klient_id"></label>
        <input type="submit" value="Dodaj wypożyczenie" class="button1" style="margin-top: 10px;"></center>
    </div>
</form>
</div>

<?php }?>
</div>
<?php } ?>
<div>
<label><?php 
echo "<center><button type='button' style='margin-top: 20px;' class='button3'><a href='index.php'>Powrót na stronę powitalną</a></button></center>";
@$kod=@$_REQUEST['answer'];
        // $kod=(int)$kod;
        if(@$kod==1){
            echo "<br><center><label>Pomyślnie dokonano wypożyczenia.</label></center>";
        }
        if(@$kod==2){
            echo "<br><center><label style= 'font-size: 22px;'>Operacja wypożyczenia auta nie powiodła się.</label></center>";
        }
        if(@$kod==3){
            echo "<br><center><label style= 'font-size: 22px;'>Dodano nowego klienta.</label></center>";
        }
?></label>
</div>
</div>
</div>
                        <script>
                        function mojafuncja(){
                            var xhttp = new XMLHttpRequest(); 
                            var x = document.getElementById("marka_id").value;
                            xhttp.open("GET", "markazapytanie.php?q=" + x, true);
                            xhttp.send();

                            var xhttp1 = new XMLHttpRequest();
                            xhttp1.open("GET", "modelzapytanie.php?q=" + x, true);
                            xhttp1.send();
                            xhttp1.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("model_id").innerHTML = this.responseText;
                                }
                            };
                        }

                        function mojafunkcja2(){
                            var xhttp3 = new XMLHttpRequest(); 
                            var x = document.getElementById("model_id").value;
                            xhttp3.open("GET", "cenazapytanie.php?m=" + x, true);
                            xhttp3.send();
                            xhttp3.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("cos").innerHTML = this.responseText;
                                }
                            };
                        }

                        function mojafunkcja3(){
                            var xhttp3 = new XMLHttpRequest(); 
                            var x = document.getElementById("klient_id").value;
                            xhttp3.open("GET", "szukanie_klienta.php?m=" + x, true);
                            xhttp3.send();
                            xhttp3.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("select_klient_id").innerHTML = this.responseText;
                                }
                            };
                        }
                        function mojafunkcja4(){
                            var xhttp3 = new XMLHttpRequest();
                            var x =document.getElementById("model_auto").value;
                            xhttp3.open("GET", "cenazapytanie.php?marka=" + x, true);
                            xhttp3.send();
                            xhttp3.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("polemarkacenapoj").innerHTML = this.responseText;
                                }
                            };
                        }
                        function mojafunkcja5(){
                            var xhttp4 = new XMLHttpRequest();
                            var x = document.getElementById("liczba_od").value;
                            var y = document.getElementById("liczba_do").value;

                            xhttp4.open("GET", "cenakrytzap.php?cena_od=" + x + "&cena_do=" + y, true);
                            xhttp4.send();
                            xhttp4.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("cenakrytzap").innerHTML = this.responseText;
                                }
                            };
                        }
                        function mojafunkcja6(){
                            var xhttp4 = new XMLHttpRequest();
                            var x = document.getElementById("model_select").value;

                            xhttp4.open("GET", "cenazapytanie.php?auto=" + x, true);
                            xhttp4.send();
                            xhttp4.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("auto_cena").innerHTML = this.responseText;
                                }
                            };
                        }
                        function mojafunkcja7(){
                            var xhttp4 = new XMLHttpRequest();
                            var x = document.getElementById("liczba_od").value;
                            var y = document.getElementById("liczba_do").value;

                            xhttp4.open("GET", "pojkrytzap.php?poj_od=" + x + "&poj_do=" + y, true);
                            xhttp4.send();
                            xhttp4.onreadystatechange = function() {
                                if (this.readyState == 4 && this.status == 200) {
                                    document.getElementById("pojkrytzap").innerHTML = this.responseText;
                                }
                            };
                        }
                        </script>
<footer>
<div class="container">
    <h1>&#169;2024 Paweł Bakuła, Jakub Pendowski</h1>
</div>
</footer>
</body>
</html>