-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 20, 2025 at 04:47 PM
-- Server version: 8.0.39
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `record-list`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_record`
--

CREATE TABLE `attendance_record` (
  `attendanceid` int NOT NULL,
  `studentid` varchar(50) NOT NULL,
  `subject-code` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `scan_dateTime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `attendance_record`
--

INSERT INTO `attendance_record` (`attendanceid`, `studentid`, `subject-code`, `section`, `scan_dateTime`) VALUES
(166, '0001', 'CC101', 'BSCS2A', '2025-05-10 21:39:27'),
(167, '0002', 'CC101', 'BSCS2A', '2025-05-10 21:39:29'),
(168, '0003', 'CC101', 'BSCS2A', '2025-05-10 21:39:31'),
(169, '0004', 'CC101', 'BSCS2A', '2025-05-10 21:39:32'),
(170, '0006', 'CC101', 'BSCS2A', '2025-05-10 21:39:33'),
(171, '0005', 'CC101', 'BSCS2A', '2025-05-10 21:39:34'),
(172, '0001', 'CC101', 'BSCS2A', '2025-05-16 18:44:14'),
(173, '0002', 'CC101', 'BSCS2A', '2025-05-16 18:42:34'),
(174, '0003', 'CC101', 'BSCS2A', '2025-05-16 18:42:36'),
(175, '0004', 'CC101', 'BSCS2A', '2025-05-16 18:42:37'),
(176, '0005', 'CC101', 'BSCS2A', '2025-05-16 18:42:38'),
(177, '0002', 'CC101', 'BSCS2A', '2025-05-20 20:39:01'),
(178, '0003', 'CC101', 'BSCS2A', '2025-05-20 20:39:13'),
(179, '0004', 'CC101', 'BSCS2A', '2025-05-20 20:39:15'),
(180, '0005', 'CC101', 'BSCS2A', '2025-05-20 20:39:16'),
(181, '0002', 'CC102', 'BSCS2A', '2025-05-20 21:19:34'),
(182, '0003', 'CC102', 'BSCS2A', '2025-05-20 21:19:36'),
(183, '0004', 'CC102', 'BSCS2A', '2025-05-20 21:19:37'),
(184, '0005', 'CC102', 'BSCS2A', '2025-05-20 21:19:38'),
(185, '0003', 'CC104', 'BSCS2A', '2025-05-20 22:25:09'),
(186, '0004', 'CC104', 'BSCS2A', '2025-05-20 22:25:10'),
(187, '0005', 'CC104', 'BSCS2A', '2025-05-20 22:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `section-tbl`
--

CREATE TABLE `section-tbl` (
  `section` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `section-tbl`
--

INSERT INTO `section-tbl` (`section`) VALUES
('asdw'),
('BSCS2A'),
('BSCS2C'),
('BSCS2E'),
('BSCS2F'),
('BSCS2G'),
('BSCS2H'),
('BSCS2J'),
('EDUC1'),
('Test 1'),
('Test 3'),
('Test2');

-- --------------------------------------------------------

--
-- Table structure for table `student-subjects`
--

CREATE TABLE `student-subjects` (
  `studentid` varchar(50) NOT NULL,
  `subject-code` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `student-subjects`
--

INSERT INTO `student-subjects` (`studentid`, `subject-code`) VALUES
('00010', 'CC101'),
('00010', 'CC102'),
('00010', 'CC106'),
('00010', 'CC107'),
('00011', 'CC101'),
('00011', 'CC102'),
('0002', 'CC101'),
('0002', 'CC102'),
('0002', 'CC103'),
('0002', 'CC104'),
('0002', 'CC105'),
('0002', 'CC106'),
('0002', 'CC107'),
('0002', 'CC108'),
('0002', 'CC109'),
('0002', 'CC110'),
('0002', 'CC111'),
('0002', 'DC102'),
('0002', 'TRY123'),
('0003', 'CC101'),
('0003', 'CC102'),
('0003', 'CC103'),
('0003', 'CC104'),
('0003', 'CC105'),
('0003', 'CC106'),
('0003', 'CC107'),
('0003', 'CC108'),
('0003', 'CC109'),
('0003', 'CC110'),
('0003', 'CC111'),
('0003', 'DC102'),
('0003', 'TRY123'),
('0004', 'CC101'),
('0004', 'CC102'),
('0004', 'CC103'),
('0004', 'CC104'),
('0004', 'CC105'),
('0004', 'CC106'),
('0004', 'CC107'),
('0004', 'CC108'),
('0004', 'CC109'),
('0004', 'CC110'),
('0004', 'CC111'),
('0004', 'DC102'),
('0004', 'TRY123'),
('0005', 'CC101'),
('0005', 'CC102'),
('0005', 'CC103'),
('0005', 'CC104'),
('0005', 'CC105'),
('0005', 'CC106'),
('0005', 'CC107'),
('0005', 'CC108'),
('0005', 'CC109'),
('0005', 'CC110'),
('0005', 'CC111'),
('0005', 'DC102'),
('0005', 'TRY123'),
('0008', 'CC101'),
('0008', 'CC104'),
('0008', 'CC107'),
('0008', 'CC108'),
('7777', 'CC101'),
('7777', 'CC106'),
('7777', 'CC108'),
('7777', 'CC109'),
('7777', 'DC102');

-- --------------------------------------------------------

--
-- Table structure for table `students-tbl`
--

CREATE TABLE `students-tbl` (
  `studentid` varchar(50) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `mi` varchar(10) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `section` varchar(50) NOT NULL,
  `enrollmentStatus` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students-tbl`
--

INSERT INTO `students-tbl` (`studentid`, `lastName`, `firstName`, `mi`, `gender`, `section`, `enrollmentStatus`) VALUES
('00010', 'Cruz', 'Angela', 'L', 'Female', 'BSCS2A', 'Irregular'),
('00011', 'Cruz', 'Jhon Vincent', 'R', 'Male', 'BSCS2A', 'Regular'),
('0002', 'Murin', 'Gigi', 'L', 'Female', 'BSCS2F', 'Regular'),
('0003', 'Lname3', 'Fname3', 'L', 'Female', 'BSCS2A', 'Regular'),
('0004', 'Lname4', 'Fname3', 'L', 'Female', 'BSCS2A', 'Regular'),
('0005', 'Lname5', 'Fname5', 'L', 'Male', 'BSCS2A', 'Regular'),
('0008', 'Last Name', 'First Name', 'L', 'Male', 'BSCS2A', 'Irregular'),
('7777', 'Murin', 'Gigi', 'R', 'Female', 'Test 1', 'Regular');

-- --------------------------------------------------------

--
-- Table structure for table `subject-code-tbl`
--

CREATE TABLE `subject-code-tbl` (
  `subject-code` varchar(50) NOT NULL,
  `subject-name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subject-code-tbl`
--

INSERT INTO `subject-code-tbl` (`subject-code`, `subject-name`) VALUES
('', ''),
('CC101', 'adadw'),
('CC102', 'Test2'),
('CC104', ''),
('CC105', ''),
('CC106', ''),
('CC107', ''),
('CC108', ''),
('CC109', ''),
('CC110', ''),
('CC111', ''),
('CC250', ''),
('DC102', 'Web Development 2'),
('TRY123', 'For Testing');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_record`
--
ALTER TABLE `attendance_record`
  ADD PRIMARY KEY (`attendanceid`),
  ADD KEY `studentid` (`studentid`),
  ADD KEY `subject-code` (`subject-code`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `section-tbl`
--
ALTER TABLE `section-tbl`
  ADD PRIMARY KEY (`section`);

--
-- Indexes for table `student-subjects`
--
ALTER TABLE `student-subjects`
  ADD PRIMARY KEY (`studentid`,`subject-code`);

--
-- Indexes for table `students-tbl`
--
ALTER TABLE `students-tbl`
  ADD PRIMARY KEY (`studentid`);

--
-- Indexes for table `subject-code-tbl`
--
ALTER TABLE `subject-code-tbl`
  ADD PRIMARY KEY (`subject-code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_record`
--
ALTER TABLE `attendance_record`
  MODIFY `attendanceid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_record`
--
ALTER TABLE `attendance_record`
  ADD CONSTRAINT `attendance_record_ibfk_2` FOREIGN KEY (`subject-code`) REFERENCES `subject-code-tbl` (`subject-code`),
  ADD CONSTRAINT `attendance_record_ibfk_3` FOREIGN KEY (`section`) REFERENCES `section-tbl` (`section`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
