-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2025 at 01:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

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
(4, '', 'mim', 'mim@gmail.com', '01723456345', 'Cardiologist', 'MBBS', 4, 1000.00, '00:00:17', '19:13:00', 'Mon,Wed,Fri', 'doc3.png', '', '', 'mim', '$2y$10$I9PRW1RQkfE5EGkyrSjEhO7Bwqe/pyFu9AvdCKb.Vl6IGhHTUI9Wa'),
(6, 'green_clinic', 'Dr. Jane Smith', 'janesmith@example.com', '01887654321', 'Dermatology', 'MBBS, DDV', 7, 900.00, '10:00:00', '16:00:00', 'Tue-Sat', 'jane_smith.jpg', 'license_jane.pdf', 'degree_jane.pdf', 'janesmith', 'hashed_password2'),
(7, 'city_hospital', 'Dr. Alex Brown', 'alexbrown@example.com', '01911223344', 'Pediatrics', 'MBBS, MD', 5, 800.00, '08:30:00', '14:30:00', 'Mon-Fri', 'alex_brown.jpg', 'license_alex.pdf', 'degree_alex.pdf', 'alexbrown', 'hashed_password3');

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
(10, 'abcd', NULL, 'abcd@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `id_proof` varchar(255) DEFAULT NULL,
  `medical_record` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `username`, `full_name`, `email`, `contact`, `gender`, `dob`, `blood_group`, `address`, `profile_image`, `id_proof`, `medical_record`, `created_at`, `updated_at`) VALUES
(1, 'SuperDuckSpecialist11', 'Md shizan Sarkar', 'shizansarkar11@gmail.com', '01303672091', 'Male', '2025-02-18', 'B-', '1231,dhaka', '1758756399_d4a60a47_Profile.jpg', '1758756495_e757870d_ART1.png', '1758765138_ec4a984b_greenlife.jpg', '2025-09-24 21:52:20', '2025-09-25 01:52:18'),
(2, 'mee', '', 'mee@me.com', '', '', NULL, '', '', '', '', '', '2025-09-25 10:53:35', '2025-09-25 10:53:35');

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
(39, 'shizan', 'shizansarkar@gmail.com', 'patient', '$2y$10$KSc9gjxZ6MCuehyc/KjV3uYm8pTRJvu2RJu62GW/ZHPOrOTOjncBu', 'approved', '2025-09-24 15:13:17', '2025-09-24 15:13:31'),
(40, 'Al Modina Hospital', 'almodina@gmail.com', 'hospital', '$2y$10$dBWSJ8d/Z0rB87ubrzhJ9.6RmmcP30w5twa2mMxeD2TFsarMa3e72', 'approved', '2025-09-24 15:14:51', '2025-09-24 15:15:46'),
(43, 'shizansarkar', 'shizansssarkar@gmail.com', 'patient', '$2y$10$y3DcqJ/wS1A.nQh99QDXDuj7L8iXOhUMriENy.8UBgvBmsqPURmjy', 'approved', '2025-09-24 18:54:37', '2025-09-24 18:54:49'),
(44, 'shizanasa', 'shizansarkarssss@gmail.com', 'patient', '$2y$10$acXKrMXD23O79oW6tSLR2ud9tb3eOa8ZPRF42nKJtM/iXWWUTqRPe', 'pending', '2025-09-24 21:47:25', '2025-09-24 21:47:25'),
(45, 'SuperDuckSpecialist11', 'shizansarkar11@gmail.com', 'patient', '$2y$10$JI9Uz1YZfIz0iyTn4GsDnO6DPT05Zmb8kN9LCJJH4HK6Gojx7ZKZa', 'approved', '2025-09-24 21:52:20', '2025-09-24 21:52:47'),
(49, 'abc', 'abc@gmail.com', 'hospital', '$2y$10$wj0g3wTysmR6tDxOnoPZReX.0/PiENuWVmc2TWiz0q7H6bwc1lPL6', 'pending', '2025-09-25 09:30:25', '2025-09-25 10:59:20'),
(55, 'abcd', 'abcd@gmail.com', 'hospital', '$2y$10$BbgZnUTjW8PoSAZOfn1Od.r19EdrF11TF0FYRvBzG15im4bgyi12e', 'approved', '2025-09-25 09:56:28', '2025-09-25 11:08:38'),
(59, 'admin', 'admin@gmail.com', 'admin', '$2y$10$cFZghSbRIz4nlKabVYh4OOC9ZsqDqV5dupIktfK22J.XEBBcg1z4K', 'approved', '2025-09-25 10:48:06', '2025-09-25 10:53:55');

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
  ADD KEY `hospital_username` (`hospital_username`) USING BTREE;

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
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
