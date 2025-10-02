-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2025 at 09:32 PM
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
-- Table structure for table `ambulance`
--

CREATE TABLE `ambulance` (
  `ambulanceId` int(11) NOT NULL,
  `hospitalName` varchar(100) NOT NULL,
  `ambulanceCode` varchar(50) NOT NULL,
  `hospitalNumber` varchar(20) DEFAULT NULL,
  `driverNumber` varchar(20) DEFAULT NULL,
  `licenseNo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ambulance`
--

INSERT INTO `ambulance` (`ambulanceId`, `hospitalName`, `ambulanceCode`, `hospitalNumber`, `driverNumber`, `licenseNo`) VALUES
(1, 'aopular', 'AMB-101', '+880255112233', '+8801711002200', 'LIC-56789'),
(2, 'xyz', 'AMB-102', '+880255445566', '+8801711223344', 'LIC-98765'),
(3, 'apollo', 'AMB-103', '+880255778899', '+8801711334455', 'LIC-33445'),
(4, 'square', 'AMB-104', '+880255990011', '+8801711445566', 'LIC-11223'),
(5, 'united', 'AMB-105', '+880255223344', '+8801711556677', 'LIC-77889');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `appointment_id` int(11) NOT NULL,
  `hospital_name` varchar(100) NOT NULL,
  `patient_name` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `contact` varchar(15) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appointment_id`, `hospital_name`, `patient_name`, `dob`, `gender`, `contact`, `doctor_name`, `appointment_date`, `appointment_time`, `created_at`) VALUES
(1, 'City Care Hospital', 'Md shizan Sarkar', '2025-09-04', 'Male', '+8801303672091', 'mim', '2222-12-12', '12:22:00', '2025-09-25 13:57:07'),
(2, 'aaa', 'Md shizan Sarkar', '2025-09-02', 'Male', '+8801303672091', 'Shizan', '2025-09-26', '12:00:00', '2025-09-25 14:26:00'),
(3, 'aaa', 'shizanaj', '2025-09-02', 'Male', '12233123123', 'Shizan', '2025-02-09', '14:00:00', '2025-09-25 15:04:13'),
(4, 'green_clinic', 'janina', '2002-01-01', 'Male', '0130303728', 'Dr. Jane Smith', '2026-01-01', '09:40:00', '2025-09-25 15:09:58'),
(5, 'aaa', 'mmmmm', '2222-02-22', 'Male', '+8801303672091', 'Shizan', '0000-00-00', '14:22:00', '2025-09-25 15:49:41'),
(6, 'aaa', 'mmmmm', '2025-09-10', 'Male', '2121312321', 'Shizan', '2025-09-26', '12:31:00', '2025-09-25 15:56:33'),
(7, 'city_hospital', 'mmmmmddd', '2025-09-26', 'Male', '1323213', 'Dr. Alex Brown', '2025-10-01', '12:33:00', '2025-09-25 16:14:20'),
(8, 'xyz', 'salman farshe', '2025-09-18', 'Male', '013', 'Miyoko Mahzabin', '2025-09-29', '01:19:00', '2025-09-25 19:17:18');

-- --------------------------------------------------------

--
-- Table structure for table `blood_donor`
--

CREATE TABLE `blood_donor` (
  `donor_id` int(11) NOT NULL,
  `donorName` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('male','female','other') NOT NULL,
  `bloodGroup` varchar(5) NOT NULL,
  `contactNumber` varchar(20) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `lastDonationDate` date DEFAULT NULL,
  `available` enum('yes','no') DEFAULT 'yes',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `blood_donor`
--

INSERT INTO `blood_donor` (`donor_id`, `donorName`, `age`, `gender`, `bloodGroup`, `contactNumber`, `email`, `address`, `lastDonationDate`, `available`, `created_at`) VALUES
(1, 'Rahim Uddin', 32, 'male', 'A+', '01710000001', 'rahim@example.com', 'Dhaka, Bangladesh', '2025-06-10', 'yes', '2025-09-25 15:43:50'),
(2, 'Fatema Khatun', 28, 'female', 'B+', '01710000002', 'fatema@example.com', 'Chittagong, Bangladesh', '2025-05-20', 'no', '2025-09-25 15:43:50'),
(3, 'Sajib Ahmed', 35, 'male', 'O-', '01710000003', 'sajib@example.com', 'Khulna, Bangladesh', '2025-04-15', 'yes', '2025-09-25 15:43:50'),
(4, 'Moushumi Begum', 30, 'female', 'AB+', '01710000004', 'moushumi@example.com', 'Rajshahi, Bangladesh', '2025-07-01', 'yes', '2025-09-25 15:43:50'),
(5, 'Tanvir Hasan', 27, 'male', 'B-', '01710000005', 'tanvir@example.com', 'Sylhet, Bangladesh', '2025-06-25', 'no', '2025-09-25 15:43:50'),
(6, 'Anika Rahman', 24, 'female', 'O+', '01710000006', 'anika@example.com', 'Barishal, Bangladesh', '2025-05-05', 'yes', '2025-09-25 15:43:50'),
(7, 'Imran Hossain', 40, 'male', 'A-', '01710000007', 'imran@example.com', 'Comilla, Bangladesh', '2025-06-30', 'yes', '2025-09-25 15:43:50'),
(8, 'Nabila Sultana', 29, 'female', 'AB-', '01710000008', 'nabila@example.com', 'Rangpur, Bangladesh', '2025-04-20', 'no', '2025-09-25 15:43:50'),
(9, 'Shahriar Alam', 33, 'male', 'O+', '01710000009', 'shahriar@example.com', 'Mymensingh, Bangladesh', '2025-07-05', 'yes', '2025-09-25 15:43:50'),
(10, 'Tania Akter', 26, 'female', 'B+', '01710000010', 'tania@example.com', 'Tangail, Bangladesh', '2025-06-15', 'yes', '2025-09-25 15:43:50'),
(11, 'Salman', 24, 'male', 'A+', '01319946481', 'salmanfarshe3071@gmail.com', 'Kuril, Vatara', '2025-09-01', 'yes', '2025-09-25 16:12:34'),
(12, 'Salman', 24, 'male', 'A+', '01319946481', 'salmanfarshe3071@gmail.com', 'Kuril, Vatara', '2025-09-04', 'no', '2025-09-25 19:10:01');

-- --------------------------------------------------------

--
-- Table structure for table `diagnostic_services`
--

CREATE TABLE `diagnostic_services` (
  `service_id` int(11) NOT NULL,
  `hospitalName` varchar(255) NOT NULL,
  `serviceName` varchar(255) NOT NULL,
  `regularPrice` decimal(10,2) NOT NULL,
  `discountRate` decimal(5,0) DEFAULT 0,
  `discountPrice` decimal(10,2) GENERATED ALWAYS AS (`regularPrice` * (1 - `discountRate` / 100)) STORED,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnostic_services`
--

INSERT INTO `diagnostic_services` (`service_id`, `hospitalName`, `serviceName`, `regularPrice`, `discountRate`, `created_at`) VALUES
(2, 'Ibnesina', 'Anesthesia for CT.Scan of Whole Abdomen', 2500.00, 25, '2025-08-31 21:10:03'),
(3, 'Ibnesina', 'CLO Test (DFARUQUE)', 1000.00, 20, '2025-08-31 21:14:59'),
(4, 'abc', 'CBEC', 2000.00, 20, '2025-08-31 21:15:57'),
(5, 'abc', 'CBC', 800.00, 10, '2025-08-31 21:16:13'),
(6, 'Popular', 'Blood Group & RH Factor', 200.00, 0, '2025-08-31 21:16:25'),
(7, 'Popular', 'BT,CT (Bleeding time & clotting time)', 300.00, 0, '2025-08-31 21:16:53'),
(8, 'xyz', 'Anti HAV - IgM', 1200.00, 20, '2025-08-31 21:17:15');

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
(4, '', 'mim', 'mim@gmail.com', '01723456345', 'Cardiologist', 'MBBS', 4, 1000.00, '00:00:17', '19:13:00', 'Mon,Wed,Fri', 'doc3.png', '', '', 'mim', '$2y$10$I9PRW1RQkfE5EGkyrSjEhO7Bwqe/pyFu9AvdCKb.Vl6IGhHTUI9Wa'),
(5, 'city_hospital', 'Dr. John Doe', 'johndoe@example.com', '01712345678', 'Cardiology', 'MBBS, MD', 10, 1200.00, '09:00:00', '15:00:00', 'Mon-Fri', 'john_doe.jpg', 'license_john.pdf', 'degree_john.pdf', 'johndoe', 'hashed_password1'),
(25, 'xyz', 'miyoko', 'salmanfarshe3071@gmail.com', '013', 'Cardiologist', 'mbbs', 2, 2000.00, '01:12:00', '05:11:00', '', 'doc2.png', '', '', '', '');

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
(12, 'asd', 'Shizan care ltd', 'a@gmail.com', '013', 'qwer', 'general', 'hos1.png', NULL, NULL, NULL),
(14, 'dfg', 'ABC', 'salmanfarshe3071@gmail.com', '01319946481', 'Kuril, Vatara', 'general', 'p1.jpg', NULL, NULL, NULL),
(15, 'hospital', 'Hospital', 'hospital@gmail.com', '01319946481', 'Kuril, Vatara', 'specialized', 'doc1.png', NULL, NULL, NULL);

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
(7, 'VVV', 'vvv', 'vvv@gmail.com', NULL, 'Female', '2025-09-25', NULL, NULL, 'p1.jpg', NULL, NULL, '2025-09-25 12:18:03', '2025-09-25 12:18:03'),
(8, 'admin', '', 'admin@gmail.com', '', '', NULL, '', '', '', '', '', '2025-09-25 19:00:31', '2025-09-25 19:00:31'),
(10, 'patient', '', 'patient@gmail.com', '', '', NULL, '', '', '', '', '', '2025-09-25 19:15:58', '2025-09-25 19:15:58');

-- --------------------------------------------------------

--
-- Table structure for table `surgery_packages`
--

CREATE TABLE `surgery_packages` (
  `surgery_id` int(11) NOT NULL,
  `hospitalName` varchar(255) NOT NULL,
  `surgeryName` varchar(255) NOT NULL,
  `priceInWord` varchar(255) DEFAULT NULL,
  `priceInStandard` decimal(10,0) DEFAULT NULL,
  `priceInDeluxe` decimal(10,0) DEFAULT NULL,
  `priceInSuite` decimal(10,0) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `surgery_packages`
--

INSERT INTO `surgery_packages` (`surgery_id`, `hospitalName`, `surgeryName`, `priceInWord`, `priceInStandard`, `priceInDeluxe`, `priceInSuite`, `duration`, `created_at`) VALUES
(1, '1', 'Fistula', '27000', 30000, 32000, 35000, '3 days', '2025-08-31 21:54:26'),
(2, 'popular', 'Appendix Surgery', '30000', 40000, 55000, 70000, '3 Days', '2025-09-25 15:11:47'),
(3, 'xyz', 'Gallbladder Removal', '40000', 55000, 70000, 90000, '4 Days', '2025-09-25 15:11:47'),
(4, 'ibnesina', 'Caesarean Section (C-Section)', '45000', 60000, 75000, 95000, '5 Days', '2025-09-25 15:11:47'),
(5, 'popular', 'Kidney Stone Removal', '50000', 70000, 85000, 105000, '5 Days', '2025-09-25 15:11:47'),
(6, 'xyz', 'Hernia Surgery', '35000', 45000, 60000, 80000, '3 Days', '2025-09-25 15:11:47'),
(7, 'ibnesina', 'Cardiac Bypass Surgery', '150000', 200000, 250000, 300000, '10 Days', '2025-09-25 15:11:47'),
(8, 'popular', 'Tonsillectomy', '27000', 30000, 45000, 60000, '2 Days', '2025-09-25 15:11:47'),
(9, 'xyz', 'Spinal Surgery (Minor)', '60000', 80000, 100000, 130000, '6 Days', '2025-09-25 15:11:47'),
(10, 'ibnesina', 'Hip Replacement', '120000', 150000, 180000, 220000, '7 Days', '2025-09-25 15:11:47'),
(11, 'popular', 'Normal Delivery Package', '30000', 35000, 50000, 70000, '2 Days', '2025-09-25 15:11:47');

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
(43, 'shizansarkar', 'shizansssarkar@gmail.com', 'patient', '$2y$10$y3DcqJ/wS1A.nQh99QDXDuj7L8iXOhUMriENy.8UBgvBmsqPURmjy', 'approved', '2025-09-24 18:54:37', '2025-09-25 12:18:54'),
(44, 'shizanasa', 'shizansarkarssss@gmail.com', 'patient', '$2y$10$acXKrMXD23O79oW6tSLR2ud9tb3eOa8ZPRF42nKJtM/iXWWUTqRPe', 'pending', '2025-09-24 21:47:25', '2025-09-25 19:01:16'),
(49, 'abc', 'abc@gmail.com', 'hospital', '$2y$10$wj0g3wTysmR6tDxOnoPZReX.0/PiENuWVmc2TWiz0q7H6bwc1lPL6', 'approved', '2025-09-25 09:30:25', '2025-09-25 09:31:43'),
(57, 'asd', 'a@gmail.com', 'hospital', '$2y$10$ficR4VcTjT6KRRcH0FjLRORstftDQniJYm7pZaSz8B/vmC/s.GOHG', 'approved', '2025-09-25 10:04:58', '2025-09-25 10:04:58'),
(64, 'VVV', 'vvv@gmail.com', 'patient', '$2y$10$rJgxju/h60X9yeeRBzqdr.26MmymCn0l1Prvk4zr826nvKcOPq8/.', 'approved', '2025-09-25 12:18:03', '2025-09-25 12:18:03'),
(65, 'dfg', 'salmanfarshe3071@gmail.com', 'hospital', '$2y$10$I2sIlLI4bIigJPo6QokcH.eBO3RVsGW0ymVTK9AuLH1uCLZvdaSee', 'approved', '2025-09-25 18:46:48', '2025-09-25 18:46:48'),
(66, 'admin', 'admin@gmail.com', 'admin', '$2y$10$C/Y5AVIKhb10EC0mvZW5.Oi8R33HAXneJVYrLlSmXzEdWGIA72Wv.', 'approved', '2025-09-25 19:00:31', '2025-09-25 19:00:53'),
(67, 'hospital', 'hospital@gmail.com', 'hospital', '$2y$10$dyX494vgjlUUSEaADSD1BeR0EJjSIsK.fDwWJcGfeFpvGoX5B9E8e', 'approved', '2025-09-25 19:13:26', '2025-09-25 19:13:54'),
(69, 'patient', 'patient@gmail.com', 'patient', '$2y$10$Lg0vRhrFM6c/ns4htt8IF.Iee2TddYbWeVgkU0NcqzD3ex0l6F1vi', 'approved', '2025-09-25 19:15:58', '2025-09-25 19:16:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `ambulance`
--
ALTER TABLE `ambulance`
  ADD PRIMARY KEY (`ambulanceId`),
  ADD UNIQUE KEY `ambulanceCode` (`ambulanceCode`),
  ADD UNIQUE KEY `licenseNo` (`licenseNo`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`appointment_id`);

--
-- Indexes for table `blood_donor`
--
ALTER TABLE `blood_donor`
  ADD PRIMARY KEY (`donor_id`);

--
-- Indexes for table `diagnostic_services`
--
ALTER TABLE `diagnostic_services`
  ADD PRIMARY KEY (`service_id`),
  ADD KEY `hospital_id` (`hospitalName`);

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
-- Indexes for table `surgery_packages`
--
ALTER TABLE `surgery_packages`
  ADD PRIMARY KEY (`surgery_id`),
  ADD KEY `hospital_id` (`hospitalName`);

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
-- AUTO_INCREMENT for table `ambulance`
--
ALTER TABLE `ambulance`
  MODIFY `ambulanceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `blood_donor`
--
ALTER TABLE `blood_donor`
  MODIFY `donor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `diagnostic_services`
--
ALTER TABLE `diagnostic_services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `hospitals`
--
ALTER TABLE `hospitals`
  MODIFY `hospital_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `surgery_packages`
--
ALTER TABLE `surgery_packages`
  MODIFY `surgery_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
