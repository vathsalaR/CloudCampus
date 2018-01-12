-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2017 at 06:57 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cloudcampus`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `Id` int(5) NOT NULL AUTO_INCREMENT,
  `Code` varchar(20) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Professor` int(5) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Code` (`Code`),
  KEY `Professor_in_Login_Table` (`Professor`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`Id`, `Code`, `Name`, `Description`, `Professor`) VALUES
(1, 'IS 6410', 'Web Based Apps', 'We teach Something', 12),
(2, 'IS 4320', 'Business Intel', 'We teach what we teach', 12),
(3, 'IS 5340', 'Natural Language', 'We teach English in a new way.', 11),
(4, 'IS 6160', 'Data Mining', 'Data is the New God.', 11),
(5, 'IS 6800', 'Distributed Systems', 'The say once the world was centralized.', 11);

-- --------------------------------------------------------

--
-- Table structure for table `enroll`
--

DROP TABLE IF EXISTS `enroll`;
CREATE TABLE IF NOT EXISTS `enroll` (
  `Id` int(5) NOT NULL AUTO_INCREMENT,
  `UserId` int(20) NOT NULL,
  `ClassId` int(20) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UserId` (`UserId`,`ClassId`),
  KEY `Class_in_Class_Table` (`ClassId`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enroll`
--

INSERT INTO `enroll` (`Id`, `UserId`, `ClassId`) VALUES
(36, 9, 3),
(37, 9, 4),
(39, 9, 5);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `Id` int(5) NOT NULL AUTO_INCREMENT,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Role` varchar(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Username` (`Username`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`Id`, `Username`, `Password`, `Email`, `Role`, `Name`) VALUES
(9, 'Teja', 'teja12', 'teja.kommineni1@gmail.com', 'Student', 'Teja'),
(10, 'Vathsala', 'vatsed', 'vathsala.ragireddy@gmail.com', 'Student', 'Vathsala'),
(11, 'Rob', 'robrob', 'rob@rob.edu', 'Professor', 'Robert Ricci'),
(12, 'Kobus', 'kobus', 'kobus@cs.edu', 'Professor', 'Kobus');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
CREATE TABLE IF NOT EXISTS `notifications` (
  `Id` int(5) NOT NULL AUTO_INCREMENT,
  `UserId` int(5) NOT NULL,
  `Videos` int(5) NOT NULL DEFAULT '0',
  `Questions` int(5) NOT NULL DEFAULT '0',
  `Answers` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `UserId` (`UserId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`Id`, `UserId`, `Videos`, `Questions`, `Answers`) VALUES
(4, 10, 0, 0, 0),
(3, 9, 0, 0, 0),
(5, 11, 0, 0, 0),
(6, 12, 0, 0, 0),
(7, 13, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `Id` int(5) NOT NULL AUTO_INCREMENT,
  `Question` varchar(200) NOT NULL,
  `UserId` int(11) NOT NULL,
  `Answer` varchar(200) NOT NULL DEFAULT '',
  `ClassId` int(5) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Question` (`Question`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`Id`, `Question`, `UserId`, `Answer`, `ClassId`) VALUES
(11, 'Dear Professor,\r\nWhat are the suggested books for this course ?\r\nThanks,\r\nTeja', 9, 'The research papers discussed in the class along with my slides should be enough. There are few other materials posted on my website.', 4),
(12, 'Hi, \r\nWhat is the syllabus for mid term ?', 9, 'It should be what we covered in the class till tuesday.', 5),
(13, 'asdasd', 9, 'dqw', 3),
(14, 'edaina', 9, 'answer', 3),
(15, 'post', 9, 'answeerfwed', 3),
(16, 'ask a question', 9, '', 4),
(17, 'ask', 9, 'answer', 5);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
CREATE TABLE IF NOT EXISTS `videos` (
  `Id` int(5) NOT NULL AUTO_INCREMENT,
  `ClassId` int(20) NOT NULL,
  `Links` varchar(200) NOT NULL,
  `Topic` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `ClassID_in_Class_Table` (`ClassId`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`Id`, `ClassId`, `Links`, `Topic`) VALUES
(11, 5, 'consensus/raft.go', 'Consesus'),
(12, 5, 'transactions/aries.go', 'Transactions'),
(13, 3, 'tes url', 'test'),
(14, 3, 'asdasdas', 'asdd'),
(15, 3, 'tested', 'test'),
(16, 3, 'test1', 'test1'),
(17, 3, 'asdas', 'asas');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
