<html>
    <head>
        <title>Informacje o projekcie</title>
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
            <div class="costma1">
            <h1>Informacje o projekcie</h1>
            
            <h2>Przyjęte założenia działania wypożyczalni:</h2>
            <ol>
                <li>Jeden klient może wypożyczyć wiele samochodów.<br>Wypożyczenie wielu samochodów odbywa się poprzez złożenie wielu zamówień. To samo tyczy się zwrotu wypożyczonych samochodów.</li>
                <li>Nie mogą istnieć dwa identyczne modele.<br>Założyliśmy, że nie mogą istnieć dwa modele o identycznych atrybutach. Nawet jeden inny atrybut np. rocznik rozwiązuje ten problem.</li>
                <li>Samochód może zostać wypożyczony wiele razy.<br>Jeżeli samochód został zwrócony przez klienta to znowu może zostać wypożyczony.</li>
                <li>Samochód może być serwisowany wiele razy.<br>Zakładamy, że po jakimś czasie od powrotu z naprawy samochód może ponownie potrzebować serwisu.</li>
                <li>Samochód nie może być jednocześnie wypożyczony i serwisowany.<br>Aby możliwe było wypożyczenie samochodu musi mieć on status "Dostępny", czyli nie może być on w naprawie. To samo tyczy się oddawania samochodu do serwisu.</li>
            </ol>

            <h2>Reguły poprawności:</h2>
            <p>Dodaliśmy zawężenie dziedziny poprzez odpowiedni typ pól w tabelach oraz walidację danych wprowadzanych przez użytkownika w formularzach.</p>
            
            <h2>Związki występujące pomiędzy encjami:</h2>
            <ul>
                <li>KLIENT (wymagane) (jeden do wiele) (wymagane) WYPOŻYCZENIE</li>
                <li>WYPOŻYCZENIE (wymagane) (jeden do jeden) (wymagane) OPŁATA</li>
                <li>WYPOŻYCZENIE (wymagane) (wiele do wiele) (opcjonalne) AUTA</li>
                <li>AUTO (opcjonalne) (jeden do wiele) (wymagane) SERWIS</li>
            </ul><div class="button-container">
            <button type="button" class="button3"><a href="index.php">Powrót na stronę powitalną</a></button>
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