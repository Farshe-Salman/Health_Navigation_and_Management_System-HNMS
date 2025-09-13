-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2025 at 07:33 PM
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
-- Database: `project_p`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `AppointmentID` int(11) NOT NULL,
  `PatientName` varchar(100) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `HospitalID` int(11) NOT NULL,
  `HospitalName` varchar(100) NOT NULL,
  `SerialNumber` int(11) DEFAULT NULL,
  `StartTime` time DEFAULT NULL,
  `SerialTime` time DEFAULT NULL,
  `Date` date NOT NULL,
  `Status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_services`
--

CREATE TABLE `diagnostic_services` (
  `service_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `regular_price` decimal(10,2) NOT NULL,
  `discount_rate` decimal(5,0) DEFAULT 0,
  `discount_price` decimal(10,2) GENERATED ALWAYS AS (`regular_price` * (1 - `discount_rate` / 100)) STORED,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnostic_services`
--

INSERT INTO `diagnostic_services` (`service_id`, `hospital_id`, `service_name`, `regular_price`, `discount_rate`, `created_at`) VALUES
(2, 1, 'Anesthesia for CT.Scan of Whole Abdomen', 2500.00, 25, '2025-08-31 21:10:03'),
(3, 1, 'CLO Test (DFARUQUE)', 1000.00, 20, '2025-08-31 21:14:59'),
(4, 1, 'CBEC', 2000.00, 20, '2025-08-31 21:15:57'),
(5, 1, 'CBC', 800.00, 10, '2025-08-31 21:16:13'),
(6, 1, 'Blood Group & RH Factor', 200.00, 0, '2025-08-31 21:16:25'),
(7, 1, 'BT,CT (Bleeding time & clotting time)', 300.00, 0, '2025-08-31 21:16:53'),
(8, 1, 'Anti HAV - IgM', 1200.00, 20, '2025-08-31 21:17:15');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `qualification` varchar(150) DEFAULT NULL,
  `experience_years` int(11) DEFAULT NULL,
  `consultation_fee` decimal(10,2) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `schedule_days` varchar(100) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `hospital_id`, `name`, `specialization`, `qualification`, `experience_years`, `consultation_fee`, `photo`, `schedule_days`, `start_time`, `end_time`) VALUES
(1, 1, 'salman', 'ent', 'mbbs', 2, 1000.00, 'Capture.PNG', 'sun', '02:58:00', '03:59:00'),
(3, 1, 'Md. Salman Farshe', 'ent', 'mbbs', 2, 2222.00, 'lol3.PNG', 'sun', '15:02:00', '17:02:00'),
(7, 2, 'Shizan Srakar', 'Cardiologist', 'MBBS, FCPS', 3, 1000.00, 'doc1.png', 'Thursday, Fridfay', '04:08:00', '07:06:00'),
(15, 2, 'Miyoko Mahzabin', 'Anesthesiology', 'MBBS, FCPS, FPS', 10, 1200.00, 'doc3.png', 'Sun,Tues,Thursday', '18:00:00', '22:00:00'),
(18, 1, 'mim', 'Anesthesiology', 'MBBS, FCPS', 3, 1000.00, 'doc3.png', 'Friday', '09:00:00', '12:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hospital_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `name`, `location`, `contact`) VALUES
(1, 'ibnesina', 'dhaka', '013'),
(2, 'popular', 'Badda, Dhaka', '01319945481');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `name`, `age`, `gender`, `contact`) VALUES
(1, 'salman farshe', NULL, NULL, NULL),
(2, 'AFga', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `surgery`
--

CREATE TABLE `surgery` (
  `surgery_id` int(11) NOT NULL,
  `hospital_id` int(11) NOT NULL,
  `surgery_name` varchar(255) NOT NULL,
  `price_in_word` varchar(255) DEFAULT NULL,
  `price_in_standard` decimal(10,0) DEFAULT NULL,
  `price_in_deluxe` decimal(10,0) DEFAULT NULL,
  `price_in_suite` decimal(10,0) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surgery`
--

INSERT INTO `surgery` (`surgery_id`, `hospital_id`, `surgery_name`, `price_in_word`, `price_in_standard`, `price_in_deluxe`, `price_in_suite`, `duration`, `created_at`) VALUES
(1, 1, 'Fistula', '27000', 30000, 32000, 35000, '3', '2025-08-31 21:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `surgery_packages`
--

CREATE TABLE `surgery_packages` (
  `package_id` int(11) NOT NULL,
  `hospital_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userlogin`
--

CREATE TABLE `userlogin` (
  `UserId` int(4) UNSIGNED NOT NULL,
  `UserName` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `UserType` enum('patient','hospital','pharmacy','admin') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('patient','hospital') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`) VALUES
(1, 'salmanfarshe3071@gmail.com', '$2y$10$23S00etzKvbRacmhL0uBueoickP9tUq29l3BMxZx3Nd77YDr87rRi', 'patient'),
(2, 'patient', '$2y$10$gDr/ejzL76jd9kfBNJeE7.cUBbQG4y.sBlQQR08EyKpNQBOXNyv8i', 'patient'),
(3, 'hospital', '$2y$10$QQYa448ZBNyMzN9mzzZ.heC5m7SPpoHVmk78kIV6ZY/jpe8Qljy5u', 'hospital'),
(4, 'ibnesina', '$2y$10$QJu7muneTXUowCVwi1BB6epz1e.bmzf4qRsk0UJepmHi4n9d/oVTG', 'hospital');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `DoctorID` (`DoctorID`);

--
-- Indexes for table `diagnostic_services`
--
ALTER TABLE `diagnostic_services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`hospital_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `surgery`
--
ALTER TABLE `surgery`
  ADD PRIMARY KEY (`surgery_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `surgery_packages`
--
ALTER TABLE `surgery_packages`
  ADD PRIMARY KEY (`package_id`),
  ADD KEY `hospital_id` (`hospital_id`);

--
-- Indexes for table `userlogin`
--
ALTER TABLE `userlogin`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `UserName_U` (`UserName`),
  ADD UNIQUE KEY `Email_U` (`Email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `diagnostic_services`
--
ALTER TABLE `diagnostic_services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surgery`
--
ALTER TABLE `surgery`
  MODIFY `surgery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `surgery_packages`
--
ALTER TABLE `surgery_packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userlogin`
--
ALTER TABLE `userlogin`
  MODIFY `UserId` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`DoctorID`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE;

--
-- Constraints for table `diagnostic_services`
--
ALTER TABLE `diagnostic_services`
  ADD CONSTRAINT `diagnostic_services_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`);

--
-- Constraints for table `surgery`
--
ALTER TABLE `surgery`
  ADD CONSTRAINT `surgery_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`) ON DELETE CASCADE;

--
-- Constraints for table `surgery_packages`
--
ALTER TABLE `surgery_packages`
  ADD CONSTRAINT `surgery_packages_ibfk_1` FOREIGN KEY (`hospital_id`) REFERENCES `hospitals` (`hospital_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
