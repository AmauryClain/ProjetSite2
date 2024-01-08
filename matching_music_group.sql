-- phpMyAdmin SQL Dump
-- version 5.1.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 08, 2024 at 04:18 PM
-- Server version: 5.7.24
-- PHP Version: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matching_music_group`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `alb_id` int(11) NOT NULL,
  `alb_name` varchar(300) NOT NULL,
  `alb_createdate` date NOT NULL,
  `grp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`alb_id`, `alb_name`, `alb_createdate`, `grp_id`) VALUES
(1, 'Cowboys From Hell', '1990-07-24', 1),
(2, 'Vulgar Display Of Power', '1992-02-25', 1),
(3, 'De Mysteriis Dom Sathanas', '1994-05-24', 9);

-- --------------------------------------------------------

--
-- Table structure for table `groupe`
--

CREATE TABLE `groupe` (
  `grp_id` int(11) NOT NULL,
  `grp_name` varchar(200) NOT NULL,
  `grp_createdate` date DEFAULT NULL,
  `grp_img` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `groupe`
--

INSERT INTO `groupe` (`grp_id`, `grp_name`, `grp_createdate`, `grp_img`) VALUES
(1, 'Pantera', '1981-01-01', NULL),
(8, 'Cannibal Corpse', '1988-01-01', NULL),
(9, 'Mayhem', '1984-01-01', NULL),
(10, 'Meshuggah', '1987-01-01', NULL),
(11, 'Metallica', '1981-01-01', NULL),
(12, 'Megadeth', '1983-01-01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grp_genre`
--

CREATE TABLE `grp_genre` (
  `grp_id` int(11) NOT NULL,
  `mgr_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grp_genre`
--

INSERT INTO `grp_genre` (`grp_id`, `mgr_id`) VALUES
(11, 1),
(12, 1),
(1, 2),
(8, 3),
(9, 5),
(10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `grp_membre`
--

CREATE TABLE `grp_membre` (
  `mbr_id` int(11) NOT NULL,
  `grp_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `grp_membre`
--

INSERT INTO `grp_membre` (`mbr_id`, `grp_id`) VALUES
(1, 1),
(2, 1),
(3, 9);

-- --------------------------------------------------------

--
-- Table structure for table `membre`
--

CREATE TABLE `membre` (
  `mbr_id` int(11) NOT NULL,
  `mbr_firstName` varchar(100) NOT NULL,
  `mbr_lastName` varchar(100) NOT NULL,
  `mbr_role` varchar(70) NOT NULL,
  `mbr_birthdate` date NOT NULL,
  `mbr_joinDate` date NOT NULL,
  `mbr_nickname` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membre`
--

INSERT INTO `membre` (`mbr_id`, `mbr_firstName`, `mbr_lastName`, `mbr_role`, `mbr_birthdate`, `mbr_joinDate`, `mbr_nickname`) VALUES
(1, 'Darrell', 'Abbott', 'Guitariste', '1966-08-20', '1981-01-01', 'Dimebag Darrell'),
(2, 'Vincent Paul', 'Abbott', 'Batterie', '1964-03-11', '1981-01-01', 'Vinnie Paul'),
(3, 'Per Yngve', 'Ohlin', 'Chant', '1969-01-16', '1988-01-01', 'Dead');

-- --------------------------------------------------------

--
-- Table structure for table `music_genre`
--

CREATE TABLE `music_genre` (
  `mgr_id` int(11) NOT NULL,
  `mgr_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `music_genre`
--

INSERT INTO `music_genre` (`mgr_id`, `mgr_name`) VALUES
(1, 'Heavy Metal'),
(2, 'Groove Metal'),
(3, 'Death Metal'),
(4, 'Trash Metal'),
(5, 'Black Metal'),
(6, 'Progressive Metal');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`alb_id`),
  ADD KEY `album_groupe_FK` (`grp_id`);

--
-- Indexes for table `groupe`
--
ALTER TABLE `groupe`
  ADD PRIMARY KEY (`grp_id`);

--
-- Indexes for table `grp_genre`
--
ALTER TABLE `grp_genre`
  ADD PRIMARY KEY (`grp_id`,`mgr_id`),
  ADD KEY `grp_genre_music_genre0_FK` (`mgr_id`);

--
-- Indexes for table `grp_membre`
--
ALTER TABLE `grp_membre`
  ADD PRIMARY KEY (`mbr_id`,`grp_id`),
  ADD KEY `grp_membre_groupe0_FK` (`grp_id`);

--
-- Indexes for table `membre`
--
ALTER TABLE `membre`
  ADD PRIMARY KEY (`mbr_id`);

--
-- Indexes for table `music_genre`
--
ALTER TABLE `music_genre`
  ADD PRIMARY KEY (`mgr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `alb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `groupe`
--
ALTER TABLE `groupe`
  MODIFY `grp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `membre`
--
ALTER TABLE `membre`
  MODIFY `mbr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `music_genre`
--
ALTER TABLE `music_genre`
  MODIFY `mgr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `album_groupe_FK` FOREIGN KEY (`grp_id`) REFERENCES `groupe` (`grp_id`);

--
-- Constraints for table `grp_genre`
--
ALTER TABLE `grp_genre`
  ADD CONSTRAINT `grp_genre_groupe_FK` FOREIGN KEY (`grp_id`) REFERENCES `groupe` (`grp_id`),
  ADD CONSTRAINT `grp_genre_music_genre0_FK` FOREIGN KEY (`mgr_id`) REFERENCES `music_genre` (`mgr_id`);

--
-- Constraints for table `grp_membre`
--
ALTER TABLE `grp_membre`
  ADD CONSTRAINT `grp_membre_groupe0_FK` FOREIGN KEY (`grp_id`) REFERENCES `groupe` (`grp_id`),
  ADD CONSTRAINT `grp_membre_membre_FK` FOREIGN KEY (`mbr_id`) REFERENCES `membre` (`mbr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
