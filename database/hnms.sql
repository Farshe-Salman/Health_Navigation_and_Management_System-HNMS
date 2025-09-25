-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2025 at 11:03 PM
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
-- Database: `hnms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(15) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `hospital_username` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `qualification` varchar(150) DEFAULT NULL,
  `experience_years` int(11) DEFAULT NULL,
  `consultation_fee` decimal(10,2) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `schedule_days` varchar(255) NOT NULL,
  `profile_image` varchar(255) NOT NULL,
  `medical_license` varchar(255) NOT NULL,
  `degree_certificate` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `hospital_username`, `doctor_name`, `email`, `contact`, `specialization`, `qualification`, `experience_years`, `consultation_fee`, `start_time`, `end_time`, `schedule_days`, `profile_image`, `medical_license`, `degree_certificate`, `username`, `password_hash`) VALUES
(1, '', 'Miyoko Mahzabin', 'miyoko@gmail.com', '23456', 'Cardiologist', 'MBBS', 3, 1000.00, '00:00:16', '18:00:00', 'Mon,Tue', 'doc3.png', '', '', '', '$2y$10$sA6JKNKvvkhCcFly2S/3iO156qjiLie.hbVux1jn2MhZQHPAlfQNa'),
(3, '', 'mim', 'mim@gmail.com', '23456', 'Cardiologist', 'MBBS', 3, 1000.00, '00:00:16', '18:00:00', 'Mon,Tue', 'doc3.png', '', '', 'mim', '$2y$10$4K63FefGjWYf94H2WQOnI.WyF8qBHjRKaOEtZIRXb87l0B.e.lOS6'),
(4, '', 'mim', 'mim@gmail.com', '01723456345', 'Cardiologist', 'MBBS', 4, 1000.00, '00:00:17', '19:13:00', 'Mon,Wed,Fri', 'doc3.png', '', '', 'mim', '$2y$10$I9PRW1RQkfE5EGkyrSjEhO7Bwqe/pyFu9AvdCKb.Vl6IGhHTUI9Wa');

-- --------------------------------------------------------

--
-- Table structure for table `hospitals`
--

CREATE TABLE `hospitals` (
  `hospital_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `category` enum('general','specialized','teaching') DEFAULT 'general',
  `profile_image` varchar(255) DEFAULT NULL,
  `license_file` varchar(255) DEFAULT NULL,
  `accreditation_file` varchar(255) DEFAULT NULL,
  `vat_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hospitals`
--

INSERT INTO `hospitals` (`hospital_id`, `username`, `hospital_name`, `email`, `phone`, `address`, `category`, `profile_image`, `license_file`, `accreditation_file`, `vat_file`) VALUES
(1, 'abc', 'ABC', 'abc@123', '0171223456767', 'Dhaka', 'specialized', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `blood_group` enum('A+','A-','B+','B-','AB+','AB-','O+','O-') DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `usertype` enum('admin','patient','hospital','pharmacy','doctor') NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `clearance_status` enum('pending','approved','rejected') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `usertype`, `password_hash`, `clearance_status`, `created_at`, `updated_at`) VALUES
(1, 'shizan', 'shizansarkar@gmail.com', 'patient', 'Shizan711@', 'approved', '2025-09-16 07:45:58', '2025-09-16 07:48:55'),
(12, 'ss', 'ssss@hh.com', 'patient', 'sd12@@S', 'approved', '2025-09-16 09:19:12', '2025-09-16 09:19:12'),
(19, 'rrr', 'salmanfarshe3071@gmail.com', 'patient', 'Shizna711@@jhsf', 'pending', '2025-09-16 09:40:52', '2025-09-16 09:40:52'),
(20, 'shizansarkar@gmail.com', 'shizansarkdewar@gmail.com', 'patient', 'Shiza711@@', 'pending', '2025-09-16 10:39:20', '2025-09-16 10:39:20'),
(21, 'SuperDuckSpecialist6', 'shizansarkdefwar@gmail.com', 'doctor', 'Shiznah711@', 'pending', '2025-09-16 17:50:21', '2025-09-16 17:50:21'),
(23, 'sss', 'shizansarkarsd@gmail.com', 'patient', '$2y$10$a.pWgAumYeXfah5cVyNvFee8o3tViC1K2XlDe50LlW1vQnxgNxLrO', 'approved', '2025-09-21 20:27:43', '2025-09-21 20:31:45'),
(24, 'miyoko', 'miyoko@gmail.com', 'patient', '$2y$10$zzKgCg5x5xU1VJyzmfbJwuNly26ItxUkQXtFd3VlVeYG4dflqQYv2', 'approved', '2025-09-23 06:13:47', '2025-09-23 06:19:35'),
(25, 'Islami hospital, Dhaka', 'islamihospital@gmail.com', 'hospital', '$2y$10$KA.tozc2yHTPM1YpDlPXS.9O02jsZn097KJsX3CPCpDKAybyjDIbO', 'approved', '2025-09-23 06:45:44', '2025-09-23 06:45:59'),
(26, 'islamia', 'islamia@gmail.com', 'hospital', '$2y$10$1O9fk5Bx2C7idRRDgLgwD.odQ0J8tHj7tA2nbmBUidH7vQEhG/P1S', 'approved', '2025-09-23 16:52:31', '2025-09-23 16:54:44'),
(27, 'abc', 'abc@gmail.com', 'hospital', '$2y$10$3VMw8dONtu4QeYQpCVKh1uV62qf5seP1TTBdLcVP0mKReRkOJRNVq', 'approved', '2025-09-23 16:56:58', '2025-09-23 16:57:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `hospital_username` (`hospital_username`);

--
-- Indexes for table `hospitals`
--
ALTER TABLE `hospitals`
  ADD PRIMARY KEY (`hospital_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(15) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
