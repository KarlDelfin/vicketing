-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2025 at 12:52 PM
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
-- Database: `vicketing`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `areaId` int(11) NOT NULL,
  `areaName` varchar(255) NOT NULL,
  `dateTimeCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`areaId`, `areaName`, `dateTimeCreated`) VALUES
(21, 'Banilad', '2025-06-14 05:36:07'),
(22, 'Basak', '2025-06-14 05:36:07'),
(23, 'Bulacao', '2025-06-14 05:36:07'),
(24, 'Busay', '2025-06-14 05:36:07'),
(25, 'Calamba', '2025-06-14 05:36:07'),
(26, 'Capitol Site', '2025-06-14 05:36:07'),
(27, 'Carreta', '2025-06-14 05:36:07'),
(28, 'Cogon Ramos', '2025-06-14 05:36:07'),
(29, 'Day-as', '2025-06-14 05:36:07'),
(30, 'Fuente', '2025-06-14 05:36:07'),
(31, 'Guadalupe', '2025-06-14 05:36:07'),
(32, 'Hipodromo', '2025-06-14 05:36:07'),
(33, 'Labangon', '2025-06-14 05:36:07'),
(34, 'Lahug', '2025-06-14 05:36:07'),
(35, 'Mabolo', '2025-06-14 05:36:07'),
(36, 'Mambaling', '2025-06-14 05:36:07'),
(37, 'Pardo', '2025-06-14 05:36:07'),
(38, 'Talamban', '2025-06-14 05:36:07'),
(39, 'Tisa', '2025-06-14 05:36:07'),
(40, 'V. Rama', '2025-06-14 05:36:07');

-- --------------------------------------------------------

--
-- Table structure for table `fields`
--

CREATE TABLE `fields` (
  `fieldId` int(11) NOT NULL,
  `fieldName` varchar(255) NOT NULL,
  `dateTimeCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fields`
--

INSERT INTO `fields` (`fieldId`, `fieldName`, `dateTimeCreated`) VALUES
(1, 'Traffic', '2025-06-14 06:04:34'),
(2, 'Pedestrian', '2025-06-14 06:04:34');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roleId` int(11) NOT NULL,
  `roleName` varchar(255) NOT NULL,
  `roleLevel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roleId`, `roleName`, `roleLevel`) VALUES
(1, 'Admin', 1),
(2, 'Enforcer', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `roleId` int(11) NOT NULL,
  `fieldId` int(11) DEFAULT NULL,
  `areaId` int(11) DEFAULT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(13) NOT NULL,
  `birthDate` datetime NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `image` varchar(255) NOT NULL,
  `dateTimeCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `roleId`, `fieldId`, `areaId`, `firstName`, `lastName`, `email`, `password`, `phone`, `birthDate`, `gender`, `image`, `dateTimeCreated`, `status`) VALUES
(8, 1, NULL, NULL, 'asd', 'asd', 'asd', '$2y$10$D3gzAEhYb33ilAitFZXoO.sQnFeVWgoADZSiu8I57rZu1mCQkps5C', '123', '2025-06-10 16:00:00', 'Male', '20250614100614.png', '2025-06-14 10:14:37', 'Up');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`areaId`);

--
-- Indexes for table `fields`
--
ALTER TABLE `fields`
  ADD PRIMARY KEY (`fieldId`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roleId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `roleId` (`roleId`),
  ADD KEY `fieldId` (`fieldId`),
  ADD KEY `areaId` (`areaId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `areaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `fields`
--
ALTER TABLE `fields`
  MODIFY `fieldId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roleId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`roleId`) REFERENCES `roles` (`roleId`),
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`fieldId`) REFERENCES `fields` (`fieldId`),
  ADD CONSTRAINT `users_ibfk_3` FOREIGN KEY (`areaId`) REFERENCES `areas` (`areaId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
