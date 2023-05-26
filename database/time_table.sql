-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2023 at 11:54 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `time_table`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(30) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `hash_password` varchar(255) NOT NULL,
  `last_seen` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_email`, `hash_password`, `last_seen`) VALUES
(1, 'amtech', 'amtechdigitalnetworks@gmail.com', 'admin', '2023-05-04 16:51:25'),
(2, 'Abdulsalam Abdulrahman', 'abdulsalamamtech@gmail.com', 'amtech', '2023-05-07 14:48:56');

-- --------------------------------------------------------

--
-- Table structure for table `classroom`
--

CREATE TABLE `classroom` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(30) NOT NULL,
  `class_title` varchar(50) NOT NULL,
  `class_capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classroom`
--

INSERT INTO `classroom` (`class_id`, `class_name`, `class_title`, `class_capacity`) VALUES
(15, 'LR1', 'Lecture Room 1', 350),
(16, 'LR2', 'Lecture Room 2', 300),
(17, 'LR3', 'Lecture Room 3', 400),
(18, 'LR4', 'Lecture Room 4', 420),
(19, 'THA-A', 'Theatre  A', 520),
(20, 'CIT', 'Center For Information Technology', 500),
(21, 'LAB 1', 'Computer Laboratory', 200);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(7) NOT NULL,
  `course_title` varchar(50) NOT NULL,
  `credit_unit` int(1) NOT NULL,
  `level` int(1) NOT NULL,
  `department` varchar(30) NOT NULL,
  `semester` int(1) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_title`, `credit_unit`, `level`, `department`, `semester`, `status`) VALUES
(17, 'EEP3201', 'Entrepreneurship And Innovation', 2, 3, 'EEP', 1, ''),
(18, 'CBS4207', 'Enterprise Security And Inovation Assurance', 2, 4, 'CBS', 1, ''),
(19, 'ITC4204', 'Mobile Application Development', 2, 4, 'ITC', 1, ''),
(20, 'ITC4223', 'Ethics And Professional Practice', 2, 4, 'ITC', 1, ''),
(21, 'ITC4303', 'Applied Networks And Security', 3, 4, 'ITC', 1, ''),
(22, 'ITC4305', 'Integrative Programming And Technologies', 3, 4, 'ITC', 1, ''),
(23, 'ITC4306', 'Mobile And Pervasive Computing', 3, 4, 'ITC', 1, ''),
(24, 'ITC4331', 'Database Administration', 3, 4, 'ITC', 1, ''),
(25, 'SWE4203', 'Project Management', 2, 4, 'SWE', 1, ''),
(26, 'EEP4201', 'Venture Creation And Growth', 2, 4, 'EEP', 1, ''),
(27, 'ITC4307', 'System Administration And Management', 3, 4, 'ITC', 1, ''),
(28, 'ITC4215', 'Special Topics In It', 2, 4, 'ITC', 1, ''),
(29, 'ITC4344', 'Cloud Computing', 3, 4, 'ITC', 2, ''),
(30, 'ITC4600', 'Project', 6, 4, 'ITC', 2, ''),
(31, 'CSC4203', 'Concepts Of Programming Languages', 2, 4, 'COM', 2, '');

-- --------------------------------------------------------

--
-- Table structure for table `depertment`
--

CREATE TABLE `depertment` (
  `dept_id` int(11) NOT NULL,
  `dept_title` varchar(11) NOT NULL,
  `dept_name` varchar(50) NOT NULL,
  `dept_status` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `depertment`
--

INSERT INTO `depertment` (`dept_id`, `dept_title`, `dept_name`, `dept_status`) VALUES
(1, 'ITC', 'Information Technology', ''),
(2, 'COM', 'Computer Science', ''),
(5, 'CBS', 'Cyber Security', ''),
(8, 'SWE', 'Software Engineering', ''),
(12, 'EEP', 'School Of Entrepreneurship Program', '');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `staff_id` int(11) NOT NULL,
  `staff_title` varchar(14) NOT NULL,
  `staff_first_name` varchar(30) NOT NULL,
  `staff_last_name` varchar(30) NOT NULL,
  `staff_mid_name` varchar(30) NOT NULL,
  `staff_email` varchar(50) NOT NULL,
  `staff_phone_number` varchar(14) NOT NULL,
  `hash_password` varchar(255) NOT NULL,
  `staff_course` varchar(255) NOT NULL,
  `rank` varchar(30) NOT NULL,
  `status` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`staff_id`, `staff_title`, `staff_first_name`, `staff_last_name`, `staff_mid_name`, `staff_email`, `staff_phone_number`, `hash_password`, `staff_course`, `rank`, `status`) VALUES
(1, 'Dr.', 'Habibah', 'Kakudi', 'Adamu', 'habibakadamu@gmail.com', '+2349091922467', 'habibah', 'ITC4344', 'Senir Lecturer', ''),
(108, 'Prof.', 'Abdulrahman', 'Abdulsalam', 'Musftau', 'abdulsalamamtech@gmail.com', '+2349091922467', '', 'ITC4600', 'Proffesor', ''),
(113, 'Prof.', 'Bashir', 'Yakasai', 'M.', 'bashiryakasai@gmail.com', '+1234567890', '', 'SWE4203', 'Proffesor', ''),
(114, 'Dr.', 'Amina', 'Muhammad', 'Lawal', 'aminamuhammad@gmail.com', '+0987654321', '', 'ITC4344', 'Senir Lecturer', ''),
(115, 'Dr.', 'Mansur', 'Muhammad', 'Zubairu', 'mansurmuhammad@gmail.com', '+1236547890', '', 'ITC4307', 'Lecturer Ii', ''),
(116, 'Dr.', 'Muhammad', 'Muhammad', '', 'muhammadhassan@gmail.com', '+0981234567', '', 'ITC4306', 'Senir Lecturer', ''),
(117, 'Mallam.', 'Saminu', 'Muhammad', 'Aliyu', 'saminumuhammad@gmail.com', '+0912453678', '', 'ITC4305', 'Senir Lecturer', ''),
(118, 'Dr.', 'Maryam', 'Ibrahim', 'Mukhtar', 'maryamibrahim@gmail.com', '+9087652341', '', 'ITC4303', 'Senir Lecturer', ''),
(119, 'Mallam.', 'Sagir', 'Musa', 'Tanimu', 'sagirmusa@gmail.com', '+09787645321', '', 'ITC4215', 'Lecturer Ii', ''),
(120, 'Mr.', 'Zahraddeen', 'Zahraddeen', '', 'zahaddeen@gmail.com', '+1234560987', '', 'ITC4204', 'Lecturer I', ''),
(121, 'Dr.', 'F.', 'F.', 'Ambursa', 'ambursa@gmail.com', '+0977857432', '', 'EEP4201', 'Reader/associate Prof.', ''),
(122, 'Mallam.', 'Murjanatu', 'Gadanya', 'S.', 'mujanatu@gmail.com', '+09896653232', '', 'CSC4203', 'Assistant Lecturer', '');

-- --------------------------------------------------------

--
-- Table structure for table `timetable_first_semester`
--

CREATE TABLE `timetable_first_semester` (
  `id` int(11) NOT NULL,
  `day` varchar(15) NOT NULL,
  `time8_9` varchar(10) NOT NULL,
  `time8_9class` varchar(30) NOT NULL,
  `time9_10` varchar(10) NOT NULL,
  `time9_10class` varchar(30) NOT NULL,
  `time10_11` varchar(10) NOT NULL,
  `time10_11class` varchar(30) NOT NULL,
  `time11_12` varchar(10) NOT NULL,
  `time11_12class` varchar(30) NOT NULL,
  `time12_1` varchar(10) NOT NULL,
  `time12_1class` varchar(30) NOT NULL,
  `time1_2` varchar(10) NOT NULL,
  `time1_2class` varchar(30) NOT NULL,
  `time2_3` varchar(10) NOT NULL,
  `time2_3class` varchar(30) NOT NULL,
  `time3_4` varchar(10) NOT NULL,
  `time3_4class` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `timetable_first_semester`
--

INSERT INTO `timetable_first_semester` (`id`, `day`, `time8_9`, `time8_9class`, `time9_10`, `time9_10class`, `time10_11`, `time10_11class`, `time11_12`, `time11_12class`, `time12_1`, `time12_1class`, `time1_2`, `time1_2class`, `time2_3`, `time2_3class`, `time3_4`, `time3_4class`) VALUES
(1, 'MONDAY', 'CBS4207', 'CIT', '', '', 'EEP3201', 'LR1', '', '', 'ITC4204', 'LR3', '', '', 'ITC4215', 'LR3', '', ''),
(2, 'TUESDAY ', 'CBS4207', 'CIT', 'EEP3201', 'LR1', 'EEP4201', 'LR2', 'ITC4215', 'LR2', 'ITC4303', 'LR3', '', '', 'ITC4223', 'THA-A', 'SWE4203', 'THA-A'),
(3, 'WEDNESDAY ', '', '', 'SWE4203', 'THA-A', '', '', '', '', 'ITC4344', 'CIT', '', '', '', '', '', ''),
(4, 'THURSDAY ', '', '', 'ITC4215', 'LR1', 'ITC4305', 'CIT', '', '', '', '', 'ITC4344', 'LR3', 'ITC4344', 'LR3', '', ''),
(5, 'FRIDAY ', 'ITC4303', 'CIT', 'ITC4307', 'LR4', '', '', 'ITC4344', 'LR2', 'EEP3201', 'LR4', '', '', '', '', '', ''),
(6, 'SATURDAY', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `depertment`
--
ALTER TABLE `depertment`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `timetable_first_semester`
--
ALTER TABLE `timetable_first_semester`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classroom`
--
ALTER TABLE `classroom`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `depertment`
--
ALTER TABLE `depertment`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `timetable_first_semester`
--
ALTER TABLE `timetable_first_semester`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
