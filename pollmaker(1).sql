-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 19, 2023 at 05:16 PM
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
-- Database: `pollmaker`
--
CREATE DATABASE IF NOT EXISTS `pollmaker` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pollmaker`;

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE IF NOT EXISTS `choices` (
  `chid` int(11) NOT NULL AUTO_INCREMENT,
  `qid` int(11) NOT NULL,
  `choice` varchar(128) NOT NULL,
  `votes` int(11) NOT NULL,
  PRIMARY KEY (`chid`),
  KEY `Foreign key to the question id` (`qid`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`chid`, `qid`, `choice`, `votes`) VALUES
(5, 8, 'call of duty', 0),
(6, 8, 'overwatch', 0),
(7, 9, 'egypt', 0),
(8, 9, 'qatar', 0);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE IF NOT EXISTS `polls` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `question` text NOT NULL,
  `qdate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `edate` date NOT NULL,
  PRIMARY KEY (`qid`),
  KEY `Foreign key userid for the questions` (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`qid`, `uid`, `question`, `qdate`, `status`, `edate`) VALUES
(8, 1, 'what is your favorite game?', '2023-12-16', 1, '2023-12-29'),
(9, 1, 'what is your favorite country?', '2023-12-16', 1, '2023-12-23');

-- --------------------------------------------------------

--
-- Table structure for table `reponses`
--

CREATE TABLE IF NOT EXISTS `reponses` (
  `rid` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `chid` int(11) NOT NULL,
  PRIMARY KEY (`rid`),
  KEY `user id Foreign key` (`uid`),
  KEY `question id  Foreign key` (`qid`),
  KEY `choice id  Foreign key` (`chid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `sitename` varchar(1024) NOT NULL,
  `maintaince` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sitename`, `maintaince`) VALUES
('MyPoll', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `username`, `password`) VALUES
(1, 'root', 'mohamed123@gmail.com', '$2y$10$NRq03jTwXJGSsIyjnwXe9OH0/7AL7UMPVMCHLG4rYmxZuxWVQiJXC'),
(2, 'root', 'ali456@gmail.com', '$2y$10$x0VQAgNRJZwpkwfPldQ.EOoznT/B.OV9FOUoYv/7svgxRoRAM4ooK'),
(3, 'root', 'er4ffk@gmail.com', '$2y$10$aA3hcCdVL4YwRN7Cio8A0OVszVFrtSpeTSPPTB5P8HtPdrS7gKpX2'),
(4, 'root', 'difnf@gmail.com', '$2y$10$ov9v1A88c2QKCORyaThBS.O8nzFecYfmDtA8zWjeC2pZ8z4xM7XnS'),
(5, 'root', 'sayed2@gmail.com', '$2y$10$UlYkfjEpbMWVoUdp8wkbLur/y6ViPDzp0nC/FIhcmm0Uyj2K4h4mG'),
(6, 'root', 'wddj@gmail.com', '$2y$10$g/qsNNlTVVZvZcuZB1GyUu3QNEzC1AfCnOsnKFWPEW4GME0lRFygS');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `Foreign key to the question id` FOREIGN KEY (`qid`) REFERENCES `polls` (`qid`) ON DELETE CASCADE;

--
-- Constraints for table `polls`
--
ALTER TABLE `polls`
  ADD CONSTRAINT `Foreign key userid for the questions` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);

--
-- Constraints for table `reponses`
--
ALTER TABLE `reponses`
  ADD CONSTRAINT `choice id  Foreign key` FOREIGN KEY (`chid`) REFERENCES `choices` (`chid`),
  ADD CONSTRAINT `question id  Foreign key` FOREIGN KEY (`qid`) REFERENCES `polls` (`qid`),
  ADD CONSTRAINT `user id Foreign key` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
