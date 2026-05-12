-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2026 at 02:51 AM
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
-- Database: `basasnapa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `age` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `age`, `email`, `course`, `address`) VALUES
(1, 'Trixia Ceniza', 19, 'trixia@gmail.com', 'BSIT', 'cantoyok'),
(2, 'Richel Basas', 19, 'basass33@gmail.com', 'BSIT', 'Baogo'),
(3, 'airen mae', 19, 'airen@gmail.com', 'BSIS', 'Baogo'),
(4, 'Jiane leigh', 19, 'jianeleighnapa0@gmail.com', 'BSIT', 'Ilaya'),
(5, 'Angelyn Nangca', 19, 'angelynnangca@gmail.com', 'BSIS', 'Bugang'),
(6, 'Ma- Grace Bautista', 20, 'magracebautista@gmail.com', 'BSIS', 'lapacan'),
(7, 'Amelia ', 19, 'amelia@gmail.com', 'BSIS', 'Baogo'),
(8, 'ave', 3, 'ave@gmail.com', 'BSIT', 'Baogo');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`username`, `password`) VALUES
('admin', 'e10adc3949ba59abbe56e057f20f883e'),
('admin', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
