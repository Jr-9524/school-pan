-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2025 at 07:03 AM
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
-- Table structure for table `attendance-record`
--

CREATE TABLE `attendance-record` (
  `attendanceid` int NOT NULL,
  `studentid` varchar(50) DEFAULT NULL,
  `subject-code` varchar(50) DEFAULT NULL,
  `section` varchar(50) DEFAULT NULL,
  `scan_dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_record` date DEFAULT NULL,
  `time_record` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
('097855', 'CC101'),
('097855', 'CC102'),
('097855', 'CC103'),
('097855', 'CC104'),
('097855', 'CC105'),
('097855', 'CC106'),
('097855', 'CC107'),
('097855', 'CC108'),
('097855', 'CC109'),
('097855', 'CC110'),
('097855', 'CC111'),
('123456', 'CC101'),
('123456', 'CC102'),
('123456', 'CC103'),
('123456', 'CC104'),
('123456', 'CC105'),
('123456', 'CC106'),
('123456', 'CC107'),
('123456', 'CC108'),
('123456', 'CC109'),
('123456', 'CC110'),
('123456', 'CC111'),
('2024-01-03', 'CC101'),
('2024-01-03', 'CC102'),
('2024-01-03', 'CC103'),
('2024-01-03', 'CC104'),
('2024-01-03', 'CC105'),
('2024-01-03', 'CC106'),
('2024-01-03', 'CC107'),
('2024-01-03', 'CC108'),
('2024-01-03', 'CC109'),
('2024-01-03', 'CC110'),
('2024-01-03', 'CC111'),
('2025-04-25', 'CC101'),
('2025-04-25', 'CC102'),
('2025-04-25', 'CC103'),
('2025-04-25', 'CC104'),
('2025-04-25', 'CC105'),
('2025-04-25', 'CC106'),
('2025-04-25', 'CC107'),
('2025-04-25', 'CC108'),
('2025-04-25', 'CC109'),
('2025-04-25', 'CC110'),
('2025-04-25', 'CC111'),
('2025-04-25', 'DC102');

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
('097855', 'Ruco', 'Rococo', 'R', 'Male', 'BSCS2A', 'Regular'),
('123456', 'Olan', 'Jhon Ruzzel', 'L', 'Male', 'BSCS2A', 'Regular'),
('2024-01-03', 'Borela', 'Renniel', '', 'Male', 'BSCS2H', 'Regular'),
('2025-04-25', 'Murin', 'Gigi', '', 'Female', 'Test 1', 'Regular');

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
('DC102', 'Web Development 2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance-record`
--
ALTER TABLE `attendance-record`
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
-- AUTO_INCREMENT for table `attendance-record`
--
ALTER TABLE `attendance-record`
  MODIFY `attendanceid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance-record`
--
ALTER TABLE `attendance-record`
  ADD CONSTRAINT `attendance-record_ibfk_1` FOREIGN KEY (`studentid`) REFERENCES `students-tbl` (`studentid`),
  ADD CONSTRAINT `attendance-record_ibfk_2` FOREIGN KEY (`subject-code`) REFERENCES `subject-code-tbl` (`subject-code`),
  ADD CONSTRAINT `attendance-record_ibfk_3` FOREIGN KEY (`section`) REFERENCES `section-tbl` (`section`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
