-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2015 at 06:10 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tam_an_fix_bug`
--
CREATE DATABASE IF NOT EXISTS `Tam_An` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `Tam_An`;

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone_Number` varchar(50) DEFAULT NULL,
  `Address` char(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ID`, `Name`, `Email`, `Phone_Number`, `Address`) VALUES
('0000001', 'Van Duy Vinh', 'vdvinh@apcs.vn', '09090909', '1234567891'),
('0000002', 'Quach Minh Tri', 'qmtri@qpcs.vn', '09090908', '1234567891');

-- --------------------------------------------------------

--
-- Table structure for table `debts`
--

DROP TABLE IF EXISTS `debts`;
CREATE TABLE IF NOT EXISTS `debts` (
  `RecieptID` int NOT NULL,
  `Deadline` date DEFAULT NULL,
  `Payment_Date` date DEFAULT NULL,
  PRIMARY KEY (`RecieptID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `Name` varchar(50) DEFAULT NULL,
  `Role` varchar(50) DEFAULT NULL,
  `Salary` double DEFAULT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  `Email` varchar(50) DEFAULT NULL,
  `Adress` varchar(50) DEFAULT NULL,
  `Phone_Number` varchar(50) DEFAULT NULL,
  `CMND` char(12) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Name`, `Role`, `Salary`, `ID`, `Email`, `Adress`, `Phone_Number`, `CMND`) VALUES
('Ho Huu Phat', 'Sale', 1000000, '0000001', 'hhp@apcs.vn', '5, HCM', '090912312', '123123123'),
('Kim Nhat Thanh', 'Sale', 1000000, '0000002', 'knt@apcs.vn', 'Tan Binh, HCM', '090912313', '123123124'),
('Trinh Hoang Trieu', 'Owner', 1000000, '0000003', 'tht@apcs.vn', '5, HCM', '090912314', '123123125');

-- --------------------------------------------------------

--
-- Create user table
--
DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Employee_ID` int DEFAULT NULL,  
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employee`
--

INSERT INTO `user` (`Id`, `Name`, `Username`, `Password`, `Employee_ID`) VALUES
(1, 'Tâm An', 'admin', '827ccb0eea8a706c4c34a16891f84e7b', NULL),
(2, 'Hồ Hữu Phát', 'dekal', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(3, 'Kim Nhật Thành', 'knthanh', '827ccb0eea8a706c4c34a16891f84e7b', '1'),
(4, 'Trịnh Hoàng Triều', 'thtrieu', '25d55ad283aa400af464c76d713c07ad', '3');

-- --------------------------------------------------------
--
-- Table structure for table `input product`
--

DROP TABLE IF EXISTS `input product`;
CREATE TABLE IF NOT EXISTS `input product` (
  `Number` float DEFAULT NULL,
  `Price` double DEFAULT NULL,
  `Tax` double DEFAULT NULL,
  `ProductID` int NOT NULL,
  `ProviderID` int NOT NULL,
  `ReceiptID` int NOT NULL,
  PRIMARY KEY (`ProductID`,`ProviderID`,`ReceiptID`),
  KEY `FK_Input Product_Input Product Receipt` (`ReceiptID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `input product receipt`
--

DROP TABLE IF EXISTS `input product receipt`;
CREATE TABLE IF NOT EXISTS `input product receipt` (
  `Transporter` varchar(50) DEFAULT NULL,
  `ReceiptID` int NOT NULL,
  PRIMARY KEY (`ReceiptID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `output product`
--

DROP TABLE IF EXISTS `output product`;
CREATE TABLE IF NOT EXISTS `output product` (
  `ProductID` int NOT NULL,
  `Number` float DEFAULT NULL,
  `Tax` double DEFAULT NULL,
  `ReceiptID` int NOT NULL,
  `Price` decimal(19,4) DEFAULT NULL,
  PRIMARY KEY (`ProductID`,`ReceiptID`),
  KEY `FK_Output Product_Output Product Receipt` (`ReceiptID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `output product receipt`
--

DROP TABLE IF EXISTS `output product receipt`;
CREATE TABLE IF NOT EXISTS `output product receipt` (
  `CustomerID` int DEFAULT NULL,
  `ReceiptID` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ReceiptID`),
  KEY `FK_Output Product Receipt_Customer` (`CustomerID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Product_ID` nvarchar(10) DEFAULT NULL,
  `Name` varchar(250) DEFAULT NULL,
  `Unit` varchar(50) DEFAULT NULL,
  `Product_TypeID` int DEFAULT NULL,
  `TrademarkID` int DEFAULT NULL,
  `Price` double DEFAULT 0,
  `Bought` double DEFAULT 0,  
  `NumRemain` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Product_Product_Type` (`Product_TypeID`),
  KEY `FK_Product_Trademark` (`TrademarkID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`ID`, `Name`, `Unit`, `Product_TypeID`, `TrademarkID`, `Price`, `NumRemain`) VALUES(NULL, 'Bánh dưỡng sinh cao cấp ông thầy Tuệ Hải', 'hộp', '6', NULL, 50000, NULL),
(NULL, 'Bột trầm', 'Lọ', '6', NULL, 200000, NULL),
(NULL, 'Chojyo Kansa miso', 'hộp', '6', NULL, 350000, NULL),
(NULL, 'Chojyo Miso( đậm)', 'hộp', '6', NULL, 300000, NULL),
(NULL, 'Chojyo Miso( nhạt)', 'hộp', '6', NULL, 300000, NULL),
(NULL, 'Canh rong biển', 'hộp', '6', NULL, 40000, NULL),
(NULL, 'Đèn đá muối', 'kg', '6', NULL, 230000, NULL),
(NULL, 'Đèn đá muối (đèn lò tinh dầu tự nhiên)', 'Kg', '6', NULL, 230000, NULL),
(NULL, 'Dầu dừa dưỡng tóc Lifecoco (180ml)', 'chai', '6', NULL, 120000, NULL),
(NULL, 'Dầu dừa dưỡng da Lifecoco (180ml)', 'chai', '6', NULL, 120000, NULL),
(NULL, 'Dầu dừa tinh luyện Lifecoco (500ml) màu vàng', 'chai', '6', NULL, 65000, NULL),
(NULL, 'Dầu dừa tinh khiết Lifecoco (250ml)', 'chai', '6', NULL, 65000, NULL),
(NULL, 'Dầu dừa dưỡng da Lifecoco (100ml)', 'chai', '6', NULL, 70000, NULL),
(NULL, 'Dầu dừa tinh khiết Lifecoco (500ml)', 'chai', '6', NULL, 120000, NULL),
(NULL, 'Dầu dừa dưỡng tóc Lifecoco (100ml)', 'chai', '6', NULL, 70000, NULL),
(NULL, 'Dầu dừa dưỡng tóc và da Lifecoco (50ml)', 'chai', '6', NULL, 40000, NULL),
(NULL, 'Đường đen ', 'Kg ', '6', NULL, 20000, NULL),
(NULL, 'Đèn đá massage chân', 'cái', '6', NULL, 1200000, NULL),
(NULL, 'Đèn đá tượng phật', 'kg', '6', NULL, 650000, NULL),
(NULL, 'Đèn đá xây dựng (25*25)', 'viên', '6', NULL, 450000, NULL),
(NULL, 'Đèn đá xây dựng', 'viên', '6', NULL, 130000, NULL),
(NULL, 'Dầu oliu extra(250ml)', 'chai(250ml)', '6', NULL, 99000, NULL),
(NULL, 'Gạo đen hữu cơ hoa sữa', 'kg', '6', NULL, 80000, NULL),
(NULL, 'Gạo đỏ hữu cơ hoa sữa', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Gạo lứt đỏ', 'Kg', '6', NULL, 29000, NULL),
(NULL, 'Gạo lứt trắng hữu cơ hoa sữa', 'kg', '6', NULL, 55000, NULL),
(NULL, 'Hải sâm', 'Con', '6', NULL, 400000, NULL),
(NULL, 'Kim thử đường', 'hộp', '6', NULL, 55000, NULL),
(NULL, 'Muối massage', 'viên', '6', NULL, 100000, NULL),
(NULL, 'Miso nhật (đen - gói 1kg)', 'gói( 1 kg)', '6', NULL, 1000000, NULL),
(NULL, 'Đèn đá Massage chân lớn', 'cái', '6', NULL, 950000, NULL),
(NULL, 'Máy thử đường', 'máy', '6', NULL, 1800000, NULL),
(NULL, 'Muối ủ', 'kg', '6', NULL, 140000, NULL),
(NULL, 'Natto ', 'Hộp', '6', NULL, 31000, NULL),
(NULL, 'Ngưu báng', 'kg', '6', NULL, 220000, NULL),
(NULL, 'Nhung hưu tươi', 'gr', '6', NULL, 17000, NULL),
(NULL, 'Nghệ Nano', 'lọ', '6', NULL, 800000, NULL),
(NULL, 'Que thử đường', 'hộp', '6', NULL, 265000, NULL),
(NULL, 'Rau mầm (200g)', 'Hộp', '6', NULL, 15000, NULL),
(NULL, 'Shinshu miso (vàng)', 'kg', '6', NULL, 130000, NULL),
(NULL, 'Takasago chojyu - miso', 'gói', '6', NULL, 50000, NULL),
(NULL, 'Đèn đá muối(Thố đá lớn)', 'cái', '6', NULL, 850000, NULL),
(NULL, 'Tỏi đen', 'hộp(100gr)', '6', NULL, 250000, NULL),
(NULL, 'Tỏi đen', 'hộp(500gr)', '6', NULL, 700000, NULL),
(NULL, 'Đèn đá muối ( Thố đá nhỏ )', 'cái', '6', NULL, 600000, NULL),
(NULL, 'Đèn đá muối(Thố đá trung)', 'cái', '6', NULL, 700000, NULL),
(NULL, '(Trà trầm + trà dây) hút chân không', 'gói', '6', NULL, 82000, NULL),
(NULL, 'Trà trầm hút chân không (20gr)', 'gói(20gr)', '6', NULL, 150000, NULL),
(NULL, 'Trà trầm hút chân không (50g)', 'gói(50g)', '6', NULL, 300000, NULL),
(NULL, 'Trà trầm túi lọc ( hộp lớn )', 'hộp', '6', NULL, 200000, NULL),
(NULL, 'Trà trầm túi lọc ( hộp nhỏ )', 'hộp', '6', NULL, 200000, NULL),
(NULL, 'Xà phòng dầu dừa Lifecoco', 'hộp', '6', NULL, 55000, NULL),
(NULL, 'Yến hồng Gò Công', 'Hộp', '6', NULL, 4200000, NULL),
(NULL, 'Yến trắng Gò Công', 'Hộp', '6', NULL, 3600000, NULL),
(NULL, 'Bo bo lứt', 'gói(500gr)', '6', NULL, 75000, NULL),
(NULL, 'Bột gạo lứt', 'gói(500gr)', '6', NULL, 32000, NULL),
(NULL, 'Bơ hạnh nhân', 'hủ(150gr)', '6', NULL, 140000, NULL),
(NULL, 'Bột nghệ đen', 'hủ(100gr)', '6', NULL, 35000, NULL),
(NULL, 'Bột nấm linh chi', 'gói(50gr)', '6', NULL, 390000, NULL),
(NULL, 'Bột nghệ vàng', 'hủ(100gr)', '6', NULL, 30000, NULL),
(NULL, 'Bột sắn loại 2', 'gói(500gr)', '6', NULL, 120000, NULL),
(NULL, 'Bột sắn loại 1', 'gói(500gr)', '6', NULL, 130000, NULL),
(NULL, 'Bột sắn loại 3', 'gói(500gr)', '6', NULL, 100000, NULL),
(NULL, 'Bột sắn tinh chế (500g)', 'gói(500gr)', '6', NULL, 160000, NULL),
(NULL, 'Bánh tráng lứt', 'gói(400gr)', '6', NULL, 32000, NULL),
(NULL, 'Bún gạo lứt', 'gói(200gr)', '6', NULL, 26000, NULL),
(NULL, 'Cao khoai sọ ( hũ 280gr)', 'hũ(280gr)', '6', NULL, 70000, NULL),
(NULL, 'Chanh muối', 'hủ(250gr)', '6', NULL, 50000, NULL),
(NULL, 'Choimiso đậm(hủ)', 'hủ( 100 gr)', '6', NULL, 90000, NULL),
(NULL, 'Choimiso nhạt( hủ)', 'hủ( 100 gr)', '6', NULL, 80000, NULL),
(NULL, 'Đậu đỏ sống', 'gói(500gr)', '6', NULL, 45000, NULL),
(NULL, 'Trà đậu đỏ', 'gói(500gr)', '6', NULL, 60000, NULL),
(NULL, 'Dầu mè', 'chai(300ml)', '6', NULL, 85000, NULL),
(NULL, 'Denti chà Răng', 'hủ(100gr)', '6', NULL, 50000, NULL),
(NULL, 'Denti ngậm', 'hủ(100gr)', '6', NULL, 85000, NULL),
(NULL, 'Cốm ống', 'gói(150gr)', '6', NULL, 17000, NULL),
(NULL, 'Cốm ống hình con sâu', 'gói(200gr)', '6', NULL, 23000, NULL),
(NULL, 'Cốm gạo lứt', 'gói(250gr)', '6', NULL, 35000, NULL),
(NULL, 'Trà Gạo lứt', 'gói(500gr)', '6', NULL, 40000, NULL),
(NULL, 'Hạt chia đen', 'gói(500gr)', '6', NULL, 600000, NULL),
(NULL, 'Hạt chia đen (250gr)', 'gói(250gr)', '6', NULL, 310000, NULL),
(NULL, 'Hạt kê', 'gói(500gr)', '6', NULL, 55000, NULL),
(NULL, 'Hạnh nhân', 'gói(500gr)', '6', NULL, 235000, NULL),
(NULL, 'Hạnh nhân rang muối', 'gói(500gr)', '6', NULL, 235000, NULL),
(NULL, 'Hạt sen lứt', 'gói(500gr)', '6', NULL, 100000, NULL),
(NULL, 'Kansa miso( hủ)', 'hủ( 100 gr)', '6', NULL, 90000, NULL),
(NULL, 'Lúa mạch', 'gói(500gr)', '6', NULL, 100000, NULL),
(NULL, 'Lúa mạch ăn liền( 500gr)', 'gói( 500gr)', '6', NULL, 60000, NULL),
(NULL, 'Mật ong rừng( 150ml)', 'hũ( 150ml)', '6', NULL, 135000, NULL),
(NULL, 'Muối ăn hymalaya', 'hủ(400gr)', '6', NULL, 60000, NULL),
(NULL, 'Muối ăn (1kg)', 'gói(1kg)', '6', NULL, 140000, NULL),
(NULL, 'Mơ muối', 'hủ(250gr)', '6', NULL, 60000, NULL),
(NULL, 'Muối ngâm chân hymalaya', 'hủ(400gr)', '6', NULL, 60000, NULL),
(NULL, 'Mật ong ( chai 600ml)', 'chai(600ml)', '6', NULL, 250000, NULL),
(NULL, 'Mè rang không muối', 'gói(200gr)', '6', NULL, 35000, NULL),
(NULL, 'Mè rang muối 1/20', 'gói(200gr)', '6', NULL, 38000, NULL),
(NULL, 'Mè rang muối 1/30', 'gói(200gr)', '6', NULL, 38000, NULL),
(NULL, 'Mè rang muối 1/40', 'gói(200gr)', '6', NULL, 38000, NULL),
(NULL, 'Mè sống', 'gói(500gr)', '6', NULL, 43000, NULL),
(NULL, 'Túi massage cổ vai', 'cái', '6', NULL, 445000, NULL),
(NULL, 'Miso đen (nhật)', 'hủ(100gr)', '6', NULL, 100000, NULL),
(NULL, 'Túi massage gối', 'cái', '6', NULL, 415000, NULL),
(NULL, 'Túi massage lưng', 'cái', '6', NULL, 430000, NULL),
(NULL, 'Muối ủ (1.5 kg)+túi nhung', 'gói', '6', NULL, 270000, NULL),
(NULL, 'Muối ủ ( 1 kg)', 'gói', '6', NULL, 140000, NULL),
(NULL, 'Nấm Lim Xanh (40 g)', 'Gói(40gr)', '6', NULL, 390000, NULL),
(NULL, 'Óc chó hủ', 'hủ', '6', NULL, 105000, NULL),
(NULL, 'Óc chó gói', 'gói', '6', NULL, 370000, NULL),
(NULL, 'Phở gạo lứt', 'gói', '6', NULL, 41000, NULL),
(NULL, 'Phổ tai nhật', 'gói', '6', NULL, 160000, NULL),
(NULL, 'Rong biển nhật', 'gói', '6', NULL, 100000, NULL),
(NULL, 'Sữa dưỡng sinh(ngũ cốc)" Ông Thầy Tuệ Hải " không đường', 'gói', '6', NULL, 60000, NULL),
(NULL, 'Trà bancha cọng', 'gói', '6', NULL, 45000, NULL),
(NULL, 'Trà bancha lá (150gr)', 'gói', '6', NULL, 45000, NULL),
(NULL, 'Tinh bột nghệ đen', 'hủ', '6', NULL, 190000, NULL),
(NULL, 'Tinh bột nghệ vàng 100gr', 'hũ(100gr)', '6', NULL, 170000, NULL),
(NULL, 'Trà củ sen (100gr)', 'gói', '6', NULL, 42000, NULL),
(NULL, 'Hỗ trợ đau bao tử', 'hủ', '6', NULL, 1200000, NULL),
(NULL, 'Tekka', 'hũ(150gr)', '6', NULL, 150000, NULL),
(NULL, 'Trà khổ qua (thái lát)', 'gói ( 200gr)', '6', NULL, 30000, NULL),
(NULL, 'Trà khổ qua dây ', 'gói(200gr)', '6', NULL, 60000, NULL),
(NULL, 'Trà lá sen ( 20g)', 'gói', '6', NULL, 4000, NULL),
(NULL, 'Tamari', 'Chai(300ml)', '6', NULL, 150000, NULL),
(NULL, 'Tamari tỏi', 'hủ(300gr)', '6', NULL, 150000, NULL),
(NULL, 'Trà dây Tây Nguyên', 'gói ( 200gr )', '6', NULL, 42000, NULL),
(NULL, 'Tảo viên', 'hủ(100v)', '6', NULL, 200000, NULL),
(NULL, 'Nấm linh chi( núi)', 'gói( 50gr)', '6', NULL, 450000, NULL),
(NULL, 'Bánh hỏi gạo lứt', 'gói( 300gr)', '6', NULL, 45000, NULL),
(NULL, 'Hỗ trợ bệnh trĩ', 'thang', '6', NULL, 15000, NULL),
(NULL, 'Bồ bồ(30gr)', 'GÓI(30gr)', '6', NULL, 7000, NULL),
(NULL, 'Bồ bồ(50 gr)', 'gói(50gr)', '6', NULL, 10000, NULL),
(NULL, 'Bán chỉ liên(30gr)', 'gói(30gr)', '6', NULL, 7000, NULL),
(NULL, 'Bách hoa xà(20gr)', 'gói(20gr)', '6', NULL, 5000, NULL),
(NULL, 'Cây chó đẽ(20gr)', 'gói(20gr)', '6', NULL, 5000, NULL),
(NULL, 'Cây cơm nguội 50gr', 'gói(50gr)', '6', NULL, 5000, NULL),
(NULL, 'Cây hoàng ngọc(30gr)', 'gói(30gr)', '6', NULL, 5000, NULL),
(NULL, 'Câu kỷ tử -12g', 'gói(12gr)', '6', NULL, 10000, NULL),
(NULL, 'Cây lá gai(30gr)', 'gói(30gr)', '6', NULL, 7000, NULL),
(NULL, 'Cỏ mần chầu(20gr)', 'gói(20gr)', '6', NULL, 5000, NULL),
(NULL, 'Cây ô rô(20gr)', 'gói(20gr)', '6', NULL, 5000, NULL),
(NULL, 'Cam thảo( 12 gr)', 'gói(12gr)', '6', NULL, 7000, NULL),
(NULL, 'Hỗ trợ đau nhức', 'Thang', '6', NULL, 19000, NULL),
(NULL, 'Đan sâm(30gr)', 'gói(30gr)', '6', NULL, 7000, NULL),
(NULL, 'Lá đu đủ (30g)', 'gói(30gr)', '6', NULL, 9000, NULL),
(NULL, 'Lão sơn sâm - 12g', 'gói(12gr)', '6', NULL, 100000, NULL),
(NULL, 'Lá trinh nữ hoàng cung khô(10gr)', 'gói(10gr)', '6', NULL, 3000, NULL),
(NULL, 'Lá thiên tuế(10gr)', 'GÓI(10gr)', '6', NULL, 5000, NULL),
(NULL, 'Lá sả (5g)', 'Gói(5gr)', '6', NULL, 3000, NULL),
(NULL, 'Mắc cỡ đỏ', 'gói(30gr)', '6', NULL, 5000, NULL),
(NULL, 'Cây mã đề(20 gr)', 'gói(20gr)', '6', NULL, 3000, NULL),
(NULL, 'Mật nhân(30gr)', 'GÓI(30gr)', '6', NULL, 5000, NULL),
(NULL, 'Nàng hai  (100g)', 'gói(100gr)', '6', NULL, 12000, NULL),
(NULL, 'Nhân trần(30gr)', 'GÓI', '6', NULL, 5000, NULL),
(NULL, 'Phan tả diệp(10gr)', 'gói', '6', NULL, 2000, NULL),
(NULL, 'Quế(12g)', 'gói', '6', NULL, 10000, NULL),
(NULL, 'Rễ cây nhỏ gừa 50G', 'GÓI', '6', NULL, 10000, NULL),
(NULL, 'Rễ cây nhỏ gừa 30g', 'gói', '6', NULL, 5000, NULL),
(NULL, 'Hỗ trợ đẹp da', 'Thang', '6', NULL, 25000, NULL),
(NULL, 'Hỗ trợ động kinh-tan máu bầm trong não', 'Thang', '6', NULL, 15000, NULL),
(NULL, 'Hỗ trợ gan (ko bá bệnh)', 'Thang', '6', NULL, 30000, NULL),
(NULL, 'Hỗ trợ gan(BB)', 'Thang', '6', NULL, 35000, NULL),
(NULL, 'Hỗ trợ bệnh ho', 'thang', '6', NULL, 50000, NULL),
(NULL, 'Hỗ trợ sức khỏe', 'Thang', '6', NULL, 110000, NULL),
(NULL, 'Hỗ trợ mắt', 'Thang', '6', NULL, 15000, NULL),
(NULL, 'Hỗ trợ parkinson', 'Thang', '6', NULL, 12000, NULL),
(NULL, 'Hỗ trợ sỏi thận', 'Thang', '6', NULL, 20000, NULL),
(NULL, 'Hỗ trợ suy thận (bồi bổ khí huyết)', 'Thang', '6', NULL, 140000, NULL),
(NULL, 'Hỗ trợ bệnh trĩ', 'Thang', '6', NULL, 15000, NULL),
(NULL, 'Hỗ trợ ung bướu (ko bá bệnh)', 'thang', '6', NULL, 20000, NULL),
(NULL, 'Hỗ trợ ung bướu(BB)', 'thang', '6', NULL, 25000, NULL),
(NULL, 'Sổ tay', 'quyển', '6', NULL, 5000, NULL),
(NULL, 'Đĩa MP3', 'Đĩa', '6', NULL, 6000, NULL),
(NULL, 'Đĩa VCD', 'Đĩa', '6', NULL, 8000, NULL),
(NULL, 'Đĩa DVD', 'Đĩa', '6', NULL, 10000, NULL),
(NULL, 'Gạo mầm đen hữu cơ HoaSuaFoods - Gạo Gaba đen', 'Kg', '6', NULL, 100000, NULL),
(NULL, 'Gạo trắng hữu cơ HoaSuaFoods - Japonica', 'kg', '6', NULL, 50000, NULL),
(NULL, 'Gạo lứt hữu cơ HoaSuaFoods - hạt dài', 'kg', '6', NULL, 55000, NULL),
(NULL, 'Gạo đỏ hữu cơ HoaSuaFoods - hạt dài', 'Kg', '6', NULL, 60000, NULL),
(NULL, 'Gạo đen hữu cơ HoaSuaFoods ', 'kg', '6', NULL, 80000, NULL),
(NULL, 'GẠO CAO CẤP NÀNG MAI', 'Kg', '6', NULL, 35000, NULL),
(NULL, 'GẠO THƠM NÀNG YẾN', 'Kg', '6', NULL, 0, NULL),
(NULL, 'GẠO THƠM NÀNG NGA', 'Kg', '6', NULL, 27000, NULL),
(NULL, 'GẠO THƠM NÀNG CÚC', 'Kg', '6', NULL, 33000, NULL),
(NULL, 'GẠO TẤM NÀNG YẾN', 'Kg', '6', NULL, 0, NULL),
(NULL, 'NẾP ĐẶC SẢN VUA LIÊU', 'Kg', '6', NULL, 0, NULL),
(NULL, 'Bắp cải tím', 'kg', '6', NULL, 49500, NULL),
(NULL, 'Bắp cải trái tim', 'kg', '6', NULL, 27000, NULL),
(NULL, 'Bắp cải trắng', 'kg', '6', NULL, 15000, NULL),
(NULL, 'Bí ngồi xanh', 'kg', '6', NULL, 22500, NULL),
(NULL, 'Cải ngọt', 'kg', '6', NULL, 18000, NULL),
(NULL, 'Cà chua bi', 'kg', '6', NULL, 30000, NULL),
(NULL, 'Cà chua lớn', 'kg', '6', NULL, 27000, NULL),
(NULL, 'Cà rốt', 'kg', '6', NULL, 37500, NULL),
(NULL, 'Cải thảo', 'kg', '6', NULL, 18000, NULL),
(NULL, 'Cần tây', 'kg', '6', NULL, 21000, NULL),
(NULL, 'Củ cải đường (Củ Radick)', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Đậu Côve Nhật', 'kg', '6', NULL, 30000, NULL),
(NULL, 'Hành tây', 'kg', '6', NULL, 30000, NULL),
(NULL, 'Khoai tây lớn da hồng', 'kg', '6', NULL, 30000, NULL),
(NULL, 'Cà tím', 'kg', '6', NULL, 18000, NULL),
(NULL, 'Lơ xanh', 'kg', '6', NULL, 37000, NULL),
(NULL, 'Ớt chuông đỏ Đà Lạt', 'kg', '6', NULL, 49000, NULL),
(NULL, 'Ớt chuông vàng Đà Lạt', 'kg', '6', NULL, 49000, NULL),
(NULL, 'Ớt chuông xanh', 'kg', '6', NULL, 42000, NULL),
(NULL, 'Xà lách Corôn', 'kg', '6', NULL, 18000, NULL),
(NULL, 'Xà lách Ice berg', 'kg', '6', NULL, 30000, NULL),
(NULL, 'Xà lách Radichio', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Xà lách lolo tím', 'kg', '6', NULL, 52500, NULL),
(NULL, 'Xà lách lolo xanh', 'kg', '6', NULL, 36000, NULL),
(NULL, 'Xà lách Romaine', 'kg', '6', NULL, 37500, NULL),
(NULL, 'Củ dền', 'kg', '6', NULL, 18000, NULL),
(NULL, 'Chanh dây', 'kg', '6', NULL, 33000, NULL),
(NULL, 'Chanh không hạt', 'kg', '6', NULL, 45000, NULL),
(NULL, 'Xà lách Frisé big', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Bí hồ lô', 'kg', '6', NULL, 22500, NULL),
(NULL, 'Khoai lang Nhật', 'kg', '6', NULL, 37500, NULL),
(NULL, 'Khoai môn sáp vàng', 'kg', '6', NULL, 33000, NULL),
(NULL, 'Bí đao', 'kg', '6', NULL, 19500, NULL),
(NULL, 'Khoai tây trung da hồng', 'kg', '6', NULL, 22500, NULL),
(NULL, 'Ngò tây (Parsley)', 'kg', '6', NULL, 75000, NULL),
(NULL, 'Su hào', 'kg', '6', NULL, 22000, NULL),
(NULL, 'Nha đam', 'kg', '6', NULL, 22500, NULL),
(NULL, 'Dưa leo baby', 'kg', '6', NULL, 32000, NULL),
(NULL, 'ớt xiêm (ớt hiểm)', 'kg', '6', NULL, 67500, NULL),
(NULL, 'ớt sừng', 'kg', '6', NULL, 52500, NULL),
(NULL, 'Bố xôi', 'kg', '6', NULL, 27000, NULL),
(NULL, 'Cải rocket', 'kg', '6', NULL, 24000, NULL),
(NULL, 'Parô hành làm sạch', 'kg', '6', NULL, 27000, NULL),
(NULL, 'Hồng giòn', '', '6', NULL, 0, NULL),
(NULL, 'Cà chua bi giống ngọt', '', '6', NULL, 0, NULL),
(NULL, 'Đậu giống nhật', '', '6', NULL, 0, NULL),
(NULL, 'Dâu tây Nhật', '', '6', NULL, 0, NULL),
(NULL, 'Bồ ngót', 'kg', '6', NULL, 22000, NULL),
(NULL, 'Cải ngọt', 'kg', '6', NULL, 19000, NULL),
(NULL, 'Cải xanh', 'kg', '6', NULL, 19000, NULL),
(NULL, 'Rau muống', 'kg', '6', NULL, 16000, NULL),
(NULL, 'Ngò', 'kg', '6', NULL, 0, NULL),
(NULL, 'Hành lá', 'kg', '6', NULL, 45000, NULL),
(NULL, 'Đậu Hà lan', 'kg', '6', NULL, 0, NULL),
(NULL, 'Các loại cà', 'kg', '6', NULL, 0, NULL),
(NULL, 'Đậu bắp', 'kg', '6', NULL, 20000, NULL),
(NULL, 'Dưa leo', 'kg', '6', NULL, 0, NULL),
(NULL, 'Rau dền', 'kg', '6', NULL, 17000, NULL),
(NULL, 'Rau răm, thơm,…', 'kg', '6', NULL, 0, NULL),
(NULL, 'Bầu', 'kg', '6', NULL, 11000, NULL),
(NULL, 'Bí Đao', 'kg', '6', NULL, 0, NULL),
(NULL, 'Bí Đỏ', 'kg', '6', NULL, 0, NULL),
(NULL, 'Mướp', 'kg', '6', NULL, 0, NULL),
(NULL, 'Rau tập tàn', 'kg', '6', NULL, 0, NULL),
(NULL, 'Rau má', 'kg', '6', NULL, 0, NULL),
(NULL, 'Mồng tơi', 'kg', '6', NULL, 19000, NULL),
(NULL, 'Mứt sung - 250g', 'Lọ', '6', NULL, 230000, NULL),
(NULL, 'Mứt cherry - 250g', 'Lọ ', '6', NULL, 230000, NULL),
(NULL, 'Mứt dâu đen - 250g', 'Lọ', '6', NULL, 230000, NULL),
(NULL, 'Đậu đen xanh lòng - 500g', 'Gói', '6', NULL, 86000, NULL),
(NULL, 'Đậu đỏ - 500g', 'Gói', '6', NULL, 86000, NULL),
(NULL, 'Đậu nành đen - 500g', 'Gói', '6', NULL, 89000, NULL),
(NULL, 'Đậu nành vàng - 500g', 'Gói', '6', NULL, 86000, NULL),
(NULL, 'Đậu nành xanh - 500g', 'Gói', '6', NULL, 86000, NULL),
(NULL, 'Đậu phộng (lạc) - 250g', 'Gói', '6', NULL, 65000, NULL),
(NULL, 'Hạt chia -250g', 'Lọ', '6', NULL, 234000, NULL),
(NULL, 'Bánh quy chia - 150g', 'Hộp ', '6', NULL, 69000, NULL),
(NULL, 'Bột đậu nành đen - 500g', 'Hộp ', '6', NULL, 150000, NULL),
(NULL, 'Hạt hương dương tách vỏ- 250g', 'Gói', '6', NULL, 69000, NULL),
(NULL, 'Hạt kê - 500g', 'Gói', '6', NULL, 86000, NULL),
(NULL, 'Yến mạch -750g', 'Gói', '6', NULL, 115000, NULL),
(NULL, 'Yến mạch cán mỏng - 500g', 'Gói', '6', NULL, 81000, NULL),
(NULL, 'Trà cao bồ - 100g', 'Túi', '6', NULL, 97000, NULL),
(NULL, 'Dấm thốt nốt- 375ml', 'Chai', '6', NULL, 179000, NULL),
(NULL, 'Đường thốt nốt - 500g', 'Gói', '6', NULL, 110000, NULL),
(NULL, 'Mè đen Organic- 200g', 'Gói', '6', NULL, 105000, NULL),
(NULL, 'Mè nâu Organic - 200g', 'Gói', '6', NULL, 85000, NULL),
(NULL, 'Bột cà ri 100g', 'Lọ', '6', NULL, 76500, NULL),
(NULL, 'Bột gừng 100g', 'Lọ', '6', NULL, 56000, NULL),
(NULL, 'Bột ớt  100g', 'Lọ', '6', NULL, 76500, NULL),
(NULL, 'Bột quế 100g', 'Lọ', '6', NULL, 76500, NULL),
(NULL, 'Bột nghệ 50g', 'Lọ', '6', NULL, 43500, NULL),
(NULL, 'Quinoa nguyên hạt 500g', 'Gói', '6', NULL, 382000, NULL),
(NULL, 'Siro cây phong 250ml', 'Chai', '6', NULL, 385000, NULL),
(NULL, 'Mơ sấy 250g', 'Gói', '6', NULL, 145000, NULL),
(NULL, 'Nho khô 200g', 'Gói', '6', NULL, 85000, NULL),
(NULL, 'Nam việt quất 100g', 'Gói', '6', NULL, 147000, NULL),
(NULL, 'Nước ép Táo 750ml', 'Chai ', '6', NULL, 127000, NULL),
(NULL, 'Nước ép lựu + nho 750ml', 'Chai', '6', NULL, 183000, NULL),
(NULL, 'Nước ép nho + Việt quất 750ml', 'Chai ', '6', NULL, 164000, NULL),
(NULL, 'Nước ép Cherry  750ml', 'Chai', '6', NULL, 183000, NULL),
(NULL, 'Smoothie chuối + Việt quất +acai 240ml', 'Chai', '6', NULL, 92000, NULL),
(NULL, 'Sinh tố Nho đỏ và lưu 240ml', 'Chai', '6', NULL, 92000, NULL),
(NULL, 'Sinh tố Táo Xoài Sơri  240ml', 'Chai', '6', NULL, 92000, NULL),
(NULL, 'Sữa gạo 1L', 'Hộp ', '6', NULL, 92000, NULL),
(NULL, 'Sữa gạo 200ml', 'Hộp ', '6', NULL, 35000, NULL),
(NULL, 'Sữa yến mạch chocolate 1L', 'Hộp ', '6', NULL, 108000, NULL),
(NULL, 'Sữa yến mạch chocolate 200ml', 'Hộp ', '6', NULL, 33000, NULL),
(NULL, 'Sữa hạnh nhân 1L', 'Hộp ', '6', NULL, 105000, NULL),
(NULL, 'Sữa hạnh nhân 200ml', 'Hộp ', '6', NULL, 40000, NULL),
(NULL, 'Sữa mè 1L', 'Hộp ', '6', NULL, 105000, NULL),
(NULL, 'Sữa Quinoa 1L', 'Hộp ', '6', NULL, 105000, NULL),
(NULL, 'Sữa hạt phỉ 1L', 'Hộp ', '6', NULL, 119000, NULL),
(NULL, 'Dầu gội nha đam organic', 'Chai', '6', NULL, 199000, NULL),
(NULL, 'Sữa tắm nha đam organic', 'Chai', '6', NULL, 199000, NULL),
(NULL, 'Bánh chuối đậu phộng', 'Thanh', '6', NULL, 11000, NULL),
(NULL, 'Bánh chuối thập cẩm', 'Thanh', '6', NULL, 11000, NULL),
(NULL, 'Chuối sấy hữu cơ', 'Hộp ', '6', NULL, 32000, NULL),
(NULL, 'THỰC PHẨM TƯƠI', '', '6', NULL, 0, NULL),
(NULL, 'Bắp cải', 'kg', '6', NULL, 65000, NULL),
(NULL, 'Cà chua bi Cherry', 'kg', '6', NULL, 110000, NULL),
(NULL, 'Cà chua cocktail', 'Kg', '6', NULL, 110000, NULL),
(NULL, 'Cà chua giống Hà Lan', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Cà rốt baby', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Củ cà rốt', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Đậu que Nhật ', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Đậu rồng (Kg)', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Dưa leo', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Hành baro', 'kg', '6', NULL, 120000, NULL),
(NULL, 'Hành lá', 'kg', '6', NULL, 120000, NULL),
(NULL, 'Húng nhũi (kg)', 'kg', '6', NULL, 195000, NULL),
(NULL, 'Kinh giới (kg)', 'Kg', '6', NULL, 195000, NULL),
(NULL, 'Mướp đắng (khổ qua)', 'kg', '6', NULL, 60000, NULL),
(NULL, 'Mướp hương', 'kg', '6', NULL, 55000, NULL),
(NULL, 'Nấm mỡ trắng', 'kg', '6', NULL, 210000, NULL),
(NULL, 'Nấm Mộc nhĩ ', 'kg', '6', NULL, 370000, NULL),
(NULL, 'Ngô ngọt (Bắp Nhật)', 'kg', '6', NULL, 70000, NULL),
(NULL, 'Ngọn bí đỏ (Kg)', 'kg', '6', NULL, 65000, NULL),
(NULL, 'Quả chuối xiêm', 'kg', '6', NULL, 40000, NULL),
(NULL, 'Rau cải bẹ xanh (kg)', 'kg', '6', NULL, 55000, NULL),
(NULL, 'Rau cải ngồng (kg)', 'Kg', '6', NULL, 55000, NULL),
(NULL, 'Rau cải ngọt (kg)', 'kg', '6', NULL, 55000, NULL),
(NULL, 'Rau Cải thìa (kg)', 'kg', '6', NULL, 55000, NULL),
(NULL, 'Rau cần tây', 'Kg', '6', NULL, 95000, NULL),
(NULL, 'Rau đay (Kg)', 'Kg', '6', NULL, 55000, NULL),
(NULL, 'Rau dền (Kg)', 'Kg', '6', NULL, 55000, NULL),
(NULL, 'Rau lang', 'Kg', '6', NULL, 65000, NULL),
(NULL, 'Rau Mồng tơi (kg)', 'kg', '6', NULL, 55000, NULL),
(NULL, 'Rau mùi (ngò rí)', 'Kg', '6', NULL, 195000, NULL),
(NULL, 'Rau muống', 'Kg', '6', NULL, 55000, NULL),
(NULL, 'Rau ngót ', 'Kg', '6', NULL, 75000, NULL),
(NULL, 'Rau xà lách Iceberg', 'kg', '6', NULL, 75000, NULL),
(NULL, 'Rau bó xôi', 'kg', '6', NULL, 78000, NULL),
(NULL, 'Cam lớn', 'kg', '6', NULL, 27000, NULL),
(NULL, 'Cam nhỏ', 'kg', '6', NULL, 22000, NULL),
(NULL, 'Quýt ', 'kg', '6', NULL, 24000, NULL),
(NULL, 'Trà xanh', 'kg', '6', NULL, 21000, NULL),
(NULL, 'Cà pháo', 'kg', '6', NULL, 14000, NULL),
(NULL, 'Bưởi', 'kg', '6', NULL, 25000, NULL),
(NULL, 'Rong nho biển Nha Trang', 'kg', '6', NULL, 350000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

DROP TABLE IF EXISTS `product_type`;
CREATE TABLE IF NOT EXISTS `product_type` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) DEFAULT NULL,
  `IsVegetarian` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`ID`, `Name`, `IsVegetarian`) VALUES
('0000001', 'rau cu', NULL),
('0000002', 'trai cay', NULL),
('0000003', 'thuc pham chuc nang', NULL),
('0000004', 'Gao', NULL),
('0000005', 'My Pham', NULL),
('0000006', 'khac', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `provider`
--

DROP TABLE IF EXISTS `provider`;
CREATE TABLE IF NOT EXISTS `provider` (
  `Name` varchar(50) DEFAULT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  `Address` varchar(150) DEFAULT NULL,
  `Phone_Number` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Website` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider`
--

INSERT INTO `provider` (`Name`, `ID`, `Address`, `Phone_Number`, `Email`, `Website`) VALUES
('Quy Nguyen', '0000001', 'Phu Nhuan, HCM', '09090010101', 'qn@gmail.com', 'quynguyen@gmail.com'),
('Hoa sua', '0000002', '5, HCM', '09090010102', 'hs@gmail.com', 'hoasua.com'),
('Ritarice', '0000003', '1, HCM', '09090010103', 'rtr@gmail.com', 'ritarice.com'),
('Dat lat', '0000004', 'Da lat, Lam Dong', '09090010104', 'dl@gmail.com', 'dalat.com'),
('Vietgap', '0000005', 'Phu Nhuan, HCM', '09090010105', 'vg@gmail.com', 'vietgap.com'),
('Oganica', '0000006', 'Phu Nhuan, HCM', '09090010106', 'ognc@gmail.com', 'oganica.com'),
('Hoai An', '0000007', 'Ha Noi', '09090010107', 'ha@gmail.com', 'ha.com'),
('Khac', '0000008', 'Nha Trang', '09090010108', '', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `provider product`
--

DROP TABLE IF EXISTS `provider product`;
CREATE TABLE IF NOT EXISTS `provider product` (
  `Name` varchar(50) DEFAULT NULL,
  `ProductID` int NOT NULL,
  `ProviderID` int NOT NULL,
  PRIMARY KEY (`ProductID`,`ProviderID`),
  KEY `FK_Provider Product_Provider` (`ProviderID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `provider product`
--

-- INSERT INTO `provider product` (`Name`, `ProductID`, `ProviderID`) VALUES
-- ('Chojyo Kansa miso', '0000001', '0000001'),
-- ('Chojyo Miso( dam)', '0000002', '0000001'),
-- ('dau dua duong toc Lifecoco (180ml)', '0000003', '0000001'),
-- ('dau dua duong da Lifecoco (180ml)', '0000004', '0000001'),
-- ('banh duong sinh', '0000005', '0000001'),
-- ('gao mam den huu co', '0000006', '0000002'),
-- ('gao cao cap nang mai', '0000007', '0000003'),
-- ('rau den', '0000008', '0000004'),
-- ('rau muong', '0000009', '0000005'),
-- ('cam lon', '0000010', '0000006'),
-- ('rong bien nha trang', '0000011', '0000007');

-- --------------------------------------------------------

--
-- Table structure for table `receipt`
--

DROP TABLE IF EXISTS `receipt`;
CREATE TABLE IF NOT EXISTS `receipt` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Time` datetime(6) DEFAULT NULL,
  `Price_Sum` double DEFAULT NULL,
  `Receipt_Type` int(11) DEFAULT NULL,
  `Tax` double DEFAULT NULL,
  `EmployeeID` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Receipt_Employee` (`EmployeeID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sysdiagrams`
--

DROP TABLE IF EXISTS `sysdiagrams`;
CREATE TABLE IF NOT EXISTS `sysdiagrams` (
  `name` varchar(160) NOT NULL,
  `principal_id` int(11) NOT NULL,
  `diagram_id` int(11) NOT NULL AUTO_INCREMENT,
  `version` int(11) DEFAULT NULL,
  `definition` longblob,
  PRIMARY KEY (`diagram_id`),
  UNIQUE KEY `UK_principal_name` (`principal_id`,`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Table structure for table `trademark`
--

DROP TABLE IF EXISTS `trademark`;
CREATE TABLE IF NOT EXISTS `trademark` (
  `Name` varchar(50) DEFAULT NULL,
  `Nation` varchar(50) DEFAULT NULL,
  `ID` int NOT NULL AUTO_INCREMENT,
  `Phone_Number` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Website` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trademark`
--

INSERT INTO `trademark` (`Name`, `Nation`, `ID`, `Phone_Number`, `Email`, `Website`) VALUES
('Lifecoco', 'Vietnam', '0000001', '0129309102', 'Lifecoco@gmail.com', 'Lifecoco.com'),
('Ong Thay Tue Hai', 'Vietnam', '0000002', '0129309103', 'otth@gmail.com', 'ongthaytuehai.com'),
('HoaSuaFoods', 'Vietnam', '0000003', '0129309104', 'hsf@gmail.com', 'hoasuafood.com'),
('Ritarice', 'Vietnam', '0000004', '0129309105', 'rtr@gmail.com', 'ritarice.com'),
('Vietgap', 'Vietnam', '0000005', '0129309106', 'vg@gmail.com', 'vietgap.com'),
('Oganica', 'Vietnam', '0000006', '0129309107', 'ognc@gmail.com', 'oganica.com');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `debts`
--
ALTER TABLE `debts`
  ADD CONSTRAINT `FK_Debts_Receipt` FOREIGN KEY (`RecieptID`) REFERENCES `receipt` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `input product`
--
ALTER TABLE `input product`
  ADD CONSTRAINT `FK_Input Product_Input Product Receipt` FOREIGN KEY (`ReceiptID`) REFERENCES `input product receipt` (`ReceiptID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Input Product_Provider Product` FOREIGN KEY (`ProductID`, `ProviderID`) REFERENCES `provider product` (`ProductID`, `ProviderID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `input product receipt`
--
ALTER TABLE `input product receipt`
  ADD CONSTRAINT `FK_Receipt_Input ProductReceipt` FOREIGN KEY (`ReceiptID`) REFERENCES `receipt` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `output product`
--
ALTER TABLE `output product`
  ADD CONSTRAINT `FK_Output Product_Product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Output Product_Output Product Receipt` FOREIGN KEY (`ReceiptID`) REFERENCES `output product receipt` (`ReceiptID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `output product receipt`
--
ALTER TABLE `output product receipt`
  ADD CONSTRAINT `FK_Output Product Receipt_Customer` FOREIGN KEY (`CustomerID`) REFERENCES `customer` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Output Product Receipt_Receipt` FOREIGN KEY (`ReceiptID`) REFERENCES `receipt` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_Product_Product_Type` FOREIGN KEY (`Product_TypeID`) REFERENCES `product_type` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Product_Trademark` FOREIGN KEY (`TrademarkID`) REFERENCES `trademark` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `provider product`
--
-- ALTER TABLE `provider product`
--   ADD CONSTRAINT `FK_Provider Product_Product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
--   ADD CONSTRAINT `FK_Provider Product_Provider` FOREIGN KEY (`ProviderID`) REFERENCES `provider` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
-- 
--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `FK_Receipt_Employee` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  
  
ALTER TABLE `user`
  ADD CONSTRAINT `FK_User_Employee` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

DELIMITER $$
DROP PROCEDURE IF EXISTS get_list_of_product_info$$

CREATE PROCEDURE get_list_of_product_info()
BEGIN
  SELECT Name, Unit AS 'UnitName', Price, ID AS 'Id', Product_ID AS 'ProductId', Bought FROM tam_an.product WHERE Price != 0;
END $$

DELIMITER $$
DROP PROCEDURE IF EXISTS get_list_of_product_info_with_query$$

CREATE PROCEDURE get_list_of_product_info_with_query(pname varchar(100) CHARSET utf8)
BEGIN
  SELECT Name, Unit AS 'UnitName', Price, ID AS 'Id', Product_ID AS 'ProductId', Bought FROM tam_an.product WHERE Price != 0 AND Name LIKE CONCAT('%', pname, '%') ;
END $$

DELIMITER $$
DROP PROCEDURE IF EXISTS check_user_login$$

CREATE PROCEDURE check_user_login( uname varchar(50), pass  varchar(100))
BEGIN
  SELECT ID AS 'Id', Name FROM tam_an.user WHERE Username LIKE uname AND Password LIKE pass;
END $$


DELIMITER $$
DROP FUNCTION IF EXISTS insert_receipt_to_database$$

CREATE FUNCTION insert_receipt_to_database( id int, quantity  float)
RETURNS INT
BEGIN
  -- TODO
  RETURN 0;
END $$


DELIMITER ;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


