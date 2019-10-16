-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2019 at 10:57 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ums_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `ums_tb`
--

CREATE TABLE `ums_tb` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `last_login` datetime NOT NULL,
  `is_deleted` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ums_tb`
--

INSERT INTO `ums_tb` (`id`, `first_name`, `last_name`, `email`, `password`, `last_login`, `is_deleted`) VALUES
(1, 'Smith', 'Saparamadhu', 'Sumith@gmail.com', 'e67a40509ebbff2', '0000-00-00 00:00:00', 0),
(2, 'Anil', 'Sennadhira', 'anil@gmail.com', '86010fa20d57c43', '0000-00-00 00:00:00', 0),
(3, 'Keerthi', 'Dharmasiri', 'keerthi@gmail.com', '967b357b68e3537', '0000-00-00 00:00:00', 0),
(4, 'Srinath', 'Wickramasinghe', 'sri@gmail.com', 'f9a379b7bdf7768', '0000-00-00 00:00:00', 0),
(5, 'Ranganath', 'Pinnapola', 'ranga@gmail.com', '2d769dfea3970d0', '0000-00-00 00:00:00', 0),
(6, 'Madhawi', 'pilapitiya', 'madhawi@gmail.com', '3a241eab038e3d5', '0000-00-00 00:00:00', 0),
(7, 'thilak', 'Wimalaweera', 'thilak@gmail.com', 'dbcd245e4daf435', '0000-00-00 00:00:00', 0),
(8, 'Roshan', 'Dharshana', 'roshdha@gmail.com', '7ebf3a54a2e7bdf', '0000-00-00 00:00:00', 0),
(9, 'Nuwan', 'Kulasekara', 'nuwa@gmail.com', 'ccfe79ff6bf091c', '0000-00-00 00:00:00', 0),
(10, 'Jason', 'Mohomad', 'jasonmoho@gmail.com', '0ff5f6b648b7c82', '0000-00-00 00:00:00', 0),
(11, 'Hashan', 'Liyanage', 'hashanduplessis@gmail.com', 'a9993e364706816aba3e25717850c26c9cd0d89d', '0000-00-00 00:00:00', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ums_tb`
--
ALTER TABLE `ums_tb`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ums_tb`
--
ALTER TABLE `ums_tb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
