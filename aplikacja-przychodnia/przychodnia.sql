-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 29 Maj 2022, 20:02
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Baza danych: `przychodnia`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `gabinet`
--

CREATE TABLE `gabinet` (
  `id_gabinet` int(11) NOT NULL,
  `nr_gabinetu` varchar(5) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- RELACJE DLA TABELI `gabinet`:
--

--
-- Zrzut danych tabeli `gabinet`
--

INSERT INTO `gabinet` (`id_gabinet`, `nr_gabinetu`) VALUES
(1, '1'),
(2, '12'),
(3, '31'),
(4, '8');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `lekarz`
--

CREATE TABLE `lekarz` (
  `id_lekarz` int(11) NOT NULL,
  `tytul` varchar(20) COLLATE utf8mb4_polish_ci NOT NULL,
  `imie` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `specjalizacja` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `login` varchar(15) COLLATE utf8mb4_polish_ci NOT NULL,
  `haslo` varchar(50) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- RELACJE DLA TABELI `lekarz`:
--

--
-- Zrzut danych tabeli `lekarz`
--

INSERT INTO `lekarz` (`id_lekarz`, `tytul`, `imie`, `nazwisko`, `specjalizacja`, `login`, `haslo`) VALUES
(1, 'Lek. Med.', 'Kamil', 'Lato', 'kardiolog', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997'),
(2, 'Lekarz', 'Jakub', 'Bednarczyk', 'pediatra', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pacjent`
--

CREATE TABLE `pacjent` (
  `id_pacjent` int(11) NOT NULL,
  `imie` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `nazwisko` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `pesel` varchar(11) COLLATE utf8mb4_polish_ci NOT NULL,
  `miejscowosc` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `pocztowy` varchar(6) COLLATE utf8mb4_polish_ci NOT NULL,
  `ulica` varchar(30) COLLATE utf8mb4_polish_ci NOT NULL,
  `nr_domu` varchar(5) COLLATE utf8mb4_polish_ci NOT NULL,
  `nr_mieszkania` varchar(5) COLLATE utf8mb4_polish_ci NOT NULL,
  `telefon` varchar(11) COLLATE utf8mb4_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- RELACJE DLA TABELI `pacjent`:
--

--
-- Zrzut danych tabeli `pacjent`
--

INSERT INTO `pacjent` (`id_pacjent`, `imie`, `nazwisko`, `pesel`, `miejscowosc`, `pocztowy`, `ulica`, `nr_domu`, `nr_mieszkania`, `telefon`) VALUES
(1, 'Bartek', 'Barciś', '10101010101', 'Kraków', '21-231', 'Nowa', '2', '12', '321-321-321'),
(2, 'Paweł', 'Nowak', '00000000001', 'Poznań', '02-234', 'Długa', '2', '53', '594-304-329');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `wizyty`
--

CREATE TABLE `wizyty` (
  `id_wizyty` int(11) NOT NULL,
  `id_pacjent` int(11) NOT NULL,
  `id_lekarz` int(11) NOT NULL,
  `daty` date NOT NULL,
  `godzina` time NOT NULL,
  `id_gabinet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_polish_ci;

--
-- RELACJE DLA TABELI `wizyty`:
--   `id_pacjent`
--       `pacjent` -> `id_pacjent`
--   `id_gabinet`
--       `gabinet` -> `id_gabinet`
--   `id_lekarz`
--       `lekarz` -> `id_lekarz`
--

--
-- Zrzut danych tabeli `wizyty`
--

INSERT INTO `wizyty` (`id_wizyty`, `id_pacjent`, `id_lekarz`, `daty`, `godzina`, `id_gabinet`) VALUES
(1, 1, 2, '2022-07-10', '01:49:00', 4),
(2, 1, 2, '2022-05-29', '22:46:00', 3);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `gabinet`
--
ALTER TABLE `gabinet`
  ADD PRIMARY KEY (`id_gabinet`);

--
-- Indeksy dla tabeli `lekarz`
--
ALTER TABLE `lekarz`
  ADD PRIMARY KEY (`id_lekarz`);

--
-- Indeksy dla tabeli `pacjent`
--
ALTER TABLE `pacjent`
  ADD PRIMARY KEY (`id_pacjent`);

--
-- Indeksy dla tabeli `wizyty`
--
ALTER TABLE `wizyty`
  ADD PRIMARY KEY (`id_wizyty`),
  ADD KEY `id_pacjent` (`id_pacjent`),
  ADD KEY `id_lekarz` (`id_lekarz`),
  ADD KEY `id_gabinet` (`id_gabinet`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `gabinet`
--
ALTER TABLE `gabinet`
  MODIFY `id_gabinet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `lekarz`
--
ALTER TABLE `lekarz`
  MODIFY `id_lekarz` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `pacjent`
--
ALTER TABLE `pacjent`
  MODIFY `id_pacjent` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `wizyty`
--
ALTER TABLE `wizyty`
  MODIFY `id_wizyty` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `wizyty`
--
ALTER TABLE `wizyty`
  ADD CONSTRAINT `wizyty_ibfk_1` FOREIGN KEY (`id_pacjent`) REFERENCES `pacjent` (`id_pacjent`),
  ADD CONSTRAINT `wizyty_ibfk_2` FOREIGN KEY (`id_gabinet`) REFERENCES `gabinet` (`id_gabinet`),
  ADD CONSTRAINT `wizyty_ibfk_3` FOREIGN KEY (`id_lekarz`) REFERENCES `lekarz` (`id_lekarz`);
COMMIT;
