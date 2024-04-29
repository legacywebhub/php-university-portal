-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2024 at 01:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uniportal_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `correct_option` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `lecturers` varchar(160) DEFAULT NULL,
  `course_image` varchar(255) DEFAULT NULL,
  `course_code` varchar(10) NOT NULL,
  `title` varchar(60) NOT NULL,
  `description` text DEFAULT NULL,
  `price` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `department_id`, `level`, `semester`, `lecturers`, `course_image`, `course_code`, `title`, `description`, `price`) VALUES
(2, 2, 100, 2, 'Dr. Paulson Bosah', NULL, 'MAT 202', 'Linear Algebras', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quisquam a provident sunt et atque temporibus suscipit numquam animi tempora culpa, repudiandae doloribus sit nulla tempore, fuga, rem rerum enim saepe fugit dolores perspiciatis! Eaque obcaecati tempora voluptate, distinctio quisquam est impedit corrupti quo nisi a nam magnam, praesentium minima veniam.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `department_code` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `short_name` varchar(60) NOT NULL,
  `start_level` int(11) NOT NULL,
  `end_level` int(11) NOT NULL,
  `head_of_department` varchar(150) DEFAULT NULL,
  `reg_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `faculty_id`, `department_code`, `name`, `short_name`, `start_level`, `end_level`, `head_of_department`, `reg_date`) VALUES
(1, 1, 374, 'Industrial And Production Engineering', 'IPE', 100, 500, '', '2024-02-09'),
(2, 3, 254, 'Computer Science', 'CSC', 100, 400, '', '2024-02-09'),
(3, 3, 215, 'Mathematics', 'MAT', 100, 400, '', '2024-02-09'),
(4, 1, 375, 'Mechanical Engineering', 'MCE', 100, 500, NULL, '2024-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `document` varchar(1050) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `lesson_id`, `document`) VALUES
(5, 1, 'DOC-65dbbbecb83ba8.03848449.docx');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `reg_date` date DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `name`, `reg_date`) VALUES
(1, 'Faculty of Engineering', '2024-02-08'),
(2, 'Faculty of Arts', '2024-02-08'),
(3, 'Faculty of Physical Sciences', '2024-02-08'),
(4, 'Faculty of Social Science', '2024-04-29'),
(5, 'Faculty of Law', '2024-04-29');

-- --------------------------------------------------------

--
-- Table structure for table `fees`
--

CREATE TABLE `fees` (
  `id` int(11) NOT NULL,
  `invoice_id` varchar(30) NOT NULL,
  `student_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `purpose` varchar(60) NOT NULL,
  `details` text DEFAULT NULL,
  `payment_method` varchar(60) NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `fees`
--

INSERT INTO `fees` (`id`, `invoice_id`, `student_id`, `department_id`, `level`, `amount`, `purpose`, `details`, `payment_method`, `date`) VALUES
(1, '159294736', 1, 2, 100, 1000, 'Fess Type', NULL, 'card', '2024-03-06 13:48:21'),
(2, '554463789', 1, 2, 100, 50000, '100Level School Fee', NULL, 'card', '2024-03-06 13:55:57'),
(3, '720101166', 1, 2, 100, 50, '100Level GS Fee', NULL, 'card', '2024-03-06 14:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(11) NOT NULL,
  `type` varchar(60) NOT NULL,
  `payment` varchar(60) NOT NULL,
  `details` text DEFAULT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(160) NOT NULL,
  `content` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `content`) VALUES
(1, 2, 'Engineering drawing', '<div style=\"line-height: 19px;\"><b>Lorem ipsum</b> <b>dolor sit</b>, amet consectetur adipisicing elit. Rerum ad totam, alias aperiam nihil quod incidunt recusandae aut mollitia, iure repudiandae eos doloremque ab nisi inventore? Ratione cupiditate totam necessitatibus aperiam, reprehenderit aut ducimus iure quasi aspernatur, corporis delectus illum labore. Ducimus culpa, repudiandae doloribus nesciunt cumque totam autem ad.</div>');

-- --------------------------------------------------------

--
-- Table structure for table `levels`
--

CREATE TABLE `levels` (
  `id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `name` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(60) DEFAULT NULL,
  `message` text NOT NULL,
  `date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `date`) VALUES
(1, 1, 1, 'First message', 'This is my first message insha allah', '2024-03-01 07:55:55'),
(2, 1, 1, 'Message reply', 'First reply', '2024-03-01 17:49:18'),
(3, 1, 1, 'Message reply', 'First reply', '2024-03-01 17:49:50'),
(4, 1, 1, 'Message reply', 'Testing the mic 1 2', '2024-03-01 18:05:04'),
(5, 1, 3, 'New message to Favour', 'bla bla bla', '2024-03-01 18:08:25');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option` varchar(1) NOT NULL,
  `text` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `test_id` int(11) NOT NULL,
  `text` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `expires`) VALUES
(6, 'engineering', '2024-04-27 15:00:16');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `id` int(11) NOT NULL,
  `semester` int(11) NOT NULL,
  `name` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `motto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `email`, `phone`, `address`, `motto`) VALUES
(1, 'Nnamdi Azikiwe University', 'email@gmail.com', '09160755152', 'Ifite Road', 'Leaders of tomorrow');

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(20) NOT NULL,
  `department_id` int(11) NOT NULL,
  `passport` varchar(255) DEFAULT NULL,
  `role` varchar(60) NOT NULL,
  `title` varchar(10) DEFAULT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `is_blocked` tinyint(4) DEFAULT 0,
  `is_superuser` tinyint(4) DEFAULT 0,
  `reg_date` date DEFAULT current_timestamp(),
  `reset_token_hash` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `staff_id`, `department_id`, `passport`, `role`, `title`, `firstname`, `middlename`, `lastname`, `gender`, `dob`, `email`, `phone`, `password`, `is_blocked`, `is_superuser`, `reg_date`, `reset_token_hash`, `reset_token_expires`) VALUES
(1, '2024374144', 1, 'IMG-65c7e647c89ea6.23813515.jpg', 'professor', 'Engr.', 'Paulson', '', 'Bosah', 'M', NULL, 'legacywebhub@gmail.com', '09160755152', '$2y$10$2UpzBY81ys5dXAEEM25YwO288nkxuWtEzLrA/HKcwJSkyDu/fBONq', 0, 1, '2024-02-10', NULL, NULL),
(2, '2024374036', 1, 'IMG-65c7e647c89ea6.23813515.jpg', 'professor', 'Engr.', 'Chinedu', NULL, 'Egwu', 'M', NULL, 'paulsonbosah@gmail.com', '09017570620', '$2y$10$2UpzBY81ys5dXAEEM25YwO288nkxuWtEzLrA/HKcwJSkyDu/fBONq', 0, 0, '2024-04-26', NULL, NULL),
(3, '2024254144', 2, NULL, 'professor', 'Dr.', 'Joy', '', 'Anekwe', 'F', NULL, 'joyanekwe@gmail.com', '09160755152', '$2y$10$2UpzBY81ys5dXAEEM25YwO288nkxuWtEzLrA/HKcwJSkyDu/fBONq', 0, 1, '2024-02-10', NULL, NULL),
(4, '2024254001', 2, NULL, 'hod', 'Dr.', 'Legacy', 'Web', 'Hub', 'M', NULL, 'legacywebtechnologies@gmail.com', NULL, '$2y$10$2UpzBY81ys5dXAEEM25YwO288nkxuWtEzLrA/HKcwJSkyDu/fBONq', 0, 1, '2024-02-10', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `matric_number` varchar(20) NOT NULL,
  `department_id` int(11) NOT NULL,
  `level` int(11) DEFAULT 100,
  `passport` varchar(255) DEFAULT NULL,
  `firstname` varchar(30) NOT NULL,
  `middlename` varchar(30) DEFAULT NULL,
  `lastname` varchar(30) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `dob` date DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `email` varchar(60) NOT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `parent_name` varchar(100) DEFAULT NULL,
  `parent_email` varchar(60) DEFAULT NULL,
  `parent_phone` varchar(60) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` date DEFAULT current_timestamp(),
  `is_blocked` tinyint(4) DEFAULT 0,
  `reset_token_hash` varchar(255) DEFAULT NULL,
  `reset_token_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `matric_number`, `department_id`, `level`, `passport`, `firstname`, `middlename`, `lastname`, `gender`, `dob`, `blood_group`, `email`, `phone`, `address`, `parent_name`, `parent_email`, `parent_phone`, `password`, `reg_date`, `is_blocked`, `reset_token_hash`, `reset_token_expires`) VALUES
(1, 'CSC/078741/24', 2, 100, 'IMG-65c7fb453a8b99.58584436.jpg', 'Paulson', 'Chinedu', 'Bosah', 'M', '0000-00-00', NULL, 'legacywebhub@gmail.com', '09160755152', NULL, NULL, NULL, NULL, '$2y$10$QbbGE/ktM7SopfTiNEbrnumVdCn20C0GD5F38pttln.fxrVRE//Zm', '2024-02-10', 0, NULL, NULL),
(2, 'CSC/003192/24', 2, 100, NULL, 'Victor', 'Chukwudumebi', 'Egwu', 'M', '8991-01-10', NULL, 'dumebi@gmail.com', '09160755152', NULL, NULL, NULL, NULL, '$2y$10$0prTP1VG8V15CFEfKSoTd.GGu91/SHmyEHTVBKon9Qjl1ddx78jRa', '2024-02-12', 0, NULL, NULL),
(3, 'CSC/073429/24', 2, 100, 'IMG-65c9e9dc5c03b5.70878310.jpg', 'Favour', '', 'Bosah', 'M', '8991-01-10', NULL, 'favourbosah@gmail.com', '09160755152', NULL, NULL, NULL, NULL, '$2y$10$g76z6t97DFFRoSFw.4/8nuCwPrbylAFY8jKPemH0uyz9X4i30d3w6', '2024-02-12', 0, NULL, NULL),
(4, 'CSC/088741/24', 1, 100, NULL, 'Kingsley', 'Chibuike', 'Mmadu', 'M', NULL, NULL, 'kingsleymmadu@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$QbbGE/ktM7SopfTiNEbrnumVdCn20C0GD5F38pttln.fxrVRE//Zm', '2024-04-29', 0, NULL, NULL),
(5, 'CSC/000000/24', 1, 300, NULL, 'Peace', '', 'Ikemefuna', 'F', NULL, NULL, 'peaceikemefuna@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$QbbGE/ktM7SopfTiNEbrnumVdCn20C0GD5F38pttln.fxrVRE//Zm', '2024-04-29', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `test_score` int(11) DEFAULT 100,
  `score` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `lesson_id` int(11) NOT NULL,
  `video` varchar(1050) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `lesson_id`, `video`) VALUES
(2, 1, 'VID-65dbbbec733c34.77370950.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code_2` (`course_code`),
  ADD UNIQUE KEY `title_2` (`title`),
  ADD KEY `title` (`title`),
  ADD KEY `course_code` (`course_code`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `department_code` (`department_code`),
  ADD UNIQUE KEY `short_name_2` (`short_name`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD KEY `name` (`name`),
  ADD KEY `short_name` (`short_name`),
  ADD KEY `code` (`department_code`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `fees`
--
ALTER TABLE `fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `levels`
--
ALTER TABLE `levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name_2` (`name`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `semester_2` (`semester`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `semester` (`semester`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_id_2` (`staff_id`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `email` (`email`),
  ADD KEY `staff_id` (`staff_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `matric_number_2` (`matric_number`),
  ADD UNIQUE KEY `email_2` (`email`),
  ADD UNIQUE KEY `reset_token_hash` (`reset_token_hash`),
  ADD KEY `email` (`email`),
  ADD KEY `matric_number` (`matric_number`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lesson_id` (`lesson_id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `fees`
--
ALTER TABLE `fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `levels`
--
ALTER TABLE `levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
