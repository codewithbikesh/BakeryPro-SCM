-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2023 at 09:54 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `ID` int(4) NOT NULL,
  `AREA_CODE` varchar(10) COLLATE utf8_bin NOT NULL,
  `AREA_NAME` varchar(255) COLLATE utf8_bin NOT NULL,
  `SHIPPING_CHARGE` float(12,2) NOT NULL DEFAULT 0.00,
  `CREATED_BY` varchar(20) COLLATE utf8_bin NOT NULL,
  `CREATED_DATE` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `area`
--

INSERT INTO `area` (`ID`, `AREA_CODE`, `AREA_NAME`, `SHIPPING_CHARGE`, `CREATED_BY`, `CREATED_DATE`) VALUES
(10, 'PKR', 'Pokhara', 0.00, '10', '2023-01-11 11:40 PM'),
(11, 'KTM', 'Kathmandu', 250.00, '1', '2023-01-11 11:38 PM'),
(32, 'MKL', 'Malekhu', 200.00, '1', '2023-01-11 11:35 PM'),
(52, 'NPL', 'Nepalgunj', 0.00, '1', '2023-01-11 11:32 PM'),
(56, 'OKL', 'Okhaldhunga', 0.00, '1', '2023-01-12 00:01 AM');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CATEGORY_ID` int(11) NOT NULL,
  `CATEGORY_NAME` varchar(50) DEFAULT NULL,
  `CATEGORY_DESCRIPTION` varchar(255) NOT NULL,
  `CREATED_DATE` varchar(255) DEFAULT NULL,
  `CREATED_BY` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`CATEGORY_ID`, `CATEGORY_NAME`, `CATEGORY_DESCRIPTION`, `CREATED_DATE`, `CREATED_BY`) VALUES
(1, 'Bread', 'A staple food prepared from a dough of flour and water, usually by baking.', '2023-01-12 21:23 PM', '1'),
(2, 'Cakes', 'A type of (usually) sweet dessert which is baked.', '2023-01-12 21:23 PM', '1'),
(3, 'Bun', 'A type of bread roll, typically filled with savory fillings', '2023-01-12 21:23 PM', '1'),
(4, 'Pastries', 'baked products made from ingredients such as flour, sugar, milk, butter, shortening, baking powder, and eggs.', '2023-01-12 21:23 PM', '1'),
(5, 'Biscuits', 'A flour-based baked and shaped food product.', '2023-01-12 21:23 PM', '1'),
(6, 'Cookies', 'A baked or cooked snack or dessert that is typically small, flat and sweet.', '2023-01-12 21:23 PM', '1'),
(7, 'Doughnuts', 'A type of food made from leavened fried dough.', '2023-01-12 21:23 PM', '1'),
(8, 'Crackers', 'A flat, dry baked biscuit typically made with flour.', '2023-01-12 21:24 PM', '1');

-- --------------------------------------------------------

--
-- Table structure for table `gender_code`
--

CREATE TABLE `gender_code` (
  `GENDER_ID` int(4) NOT NULL,
  `GENDER_NAME` varchar(50) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `gender_code`
--

INSERT INTO `gender_code` (`GENDER_ID`, `GENDER_NAME`) VALUES
(1, 'Male'),
(2, 'Female'),
(3, 'Other');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `INVOICE_ID` int(11) NOT NULL,
  `ORDER_ID` int(11) NOT NULL,
  `RETAILER_ID` int(11) NOT NULL,
  `DISTRIBUTOR_ID` int(11) NOT NULL,
  `TOTAL_AMOUNT` float(12,2) NOT NULL,
  `DISCOUNT` float(12,2) DEFAULT NULL,
  `COMMENTS` text COLLATE utf8_bin DEFAULT NULL,
  `PAYMENT_STATUS` int(11) NOT NULL,
  `PAYMENT_METHOD` varchar(55) COLLATE utf8_bin DEFAULT NULL,
  `SHIPPING_COST` varchar(4) COLLATE utf8_bin DEFAULT NULL,
  `CREATED_DATE` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`INVOICE_ID`, `ORDER_ID`, `RETAILER_ID`, `DISTRIBUTOR_ID`, `TOTAL_AMOUNT`, `DISCOUNT`, `COMMENTS`, `PAYMENT_STATUS`, `PAYMENT_METHOD`, `SHIPPING_COST`, `CREATED_DATE`) VALUES
(2, 1, 37, 34, 2440.00, 40.00, 'hello', 1, 'Paypal', 'N', '2023-01-13 21:56 PM'),
(3, 2, 37, 34, 3000.00, 0.00, 'Test Data', 1, 'Paypal', 'N', '2023-01-14 01:46 AM'),
(6, 8, 37, 40, 2800.00, 0.00, 'test', 1, 'Paypal', 'Y', '2023-01-20 12:01 PM'),
(7, 7, 37, 38, 4000.00, 0.00, 'hello hello', 1, 'Cash On Delivery', 'N', '2023-01-21 02:05 AM'),
(8, 9, 41, 40, 24500.00, 50.00, 'Thank you!!!', 0, 'Cash On Delivery', 'Y', '2023-01-23 23:30 PM'),
(9, 10, 37, 38, 10300.00, 300.00, 'Thank you', 1, 'Cash On Delivery', 'Y', '2023-01-24 21:38 PM'),
(10, 13, 37, 38, 4000.00, 0.00, 'Thank You!', 0, NULL, 'Y', '2023-01-29 19:09 PM'),
(34, 35, 52, 38, 3900.00, 0.00, 'Thank you for your order!', 1, 'Paypal', 'N', '2023-01-31 13:49 PM');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `INVOICE_ITEMS_ID` int(11) NOT NULL,
  `INVOICE_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `QUANTITY` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`INVOICE_ITEMS_ID`, `INVOICE_ID`, `PRODUCT_ID`, `QUANTITY`) VALUES
(8, 2, 1, 2),
(9, 2, 2, 2),
(10, 2, 3, 2),
(11, 2, 14, 2),
(12, 2, 21, 2),
(13, 2, 22, 2),
(14, 2, 25, 3),
(15, 3, 3, 20),
(22, 6, 2, 10),
(23, 6, 10, 10),
(24, 7, 25, 10),
(25, 8, 4, 20),
(26, 8, 8, 15),
(27, 8, 11, 25),
(28, 9, 1, 10),
(29, 9, 2, 10),
(30, 9, 3, 10),
(31, 9, 4, 10),
(32, 9, 10, 10),
(33, 10, 7, 20),
(80, 34, 2, 5),
(81, 34, 3, 6),
(82, 34, 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ORDER_ID` int(11) NOT NULL,
  `RETAILER_ID` int(11) NOT NULL,
  `APPROVED` tinyint(1) NOT NULL DEFAULT 0,
  `STATUS` tinyint(1) NOT NULL DEFAULT 0,
  `TOTAL_AMOUNT` float(12,2) NOT NULL,
  `CREATED_DATE` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ORDER_ID`, `RETAILER_ID`, `APPROVED`, `STATUS`, `TOTAL_AMOUNT`, `CREATED_DATE`) VALUES
(1, 37, 1, 1, 2440.00, '2023-01-12 23:48 AM'),
(2, 37, 1, 1, 3000.00, '2023-01-14 01:45 PM'),
(7, 37, 1, 1, 4000.00, '2023-01-18 23:09 AM'),
(8, 37, 1, 1, 2800.00, '2023-01-20 11:59 AM'),
(9, 41, 1, 1, 24500.00, '2023-01-22 22:26 PM'),
(10, 37, 1, 1, 10300.00, '2023-01-22 22:26 AM'),
(12, 37, 0, 2, 7500.00, '2023-01-26 22:14 AM'),
(13, 37, 1, 1, 4000.00, '2023-01-26 22:16 AM'),
(16, 37, 1, 1, 1800.00, '2023-01-26 22:38 AM'),
(18, 37, 1, 1, 2200.00, '2023-01-26 22:50 AM'),
(19, 41, 0, 2, 17300.00, '2023-01-30 22:56 AM'),
(20, 41, 1, 1, 18000.00, '2023-01-26 23:34 AM'),
(35, 52, 1, 1, 3900.00, '2023-01-31 13:47 PM');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `ORDER_ITEMS_ID` int(11) NOT NULL,
  `ORDER_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `QUANTITY` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`ORDER_ITEMS_ID`, `ORDER_ID`, `PRODUCT_ID`, `QUANTITY`) VALUES
(1, 1, 1, 2),
(2, 1, 2, 2),
(3, 1, 3, 2),
(4, 1, 14, 2),
(5, 1, 21, 2),
(6, 1, 22, 2),
(7, 1, 25, 3),
(8, 2, 3, 20),
(14, 7, 25, 10),
(15, 8, 2, 10),
(16, 8, 10, 10),
(17, 9, 4, 20),
(18, 9, 8, 15),
(19, 9, 11, 25),
(20, 10, 1, 10),
(21, 10, 2, 10),
(22, 10, 3, 10),
(23, 10, 4, 10),
(24, 10, 10, 10),
(26, 12, 24, 25),
(27, 13, 7, 20),
(30, 16, 24, 6),
(32, 18, 1, 22),
(33, 19, 1, 12),
(35, 19, 20, 20),
(36, 19, 23, 22),
(37, 19, 25, 15),
(38, 20, 5, 30),
(72, 35, 2, 5),
(73, 35, 3, 6),
(74, 35, 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `PRODUCT_ID` int(11) NOT NULL,
  `PRODUCT_NAME` varchar(50) DEFAULT NULL,
  `PRODUCT_CODE` varchar(55) NOT NULL,
  `MFD_DATE` date DEFAULT NULL,
  `EXP_DATE` date DEFAULT NULL,
  `DESCRIPTION` varchar(250) NOT NULL,
  `MANAGE_STOCK` varchar(4) NOT NULL,
  `ON_STOCK` varchar(50) NOT NULL DEFAULT 'NA',
  `PRICE` float(12,2) DEFAULT NULL,
  `CATEGORY_ID` int(11) DEFAULT NULL,
  `UNIT_ID` int(11) DEFAULT NULL,
  `CREATED_DATE` varchar(255) NOT NULL,
  `CREATED_BY` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`PRODUCT_ID`, `PRODUCT_NAME`, `PRODUCT_CODE`, `MFD_DATE`, `EXP_DATE`, `DESCRIPTION`, `MANAGE_STOCK`, `ON_STOCK`, `PRICE`, `CATEGORY_ID`, `UNIT_ID`, `CREATED_DATE`, `CREATED_BY`) VALUES
(1, 'Sourdough', 'SOURDOUGH1001', '2023-01-16', '2023-01-31', 'Yummy', 'Y', '25', 100.00, 1, 2, '2023-01-12 22:28 PM', 1),
(2, 'Multigrain', 'MULTIGRAIN1001', '2023-01-16', '2023-01-31', 'Tasty', 'Y', '3', 200.00, 1, 2, '2023-01-12 22:29 PM', 1),
(3, 'Rye Bread', 'RYEBREAD1001', '2023-01-16', '2023-01-31', 'Taste good', 'Y', '10', 150.00, 1, 2, '2023-01-12 22:31 PM', 1),
(4, 'Yellow Cake', 'YELLOWCAKE1001', '2023-01-10', '2023-01-31', 'Tasty', 'Y', '50', 500.00, 2, 1, '2023-01-12 22:35 PM', 1),
(5, 'Pound Cake', 'POUNDCAKE1001', '2023-01-09', '2023-01-31', 'Tasty', 'Y', '5', 600.00, 2, 1, '2023-01-12 22:35 PM', 1),
(6, 'Red Velvet Cake', 'REDVELVETCAKE1001', '2023-01-12', '2023-01-31', 'Yummy', 'Y', '38', 800.00, 2, 1, '2023-01-12 22:35 PM', 1),
(7, 'Plain Bun', 'PLAINBUN1001', '2023-01-11', '2023-01-31', 'Yummy', 'Y', '5', 200.00, 3, 2, '2023-01-12 22:42 PM', 1),
(8, 'Sesame Seed Bun', 'SESAMESEEDBUN1001', '2023-01-10', '2023-01-31', 'Yummy', 'Y', '34', 300.00, 3, 2, '2023-01-12 22:42 PM', 1),
(9, 'Potato Bun', 'POTATOBUN1001', '2023-01-05', '2023-01-31', 'Tasty', 'Y', '40', 200.00, 3, 2, '2023-01-12 22:43 PM', 1),
(10, 'Brown Bread', 'BROWNBREAD1001', '2023-01-06', '2023-01-31', 'Taste good', 'Y', '9', 80.00, 1, 12, '2023-01-12 22:46 PM', 1),
(11, 'Macarons', 'MACARONS1001', '2023-01-07', '2023-01-31', 'Tasty', 'Y', '25', 400.00, 4, 2, '2023-01-12 22:50 PM', 1),
(12, 'Cannoli', 'CANNOLI1001', '2023-01-07', '2023-01-31', 'Yummy', 'Y', '38', 500.00, 4, 2, '2023-01-12 22:51 PM', 1),
(13, 'Pies', 'PIES1001', '2023-01-11', '2023-01-31', 'Yummy', 'Y', '38', 400.00, 4, 2, '2023-01-12 22:53 PM', 1),
(14, 'Sandwich biscuits', 'SANDWICHBISCUITS1001', '2023-01-10', '2023-01-31', 'Tasty', 'Y', '46', 100.00, 5, 12, '2023-01-12 22:56 PM', 1),
(15, 'Digestive biscuits', 'DIGESTIVEBISCUITS1001', '2023-01-16', '2023-01-31', 'Yummy', 'Y', '47', 200.00, 5, 12, '2023-01-12 22:57 PM', 1),
(16, 'Shortbread biscuits', 'SHORTBREADBISCUITS1001', '2023-01-10', '2023-01-31', 'Tasty', 'Y', '38', 200.00, 5, 12, '2023-01-12 22:57 PM', 1),
(17, 'Butter Cookies', 'BUTTERCOOKIES1001', '2023-01-15', '2023-01-31', 'Tasty', 'Y', '46', 200.00, 6, 12, '2023-01-12 23:00 PM', 1),
(18, 'Cake Mix Cookies', 'CAKEMIXCOOKIES1001', '2023-01-15', '2023-01-31', 'Tasty', 'Y', '49', 300.00, 6, 12, '2023-01-12 23:00 PM', 1),
(19, 'Chocolate Chip Cookies', 'CHOCOLATECHIPCOOKIES1001', '2023-01-13', '2023-01-31', 'Tasty', 'Y', '49', 400.00, 6, 12, '2023-01-12 23:01 PM', 1),
(20, 'Yeast Doughnut', 'YEASTDOUGHNUT1001', '2023-01-14', '2023-01-31', 'Tasty', 'Y', '30', 25.00, 7, 2, '2023-01-12 23:02 PM', 1),
(21, 'Jelly Doughnut', 'JELLYDOUGHNUT1001', '2023-01-13', '2023-01-31', 'Yummy', 'Y', '48', 30.00, 7, 2, '2023-01-12 23:02 PM', 1),
(22, 'Cream Doughnut', 'CREAMDOUGHNUT1001', '2023-01-15', '2023-01-31', 'Tasty', 'Y', '47', 40.00, 7, 2, '2023-01-12 23:02 PM', 1),
(23, 'Animal cracker', 'ANIMALCRACKER1001', '2023-01-15', '2023-01-31', 'Yummy', 'Y', '28', 400.00, 8, 12, '2023-01-12 23:05 PM', 1),
(24, 'Cream cracker', 'CREAMCRACKER1001', '2023-01-12', '2023-01-31', 'Yummy', 'Y', '34', 300.00, 8, 12, '2023-01-12 23:06 PM', 1),
(25, 'Cheese cracker', 'CHEESECRACKER1001', '2023-01-10', '2023-01-31', 'Tasty', 'Y', '17', 400.00, 8, 12, '2023-01-12 23:06 PM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE `tbl_countries` (
  `ID` int(11) NOT NULL,
  `COUNTRY_NAME` varchar(55) NOT NULL,
  `COUNTRY_NICENAME` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`ID`, `COUNTRY_NAME`, `COUNTRY_NICENAME`) VALUES
(1, 'AFGHANISTAN', 'Afghanistan'),
(2, 'ALBANIA', 'Albania'),
(3, 'ALGERIA', 'Algeria'),
(4, 'AMERICAN SAMOA', 'American Samoa'),
(5, 'ANDORRA', 'Andorra'),
(6, 'ANGOLA', 'Angola'),
(7, 'ANGUILLA', 'Anguilla'),
(8, 'ANTARCTICA', 'Antarctica'),
(9, 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda'),
(10, 'ARGENTINA', 'Argentina'),
(11, 'ARMENIA', 'Armenia'),
(12, 'ARUBA', 'Aruba'),
(13, 'AUSTRALIA', 'Australia'),
(14, 'AUSTRIA', 'Austria'),
(15, 'AZERBAIJAN', 'Azerbaijan'),
(16, 'BAHAMAS', 'Bahamas'),
(17, 'BAHRAIN', 'Bahrain'),
(18, 'BANGLADESH', 'Bangladesh'),
(19, 'BARBADOS', 'Barbados'),
(20, 'BELARUS', 'Belarus'),
(21, 'BELGIUM', 'Belgium'),
(22, 'BELIZE', 'Belize'),
(23, 'BENIN', 'Benin'),
(24, 'BERMUDA', 'Bermuda'),
(25, 'BHUTAN', 'Bhutan'),
(26, 'BOLIVIA', 'Bolivia'),
(27, 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina'),
(28, 'BOTSWANA', 'Botswana'),
(29, 'BOUVET ISLAND', 'Bouvet Island'),
(30, 'BRAZIL', 'Brazil'),
(31, 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory'),
(32, 'BRUNEI DARUSSALAM', 'Brunei Darussalam'),
(33, 'BULGARIA', 'Bulgaria'),
(34, 'BURKINA FASO', 'Burkina Faso'),
(35, 'BURUNDI', 'Burundi'),
(36, 'CAMBODIA', 'Cambodia'),
(37, 'CAMEROON', 'Cameroon'),
(38, 'CANADA', 'Canada'),
(39, 'CAPE VERDE', 'Cape Verde'),
(40, 'CAYMAN ISLANDS', 'Cayman Islands'),
(41, 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic'),
(42, 'CHAD', 'Chad'),
(43, 'CHILE', 'Chile'),
(44, 'CHINA', 'China'),
(45, 'CHRISTMAS ISLAND', 'Christmas Island'),
(46, 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands'),
(47, 'COLOMBIA', 'Colombia'),
(48, 'COMOROS', 'Comoros'),
(49, 'CONGO', 'Congo'),
(50, 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the'),
(51, 'COOK ISLANDS', 'Cook Islands'),
(52, 'COSTA RICA', 'Costa Rica'),
(53, 'COTE D\'IVOIRE', 'Cote D\'Ivoire'),
(54, 'CROATIA', 'Croatia'),
(55, 'CUBA', 'Cuba'),
(56, 'CYPRUS', 'Cyprus'),
(57, 'CZECH REPUBLIC', 'Czech Republic'),
(58, 'DENMARK', 'Denmark'),
(59, 'DJIBOUTI', 'Djibouti'),
(60, 'DOMINICA', 'Dominica'),
(61, 'DOMINICAN REPUBLIC', 'Dominican Republic'),
(62, 'ECUADOR', 'Ecuador'),
(63, 'EGYPT', 'Egypt'),
(64, 'EL SALVADOR', 'El Salvador'),
(65, 'EQUATORIAL GUINEA', 'Equatorial Guinea'),
(66, 'ERITREA', 'Eritrea'),
(67, 'ESTONIA', 'Estonia'),
(68, 'ETHIOPIA', 'Ethiopia'),
(69, 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)'),
(70, 'FAROE ISLANDS', 'Faroe Islands'),
(71, 'FIJI', 'Fiji'),
(72, 'FINLAND', 'Finland'),
(73, 'FRANCE', 'France'),
(74, 'FRENCH GUIANA', 'French Guiana'),
(75, 'FRENCH POLYNESIA', 'French Polynesia'),
(76, 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories'),
(77, 'GABON', 'Gabon'),
(78, 'GAMBIA', 'Gambia'),
(79, 'GEORGIA', 'Georgia'),
(80, 'GERMANY', 'Germany'),
(81, 'GHANA', 'Ghana'),
(82, 'GIBRALTAR', 'Gibraltar'),
(83, 'GREECE', 'Greece'),
(84, 'GREENLAND', 'Greenland'),
(85, 'GRENADA', 'Grenada'),
(86, 'GUADELOUPE', 'Guadeloupe'),
(87, 'GUAM', 'Guam'),
(88, 'GUATEMALA', 'Guatemala'),
(89, 'GUINEA', 'Guinea'),
(90, 'GUINEA-BISSAU', 'Guinea-Bissau'),
(91, 'GUYANA', 'Guyana'),
(92, 'HAITI', 'Haiti'),
(93, 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands'),
(94, 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)'),
(95, 'HONDURAS', 'Honduras'),
(96, 'HONG KONG', 'Hong Kong'),
(97, 'HUNGARY', 'Hungary'),
(98, 'ICELAND', 'Iceland'),
(99, 'INDIA', 'India'),
(100, 'INDONESIA', 'Indonesia'),
(101, 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of'),
(102, 'IRAQ', 'Iraq'),
(103, 'IRELAND', 'Ireland'),
(104, 'ISRAEL', 'Israel'),
(105, 'ITALY', 'Italy'),
(106, 'JAMAICA', 'Jamaica'),
(107, 'JAPAN', 'Japan'),
(108, 'JORDAN', 'Jordan'),
(109, 'KAZAKHSTAN', 'Kazakhstan'),
(110, 'KENYA', 'Kenya'),
(111, 'KIRIBATI', 'Kiribati'),
(112, 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of'),
(113, 'KOREA, REPUBLIC OF', 'Korea, Republic of'),
(114, 'KUWAIT', 'Kuwait'),
(115, 'KYRGYZSTAN', 'Kyrgyzstan'),
(116, 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic'),
(117, 'LATVIA', 'Latvia'),
(118, 'LEBANON', 'Lebanon'),
(119, 'LESOTHO', 'Lesotho'),
(120, 'LIBERIA', 'Liberia'),
(121, 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya'),
(122, 'LIECHTENSTEIN', 'Liechtenstein'),
(123, 'LITHUANIA', 'Lithuania'),
(124, 'LUXEMBOURG', 'Luxembourg'),
(125, 'MACAO', 'Macao'),
(126, 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of'),
(127, 'MADAGASCAR', 'Madagascar'),
(128, 'MALAWI', 'Malawi'),
(129, 'MALAYSIA', 'Malaysia'),
(130, 'MALDIVES', 'Maldives'),
(131, 'MALI', 'Mali'),
(132, 'MALTA', 'Malta'),
(133, 'MARSHALL ISLANDS', 'Marshall Islands'),
(134, 'MARTINIQUE', 'Martinique'),
(135, 'MAURITANIA', 'Mauritania'),
(136, 'MAURITIUS', 'Mauritius'),
(137, 'MAYOTTE', 'Mayotte'),
(138, 'MEXICO', 'Mexico'),
(139, 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of'),
(140, 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of'),
(141, 'MONACO', 'Monaco'),
(142, 'MONGOLIA', 'Mongolia'),
(143, 'MONTSERRAT', 'Montserrat'),
(144, 'MOROCCO', 'Morocco'),
(145, 'MOZAMBIQUE', 'Mozambique'),
(146, 'MYANMAR', 'Myanmar'),
(147, 'NAMIBIA', 'Namibia'),
(148, 'NAURU', 'Nauru'),
(149, 'NEPAL', 'Nepal'),
(150, 'NETHERLANDS', 'Netherlands'),
(151, 'NETHERLANDS ANTILLES', 'Netherlands Antilles'),
(152, 'NEW CALEDONIA', 'New Caledonia'),
(153, 'NEW ZEALAND', 'New Zealand'),
(154, 'NICARAGUA', 'Nicaragua'),
(155, 'NIGER', 'Niger'),
(156, 'NIGERIA', 'Nigeria'),
(157, 'NIUE', 'Niue'),
(158, 'NORFOLK ISLAND', 'Norfolk Island'),
(159, 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands'),
(160, 'NORWAY', 'Norway'),
(161, 'OMAN', 'Oman'),
(162, 'PAKISTAN', 'Pakistan'),
(163, 'PALAU', 'Palau'),
(164, 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied'),
(165, 'PANAMA', 'Panama'),
(166, 'PAPUA NEW GUINEA', 'Papua New Guinea'),
(167, 'PARAGUAY', 'Paraguay'),
(168, 'PERU', 'Peru'),
(169, 'PHILIPPINES', 'Philippines'),
(170, 'PITCAIRN', 'Pitcairn'),
(171, 'POLAND', 'Poland'),
(172, 'PORTUGAL', 'Portugal'),
(173, 'PUERTO RICO', 'Puerto Rico'),
(174, 'QATAR', 'Qatar'),
(175, 'REUNION', 'Reunion'),
(176, 'ROMANIA', 'Romania'),
(177, 'RUSSIAN FEDERATION', 'Russian Federation'),
(178, 'RWANDA', 'Rwanda'),
(179, 'SAINT HELENA', 'Saint Helena'),
(180, 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis'),
(181, 'SAINT LUCIA', 'Saint Lucia'),
(182, 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon'),
(183, 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines'),
(184, 'SAMOA', 'Samoa'),
(185, 'SAN MARINO', 'San Marino'),
(186, 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe'),
(187, 'SAUDI ARABIA', 'Saudi Arabia'),
(188, 'SENEGAL', 'Senegal'),
(189, 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro'),
(190, 'SEYCHELLES', 'Seychelles'),
(191, 'SIERRA LEONE', 'Sierra Leone'),
(192, 'SINGAPORE', 'Singapore'),
(193, 'SLOVAKIA', 'Slovakia'),
(194, 'SLOVENIA', 'Slovenia'),
(195, 'SOLOMON ISLANDS', 'Solomon Islands'),
(196, 'SOMALIA', 'Somalia'),
(197, 'SOUTH AFRICA', 'South Africa'),
(198, 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands'),
(199, 'SPAIN', 'Spain'),
(200, 'SRI LANKA', 'Sri Lanka'),
(201, 'SUDAN', 'Sudan'),
(202, 'SURINAME', 'Suriname'),
(203, 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen'),
(204, 'SWAZILAND', 'Swaziland'),
(205, 'SWEDEN', 'Sweden'),
(206, 'SWITZERLAND', 'Switzerland'),
(207, 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic'),
(208, 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China'),
(209, 'TAJIKISTAN', 'Tajikistan'),
(210, 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of'),
(211, 'THAILAND', 'Thailand'),
(212, 'TIMOR-LESTE', 'Timor-Leste'),
(213, 'TOGO', 'Togo'),
(214, 'TOKELAU', 'Tokelau'),
(215, 'TONGA', 'Tonga'),
(216, 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago'),
(217, 'TUNISIA', 'Tunisia'),
(218, 'TURKEY', 'Turkey'),
(219, 'TURKMENISTAN', 'Turkmenistan'),
(220, 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands'),
(221, 'TUVALU', 'Tuvalu'),
(222, 'UGANDA', 'Uganda'),
(223, 'UKRAINE', 'Ukraine'),
(224, 'UNITED ARAB EMIRATES', 'United Arab Emirates'),
(225, 'UNITED KINGDOM', 'United Kingdom'),
(226, 'UNITED STATES', 'United States'),
(227, 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands'),
(228, 'URUGUAY', 'Uruguay'),
(229, 'UZBEKISTAN', 'Uzbekistan'),
(230, 'VANUATU', 'Vanuatu'),
(231, 'VENEZUELA', 'Venezuela'),
(232, 'VIET NAM', 'Viet Nam'),
(233, 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British'),
(234, 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.'),
(235, 'WALLIS AND FUTUNA', 'Wallis and Futuna'),
(236, 'WESTERN SAHARA', 'Western Sahara'),
(237, 'YEMEN', 'Yemen'),
(238, 'ZAMBIA', 'Zambia'),
(239, 'ZIMBABWE', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `type`
--

CREATE TABLE `type` (
  `TYPE_ID` int(11) NOT NULL,
  `TYPE` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `type`
--

INSERT INTO `type` (`TYPE_ID`, `TYPE`) VALUES
(1, 'Admin'),
(2, 'Manufacturer'),
(3, 'Retailer'),
(4, 'Distributor');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `UNIT_ID` int(11) NOT NULL,
  `UNIT_NAME` varchar(50) COLLATE utf8_bin NOT NULL,
  `UNIT_DESCRIPTION` varchar(255) COLLATE utf8_bin NOT NULL,
  `CREATED_DATE` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `CREATED_BY` varchar(55) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`UNIT_ID`, `UNIT_NAME`, `UNIT_DESCRIPTION`, `CREATED_DATE`, `CREATED_BY`) VALUES
(1, 'KG', 'Kilogram', '2022-12-22 11:01 AM', '1'),
(2, 'PCS', 'Pieces', '2022-12-22 11:03 PM', '1'),
(7, 'LTR', 'Litre', '2022-12-22 06:50 PM', '1'),
(12, 'PCKT', 'Packet', '2023-01-12 22:46 AM', '1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `F_NAME` varchar(50) NOT NULL,
  `L_NAME` varchar(50) NOT NULL,
  `GENDER_ID` int(12) DEFAULT NULL,
  `EMAIL` varchar(50) NOT NULL,
  `PHONE_NUMBER` varchar(12) NOT NULL,
  `STREET_ADDRESS` varchar(55) NOT NULL,
  `COMPANY_NAME` varchar(255) DEFAULT NULL,
  `STATE` varchar(255) DEFAULT NULL,
  `POSTCODE` varchar(55) DEFAULT NULL,
  `COUNTRY_ID` int(12) DEFAULT NULL,
  `VAT_NUMBER` varchar(255) DEFAULT NULL,
  `TERMS` varchar(4) DEFAULT NULL,
  `USERNAME` varchar(50) DEFAULT NULL,
  `PASSWORD` varchar(50) DEFAULT NULL,
  `IMAGE_PATH` varchar(55) NOT NULL,
  `TYPE_ID` int(11) DEFAULT NULL,
  `AREA_ID` int(12) DEFAULT NULL,
  `TSV` varchar(4) NOT NULL,
  `VERIFIED` varchar(4) NOT NULL,
  `CREATED_DATE` varchar(255) NOT NULL,
  `CREATED_BY` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `F_NAME`, `L_NAME`, `GENDER_ID`, `EMAIL`, `PHONE_NUMBER`, `STREET_ADDRESS`, `COMPANY_NAME`, `STATE`, `POSTCODE`, `COUNTRY_ID`, `VAT_NUMBER`, `TERMS`, `USERNAME`, `PASSWORD`, `IMAGE_PATH`, `TYPE_ID`, `AREA_ID`, `TSV`, `VERIFIED`, `CREATED_DATE`, `CREATED_BY`) VALUES
(1, 'Admin', 'Account', 1, 'janampandey2@gmail.com', '9866077949', 'Malekhu, Dhading', NULL, NULL, NULL, NULL, NULL, NULL, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Janam1.jpg', 1, NULL, 'N', '1', '2022-06-28 15:02 PM', 0),
(34, 'Distributor', 'User', 1, 'distributor@gmail.com', '9823389283', 'Malekhu, Dhading', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 4, NULL, 'N', '1', '2022-12-22 06:03 PM', 0),
(37, 'Kushal', 'Bhattarai', NULL, 'kushalbhattarai277@gmail.com', '9813074888', 'Putalisadak chowk', 'IT Business Service Pvt. Ltd', 'Bagmati', '44600', 149, '16235512', 'Y', 'kushal', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 3, 11, 'N', '1', '2023-01-11 10:54 AM', 0),
(38, 'Dipak', 'Nyaupane', 1, 'nyaupane04@gmail.com', '9861939061', 'Nepaltar, Tarkeshwor, Kathmandu', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 4, NULL, 'N', '1', '2023-01-18 01:06 AM', 0),
(39, 'Jeevan', 'Pandey', NULL, 'zeeeone143k@gmail.com', '98236168201', '', NULL, NULL, NULL, NULL, NULL, NULL, 'jeevan', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 2, NULL, 'N', '1', '2023-01-18 23:16 PM', 0),
(40, 'Sanjay', 'Acharya', 1, 'sanjay1234@gmail.com', '2737623872', 'Dang', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 4, NULL, 'N', '1', '2023-01-20 11:04 AM', 0),
(41, 'Prajwal ', 'Acharya', NULL, 'prajwal@gmail.com', '9861256121', 'Malekhu, Dhading', 'No company yet', 'Bagmati', '44600', 149, 'N/A', 'Y', 'prajwal', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'Prajwal 41.jpg', 3, 32, 'N', '1', '2023-01-22 22:25 PM', 0),
(43, 'Jack', 'Pandey', NULL, 'jack@gmail.com', '9823677112', '', NULL, NULL, NULL, NULL, NULL, NULL, 'jack', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', 2, NULL, 'N', '1', '2023-01-28 21:58 PM', 0),
(44, 'Sandhya', 'Adhikari', NULL, 'sandhyaadhikari976@gmail.com', '9841093320', 'Dang', '', 'Bagmati', '44600', 149, '', 'Y', 'sandhya', 'f3417c26b9118b41bb2ed053ef9003effc0de721', '', 3, 11, 'N', '1', '2023-01-28 22:33 PM', 0),
(52, 'Janam', 'Pandey', NULL, 'itbs.imerp3@gmail.com', '9866077949', 'Balaju', '', 'Bagmati', '44600', 149, '', 'Y', 'itbsjanam', 'd24712c863c39f44ffda468a1f311831f62c9536', '', 3, 11, 'N', '1', '2023-01-31 13:45 PM', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`CATEGORY_ID`);

--
-- Indexes for table `gender_code`
--
ALTER TABLE `gender_code`
  ADD PRIMARY KEY (`GENDER_ID`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`INVOICE_ID`),
  ADD KEY `invoice_ibfk_1` (`ORDER_ID`),
  ADD KEY `invoice_ibfk_2` (`RETAILER_ID`),
  ADD KEY `invoice_ibfk_3` (`DISTRIBUTOR_ID`);

--
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD PRIMARY KEY (`INVOICE_ITEMS_ID`),
  ADD KEY `invoice_items_ibfk_1` (`INVOICE_ID`),
  ADD KEY `invoice_items_ibfk_2` (`PRODUCT_ID`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ORDER_ID`),
  ADD KEY `orders_ibfk_1` (`RETAILER_ID`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`ORDER_ITEMS_ID`),
  ADD KEY `orders_items_ibfk_1` (`ORDER_ID`),
  ADD KEY `orders_items_ibfk_2` (`PRODUCT_ID`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`PRODUCT_ID`),
  ADD KEY `CATEGORY_ID` (`CATEGORY_ID`),
  ADD KEY `unit_ibfk_1` (`UNIT_ID`);

--
-- Indexes for table `tbl_countries`
--
ALTER TABLE `tbl_countries`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `type`
--
ALTER TABLE `type`
  ADD PRIMARY KEY (`TYPE_ID`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`UNIT_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `usertype` (`TYPE_ID`),
  ADD KEY `area_ibfk_1` (`AREA_ID`),
  ADD KEY `gender_ibfk_1` (`GENDER_ID`),
  ADD KEY `country` (`COUNTRY_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `CATEGORY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `gender_code`
--
ALTER TABLE `gender_code`
  MODIFY `GENDER_ID` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `INVOICE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `INVOICE_ITEMS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `ORDER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `ORDER_ITEMS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `PRODUCT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `UNIT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `invoices`
--
ALTER TABLE `invoices`
  ADD CONSTRAINT `distributor_ibfk` FOREIGN KEY (`DISTRIBUTOR_ID`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `order_ibfk` FOREIGN KEY (`ORDER_ID`) REFERENCES `orders` (`ORDER_ID`),
  ADD CONSTRAINT `retailer_ibfk` FOREIGN KEY (`RETAILER_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `invoice_items`
--
ALTER TABLE `invoice_items`
  ADD CONSTRAINT `invoice_items_ibfk_1` FOREIGN KEY (`INVOICE_ID`) REFERENCES `invoices` (`INVOICE_ID`) ON UPDATE CASCADE,
  ADD CONSTRAINT `invoice_items_ibfk_2` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `product` (`PRODUCT_ID`) ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`RETAILER_ID`) REFERENCES `users` (`ID`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `orders_items_ibfk_1` FOREIGN KEY (`ORDER_ID`) REFERENCES `orders` (`ORDER_ID`),
  ADD CONSTRAINT `orders_items_ibfk_2` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `product` (`PRODUCT_ID`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`CATEGORY_ID`) REFERENCES `category` (`CATEGORY_ID`),
  ADD CONSTRAINT `unit_ibfk_1` FOREIGN KEY (`UNIT_ID`) REFERENCES `unit` (`UNIT_ID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `area_ibfk_1` FOREIGN KEY (`AREA_ID`) REFERENCES `area` (`ID`),
  ADD CONSTRAINT `country` FOREIGN KEY (`COUNTRY_ID`) REFERENCES `tbl_countries` (`ID`),
  ADD CONSTRAINT `gender_ibfk_1` FOREIGN KEY (`GENDER_ID`) REFERENCES `gender_code` (`GENDER_ID`),
  ADD CONSTRAINT `usertype` FOREIGN KEY (`TYPE_ID`) REFERENCES `type` (`TYPE_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
