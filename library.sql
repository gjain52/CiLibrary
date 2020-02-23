-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 23, 2020 at 11:50 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `author` varchar(50) DEFAULT NULL,
  `added_on` datetime NOT NULL DEFAULT current_timestamp(),
  `published` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `name`, `author`, `added_on`, `published`) VALUES
(1, 'Who will cry when you die', 'Robin Sharma', '2020-02-22 15:57:11', 1),
(2, 'The monk who sold his ferrari', 'Robin Sharma', '2020-02-22 15:57:45', 1),
(3, 'Stay Hungry Stay Foolish', 'Rashmi Bansal', '2020-02-22 22:41:41', 1),
(4, 'Connect the Dots', 'Rashmi Bansal', '2020-02-22 22:41:41', 1),
(5, 'The 5 Second Rule', 'Mel Robbins', '2020-02-22 22:41:41', 1),
(6, 'The Alchemist', 'Paulo Coelho', '2020-02-22 22:41:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `book_history`
--

CREATE TABLE `book_history` (
  `id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `issued_on` datetime NOT NULL DEFAULT current_timestamp(),
  `returned_on` datetime DEFAULT NULL,
  `note` varchar(150) DEFAULT NULL COMMENT 'This field can be used for some additional remarks.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_history`
--

INSERT INTO `book_history` (`id`, `book_id`, `user_id`, `issued_on`, `returned_on`, `note`) VALUES
(1, 5, 3, '2020-02-23 16:20:03', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `user_type` int(10) NOT NULL DEFAULT 1 COMMENT 'This field can be used to provide different access.',
  `email` varchar(100) NOT NULL COMMENT 'Email can be used for login purpose.',
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `email`, `password`) VALUES
(1, 'Gourav Jain', 2, 'Admin@gmail.com', ''),
(2, 'User 1', 1, 'user1@gmail.com', ''),
(3, 'User 2', 1, 'user2@gmail.com', ''),
(4, 'User 3', 1, 'user3@gmail.com', ''),
(5, 'User 4', 1, 'user4@gmail.com', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_history`
--
ALTER TABLE `book_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `book_history`
--
ALTER TABLE `book_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `book_history`
--
ALTER TABLE `book_history`
  ADD CONSTRAINT `book_id` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
