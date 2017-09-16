-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2017 at 04:16 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jonas`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`user_from`, `user_to`, `message`, `date`, `ID`) VALUES
(1, 5, 'hi!', '2017-09-15 11:56:42', 1),
(5, 1, 'hello!', '2017-09-15 11:56:45', 2),
(1, 5, 'hi', '2017-09-15 12:10:22', 3),
(1, 5, 'this is a test message', '2017-09-15 12:11:14', 4),
(1, 5, 'yet another test', '2017-09-15 12:12:03', 5),
(1, 1, 'hi', '2017-09-15 12:44:30', 6),
(6, 1, 'hi admin', '2017-09-15 13:20:41', 7),
(1, 6, 'hello my master!', '2017-09-15 13:33:00', 10),
(1, 6, 'wolla', '2017-09-15 13:34:38', 11),
(6, 1, 'hi again', '2017-09-15 13:55:29', 12),
(6, 1, 'testing', '2017-09-15 13:57:12', 13),
(6, 1, '123', '2017-09-15 13:57:52', 14),
(6, 1, 'lalala', '2017-09-15 13:58:28', 15),
(6, 1, 'hi', '2017-09-15 14:10:46', 16),
(6, 7, 'yo bro :p', '2017-09-15 15:00:49', 17),
(1, 5, 'fjdkfjsl$Âµ', '2017-09-15 15:06:16', 18),
(7, 6, 'yooooo :D', '2017-09-15 16:06:33', 19),
(6, 7, 'this is awesome :p', '2017-09-15 16:06:52', 20),
(7, 6, 'aight :D', '2017-09-15 16:11:43', 21);

-- --------------------------------------------------------

--
-- Table structure for table `pagegen`
--

CREATE TABLE `pagegen` (
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `user_id` int(11) NOT NULL,
  `permissions` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`user_id`, `permissions`) VALUES
(1, 'cloud, chat'),
(6, 'chat, cloud'),
(7, 'cloud, chat');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_pass`) VALUES
(1, 'admin', '$2y$10$iNGE4KUa2GFkLe0NiyW.heqW1rmLeMOxh0GvJuttjevREsx4cjtKu'),
(5, 'test', '$2y$10$NJ.9GpxUgss8GgGt.cpsAeSokNjZ2FKsXYtwb.Wr4ryMem1WjwG5a'),
(6, 'robin', '$2y$10$OxEG314mUD.3fVlKHCGvw.BEkpbo3oWtiGkcLSXP9NT.y27CuJVGW'),
(7, 'EMP_@thy', '$2y$10$PuBbmZhwFJNliDoEfEqwaus3OCnk4FD2jSCDi/u.A5urn5wsDKQN2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
