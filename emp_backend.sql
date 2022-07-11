-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 04, 2022 at 06:20 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emp_backend`
--

-- --------------------------------------------------------

--
-- Table structure for table `eroamingauthentificationdata`
--

CREATE TABLE `eroamingauthentificationdata` (
  `ID` int(11) NOT NULL,
  `ProviderID` varchar(200) NOT NULL,
  `Identification` varchar(200) NOT NULL,
  `UID` varchar(50) NOT NULL,
  `EvcoID` varchar(250) NOT NULL,
  `RFID` varchar(200) NOT NULL,
  `PIN` varchar(250) NOT NULL,
  `HashedPIN` varchar(250) NOT NULL,
  `PrintedNumber` varchar(150) NOT NULL,
  `ExpiryDate` datetime NOT NULL,
  `DateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eroamingauthentificationdata`
--

INSERT INTO `eroamingauthentificationdata` (`ID`, `ProviderID`, `Identification`, `UID`, `EvcoID`, `RFID`, `PIN`, `HashedPIN`, `PrintedNumber`, `ExpiryDate`, `DateTime`) VALUES
(1, 'DE-8EO', 'RFIDMifareFamilyIdentification', '7568290FFF765F', '-', '-', '-', '-', '-', '2022-07-03 12:56:51', '2022-07-03 12:56:51'),
(2, 'DE-8EOO', 'RemoteIdentification', '-', 'DE-8EO-CAet5e4XY-3', '-', '-', '-', '-', '2022-07-03 13:13:02', '2022-07-03 13:13:02');

-- --------------------------------------------------------

--
-- Table structure for table `eroamingauthorizestart`
--

CREATE TABLE `eroamingauthorizestart` (
  `ID` int(11) NOT NULL,
  `SessionID` varchar(200) NOT NULL,
  `CPOPartnerSessionID` varchar(250) NOT NULL,
  `EMPPartnerSessionID` varchar(250) NOT NULL,
  `OperatorID` varchar(200) NOT NULL,
  `EvseID` varchar(200) NOT NULL,
  `Identification` varchar(200) NOT NULL,
  `PartnerProductID` varchar(200) NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eroamingauthentificationdata`
--
ALTER TABLE `eroamingauthentificationdata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `eroamingauthorizestart`
--
ALTER TABLE `eroamingauthorizestart`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `eroamingauthentificationdata`
--
ALTER TABLE `eroamingauthentificationdata`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `eroamingauthorizestart`
--
ALTER TABLE `eroamingauthorizestart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
