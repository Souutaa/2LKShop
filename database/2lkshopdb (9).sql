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
('testuser2', 'testuser2', '2024-04-02 06:34:41', NULL, NULL),
('testuser3', 'testuser3', '2024-05-02 13:54:57', NULL, NULL),
('testuser4', 'testuser4', '2024-05-02 13:55:36', NULL, NULL);

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
('testuser2', 'CUSTOMER'),
('testadmin1', 'ADMIN'),
('testadmin2', 'ADMIN'),
('testuser1', 'CUSTOMER'),
('testuser2', 'CUSTOMER'),
('testuser3', 'CUSTOMER'),
('testuser4', 'CUSTOMER');

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
('U_Edit', 'EMPLOYEE'),
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
('AMD', 'AMD'),
('DELL', 'Dell'),
('HP', 'HP'),
('INTEL', 'Intel'),
('MSI', 'MSI'),
('NoBrand', 'No Brand'),
('NVIDIA', 'NVIDIA');

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
(2, 'PC'),
(3, 'Bàn phím'),
(4, 'Chuột'),
(5, 'Tai nghe'),
(6, 'CPU'),
(7, 'VGA');

-- --------------------------------------------------------

--
-- Table structure for table `orderdetail`
--

CREATE TABLE `orderdetail` (
  `OrderID` int(11) NOT NULL,
  `ProductId` varchar(50) NOT NULL,
  `purchasePrice` int(11) UNSIGNED NOT NULL,
  `purchaseDiscount` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderdetail`
--

INSERT INTO `orderdetail` (`OrderID`, `ProductId`, `purchasePrice`, `purchaseDiscount`) VALUES
(18, 'K123172489FAN', 29490000, 0),
(18, 'PD1', 29490000, 0),
(19, 'K123172489FAN', 29490000, 0),
(20, 'K123172489FAN', 29490000, 0),
(21, 'K123172489FAN', 29490000, 0),
(22, 'PD1', 29490000, 0),
(22, 'AMDRZ1', 4390000, 0),
(23, 'AMDRZ2', 4390000, 0),
(24, 'AMDRZ2', 4390000, 0),
(25, 'AMDRZ2', 4390000, 0),
(26, 'AMDRZ2', 4390000, 0),
(27, 'AMDRZ2', 4390000, 0),
(28, 'AMDRZ2', 4390000, 0),
(29, 'AMDRZ2', 4390000, 0),
(30, 'AMDRZ2', 4390000, 0),
(31, 'AMDRZ2', 4390000, 0),
(32, 'AMDRZ2', 4390000, 0),
(33, 'AMDRZ2', 4390000, 0),
(34, 'AMDRZ2', 4390000, 0),
(35, 'PD2', 29490000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderinformation`
--

CREATE TABLE `orderinformation` (
  `Id` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `email` varchar(60) NOT NULL,
  `phoneNumber` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderinformation`
--

INSERT INTO `orderinformation` (`Id`, `OrderID`, `username`, `fullname`, `address`, `note`, `email`, `phoneNumber`) VALUES
(5, 18, 'testuser1', 'Maito Shikigami', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Thủ Dầu Một, Tỉnh Bình Dương', 'không có ghi chú', 'shikigamimaito25@gmail.com', '+84352116516'),
(6, 19, 'testuser1', 'Maito Shikigami', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Thái Nguyên, Tỉnh Thái Nguyên', 'không có ghi chú', 'shikigamimaito25@gmail.com', '+84352116516'),
(7, 20, 'testuser1', 'Maito Shikigami', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Tuyên Quang, Tỉnh Tuyên Quang', 'không có ghi chú', 'shikigamimaito25@gmail.com', '+84352116516'),
(8, 21, 'testuser1', 'Maito Shikigami', '5, Huyện Ngân Sơn, Tỉnh Bắc Kạn', 'không có ghi chú', 'shikigamimaito25@gmail.com', '+84352116516'),
(9, 22, 'testuser1', 'Le Vi', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Vĩnh Yên, Tỉnh Vĩnh Phúc', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516'),
(10, 23, 'testuser1', 'Maito Shikigami', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Việt Trì, Tỉnh Phú Thọ', 'không có ghi chú', 'shikigamimaito25@gmail.com', '+84352116516'),
(11, 24, 'testuser1', 'Le Vi', '5, Thành phố Lào Cai, Tỉnh Lào Cai', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516'),
(12, 25, 'testuser1', 'Le Vi', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Điện Biên Phủ, Tỉnh Điện Biên', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516'),
(13, 26, 'testuser1', 'Le Vi', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Vĩnh Yên, Tỉnh Vĩnh Phúc', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516'),
(14, 27, 'testuser1', 'Le Vi', '5, Thành phố Cao Bằng, Tỉnh Cao Bằng', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516'),
(15, 28, 'testuser1', 'Le Vi', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Hưng Yên, Tỉnh Hưng Yên', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516'),
(16, 29, 'testuser1', 'Le Vi', 'Ấp chợ, xã Mỹ Thạnh, Huyện Lập Thạch, Tỉnh Vĩnh Phúc', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516'),
(17, 30, 'testuser1', 'Maito Shikigami', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Bắc Ninh, Tỉnh Bắc Ninh', 'không có ghi chú', 'shikigamimaito25@gmail.com', '+84352116516'),
(18, 31, 'testuser1', 'Le Vi', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Hải Dương, Tỉnh Hải Dương', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516'),
(19, 32, 'testuser1', 'Le Vi', '5, Thành phố Hải Dương, Tỉnh Hải Dương', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516'),
(20, 33, 'testuser1', 'Maito Shikigami', 'Ấp chợ, xã Mỹ Thạnh, Thành phố Hải Dương, Tỉnh Hải Dương', 'không có ghi chú', 'shikigamimaito25@gmail.com', '+84352116516'),
(21, 34, 'testuser1', 'Le Vi', 'Ấp chợ, xã Mỹ Thạnh, Quận Lê Chân, Thành phố Hải Phòng', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516'),
(22, 35, 'testuser1', 'Le Vi', 'Ấp chợ, xã Mỹ Thạnh, Thành Phố Bắc Kạn, Tỉnh Bắc Kạn', 'không có ghi chú', 'shikigamimaito25@gmail.com', '0352116516');

-- --------------------------------------------------------

--
-- Table structure for table `orderstatus`
--

CREATE TABLE `orderstatus` (
  `StatusID` int(11) NOT NULL,
  `StatusName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orderstatus`
--

INSERT INTO `orderstatus` (`StatusID`, `StatusName`) VALUES
(1, 'Đang xử lý'),
(3, 'Đang Giao'),
(4, 'Đã Giao'),
(5, 'Đã Hủy');

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
  `Thumbnail` varchar(50) NOT NULL,
  `Price` int(10) UNSIGNED NOT NULL,
  `Discount` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `warranty_period` varchar(20) DEFAULT NULL,
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

INSERT INTO `product` (`Product_Line`, `Product_Name`, `Thumbnail`, `Price`, `Discount`, `warranty_period`, `Created_at`, `Modified_at`, `Deleted_at`, `Created_by`, `BrandID`, `Category`) VALUES
('AMD_RZ_5_3600_B_CT', 'CPU AMD RYZEN 5 3600 (3.6GHz Up to 4.20GHz, AM4, 6 Cores 12 Threads) Box Công Ty', 'AMD_RZ_5_3600_B_CT.jpg', 4390000, 0, '12M', '2024-05-04 09:13:45', '2024-05-06 15:07:32', NULL, 'testadmin1', 'AMD', 6),
('IG870_TR', 'CPU intel pentium G870 (3.0GHz, 2 lõi, 2 luồng) Tray', 'IG870_TR.jpg', 210000, 0, NULL, '2024-05-03 14:40:11', '2024-05-06 14:58:15', NULL, 'testadmin1', 'INTEL', 6),
('MB_CHICKEN_Mini_1660TI', 'Cấu hình Gaming CHICKEN Mini 1660Ti', 'MB_CHICKEN_Mini_1660TI.jpg', 8885000, 0, NULL, '2024-05-03 14:33:10', '2024-05-08 12:54:19', NULL, 'testadmin1', 'NoBrand', 2),
('MB_STAR_CHICKEN_SUMMMER', 'Cấu hình Gaming CHICKEN Summer 3050', 'MB_STAR_CHICKEN_SUMMMER.png', 13549000, 0, NULL, '2024-05-08 12:52:58', '2024-05-08 12:54:44', NULL, 'testadmin1', 'NoBrand', 2),
('MSI_GF65_2', 'Laptop MSI Gaming GF65 Thin 10UE i5 10500H/16GB/512GB/6GB RTX3060 Max-Q/144Hz/Balo/Win10 (286VN)', 'MSI_GF56_268VN.jpg', 29490000, 0, NULL, '2024-04-02 13:08:29', '2024-05-06 14:58:12', NULL, 'testadmin1', 'MSI', 1),
('MSI_GK20', 'Bàn Phím Có dây Gaming MSI Vigor GK20 US', 'MSI_GK20.jpeg', 700000, 0, NULL, '2024-04-02 13:10:32', '2024-05-06 14:58:10', NULL, 'testadmin2', 'MSI', 3),
('MSI_GM08', 'Chuột Có dây Gaming MSI Clutch GM08 Đen', 'MSI_GM08.jpeg', 420000, 50, NULL, '2024-04-02 13:10:32', '2024-05-06 14:58:08', NULL, 'testadmin2', 'MSI', 4),
('MSI_M14_10', 'Laptop MSI Modern 14 B11MOU i3 1115G4/8GB/256GB/Win11 (1027VN)', 'MSI_M14_10.jpg', 13790000, 20, NULL, '2024-04-02 13:08:29', '2024-05-08 11:50:52', '2024-05-08 18:50:52', 'testadmin1', 'MSI', 1),
('NH_QAYSV_007', 'Laptop Acer Aspire 7 Gaming A715 42G R05G R5 5500U/8GB/512GB/4GB GTX1650/144Hz/Win11', 'NH_QAYSV_007.jpg', 15990000, 0, NULL, '2024-04-19 08:17:26', '2024-05-06 14:58:05', NULL, 'testadmin1', 'ACER', 1),
('NX_AM0SV_007', 'Laptop Acer Aspire 3 A315 58 54XF i5 1135G7/8GB/512GB/Win11', 'NX_AM0SV_007.png', 13990000, 0, NULL, '2024-04-19 08:03:05', '2024-05-06 14:58:04', NULL, 'testadmin1', 'ACER', 1),
('NX_HS5SV_00K', 'Laptop Acer Aspire 3 A315 56 32TP i3 1005G1/4GB/256GB/Win11', 'NX_HS5SV_00K.jpg', 11990000, 0, NULL, '2024-04-19 08:29:46', '2024-05-06 14:58:02', NULL, 'testadmin1', 'ACER', 1),
('NX_KAGSV_001', 'Laptop Acer Aspire 3 A315 57 379K i3 1005G1/4GB/256GB/Win11', 'NX_KAGSV_001.jpg', 11990000, 0, NULL, '2024-04-19 08:14:54', '2024-05-06 14:57:57', NULL, 'testadmin1', 'ACER', 1),
('V_730_2G_PL', 'VGA Palit GT 730 2GB SDDR3 64-bit VGA-DVI-HDMI', 'V_730_2G_PL.jpg', 990000, 0, NULL, '2024-05-03 14:38:48', '2024-05-06 14:58:00', NULL, 'testadmin1', 'NVIDIA', 7);

-- --------------------------------------------------------

--
-- Table structure for table `productimage`
--

CREATE TABLE `productimage` (
  `ImageID` int(11) NOT NULL,
  `ProductLine` varchar(50) NOT NULL,
  `imgPath` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productimage`
--

INSERT INTO `productimage` (`ImageID`, `ProductLine`, `imgPath`) VALUES
(1, 'MSI_GF65_2', 'vi-vn-msi-gaming-gf65-thin-10ue-i5-286vn-1.jpg'),
(2, 'MSI_GF65_2', 'vi-vn-msi-gaming-gf65-thin-10ue-i5-286vn-2.jpg'),
(3, 'MSI_GF65_2', 'vi-vn-msi-gaming-gf65-thin-10ue-i5-286vn-3.jpg'),
(10, 'AMD_RZ_5_3600_B_CT', 'AMD_RZ_5_3600_B_CT-0.jpg'),
(11, 'AMD_RZ_5_3600_B_CT', 'AMD_RZ_5_3600_B_CT-1.jpg'),
(12, 'MB_STAR_CHICKEN_SUMMMER', 'MB_STAR_CHICKEN_SUMMMER-0.png');

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
(3, 'MSI_GF65_2', 'Ổ cứng: 512 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 2 TB)Hỗ trợ thêm 1 khe cắm SSD M.2 PCIe mở rộng (nâng cấp tối đa 2 TB)'),
(12, 'NX_HS5SV_00K', 'CPU:  i31005G11.2GHz'),
(13, 'NX_HS5SV_00K', 'RAM:  4 GBDDR4 (Onboard 4 GB +1 khe rời)2400 MHz'),
(14, 'NX_HS5SV_00K', 'Ổ cứng:  Hỗ trợ khe cắm HDD SATA (nâng cấp tối đa 2 TB)256 GB SSD NVMe PCIe (Có thể tháo ra, lắp thanh khác tối đa 512 GB)'),
(16, 'MB_CHICKEN_Mini_1660TI', ' MAINBOARD	Mainboard Asrock H510M-HVS R2.0'),
(17, 'MB_CHICKEN_Mini_1660TI', 'CPU	CPU Intel Core i5 10400F TRAY chưa gồm Fan'),
(18, 'MB_CHICKEN_Mini_1660TI', 'RAM	2x Ram Pioneer Udimm 8GB DDR4 3200MHz Tản Nhiệt'),
(19, 'MB_CHICKEN_Mini_1660TI', 'SSD	Ổ cứng SSD 240G Kingston A400 Sata III 6Gb/s TLC'),
(20, 'MB_CHICKEN_Mini_1660TI', 'VGA	VGA Gainward GTX 1660 Ti Ghost 6GB 2 Fan (2nd)'),
(21, 'MB_CHICKEN_Mini_1660TI', 'PSU	Nguồn Jetek J Series 650W Plus (ST650 POWER SUPPLY ATX 12V PFC)'),
(22, 'MB_CHICKEN_Mini_1660TI', 'CASE	Thùng máy Case VITRA CERES V305-M 4FRGB BLACK (Mid Tower/Màu Đen/ Kèm sẵn 4 Fan RGB)'),
(23, 'MB_CHICKEN_Mini_1660TI', 'Tản Nhiệt	Tản Nhiệt Khí CPU Sama MA-400B Led RGB'),
(24, 'V_730_2G_PL', 'GPU GeForce GT 730'),
(25, 'V_730_2G_PL', 'Bộ nhớ 2GB SDDR3'),
(26, 'V_730_2G_PL', 'Xung nhịp: 902 MHz'),
(27, 'V_730_2G_PL', 'Bộ nhớ: 2048 MHz 64-bit'),
(28, 'V_730_2G_PL', 'Nguồn đề nghị: 300W'),
(29, 'V_730_2G_PL', 'Cổng kết nối: VGA, HDMI, DVI'),
(30, 'IG870_TR', 'Socket: FCLGA1155'),
(31, 'IG870_TR', 'Cấu hình CPU tối đa: 1'),
(32, 'IG870_TR', 'Tốc độ: 3.0GHz'),
(33, 'IG870_TR', 'Số lõi: 2'),
(34, 'IG870_TR', 'Số luồng: 2'),
(35, 'IG870_TR', 'Bộ nhớ đệm: 6MB SmartCache'),
(48, 'AMD_RZ_5_3600_B_CT', 'Socket: AM4 , AMD Ryzen thế hệ thứ 3'),
(49, 'AMD_RZ_5_3600_B_CT', 'Tốc độ xử lý: 3.6 GHz – 4.2GHz ( 6 nhân, 12 luồng)'),
(50, 'AMD_RZ_5_3600_B_CT', 'Bộ nhớ đệm: 32MB'),
(51, 'MB_STAR_CHICKEN_SUMMMER', 'VGA	VGA Gigabyte RTX 3050 8GB GDDR6 EAGLE OC (GV-N3050EAGLE OC-8GBD)'),
(52, 'MB_STAR_CHICKEN_SUMMMER', ' MAINBOARD	Mainboard Asrock H510M-HVS R2.0'),
(53, 'MB_STAR_CHICKEN_SUMMMER', 'CPU	CPU Intel Core i3 12100F TRAY (3.30 Up to 4.30GHz)');

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
('AMDRZ1', '2024-05-06', NULL, 'AMD_RZ_5_3600_B_CT'),
('AMDRZ2', NULL, NULL, 'AMD_RZ_5_3600_B_CT'),
('CCS1', NULL, NULL, 'MB_STAR_CHICKEN_SUMMMER'),
('CCS2', NULL, NULL, 'MB_STAR_CHICKEN_SUMMMER'),
('CCS3', NULL, NULL, 'MB_STAR_CHICKEN_SUMMMER'),
('CCS4', NULL, NULL, 'MB_STAR_CHICKEN_SUMMMER'),
('K123172489FAN', '2024-05-06', NULL, 'MSI_GF65_2'),
('PD1', '2024-05-06', NULL, 'MSI_GF65_2'),
('PD2', NULL, NULL, 'MSI_GF65_2');

-- --------------------------------------------------------

--
-- Table structure for table `userdetail`
--

CREATE TABLE `userdetail` (
  `userdetailID` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `detailedAddress` varchar(30) DEFAULT NULL,
  `District` varchar(20) NOT NULL,
  `City/Province` varchar(20) NOT NULL,
  `Phone_Number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userdetail`
--

INSERT INTO `userdetail` (`userdetailID`, `username`, `FirstName`, `LastName`, `Email`, `detailedAddress`, `District`, `City/Province`, `Phone_Number`) VALUES
(1, 'testadmin1', '', '', '', NULL, 'Quận 2', 'TPHCM', '0351116516'),
(2, 'testuser1', '', '', '', '203 Trần Bình Trọng', 'Quận 5', 'TPHCM', '0267282145'),
(3, 'testadmin2', '', '', '', 'Trần Duy Hưng', 'Đống Đa', 'HN', '02784272516'),
(6, 'testuser3', 'Lê Thái', 'Vi', 'shikigamimaito25@gmail.com', '1', '3', '4', '5'),
(7, 'testuser4', 'Lê Thái', 'Vi', 'shikigamimaito25@gmail.com', NULL, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `userorder`
--

CREATE TABLE `userorder` (
  `OrderID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `Status` int(11) DEFAULT 1,
  `Total` int(20) UNSIGNED NOT NULL,
  `Confirmed_by` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userorder`
--

INSERT INTO `userorder` (`OrderID`, `Username`, `Created_at`, `Status`, `Total`, `Confirmed_by`) VALUES
(18, 'testuser1', '2024-05-06 11:10:13', 5, 58980000, NULL),
(19, 'testuser1', '2024-05-06 12:24:43', 5, 29490000, NULL),
(20, 'testuser1', '2024-05-06 12:25:41', 5, 29490000, NULL),
(21, 'testuser1', '2024-05-06 12:26:25', 3, 29490000, NULL),
(22, 'testuser1', '2024-05-06 13:55:17', 4, 33880000, NULL),
(23, 'testuser1', '2024-05-06 13:56:50', 5, 4390000, NULL),
(24, 'testuser1', '2024-05-06 15:26:44', 5, 4390000, NULL),
(25, 'testuser1', '2024-05-06 15:28:02', 5, 4390000, NULL),
(26, 'testuser1', '2024-05-06 15:30:24', 5, 4390000, NULL),
(27, 'testuser1', '2024-05-06 15:32:23', 5, 4390000, NULL),
(28, 'testuser1', '2024-05-06 15:34:11', 5, 4390000, NULL),
(29, 'testuser1', '2024-05-06 15:36:05', 5, 4390000, NULL),
(30, 'testuser1', '2024-05-06 15:37:10', 5, 4390000, NULL),
(31, 'testuser1', '2024-05-06 15:38:03', 5, 4390000, NULL),
(32, 'testuser1', '2024-05-06 15:38:28', 5, 4390000, NULL),
(33, 'testuser1', '2024-05-06 15:39:25', 5, 4390000, NULL),
(34, 'testuser1', '2024-05-06 15:42:55', 5, 4390000, NULL),
(35, 'testuser1', '2024-05-06 15:45:18', 5, 29490000, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `warrantyperiod`
--

CREATE TABLE `warrantyperiod` (
  `WarrantyId` varchar(20) NOT NULL,
  `Months` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `warrantyperiod`
--

INSERT INTO `warrantyperiod` (`WarrantyId`, `Months`) VALUES
('12M', 12),
('24M', 24),
('32M', 32),
('3M', 3),
('6M', 6);

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
-- Indexes for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD KEY `FK_productId_orderdetail` (`ProductId`),
  ADD KEY `FK_userorder_orderdetail` (`OrderID`);

--
-- Indexes for table `orderinformation`
--
ALTER TABLE `orderinformation`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `FK_account_orderinformation` (`username`),
  ADD KEY `FK_userorder_orderinformation` (`OrderID`);

--
-- Indexes for table `orderstatus`
--
ALTER TABLE `orderstatus`
  ADD PRIMARY KEY (`StatusID`);

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
  ADD KEY `FK_product_brand` (`BrandID`),
  ADD KEY `FK_product_category` (`Category`),
  ADD KEY `FK_product_account` (`Created_by`),
  ADD KEY `FK_product_warrantyPeriod` (`warranty_period`);

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
  ADD KEY `FK_productWarranty_product` (`product_line`);

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
  ADD KEY `FK_account_userorder_staff` (`Confirmed_by`),
  ADD KEY `FK_account_userorder_user` (`Username`),
  ADD KEY `FK_orderstatus_userorder` (`Status`);

--
-- Indexes for table `warrantyperiod`
--
ALTER TABLE `warrantyperiod`
  ADD PRIMARY KEY (`WarrantyId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CategoryID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orderinformation`
--
ALTER TABLE `orderinformation`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `orderstatus`
--
ALTER TABLE `orderstatus`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `productimage`
--
ALTER TABLE `productimage`
  MODIFY `ImageID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `productinfo`
--
ALTER TABLE `productinfo`
  MODIFY `Info_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `userdetail`
--
ALTER TABLE `userdetail`
  MODIFY `userdetailID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `userorder`
--
ALTER TABLE `userorder`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

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
-- Constraints for table `orderdetail`
--
ALTER TABLE `orderdetail`
  ADD CONSTRAINT `FK_productId_orderdetail` FOREIGN KEY (`ProductId`) REFERENCES `product_warranty` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_userorder_orderdetail` FOREIGN KEY (`OrderID`) REFERENCES `userorder` (`OrderID`) ON DELETE CASCADE;

--
-- Constraints for table `orderinformation`
--
ALTER TABLE `orderinformation`
  ADD CONSTRAINT `FK_account_orderinformation` FOREIGN KEY (`username`) REFERENCES `account` (`Username`),
  ADD CONSTRAINT `FK_userorder_orderinformation` FOREIGN KEY (`OrderID`) REFERENCES `userorder` (`OrderID`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `FK_product_account` FOREIGN KEY (`Created_by`) REFERENCES `account` (`Username`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_product_brand` FOREIGN KEY (`BrandID`) REFERENCES `brand` (`BrandID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`Category`) REFERENCES `category` (`CategoryID`) ON DELETE NO ACTION,
  ADD CONSTRAINT `FK_product_warrantyPeriod` FOREIGN KEY (`warranty_period`) REFERENCES `warrantyperiod` (`WarrantyId`);

--
-- Constraints for table `productimage`
--
ALTER TABLE `productimage`
  ADD CONSTRAINT `FK_productImage_ProductLine` FOREIGN KEY (`ProductLine`) REFERENCES `product` (`Product_Line`);

--
-- Constraints for table `productinfo`
--
ALTER TABLE `productinfo`
  ADD CONSTRAINT `FK_productInfo_product` FOREIGN KEY (`Product_Line`) REFERENCES `product` (`Product_Line`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_warranty`
--
ALTER TABLE `product_warranty`
  ADD CONSTRAINT `FK_productWarranty_product` FOREIGN KEY (`product_line`) REFERENCES `product` (`Product_Line`) ON DELETE CASCADE;

--
-- Constraints for table `userdetail`
--
ALTER TABLE `userdetail`
  ADD CONSTRAINT `FK_userdetail_account` FOREIGN KEY (`username`) REFERENCES `account` (`Username`);

--
-- Constraints for table `userorder`
--
ALTER TABLE `userorder`
  ADD CONSTRAINT `FK_account_userorder_staff` FOREIGN KEY (`Confirmed_by`) REFERENCES `account` (`Username`),
  ADD CONSTRAINT `FK_account_userorder_user` FOREIGN KEY (`Username`) REFERENCES `account` (`Username`),
  ADD CONSTRAINT `FK_orderstatus_userorder` FOREIGN KEY (`Status`) REFERENCES `orderstatus` (`StatusID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
