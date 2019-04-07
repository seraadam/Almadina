-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 07, 2019 at 06:46 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nomowtec_tayba`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `adminID` varchar(30) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`adminID`, `password`) VALUES
('abeer', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FID` varchar(15) NOT NULL,
  `VID` varchar(15) NOT NULL,
  `PID` varchar(15) NOT NULL,
  `Comment` varchar(100) NOT NULL,
  `Rate` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FID`, `VID`, `PID`, `Comment`, `Rate`) VALUES
('1', '1', '11', '', 4),
('2', '2', '16', '', 3),
('3', '3', '11', '', 3);

-- --------------------------------------------------------

--
-- Table structure for table `Impression`
--

CREATE TABLE `Impression` (
  `IID` int(255) NOT NULL,
  `PID` int(100) NOT NULL,
  `VID` int(20) NOT NULL,
  `Date` date NOT NULL,
  `Visited` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Impression`
--

INSERT INTO `Impression` (`IID`, `PID`, `VID`, `Date`, `Visited`) VALUES
(1, 11, 2345, '2019-02-06', 'yes'),
(2, 16, 3, '2019-02-03', 'yes'),
(3, 11, 3, '2019-02-05', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `PID` int(15) NOT NULL,
  `Category` varchar(50) NOT NULL,
  `Title` varchar(225) NOT NULL,
  `lat` varchar(50) NOT NULL,
  `lang` varchar(50) NOT NULL,
  `image_name` text NOT NULL,
  `Description` text NOT NULL,
  `Start` date NOT NULL,
  `End` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`PID`, `Category`, `Title`, `lat`, `lang`, `image_name`, `Description`, `Start`, `End`) VALUES
(7, 'Historical', 'Medina', '24.4619371', '39.6009011', 'https://www.sauditourism.sa/ar/ExploreKSA/AttractionSites/AlHijazRailroad/PublishingImages/HijazRailroadLine.jpg', 'The', '0000-00-00', '2019-01-21'),
(9, 'Historical', 'Tabuk', '28.4043008', '36.614686', 'https://www.sauditourism.sa/ar/ExploreKSA/AttractionSites/AlHijazRailroad/PublishingImages/taboukstation.jpg', 'It', '0000-00-00', '2019-02-18'),
(10, 'Historical', 'Medina museum (Railway Station)', '24.4619371', '39.6009011', 'https://www.sauditourism.sa/ar/ExploreKSA/AttractionSites/AlHijazRailroad/PublishingImages/HijazRailroadLine.jpg', 'The Medina museum in Hejaz railway Station receives a lot of visitors and researchers. It is one of the prominent tourist destinations and a cultural front for Medina region, which is characterized by the abundance of archeological and Islamic sites. The museum includes the railway station buildings; a museum in the railway repair shop that displays the history of Hejaz Railway station; a market for craftsmen; a shop; a traditional café; and a restauran', '2019-02-05', '2019-03-24'),
(11, 'Religious', 'Medina museum (Railway Station)', '24.4619371', '39.6009011', 'https://www.sauditourism.sa/ar/ExploreKSA/AttractionSites/AlHijazRailroad/PublishingImag/HijazRailroadLine.jpg', 'The Medina museum in Hejaz railway Station receives a lot of visitors and researchers. It is one of the prominent tourist destinations and a cultural front for Medina region, which is characterized by the abundance of archeological and Islamic sites. The museum includes the railway station buildings; a museum in the railway repair shop that displays the history of Hejaz Railway station; a market for craftsmen; a shop; a traditional café; and a restauran', '2019-09-04', '2019-09-23'),
(12, 'Historical', 'Madain', '23.86754', '33.098765', '', 'It is one of the main stations on the pilgrims trail. The location includes an ancient Islamic castle with Al Naqa Well in its center, in addition to an old lake, 5 stone wells, and 16 railway buildings made of stone.', '2019-04-01', '2019-04-04'),
(13, 'Shopping', 'sdfg', '23456', '', '', 'It is one of the main stations on the pilgrims trail. The location includes an ancient Islamic castle with Al Naqa Well in its center, in addition to an old lake, 5 stone wells, and 16 railway buildings made of stone.', '2019-04-03', '2019-04-25');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `TID` int(11) NOT NULL,
  `VID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`TID`, `VID`, `PID`, `Date`) VALUES
(1, 4, 9, '2019-09-04'),
(2, 4, 9, '2019-09-04'),
(4, 3, 9, '2019-09-04'),
(5, 4, 9, '2019-09-04');

-- --------------------------------------------------------

--
-- Table structure for table `visitor`
--

CREATE TABLE `visitor` (
  `VID` int(15) NOT NULL,
  `Username` varchar(15) NOT NULL,
  `Password` varchar(15) NOT NULL,
  `Nationality` varchar(15) NOT NULL,
  `Age` int(4) NOT NULL,
  `Gender` varchar(15) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `PhoneNumber` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `visitor`
--

INSERT INTO `visitor` (`VID`, `Username`, `Password`, `Nationality`, `Age`, `Gender`, `Email`, `PhoneNumber`) VALUES
(3, 'abeer', '1234', 'sss', 22, 'female', 'abeer@gmail.com', '05000000'),
(4, 'mona', '1234', 'sss', 22, 'female', 'abeer@gmail.com', '05000000'),
(5, 'walaa', '1234', 'sss', 22, 'female', 'abeer@gmail.com', '05000000'),
(6, 'Historical', 'Tabuk station', 'ss', 28, 'gfds', 'dsafdghf', '2435465768'),
(7, 'Historical', 'Tabuk station', 'ss', 28, 'gfds', 'dsafdghf', '2435465768');

-- --------------------------------------------------------

--
-- Table structure for table `web data`
--

CREATE TABLE `web data` (
  `WID` varchar(15) NOT NULL,
  `PID` varchar(15) NOT NULL,
  `Popularity` decimal(10,0) NOT NULL,
  `Impression` decimal(10,0) NOT NULL,
  `Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FID`,`VID`,`PID`);

--
-- Indexes for table `Impression`
--
ALTER TABLE `Impression`
  ADD PRIMARY KEY (`IID`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`PID`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`TID`),
  ADD KEY `fkey` (`PID`),
  ADD KEY `gkey` (`VID`);

--
-- Indexes for table `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`VID`);

--
-- Indexes for table `web data`
--
ALTER TABLE `web data`
  ADD PRIMARY KEY (`WID`,`PID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Impression`
--
ALTER TABLE `Impression`
  MODIFY `IID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `PID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `TID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `visitor`
--
ALTER TABLE `visitor`
  MODIFY `VID` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `fkey` FOREIGN KEY (`PID`) REFERENCES `place` (`PID`),
  ADD CONSTRAINT `gkey` FOREIGN KEY (`VID`) REFERENCES `visitor` (`VID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
