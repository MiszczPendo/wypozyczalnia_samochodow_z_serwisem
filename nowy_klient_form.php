<html>
    <head>
        <title>Nowy klient</title>
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
            <div class="button-container1">
                <div class="costma">
            <h1>Formularz dodawania nowego klienta</h1>
        </br>
       <center><form action="dodawanie_klient_obsluga.php" method="post" accept-charset="utf-8">
    <label>Imie: </label>
    <input type="text" name="nazwa_imie_klient" id="id_imie_klient" pattern="[A-Za-ząęźżśóćńłĄĘŻŹŚÓŚĆŃŁ]*" title="Proszę wprowadzić tylko litery" required><br>

    <label>Nazwisko: </label>
    <input type="text" name="nazwa_nazwisko_klient" id="id_nazwisko_klient" pattern="[A-Za-ząęźżśóćńłĄĘŻŹŚÓŚĆŃŁ]*" title="Proszę wprowadzić tylko litery" required><br>

    <label>NIP: </label>
    <input type="number" name="klient_nip" id="id_klient_nip" pattern="[0-9]{10}", title="Proszę wprowadzić 10 cyfr"><br>

    <label>Nr Telefonu: </label>
    <input type="tel" name="klient_nrtelefonu" id="id_klient_nrtelefonu" pattern="[0-9]{3}-[0-9]{3}-[0-9]{3}" title="Proszę wprowadzić 9 cyfr w formacie xxx-xxx-xxx" required><br>

    <label>Adres Email: </label>
    <input type="email" name="klient_adresemail" id="id_klient_adresemail" required><br>

    <label>PESEL: </label>
    <input type="text" name="klient_pesel" id="id_klient_pesel" pattern="[0-9]{11}" title="Proszę wprowadzić 11 cyfr" required><br>

    <label>Miasto: </label>
    <input type="text" name="adres_miasto" id="id_adres_miasto" pattern="[A-Za-ząęźżśóćńłĄĘŻŹŚÓŚĆŃŁ]*" title="Proszę wprowadzić tylko litery" required><br>

    <label>Ulica: </label>
    <input type="text" name="adres_ulica" id="id_adres_ulica" pattern="[A-Za-ząęźżśóćńłĄĘŻŹŚÓŚĆŃŁ]*" title="Proszę wprowadzić tylko litery" required><br>

    <label>Numer Domu: </label>
    <input type="text" name="adres_numerdomu" id="id_adres_numerdomu" required><br>

    <label>Numer Mieszkania: </label>
    <input type="text" name="adres_numermieszkania" id="id_adres_numermieszkania"><br>

    <label>Województwo: </label>
    <select name="adres_wojewodztwo" id="id_adres_wojewodztwo" class="select1">
        <option value="Dolnośląskie">Dolnośląskie</option>
        <option value="Kujawsko-Pomorskie">Kujawsko-Pomorskie</option>
        <option value="Lubelskie">Lubelskie</option>
        <option value="Lubuskie">Lubuskie</option>
        <option value="Łódzkie">Łódzkie</option>
        <option value="Małopolskie">Małopolskie</option>
        <option value="Mazowieckie">Mazowieckie</option>
        <option value="Opolskie">Opolskie</option>
        <option value="Podkarpackie">Podkarpackie</option>
        <option value="Podlaskie">Podlaskie</option>
        <option value="Pomorskie">Pomorskie</option>
        <option value="Śląskie">Śląskie</option>
        <option value="Świętokrzyskie">Świętokrzyskie</option>
        <option value="Warmińsko-Mazurskie">Warmińsko-Mazurskie</option>
        <option value="Wielkopolskie">Wielkopolskie</option>
        <option value="Zachodniopomorskie">Zachodniopomorskie</option>
    </select><br><br>

    <button type="submit"class="button1">Dodaj klienta</button>
    <button type="reset" class="button1">Reset</button>
    <br>
    <center><button type='button' style='margin-top: 20px;' class='button3'><a href='wypozyczenie.php'>Powrót do wypożyczeń</a></button></center>
</form></center>
</div>
</div>
</div>

<footer>
<div class="container">
<h1>&#169;2024 Paweł Bakuła, Jakub Pendowski</h1>
</div>
</footer>
    </body>
</html>