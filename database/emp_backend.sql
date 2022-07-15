-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2022 at 07:42 PM
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
-- Table structure for table `eroamingauthorizeremotestart`
--

CREATE TABLE `eroamingauthorizeremotestart` (
  `ID` int(11) NOT NULL,
  `SessionID` varchar(200) NOT NULL,
  `CPOPartnerSessionID` varchar(250) NOT NULL,
  `EMPPartnerSessionID` varchar(250) NOT NULL,
  `ProviderID` varchar(200) NOT NULL,
  `EvseID` varchar(200) NOT NULL,
  `Identification` varchar(200) NOT NULL,
  `PartnerProductID` varchar(200) NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eroamingauthorizeremotestart`
--

INSERT INTO `eroamingauthorizeremotestart` (`ID`, `SessionID`, `CPOPartnerSessionID`, `EMPPartnerSessionID`, `ProviderID`, `EvseID`, `Identification`, `PartnerProductID`, `DateTime`) VALUES
(1, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '123-123', 'RemoteIdentification', '', '2022-07-11 05:37:06'),
(2, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '123-123', 'RemoteIdentification', '', '2022-07-15 21:53:59'),
(3, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE03991', '123-123', 'RemoteIdentification', '', '2022-07-15 21:54:37'),
(4, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '123-123', 'RemoteIdentification', '', '2022-07-15 22:11:37'),
(5, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '1234', '', 'DE0399', '123-123', 'RemoteIdentification', '', '2022-07-15 22:11:49');

-- --------------------------------------------------------

--
-- Table structure for table `eroamingauthorizeremotestop`
--

CREATE TABLE `eroamingauthorizeremotestop` (
  `ID` int(11) NOT NULL,
  `SessionID` varchar(200) NOT NULL,
  `CPOPartnerSessionID` varchar(250) NOT NULL,
  `EMPPartnerSessionID` varchar(250) NOT NULL,
  `ProviderID` varchar(200) NOT NULL,
  `EvseID` varchar(200) NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eroamingauthorizeremotestop`
--

INSERT INTO `eroamingauthorizeremotestop` (`ID`, `SessionID`, `CPOPartnerSessionID`, `EMPPartnerSessionID`, `ProviderID`, `EvseID`, `DateTime`) VALUES
(1, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '123-123', '2022-07-15 22:34:15'),
(2, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '123-123', '2022-07-15 22:35:08'),
(3, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '123-123', '2022-07-15 22:37:12');

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
-- Dumping data for table `eroamingauthorizestart`
--

INSERT INTO `eroamingauthorizestart` (`ID`, `SessionID`, `CPOPartnerSessionID`, `EMPPartnerSessionID`, `OperatorID`, `EvseID`, `Identification`, `PartnerProductID`, `DateTime`) VALUES
(1, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '', 'RemoteIdentification', '', '2022-07-11 05:20:44'),
(2, '', '', '', 'DE0399', '', 'RemoteIdentification', '', '2022-07-11 05:22:39'),
(3, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '', 'RemoteIdentification', '', '2022-07-11 05:31:36'),
(4, '', '', '', 'DE0399', '', 'RemoteIdentification', '', '2022-07-14 19:51:59'),
(5, '', '', '', 'DE0399', '', 'RemoteIdentification', '', '2022-07-15 22:02:03'),
(6, '', '', '', 'DE0399', '', 'RemoteIdentification', '', '2022-07-15 22:03:33'),
(7, '', '', '', 'DE0399', '', 'RemoteIdentification', '', '2022-07-15 22:04:22');

-- --------------------------------------------------------

--
-- Table structure for table `eroamingauthorizestop`
--

CREATE TABLE `eroamingauthorizestop` (
  `ID` int(11) NOT NULL,
  `SessionID` varchar(200) NOT NULL,
  `CPOPartnerSessionID` varchar(250) NOT NULL,
  `EMPPartnerSessionID` varchar(250) NOT NULL,
  `OperatorID` varchar(200) NOT NULL,
  `EvseID` varchar(200) NOT NULL,
  `Identification` varchar(200) NOT NULL,
  `DateTime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `eroamingauthorizestop`
--

INSERT INTO `eroamingauthorizestop` (`ID`, `SessionID`, `CPOPartnerSessionID`, `EMPPartnerSessionID`, `OperatorID`, `EvseID`, `Identification`, `DateTime`) VALUES
(1, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '', 'RemoteIdentification', '2022-07-11 04:53:31'),
(2, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '', 'RemoteIdentification', '2022-07-11 05:23:34'),
(3, 'b2688855-7f00-0002-6d8e-48d883f6abb6', '', '', 'DE0399', '', 'RemoteIdentification', '2022-07-11 05:33:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `eroamingauthentificationdata`
--
ALTER TABLE `eroamingauthentificationdata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `eroamingauthorizeremotestart`
--
ALTER TABLE `eroamingauthorizeremotestart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `eroamingauthorizeremotestop`
--
ALTER TABLE `eroamingauthorizeremotestop`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `eroamingauthorizestart`
--
ALTER TABLE `eroamingauthorizestart`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `eroamingauthorizestop`
--
ALTER TABLE `eroamingauthorizestop`
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
-- AUTO_INCREMENT for table `eroamingauthorizeremotestart`
--
ALTER TABLE `eroamingauthorizeremotestart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `eroamingauthorizeremotestop`
--
ALTER TABLE `eroamingauthorizeremotestop`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `eroamingauthorizestart`
--
ALTER TABLE `eroamingauthorizestart`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `eroamingauthorizestop`
--
ALTER TABLE `eroamingauthorizestop`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
