-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 08, 2021 at 05:13 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventorydb`
--

DELIMITER $$
--
-- Procedures
--
DROP PROCEDURE IF EXISTS `AddTransactionBody`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddTransactionBody` (IN `THID` INT, IN `rowId` INT, IN `userID` INT, IN `PID` INT, IN `unitID` INT, IN `quantity` FLOAT, IN `rate` FLOAT, IN `gross` FLOAT, IN `narration` VARCHAR(255))  BEGIN
  insert into transactionsbody(THID,rowId,userID,PID,unitID,quantity,rate,gross,narration)
    values(THID,rowId,userID,PID,unitID,quantity,rate,gross,narration);

END$$

DROP PROCEDURE IF EXISTS `AddTranscationHeader`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `AddTranscationHeader` (IN `vuserID` INT, IN `bID` INT, IN `whID` INT, IN `vID_CID` INT, IN `vtType` INT, IN `voucherDate` DATE, IN `vcomment` TEXT, OUT `Result` INT)  BEGIN
  set  @voucerNo=(select  case when ISNULL(max(voucherNo)) =1 then 1 else max(voucherNo)+1 end as voucherNo    from transactionsheader WHERE TType=vtType and year=YEAR(NOW()));

insert into transactionsheader(userID,VoucherNo,BID,WhID,VID_CID,TType,VoucherDate,Comment,year)
  values(vuserID,@voucerNo,bID,whID,vID_CID,vtType,voucherDate,vcomment,YEAR(NOW()));

select max(THID) into Result from transactionsheader ;


END$$

DROP PROCEDURE IF EXISTS `UpdateTransactionBody`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTransactionBody` (IN `bTHID` INT, IN `bRowId` INT, IN `BPID` INT, IN `BunitID` INT, IN `Quantity` FLOAT, IN `Rate` FLOAT, IN `Gross` FLOAT, IN `Narration` VARCHAR(255))  BEGIN
 set @foundId=null;
 select  rowId into @foundId from transactionsbody  where THID=bTHID and rowId=bRowId limit 1;
  if(@foundId is null) then 
   call AddTransactionBody(bTHID,bRowId,0,BPID,BunitID,Quantity,Rate,Gross,Narration);
  else
   update transactionsbody 
  set
 PID=BPID,
unitID=BunitID,
quantity=Quantity,
  rate=Rate,
  gross=Gross,
narration=Narration

  where THID=bTHID and rowId=@foundId;
    end If;
 

  select @foundId;


END$$

DROP PROCEDURE IF EXISTS `UpdateTranscationHeader`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTranscationHeader` (IN `vId` INT, IN `vuserID` INT, IN `vbID` INT, IN `vwhID` INT, IN `vvID_CID` INT, IN `vtType` INT, IN `vvoucherDate` DATE, IN `vcomment` TEXT)  BEGIN
  
update transactionsheader
  set 
  BID=vbID,
  WhID=vwhID,
  VID_CID=vvID_CID,
  TType=vtType,
  voucherDate=vvoucherDate,
  Comment=vcomment
 
  where thid=vId ;



END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
CREATE TABLE IF NOT EXISTS `branches` (
  `BID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `BTitle` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`BID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`BID`, `userID`, `BTitle`, `address`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'المركز الرئيسي', '', '2021-05-01 23:38:30', '2021-05-01 23:38:30', '2021-05-01 23:38:30'),
(2, 1, 'عدن', '', '2021-05-01 23:38:51', '2021-05-01 23:38:51', '2021-05-01 23:38:51'),
(3, 1, 'الحديدة', '', '2021-05-01 23:38:51', '2021-05-01 23:38:51', '2021-05-01 23:38:51'),
(4, 2, 'حضرموت', 'سيئون', '2021-05-04 02:02:06', '2021-05-04 02:02:06', '2021-05-04 02:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `CID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `cname` varchar(70) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`CID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`CID`, `userID`, `cname`, `phone`, `address`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'شاكر', '777', '', 1, '2021-05-01 23:39:50', '2021-05-01 23:39:50', '2021-05-01 23:39:50'),
(2, 1, 'نهام', '777', '', 1, '2021-05-01 23:39:50', '2021-05-01 23:39:50', '2021-05-01 23:39:50'),
(3, 1, 'عمر', '777', '', 1, '2021-05-01 23:39:50', '2021-05-01 23:39:50', '2021-05-01 23:39:50'),
(4, 1, 'سامي', 'صنعاء', '', 0, '2021-05-04 00:49:31', '2021-05-04 00:49:31', '2021-05-04 00:49:31'),
(5, 1, 'صدام', '123', 'عدن', 1, '2021-05-04 00:49:39', '2021-05-04 00:49:39', '2021-05-04 00:49:39'),
(6, 1, 'سليم', '444', 'شعوب', 1, '2021-05-04 00:51:32', '2021-05-04 00:51:32', '2021-05-04 00:51:32');

-- --------------------------------------------------------

--
-- Table structure for table `openningstocks`
--

DROP TABLE IF EXISTS `openningstocks`;
CREATE TABLE IF NOT EXISTS `openningstocks` (
  `openID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `VID` int(11) NOT NULL,
  `WhID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`openID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `PTitle` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `PrDate` date DEFAULT NULL,
  `ExDate` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`PID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PID`, `userID`, `PTitle`, `company`, `PrDate`, `ExDate`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'نظام', 'اجيل سوفت', '2021-05-01', '2021-05-31', '2021-05-01 23:40:39', '2021-05-01 23:40:39', '2021-05-01 23:40:39'),
(2, 1, 'بطاطس', 'هائل سعيد', '2021-05-01', '2021-05-31', '2021-05-01 23:41:58', '2021-05-01 23:41:58', '2021-05-01 23:41:58'),
(3, 1, 'عصير', 'هنية', '2021-05-01', '2021-05-31', '2021-05-01 23:41:58', '2021-05-01 23:41:58', '2021-05-01 23:41:58'),
(4, 1, 'ccc', 'aa', NULL, NULL, '2021-05-04 00:24:50', '2021-05-04 00:24:50', '2021-05-04 00:24:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `RID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `RTitle` varchar(50) NOT NULL,
  `RDesc` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`RID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `transactionsbody`
--

DROP TABLE IF EXISTS `transactionsbody`;
CREATE TABLE IF NOT EXISTS `transactionsbody` (
  `bodyID` int(11) NOT NULL AUTO_INCREMENT,
  `rowId` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `THID` int(11) NOT NULL,
  `PID` int(11) NOT NULL,
  `unitID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` decimal(7,0) NOT NULL,
  `gross` decimal(10,0) NOT NULL,
  `narration` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`bodyID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactionsbody`
--

INSERT INTO `transactionsbody` (`bodyID`, `rowId`, `userID`, `THID`, `PID`, `unitID`, `quantity`, `rate`, `gross`, `narration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 0, 2, 1, 2, 2, 5, '4000', '20000', '', '2021-05-08 03:36:04', '2021-05-08 03:36:04', '2021-05-08 03:36:04'),
(2, 0, 2, 2, 2, 2, 2, '5000', '10000', '', '2021-05-08 03:36:43', '2021-05-08 03:36:43', '2021-05-08 03:36:43'),
(3, 0, 2, 3, 1, 1, 1, '4', '4', '', '2021-05-08 05:02:18', '2021-05-08 05:02:18', '2021-05-08 05:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `transactionsheader`
--

DROP TABLE IF EXISTS `transactionsheader`;
CREATE TABLE IF NOT EXISTS `transactionsheader` (
  `THID` int(11) NOT NULL AUTO_INCREMENT,
  `VoucherNo` varchar(20) NOT NULL,
  `Year` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `BID` int(11) NOT NULL,
  `WhID` int(11) NOT NULL,
  `VID_CID` int(11) NOT NULL,
  `TType` int(11) NOT NULL,
  `VoucherDate` date NOT NULL,
  `Comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`THID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactionsheader`
--

INSERT INTO `transactionsheader` (`THID`, `VoucherNo`, `Year`, `userID`, `BID`, `WhID`, `VID_CID`, `TType`, `VoucherDate`, `Comment`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 2021, 2, 1, 1, 1, 1, '2021-05-08', '', '2021-05-08 03:36:04', '2021-05-08 03:36:04', '2021-05-08 03:36:04'),
(2, '1', 2021, 2, 1, 1, 2, 2, '2021-05-10', '', '2021-05-08 03:36:43', '2021-05-08 03:36:43', '2021-05-08 03:36:43'),
(3, '1', 2021, 2, 1, 1, 0, 5, '2021-05-08', '', '2021-05-08 05:02:18', '2021-05-08 05:02:18', '2021-05-08 05:02:18');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

DROP TABLE IF EXISTS `units`;
CREATE TABLE IF NOT EXISTS `units` (
  `unitID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `unitTitle` varchar(50) NOT NULL,
  `unitDesc` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`unitID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unitID`, `userID`, `unitTitle`, `unitDesc`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'حبة', '', '2021-05-02 00:04:00', '2021-05-02 00:04:00', '2021-05-02 00:04:00'),
(2, 1, 'كرتون', '', '2021-05-02 00:04:00', '2021-05-02 00:04:00', '2021-05-02 00:04:00'),
(3, 1, 'قطعة', '', '2021-05-02 00:04:00', '2021-05-02 00:04:00', '2021-05-02 00:04:00'),
(4, 1, 'باكت', '', '2021-05-02 00:04:00', '2021-05-02 00:04:00', '2021-05-02 00:04:00'),
(5, 1, 'شدة', '', '2021-05-02 00:04:00', '2021-05-02 00:04:00', '2021-05-02 00:04:00'),
(6, 1, 'كيلو', '', '2021-05-02 00:04:00', '2021-05-02 00:04:00', '2021-05-02 00:04:00'),
(7, 1, 'شوالة', '', '2021-05-04 00:32:04', '2021-05-04 00:32:04', '2021-05-04 00:32:04');

-- --------------------------------------------------------

--
-- Table structure for table `useraccount`
--

DROP TABLE IF EXISTS `useraccount`;
CREATE TABLE IF NOT EXISTS `useraccount` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `userType` int(11) NOT NULL,
  `userName` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `surName` text DEFAULT NULL,
  `gender` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`userID`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `useraccount`
--

INSERT INTO `useraccount` (`userID`, `userType`, `userName`, `password`, `surName`, `gender`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, '555Yahia', '202cb962ac59075b964b07152d234b70', 'a', 1, 1, '2021-05-03 23:21:13', '2021-05-03 23:21:13', '2021-05-03 23:21:13'),
(2, 2, 'yahia', '202cb962ac59075b964b07152d234b70', NULL, 1, 1, '2021-05-03 23:42:00', '2021-05-03 23:42:00', '2021-05-03 23:42:00'),
(3, 1, 'aa', '182be0c5cdcd5072bb1864cdee4d3d6e', NULL, 1, 1, '2021-05-03 23:49:27', '2021-05-03 23:49:27', '2021-05-03 23:49:27'),
(4, 1, 'cc', '202cb962ac59075b964b07152d234b70', NULL, 1, 1, '2021-05-03 23:49:38', '2021-05-03 23:49:38', '2021-05-03 23:49:38'),
(5, 1, 'ee', '202cb962ac59075b964b07152d234b70', NULL, 1, 1, '2021-05-03 23:51:26', '2021-05-03 23:51:26', '2021-05-03 23:51:26'),
(6, 1, 'er', '202cb962ac59075b964b07152d234b70', NULL, 1, 1, '2021-05-03 23:54:34', '2021-05-03 23:54:34', '2021-05-03 23:54:34'),
(7, 1, 'ee', '182be0c5cdcd5072bb1864cdee4d3d6e', NULL, 1, 1, '2021-05-03 23:57:41', '2021-05-03 23:57:41', '2021-05-03 23:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `usertyperoles`
--

DROP TABLE IF EXISTS `usertyperoles`;
CREATE TABLE IF NOT EXISTS `usertyperoles` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `UTID` int(11) NOT NULL,
  `RID` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

DROP TABLE IF EXISTS `usertypes`;
CREATE TABLE IF NOT EXISTS `usertypes` (
  `UTID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `TDesc` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`UTID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

DROP TABLE IF EXISTS `vendors`;
CREATE TABLE IF NOT EXISTS `vendors` (
  `VID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `vname` varchar(50) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `address` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`VID`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`VID`, `userID`, `vname`, `phone`, `address`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'محمد', NULL, '', 1, '2021-05-01 23:42:42', '2021-05-01 23:42:42', '2021-05-01 23:42:42'),
(2, 1, 'صالح', NULL, '', 1, '2021-05-01 23:42:42', '2021-05-01 23:42:42', '2021-05-01 23:42:42'),
(3, 1, 'مروان', '', 'تعز', 1, '2021-05-01 23:42:42', '2021-05-01 23:42:42', '2021-05-01 23:42:42'),
(4, 1, 'ايمن', '7777', 'حضرموت', 1, '2021-05-04 00:54:31', '2021-05-04 00:54:31', '2021-05-04 00:54:31');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

DROP TABLE IF EXISTS `warehouses`;
CREATE TABLE IF NOT EXISTS `warehouses` (
  `WID` int(11) NOT NULL AUTO_INCREMENT,
  `BID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `WTitle` varchar(70) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`WID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`WID`, `BID`, `userID`, `WTitle`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'التحرير', '2021-05-02 00:18:20', '2021-05-02 00:18:20', '2021-05-02 00:18:20'),
(2, 1, 1, 'الحصبة', '2021-05-02 00:18:20', '2021-05-02 00:18:20', '2021-05-02 00:18:20'),
(3, 2, 2, 'التواهي', '2021-05-04 02:07:56', '2021-05-04 02:07:56', '2021-05-04 02:07:56');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
