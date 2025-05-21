-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 04:57 AM
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
(135, '0001', 'CC101', 'BSCS2A', '2025-04-30 16:33:07'),
(136, '0002', 'CC101', 'BSCS2A', '2025-04-30 16:34:13'),
(137, '0003', 'CC101', 'BSCS2A', '2025-04-30 16:34:19'),
(138, '0004', 'CC101', 'BSCS2A', '2025-04-30 16:34:22'),
(139, '0005', 'CC101', 'BSCS2A', '2025-04-30 16:34:25'),
(140, '0006', 'CC101', 'BSCS2A', '2025-04-30 16:34:28'),
(141, '0007', 'CC101', 'BSCS2A', '2025-04-30 16:34:31'),
(142, '0008', 'CC101', 'BSCS2A', '2025-04-30 16:34:35'),
(143, '0009', 'CC101', 'BSCS2A', '2025-04-30 16:34:37'),
(144, '0010', 'CC101', 'BSCS2A', '2025-04-30 16:58:50'),
(145, '0010', 'CC109', 'BSCS2A', '2025-04-30 17:17:26'),
(146, '0001', 'CC109', 'BSCS2A', '2025-04-30 17:17:28'),
(147, '0002', 'CC109', 'BSCS2A', '2025-04-30 17:17:30'),
(148, '0003', 'CC109', 'BSCS2A', '2025-04-30 17:17:33'),
(149, '0003', 'CC111', 'BSCS2A', '2025-04-30 17:21:33'),
(150, '0004', 'CC111', 'BSCS2A', '2025-04-30 17:21:36'),
(151, '0005', 'CC111', 'BSCS2A', '2025-04-30 17:21:38'),
(152, '0006', 'CC111', 'BSCS2A', '2025-04-30 17:21:40');

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
('BSCS2B'),
('BSCS2C'),
('BSCS2E'),
('BSCS2F'),
('BSCS2G'),
('BSCS2H'),
('BSCS2J'),
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
('0001', 'CC101'),
('0001', 'CC102'),
('0001', 'CC103'),
('0001', 'CC104'),
('0001', 'CC105'),
('0001', 'CC106'),
('0001', 'CC107'),
('0001', 'CC108'),
('0001', 'CC109'),
('0001', 'CC110'),
('0001', 'CC111'),
('0001', 'DC102'),
('0001', 'TRY123'),
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
('0006', 'CC101'),
('0006', 'CC102'),
('0006', 'CC103'),
('0006', 'CC104'),
('0006', 'CC105'),
('0006', 'CC106'),
('0006', 'CC107'),
('0006', 'CC108'),
('0006', 'CC109'),
('0006', 'CC110'),
('0006', 'CC111'),
('0006', 'DC102'),
('0006', 'TRY123'),
('0007', 'CC101'),
('0007', 'CC102'),
('0007', 'CC103'),
('0007', 'CC104'),
('0007', 'CC105'),
('0007', 'CC106'),
('0007', 'CC107'),
('0007', 'CC108'),
('0007', 'CC109'),
('0007', 'CC110'),
('0007', 'CC111'),
('0007', 'DC102'),
('0007', 'TRY123'),
('0008', 'CC101'),
('0008', 'CC102'),
('0008', 'CC103'),
('0008', 'CC104'),
('0008', 'CC105'),
('0008', 'CC106'),
('0008', 'CC107'),
('0008', 'CC108'),
('0008', 'CC109'),
('0008', 'CC110'),
('0008', 'CC111'),
('0008', 'DC102'),
('0008', 'TRY123'),
('0009', 'CC101'),
('0009', 'CC102'),
('0009', 'CC103'),
('0009', 'CC104'),
('0009', 'CC105'),
('0009', 'CC106'),
('0009', 'CC107'),
('0009', 'CC108'),
('0009', 'CC109'),
('0009', 'CC110'),
('0009', 'CC111'),
('0009', 'DC102'),
('0009', 'TRY123');

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
('0001', 'Change2', 'Maria', 'C', 'Female', 'BSCS2A', 'Regular'),
('0002', 'Cruz', 'Juan', 'M', 'Male', 'BSCS2A', 'Regular'),
('0003', 'Cruz', 'Angela', 'L', 'Female', 'BSCS2A', 'Regular'),
('0004', 'Bagu', 'Isabel', 'Q', 'Female', 'BSCS2A', 'Regular'),
('0005', 'Ramos', 'Carlo', 'A', 'Male', 'BSCS2A', 'Regular'),
('0006', 'Medoza', 'Katrina', 'O', 'Female', 'BSCS2A', 'Regular'),
('0007', 'Aquino', 'Bryan', 'B', 'Male', 'BSCS2A', 'Regular'),
('0008', 'Torress', 'Hannah', 'F', 'Female', 'BSCS2A', 'Regular'),
('0009', 'Quezon', 'Ricky', 'K', 'Male', 'BSCS2A', 'Regular'),
('0010', 'Navaro', 'Miguel', 'T', 'Male', 'BSCS2A', 'Regular');

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
('CC101', 'Test1'),
('CC102', 'Test2'),
('CC103', 'Test3'),
('CC104', ''),
('CC105', ''),
('CC106', ''),
('CC107', ''),
('CC108', ''),
('CC109', ''),
('CC110', ''),
('CC111', ''),
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
  MODIFY `attendanceid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance_record`
--
ALTER TABLE `attendance_record`
  ADD CONSTRAINT `attendance_record_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `students-tbl` (`studentid`),
  ADD CONSTRAINT `attendance_record_ibfk_2` FOREIGN KEY (`subject-code`) REFERENCES `subject-code-tbl` (`subject-code`),
  ADD CONSTRAINT `attendance_record_ibfk_3` FOREIGN KEY (`section`) REFERENCES `section-tbl` (`section`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
