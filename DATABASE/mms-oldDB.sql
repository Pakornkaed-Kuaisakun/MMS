-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2023 at 06:06 PM
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
-- Table structure for table `moneydata`
--

CREATE TABLE `moneydata` (
  `ID` int(255) NOT NULL,
  `accID` int(255) NOT NULL,
  `amount` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `expenese_group` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `moneydata`
--

INSERT INTO `moneydata` (`ID`, `accID`, `amount`, `type`, `expenese_group`, `comment`, `time`) VALUES
(1, 1, 5000, 'Income', 'NaN', '', '2023-08-09 13:07:45'),
(7, 1, 80, 'Expenese', 'laundry', '', '2023-08-09 13:10:34'),
(8, 1, 83, 'Saving', 'NaN', '', '2023-08-09 15:48:34'),
(9, 1, 3600, 'Expenese', 'food', '', '2023-08-09 13:14:00'),
(10, 1, 1000, 'Expenese', 'travel', '', '2023-08-09 13:14:16'),
(11, 1, 37, 'Expenese', 'subscription_fee', '', '2023-08-09 13:14:55'),
(12, 1, 200, 'Expenese', 'other', '', '2023-08-09 13:15:07');

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
(1, 'pakornkiet2186@gmail.com', 'adcd7048512e64b48da55b027577886ee5a36350', 'Pakornkaed', 'Kuaisakun', '2023-08-12 08:26:45', '198754');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `moneydata`
--
ALTER TABLE `moneydata`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `moneydata`
--
ALTER TABLE `moneydata`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `ID` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
