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
CREATE DATABASE IF NOT EXISTS `Tam_An` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
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
  `Price` double DEFAULT NULL,
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

INSERT INTO `provider product` (`Name`, `ProductID`, `ProviderID`) VALUES
('Chojyo Kansa miso', '0000001', '0000001'),
('Chojyo Miso( dam)', '0000002', '0000001'),
('dau dua duong toc Lifecoco (180ml)', '0000003', '0000001'),
('dau dua duong da Lifecoco (180ml)', '0000004', '0000001'),
('banh duong sinh', '0000005', '0000001'),
('gao mam den huu co', '0000006', '0000002'),
('gao cao cap nang mai', '0000007', '0000003'),
('rau den', '0000008', '0000004'),
('rau muong', '0000009', '0000005'),
('cam lon', '0000010', '0000006'),
('rong bien nha trang', '0000011', '0000007');

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

--
-- Dumping data for table `sysdiagrams`
--

INSERT INTO `sysdiagrams` (`name`, `principal_id`, `diagram_id`, `version`, `definition`) VALUES
('Diagram_0', 1, 1, 1, 0xd0cf11e0a1b11ae1000000000000000000000000000000003e000300feff0900060000000000000000000000010000000100000000000000001000000200000001000000feffffff0000000000000000fffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffdffffff21000000feffffff040000000500000006000000070000000800000009000000340000000b0000000c0000000d0000000e0000000f000000100000001100000012000000130000001400000015000000160000001700000018000000190000001a0000001b0000001c0000001d0000001e0000001f00000020000000fefffffffeffffff230000002400000025000000260000002700000028000000290000002a0000002b0000002c0000002d0000002e0000002f00000030000000310000003200000033000000feffffff3500000036000000feffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff52006f006f007400200045006e00740072007900000000000000000000000000000000000000000000000000000000000000000000000000000000000000000016000500ffffffffffffffff02000000000000000000000000000000000000000000000000000000000000004082678e9129d1010300000040120000000000006600000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000004000201ffffffffffffffffffffffff00000000000000000000000000000000000000000000000000000000000000000000000000000000be0c0000000000006f000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000040002010100000004000000ffffffff0000000000000000000000000000000000000000000000000000000000000000000000000a000000952c000000000000010043006f006d0070004f0062006a0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000012000201ffffffffffffffffffffffff000000000000000000000000000000000000000000000000000000000000000000000000330000005f000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a0000000b0000000c0000000d0000000e0000000f000000100000001100000012000000130000001400000015000000160000001700000018000000190000001a0000001b0000001c0000001d0000001e0000001f000000200000002100000022000000230000002400000025000000260000002700000028000000290000002a0000002b0000002c0000002d0000002e0000002f000000300000003100000032000000feffffff34000000fefffffffeffffff3700000038000000390000003a0000003b0000003c0000003d0000003e0000003f0000004000000041000000420000004300000044000000450000004600000047000000fefffffffeffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffffff000428000a0e100c05000080270000000f00ffff27000000007d0000d27800008e4800005fa800005ec20000de805b10f195d011b0a000aa00bdcb5c0000080030000000000200000300000038002b00000009000000d9e6b0e91c81d011ad5100a0c90f5739f43b7f847f61c74385352986e1d552f8a0327db2d86295428d98273c25a2da2d00002c0043200000000000000000000053444dd2011fd1118e63006097d2df4834c9d2777977d811907000065b840d9c00002c0043200000000000000000000051444dd2011fd1118e63006097d2df4834c9d2777977d811907000065b840d9c27000000d00b000000a7010000003000a50900000700008001000000a202000000800000080000805363684772696400d020000070170000437573746f6d657200003000a509000007000080020000009c02000000800000050000805363684772696400da610000100e0000446562747369640000003000a50900000700008003000000a2020000008000000800008053636847726964000e6a0000fa320000456d706c6f79656500003800a50900000700008004000000ac020000008000000d00008053636847726964009c180000fa320000496e7075742050726f6475637408000000004000a50900000700008005000000bc02000000800000150000805363684772696400d6380000aa370000496e7075742050726f64756374205265636569707474070000009400a50900000700008006000000520000000180000069000080436f6e74726f6c00b12e0000593b000052656c6174696f6e736869702027464b5f496e7075742050726f647563745f496e7075742050726f64756374205265636569707427206265747765656e2027496e7075742050726f6475637420526563656970742720616e642027496e7075742050726f647563742700000000002800b50100000700008007000000310000007f00000002800000436f6e74726f6c002c2900009f3d000000003800a50900000700008008000000ae020000008000000e000080536368477269640000000000000000004f75747075742050726f64756374000000004000a50900000700008009000000be02000000800000160000805363684772696400d0200000840300004f75747075742050726f647563742052656365697074000000008c00a5090000070000800a000000520000000180000061000080436f6e74726f6c00f12a00003a0b000052656c6174696f6e736869702027464b5f4f75747075742050726f6475637420526563656970745f437573746f6d657227206265747765656e2027437573746f6d65722720616e6420274f75747075742050726f6475637420526563656970742700740000002800b5010000070000800b000000310000007700000002800000436f6e74726f6cff372d0000ed10000000009800a5090000070000800c00000052000000018000006d000080436f6e74726f6c00151600003307000052656c6174696f6e736869702027464b5f4f75747075742050726f6475637420526563656970745f4f75747075742050726f6475637427206265747765656e20274f75747075742050726f647563742720616e6420274f75747075742050726f6475637420526563656970742700000000002800b5010000070000800d000000310000008300000002800000436f6e74726f6c650f0f00007909000000003000a5090000070000800e000000a002000000800000070000805363684772696400bc340000286e000050726f647563740000007800a5090000070000800f00000062000000018000004f000080436f6e74726f6c003d0a0000270f000052656c6174696f6e736869702027464b5f4f75747075742050726f647563745f50726f6475637427206265747765656e202750726f647563742720616e6420274f75747075742050726f64756374270000002800b50100000700008010000000310000006500000002800000436f6e74726f6c00d4fbffff6a5d000000003400a50900000700008011000000aa020000008000000c0000805363684772696400bc340000628e000050726f647563745f5479706500007400a5090000070000801200000052000000018000004b000080436f6e74726f6cffdd3e00004582000052656c6174696f6e736869702027464b5f50726f647563745f50726f647563745f5479706527206265747765656e202750726f647563745f547970652720616e64202750726f64756374277500002800b50100000700008013000000310000006100000002800000436f6e74726f6c005a3100001a89000000003000a50900000700008014000000a2020000008000000800008053636847726964723e4900004650000050726f766964657200003800a50900000700008015000000b202000000800000100000805363684772696400042900006054000050726f76696465722050726f6475637400008800a5090000070000801600000062000000018000005f000080436f6e74726f6c00d92200009c44000052656c6174696f6e736869702027464b5f496e7075742050726f647563745f50726f76696465722050726f6475637427206265747765656e202750726f76696465722050726f647563742720616e642027496e7075742050726f64756374270000002800b50100000700008017000000310000007500000002800000436f6e74726f6c00d01a00008849000000007c00a50900000700008018000000620000000180000053000080436f6e74726f6c6541330000915e000052656c6174696f6e736869702027464b5f50726f76696465722050726f647563745f50726f6475637427206265747765656e202750726f647563742720616e64202750726f76696465722050726f64756374270000002800b50100000700008019000000310000006900000002800000436f6e74726f6c655e4100000665000000008000a5090000070000801a000000520000000180000055000080436f6e74726f6c72193f00003b59000052656c6174696f6e736869702027464b5f50726f76696465722050726f647563745f50726f766964657227206265747765656e202750726f76696465722720616e64202750726f76696465722050726f647563742700000000002800b5010000070000801b000000310000006b00000002800000436f6e74726f6c00163d0000cb58000000003000a5090000070000801c000000a0020000008000000700008053636847726964000a4100008c0a0000526563656970740000006800a5090000070000801d00000052000000018000003d000080436f6e74726f6c001f570000eb12000052656c6174696f6e736869702027464b5f44656274735f5265636569707427206265747765656e2027526563656970742720616e64202744656274732762886f00002800b5010000070000801e000000310000005300000002800000436f6e74726f6c001c5800003115000000006c00a5090000070000801f000000620000000180000043000080436f6e74726f6c00dd4b00002e1c000052656c6174696f6e736869702027464b5f526563656970745f456d706c6f79656527206265747765656e2027456d706c6f7965652720616e64202752656365697074270000002800b50100000700008020000000310000005900000002800000436f6e74726f6c65a45a0000852e000000008400a5090000070000802100000062000000018000005c000080436f6e74726f6c0062430000321c000052656c6174696f6e736869702027464b5f526563656970745f496e7075742050726f647563745265636569707427206265747765656e2027526563656970742720616e642027496e7075742050726f6475637420526563656970742700002800b50100000700008022000000310000007100000002800000436f6e74726f6c65e7370000852e000000008800a5090000070000802300000062000000018000005f000080436f6e74726f6c00e53600009e07000052656c6174696f6e736869702027464b5f4f75747075742050726f6475637420526563656970745f5265636569707427206265747765656e2027526563656970742720616e6420274f75747075742050726f647563742052656365697074270000002800b50100000700008024000000310000007500000002800000436f6e74726f6c72e9390000f00c000000003400a50900000700008025000000a4020000008000000900008053636847726964728c550000546f000054726164656d61726b6f647500007000a50900000700008026000000520000000180000045000080436f6e74726f6c72d14a0000b377000052656c6174696f6e736869702027464b5f50726f647563745f54726164656d61726b27206265747765656e202754726164656d61726b2720616e64202750726f647563742700000000002800b50100000700008027000000310000005b00000002800000436f6e74726f6c00c04a00004377000000000100feff030a0000ffffffff00000000000000000000000000000000170000004d6963726f736f66742044445320466f726d20322e300010000000456d626564646564204f626a6563740000000000f439b271000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000010003000000000000000c0000000b0000004e61bc00000000000000000000000000000000000000000000000000000000000000000000000000000000000000dbe6b0e91c81d011ad5100a0c90f5739000002005038658e9129d101020200001048450000000000000000000000000000000000600100004400610074006100200053006f0075007200630065003d002e003b0049006e0069007400690061006c00200043006100740061006c006f0067003d00540061006d005f0041006e00214334120800000041170000e211000078563412070000001401000043007500730074006f006d006500720000005100d9f4ce11ffff610001f5ce11ffff2e0029f5ce11ffff690051f5ce11ffff5600b195d611ffff6900d995d611ffff32000196d611ffff30002996d611ffff2c00f0877c0f48d3e8640010e8647c0100063f5fea64bea6eb6405000000f0877c0f07467c2c50007500f0877c0f54d3e8640010e8647d010006355fea64caa0eb6406000000f0877c0f133d91aa61003100f0877c0f60d3e8640010e8647e010006ed66ea64b2aaeb6407000000f0877c0f52dfcbc100000000f0877c0f6cd3e8640010e8647f010006fc66ea64b2aaeb6407000000f0877c0f6422000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a729000039160000000000002d010000070000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc07000046050000000000000100000041170000e211000000000000050000000500000002000000020000001c010000e60a00000000000001000000f21300004e06000000000000010000000100000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000005a00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000900000043007500730074006f006d00650072000000214334120800000041170000ec0c000078563412070000001401000044006500620074007300000060b93a0f0700000058ecd6110000000058ecd61160b83a0f04000000000000000300000000000000000000000001000000010000000000009c87f166a4effd669c293c679c87f166a4effd669c293c674cecfd6658ecfd6658ecfd6664ecfd6664ecfd6690ecfd6690ecfd669cecfd669cecfd66a8ecfd66a8ecfd66d4ecfd66d4ecfd66e0ecfd66e0ecfd66ececfd66ececfd6604edfd6604edfd6610edfd6610edfd661cedfd661cedfd6648edfd6648edfd6654edfd6654edfd6660edfd6660edfd666cedfd666cedfd6678edfd6678edfd6684edfd6684edfd66b0edfd66b0ed000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a729000039160000000000002d010000070000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc07000046050000000000000100000041170000ec0c000000000000030000000300000002000000020000001c010000e60a00000000000001000000f21300004e06000000000000010000000100000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000005400000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f000000060000004400650062007400730000002143341208000000411700005319000078563412070000001401000045006d0070006c006f0079006500650000000000000000000000000000000000000000000000000000000000000000000c9407300c940730e0940730e0940730f0940730f0940730f8940730f894073008950730089507301895073018950730289507302895073030950730309507303895073038950730409507304095073048950730489507305895073058950730c0930730c09307305095073050950730d0930730d0930730e4930730e4930730f8930730f8930730149407301494073020940730209407302c9407302c9407303894073038940730449407304494073050940730509407305c9407305c94000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a72900000b1d0000000000002d0100000a0000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc070000460500000000000001000000411700005319000000000000080000000800000002000000020000001c010000e60a00000000000001000000f21300004e06000000000000010000000100000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000005a00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000900000045006d0070006c006f0079006500650000002143341208000000411700005d14000078563412070000001401000049006e007000750074002000500072006f006400750063007400000078b1fc6604b2fc6604b2fc669083f1669083f166f899f166f899f166e4b1fc66e4b1fc6614b2fc6614b2fc66bcb1fc66bcb1fc66dcb1fc66dcb1fc66809af166809af16670b1fc6670b1fc660cb2fc660cb2fc6640b1fc6640b1fc664cb1fc664cb1fc6658b1fc6658b1fc6664b1fc6664b1fc6680b1fc6680b1fc668cb1fc668cb1fc6698b1fc6698b1fc66a4b1fc66a4b1fc66b0b1fc66b0b1fc66c4b1fc66c4b1fc66d0b1fc66d0b1fc66ecb1fc66ecb1fc66f8b1fc66f8b1fc661cb2fc661cb2fc6628b2fc6628b2fc6634b2fc6634b2000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a72900007f180000000000002d010000080000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc070000460500000000000001000000411700005d14000000000000060000000600000002000000020000001c010000e60a00000000000001000000f2130000da0a000000000000030000000300000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000006400000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000e00000049006e007000750074002000500072006f0064007500630074000000214334120800000041170000710a000078563412070000001401000049006e007000750074002000500072006f0064007500630074002000520065006300650069007000740000000c00000000000000000000000001000000010000000000004c86f1669c87f166e486f1662c86fe668406d2122831fd661c86fe662c86fe668c9ffe66989ffe669c87f166a086f16690ecfd669cecfd669cecfd66a8ecfd66a8ecfd66d4ecfd66d4ecfd66e0ecfd66e0ecfd66ececfd66ececfd6604edfd6604edfd6610edfd6610edfd661cedfd661cedfd6648edfd6648edfd6654edfd6654edfd6660edfd6660edfd666cedfd666cedfd6678edfd6678edfd6684edfd6684edfd66b0edfd66b0ed000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a729000039160000000000002d010000070000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc07000046050000000000000100000041170000710a000000000000020000000200000002000000020000001c010000e60a00000000000001000000f21300004e06000000000000010000000100000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000007400000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000001600000049006e007000750074002000500072006f00640075006300740020005200650063006500690070007400000002000b00d6380000f03c0000dd2f0000f03c00000000000002000000f0f0f000000000000000000000000000000000000100000007000000000000002c2900009f3d0000f71500005801000031000000010000020000f715000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61260046004b005f0049006e007000750074002000500072006f0064007500630074005f0049006e007000750074002000500072006f00640075006300740020005200650063006500690070007400214334120800000041170000e21100007856341207000000140100004f00750074007000750074002000500072006f0064007500630074000000e21150b83a0f08000000000000000a00000000000000000000000001000000010000000000004c86f1669c87f166e486f1662c86fe66e8d9f6162831fd660c86fe662c86fe669c87f166a086f16664ecfd6690ecfd6690ecfd669cecfd669cecfd66a8ecfd66a8ecfd66d4ecfd66d4ecfd66e0ecfd66e0ecfd66ececfd66ececfd6604edfd6604edfd6610edfd6610edfd661cedfd661cedfd6648edfd6648edfd6654edfd6654edfd6660edfd6660edfd666cedfd666cedfd6678edfd6678edfd6684edfd6684edfd66b0edfd66b0ed000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a729000039160000000000002d010000070000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc07000046050000000000000100000041170000e211000000000000050000000500000002000000020000001c010000e60a00000000000001000000f21300009408000000000000020000000200000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000006600000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000f0000004f00750074007000750074002000500072006f0064007500630074000000214334120800000041170000710a00007856341207000000140100004f00750074007000750074002000500072006f006400750063007400200052006500630065006900700074000000000000000000000000000001000000010000000000009c87f166a4effd669c293c670c000000e8ffffff50000000520100000a0000000300000005000000f0ffffffe8ffffff0e0000005201000002000000080000000500000018000000e8ffffff0e0000005201000004000000030000000500000010000000e8ffffff1d00000052010000070000000300000005000000c8ffffffe8ffffff60f89165092b0022d9e52300c0003e00d005630f80f891658cf891658cf8916598f8916598f8000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a729000039160000000000002d010000070000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc07000046050000000000000100000041170000710a000000000000020000000200000002000000020000001c010000e60a00000000000001000000f21300009408000000000000020000000200000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000007600000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f000000170000004f00750074007000750074002000500072006f00640075006300740020005200650063006500690070007400000002000b00882c000070170000882c0000f50d00000000000002000000f0f0f00000000000000000000000000000000000010000000b00000000000000372d0000ed1000009d14000058010000400000000100000200009d14000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61220046004b005f004f00750074007000750074002000500072006f006400750063007400200052006500630065006900700074005f0043007500730074006f006d006500720002000b0041170000ca080000d0200000ca0800000200000002000000f0f0f00000000000000000000000000000000000010000000d000000000000000f0f000079090000c5170000580100003a000000010000020000c517000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61280046004b005f004f00750074007000750074002000500072006f006400750063007400200052006500630065006900700074005f004f00750074007000750074002000500072006f006400750063007400214334120800000041170000d8160000785634120700000014010000500072006f00640075006300740000000700000058ecd6110000000058ecd611c0b83a0f04000000000000000300000000000000000000000001000000010000000000009c87f166a4effd669c293c672c86fe66e8d9f6162831fd660c86fe662c86fe669c87f166a086f16664ecfd6690ecfd6690ecfd669cecfd669cecfd66a8ecfd66a8ecfd66d4ecfd66d4ecfd66e0ecfd66e0ecfd66ececfd66ececfd6604edfd6604edfd6610edfd6610edfd661cedfd661cedfd6648edfd6648edfd6654edfd6654edfd6660edfd6660edfd666cedfd666cedfd6678edfd6678edfd6684edfd6684edfd66b0edfd66b0ed000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a7290000c51a0000000000002d010000090000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc07000046050000000000000100000041170000d816000000000000070000000700000002000000020000001c010000e60a00000000000001000000f2130000da0a000000000000030000000300000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000005800000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f00000008000000500072006f006400750063007400000004000b00483f0000286e0000483f0000c1670000b80b0000c1670000b80b0000e21100000000000002000000f0f0f00000000000000000000000000000000000010000001000000000000000d4fbffff6a5d0000350f00005801000030000000010000020000350f000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61190046004b005f004f00750074007000750074002000500072006f0064007500630074005f00500072006f006400750063007400214334120800000041170000ec0c0000785634120700000014010000500072006f0064007500630074005f00540079007000650000005300650072007600650072002e004d0061006e006100670065006d0065006e0074002e005200650070006f007200740073002e005200650070006f007200740073005000610063006b006100670065002c0020004d006900630072006f0073006f00660074002e00530071006c005300650072007600650072002e004d0061006e006100670065006d0065006e0074002e005200650070006f007200740073002c002000560065007200730069006f006e003d00310032002e0030002e0030002e0030002c002000430075006c00740075007200000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a729000039160000000000002d010000070000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc07000046050000000000000100000041170000ec0c000000000000030000000300000002000000020000001c010000e60a00000000000001000000f21300004e06000000000000010000000100000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000006200000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000d000000500072006f0064007500630074005f005400790070006500000002000b0074400000628e000074400000008500000000000002000000f0f0f000000000000000000000000000000000000100000013000000000000005a3100001a8900006b0e000058010000310000000100000200006b0e000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61170046004b005f00500072006f0064007500630074005f00500072006f0064007500630074005f0054007900700065002143341208000000411700005d140000785634120700000014010000500072006f00760069006400650072000000bc7e0000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000400000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a72900007f180000000000002d010000080000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc070000460500000000000001000000411700005d14000000000000060000000600000002000000020000001c010000e60a00000000000001000000f21300004e06000000000000010000000100000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000005a00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f00000009000000500072006f00760069006400650072000000214334120800000041170000ec0c0000785634120700000014010000500072006f00760069006400650072002000500072006f0064007500630074000000650072002e006d0061006e006100670065006d0065006e0074002e00730071006c00730074007500640069006f002e006500780070006c006f007200650072000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a729000039160000000000002d010000070000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc07000046050000000000000100000041170000ec0c000000000000030000000300000002000000020000001c010000e60a00000000000001000000f21300009408000000000000020000000200000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000006a00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f00000011000000500072006f00760069006400650072002000500072006f006400750063007400000004000b00bc34000060540000bc340000d948000054240000d948000054240000574700000000000002000000f0f0f00000000000000000000000000000000000010000001700000000000000d01a00008849000026130000580100003c0000000100000200002613000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d61210046004b005f0049006e007000750074002000500072006f0064007500630074005f00500072006f00760069006400650072002000500072006f00640075006300740004000b000a410000286e00000a4100000d670000bc3400000d670000bc3400004c6100000000000002000000f0f0f000000000000000000000000000000000000100000019000000000000005e41000006650000e20f0000580100001e000000010000020000e20f000058010000020000000000050000800800008001000000150001000000900144420100065461686f6d611b0046004b005f00500072006f00760069006400650072002000500072006f0064007500630074005f00500072006f00640075006300740002000b003e490000d25a000045400000d25a00000000000002000000f0f0f00000000000000000000000000000000000010000001b00000000000000163d0000cb5800003810000058010000380000000100000200003810000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d611c0046004b005f00500072006f00760069006400650072002000500072006f0064007500630074005f00500072006f00760069006400650072002143341208000000411700005d14000078563412070000001401000052006500630065006900700074000000007300740072006100740069aa7b2b19003e00800044002c00200068007400740070003a002f002f0073006300680065006d00610073002e006d006900630072006f0073d17b2219003f00800063006f006d002f00530071006c005300650072007600650072002f004d0061006e006100670065006d0065006e0074d87b5919004000800069007300740072006100740069006f006e003a00460069006c0074006500720073002c00200068007400740070003adf7b50190041008000680065006d00610073002e006d006900630072006f0073006f00660074002e0063000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a72900007f180000000000002d010000080000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc070000460500000000000001000000411700005d14000000000000060000000600000002000000020000001c010000e60a00000000000001000000f21300009408000000000000020000000200000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000005800000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f000000080000005200650063006500690070007400000002000b004b58000082140000da610000821400000200000002000000f0f0f00000000000000000000000000000000000010000001e000000000000001c58000031150000e90900005801000034000000010000020000e909000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61100046004b005f00440065006200740073005f00520065006300650069007000740004000b00c6750000fa320000c67500008c300000584d00008c300000584d0000e91e00000000000002000000f0f0f00000000000000000000000000000000000010000002000000000000000a45a0000852e0000f10b00005801000032000000010000020000f10b000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61130046004b005f0052006500630065006900700074005f0045006d0070006c006f0079006500650004000b00964b0000e91e0000964b00008c3000008e4400008c3000008e440000aa3700000200000002000000f0f0f00000000000000000000000000000000000010000002200000000000000e7370000852e00003f120000580100003a0000000100000200003f12000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d611f0046004b005f0052006500630065006900700074005f0049006e007000750074002000500072006f006400750063007400520065006300650069007000740004000b000a410000821400003a390000821400003a390000ca08000011380000ca0800000200000002000000f0f0f00000000000000000000000000000000000010000002400000000000000e9390000f00c00007c13000058010000410000000100000200007c13000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61210046004b005f004f00750074007000750074002000500072006f006400750063007400200052006500630065006900700074005f0052006500630065006900700074002143341208000000411700005d140000785634120700000014010000540072006100640065006d00610072006b00000000000000000000000000000000000000000000000000000000000000000000001f7d901800010080c24c0000564d0000c24c0000e64e0000a34d0000e64e0000a34d00005e4c0000844e00005e4c0000844e0000ee4d0000067d8f1800020080c24c0000564d0000c24c0000e64e0000a34d0000e64e0000a34d00005e4c0000844e00005e4c0000844e0000ee4d00000d7d861800030080c24c0000564d0000c24c0000e64e0000a34d0000e64e0000a34d00005e4c0000844e00005e4c0000844e0000ee4d0000347dbd180004008000000000000000000000000000000000000000000100000005000000540000002c0000002c0000002c000000340000000000000000000000a72900007f180000000000002d010000080000000c000000070000001c010000f708000053070000390300000b040000d0020000dd04000018060000a203000018060000bc070000460500000000000001000000411700005d14000000000000060000000600000002000000020000001c010000e60a00000000000001000000f21300004e06000000000000010000000100000002000000020000001c010000f70800000100000000000000f21300000804000000000000000000000000000002000000020000001c010000f7080000000000000000000055320000dd23000000000000000000000d00000004000000040000001c010000f70800009b0a00008106000078563412040000005c00000001000000010000000b000000000000000100000002000000030000000400000005000000060000000700000008000000090000000a00000004000000640062006f0000000a000000540072006100640065006d00610072006b00000002000b008c5500004a790000fd4b00004a7900000000000002000000f0f0f00000000000000000000000000000000000010000002700000000000000c04a0000437700009d0c0000580100003c0000000100000200009d0c000058010000020000000000ffffff000800008001000000150001000000900144420100065461686f6d61140046004b005f00500072006f0064007500630074005f00540072006100640065006d00610072006b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000300440064007300530074007200650061006d000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000160002000300000006000000ffffffff000000000000000000000000000000000000000000000000000000000000000000000000220000008f2300000000000053006300680065006d00610020005500440056002000440065006600610075006c0074000000000000000000000000000000000000000000000000000000000026000200ffffffffffffffffffffffff000000000000000000000000000000000000000000000000000000000000000000000000350000001600000000000000440053005200450046002d0053004300480045004d0041002d0043004f004e00540045004e0054005300000000000000000000000000000000000000000000002c0002010500000007000000ffffffff00000000000000000000000000000000000000000000000000000000000000000000000036000000660400000000000053006300680065006d00610020005500440056002000440065006600610075006c007400200050006f007300740020005600360000000000000000000000000036000200ffffffffffffffffffffffff0000000000000000000000000000000000000000000000000000000000000000000000004800000012000000000000000c00000000000000000000000100260000007300630068005f006c006100620065006c0073005f00760069007300690062006c0065000000010000000b0000001e000000000000000000000000000000000000006400000000000000000000000000000000000000000000000000010000000100000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c0031003600360035000000020000000200000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c0031003600360035000000030000000300000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c0031003600360035000000040000000400000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c0031003600360035000000050000000500000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c00310036003600350000000600000006000000000000005e0000000195ffff01000000640062006f00000046004b005f0049006e007000750074002000500072006f0064007500630074005f0049006e007000750074002000500072006f0064007500630074002000520065006300650069007000740000000000000000000000c402000000000700000007000000060000000800000001fcd61118fcd6110000000000000000ad0f0000010000080000000800000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c0031003600360035000000090000000900000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c00310036003600350000000a0000000a000000000000005600000001002d0001000000640062006f00000046004b005f004f00750074007000750074002000500072006f006400750063007400200052006500630065006900700074005f0043007500730074006f006d006500720000000000000000000000c402000000000b0000000b0000000a0000000800000001f8d61198f8d6110000000000000000ad0f00000100000c0000000c0000000000000062000000013ca76901000000640062006f00000046004b005f004f00750074007000750074002000500072006f006400750063007400200052006500630065006900700074005f004f00750074007000750074002000500072006f00640075006300740000000000000000000000c402000000000d0000000d0000000c0000000800000001fad61198fad6110000000000000000ad0f00000100000e0000000e00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c00310036003600350000000f0000000f00000000000000440000000163526b01000000640062006f00000046004b005f004f00750074007000750074002000500072006f0064007500630074005f00500072006f00640075006300740000000000000000000000c4020000000010000000100000000f0000000800000001f7d61118f7d6110000000000000000ad0f0000010000110000001100000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c00310036003600350000001200000012000000000000004000000001003a0001000000640062006f00000046004b005f00500072006f0064007500630074005f00500072006f0064007500630074005f00540079007000650000000000000000000000c402000000001300000013000000120000000800000001fed611d8fed6110000000000000000ad0f0000010000140000001400000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c0031003600360035000000150000001500000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c00310036003600350000001600000016000000000000005400000001002d0001000000640062006f00000046004b005f0049006e007000750074002000500072006f0064007500630074005f00500072006f00760069006400650072002000500072006f00640075006300740000000000000000000000c402000000001700000017000000160000000800000001fdd61198fdd6110000000000000000ad0f0000010000180000001800000000000000480000000100000001000000640062006f00000046004b005f00500072006f00760069006400650072002000500072006f0064007500630074005f00500072006f00640075006300740000000000000000000000c40200000000190000001900000018000000080000000103d7119803d7110000000000000000ad0f00000100001a0000001a000000000000004a0000000100350001000000640062006f00000046004b005f00500072006f00760069006400650072002000500072006f0064007500630074005f00500072006f007600690064006500720000000000000000000000c402000000001b0000001b0000001a0000000800000001fed61198fed6110000000000000000ad0f00000100001c0000001c00000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c00310036003600350000001d0000001d00000000000000320000000100000001000000640062006f00000046004b005f00440065006200740073005f00520065006300650069007000740000000000000000000000c402000000001e0000001e0000001d000000080000000100d7115800d7110000000000000000ad0f00000100001f0000001f00000000000000380000000100000001000000640062006f00000046004b005f0052006500630065006900700074005f0045006d0070006c006f0079006500650000000000000000000000c4020000000020000000200000001f000000080000000101d711d801d7110000000000000000ad0f000001000021000000210000000000000050000000016aa11601000000640062006f00000046004b005f0052006500630065006900700074005f0049006e007000750074002000500072006f006400750063007400520065006300650069007000740000000000000000000000c40200000000220000002200000021000000080000000103d7111803d7110000000000000000ad0f00000100002300000023000000000000005400000001002d0001000000640062006f00000046004b005f004f00750074007000750074002000500072006f006400750063007400200052006500630065006900700074005f00520065006300650069007000740000000000000000000000c402000000002400000024000000230000000800000001aa9d0f28aa9d0f0000000000000000ad0f0000010000250000002500000000000000000000000000000000000000d00200000600280000004100630074006900760065005400610062006c00650056006900650077004d006f006400650000000100000008000400000031000000200000005400610062006c00650056006900650077004d006f00640065003a00300000000100000008003a00000034002c0030002c003200380034002c0030002c0032003200390035002c0031002c0031003800370035002c0035002c0031003200340035000000200000005400610062006c00650056006900650077004d006f00640065003a00310000000100000008001e00000032002c0030002c003200380034002c0030002c0032003700390030000000200000005400610062006c00650056006900650077004d006f00640065003a00320000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00330000000100000008001e00000032002c0030002c003200380034002c0030002c0032003200390035000000200000005400610062006c00650056006900650077004d006f00640065003a00340000000100000008003e00000034002c0030002c003200380034002c0030002c0032003200390035002c00310032002c0032003700310035002c00310031002c00310036003600350000002600000026000000000000003a0000000150010301000000640062006f00000046004b005f00500072006f0064007500630074005f00540072006100640065006d00610072006b0000000000000000000000c4020000000027000000270000002600000008000000010e650f080e650f0000000000000000ad0f0000010000410000000a000000010000000900000026000000270000001f000000030000001c00000026000000290000000600000005000000040000005c0000006d0000000c0000000800000009000000690000005c000000180000000e0000001500000028000000270000000f0000000e00000008000000220000002700000012000000110000000e00000026000000270000001a00000014000000150000006e000000610000001600000015000000040000002600000027000000230000001c000000090000006c0000005d000000210000001c0000000500000023000000260000001d0000001c000000020000006d0000006000000026000000250000000e0000006c0000007100000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000005f004600690078005f004200750067003b0049006e00740065006700720061007400650064002000530065006300750072006900740079003d0054007200750065003b004d0075006c007400690070006c00650041006300740069007600650052006500730075006c00740053006500740073003d00460061006c00730065003b005000610063006b00650074002000530069007a0065003d0034003000390036003b004100700070006c00690063006100740069006f006e0020004e0061006d0065003d0022004d006900630072006f0073006f00660074002000530051004c00200053006500720076006500720020004d0061006e006100670065006d0065006e0074002000530074007500640069006f002200000000800500140000004400690061006700720061006d005f0030000000000226001200000043007500730074006f006d0065007200000008000000640062006f000000000226000c00000044006500620074007300000008000000640062006f000000000226001200000045006d0070006c006f00790065006500000008000000640062006f000000000226001c00000049006e007000750074002000500072006f006400750063007400000008000000640062006f000000000226002c00000049006e007000750074002000500072006f00640075006300740020005200650063006500690070007400000008000000640062006f000000000226001e0000004f00750074007000750074002000500072006f006400750063007400000008000000640062006f000000000226002e0000004f00750074007000750074002000500072006f00640075006300740020005200650063006500690070007400000008000000640062006f0000000002260010000000500072006f006400750063007400000008000000640062006f000000000226001a000000500072006f0064007500630074005f005400790070006500000008000000640062006f0000000002260012000000500072006f0076006900640065007200000008000000640062006f0000000002260022000000500072006f00760069006400650072002000500072006f006400750063007400000008000000640062006f00000000022600100000005200650063006500690070007400000008000000640062006f0000000002240014000000540072006100640065006d00610072006b00000008000000640062006f00000001000000d68509b3bb6bf2459ab8371664f0327008004e0000007b00310036003300340043004400440037002d0030003800380038002d0034003200450033002d0039004600410032002d004200360044003300320035003600330042003900310044007d0000000000000000000000000000000000000000000000000000000000010003000000000000000c0000000b000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000000062885214);

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
ALTER TABLE `provider product`
  ADD CONSTRAINT `FK_Provider Product_Product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_Provider Product_Provider` FOREIGN KEY (`ProviderID`) REFERENCES `provider` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `FK_Receipt_Employee` FOREIGN KEY (`EmployeeID`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
  
  
ALTER TABLE `user`
  ADD CONSTRAINT `FK_User_Employee` FOREIGN KEY (`Employee_ID`) REFERENCES `employee` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

DELIMITER ;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


