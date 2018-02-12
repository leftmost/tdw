-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 21, 2017 at 02:28 PM
-- Server version: 5.6.35
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tdw1718_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(3, 'Administrator', 'Amministratori sistema'),
(4, 'Editor', 'Gruppo gestione contenuti');

-- --------------------------------------------------------

--
-- Table structure for table `groups_services`
--

CREATE TABLE `groups_services` (
  `id_groups` int(10) UNSIGNED DEFAULT NULL,
  `id_services` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groups_services`
--

INSERT INTO `groups_services` (`id_groups`, `id_services`) VALUES
(3, 1),
(3, 2),
(3, 3),
(4, 1),
(4, 2),
(4, 4);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(20) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `body` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `username`, `title`, `body`) VALUES
(1, 'admin', 'titolo 1', 'body 1'),
(2, 'alfonso', 'titolo 2', 'body 2');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(10) UNSIGNED NOT NULL,
  `script` varchar(100) DEFAULT NULL,
  `active` varchar(1) DEFAULT NULL,
  `filtering` varchar(1) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `script`, `active`, `filtering`, `description`) VALUES
(1, 'login.php', '*', '', NULL),
(2, 'logout.php', '*', '', NULL),
(3, 'users-create.php', '', '', NULL),
(4, 'users-update.php', '*', '', NULL),
(5, 'news-create.php', '*', '', NULL),
(6, 'news-update.php', '*', '*', NULL),
(7, 'news-delete.php', '*', '*', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `surname`, `email`) VALUES
('admin', '0c88028bf3aa6a6a143ed846f2be1ea4', 'Angelo', 'Angelucci', 'a.angelucci@me.com'),
('alfonso', '0c88028bf3aa6a6a143ed846f2be1ea4', 'alfonso', 'pierantonio', 'alfonso.pierantonio@univaq.it');

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `id_groups` int(10) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`username`, `id_groups`) VALUES
('admin', 3),
('alfonso', 4);

-- --------------------------------------------------------

--
-- Table structure for table `users_old`
--

CREATE TABLE `users_old` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `note` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_old`
--

INSERT INTO `users_old` (`id`, `name`, `surname`, `email`, `note`) VALUES
(1, 'Alfonsos', 'Pierantonioseee', 'alfonso.pierantonio@univaq.it', 'Boh!'),
(2, 'Pippo2', 'Baudo2', 'pippo.baudo2@univaq.it', 'Some text gooes here!2'),
(3, 'Sergio', 'Mattarelaa', 's.mattarella@quirinale.it', 'Boh 2!'),
(4, 'Gino', 'Ginelli', 'gino@ginelli.me', 'Boh'),
(5, 'A', 'A', 'A@A.com', 'A'),
(6, 'A', 'A', 'A@A.com', 'A'),
(7, 's', 's', 's@s.com', 'sss'),
(8, 's', 's', 's@s.com', 'sss'),
(9, 's', 's', 's@s.com', 'sss'),
(10, 's', 's', 's@s.com', 'sss');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`username`,`id_groups`);

--
-- Indexes for table `users_old`
--
ALTER TABLE `users_old`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users_old`
--
ALTER TABLE `users_old`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
