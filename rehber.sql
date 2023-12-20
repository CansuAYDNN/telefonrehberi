-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2023 at 11:51 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rehber`
--

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `url`) VALUES
(1, 'http://localhost/rehber');

-- --------------------------------------------------------

--
-- Table structure for table `liste`
--

CREATE TABLE `liste` (
  `id` int(11) NOT NULL,
  `isim` text NOT NULL,
  `numara` text NOT NULL,
  `dogumtarihi` text NOT NULL,
  `notlar` text NOT NULL,
  `resim` text NOT NULL,
  `durum` varchar(50) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Dumping data for table `liste`
--

INSERT INTO `liste` (`id`, `isim`, `numara`, `dogumtarihi`, `notlar`, `resim`, `durum`) VALUES
(39, 'Ahmet Yılmaz', '555 101 11 11', '1985-01-01', 'Not 1', 'assets/img/658191819a2f0.png', '1'),
(40, 'Elif Kaya', '555 102 22 22', '1990-02-02', 'Not 2', 'assets/img/658191819a2f0.png', '1'),
(41, 'Mehmet Öz', '555 103 33 33', '1980-03-03', 'Not 3', 'assets/img/658191819a2f0.png', '1'),
(42, 'Ayşe Demir', '555 104 44 44', '1975-04-04', 'Not 4', 'assets/img/658191819a2f0.png', '1'),
(43, 'Oğuz Arslan', '555 105 55 55', '2000-05-05', 'Not 5', 'assets/img/658191819a2f0.png', '1'),
(44, 'Kemal Sunal', '555 106 66 66', '1982-06-06', 'Not 6', 'assets/img/658191819a2f0.png', '1'),
(45, 'Zeynep Bakşi', '555 107 77 77', '1992-07-07', 'Not 7', 'assets/img/658191819a2f0.png', '1'),
(46, 'Murat Yıldırım', '555 108 88 88', '1988-08-08', 'Not 8', 'assets/img/658191819a2f0.png', '1'),
(47, 'Esra Erol', '555 109 99 99', '1979-09-09', 'Not 9', 'assets/img/658191819a2f0.png', '1'),
(48, 'Can Yaman', '555 110 00 00', '1991-10-10', 'Not 10', 'assets/img/658191819a2f0.png', '1'),
(49, 'Demet Özdemir', '555 111 01 01', '1993-11-11', 'Not 11', 'assets/img/658191819a2f0.png', '1'),
(50, 'Kıvanç Tatlıtuğ', '555 112 02 02', '1983-12-12', 'Not 12', 'assets/img/658191819a2f0.png', '1'),
(51, 'Beren Saat', '555 113 03 03', '1984-01-13', 'Not 13', 'assets/img/658191819a2f0.png', '1'),
(52, 'Kenan İmirzalıoğlu', '555 114 04 04', '1974-02-14', 'Not 14', 'assets/img/658191819a2f0.png', '1'),
(53, 'Tarkan Tevetoğlu', '555 115 05 05', '1972-03-15', 'Not 15', 'assets/img/658191819a2f0.png', '1'),
(54, 'Sibel Can', '555 116 06 06', '1970-04-16', 'Not 16', 'assets/img/658191819a2f0.png', '1'),
(55, 'Ajda Pekkan', '555 117 07 07', '1946-05-17', 'Not 17', 'assets/img/658191819a2f0.png', '1'),
(56, 'Sezen Aksu', '555 118 08 08', '1954-06-18', 'Not 18', 'assets/img/658191819a2f0.png', '1'),
(57, 'Barış Manço', '555 119 09 09', '1943-07-19', 'Not 19', 'assets/img/658191819a2f0.png', '1'),
(58, 'Cem Yılmaz', '555 120 10 10', '1973-08-20', 'Not 20', 'assets/img/658191819a2f0.png', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `liste`
--
ALTER TABLE `liste`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `liste`
--
ALTER TABLE `liste`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
