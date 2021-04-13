-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2021 at 04:50 AM
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
(1, 'Pen', '10056', '10', '2021-04-04 12:53:14'),
(3, 'pencil', '10055', '12', '2021-04-04 12:55:03'),
(4, 'Note', '10004', '20', '2021-04-04 12:55:20'),
(5, 'Book', '10051', '15', '2021-04-04 12:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `aes_algo`
--

CREATE TABLE `aes_algo` (
  `ID` int(11) NOT NULL,
  `sname` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `aes_algo`
--

INSERT INTO `aes_algo` (`ID`, `sname`) VALUES
(1, 'ciBNx2tJwVf8xzZzsSXHv45USB6efcFCeLryHWo2lsth84V3QhgRqArNh47U43AHnNOqV9y4PQ4f/F2857aYHg=='),
(2, 'E9tOYVWuXHqlsZEp0TR0pKriH7zRpHM58Rkx7rFi0k8MkRRYKlKTzd/SdPoX+HYy6Lp6nL2SBpWTKQVjJWoVdg=='),
(3, 'AIXnREFgpKOII++wB8eLEoQvCqJBpSxNf29J4PEL3Y1rYswPrCaEXpxv9A1ntBKe4OSoBrSA0YDB2c0BKNbiYw=='),
(4, 'U5d4NT1KCx4NrryiMeWm/i5jp+SxYT0S2htkE425K7GrGRMK67NsYoi1nQi7SwtR4EwE+cHMNQaHEqtTUE+h+w=='),
(5, 'ZlX//FY8Bv9qtpl3MyEiH5F4DGYRapZyEBVdZ/2S/d8f4huvMkUyuedsw2i0p4bx5YR7YNk5dygTHqpPnHVFRA=='),
(6, 'VxuY1Li3LgnHUbzQKd8XMbbYdIR87/Mi2x2cbx0m4sSZfI9ukOCauDlAtKBTzWsGjcqTJuiTGTg8PbhGNfyLcg=='),
(7, 'BpVMnDz6rP5qyLIBpdkgnWmHMtB6zCh5J1oLH8oimv+VvduUmVtj5fob5AQa5MSyChgHdiITnB/qgnwbIKXoiw=='),
(8, '4W12rmPLw5CLSUblSjsBJs9Faza1aT1s5kfHkL3O3chD1i2rendvHd1wA4pWQiQ0ncLFNgjH3Lp+Q+uBgXPXJg=='),
(9, 'x5UH6DhPgJhmIxqiXToFRSdBKAYWDDgfSfc3IiFbDeka/W/MZLDxbdtOjMIqZ8URpHSdhSG6LMut1s37r7vfpw=='),
(10, '11ia+S31csGYfjvpJVV2w4cbIJoBiS8XxjzpjZPFfefToRSa/z/e07pSLTvnZvISjK344NPbyzGReSMIXmebpg=='),
(11, '3wMTfW1PYjv54RVDUgJsJjpskSpqVX7Es5Mam48aRxudnbfu0vYclVVqy/U4XmkIc4zADs5hJRS0IcBPRPH70g=='),
(12, 'Hk3c037VuGvldb4vAn9nTUcetrR5ZOVTK7ldesFWxyiiyCvuBTk42F45z1FGnSoKzZOL5fxr2Fcp/ApwbDgpMw==');

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
(3, 'Parthisri', '513417104711', 'Delivered Successfully', '2021-04-04 17:20:37', '2', '3', '3', '3'),
(12, 'Parthi', '511', 'Waiting For Delivery', '2021-04-12 20:28:31', '1', '5', NULL, '58'),
(13, 'Parthi', '511', 'Waiting For Delivery', '2021-04-12 20:48:10', NULL, NULL, NULL, NULL),
(14, 'Parthi', '511', 'Waiting For Delivery', '2021-04-12 21:23:04', NULL, '1', '52', '5'),
(15, 'Parthi', '511', 'Waiting For Delivery', '2021-04-12 21:34:18', NULL, NULL, NULL, NULL),
(16, 'Parthi', '511', 'Waiting For Delivery', '2021-04-12 21:34:49', NULL, NULL, NULL, NULL),
(17, 'Parthi', '511', 'Waiting For Delivery', '2021-04-12 21:37:01', NULL, NULL, NULL, NULL),
(18, 'Parthi', '511', 'Waiting For Delivery', '2021-04-12 21:37:16', NULL, NULL, NULL, NULL),
(19, 'Parthi', '511', 'Waiting For Delivery', '2021-04-12 21:37:18', NULL, NULL, NULL, NULL),
(20, 'Parthi', '511', 'Waiting For Delivery', '2021-04-12 21:37:43', NULL, NULL, NULL, NULL),
(21, 'Parthi', '511', 'Waiting For Delivery', '2021-04-12 21:38:42', NULL, '1', NULL, NULL);

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
  `phno` text DEFAULT NULL,
  `stu_address` varchar(255) DEFAULT NULL,
  `email` text DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `submitted_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`ID`, `regno`, `sname`, `dob`, `course`, `branch`, `syear`, `balance`, `phno`, `stu_address`, `email`, `password`, `submitted_time`) VALUES
(4, '962817104711', 'NH72FiCejfvnm+3y+5Ib/WwiysCm2MFqGsN9Ap+dxEuKGHQvdexmLSskPHFrUgT6SjyLdL7GTbq/ZKDsi1X2VQ==', '2021-04-22', 'Bachelor of Engineering(BE)', 'Information Technology(IT)', 'First Year', 1255, 'YUlxaMOUp7VTQYKvOUTgbJ3pqg2AVWbpJWsznCZVuubePDltR5r01zrm+B/DnUNwMcHrucEFhUJm1ANC6IIT7Q==', '293, thanigai amman kovil\r\nNeikuppi village Anupuram', 'DmBPBEHGjmJZuLSE4BIt0lGzBu9pjuz7LYdpiylqRAhw+R5g/LLBuqQ1irQVku+hKgbAcPyXfUEYwFBlcXOVP4UdyObdBd1BfdSCyd2+e1U=', '$2y$10$.56sU9SovVZV1N4e3ETMQufXTJ2wa/VO9Tvm6qJVBLTghTRbKXHvi', '2021-04-12 17:46:48'),
(5, '511', 'PjYs5AxhH1O+6MQ3ZlZbESPEY8cR+uWi33AbLAQwE749Kac6YHPuOCTE2w1j9eoxvxbb9JF0f3SFLidZt6PSZw==', '2021-04-22', 'Bachelor of Engineering(BE)', 'Information Technology(IT)', 'First Year', 1258, 'PKozAXGOE6QP94Ak4WSZ2b+SJV86hkozkfzOF954aiEkzno2FU7Wuk4TpgkMRvz4n6bKXHQgGIVPpRmf9MF3tQ==', '293, thanigai amman kovil\r\nNeikuppi village Anupuram', 'H1k3pqLhl+0CdQRUSz/jnj3wjEkaF/XLRwc5nI6T8YEXZzS7PVaJAj9dS/RlEnp1qibz7XWkEjyTpnqs+IF3lQuKknbJALUZ5xldp0m2zbs=', '$2y$10$W.AiXgF4HDKHakqqNW7h.uMvJiLW6jRCPldyLg16nXw1nzE7FhRiu', '2021-04-12 17:53:07');

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
-- Indexes for table `aes_algo`
--
ALTER TABLE `aes_algo`
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
-- AUTO_INCREMENT for table `aes_algo`
--
ALTER TABLE `aes_algo`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `purchase`
--
ALTER TABLE `purchase`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
