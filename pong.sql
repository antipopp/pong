-- phpMyAdmin SQL Dump
-- version 4.7.8
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2018 at 10:05 AM
-- Server version: 10.0.33-MariaDB
-- PHP Version: 5.5.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pong`
--

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE `leaderboard` (
  `id` int(11) NOT NULL,
  `win` int(11) NOT NULL,
  `lost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `leaderboard`
--

INSERT INTO `leaderboard` (`id`, `win`, `lost`) VALUES
(5, 0, 0),
(6, 0, 0),
(7, 0, 0),
(8, 0, 0),
(9, 0, 0),
(10, 0, 0),
(11, 0, 0),
(12, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `trn_date`) VALUES
(1, 'ciccio', 'email@falsa.it', 'ce2505c0da3616108de4736804aff6b5', '2018-03-12 15:55:43'),
(7, 'ciccio', 'sultano@gmail.it', 'e165d4f2174b66a7d1a95cb204d296eb', '2018-03-16 11:03:59'),
(8, 'ciccio', 'email2@falsa.it', 'ffe7470430a737c4ce6dc74bea0155d5', '2018-03-16 12:49:58'),
(9, 'franco', 'franco@email.it', '6dd1411a66159040b7fff30d0097dbe4', '2018-03-16 16:41:23'),
(10, 'francos', 'francos@gmail.com', 'f1cb3645724a42ea0e1fab16e3532e9e', '2018-03-16 16:42:48'),
(11, 'franco', 'frnaco@email.it', '6dd1411a66159040b7fff30d0097dbe4', '2018-03-20 09:14:43'),
(12, 'franci', 'franci@ema.ir', '17166193b35a231d8031c52931e06a70', '2018-03-20 09:19:18');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `leaderboard_init` AFTER INSERT ON `users` FOR EACH ROW INSERT INTO `leaderboard` (id, win, lost)
VALUES (NEW.id, 0, 0)
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `id_2` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
