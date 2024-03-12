-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 16, 2024 lúc 08:57 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `2lkshopdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_at` datetime NOT NULL,
  `Last_login` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accountgroups`
--

CREATE TABLE `accountgroups` (
  `UID` varchar(50) NOT NULL,
  `TypeID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accountpermission`
--

CREATE TABLE `accountpermission` (
  `permissionID` int(10) NOT NULL,
  `typeID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `accounttype`
--

CREATE TABLE `accounttype` (
  `TypeID` int(10) NOT NULL,
  `TypeName` varchar(50) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_at` datetime DEFAULT NULL,
  `Deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `OrderID` int(10) NOT NULL,
  `ProductID` varchar(20) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `SubTotal` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `permissionID` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `ProductID` varchar(20) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Brand` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `Discount` float NOT NULL,
  `Create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modfied_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Deleted_at` datetime DEFAULT NULL,
  `Created_by` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productdetails`
--

CREATE TABLE `productdetails` (
  `ProductDetailID` varchar(20) NOT NULL,
  `ProductID` varchar(20) NOT NULL,
  `Warranty_created_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `Warranty_Valid_Until` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productinfomation`
--

CREATE TABLE `productinfomation` (
  `ProductID` varchar(20) NOT NULL,
  `Info` text NOT NULL,
  `ProductInfoID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `producttag`
--

CREATE TABLE `producttag` (
  `ProductID` varchar(20) NOT NULL,
  `TagID` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tag`
--

CREATE TABLE `tag` (
  `TagID` varchar(10) NOT NULL,
  `TagName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfo`
--

CREATE TABLE `userinfo` (
  `ID` int(10) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Details_Address` varchar(100) DEFAULT NULL,
  `Ward/Village` varchar(50) DEFAULT NULL,
  `District` varchar(50) DEFAULT NULL,
  `City/Province` varchar(50) DEFAULT NULL,
  `Phone_Number` varchar(25) DEFAULT NULL,
  `Is_Default` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userorder`
--

CREATE TABLE `userorder` (
  `OrderID` int(10) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `Status` tinyint(4) NOT NULL,
  `Total` int(11) NOT NULL,
  `Confirmed_by` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userpayment`
--

CREATE TABLE `userpayment` (
  `ID` int(10) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `PaymentType` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`Username`);

--
-- Indexes for table `accountgroups`
--
ALTER TABLE `accountgroups`
  ADD PRIMARY KEY (`UID`,`TypeID`),
  ADD KEY `FK_accountgroup_accounttype` (`TypeID`);

--
-- Indexes for table `accountpermission`
--
ALTER TABLE `accountpermission`
  ADD PRIMARY KEY (`permissionID`,`typeID`),
  ADD KEY `FK_accounttype_accountpermission` (`typeID`);

--
-- Indexes for table `accounttype`
--
ALTER TABLE `accounttype`
  ADD PRIMARY KEY (`TypeID`);

--
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD PRIMARY KEY (`OrderID`,`ProductID`),
  ADD KEY `FK_orderdetail_product` (`ProductID`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`permissionID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`ProductID`),
  ADD KEY `FK_product_account` (`Created_by`);

--
-- Indexes for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD PRIMARY KEY (`ProductDetailID`),
  ADD KEY `FK_productdetails_product` (`ProductID`);

--
-- Indexes for table `productinfomation`
--
ALTER TABLE `productinfomation`
  ADD PRIMARY KEY (`ProductInfoID`),
  ADD KEY `FK_productInfo_product` (`ProductID`);

--
-- Indexes for table `producttag`
--
ALTER TABLE `producttag`
  ADD PRIMARY KEY (`ProductID`,`TagID`),
  ADD KEY `FK_producttag_tag` (`TagID`);

--
-- Indexes for table `tag`
--
ALTER TABLE `tag`
  ADD PRIMARY KEY (`TagID`);

--
-- Indexes for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_account_userInfo` (`UserID`);

--
-- Indexes for table `userorder`
--
ALTER TABLE `userorder`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_userorder_account_confirm` (`Confirmed_by`),
  ADD KEY `FK_userorder_account_purchase` (`UserID`);

--
-- Indexes for table `userpayment`
--
ALTER TABLE `userpayment`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `FK_account_userpayment` (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounttype`
--
ALTER TABLE `accounttype`
  MODIFY `TypeID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
  MODIFY `permissionID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productinfomation`
--
ALTER TABLE `productinfomation`
  MODIFY `ProductInfoID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfo`
--
ALTER TABLE `userinfo`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userorder`
--
ALTER TABLE `userorder`
  MODIFY `OrderID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userpayment`
--
ALTER TABLE `userpayment`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountgroups`
--
ALTER TABLE `accountgroups`
  ADD CONSTRAINT `FK_accountgroup_account` FOREIGN KEY (`UID`) REFERENCES `account` (`Username`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_accountgroup_accounttype` FOREIGN KEY (`TypeID`) REFERENCES `accounttype` (`TypeID`) ON DELETE CASCADE;

--
-- Constraints for table `accountpermission`
--
ALTER TABLE `accountpermission`
  ADD CONSTRAINT `FK_accounttype_accountpermission` FOREIGN KEY (`typeID`) REFERENCES `accounttype` (`TypeID`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_permission_accountpermission` FOREIGN KEY (`permissionID`) REFERENCES `permission` (`permissionID`) ON DELETE CASCADE;

--
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `FK_orderdetail_product` FOREIGN KEY (`ProductID`) REFERENCES `productdetails` (`ProductDetailID`),
  ADD CONSTRAINT `FK_orderdetail_userorder` FOREIGN KEY (`OrderID`) REFERENCES `userorder` (`OrderID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_account` FOREIGN KEY (`Created_by`) REFERENCES `account` (`Username`);

--
-- Constraints for table `productdetails`
--
ALTER TABLE `productdetails`
  ADD CONSTRAINT `FK_productdetails_product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `productinfomation`
--
ALTER TABLE `productinfomation`
  ADD CONSTRAINT `FK_productInfo_product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`);

--
-- Constraints for table `producttag`
--
ALTER TABLE `producttag`
  ADD CONSTRAINT `FK_producttag_product` FOREIGN KEY (`ProductID`) REFERENCES `product` (`ProductID`),
  ADD CONSTRAINT `FK_producttag_tag` FOREIGN KEY (`TagID`) REFERENCES `tag` (`TagID`);

--
-- Constraints for table `userinfo`
--
ALTER TABLE `userinfo`
  ADD CONSTRAINT `FK_account_userInfo` FOREIGN KEY (`UserID`) REFERENCES `account` (`Username`) ON DELETE CASCADE;

--
-- Constraints for table `userorder`
--
ALTER TABLE `userorder`
  ADD CONSTRAINT `FK_userorder_account_confirm` FOREIGN KEY (`Confirmed_by`) REFERENCES `account` (`Username`),
  ADD CONSTRAINT `FK_userorder_account_purchase` FOREIGN KEY (`UserID`) REFERENCES `account` (`Username`);

--
-- Constraints for table `userpayment`
--
ALTER TABLE `userpayment`
  ADD CONSTRAINT `FK_account_userpayment` FOREIGN KEY (`UserID`) REFERENCES `account` (`Username`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
