-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2023 at 12:02 PM
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
-- Database: `reglog`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus_list`
--

CREATE TABLE `bus_list` (
  `bus_company` varchar(255) NOT NULL,
  `bus_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_list`
--

INSERT INTO `bus_list` (`bus_company`, `bus_id`) VALUES
('Putra Jaya', 'cf6d98'),
('Putra Jaya', '8c07e4'),
('Putra Jaya', 'e2123b'),
('Putra Jaya', '82604c'),
('Putra Jaya', 'c46a06'),
('Putra Jaya', 'c7284d'),
('Putra Jaya', 'be88ff'),
('Putra Jaya', 'fd29b2'),
('Putra Jaya', 'e9956d'),
('Putra Jaya', '71fee7'),
('Agra Mas', 'b6d3ea'),
('Agra Mas', 'c19cde'),
('Agra Mas', 'a9a734'),
('Agra Mas', '822f7c'),
('Agra Mas', '4d5245'),
('Agra Mas', '91e922'),
('Agra Mas', 'f64882'),
('Agra Mas', 'e286eb'),
('Agra Mas', '62dd5b'),
('Agra Mas', '88faa7'),
('PT Sinar Jaya', '4fe425'),
('PT Sinar Jaya', 'b52232'),
('PT Sinar Jaya', '49339c'),
('PT Sinar Jaya', 'e51b07'),
('PT Sinar Jaya', '1a7998'),
('PT Sinar Jaya', '4badb7'),
('PT Sinar Jaya', 'ee1c01'),
('PT Sinar Jaya', 'd28914'),
('PT Sinar Jaya', '0e4b76');

-- --------------------------------------------------------

--
-- Table structure for table `bus_schedule`
--

CREATE TABLE `bus_schedule` (
  `bus_company` varchar(255) NOT NULL,
  `bus_id` varchar(255) NOT NULL,
  `departure_location` varchar(255) NOT NULL,
  `arrival_location` varchar(255) NOT NULL,
  `departure_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL,
  `seats` int(11) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_schedule`
--

INSERT INTO `bus_schedule` (`bus_company`, `bus_id`, `departure_location`, `arrival_location`, `departure_time`, `arrival_time`, `seats`, `price`) VALUES
('Agra Mas', 'b6d3ea', 'Jakarta', 'Bandung', '2023-06-25 15:30:00', '2023-06-27 15:30:00', 1, 1),
('', '', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `saldo` int(11) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id`, `username`, `password`, `email`, `saldo`, `status`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@gmail.com', 0, 'admin'),
(2, 'sp', '7815696ecbf1c96e6894b779456d330e', 'sp@gmail.com', 0, 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
