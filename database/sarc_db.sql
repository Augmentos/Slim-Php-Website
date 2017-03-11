-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
<<<<<<< HEAD
-- Host: localhost
-- Generation Time: Oct 31, 2016 at 05:13 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.23
=======
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2016 at 01:51 PM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14
>>>>>>> e449ae534c44212de1f43ea34d5bd9a76a250a0d

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sarc_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(5) NOT NULL,
  `username` varchar(40) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `auth_level` int(2) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `email`, `auth_level`, `timestamp`) VALUES
(34, 'jokker', 'b48315d52b88d4013a2b5bf1be8f40d1', 'jokerhoker@gmail.com', 0, '2016-08-20 09:54:15'),
(35, 'sharoon', 'eedf1e7e9dec6effc341c4b417d295a8', 'jokerhoker@gmail.com', 0, '2016-08-20 10:04:12'),
(37, 'austin', '229979fce5174c17d4645bf8752dae1e', 'austin2@gmail.com', 1, '2016-08-27 16:21:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Tel` int(15) NOT NULL,
  `Contact` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `Name`, `Email`, `Tel`, `Contact`) VALUES
(12, 'sharoon', 'jokerhoker@gmail.com', 123123123, 'hugsy'),
(13, 'Aust', 'chus@gmail.com', 2147483647, 'sdfjsjdfhjsfhsdhfjhsfhkHDfhsf'),
(14, 'Aust', 'chus@gmail.com', 2147483647, 'sdfjsjdfhjsfhsdhfjhsfhkHDfhsf');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(10) NOT NULL,
  `name` longtext COLLATE utf8_bin NOT NULL,
  `e_date` varchar(20) COLLATE utf8_bin NOT NULL,
  `day` int(10) NOT NULL,
  `mon` varchar(3) COLLATE utf8_bin NOT NULL,
  `year` int(4) NOT NULL,
  `venue` varchar(128) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `e_date`, `day`, `mon`, `year`, `venue`) VALUES
(1, 'Get together', '12-01-2016', 12, 'Jan', 2016, 'Emmanuel'),
(2, 'Mega Play', '12-12-2016', 12, 'Dec', 2016, 'Emmanuel'),
(3, 'Invento', '12-02-2016', 12, 'Feb', 2016, 'Emmanuel'),
(4, 'New year', '01-01-2017', 1, 'Jan', 2017, 'Emmanuel');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(50) NOT NULL,
  `date` varchar(30) NOT NULL,
  `title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `date`, `title`) VALUES
(6, '12-12-12', 'Conservatory Exhibit: The garden of india a country and culture revealed'),
(7, '12-13-13', 'Conservatory Exhibit: The garden of india a country and culture revealed'),
(8, '14-12-12', 'Conservatory Exhibit: The garden of india a country and culture revealed'),
(9, '12-13-12', 'Conservatory Exhibit: The garden of india a country and culture revealed'),
(10, '09-01-2012', 'Conservatory Exhibit: The garden of india a country and culture revealed');

-- --------------------------------------------------------

--
-- Table structure for table `service_requests`
--
-- in use(#1932 - Table 'sarc_db.service_requests' doesn't exist in engine)
-- Error reading data: (#1932 - Table 'sarc_db.service_requests' doesn't exist in engine)

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
<<<<<<< HEAD
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);
=======
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`s_id`);
>>>>>>> e449ae534c44212de1f43ea34d5bd9a76a250a0d

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
<<<<<<< HEAD
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
=======
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `s_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
>>>>>>> e449ae534c44212de1f43ea34d5bd9a76a250a0d
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
