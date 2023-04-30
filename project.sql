-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2023 at 12:40 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_schedule`
--

CREATE TABLE `bus_schedule` (
  `bus_id` varchar(100) NOT NULL,
  `bus_company` varchar(100) NOT NULL,
  `from_city` varchar(100) NOT NULL,
  `to_city` varchar(100) NOT NULL,
  `d_time` datetime NOT NULL,
  `a_time` datetime NOT NULL,
  `seat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_schedule`
--

INSERT INTO `bus_schedule` (`bus_id`, `bus_company`, `from_city`, `to_city`, `d_time`, `a_time`, `seat`) VALUES
('SPxY', 'ESPI', 'Yogyakarta', 'Jakarta', '2023-04-29 10:24:00', '2023-04-29 16:25:00', 100),
('SPxY', 'ESPI', 'Yogyakarta', 'Jakarta', '2023-04-30 14:13:00', '2023-04-30 19:13:00', 11),
('E73AF', 'Pt.Bimo Nusantara', 'Bandung', 'Surabaya', '2023-04-30 16:00:00', '2023-05-01 04:02:00', 40),
('E73AF', 'Pt.Bimo Nusantara', 'Yogyakarta', 'Jakarta', '2023-05-03 17:38:00', '2023-05-04 04:38:00', 40);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`) VALUES
(1, 'Espi', '202cb962ac59075b964b07152d234b70', '2200018273@webmail.uad.ac.id', '081271139285'),
(2, 'z', '25ed1bcb423b0b7200f485fc5ff71c8e', 'z@gmail.com', '081271139286'),
(3, 'SP', 'f6e9fc17923ca1dc268d95edac6a32b6', 'rakasatria85@gmail.com', '081271139287'),
(4, 'asd', '5fa72358f0b4fb4f2c5d7de8c9a41846', 'asd@gmail.com', '081271139280');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
