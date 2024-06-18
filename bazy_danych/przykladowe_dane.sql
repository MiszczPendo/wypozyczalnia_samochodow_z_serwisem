-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 18, 2024 at 12:09 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wypożyczalnia_samochodów_z_serwisem`
--
CREATE DATABASE IF NOT EXISTS `wypożyczalnia_samochodów_z_serwisem` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `wypożyczalnia_samochodów_z_serwisem`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `adresy`
--

CREATE TABLE `adresy` (
  `id_adres` int(11) NOT NULL,
  `Adres_Miasto` varchar(255) NOT NULL,
  `Adres_Ulica` varchar(255) NOT NULL,
  `Adres_NumerDomu` varchar(10) NOT NULL,
  `Adres_NumerMieszkania` varchar(10) DEFAULT NULL,
  `Adres_Wojewodztwo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `adresy`
--

INSERT INTO `adresy` (`id_adres`, `Adres_Miasto`, `Adres_Ulica`, `Adres_NumerDomu`, `Adres_NumerMieszkania`, `Adres_Wojewodztwo`) VALUES
(1, 'Warszawa', 'Krakowskie Przedmieście', '15', NULL, 'Mazowieckie'),
(2, 'Kraków', 'Floriańska', '12', '5', 'Małopolskie'),
(3, 'Gdańsk', 'Długa', '7', '2', 'Pomorskie'),
(4, 'Poznań', 'Święty Marcin', '10', NULL, 'Wielkopolskie'),
(5, 'Wrocław', 'Rynek', '3', NULL, 'Dolnośląskie'),
(6, 'Szczecin', 'Wojska Polskiego', '2', NULL, 'Zachodniopomorskie'),
(7, 'Łódź', 'Piotrkowska', '20', '10', 'Łódzkie'),
(8, 'Katowice', 'Mariacka', '5', '7', 'Śląskie'),
(9, 'Lublin', 'Krakowskie Przedmieście', '9', '2', 'Lubelskie'),
(10, 'Bydgoszcz', 'Gdańska', '13', NULL, 'Kujawsko-Pomorskie'),
(11, 'Rzeszów', '3 Maja', '21', '5', 'Podkarpackie'),
(12, 'Toruń', 'Żeglarska', '8', NULL, 'Kujawsko-Pomorskie'),
(13, 'Opole', 'Ozimska', '15', NULL, 'Opolskie'),
(14, 'Gorzów Wielkopolski', 'Chrobrego', '10', NULL, 'Lubuskie'),
(15, 'Kielce', 'Sienkiewicza', '12', '7', 'Świętokrzyskie'),
(16, 'Zielona Góra', 'Batorego', '7', '2', 'Lubuskie'),
(17, 'Olsztyn', 'Kościuszki', '11', NULL, 'Warmińsko-Mazurskie'),
(18, 'Białystok', 'Branickiego', '9', '1', 'Podlaskie'),
(19, 'Częstochowa', 'Aleja Najświętszej Maryi Panny', '5', NULL, 'Śląskie'),
(20, 'Radom', 'Żeromskiego', '14', '4', 'Mazowieckie'),
(21, 'Sulejówek', 'Wesoła', '15', NULL, 'Mazowieckie'),
(22, 'Bączki', 'Łąkowa', '12', NULL, 'Opolskie'),
(23, 'Bączki', 'Łąkowa', '13', NULL, 'podkarpackie'),
(24, '', '', '', '', ''),
(25, 'Halinów', 'Święta', '11', '', 'Mazowieckie'),
(26, 'Halinów', 'Nieudaczna', '69', '', 'Podlaskie');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `auta`
--

CREATE TABLE `auta` (
  `id_auta` int(11) NOT NULL,
  `auto_vin` varchar(20) NOT NULL,
  `auto_kolor` varchar(50) DEFAULT NULL,
  `auto_stan` varchar(50) NOT NULL,
  `wypozyczenie_cena_na_dzien` int(11) NOT NULL,
  `id_model` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `auta`
--

INSERT INTO `auta` (`id_auta`, `auto_vin`, `auto_kolor`, `auto_stan`, `wypozyczenie_cena_na_dzien`, `id_model`) VALUES
(1, 'JTDBR32E502062548', 'Czarny', 'Dostępny', 700, 1),
(2, '1FAHP3F24CL378984', 'Niebieski', 'Dostępny', 500, 2),
(3, '5UXCR4C50BL718764', 'Biały', 'Dostępny', 1000, 3),
(4, 'WAUZZZ8K8DA129876', 'Czerwony', 'Dostępny', 900, 4),
(5, 'WDBRF40J73F331156', 'Srebrny', 'Dostępny', 1500, 5),
(6, 'WVWEV7AJ0BW000351', 'Zielony', 'Dostępny', 500, 6),
(7, 'VF1BB3A0482198765', 'Niebieski', 'Dostępny', 700, 7),
(8, 'VF37N9HD8EL123456', 'Biały', 'Dostępny', 700, 8),
(9, 'ZFA19900006D12345', 'Czarny', 'Wypożyczony', 1300, 9),
(10, '2HGFA16578H500000', 'Szary', 'Dostępny', 1300, 10),
(11, '1HGCM82633A004352', 'Złoty', 'Dostępny', 1300, 11),
(12, '4T1BE32KX2U123456', 'Szary', 'Dostępny', 2000, 12),
(13, '1FAHP2E85BG114785', 'Bordowy', 'Wypożyczony', 600, 13),
(14, '3VWDP7AJ4EM123456', 'Fioletowy', 'Dostępny', 1300, 14),
(15, 'JN8AS5MT5DW601234', 'Pomarańczowy', 'Dostępny', 2200, 15),
(16, '5J6RM4H52EL102345', 'Brązowy', 'Dostępny', 550, 16),
(17, '1G1PC5SB4E7256789', 'Czarny', 'Dostępny', 600, 17),
(18, 'KMHDH4AE1CU234567', 'Biały', 'Dostępny', 3300, 18),
(19, '3N1AB7AP3KY234567', 'Niebieski', 'Dostępny', 2700, 19),
(20, '2T3ZF4DV3BW123456', 'Zielony', 'Wypożyczony', 2300, 20),
(21, 'WBA3A5C56FP123456', 'Srebrny', 'Dostępny', 900, 21),
(22, '1C4RJEBG3EC123456', 'Czerwony', 'Dostępny', 1100, 22),
(23, '5FNYF4H50FB123456', 'Fioletowy', 'Wypożyczony', 1600, 23),
(24, 'JHMGE8H51BC123456', 'Złoty', 'Dostępny', 2300, 24),
(25, '2C3CCARG8EH123456', 'Bordowy', 'Dostępny', 2700, 25),
(26, '5XYKTDA22CG123456', 'Pomarańczowy', 'Wypożyczony', 2700, 26),
(27, '3KPC24A34KE123456', 'Szary', 'Dostępny', 3300, 27),
(28, 'WVWMP7AN2EE123456', 'Brązowy', 'Dostępny', 350, 28),
(29, '1G11C5SL0FF123456', 'Czarny', 'Dostępny', 600, 29),
(30, '5N1AR2MN2EC123456', 'Biały', 'Wypożyczony', 800, 30);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `klienci`
--

CREATE TABLE `klienci` (
  `id_klient` int(11) NOT NULL,
  `Klient_Nazwisko` varchar(255) NOT NULL,
  `Klient_Imie` varchar(255) NOT NULL,
  `Klient_NIP` varchar(20) DEFAULT NULL,
  `Klient_NrTelefonu` varchar(20) NOT NULL,
  `Klient_IdAdres` int(11) NOT NULL,
  `Klient_AdresEmail` varchar(255) NOT NULL,
  `Klient_PESEL` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `klienci`
--

INSERT INTO `klienci` (`id_klient`, `Klient_Nazwisko`, `Klient_Imie`, `Klient_NIP`, `Klient_NrTelefonu`, `Klient_IdAdres`, `Klient_AdresEmail`, `Klient_PESEL`) VALUES
(1, 'Wiśniewska', 'Maria', '1234567890', '514-123-456', 1, 'maria.wisniewska@example.com', '45678901234'),
(2, 'Zieliński', 'Tomasz', NULL, '569-234-567', 2, 'tomasz.zielinski@example.com', '56789012345'),
(3, 'Kaczmarek', 'Agnieszka', '3456789012', '690-345-678', 3, 'agnieszka.kaczmarek@example.com', '67890123456'),
(4, 'Mazur', 'Jacek', NULL, '789-456-789', 4, 'jacek.mazur@example.com', '78901234567'),
(5, 'Wojciechowska', 'Katarzyna', NULL, '743-567-890', 5, 'katarzyna.wojciechowska@example.com', '89012345678'),
(6, 'Kamiński', 'Michał', NULL, '507-678-901', 6, 'michal.kaminski@example.com', '90123456789'),
(7, 'Dąbrowska', 'Joanna', NULL, '567-789-012', 7, 'joanna.dabrowska@example.com', '01234567890'),
(8, 'Piotrowski', 'Robert', NULL, '625-890-123', 8, 'robert.piotrowski@example.com', '12345678901'),
(9, 'Szymańska', 'Ewa', NULL, '647-901-234', 9, 'ewa.szymanska@example.com', '23456789012'),
(10, 'Kowalczyk', 'Mateusz', '0123456789', '598-012-345', 10, 'mateusz.kowalczyk@example.com', '34567890123'),
(12, 'Miński', 'Paweł', NULL, '514-368-963', 21, 'p.minski@wp.pl', '12345678912'),
(13, 'Herman', 'Jakub', '3213213213', '577-596-889', 22, 'herman@pol.com', '12345678912'),
(14, 'Herman', 'Paweł', '3213213213', '577-566-889', 23, 'herman@pol.com', '12345678912'),
(15, 'Polkowski', 'Maciek', '3213213213', '557-566-889', 24, '', ''),
(16, 'Paweł', 'Trąbal', '', '213-769-420', 25, 'trabal@onet.pl', '12345678912'),
(17, 'Grzegorz', 'Parol', '', '213-721-370', 26, 'parol@phub.com', '12345678912');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `marki`
--

CREATE TABLE `marki` (
  `id_marka` int(11) NOT NULL,
  `Marka_nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marki`
--

INSERT INTO `marki` (`id_marka`, `Marka_nazwa`) VALUES
(1, 'Toyota'),
(2, 'Ford'),
(3, 'BMW'),
(4, 'Audi'),
(5, 'Mercedes'),
(6, 'Alfa Romeo'),
(7, 'Mclaren'),
(8, 'Dodge'),
(9, 'Lamborghini'),
(10, 'Subaru');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `modele`
--

CREATE TABLE `modele` (
  `id_model` int(11) NOT NULL,
  `Model_nazwa` varchar(255) NOT NULL,
  `id_marka` int(11) NOT NULL,
  `Model_rocznik` varchar(10) NOT NULL,
  `Model_pojemnosc_silnika` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modele`
--

INSERT INTO `modele` (`id_model`, `Model_nazwa`, `id_marka`, `Model_rocznik`, `Model_pojemnosc_silnika`) VALUES
(1, 'Supra', 1, '1998', 2),
(2, 'Supra', 1, '2020', 3),
(3, 'Mustang Mach-E', 2, '2021', 0),
(4, 'Mustang GT', 2, '2018', 5),
(5, 'Mustang Shelby GT500', 2, '2020', 5.8),
(6, 'Ranger Raptor', 2, '2019', 2),
(7, 'M4 GTS', 3, '2016', 3),
(8, 'X6 M', 3, '2015', 4.4),
(9, 'M5', 3, '2018', 4.4),
(10, 'RS 6 Avant', 4, '2021', 4),
(11, 'RS7 Sportback', 4, '2021', 4),
(12, 'R8 V10 plus', 4, '2016', 5.2),
(13, 'G 65 AMG', 5, '2019', 6),
(14, 'SL 63', 5, '2021', 4),
(15, 'AMG CLK GTR', 5, '2020', 6.9),
(16, '4C', 6, '2018', 1.8),
(17, 'Giulia Quadrifoglio', 6, '2019', 2.9),
(18, 'F1', 7, '2020', 6.1),
(19, 'P1', 7, '2019', 3.8),
(20, 'Senna', 7, '2021', 4),
(21, 'Charger R/T', 8, '1969', 6.2),
(22, 'Viper ACR', 8, '2016', 8.4),
(23, 'Challenger SRT DEMON', 8, '2018', 6.2),
(24, 'Sesto Elemento', 9, '2011', 5.2),
(25, 'Huracan STO', 9, '2020', 5.2),
(26, 'Veneno', 9, '2013', 6.5),
(27, 'SVJ', 9, '2018', 6.5),
(28, 'WRX STI', 10, '2011', 2),
(29, 'BRZ', 10, '2022', 2),
(30, 'Impreza 22B-STI', 10, '1998', 2.2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `opłaty`
--

CREATE TABLE `opłaty` (
  `id_opłaty` int(11) NOT NULL,
  `id_wypożyczenia` int(11) NOT NULL,
  `łączna_cena` int(11) NOT NULL,
  `rodzaj_płatności` varchar(50) NOT NULL,
  `dodatkowe_opłaty` int(11) DEFAULT NULL,
  `dodatkowe_opłaty_opis` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `opłaty`
--

INSERT INTO `opłaty` (`id_opłaty`, `id_wypożyczenia`, `łączna_cena`, `rodzaj_płatności`, `dodatkowe_opłaty`, `dodatkowe_opłaty_opis`) VALUES
(1, 1, 300, 'Karta kredytowa', 0, NULL),
(2, 2, 600, 'Przelew', 0, NULL),
(3, 3, 750, 'Gotówka', 0, NULL),
(4, 4, 330, 'Karta kredytowa', 0, NULL),
(5, 5, 390, 'Przelew', 0, NULL),
(6, 6, 700, 'Gotówka', 0, NULL),
(7, 7, 345, 'Karta kredytowa', 0, NULL),
(8, 8, 500, 'Przelew', 0, NULL),
(9, 9, 405, 'Gotówka', 0, NULL),
(15, 24, 1000, 'Gotówka', 0, ''),
(20, 25, 500, 'Przelew', 0, ''),
(21, 26, 700, 'Gotówka', 0, ''),
(59, 27, 1300, 'Gotówka', 0, ''),
(60, 28, 900, 'Gotówka', 0, ''),
(61, 29, 1300, 'Gotówka', 0, ''),
(62, 30, 700, 'Gotówka', 0, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `serwisy`
--

CREATE TABLE `serwisy` (
  `id_serwis` int(11) NOT NULL,
  `id_auta` int(11) NOT NULL,
  `termin_oddania_do_naprawy` date NOT NULL,
  `termin_odbioru_z_naprawy` date DEFAULT NULL,
  `id_usterki` int(11) DEFAULT NULL,
  `status_naprawy` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `serwisy`
--

INSERT INTO `serwisy` (`id_serwis`, `id_auta`, `termin_oddania_do_naprawy`, `termin_odbioru_z_naprawy`, `id_usterki`, `status_naprawy`) VALUES
(1, 17, '2024-05-01', '2024-05-02', 1, 'Zakończona'),
(2, 17, '2024-05-03', '2024-06-17', 2, 'Zakończona'),
(3, 17, '2024-05-06', '2024-05-07', 3, 'Zakończona'),
(4, 17, '2024-05-08', '2024-05-09', 4, 'Zakończona'),
(5, 17, '2024-05-10', '2024-05-11', 5, 'Zakończona'),
(6, 16, '2024-05-12', '2024-06-17', 6, 'Zakończona'),
(7, 1, '2024-05-15', '2024-05-16', 7, 'Zakończona'),
(8, 5, '2024-05-17', '2024-05-19', 8, 'Zakończona'),
(9, 7, '2024-05-20', '2024-05-21', 9, 'Zakończona'),
(10, 10, '2024-05-22', '2024-05-23', 10, 'Zakończona'),
(11, 1, '2024-06-16', '2024-06-16', 3, 'Zakończona'),
(12, 1, '2024-06-17', '2024-06-17', 1, 'Zakończona'),
(13, 2, '2024-06-17', '2024-06-17', 1, 'Zakończona'),
(14, 22, '2024-06-17', '2024-06-17', 6, 'Zakończona'),
(15, 28, '2024-06-17', '2024-06-17', 2, 'Zakończona'),
(16, 4, '2024-06-17', '2024-06-17', 4, 'Zakończona'),
(17, 15, '2024-06-17', '2024-06-17', 3, 'Zakończona'),
(18, 2, '2024-06-17', '2024-06-17', 1, 'Zakończona'),
(19, 24, '2024-06-17', '2024-06-17', 3, 'Zakończona');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `usterki`
--

CREATE TABLE `usterki` (
  `id_usterki` int(11) NOT NULL,
  `Nazwa_Usterki` varchar(255) NOT NULL,
  `Koszt_usterki` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usterki`
--

INSERT INTO `usterki` (`id_usterki`, `Nazwa_Usterki`, `Koszt_usterki`) VALUES
(1, 'Wymiana oleju', 150),
(2, 'Naprawa hamulców', 500),
(3, 'Wymiana opon', 300),
(4, 'Naprawa klimatyzacji', 700),
(5, 'Wymiana świec zapłonowych', 200),
(6, 'Naprawa silnika', 1500),
(7, 'Wymiana rozrządu', 800),
(8, 'Naprawa skrzyni biegów', 1000),
(9, 'Wymiana filtrów', 100),
(10, 'Regulacja zawieszenia', 400);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypożyczenia`
--

CREATE TABLE `wypożyczenia` (
  `id_wypożyczenia` int(11) NOT NULL,
  `id_klient` int(11) NOT NULL,
  `data_wypożyczenia` date NOT NULL,
  `data_oddania` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wypożyczenia`
--

INSERT INTO `wypożyczenia` (`id_wypożyczenia`, `id_klient`, `data_wypożyczenia`, `data_oddania`) VALUES
(1, 1, '2024-05-10', '2024-05-12'),
(2, 2, '2024-05-15', '2024-05-20'),
(3, 3, '2024-05-21', '2024-05-25'),
(4, 4, '2024-05-26', '2024-05-28'),
(5, 5, '2024-05-29', '2024-05-31'),
(6, 6, '2024-06-01', '2024-06-05'),
(7, 7, '2024-06-06', '2024-06-08'),
(8, 8, '2024-06-09', '2024-06-12'),
(9, 9, '2024-06-13', '2024-06-14'),
(24, 4, '2024-06-16', '2024-06-16'),
(25, 4, '2024-06-16', '2024-06-16'),
(26, 4, '2024-06-16', '2024-06-16'),
(27, 1, '2024-06-17', '2024-06-17'),
(28, 14, '2024-06-18', '2024-06-18'),
(29, 13, '2024-06-18', '2024-06-18'),
(30, 13, '2024-06-18', '2024-06-18');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypożyczenia_auta`
--

CREATE TABLE `wypożyczenia_auta` (
  `id_auta` int(11) NOT NULL,
  `id_wypożyczenia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wypożyczenia_auta`
--

INSERT INTO `wypożyczenia_auta` (`id_auta`, `id_wypożyczenia`) VALUES
(1, 1),
(1, 26),
(2, 2),
(2, 25),
(3, 3),
(3, 24),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(7, 30),
(8, 8),
(9, 9),
(10, 29),
(14, 27),
(21, 28);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `adresy`
--
ALTER TABLE `adresy`
  ADD PRIMARY KEY (`id_adres`);

--
-- Indeksy dla tabeli `auta`
--
ALTER TABLE `auta`
  ADD PRIMARY KEY (`id_auta`),
  ADD KEY `id_model` (`id_model`);

--
-- Indeksy dla tabeli `klienci`
--
ALTER TABLE `klienci`
  ADD PRIMARY KEY (`id_klient`),
  ADD UNIQUE KEY `Klient_IdAdres` (`Klient_IdAdres`);

--
-- Indeksy dla tabeli `marki`
--
ALTER TABLE `marki`
  ADD PRIMARY KEY (`id_marka`);

--
-- Indeksy dla tabeli `modele`
--
ALTER TABLE `modele`
  ADD PRIMARY KEY (`id_model`),
  ADD KEY `id_marka` (`id_marka`);

--
-- Indeksy dla tabeli `opłaty`
--
ALTER TABLE `opłaty`
  ADD PRIMARY KEY (`id_opłaty`),
  ADD KEY `id_wypożyczenia` (`id_wypożyczenia`);

--
-- Indeksy dla tabeli `serwisy`
--
ALTER TABLE `serwisy`
  ADD PRIMARY KEY (`id_serwis`),
  ADD KEY `id_usterki` (`id_usterki`),
  ADD KEY `id_auta` (`id_auta`);

--
-- Indeksy dla tabeli `usterki`
--
ALTER TABLE `usterki`
  ADD PRIMARY KEY (`id_usterki`);

--
-- Indeksy dla tabeli `wypożyczenia`
--
ALTER TABLE `wypożyczenia`
  ADD PRIMARY KEY (`id_wypożyczenia`),
  ADD KEY `id_klient` (`id_klient`);

--
-- Indeksy dla tabeli `wypożyczenia_auta`
--
ALTER TABLE `wypożyczenia_auta`
  ADD PRIMARY KEY (`id_auta`,`id_wypożyczenia`),
  ADD KEY `id_auta` (`id_auta`),
  ADD KEY `id_wypożyczenia` (`id_wypożyczenia`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adresy`
--
ALTER TABLE `adresy`
  MODIFY `id_adres` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `auta`
--
ALTER TABLE `auta`
  MODIFY `id_auta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `marki`
--
ALTER TABLE `marki`
  MODIFY `id_marka` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `modele`
--
ALTER TABLE `modele`
  MODIFY `id_model` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `opłaty`
--
ALTER TABLE `opłaty`
  MODIFY `id_opłaty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `serwisy`
--
ALTER TABLE `serwisy`
  MODIFY `id_serwis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `usterki`
--
ALTER TABLE `usterki`
  MODIFY `id_usterki` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `wypożyczenia`
--
ALTER TABLE `wypożyczenia`
  MODIFY `id_wypożyczenia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auta`
--
ALTER TABLE `auta`
  ADD CONSTRAINT `auta_ibfk_1` FOREIGN KEY (`id_model`) REFERENCES `modele` (`id_model`);

--
-- Constraints for table `klienci`
--
ALTER TABLE `klienci`
  ADD CONSTRAINT `klienci_ibfk_1` FOREIGN KEY (`Klient_IdAdres`) REFERENCES `adresy` (`id_adres`);

--
-- Constraints for table `modele`
--
ALTER TABLE `modele`
  ADD CONSTRAINT `modele_ibfk_1` FOREIGN KEY (`id_marka`) REFERENCES `marki` (`id_marka`);

--
-- Constraints for table `opłaty`
--
ALTER TABLE `opłaty`
  ADD CONSTRAINT `opłaty_ibfk_1` FOREIGN KEY (`id_wypożyczenia`) REFERENCES `wypożyczenia` (`id_wypożyczenia`);

--
-- Constraints for table `serwisy`
--
ALTER TABLE `serwisy`
  ADD CONSTRAINT `serwisy_ibfk_1` FOREIGN KEY (`id_usterki`) REFERENCES `usterki` (`id_usterki`),
  ADD CONSTRAINT `serwisy_ibfk_3` FOREIGN KEY (`id_auta`) REFERENCES `auta` (`id_auta`);

--
-- Constraints for table `wypożyczenia`
--
ALTER TABLE `wypożyczenia`
  ADD CONSTRAINT `wypożyczenia_ibfk_1` FOREIGN KEY (`id_klient`) REFERENCES `klienci` (`id_klient`);

--
-- Constraints for table `wypożyczenia_auta`
--
ALTER TABLE `wypożyczenia_auta`
  ADD CONSTRAINT `wypożyczenia_auta_ibfk_1` FOREIGN KEY (`id_wypożyczenia`) REFERENCES `wypożyczenia` (`id_wypożyczenia`),
  ADD CONSTRAINT `wypożyczenia_auta_ibfk_2` FOREIGN KEY (`id_auta`) REFERENCES `auta` (`id_auta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
