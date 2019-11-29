-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2019 at 03:28 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `teater`
--

-- --------------------------------------------------------

--
-- Table structure for table `movie`
--

CREATE TABLE IF NOT EXISTS `movie` (
`id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `minutes` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `movie`
--

INSERT INTO `movie` (`id`, `name`, `minutes`, `description`) VALUES
(1, 'Upin Ipin', 150, 'Kembar bocil yang kadang jahil'),
(2, 'Dilan Apa Kabar?', 130, 'Iyaa mileea,, kabar baikk'),
(3, 'Biograpi Lucinta Luna', 100, 'Biografi lucinta luna dan bisnis kopinya'),
(4, 'Berantem Yuk', 130, 'Ayukk berantem siniii'),
(5, 'Tinki Winki', 110, 'Dipsiii.. POOH'),
(6, 'Kaskus', 125, 'Yuuk startupp..');

-- --------------------------------------------------------

--
-- Table structure for table `screen`
--

CREATE TABLE IF NOT EXISTS `screen` (
`id` int(11) NOT NULL,
  `theater_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `seats` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `screen`
--

INSERT INTO `screen` (`id`, `theater_id`, `name`, `seats`) VALUES
(1, 1, 'Ruang 1', 120),
(2, 1, 'Ruang 2', 100),
(3, 2, 'Ruang 1', 100),
(4, 2, 'Ruang 2', 100);

-- --------------------------------------------------------

--
-- Table structure for table `showtime`
--

CREATE TABLE IF NOT EXISTS `showtime` (
`id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `showtime`
--

INSERT INTO `showtime` (`id`, `screen_id`, `movie_id`, `start_date`, `end_date`) VALUES
(1, 1, 1, '2019-11-01', '2019-11-08'),
(2, 1, 2, '2019-11-01', '2019-11-04'),
(3, 2, 1, '2019-11-02', '2019-11-13');

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE IF NOT EXISTS `theater` (
`id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`id`, `name`, `address`) VALUES
(1, 'Transmart', 'Jakarta'),
(2, 'Bioskop21', 'Tangerang'),
(3, 'Cinemaplex', 'Jakarta ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movie`
--
ALTER TABLE `movie`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screen`
--
ALTER TABLE `screen`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `showtime`
--
ALTER TABLE `showtime`
 ADD PRIMARY KEY (`id`), ADD KEY `fk_screen` (`screen_id`), ADD KEY `fk_movie` (`movie_id`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movie`
--
ALTER TABLE `movie`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `screen`
--
ALTER TABLE `screen`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `showtime`
--
ALTER TABLE `showtime`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `showtime`
--
ALTER TABLE `showtime`
ADD CONSTRAINT `fk_movie` FOREIGN KEY (`movie_id`) REFERENCES `movie` (`id`),
ADD CONSTRAINT `fk_screen` FOREIGN KEY (`screen_id`) REFERENCES `screen` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
