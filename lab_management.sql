-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 15, 2023 at 03:55 AM
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
-- Database: `lab_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `user_id` varchar(10) NOT NULL,
  `user_name` text NOT NULL,
  `item_id` int(10) NOT NULL,
  `item_name` text NOT NULL,
  `date_borr` datetime NOT NULL,
  `date_ret` datetime NOT NULL,
  `qty_borr` int(11) NOT NULL,
  `teacher_appr` int(11) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`user_id`, `user_name`, `item_id`, `item_name`, `date_borr`, `date_ret`, `qty_borr`, `teacher_appr`, `description`) VALUES
('janedoe', 'Jane Doe', 11, 'measuring tape', '2023-01-18 00:31:20', '0000-00-00 00:00:00', 1, 0, ''),
('johndoe', 'John Doe', 1, 'Test Tubes', '2023-01-18 00:39:37', '2023-01-18 00:39:50', 1, 0, ''),
('marypete', 'Mary Peters', 1, 'Test Tubes', '2023-01-16 15:11:13', '2023-02-01 21:44:06', 5, 0, 'Kamala Sharma Grade 8B'),
('marypete', 'Mary Peters', 1, 'Test Tubes', '2023-02-01 21:37:43', '2023-02-02 09:53:43', 1, 0, 'Shyam Grade 9 A'),
('marypete', 'Mary Peters', 2, 'Pippettes', '2023-01-11 16:34:48', '0000-00-00 00:00:00', 1, 0, 'Shyam Grade 9 A'),
('marypete', 'Mary Peters', 2, 'Pippettes', '2023-01-17 14:20:21', '2023-01-17 14:21:06', 5, 0, 'Shyam Grade 9 A'),
('marypete', 'Mary Peters', 2, 'Pippettes', '2023-01-31 14:59:42', '2023-02-02 15:17:00', 3, 0, 'Shyam Grade 9 A'),
('marypete', 'Mary Peters', 2, 'Pippettes', '2023-02-01 14:35:32', '2023-02-01 14:59:28', 3, 0, 'Shyam Grade 9 A'),
('marypete', 'Mary Peters', 3, 'Burettes', '2023-01-26 15:43:17', '2023-02-01 15:46:06', 4, 0, 'rahulkumar'),
('marypete', 'Mary Peters', 5, 'NPN Transistors', '2023-02-01 14:13:00', '0000-00-00 00:00:00', 2, 0, 'Shyam Grade 9 A'),
('marypete', 'Mary Peters', 5, 'NPN Transistors', '2023-02-01 15:41:21', '0000-00-00 00:00:00', 5, 0, 'rahulkumar'),
('marypete', 'Mary Peters', 6, 'Mitosis Slides', '2023-02-02 21:21:48', '0000-00-00 00:00:00', 1, 0, 'Anita from Grade 11A 2022'),
('marypete', 'Mary Peters', 7, 'Battery Eliminator', '2023-01-16 12:47:00', '2023-02-01 14:45:54', 1, 0, 'Shashank, 2023'),
('marypete', 'Mary Peters', 7, 'Battery Eliminator', '2023-01-30 14:54:26', '2023-02-01 14:55:15', 1, 0, 'Anita from Grade 11A 2022'),
('marypete', 'Mary Peters', 7, 'Battery Eliminator', '2023-01-31 14:47:24', '2023-02-01 14:53:55', 1, 0, 'rahulkumar'),
('marypete', 'Mary Peters', 7, 'Battery Eliminator', '2023-01-31 14:57:54', '2023-02-01 14:58:03', 1, 0, 'Kamala Sharma Grade 8B'),
('marypete', 'Mary Peters', 7, 'Battery Eliminator', '2023-01-31 14:58:40', '2023-02-01 14:58:51', 1, 0, 'Shyam Grade 9 A'),
('marypete', 'Mary Peters', 8, 'Copper wire, 12 inches', '2023-01-04 15:46:53', '2023-01-31 21:20:58', 4, 0, 'rahulkumar'),
('marypete', 'Mary Peters', 8, 'Copper wire, 12 inches', '2023-01-16 13:35:00', '2023-01-16 14:04:00', 0, 0, 'For Ram from Grade 12C 2023'),
('marypete', 'Mary Peters', 8, 'Copper wire, 12 inches', '2023-01-16 13:58:00', '2023-01-16 14:46:30', 0, 0, 'Shyam Grade 9 A'),
('marypete', 'Mary Peters', 8, 'Copper wire, 12 inches', '2023-01-16 14:07:00', '2023-01-16 21:35:34', 1, 0, 'For Ram from Grade 12C 2023'),
('marypete', 'Mary Peters', 8, 'Copper wire, 12 inches', '2023-01-16 14:07:47', '2023-01-18 00:26:37', 1, 0, 'For Ram from Grade 12C 2023'),
('marypete', 'Mary Peters', 8, 'Copper wire, 12 inches', '2023-01-18 00:26:11', '2023-01-18 00:26:56', 2, 0, 'rahulkumar'),
('marypete', 'Mary Peters', 10, 'Jumper wires', '2023-01-18 00:35:04', '2023-01-18 00:35:25', 1, 0, 'rahulkumar'),
('marypete', 'Mary Peters', 10, 'Jumper wires', '2023-02-02 09:57:55', '2023-02-02 14:12:47', 1, 0, 'Shyam Grade 9 A'),
('rahulkumar', 'Rahul Kumar', 1, 'Test Tubes', '2023-01-13 16:07:20', '0000-00-00 00:00:00', 7, 0, NULL),
('rahulkumar', 'Rahul Kumar', 2, 'Pippettes', '2023-01-15 18:17:00', '2023-01-15 19:45:00', 0, 0, NULL),
('rahulkumar', 'Rahul Kumar', 2, 'Pippettes', '2023-01-15 19:46:00', '2023-01-15 19:47:00', 0, 0, NULL),
('rahulkumar', 'Rahul Kumar', 2, 'Pippettes', '2023-01-17 14:18:15', '2023-02-02 14:11:01', 7, 0, ''),
('rahulkumar', 'Rahul Kumar', 2, 'Pippettes', '2023-02-02 14:11:51', '0000-00-00 00:00:00', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 3, 'Burettes', '2023-01-14 19:59:00', '2023-01-15 20:02:00', 0, 0, NULL),
('rahulkumar', 'Rahul Kumar', 3, 'Burettes', '2023-02-01 02:20:20', '0000-00-00 00:00:00', 2, 0, ''),
('rahulkumar', 'Rahul Kumar', 4, '100 Ohm Variable Resistance', '2023-01-16 14:49:00', '2023-01-16 15:00:00', 0, 0, ''),
('rahulkumar', 'Rahul Kumar', 4, '100 Ohm Variable Resistance', '2023-01-19 21:09:37', '2023-01-21 08:45:51', 5, 0, ''),
('rahulkumar', 'Rahul Kumar', 4, '100 Ohm Variable Resistance', '2023-02-01 12:51:37', '2023-02-01 10:10:10', 10, 0, ''),
('rahulkumar', 'Rahul Kumar', 5, 'NPN Transistors', '2023-01-14 21:15:00', '2023-01-21 14:39:29', 1, 0, NULL),
('rahulkumar', 'Rahul Kumar', 5, 'NPN Transistors', '2023-01-21 14:40:59', '2023-01-23 21:08:29', 4, 0, ''),
('rahulkumar', 'Rahul Kumar', 5, 'NPN Transistors', '2023-02-01 11:27:52', '2023-02-01 11:57:21', 5, 0, ''),
('rahulkumar', 'Rahul Kumar', 5, 'NPN Transistors', '2023-02-01 11:57:57', '2023-02-01 12:05:09', 5, 0, ''),
('rahulkumar', 'Rahul Kumar', 5, 'NPN Transistors', '2023-02-01 12:06:15', '2023-02-01 12:06:24', 10, 0, ''),
('rahulkumar', 'Rahul Kumar', 5, 'NPN Transistors', '2023-02-01 12:37:10', '2023-02-01 12:37:57', 5, 0, ''),
('rahulkumar', 'Rahul Kumar', 5, 'NPN Transistors', '2023-02-01 12:38:15', '2023-02-01 10:10:10', 10, 0, ''),
('rahulkumar', 'Rahul Kumar', 6, 'Mitosis Slide', '2023-01-12 18:14:20', '2023-01-16 14:48:01', 0, 0, NULL),
('rahulkumar', 'Rahul Kumar', 6, 'Mitosis Slide', '2023-01-16 14:51:00', '2023-01-16 21:32:00', 2, 0, NULL),
('rahulkumar', 'Rahul Kumar', 6, 'Mitosis Slides', '2023-02-01 20:20:20', '2023-02-02 14:10:53', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-17 16:33:20', '2023-01-17 16:37:04', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-17 16:44:28', '2023-01-17 16:48:09', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-17 16:52:47', '2023-01-17 16:57:13', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-18 00:24:53', '2023-01-18 00:27:28', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-18 00:33:59', '2023-01-18 00:34:14', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-18 12:35:04', '2023-01-22 12:35:51', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-19 13:03:42', '2023-01-19 13:13:20', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-20 12:21:21', '2023-01-13 12:25:33', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-20 12:40:39', '2023-01-18 12:45:42', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-20 12:54:05', '2023-01-18 12:54:42', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-01-30 20:20:20', '2023-02-01 20:20:20', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-02-01 09:36:55', '0000-00-00 00:00:00', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-02-01 12:52:14', '2023-02-01 12:53:09', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 7, 'Battery Eliminator', '2023-02-01 13:09:53', '2023-02-01 20:24:00', 1, 0, ''),
('rahulkumar', 'Rahul Kumar', 10, 'Jumper wires', '2023-02-01 09:42:14', '0000-00-00 00:00:00', 1, 0, ''),
('shankars', 'Shankar Sharma', 1, 'Test Tubes', '2023-01-13 16:07:20', '2023-01-16 23:19:00', 3, 0, NULL),
('shankars', 'Shankar Sharma', 2, 'Pippettes', '2023-01-15 18:59:00', '0000-00-00 00:00:00', 3, 0, NULL),
('shankars', 'Shankar Sharma', 3, 'Burettes', '2023-01-16 23:18:00', '0000-00-00 00:00:00', 3, 0, ''),
('shankars', 'Shankar Sharma', 4, '100 Ohm Variable Resistance', '2023-01-17 00:30:00', '2023-01-17 00:31:00', 5, 0, ''),
('shankars', 'Shankar Sharma', 5, 'NPN Transistors', '2023-01-16 23:19:00', '0000-00-00 00:00:00', 5, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `item_id` int(10) NOT NULL,
  `item_name` text NOT NULL,
  `item_qty` int(11) NOT NULL,
  `item_instock` int(11) NOT NULL,
  `item_desc` text NOT NULL,
  `item_auth` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`item_id`, `item_name`, `item_qty`, `item_instock`, `item_desc`, `item_auth`) VALUES
(1, 'Test Tubes', 55, 54, 'Borosil glass test tubes, do not break', 0),
(2, 'Pippettes', 27, 19, '16 inch glass pipettes', 0),
(3, 'Burettes', 27, 22, 'Durable glass burettes', 0),
(4, '100 Ohm Variable Resistance', 30, 30, 'Nichrome wire resistor', 0),
(5, 'NPN Transistors', 100, 93, 'Silicon NPN Transistors', 0),
(6, 'Mitosis Slides', 8, 7, 'Glass slides on Mitosis cell division', 0),
(7, 'Battery Eliminator', 3, 3, '3V to 12V DC Power Supply', 0),
(8, 'Copper wire, 12 inches', 100, 100, '12 inch shielded copper wire strips', 1),
(9, 'Ammeter', 10, 10, 'Max 1 Amp Ammeter', 1),
(10, 'Jumper wires', 24, 23, 'Used for circuits', 0),
(11, 'measuring tape', 5, 4, 'Used to measure', 0),
(12, 'Magnifying Glass', 10, 10, '15x Magnifying glass, 2 inches width', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(10) NOT NULL,
  `user_name` text NOT NULL,
  `user_pwd` text NOT NULL,
  `user_type` varchar(1) NOT NULL,
  `user_batch` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_name`, `user_pwd`, `user_type`, `user_batch`) VALUES
('dhavalk', 'Dhaval Sharma', 'gwh', 'S', 2023),
('dhrutip', 'Dhruti Pali', 'gwh', 'S', 2025),
('erik', 'Erik Schmidt', 'gwh', 'S', 2025),
('janedoe', 'Jane Doe', 'gwh', 'S', 2025),
('marypete', 'Mary Peters', 'gwh', 'T', 0),
('rahulkumar', 'Rahul Kumar', 'gwh', 'S', 2023),
('reemag', 'Reema Agarwal', 'gwh', 'S', 2022),
('shankars', 'Shankar Sharma', 'gwh', 'S', 2022),
('tanya', 'Tanya Krishna', 'gwh', 'T', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`user_id`,`item_id`,`date_borr`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
