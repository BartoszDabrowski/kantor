-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Cze 12, 2023 at 06:20 PM
-- Wersja serwera: 10.4.28-MariaDB
-- Wersja PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rekrutacja`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `currencies`
--

CREATE TABLE `currencies` (
  `curr_id` int(11) NOT NULL,
  `currency` varchar(20) NOT NULL,
  `code` varchar(20) NOT NULL,
  `bid` float NOT NULL,
  `ask` float NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`curr_id`, `currency`, `code`, `bid`, `ask`, `date`) VALUES
(235, 'dolar amerykański', 'USD', 4.1237, 4.2071, '2023-06-11'),
(236, 'dolar australijski', 'AUD', 2.7677, 2.8237, '2023-06-11'),
(237, 'dolar kanadyjski', 'CAD', 3.0807, 3.1429, '2023-06-11'),
(238, 'euro', 'EUR', 4.4277, 4.5171, '2023-06-11'),
(239, 'forint (Węgry)', 'HUF', 0.012024, 0.012266, '2023-06-11'),
(240, 'frank szwajcarski', 'CHF', 4.5592, 4.6514, '2023-06-11'),
(241, 'funt szterling', 'GBP', 5.1538, 5.258, '2023-06-11'),
(242, 'jen (Japonia)', 'JPY', 0.029656, 0.030256, '2023-06-11'),
(243, 'korona czeska', 'CZK', 0.1875, 0.1913, '2023-06-11'),
(244, 'korona duńska', 'DKK', 0.5943, 0.6063, '2023-06-11'),
(245, 'korona norweska', 'NOK', 0.3752, 0.3828, '2023-06-11'),
(246, 'korona szwedzka', 'SEK', 0.3811, 0.3887, '2023-06-11'),
(247, 'SDR (MFW)', 'XDR', 5.5086, 5.6198, '2023-06-11'),
(313, 'dolar amerykański', 'USD', 4.0864, 4.169, '2023-06-12'),
(314, 'dolar australijski', 'AUD', 2.7526, 2.8082, '2023-06-12'),
(315, 'dolar kanadyjski', 'CAD', 3.0664, 3.1284, '2023-06-12'),
(316, 'euro', 'EUR', 4.401, 4.49, '2023-06-12'),
(317, 'forint (Węgry)', 'HUF', 0.011945, 0.012187, '2023-06-12'),
(318, 'frank szwajcarski', 'CHF', 4.5318, 4.6234, '2023-06-12'),
(319, 'funt szterling', 'GBP', 5.1384, 5.2422, '2023-06-12'),
(320, 'jen (Japonia)', 'JPY', 0.029287, 0.029879, '2023-06-12'),
(321, 'korona czeska', 'CZK', 0.1857, 0.1895, '2023-06-12'),
(322, 'korona duńska', 'DKK', 0.5906, 0.6026, '2023-06-12'),
(323, 'korona norweska', 'NOK', 0.3789, 0.3865, '2023-06-12'),
(324, 'korona szwedzka', 'SEK', 0.3774, 0.385, '2023-06-12'),
(325, 'SDR (MFW)', 'XDR', 5.4519, 5.5621, '2023-06-12');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `transactions`
--

CREATE TABLE `transactions` (
  `from_currency` varchar(20) NOT NULL,
  `to_currency` varchar(20) NOT NULL,
  `from_ammount` float NOT NULL,
  `to_ammount` float NOT NULL,
  `exchange` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`curr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `curr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
