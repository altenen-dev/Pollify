-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2023 at 08:58 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE `choices` (
  `chid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `choice` varchar(128) NOT NULL,
  `votes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`chid`, `qid`, `choice`, `votes`) VALUES
(7, 9, 'egypt', 2),
(8, 9, 'qatar', 0),
(11, 10, 'spiderman', 0),
(12, 10, 'superman', 0),
(13, 10, 'batman', 0),
(17, 12, '15-20', 1),
(18, 12, '21-25', 0),
(19, 12, '26-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `polls`
--

CREATE TABLE `polls` (
  `qid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `question` text NOT NULL,
  `qdate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `edate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `polls`
--

INSERT INTO `polls` (`qid`, `uid`, `question`, `qdate`, `status`, `edate`) VALUES
(9, 1, 'what is your favorite country?', '2023-12-16', 1, '2023-12-23'),
(10, 1, 'what is your favorite show?', '2023-12-22', 1, '0000-00-00'),
(12, 1, 'what is your age group?', '2023-12-22', 1, '2023-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `responses`
--

CREATE TABLE `responses` (
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  `chid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `responses`
--

INSERT INTO `responses` (`rid`, `uid`, `qid`, `chid`) VALUES
(2, 1, 12, 17),
(3, 2, 12, 19);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
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

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `choices`
--
ALTER TABLE `choices`
  ADD PRIMARY KEY (`chid`),
  ADD KEY `Foreign key to the question id` (`qid`);

--
-- Indexes for table `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`qid`),
  ADD KEY `Foreign key userid for the questions` (`uid`);

--
-- Indexes for table `responses`
--
ALTER TABLE `responses`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `user id Foreign key` (`uid`),
  ADD KEY `question id  Foreign key` (`qid`),
  ADD KEY `choice id  Foreign key` (`chid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choices`
--
ALTER TABLE `choices`
  MODIFY `chid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `polls`
--
ALTER TABLE `polls`
  MODIFY `qid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `responses`
--
ALTER TABLE `responses`
  MODIFY `rid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Constraints for table `responses`
--
ALTER TABLE `responses`
  ADD CONSTRAINT `choice id  Foreign key` FOREIGN KEY (`chid`) REFERENCES `choices` (`chid`),
  ADD CONSTRAINT `question id  Foreign key` FOREIGN KEY (`qid`) REFERENCES `polls` (`qid`),
  ADD CONSTRAINT `user id Foreign key` FOREIGN KEY (`uid`) REFERENCES `users` (`uid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
