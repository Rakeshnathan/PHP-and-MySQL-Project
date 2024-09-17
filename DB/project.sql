-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 11:20 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

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
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Id` int(5) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Username` varchar(200) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Id`, `Email`, `Username`, `Password`, `Time`) VALUES
(20, '12345@gmail.com', 'user', '$2y$10$5uTicXSfhf3GbT.cQFUOB.nS9k1kAKYYJRzQD1FqaxABgqkUADpD2', '2024-09-01 13:31:03'),
(23, 'rakesh@gmail.com', 'rakesh', '$2y$10$JotL6Zhe5pTdHdeLtdniguQmftOkGkr9dh.vqS.wu.1zWwID5iHEO', '2024-09-04 18:33:14'),
(29, 'main@gmail.com', 'mainadmin', '$2y$10$EPYzohazI8/FG.nmZ4JQY.wh0ydm/QT1FAv/el663f2wAUGo6AKTu', '2024-09-06 22:14:06');

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE `movie` (
  `MovieId` int(11) NOT NULL,
  `MovieName` text NOT NULL,
  `Year` year(4) NOT NULL,
  `Genre` varchar(255) NOT NULL,
  `Rating` tinyint(4) NOT NULL,
  `Date` datetime NOT NULL DEFAULT current_timestamp(),
  `user_id` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`MovieId`, `MovieName`, `Year`, `Genre`, `Rating`, `Date`, `user_id`) VALUES
(2, 'The Spiderman', 2021, 'Action', 7, '2024-09-04 17:23:27', 20),
(3, 'GOAT', 2024, 'Drama', 5, '2024-09-04 17:23:51', 20),
(4, 'Spiderman 2', 2021, 'Action', 8, '2024-09-04 17:24:05', 20),
(6, 'Battlefield', 1958, 'War', 7, '2024-09-04 17:25:30', 23),
(7, 'The Rookie', 2005, 'Action', 6, '2024-09-04 17:25:54', 23),
(8, 'Iron man', 2005, 'Action', 7, '2024-09-04 17:26:18', 23),
(9, 'The Avengers', 2009, 'Action', 8, '2024-09-04 17:26:36', 23),
(10, 'The Batman', 2023, 'Crime-Action', 7, '2024-09-04 17:27:00', 0),
(11, 'Space War', 2099, 'Explore-Adv-Action', 8, '2024-09-04 17:28:51', 0),
(12, 'The Batman', 1999, 'Action', 5, '2024-09-05 16:54:33', 20),
(13, 'Avengers Infinity war', 2018, 'Action', 8, '2024-09-05 21:09:31', 20),
(14, 'Justice League synder cut', 2018, 'Action', 5, '2024-09-05 21:10:26', 20),
(15, 'Captain America', 2011, 'Action', 6, '2024-09-06 21:20:28', 20),
(16, 'Speed', 1999, 'Action', 7, '2024-09-13 20:12:47', 20),
(17, 'Doctor Strange', 2016, 'Action', 7, '2024-09-13 20:13:15', 20),
(18, 'Hangover', 2009, 'Comedy', 8, '2024-09-13 20:13:42', 20),
(19, 'Seven', 2005, 'Thriller', 8, '2024-09-13 20:14:09', 20),
(20, 'Conjuring', 2010, 'Horror', 8, '2024-09-13 20:14:30', 20),
(21, 'Ford vs Ferrari', 2022, 'Racing', 8, '2024-09-13 20:15:06', 20),
(22, 'Fast&Furious', 2000, 'Racing', 7, '2024-09-13 20:46:18', 29),
(23, 'Venom', 2019, 'Action-Comedy', 7, '2024-09-13 20:47:46', 29),
(24, 'Cars', 2001, 'Racing', 8, '2024-09-13 20:48:26', 29),
(25, 'Frozen', 2015, 'Animation', 7, '2024-09-13 20:48:44', 29),
(26, 'The Lord of the Rings', 2002, 'Adventure', 9, '2024-09-13 20:49:14', 29);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
  ADD PRIMARY KEY (`MovieId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
  MODIFY `MovieId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
