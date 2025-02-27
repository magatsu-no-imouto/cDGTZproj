-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2025 at 08:35 AM
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
-- Database: `dgtz`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerName` varchar(255) NOT NULL,
  `customerShort` varchar(5) NOT NULL,
  `dateAdded` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerName`, `customerShort`, `dateAdded`) VALUES
('PRIME PLANET ENERGY SOLUTION', 'ppes', '01/01/2025'),
('VEHICLE ENERGY JAPAN', 'vej', '01/01/2025');

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
('G1A', '01/01/2025'),
('G1B', '01/01/2025'),
('G1C', '01/01/2025'),
('G1E', '01/01/2025'),
('AUTO3', '01/01/2025'),
('ABD1', '01/01/2025'),
('ABD2', '01/01/2025'),
('CID', '01/01/2025');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `division` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `partNo` varchar(255) DEFAULT NULL,
  `lineNo` varchar(255) DEFAULT NULL,
  `lineLeader` varchar(255) DEFAULT NULL,
  `fileName` varchar(255) NOT NULL,
  `filetype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`division`, `customer`, `partNo`, `lineNo`, `lineLeader`, `fileName`, `filetype`) VALUES
('G1A', 'PRIME PLANET ENERGY SOLUTION', '20AB', NULL, NULL, 'f-ppes-20AB0001-1', 'wi'),
('G1B', 'PRIME PLANET ENERGY SOLUTION', '20AB', NULL, NULL, 'f-ppes-20AB0002-1', 'wi'),
('G1E', 'PRIME PLANET ENERGY SOLUTION', '20AB', NULL, NULL, 'f-ppes-20AB0003-1', 'cp'),
('G1A', 'PRIME PLANET ENERGY SOLUTION', '20AB', NULL, NULL, 'f-ppes-20AB0004-1', 'ps'),
('AUTO3', 'PRIME PLANET ENERGY SOLUTION', '20AB', NULL, NULL, 'f-ppes-20AB0005-1', 'md'),
('CID', 'PRIME PLANET ENERGY SOLUTION', '20AB', '2', 'John Dos', 'f-ppes-20AB0006-1', 'diaor'),
('ABD2', 'PRIME PLANET ENERGY SOLUTION', '20AB', '2', 'John Dos', 'f-ppes-20AB0007-1', 'par'),
('AUTO3', 'PRIME PLANET ENERGY SOLUTION', '21AB', NULL, NULL, 'f-ppes-21AB0001', 'cp'),
('AUTO3', '	\r\nPRIME PLANET ENERGY SOLUTION', '21AB', NULL, NULL, 'f-ppes-21AB0002-1', 'fic'),
('ABD2', 'PRIME PLANET ENERGY SOLUTION', '21AB', NULL, NULL, 'f-ppes-21AB0003-1', 'md'),
('G1C', 'PRIME PLANET ENERGY SOLUTION', '22AB', '4', 'Allie Terazon', 'f-ppes-22AB0001-1', 'diaor'),
('AUTO3', 'PRIME PLANET ENERGY SOLUTION', '22AB', '2', 'John Dos', 'f-ppes-22AB0002-1', 'dmc'),
('G1B', 'PRIME PLANET ENERGY SOLUTION', '22AB', '3', 'Jack Cena', 'f-ppes-22AB0003-1', 'par'),
('G1E', 'PRIME PLANET ENERGY SOLUTION', '22AB', '3', 'Jack Cena', 'f-ppes-22AB0004-1', 'dcior'),
('ABD2', 'PRIME PLANET ENERGY SOLUTION', '23AB', NULL, NULL, 'f-ppes-23AB0001-1', 'ps'),
('G1C', 'PRIME PLANET ENERGY SOLUTION', '23AB', NULL, NULL, 'f-ppes-23AB0002-1', 'md'),
('G1A', 'PRIME PLANET ENERGY SOLUTION', '23AB', '3', 'Jack Cena', 'f-ppes-23AB0003-1', 'diaor'),
('G1E', 'PRIME PLANET ENERGY SOLUTION', '23AB', '4', 'Allie Terazon', 'f-ppes-23AB0004-1', 'dmc'),
('ABD1', 'PRIME PLANET ENERGY SOLUTION', '23AB', '2', 'John Dos', 'f-ppes-23AB0005-1', 'dcior'),
('G1E', 'VEHICLE ENERGY JAPAN', '20AB', NULL, NULL, 'f-vej-20AB0001-1', 'cp'),
('ABD2', 'VEHICLE ENERGY JAPAN', '20AB', '1', 'Jane Doe', 'f-vej-20AB0002-1', 'dmc'),
('G1B', 'VEHICLE ENERGY JAPAN', '21AB', NULL, NULL, 'f-vej-21AB0001-1', 'wi'),
('ABD2', 'VEHICLE ENERGY JAPAN', '21AB', '1', 'Jane Doe', 'f-vej-21AB0002-1', 'diaor'),
('G1B', 'VEHICLE ENERGY JAPAN', '21AB', '3', 'Jack Cena', 'f-vej-21AB0003-1', 'dmc'),
('G1E', 'VEHICLE ENERGY JAPAN', '21AB', '4', 'Allie Terazon', 'f-vej-21AB0004-1', 'par'),
('G1B', 'VEHICLE ENERGY JAPAN', '21AB', '4', 'Allie Terazon', 'f-vej-21AB0005-1', 'dcior'),
('G1C', 'VEHICLE ENERGY JAPAN', '22AB', NULL, NULL, 'f-vej-22AB0001-1', 'wi'),
('G1B', 'VEHICLE ENERGY JAPAN', '22AB', NULL, NULL, 'f-vej-22AB0002-1', 'ps'),
('ABD2', 'VEHICLE ENERGY JAPAN', '22AB', NULL, NULL, 'f-vej-22AB0003-1', 'md'),
('G1A', 'VEHICLE ENERGY JAPAN', '23AB', NULL, NULL, 'f-vej-23AB0001-1', 'cp'),
('AUTO3', 'VEHICLE ENERGY JAPAN', '23AB', NULL, NULL, 'f-vej-23AB0002-1', 'fic'),
('AUTO3', 'VEHICLE ENERGY JAPAN', '23AB', NULL, NULL, 'f-vej-23AB0002-2', 'fic'),
('AUTO3', 'PRIME PLANET ENERGY SOLUTION', '23AB', NULL, NULL, 'f-vej-23AB0002-3', 'fic'),
('CID', 'VEHICLE ENERGY JAPAN', '23AB', NULL, NULL, 'f-vej-23AB0003-1', 'ps'),
('AUTO3', 'VEHICLE ENERGY JAPAN', '23AB', '1', 'Jane Doe', 'f-vej-23AB0004-1', 'par'),
('ABD1', 'VEHICLE ENERGY JAPAN', '23AB', '1', 'Jane Doe', 'f-vej-23AB0005-1', 'dcior');

-- --------------------------------------------------------

--
-- Table structure for table `lines`
--

CREATE TABLE `lines` (
  `lNo` varchar(255) NOT NULL,
  `lLead` varchar(255) NOT NULL,
  `dateAdded` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lines`
--

INSERT INTO `lines` (`lNo`, `lLead`, `dateAdded`) VALUES
('1', 'Jane Doe', '01/01/2025'),
('2', 'John Dos', '01/02/2025'),
('3', 'Jack Cena', '01/03/2025'),
('4', 'Allie Terazon', '01/04/2025');

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
('20AB', '01/01/2025'),
('21AB', '01/01/2025'),
('22AB', '01/01/2025'),
('23AB', '01/01/2025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerName`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`fileName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
