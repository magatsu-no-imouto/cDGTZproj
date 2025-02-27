-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2025 at 04:50 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `engrdgtz`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerName` varchar(255) NOT NULL,
  `dateAdded` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerName`, `dateAdded`) VALUES
('VEHICLE ENERGY JAPAN', '01/01/2025'),
('PRIME PLANET ENERGY SOLUTION', '01/01/2025');

-- --------------------------------------------------------

--
-- Table structure for table `division`
--

CREATE TABLE `division` (
  `divisionName` varchar(255) NOT NULL,
  `dateAdded` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `division`
--

INSERT INTO `division` (`divisionName`, `dateAdded`) VALUES
('AUTO3', '01/01/2025'),
('AUTO5', '01/01/2025');

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `partNo` varchar(255) NOT NULL,
  `dateAdded` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`partNo`, `dateAdded`) VALUES
('JF2ASY00020AC Rev.8', '01/01/2025'),
('JF2ASY00021AE Rev.8', '01/01/2025'),
('JF2ASY00022AE Rev.7', '01/01/2025'),
('JF2ASY00023AC Rev.7', '01/01/2025');

-- --------------------------------------------------------

--
-- Table structure for table `workinst`
--

CREATE TABLE `workinst` (
  `divisionName` varchar(255) NOT NULL,
  `customerName` varchar(255) NOT NULL,
  `partNo` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `workinst`
--

INSERT INTO `workinst` (`divisionName`, `customerName`, `partNo`, `filename`) VALUES
('AUTO3', 'VEHICLE ENERGY JAPAN', 'JF2ASY00020AC Rev.8', 'f-vejp-0001-3 JF2ASY00020AC Rev.8 wi'),
('AUTO3', 'VEHICLE ENERGY JAPAN', 'JF2ASY00021AE Rev.8', 'f-vejp-0002-3 JF2ASY00021AE Rev.8  wi'),
('AUTO5', 'VEHICLE ENERGY JAPAN', 'JF2ASY00022AE Rev.7', 'f-vejp-0003-3 JF2ASY00022AE Rev.7 wi'),
('AUTO5', 'VEHICLE ENERGY JAPAN', 'JF2ASY00023AC Rev.7', 'f-vejp-0004-3 JF2ASY00023AC Rev.7  wi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `workinst`
--
ALTER TABLE `workinst`
  ADD PRIMARY KEY (`filename`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
