-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2023 at 05:10 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mms`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `ID` int(255) NOT NULL,
  `accID` int(255) NOT NULL,
  `type` varchar(255) NOT NULL COMMENT 'Main/Saving',
  `bankName` varchar(255) NOT NULL,
  `bankNumber` varchar(255) NOT NULL,
  `ownerPrefix` varchar(10) NOT NULL,
  `bankOwner` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`ID`, `accID`, `type`, `bankName`, `bankNumber`, `ownerPrefix`, `bankOwner`, `status`) VALUES
(1, 1, 'Main', 'ktb', '662-2-71224-7', 'Mr.', 'Pakornkaed Kuaisakun', 'available'),
(2, 1, 'Saving', 'ktb', '693-0-54334-9', 'Miss', 'Nattomon Sukkasame', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `expenese`
--

CREATE TABLE `expenese` (
  `ID` int(255) NOT NULL,
  `accID` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `time` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `expenese`
--

INSERT INTO `expenese` (`ID`, `accID`, `amount`, `type`, `comment`, `time`, `created_at`) VALUES
(2, 1, 2100, 'food', '', '0000-00-00', '2023-08-16 14:36:24'),
(3, 1, 1000, 'travel', '', '0000-00-00', '2023-08-15 15:08:10'),
(4, 1, 5569, 'subscription_fee', '', '0000-00-00', '2023-08-16 14:31:27'),
(5, 1, 500, 'other', '', '0000-00-00', '2023-08-16 14:32:54'),
(6, 1, 0, 'laundry', '80 per month', '2023-08-24', '2023-08-26 15:43:56');

-- --------------------------------------------------------

--
-- Table structure for table `income`
--

CREATE TABLE `income` (
  `ID` int(255) NOT NULL,
  `accID` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `time` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `income`
--

INSERT INTO `income` (`ID`, `accID`, `amount`, `comment`, `time`, `created_at`) VALUES
(5, 1, 10000, '', '2023-08-21', '2023-08-26 15:42:25');

-- --------------------------------------------------------

--
-- Table structure for table `saving`
--

CREATE TABLE `saving` (
  `ID` int(255) NOT NULL,
  `accID` int(255) NOT NULL,
  `bankID` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `time` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `saving`
--

INSERT INTO `saving` (`ID`, `accID`, `bankID`, `amount`, `comment`, `time`, `created_at`) VALUES
(1, 1, 2, 831, '', '2023-09-05', '2023-09-05 13:18:50');

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `ID` int(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `Firstname` varchar(255) NOT NULL,
  `Lastname` varchar(255) NOT NULL,
  `lasted_login` datetime NOT NULL,
  `OTP` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`ID`, `email`, `password`, `Firstname`, `Lastname`, `lasted_login`, `OTP`) VALUES
(1, 'pakornkiet2186@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 'Pakornkaed', 'Kuaisakun', '2023-09-05 07:35:20', '621439'),
(2, 'getchava2551@gmail.com', '63982e54a7aeb0d89910475ba6dbd3ca6dd4e5a1', 'Getlove love', 'Guitar', '2023-09-05 07:35:20', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_accID` (`accID`) USING BTREE;

--
-- Indexes for table `expenese`
--
ALTER TABLE `expenese`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_accID` (`accID`) USING BTREE;

--
-- Indexes for table `income`
--
ALTER TABLE `income`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_accID` (`accID`) USING BTREE;

--
-- Indexes for table `saving`
--
ALTER TABLE `saving`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_accID` (`accID`) USING BTREE,
  ADD KEY `fk_bankID` (`bankID`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expenese`
--
ALTER TABLE `expenese`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `income`
--
ALTER TABLE `income`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `saving`
--
ALTER TABLE `saving`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank`
--
ALTER TABLE `bank`
  ADD CONSTRAINT `bank_ibfk_1` FOREIGN KEY (`accID`) REFERENCES `userdata` (`ID`);

--
-- Constraints for table `expenese`
--
ALTER TABLE `expenese`
  ADD CONSTRAINT `expenese_ibfk_1` FOREIGN KEY (`accID`) REFERENCES `userdata` (`ID`);

--
-- Constraints for table `income`
--
ALTER TABLE `income`
  ADD CONSTRAINT `income_ibfk_1` FOREIGN KEY (`accID`) REFERENCES `userdata` (`ID`);

--
-- Constraints for table `saving`
--
ALTER TABLE `saving`
  ADD CONSTRAINT `saving_ibfk_1` FOREIGN KEY (`accID`) REFERENCES `userdata` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `saving_ibfk_2` FOREIGN KEY (`bankID`) REFERENCES `bank` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
