-- phpMyAdmin SQL Dump
-- version 4.4.15.9
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 03, 2017 at 10:57 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simpleapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` bigint(10) NOT NULL,
  `user_firstname` varchar(240) NOT NULL,
  `user_lastname` varchar(240) NOT NULL,
  `user_gender` tinyint(2) NOT NULL DEFAULT '1',
  `user_age` int(10) NOT NULL,
  `user_dob` date NOT NULL,
  `user_phone` bigint(10) NOT NULL,
  `user_city` varchar(240) NOT NULL,
  `user_state` varchar(240) NOT NULL,
  `user_country` varchar(240) NOT NULL,
  `user_email` varchar(240) NOT NULL,
  `user_username` varchar(240) NOT NULL,
  `user_password` varchar(240) NOT NULL,
  `user_status` tinyint(240) NOT NULL DEFAULT '1',
  `user_type` varchar(240) NOT NULL DEFAULT 'subscriber',
  `user_pic` varchar(240) NOT NULL DEFAULT '1',
  `img_name` varchar(240) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_firstname`, `user_lastname`, `user_gender`, `user_age`, `user_dob`, `user_phone`, `user_city`, `user_state`, `user_country`, `user_email`, `user_username`, `user_password`, `user_status`, `user_type`, `user_pic`, `img_name`) VALUES
(1, 's', 's', 1, 18, '2017-10-04', 9898989898, 'rajkot', 'gujarat', 'india', 'rushikmaniar107@gmail.com', 's', '$2y$10$PLFFudRKJmsLIxST5zhMHO5RHGWVpj5is.2ZyBhDizg6p29Z6d756', 1, 'subscriber', 'localhost/github/simpleapp//user/uploads/profile/images/1_profile_logo.png', '1_profile_logo.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_phone` (`user_phone`),
  ADD UNIQUE KEY `user_username` (`user_username`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` bigint(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
