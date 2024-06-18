<html>
    <head>
        <title>Zwrot auta</title>
        <meta charset="utf-8">
        <link rel="stylesheet"  type="text/css" href="modul.css?v=1">
    </head>
    <body>
<header>
    <div class="container">
        <h1 style="margin-bottom:5px;">Wypożyczalnia samochodów X-CARS</h1>
    </div>
</header>
    <div class="centerdiv">
        <div class="costma">
            <h1>Formularz zwrotu auta</h1>
        <form action="zwrot_obsluga.php" method="post" accept-charset="utf-8">
        <center><div style="padding:30px;">
            <label>Wyszukaj klienta:</label>
            <input type="text" id="klient_id" name="klient_nazwa" class="input">
            <button type="button" onclick="mojafunkcja3()" class="button">Wyszukaj klienta</button>
            <br>
            <label id="select_klient_id"></label>
            <label>Wypożyczone auta:</label>
            <label id="auta_wyp"></label>
            <br>
            <label>Sposób płatności:</label>
            <select name="rodzaj_platnosci" id="id_rodzaj_platnosci" class="select1">
                <option value="Gotówka">Gotówka</option>
                <option value="Karta kredytowa">Karta kredytowa</option>
                <option value="Przelew">Przelew</option>
            </select>
            <br>
            <input type="checkbox" name="czy_dodatkowe_oplaty" id="id_czy_dodatkowe_oplaty" onclick="check()" >
            <label>Czy chcesz wprowadzić dodatkowe opłaty?</label><br>
             <div id="dodatkowe_oplaty">

             </div>
             </div>
        </center>
             <div class="button-container">
             <div class="but1">
            <button type="submit" class="button1">Zwróć auto</button>
            </div>
            <div class="but1">
            <button type="button" class="button3"><a href="index.php">Powrót na stronę powitalną</a></button>
            </div>
            </div>
            
        </form>
        <p id="zwrot_obsluga"><?php 
        @$kod=$_REQUEST['answer'];
        @$cena=$_REQUEST['cena'];
        @$kod=(int)$kod;
        if(@$kod==2){
            echo "<center>Zwrot auta się nie powiódł</center>";
        }
        if(@$kod==1){
            echo "<center>Zwrot auta powiódł się i cena wynosi ".@$cena." zł</center>";
        }
        ?></p>
        </div>
    </div>
<footer>
<div class="container">
    <h1>&#169;2024 Paweł Bakuła, Jakub Pendowski</h1>
</div>
</footer>
        <script>
        var inputs = document.getElementsByTagName('input');

            for (var i=0; i<inputs.length; i++)  {
            if (inputs[i].type == 'checkbox')   {
                inputs[i].checked = false;
            }
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
            function myfun1(){
                var xhttp3 = new XMLHttpRequest(); 
                var x = document.getElementById("klient_select").value;
                xhttp3.open("GET", "szukanie_wyp_auta.php?m=" + x, true);
                xhttp3.send();
                xhttp3.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("auta_wyp").innerHTML = this.responseText;
                    }
                };
            }
             function check() {

                   var check = document.getElementById("id_czy_dodatkowe_oplaty").checked;
                   if(check){
                    var xhttp3 = new XMLHttpRequest(); 
                    xhttp3.open("GET", "check.php?m=" + check, true);
                    xhttp3.send();
                    xhttp3.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("dodatkowe_oplaty").innerHTML = this.responseText;
                    }
                };
                   }
                   else{
                    var xcx=document.getElementById("dodatkowe_oplaty");
                    xcx.innerHTML="";
                   }
                }

        </script>
    </body>
</html>