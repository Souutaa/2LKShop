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
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Deleted_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Username`, `Password`, `Created_at`, `Modified_at`, `Deleted_at`) VALUES
('testadmin1', 'testadmin1', '2024-04-02 06:34:58', '2024-04-02 06:39:10', NULL),
('testadmin2', 'testadmin2', '2024-04-02 06:34:58', NULL, NULL),
('testuser1', 'testuser1', '2024-04-02 06:34:41', NULL, NULL),
('testuser2', 'testuser2', '2024-04-02 06:34:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `accountgroup`
--

CREATE TABLE `accountgroup` (
  `username` varchar(20) NOT NULL,
  `accountypeid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountgroup`
--

INSERT INTO `accountgroup` (`username`, `accountypeid`) VALUES
('testadmin1', 'ADMIN'),
('testadmin2', 'ADMIN'),
('testuser1', 'CUSTOMER'),
('testuser2', 'CUSTOMER');

-- --------------------------------------------------------

--
-- Table structure for table `accountpermission`
--

CREATE TABLE `accountpermission` (
  `PermissionID` varchar(10) NOT NULL,
  `TypeID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accountpermission`
--

INSERT INTO `accountpermission` (`PermissionID`, `TypeID`) VALUES
('P_Create', 'ADMIN'),
('P_Delete', 'ADMIN'),
('P_Edit', 'ADMIN'),
('P_Create', 'EMPLOYEE'),
('U_Edit', 'EMPLOYEE');

-- --------------------------------------------------------

--
-- Table structure for table `accounttype`
--

CREATE TABLE `accounttype` (
  `accountTypeID` varchar(20) NOT NULL,
  `TypeName` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `Deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accounttype`
--

INSERT INTO `accounttype` (`accountTypeID`, `TypeName`, `created_at`, `modified_at`, `Deleted_at`) VALUES
('ADMIN', 'For administration the web page', '2024-04-02 06:44:39', NULL, NULL),
('CUSTOMER', 'default for new account created by customer', '2024-04-02 06:44:39', NULL, NULL),
('EMPLOYEE', 'For employee with basic functionality', '2024-04-02 06:45:04', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `BrandID` varchar(10) NOT NULL,
  `BrandName` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`BrandID`, `BrandName`) VALUES
('ACER', 'Acer'),
('DELL', 'Dell'),
('HP', 'HP'),
('MSI', 'MSI');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CategoryID` int(10) NOT NULL,
  `CategoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CategoryID`, `CategoryName`) VALUES
(1, 'Máy tính xách tay'),
(2, 'Máy tính để bàn'),
(3, 'Bàn phím'),
(4, 'Chuột'),
(5, 'Tai nghe');

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `PermissionID` varchar(10) NOT NULL,
  `PermissionName` varchar(20) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`PermissionID`, `PermissionName`, `description`) VALUES
('P_Create', 'Create Product', 'Create Product'),
('P_Delete', 'Delete Product', 'Delete product from the store'),
('P_Edit', 'Edit Product', 'Change product infomation'),
('U_create', 'Create User', 'Create new user'),
('U_Delete', 'Delete User', 'Delete user'),
('U_Edit', 'Edit user', 'Change user infomation');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Product_Line` varchar(50) NOT NULL,
  `Product_Name` varchar(150) NOT NULL,
  `Price` int(10) UNSIGNED NOT NULL,
  `Discount` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Modified_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Deleted_at` datetime DEFAULT NULL,
  `Created_by` varchar(20) NOT NULL,
  `BrandID` varchar(10) NOT NULL,
  `Category` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Product_Line`, `Product_Name`, `Price`, `Discount`, `Created_at`, `Modified_at`, `Deleted_at`, `Created_by`, `BrandID`, `Category`) VALUES
('MSI_GF65_2', 'Laptop MSI Gaming GF65 Thin 10UE i5 10500H/16GB/512GB/6GB RTX3060 Max-Q/144Hz/Balo/Win10 (286VN)', 29490000, 0, '2024-04-02 13:08:29', NULL, NULL, 'testadmin1', 'MSI', 1),
('MSI_GK20', 'Bàn Phím Có dây Gaming MSI Vigor GK20 US', 700000, 0, '2024-04-02 13:10:32', NULL, NULL, 'testadmin2', 'MSI', 3),
('MSI_GM08', 'Chuột Có dây Gaming MSI Clutch GM08 Đen', 420000, 50, '2024-04-02 13:10:32', NULL, NULL, 'testadmin2', 'MSI', 4),
('MSI_M14_10', 'Laptop MSI Modern 14 B11MOU i3 1115G4/8GB/256GB/Win11 (1027VN)', 13790000, 20, '2024-04-02 13:08:29', NULL, NULL, 'testadmin1', 'MSI', 1);

-- --------------------------------------------------------

--
-- Table structure for table `productimage`
--

CREATE TABLE `productimage` (
  `ImageID` int(11) NOT NULL,
  `ProductLine` varchar(50) NOT NULL,
  `ImageURL` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `productinfo`
--

CREATE TABLE `productinfo` (
  `Info_ID` int(10) NOT NULL,
  `Product_Line` varchar(50) NOT NULL,
  `Product_Information` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productinfo`
--

INSERT INTO `productinfo` (`Info_ID`, `Product_Line`, `Product_Information`) VALUES
(1, 'MSI_GF65_2', 'CPU: i5, 10500H, 2.5GHz'),
(2, 'MSI_GF65_2', 'RAM: 16 GBDDR4 2 khe (1 khe 8 GB + 1 khe 8 GB)3200 MHz'),
(3, 'MSI_GF65_2', 'Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 2 TB)Hỗ trợ thêm 1 khe cắm SSD M.2 PCIe mở rộng (nâng cấp tối đa 2 TB)');

-- --------------------------------------------------------

--
-- Table structure for table `product_warranty`
--

CREATE TABLE `product_warranty` (
  `product_id` varchar(50) NOT NULL,
  `purchased_at` date DEFAULT NULL,
  `warranty_period` date DEFAULT NULL,
  `product_line` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_warranty`
--

INSERT INTO `product_warranty` (`product_id`, `purchased_at`, `warranty_period`, `product_line`) VALUES
('K123172489FAN', NULL, NULL, 'MSI_GF65_2');

-- --------------------------------------------------------

--
-- Table structure for table `userdetail`
--

CREATE TABLE `userdetail` (
  `userdetailID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `detailedAddress` varchar(30) DEFAULT NULL,
  `Ward/Village` varchar(20) NOT NULL,
  `District` varchar(20) NOT NULL,
  `City/Province` varchar(20) NOT NULL,
  `Phone_Number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetail`
--

INSERT INTO `userdetail` (`userdetailID`, `username`, `detailedAddress`, `Ward/Village`, `District`, `City/Province`, `Phone_Number`) VALUES
(1, 'testadmin1', NULL, 'Phường 8', 'Quận 2', 'TPHCM', '0351116516'),
(2, 'testuser1', '203 Trần Bình Trọng', 'Phường 5', 'Quận 5', 'TPHCM', '0267282145'),
(3, 'testadmin2', 'Trần Duy Hưng', 'Phường 2', 'Đống Đa', 'HN', '02784272516');

-- --------------------------------------------------------

--
-- Table structure for table `userorder`
--

CREATE TABLE `userorder` (
  `OrderID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` varchar(20) DEFAULT NULL,
  `Total` int(10) UNSIGNED NOT NULL,
  `Confirmed_by` varchar(20) DEFAULT NULL
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
-- Indexes for table `accountgroup`
--
ALTER TABLE `accountgroup`
  ADD KEY `FK_accountgroup_account` (`username`),
  ADD KEY `FK_accountgroup_accounttype` (`accountypeid`);

--
-- Indexes for table `accountpermission`
--
ALTER TABLE `accountpermission`
  ADD KEY `FK_accountpermission_accounttype` (`TypeID`),
  ADD KEY `FK_accountpermission_permission` (`PermissionID`);

--
-- Indexes for table `accounttype`
--
ALTER TABLE `accounttype`
  ADD PRIMARY KEY (`accountTypeID`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`BrandID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CategoryID`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
  ADD PRIMARY KEY (`PermissionID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Product_Line`),
  ADD KEY `FK_product_account` (`Created_by`),
  ADD KEY `FK_product_brand` (`BrandID`),
  ADD KEY `FK_product_category` (`Category`);

--
-- Indexes for table `productimage`
--
ALTER TABLE `productimage`
  ADD PRIMARY KEY (`ImageID`),
  ADD KEY `FK_productImage_ProductLine` (`ProductLine`);

--
-- Indexes for table `productinfo`
--
ALTER TABLE `productinfo`
  ADD PRIMARY KEY (`Info_ID`),
  ADD KEY `FK_productInfo_product` (`Product_Line`);

--
-- Indexes for table `product_warranty`
--
ALTER TABLE `product_warranty`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `FK_warranty_productLine` (`product_line`);

--
-- Indexes for table `userdetail`
--
ALTER TABLE `userdetail`
  ADD PRIMARY KEY (`userdetailID`),
  ADD KEY `FK_userdetail_account` (`username`);

--
-- Indexes for table `userorder`
--
ALTER TABLE `userorder`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `FK_orderdetail_userorder` (`Confirmed_by`),
  ADD KEY `FK_orderdetail_userorder_user` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `productimage`
--
ALTER TABLE `productimage`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `productinfo`
--
ALTER TABLE `productinfo`
  MODIFY `Info_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userdetail`
--
ALTER TABLE `userdetail`
  MODIFY `userdetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `userorder`
--
ALTER TABLE `userorder`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accountgroup`
--
ALTER TABLE `accountgroup`
  ADD CONSTRAINT `FK_accountgroup_account` FOREIGN KEY (`username`) REFERENCES `account` (`Username`),
  ADD CONSTRAINT `FK_accountgroup_accounttype` FOREIGN KEY (`accountypeid`) REFERENCES `accounttype` (`accountTypeID`);

--
-- Constraints for table `accountpermission`
--
ALTER TABLE `accountpermission`
  ADD CONSTRAINT `FK_accountpermission_accounttype` FOREIGN KEY (`TypeID`) REFERENCES `accounttype` (`accountTypeID`),
  ADD CONSTRAINT `FK_accountpermission_permission` FOREIGN KEY (`PermissionID`) REFERENCES `permission` (`PermissionID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_account` FOREIGN KEY (`Created_by`) REFERENCES `account` (`Username`),
  ADD CONSTRAINT `FK_product_brand` FOREIGN KEY (`BrandID`) REFERENCES `brand` (`BrandID`),
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`Category`) REFERENCES `category` (`CategoryID`);

--
-- Constraints for table `productimage`
--
ALTER TABLE `productimage`
  ADD CONSTRAINT `FK_productImage_ProductLine` FOREIGN KEY (`ProductLine`) REFERENCES `product` (`Product_Line`);

--
-- Constraints for table `productinfo`
--
ALTER TABLE `productinfo`
  ADD CONSTRAINT `FK_productInfo_product` FOREIGN KEY (`Product_Line`) REFERENCES `product` (`Product_Line`);

--
-- Constraints for table `product_warranty`
--
ALTER TABLE `product_warranty`
  ADD CONSTRAINT `FK_warranty_productLine` FOREIGN KEY (`product_line`) REFERENCES `product` (`Product_Line`);

--
-- Constraints for table `userdetail`
--
ALTER TABLE `userdetail`
  ADD CONSTRAINT `FK_userdetail_account` FOREIGN KEY (`username`) REFERENCES `account` (`Username`);

--
-- Constraints for table `userorder`
--
ALTER TABLE `userorder`
  ADD CONSTRAINT `FK_orderdetail_userorder` FOREIGN KEY (`Confirmed_by`) REFERENCES `account` (`Username`),
  ADD CONSTRAINT `FK_orderdetail_userorder_user` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
