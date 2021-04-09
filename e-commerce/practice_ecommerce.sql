-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 03:03 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `practice_ecommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `createdDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`adminId`, `userName`, `password`, `status`, `createdDate`) VALUES
(1, 'admin1@gmail.com', 'admin1', 1, '2021-02-25 13:08:21'),
(2, 'admin2@gmail.com', 'admin2', 1, '2021-02-25 13:08:42'),
(3, 'admin3@gmail.com', 'admin3', 1, '2021-02-25 13:09:34'),
(23, 'admin4@gmail.com', 'admin4', 1, '2021-03-10 23:49:16');

-- --------------------------------------------------------

--
-- Table structure for table `attribute`
--

CREATE TABLE `attribute` (
  `attributeId` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `entityTypeId` enum('product','category') NOT NULL,
  `code` varchar(20) NOT NULL,
  `inputType` varchar(20) NOT NULL,
  `backendType` varchar(64) DEFAULT NULL,
  `sortOrder` int(11) NOT NULL,
  `backendModel` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute`
--

INSERT INTO `attribute` (`attributeId`, `name`, `entityTypeId`, `code`, `inputType`, `backendType`, `sortOrder`, `backendModel`) VALUES
(1, 'Color', 'product', 'color', 'checkbox', 'varchar', 1, 'Model\\Attribute\\Option'),
(8, 'Popular', 'product', 'popular', 'radio', 'varchar', 3, 'Model\\Attribute\\Option'),
(11, 'Meterial', 'product', 'meterial', 'select', 'varchar', 4, 'Model\\Attribute\\Option');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_option`
--

CREATE TABLE `attribute_option` (
  `optionId` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `attributeId` int(11) NOT NULL,
  `sortOrder` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attribute_option`
--

INSERT INTO `attribute_option` (`optionId`, `name`, `attributeId`, `sortOrder`) VALUES
(49, 'Red', 1, 4),
(50, 'Green', 1, 2),
(51, 'Blue', 1, 1),
(52, 'Yes', 8, 1),
(53, 'No', 8, 2),
(54, 'Orange', 1, 3),
(63, 'Wood', 11, 1),
(64, 'Plastic', 11, 2),
(65, 'Metal', 11, 3);

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `brandId` int(11) NOT NULL,
  `imageName` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `feature` tinyint(4) NOT NULL,
  `sortOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandId`, `imageName`, `name`, `feature`, `sortOrder`) VALUES
(1, '13.png', 'Cassina', 1, 0),
(2, '14.png', 'Knoll', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartId` int(11) NOT NULL,
  `sessionId` int(50) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `paymentMethodId` int(11) DEFAULT NULL,
  `shippingMethodId` int(11) DEFAULT NULL,
  `shippingAmount` decimal(10,2) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_address`
--

CREATE TABLE `cart_address` (
  `cartAddressId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `addressId` int(11) DEFAULT NULL,
  `addressType` varchar(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(30) NOT NULL,
  `state` varchar(30) NOT NULL,
  `country` varchar(30) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `sameAsBilling` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cart_item`
--

CREATE TABLE `cart_item` (
  `cartItemId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `categoryId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `description` text NOT NULL,
  `parentId` int(11) NOT NULL,
  `pathId` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`categoryId`, `name`, `status`, `description`, `parentId`, `pathId`) VALUES
(1, 'Bedroom', 1, '', 0, '1'),
(2, 'Bedroom Sets', 1, '', 1, '1=>2'),
(3, 'Beds', 1, '', 1, '1=>3'),
(4, 'Nightstands', 1, '', 1, '1=>4'),
(5, 'Dressers', 1, '', 1, '1=>5'),
(6, 'Dresser Mirrors', 1, '', 1, '1=>6'),
(7, 'Chests', 1, '', 1, '1=>7'),
(8, 'Bedroom Benches', 1, '', 1, '1=>8'),
(9, 'Bed Frames & Headboad', 1, '', 1, '1=>9'),
(10, 'Armoires and Wardrobes', 1, '', 1, '1=>10'),
(11, 'Bedroom Vanities', 1, '', 1, '1=>11'),
(12, 'Jewelry Armoires', 1, '', 1, '1=>12'),
(13, 'Kids Room', 1, '', 1, '1=>13'),
(14, 'Kids and Youth Furniture', 1, '', 1, '1=>14'),
(15, 'Baby Furniture', 1, '', 1, '1=>15'),
(16, 'Mattresses', 1, '', 1, '1=>16'),
(17, 'Adjustable Beds', 1, '', 1, '1=>17'),
(18, 'Pillows', 1, '', 1, '1=>18'),
(19, 'Living Room', 1, '', 0, '19'),
(20, 'Living Room Sets', 1, '', 19, '19=>20'),
(21, 'Sectionals', 1, '', 19, '19=>21'),
(22, 'Sofas', 1, '', 19, '19=>22'),
(23, 'Loveseats', 1, '', 19, '19=>23'),
(24, 'Sleeper Sofas', 1, '', 19, '19=>24'),
(25, 'Theater Seating', 1, '', 19, '19=>25'),
(26, 'Chairs', 1, '', 19, '19=>26'),
(27, 'Accent Chairs', 1, '', 19, '19=>27'),
(28, 'Leather Furniture', 1, '', 19, '19=>28'),
(29, 'Occasional Table Sets', 1, '', 19, '19=>29'),
(30, 'Sofa Tables', 1, '', 19, '19=>30'),
(31, 'Accent Chests and Cabinets', 1, '', 19, '19=>31'),
(32, 'Console Tables', 1, '', 19, '19=>32'),
(33, 'Coffee and Cocktail Tables', 1, '', 19, '19=>33'),
(34, 'End Tables', 1, '', 19, '19=>34'),
(35, 'Accent Tables', 1, '', 19, '19=>35'),
(36, 'Side Tables', 1, '', 19, '19=>36'),
(37, 'TV Stands', 1, '', 19, '19=>37'),
(38, 'CD and DVD Media Storage', 1, '', 19, '19=>38'),
(39, 'Office', 1, '', 0, '39'),
(40, 'Home Office Sets', 1, '', 39, '39=>40'),
(41, 'Desks & Hutches', 1, '', 39, '39=>41'),
(42, 'Modular Office Furniture', 1, '', 39, '39=>42'),
(43, 'Filing Cabinets and Storage', 1, '', 39, '39=>43'),
(44, 'Bookcases, Book Shelves', 1, '', 39, '39=>44'),
(45, 'Office Accessories', 1, '', 39, '39=>45'),
(46, 'Office Chairs', 1, '', 39, '39=>46');

-- --------------------------------------------------------

--
-- Table structure for table `cms_page`
--

CREATE TABLE `cms_page` (
  `pageId` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `identifier` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cms_page`
--

INSERT INTO `cms_page` (`pageId`, `title`, `identifier`, `content`, `status`, `createdDate`) VALUES
(1, 'Home', '1', '<p><strong><em><a href=\"http://localhost/e-commerce/\">QuesteCom</a></em></strong></p>\n', 1, '2021-03-15 12:26:05');

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE `config` (
  `configId` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  `title` varchar(70) NOT NULL,
  `code` varchar(70) NOT NULL,
  `value` varchar(70) NOT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`configId`, `groupId`, `title`, `code`, `value`, `createdDate`) VALUES
(4, 1, 'demo2', 'demo2', 'Demo2', '2021-04-05 08:26:07'),
(5, 1, 'demo1', 'demo1', 'Demo1', '2021-04-05 08:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `config_group`
--

CREATE TABLE `config_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(70) DEFAULT NULL,
  `createdDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `config_group`
--

INSERT INTO `config_group` (`groupId`, `name`, `createdDate`) VALUES
(1, 'Group1', '2021-04-05 07:55:03'),
(2, 'Group2', '2021-04-05 07:55:21');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `customerId` int(11) NOT NULL,
  `groupId` int(11) DEFAULT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customerId`, `groupId`, `firstName`, `lastName`, `email`, `password`, `phone`, `status`, `createdDate`, `updatedDate`) VALUES
(1, 1, 'Shrey', 'Bathani', 'shreybathani1999@gmail.com', 'shrey123', '9426270892', 1, '2021-02-15 12:58:23', '2021-04-05 10:06:03'),
(2, 1, 'John', 'Mark', 'johnmark@gmail.com', 'john123', '9898767655', 1, '2021-02-16 14:09:34', '2021-04-05 10:06:09'),
(28, 2, 'Deep', 'patel', 'deeppatel@gmail.com', 'deep123', '8976129634', 1, '2021-04-08 12:47:38', '2021-04-08 12:47:38');

-- --------------------------------------------------------

--
-- Table structure for table `customer_address`
--

CREATE TABLE `customer_address` (
  `addressId` int(11) NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  `address` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` int(10) NOT NULL,
  `addressType` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_address`
--

INSERT INTO `customer_address` (`addressId`, `customerId`, `address`, `city`, `state`, `country`, `zipcode`, `addressType`) VALUES
(1, 2, 'Snkalp Apprtment', 'Junagadh', 'Gujarat', 'India', 362001, 'billing'),
(2, 2, 'Moti Palace', 'Junagadh', 'Gujarat', 'India1', 362001, 'shipping'),
(3, 1, 'zanzarda road', 'Junagadh', 'Gujarat', 'India', 362001, 'billing'),
(4, 1, 'F-202, Rudra Flower Apartment, Lambhvel Road', 'Anand', 'Gujarat', 'India', 388001, 'shipping');

-- --------------------------------------------------------

--
-- Table structure for table `customer_group`
--

CREATE TABLE `customer_group` (
  `groupId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer_group`
--

INSERT INTO `customer_group` (`groupId`, `name`, `status`, `createdDate`) VALUES
(1, 'Retailer', 1, '2021-03-12 22:47:11'),
(2, 'Wholeseller', 1, '2021-03-12 22:48:02'),
(5, 'Group 1', 0, '2021-03-13 21:15:37');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `orderId` int(11) NOT NULL,
  `cartId` int(11) NOT NULL,
  `customerId` int(11) NOT NULL,
  `customerFirstName` varchar(70) NOT NULL,
  `customerLastName` varchar(70) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` int(11) NOT NULL,
  `paymentMethodId` int(11) NOT NULL,
  `paymentMethodName` varchar(70) NOT NULL,
  `paymentMethodCode` varchar(50) NOT NULL,
  `shippingMethodId` int(11) NOT NULL,
  `shippingMethodName` varchar(70) NOT NULL,
  `shippingMethodCode` varchar(50) NOT NULL,
  `shippingAmount` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`orderId`, `cartId`, `customerId`, `customerFirstName`, `customerLastName`, `email`, `phone`, `paymentMethodId`, `paymentMethodName`, `paymentMethodCode`, `shippingMethodId`, `shippingMethodName`, `shippingMethodCode`, `shippingAmount`, `total`, `discount`, `status`, `createdDate`) VALUES
(1, 2, 1, 'Shrey', 'Bathani', 'shreybathani1999@gmail.com', 2147483647, 1, 'COD', 'ABC101', 2, 'Fast Delivery', 'SHIP102', '100.00', '4080.00', '0.00', 0, '2021-04-09 18:09:05');

-- --------------------------------------------------------

--
-- Table structure for table `order_address`
--

CREATE TABLE `order_address` (
  `orderAddressId` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `addressId` int(11) NOT NULL,
  `addressType` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `sameAsBilling` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_address`
--

INSERT INTO `order_address` (`orderAddressId`, `orderId`, `addressId`, `addressType`, `address`, `city`, `state`, `country`, `zipcode`, `firstName`, `lastName`, `sameAsBilling`) VALUES
(1, 1, 3, 'billing', 'zanzarda road', 'Junagadh', 'Gujarat', 'India', '362001', 'Shrey', 'Bathani', 0),
(2, 1, 4, 'shipping', 'F-202, Rudra Flower Apartment, Lambhvel Road', 'Anand', 'Gujarat', 'India', '388001', 'Shrey', 'Bathani', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `orderItemId` int(11) NOT NULL,
  `orderId` int(11) DEFAULT NULL,
  `productId` int(11) NOT NULL,
  `sku` varchar(70) NOT NULL,
  `name` varchar(70) NOT NULL,
  `quantity` int(11) NOT NULL,
  `basePrice` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`orderItemId`, `orderId`, `productId`, `sku`, `name`, `quantity`, `basePrice`, `price`, `discount`, `total`) VALUES
(1, 1, 9, 'DEMO1234', 'Camila Black Office Chair', 2, '1200.00', '1200.00', 10, '2380.00'),
(2, 1, 10, 'QR7373YD', 'Morth Shore NightStand', 1, '2000.00', '1800.00', 100, '1700.00');

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `methodId` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`methodId`, `name`, `code`, `description`, `status`, `createdDate`) VALUES
(1, 'COD', 'ABC101', 'Payment via cash on delivery', 1, '2021-02-17 12:47:57'),
(2, 'E-wallet', 'ABC104', 'Payment via E-wallet', 1, '2021-02-17 12:52:17'),
(3, 'Debit Card', 'ABC103', 'Payment via debit card', 1, '2021-02-17 12:51:28'),
(4, 'Credit Card', 'ABC102', 'Payment via credit card', 1, '2021-02-17 12:50:38');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `productId` int(11) NOT NULL,
  `sku` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount` varchar(10) NOT NULL,
  `quantity` int(30) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `createdDate` datetime NOT NULL,
  `updatedDate` datetime NOT NULL,
  `color` varchar(45) DEFAULT NULL,
  `popular` int(45) DEFAULT NULL,
  `meterial` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`productId`, `sku`, `name`, `price`, `discount`, `quantity`, `description`, `status`, `createdDate`, `updatedDate`, `color`, `popular`, `meterial`) VALUES
(1, 'AB1234CD', 'Mirage Panel Bed (Queen)', '10000.00', '1000', 15, 'Contemporary living is highlighted by a design that conveys energy and imagination while silhouettes create a simplistic statement to any room. From refined sophistication to modern flair, clean contemporary lines combine to create a versatile look for todays home.', 1, '2021-02-15 19:54:30', '2021-04-04 19:05:33', '', 52, '63'),
(6, 'XYZ123MN', 'Sofa', '7500.00', '500', 44, 'Im Sofa', 0, '2021-02-16 11:29:06', '2021-04-02 19:13:19', '', 52, '63'),
(7, 'PYZ1234N', 'Wallace Office Chair', '2500.00', '100', 50, 'The Armen Living Wallace mid-century office chair is a durably framed beautifully black faux leather upholstered chair fit for the modern contemporary home or commercial office. The Wallaces curved cushioned seat allows for a level of comfort that is further accented by the chairs plush back. The chrome base and wheels are durable and allow for a great deal of mobility while the gas lift mechanism allows for height adjustment. The style and functionality of the contemporary Wallace office chair make it an ideal choice for enhancing the workplace.', 1, '2021-02-16 11:30:47', '2021-04-02 19:13:29', '', 52, '63'),
(8, 'AB63CD12', 'Table', '2000.00', '100', 50, 'Im Table', 0, '2021-02-16 11:41:03', '2021-04-02 19:13:47', '', 52, NULL),
(9, 'DEMO1234', 'Camila Black Office Chair', '1200.00', '10', 45, 'Office Chair', 0, '2021-02-16 12:10:01', '2021-03-31 18:36:15', '49,51', 52, NULL),
(10, 'QR7373YD', 'Morth Shore NightStand', '2000.00', '100', 30, 'NightStand', 1, '2021-03-23 11:20:35', '2021-04-02 19:13:58', '', 52, NULL),
(48, 'DF1023MN', 'Sage Fabric Sofa', '8000.00', '100', 40, 'Sage Fabric Sofa', 1, '2021-03-23 11:16:21', '2021-04-02 19:14:09', '', 52, NULL),
(49, 'KL4523WS', 'Mirage Drawer Drasser', '8000.00', '500', 50, '', 1, '2021-03-23 11:18:40', '2021-04-02 19:14:29', '', 52, NULL),
(51, 'ER9853JG', 'Sleeper Sofa', '7000.00', '500', 20, '', 1, '2021-04-05 10:39:08', '2021-04-05 10:39:08', NULL, 53, NULL),
(52, 'GS8345PE', 'Nahara Glass Coffee Table', '3000.00', '0', 15, '', 1, '2021-04-05 11:01:38', '2021-04-05 11:01:38', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(11) NOT NULL,
  `productId` int(11) NOT NULL,
  `categoryId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `productId`, `categoryId`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 6, 1),
(5, 6, 19),
(6, 6, 22),
(7, 6, 30),
(8, 8, 1),
(9, 8, 13),
(10, 8, 29),
(11, 9, 19),
(12, 9, 26),
(13, 9, 39),
(14, 9, 46),
(15, 48, 1),
(16, 48, 19),
(17, 48, 22),
(18, 48, 30),
(19, 49, 1),
(20, 49, 5),
(21, 49, 6),
(22, 10, 1),
(23, 10, 4),
(24, 51, 19),
(25, 51, 22),
(26, 51, 24),
(27, 52, 19),
(28, 52, 33);

-- --------------------------------------------------------

--
-- Table structure for table `product_group_price`
--

CREATE TABLE `product_group_price` (
  `entityId` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `customerGroupId` int(11) NOT NULL,
  `price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_group_price`
--

INSERT INTO `product_group_price` (`entityId`, `productId`, `customerGroupId`, `price`) VALUES
(1, 9, 1, '1000'),
(2, 9, 2, '1199'),
(9, 6, 1, '14000'),
(10, 6, 2, '13000'),
(88, 9, 5, '855'),
(89, 8, 1, '500'),
(90, 8, 2, '600'),
(91, 8, 5, '1000'),
(95, 7, 1, '1000'),
(96, 7, 2, '900'),
(97, 7, 5, '900'),
(101, 6, 5, '12000'),
(102, 1, 1, '9000'),
(103, 1, 2, '8000'),
(104, 1, 5, '8500');

-- --------------------------------------------------------

--
-- Table structure for table `product_media`
--

CREATE TABLE `product_media` (
  `imageId` int(11) NOT NULL,
  `productId` int(11) DEFAULT NULL,
  `imageName` varchar(150) NOT NULL,
  `label` varchar(50) NOT NULL,
  `small` tinyint(4) NOT NULL DEFAULT 0,
  `thumb` tinyint(4) NOT NULL DEFAULT 0,
  `base` tinyint(4) NOT NULL DEFAULT 0,
  `gallery` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_media`
--

INSERT INTO `product_media` (`imageId`, `productId`, `imageName`, `label`, `small`, `thumb`, `base`, `gallery`) VALUES
(63, 1, '1_63.jfif', 'Mirage Panel Bed', 1, 1, 1, 1),
(64, 6, '6_64.jpg', 'Sofa', 1, 1, 1, 1),
(65, 7, '7_65.jpg', 'Wallace oOffice Chair', 1, 1, 1, 1),
(66, 8, '8_66.jpg', 'Table', 1, 1, 1, 1),
(67, 9, '9_67.jfif', 'Camila Black Office Chair', 1, 1, 1, 1),
(68, 10, '10_68.jpg', 'Morth Shore NightStand', 1, 1, 1, 1),
(69, 48, '48_69.jpg', 'Sage Fabric Large Sofa', 1, 1, 1, 1),
(70, 49, '49_70.jpg', 'Mirage Drawer Drasser', 1, 1, 1, 1),
(75, 51, '51_75.jpg', 'Sleeper Sofa', 1, 1, 1, 1),
(76, 52, '52_76.jpg', 'Nahara Glass Coffee Table', 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shipping_method`
--

CREATE TABLE `shipping_method` (
  `methodId` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `code` varchar(10) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `description` text NOT NULL,
  `status` tinyint(10) NOT NULL,
  `createdDate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shipping_method`
--

INSERT INTO `shipping_method` (`methodId`, `name`, `code`, `amount`, `description`, `status`, `createdDate`) VALUES
(1, 'Express Delivery', 'SHIP101', '300.00', '1 days', 1, '2021-02-17 13:25:04'),
(2, 'Fast Delivery', 'SHIP102', '100.00', '3 days', 1, '2021-02-17 13:27:05'),
(3, 'Regular Delevery', 'SHIP103', '50.00', '5 days', 1, '2021-02-17 13:28:49'),
(4, 'Free Delivery', 'SHIP104', '0.00', '7 days', 1, '2021-02-17 13:29:21');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`);

--
-- Indexes for table `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`attributeId`);

--
-- Indexes for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD PRIMARY KEY (`optionId`),
  ADD KEY `attributeId` (`attributeId`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`brandId`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartId`),
  ADD KEY `customerId` (`customerId`),
  ADD KEY `paymentMethodId` (`paymentMethodId`),
  ADD KEY `shippingMethodId` (`shippingMethodId`);

--
-- Indexes for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD PRIMARY KEY (`cartAddressId`),
  ADD KEY `addressId` (`addressId`),
  ADD KEY `cartId` (`cartId`);

--
-- Indexes for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cartItemId`),
  ADD KEY `cartId` (`cartId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `cms_page`
--
ALTER TABLE `cms_page`
  ADD PRIMARY KEY (`pageId`);

--
-- Indexes for table `config`
--
ALTER TABLE `config`
  ADD PRIMARY KEY (`configId`),
  ADD KEY `groupId` (`groupId`);

--
-- Indexes for table `config_group`
--
ALTER TABLE `config_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`customerId`),
  ADD KEY `customer_ibfk_1` (`groupId`);

--
-- Indexes for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD PRIMARY KEY (`addressId`),
  ADD KEY `customer_address_ibfk_1` (`customerId`);

--
-- Indexes for table `customer_group`
--
ALTER TABLE `customer_group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`orderId`);

--
-- Indexes for table `order_address`
--
ALTER TABLE `order_address`
  ADD PRIMARY KEY (`orderAddressId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`orderItemId`),
  ADD KEY `orderId` (`orderId`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`methodId`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`productId`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productId` (`productId`),
  ADD KEY `categoryId` (`categoryId`);

--
-- Indexes for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD PRIMARY KEY (`entityId`),
  ADD KEY `productId` (`productId`);

--
-- Indexes for table `product_media`
--
ALTER TABLE `product_media`
  ADD PRIMARY KEY (`imageId`),
  ADD KEY `product_media_ibfk_1` (`productId`);

--
-- Indexes for table `shipping_method`
--
ALTER TABLE `shipping_method`
  ADD PRIMARY KEY (`methodId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `attribute`
--
ALTER TABLE `attribute`
  MODIFY `attributeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `attribute_option`
--
ALTER TABLE `attribute_option`
  MODIFY `optionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `brandId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_address`
--
ALTER TABLE `cart_address`
  MODIFY `cartAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cart_item`
--
ALTER TABLE `cart_item`
  MODIFY `cartItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `cms_page`
--
ALTER TABLE `cms_page`
  MODIFY `pageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `config`
--
ALTER TABLE `config`
  MODIFY `configId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `config_group`
--
ALTER TABLE `config_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `customerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customer_address`
--
ALTER TABLE `customer_address`
  MODIFY `addressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `customer_group`
--
ALTER TABLE `customer_group`
  MODIFY `groupId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `orderId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_address`
--
ALTER TABLE `order_address`
  MODIFY `orderAddressId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `orderItemId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `productId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `product_group_price`
--
ALTER TABLE `product_group_price`
  MODIFY `entityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `product_media`
--
ALTER TABLE `product_media`
  MODIFY `imageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `shipping_method`
--
ALTER TABLE `shipping_method`
  MODIFY `methodId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_option`
--
ALTER TABLE `attribute_option`
  ADD CONSTRAINT `attribute_option_ibfk_1` FOREIGN KEY (`attributeId`) REFERENCES `attribute` (`attributeId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`paymentMethodId`) REFERENCES `payment_method` (`methodId`) ON DELETE SET NULL,
  ADD CONSTRAINT `cart_ibfk_3` FOREIGN KEY (`shippingMethodId`) REFERENCES `shipping_method` (`methodId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `cart_address`
--
ALTER TABLE `cart_address`
  ADD CONSTRAINT `cart_address_ibfk_1` FOREIGN KEY (`addressId`) REFERENCES `customer_address` (`addressId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_address_ibfk_2` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cartId`) REFERENCES `cart` (`cartId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `config`
--
ALTER TABLE `config`
  ADD CONSTRAINT `config_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `config_group` (`groupId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`groupId`) REFERENCES `customer_group` (`groupId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `customer_address`
--
ALTER TABLE `customer_address`
  ADD CONSTRAINT `customer_address_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_address`
--
ALTER TABLE `order_address`
  ADD CONSTRAINT `order_address_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`orderId`) REFERENCES `order` (`orderId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_category`
--
ALTER TABLE `product_category`
  ADD CONSTRAINT `product_category_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_category_ibfk_2` FOREIGN KEY (`categoryId`) REFERENCES `category` (`categoryId`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_group_price`
--
ALTER TABLE `product_group_price`
  ADD CONSTRAINT `product_group_price_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product_media`
--
ALTER TABLE `product_media`
  ADD CONSTRAINT `product_media_ibfk_1` FOREIGN KEY (`productId`) REFERENCES `product` (`productId`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
