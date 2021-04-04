-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 04, 2021 at 07:39 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `SSS`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminstock`
--

CREATE TABLE `adminstock` (
  `ID` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_quantity` varchar(25) DEFAULT NULL,
  `product_price` varchar(25) DEFAULT NULL,
  `last_updated_time` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adminstock`
--

INSERT INTO `adminstock` (`ID`, `product_name`, `product_quantity`, `product_price`, `last_updated_time`) VALUES
(1, 'Pen', '10125', '10', '2021-04-04 12:53:14'),
(3, 'pencil', '1258', '12', '2021-04-04 12:55:03'),
(4, 'Note', '12584', '20', '2021-04-04 12:55:20'),
(5, 'Book', '8759', '15', '2021-04-04 12:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE `purchase` (
  `ID` int(11) NOT NULL,
  `Stu_name` varchar(255) NOT NULL,
  `stu_regno` varchar(25) NOT NULL,
  `status` varchar(25) DEFAULT NULL,
  `sbmitted_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Pen` varchar(255) DEFAULT NULL,
  `pencil` varchar(255) DEFAULT NULL,
  `Note` varchar(255) DEFAULT NULL,
  `Book` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`ID`, `Stu_name`, `stu_regno`, `status`, `sbmitted_time`, `Pen`, `pencil`, `Note`, `Book`) VALUES
(1, 'Parthibans', '513417104711', 'Waiting For Delivery', '2021-04-04 17:18:58', '1', '2', '3', '4'),
(3, 'Parthisri', '513417104711', 'Delivered Successfully', '2021-04-04 17:20:37', '2', '3', '3', '3');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `ID` int(11) NOT NULL,
  `regno` varchar(255) DEFAULT NULL,
  `sname` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `course` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `syear` varchar(255) DEFAULT NULL,
  `balance` int(11) DEFAULT NULL,
  `phno` varchar(11) DEFAULT NULL,
  `stu_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `submitted_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `regno`, `sname`, `dob`, `course`, `branch`, `syear`, `balance`, `phno`, `stu_address`, `email`, `password`, `submitted_time`) VALUES
(1, '513417104711', 'Parthiban', '2021-04-05', 'Bachelor of Engineering(BE)', 'Computer Science Engineering(CSE)', 'Fourth Year', 10125, '06383117625', '293, thanigai amman kovil\r\nNeikuppi village Anupuram', 'parthibans452@gmail.com', '$2y$10$jtiaanbT/5lVKhsjuTxmY.L//yQ7s.JocLhgNAVJpwiLb0cSyaZoi', '2021-04-04 12:52:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`) VALUES
(1, 'parthiban', '$2y$10$XTS4kvezXplwnt7mnMMS1O2noDa0w8CyBxje1EytYeZDkp0MxVtOe', '2021-03-07 15:41:39'),
(2, 'admin', '$2y$10$eXrjbdXHNqsFk81pZ4kGOe85xjGq6w5JhU2XWTlvqjlo6R.UZETZO', '2021-03-26 19:53:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adminstock`
--
ALTER TABLE `adminstock`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `purchase`
--
ALTER TABLE `purchase`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adminstock`
--
ALTER TABLE `adminstock`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
