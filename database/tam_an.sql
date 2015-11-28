

-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2015 at 09:04 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE IF NOT EXISTS `Tam_An`;
USE `Tam_An`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tam_an`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf16_vietnamese_ci NOT NULL,
  `Username` varchar(50) COLLATE utf16_vietnamese_ci NOT NULL,
  `Password` varchar(100) COLLATE utf16_vietnamese_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_vietnamese_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Id`, `Name`, `Username`, `Password`) VALUES
(1, 'Tâm An', 'admin', '827ccb0eea8a706c4c34a16891f84e7b'),
(2, 'Hồ Hữu Phát', 'dekal', '827ccb0eea8a706c4c34a16891f84e7b'),
(3, 'Kim Nhật Thành', 'knthanh', '827ccb0eea8a706c4c34a16891f84e7b'),
(4, 'Trịnh Hoàng Triều', 'thtrieu', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) COLLATE utf16_vietnamese_ci NOT NULL,
  `Remain` int(11) NOT NULL,
  `Price` int(11) NOT NULL,
  `UnitName` varchar(50) COLLATE utf16_vietnamese_ci NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf16 COLLATE=utf16_vietnamese_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Id`, `Name`, `Remain`, `Price`, `UnitName`) VALUES
(1, 'Cá hú', 1000, 10000, 'Con'),
(2, 'Cá Nhật', 1, 1, 'Con');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
