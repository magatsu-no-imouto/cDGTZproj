-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2025 at 07:41 AM
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
('Luigis Real Estate', 'LRE', '02/28/2025'),
('PRIME PLANET ENERGY SOLUTION', 'ppes', '01/01/2025'),
('Startup Industries', 'SI', '02/28/2025'),
('Ticman Queries', 'TQ', '02/28/2025'),
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
('ABD1', '01/01/2025'),
('ABD2', '01/01/2025'),
('AUTO3', '01/01/2025'),
('CID', '01/01/2025'),
('G1A', '01/01/2025'),
('G1B', '01/01/2025'),
('G1C', '01/01/2025'),
('G1E', '01/01/2025'),
('S3', '02/28/2025'),
('SAD', '02/28/2025');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `division` varchar(255) NOT NULL,
  `customer` varchar(255) NOT NULL,
  `partNo` varchar(255) NOT NULL,
  `itemKey` varchar(255) NOT NULL,
  `lineNo` varchar(255) NOT NULL,
  `lineLeader` varchar(255) NOT NULL,
  `fileName` varchar(255) NOT NULL,
  `filetype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`division`, `customer`, `partNo`, `itemKey`, `lineNo`, `lineLeader`, `fileName`, `filetype`) VALUES
('ABD1', 'Luigis Real Estate', '20AB', '1997-2', '', '', 'f-LRE-20AB1997-2', 'fic'),
('ABD1', 'Luigis Real Estate', '20AB', '222', '', '', 'f-LRE-20AB222', 'diaor'),
('ABD1', 'PRIME PLANET ENERGY SOLUTION', '20AB', '0001-1', '', '', 'f-ppes-20AB0001-1', 'wi'),
('ABD1', 'PRIME PLANET ENERGY SOLUTION', '20AB', '0002-1', '', '', 'f-ppes-20AB0002-1', 'wi'),
('ABD1', 'PRIME PLANET ENERGY SOLUTION', '20AB', '0003-1', '', '', 'f-ppes-20AB0003-1', 'wi'),
('ABD1', 'PRIME PLANET ENERGY SOLUTION', '20AB', '0004-1', '', '', 'f-ppes-20AB0004-1', 'wi'),
('ABD1', 'Ticman Queries', 'AAA1', '12314', '', '', 'f-TQ-AAA112314', 'md');

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
('23AB', '01/01/2025'),
('AAA1', '02/28/2025');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerName`);

--
-- Indexes for table `division`
--
ALTER TABLE `division`
  ADD PRIMARY KEY (`divisionName`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`fileName`);

--
-- Indexes for table `lines`
--
ALTER TABLE `lines`
  ADD PRIMARY KEY (`lNo`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`partNo`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
