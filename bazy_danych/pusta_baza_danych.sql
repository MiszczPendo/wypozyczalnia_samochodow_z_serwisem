-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 17, 2024 at 09:00 PM
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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `marki`
--

CREATE TABLE `marki` (
  `id_marka` int(11) NOT NULL,
  `Marka_nazwa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `usterki`
--

CREATE TABLE `usterki` (
  `id_usterki` int(11) NOT NULL,
  `Nazwa_Usterki` varchar(255) NOT NULL,
  `Koszt_usterki` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wypożyczenia_auta`
--

CREATE TABLE `wypożyczenia_auta` (
  `id_auta` int(11) NOT NULL,
  `id_wypożyczenia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id_adres` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `auta`
--
ALTER TABLE `auta`
  MODIFY `id_auta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `klienci`
--
ALTER TABLE `klienci`
  MODIFY `id_klient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marki`
--
ALTER TABLE `marki`
  MODIFY `id_marka` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modele`
--
ALTER TABLE `modele`
  MODIFY `id_model` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `opłaty`
--
ALTER TABLE `opłaty`
  MODIFY `id_opłaty` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serwisy`
--
ALTER TABLE `serwisy`
  MODIFY `id_serwis` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usterki`
--
ALTER TABLE `usterki`
  MODIFY `id_usterki` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wypożyczenia`
--
ALTER TABLE `wypożyczenia`
  MODIFY `id_wypożyczenia` int(11) NOT NULL AUTO_INCREMENT;

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
