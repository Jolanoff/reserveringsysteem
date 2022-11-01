-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 01, 2022 at 11:37 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `reserveringdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `bestellingen`
--

CREATE TABLE `bestellingen` (
  `bestelling_id` int(11) NOT NULL,
  `klant_id` int(11) NOT NULL,
  `plaats_id` int(11) NOT NULL,
  `checkin` date NOT NULL,
  `dagen` int(11) NOT NULL,
  `volwassenen` int(11) NOT NULL,
  `kinderen12` int(11) NOT NULL,
  `kinderen4` int(11) NOT NULL,
  `hond` varchar(9) NOT NULL,
  `elektriciteit` varchar(9) NOT NULL,
  `bezoekers` varchar(9) NOT NULL,
  `douche` varchar(9) NOT NULL,
  `wasmachine` varchar(9) NOT NULL,
  `wasdroger` varchar(9) NOT NULL,
  `auto` varchar(9) NOT NULL,
  `kosten` varchar(9) NOT NULL,
  `status` varchar(30) NOT NULL,
  `checkout` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bestellingen`
--

INSERT INTO `bestellingen` (`bestelling_id`, `klant_id`, `plaats_id`, `checkin`, `dagen`, `volwassenen`, `kinderen12`, `kinderen4`, `hond`, `elektriciteit`, `bezoekers`, `douche`, `wasmachine`, `wasdroger`, `auto`, `kosten`, `status`, `checkout`) VALUES
(80, 2, 2, '2022-10-28', 2, 2, 0, 0, '1', '', '1', '', '', '', '', '28', 'checked out', '2022-10-31'),
(81, 8, 5, '2022-10-19', 3, 2, 1, 0, '1', '1', '', '', '1', '', '', '64', 'checked out', '2022-10-29'),
(158, 2, 10, '2022-10-29', 1, 1, 0, 0, '', '', '', '', '', '', '', '7', 'checked in', '2022-10-30'),
(160, 1, 16, '2022-10-28', 1, 1, 0, 0, '', '', '', '', '', '', '', '9', 'checked in', '2022-10-29'),
(163, 1, 13, '2022-10-28', 3, 1, 0, 0, '', '', '', '', '', '', '', '27', 'checked in', '2022-10-31'),
(164, 1, 6, '2022-10-28', 1, 1, 0, 0, '', '', '', '', '', '', '', '9', 'checked in', '2022-10-31'),
(165, 1, 6, '2022-11-01', 1, 1, 0, 0, '', '', '', '', '', '', '', '9', 'checked in', '2022-11-04'),
(166, 1, 2, '2022-11-01', 1, 1, 0, 0, '', '', '', '', '', '', '', '7', 'checked in', '2022-11-04');

-- --------------------------------------------------------

--
-- Table structure for table `klanten`
--

CREATE TABLE `klanten` (
  `id` int(11) NOT NULL,
  `voornaam` varchar(30) NOT NULL,
  `achternaam` varchar(30) NOT NULL,
  `adres` varchar(30) NOT NULL,
  `postcode` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `telefoonNum` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `klanten`
--

INSERT INTO `klanten` (`id`, `voornaam`, `achternaam`, `adres`, `postcode`, `email`, `telefoonNum`) VALUES
(1, 'Jolan', 'Abou Zid', 'Ribeslaan 42', '2641 CK', 'jawlan.abozaid12@gmail.com', '0628898727'),
(2, 'Hassan', 'Dafis', 'Polanenlaan 48D', '7272HZ', 'hassan.dafis@gmail.com', '0622222222'),
(6, 'abdulkader', 'hritani', 'de dreef 44', '2555 CK', 'abdul.kader@gmail.com', '062225558'),
(8, 'Mans', 'alharthi', 'Ribeslaan 55', '2644 HJ', 'mans.sh@gmail.com', '0628888722');

-- --------------------------------------------------------

--
-- Table structure for table `plaatsen`
--

CREATE TABLE `plaatsen` (
  `id` int(11) NOT NULL,
  `soort_id` int(11) NOT NULL,
  `naam` varchar(30) NOT NULL,
  `bezit` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plaatsen`
--

INSERT INTO `plaatsen` (`id`, `soort_id`, `naam`, `bezit`) VALUES
(1, 1, 'A1', 'false'),
(2, 1, 'A2', 'false'),
(3, 1, 'A3', 'false'),
(4, 1, 'A4', 'true'),
(5, 2, 'B1', 'false'),
(6, 2, 'B2', 'false'),
(7, 2, 'B3', 'false'),
(8, 2, 'B4', 'false'),
(9, 3, 'C1', 'true'),
(10, 3, 'C2', 'false'),
(11, 3, 'C3', 'false'),
(12, 3, 'C4', 'false'),
(13, 4, 'D1', 'false'),
(14, 4, 'D2', 'false'),
(15, 4, 'D3', 'false'),
(16, 4, 'D4', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `soort_plaatsen`
--

CREATE TABLE `soort_plaatsen` (
  `soort_id` int(11) NOT NULL,
  `soort` varchar(33) NOT NULL,
  `prijs` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `soort_plaatsen`
--

INSERT INTO `soort_plaatsen` (`soort_id`, `soort`, `prijs`) VALUES
(1, 'Caravan of camper (kleine plaats)', '2'),
(2, 'Caravan of camper (grote plaats) ', '4'),
(3, 'Tent (kleine plaats)', '2'),
(4, 'Tent (grote plaats)', '4');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(41, 'Jolan', '1234', 'admin'),
(54, 'Berkhout', '123455', 'admin'),
(116, 'Mans', '1234', 'Medewerker');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bestellingen`
--
ALTER TABLE `bestellingen`
  ADD PRIMARY KEY (`bestelling_id`);

--
-- Indexes for table `klanten`
--
ALTER TABLE `klanten`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `plaatsen`
--
ALTER TABLE `plaatsen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `soort_plaatsen`
--
ALTER TABLE `soort_plaatsen`
  ADD PRIMARY KEY (`soort_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bestellingen`
--
ALTER TABLE `bestellingen`
  MODIFY `bestelling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `klanten`
--
ALTER TABLE `klanten`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `plaatsen`
--
ALTER TABLE `plaatsen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `soort_plaatsen`
--
ALTER TABLE `soort_plaatsen`
  MODIFY `soort_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
