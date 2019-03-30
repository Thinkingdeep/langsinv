-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 30, 2019 at 02:14 PM
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
-- Database: `new_langas_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id_client` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `id_client_type` int(11) NOT NULL,
  PRIMARY KEY (`id_client`),
  KEY `fk_clients_client_types1_idx` (`id_client_type`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id_client`, `name`, `address`, `telephone`, `email`, `id_client_type`) VALUES
(1, 'GIFT EMMANUEL', 'KOBOKO', '0784156404', 'aluanuel@gmail.com', 1),
(2, 'SABOTE MOSES', 'KOBOKO', '07895636728', 'mello@gmail.com', 1),
(3, 'EZATI JOSEPH', 'CAMTECH', '0789652788', 'josephezati@gmail.com', 1),
(4, 'OTIM BENJAMIN', 'MBARARA', '0754324567', 'otim@gmail.com', 2),
(5, 'ALUA EMMANUEL', 'KAMPALA', '0782497483', 'alua@gmail.com', 2),
(6, 'DAPHNE RONARD', 'EYIT', '0789345612', 'daphne@gmail.com', 2),
(9, 'EJOYI PHILLIP', 'KAMPALA', '0784156404', 'aluanuel@gmail.com', 1),
(10, 'MUHUMUZA DERRICK', 'SHEEMA', '0704561897', 'derrick@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `client_orders`
--

DROP TABLE IF EXISTS `client_orders`;
CREATE TABLE IF NOT EXISTS `client_orders` (
  `id_client_order` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_status` varchar(15) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  PRIMARY KEY (`id_client_order`),
  KEY `fk_client_orders_clients1_idx` (`id_client`),
  KEY `fk_client_orders_stock1_idx` (`id_stock`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_orders`
--

INSERT INTO `client_orders` (`id_client_order`, `order_date`, `order_status`, `id_client`, `id_stock`) VALUES
(1, '2019-03-27 05:51:45', 'PAID', 1, 1),
(2, '2019-03-27 06:04:39', 'PAID', 3, 3),
(3, '2019-03-27 06:11:08', 'PAID', 2, 5),
(4, '2019-03-27 12:01:41', 'PAID', 1, 2),
(5, '2019-03-27 17:02:43', 'PAID', 2, 6),
(6, '2019-03-27 19:45:26', 'PAID', 1, 4),
(7, '2019-03-28 22:02:28', 'PAID', 9, 2),
(8, '2019-03-28 22:11:51', 'PAID', 2, 1),
(9, '2019-03-29 01:27:16', 'PAID', 2, 3),
(10, '2019-03-29 01:35:36', 'PAID', 9, 4),
(11, '2019-03-29 01:49:53', 'PAID', 10, 6),
(12, '2019-03-29 01:52:47', 'PAID', 2, 5),
(13, '2019-03-29 01:57:11', 'PAID', 9, 7),
(14, '2019-03-29 10:13:22', 'PAID', 9, 8),
(15, '2019-03-29 15:46:17', 'PAID', 10, 9);

-- --------------------------------------------------------

--
-- Table structure for table `client_types`
--

DROP TABLE IF EXISTS `client_types`;
CREATE TABLE IF NOT EXISTS `client_types` (
  `id_client_type` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_client_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client_types`
--

INSERT INTO `client_types` (`id_client_type`, `type_name`) VALUES
(1, 'CUSTOMER'),
(2, 'SUPPLIER');

-- --------------------------------------------------------

--
-- Table structure for table `company_accounts`
--

DROP TABLE IF EXISTS `company_accounts`;
CREATE TABLE IF NOT EXISTS `company_accounts` (
  `id_company_account` int(11) NOT NULL AUTO_INCREMENT,
  `company_name` varchar(45) NOT NULL,
  `company_address` varchar(45) NOT NULL,
  `company_telephone` varchar(45) NOT NULL,
  `company_email` varchar(45) DEFAULT NULL,
  `company_website` varchar(45) DEFAULT NULL,
  `company_join_date` datetime NOT NULL,
  PRIMARY KEY (`id_company_account`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_accounts`
--

INSERT INTO `company_accounts` (`id_company_account`, `company_name`, `company_address`, `company_telephone`, `company_email`, `company_website`, `company_join_date`) VALUES
(1, 'JUST THINK INNOVATION', 'ARUA, UGANDA', '+256784156404', 'justthinkinnovation@gmail.com', 'justthinkinnovation.net', '2019-03-28 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expenditures`
--

DROP TABLE IF EXISTS `expenditures`;
CREATE TABLE IF NOT EXISTS `expenditures` (
  `id_expenditure` int(11) NOT NULL AUTO_INCREMENT,
  `id_expenditure_source` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  `expense_amount` decimal(15,2) NOT NULL,
  `expense_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_expenditure`),
  KEY `fk_expenditures_expenditure_sources1_idx` (`id_expenditure_source`),
  KEY `expenditures_ibfk_1` (`id_stock`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenditure_sources`
--

DROP TABLE IF EXISTS `expenditure_sources`;
CREATE TABLE IF NOT EXISTS `expenditure_sources` (
  `id_expenditure_source` int(11) NOT NULL AUTO_INCREMENT,
  `expenditure_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_expenditure_source`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenditure_sources`
--

INSERT INTO `expenditure_sources` (`id_expenditure_source`, `expenditure_name`) VALUES
(1, 'Repairs'),
(2, 'Fuel');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

DROP TABLE IF EXISTS `incomes`;
CREATE TABLE IF NOT EXISTS `incomes` (
  `id_income` int(11) NOT NULL AUTO_INCREMENT,
  `id_income_source` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `income_amount` decimal(15,2) NOT NULL,
  `income_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_income`),
  KEY `fk_incomes_income_sources1_idx` (`id_income_source`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id_income`, `id_income_source`, `id_client`, `income_amount`, `income_date`) VALUES
(1, 2, 9, '200000.00', '2019-03-30 08:51:56');

-- --------------------------------------------------------

--
-- Table structure for table `income_sources`
--

DROP TABLE IF EXISTS `income_sources`;
CREATE TABLE IF NOT EXISTS `income_sources` (
  `id_income_source` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_income_source`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income_sources`
--

INSERT INTO `income_sources` (`id_income_source`, `source_name`) VALUES
(1, 'Fine'),
(2, 'Pension');

-- --------------------------------------------------------

--
-- Table structure for table `license`
--

DROP TABLE IF EXISTS `license`;
CREATE TABLE IF NOT EXISTS `license` (
  `id_license` int(11) NOT NULL AUTO_INCREMENT,
  `license_amount` decimal(2,0) NOT NULL,
  `license_start_date` datetime NOT NULL,
  `license_end_date` datetime NOT NULL,
  `id_company_account` int(11) NOT NULL,
  PRIMARY KEY (`id_license`),
  KEY `fk_license_company_accounts1_idx` (`id_company_account`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
CREATE TABLE IF NOT EXISTS `payments` (
  `id_payment` int(11) NOT NULL AUTO_INCREMENT,
  `id_stock` int(11) NOT NULL,
  `id_stock_price_type` int(11) NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL,
  `payment_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_receipt` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_payment`),
  KEY `payments_ibfk_1` (`id_stock`),
  KEY `payments_ibfk_2` (`id_stock_price_type`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id_payment`, `id_stock`, `id_stock_price_type`, `payment_amount`, `payment_date`, `payment_receipt`) VALUES
(1, 1, 1, '15000000.00', '2019-03-28 06:53:20', 1001),
(2, 2, 1, '1800000.00', '2019-03-28 06:57:25', 1002),
(3, 2, 2, '2800000.00', '2019-03-28 22:02:28', 1003),
(4, 2, 1, '200000.00', '2019-03-28 07:11:19', 1004),
(5, 1, 2, '15000000.00', '2019-03-28 22:11:51', 1004),
(6, 3, 1, '23000000.00', '2019-03-28 07:24:26', 1006),
(7, 3, 2, '30000000.00', '2019-03-29 01:27:17', 1007),
(8, 4, 1, '5800000.00', '2019-03-28 10:34:36', 1008),
(9, 4, 2, '7000000.00', '2019-03-29 01:35:36', 1009),
(10, 5, 1, '5000000.00', '2019-03-28 10:43:57', 1010),
(11, 6, 1, '23000000.00', '2019-03-28 10:47:07', 1011),
(12, 6, 2, '25000000.00', '2019-03-29 01:49:53', 1012),
(13, 5, 2, '7000000.00', '2019-03-29 01:52:47', 1013),
(14, 7, 1, '18000000.00', '2019-03-28 10:56:14', 1014),
(15, 7, 2, '21000000.00', '2019-03-29 01:57:11', 1015),
(16, 8, 1, '17000000.00', '2019-03-29 07:03:26', 1016),
(17, 9, 1, '7000000.00', '2019-03-29 07:11:29', 1017),
(18, 8, 2, '20000000.00', '2019-03-29 10:13:22', 1018),
(19, 9, 2, '12000000.00', '2019-03-29 15:46:17', 1019),
(20, 10, 1, '4000000.00', '2019-03-30 05:14:31', 1020),
(21, 11, 1, '4500000.00', '2019-03-30 05:47:08', 1021),
(22, 9, 1, '1000000.00', '2019-03-30 08:05:37', 1022),
(23, 8, 1, '2000000.00', '2019-03-30 09:46:35', 1023),
(24, 10, 1, '2000000.00', '2019-03-30 01:34:51', 1024);

-- --------------------------------------------------------

--
-- Table structure for table `payment_schedules`
--

DROP TABLE IF EXISTS `payment_schedules`;
CREATE TABLE IF NOT EXISTS `payment_schedules` (
  `id_payment_schedule` int(11) NOT NULL AUTO_INCREMENT,
  `id_stock` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `payment_date` date NOT NULL,
  `payment_amount` decimal(15,2) NOT NULL,
  PRIMARY KEY (`id_payment_schedule`),
  KEY `id_stock` (`id_stock`),
  KEY `id_client` (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `id_stock` int(11) NOT NULL AUTO_INCREMENT,
  `chasis_number` varchar(45) NOT NULL,
  `engine_number` varchar(45) NOT NULL,
  `plate_number` varchar(45) DEFAULT NULL,
  `purchase_date` date NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_stock_color` int(11) NOT NULL,
  `id_stock_name` int(11) NOT NULL,
  `id_stock_type` int(11) NOT NULL,
  `stock_status` varchar(20) NOT NULL,
  PRIMARY KEY (`id_stock`),
  KEY `fk_stock_stock_color_idx` (`id_stock_color`),
  KEY `fk_stock_stock_name1_idx` (`id_stock_name`),
  KEY `fk_stock_stock_type1_idx` (`id_stock_type`),
  KEY `stock_ibfk_1` (`id_client`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `chasis_number`, `engine_number`, `plate_number`, `purchase_date`, `id_client`, `id_stock_color`, `id_stock_name`, `id_stock_type`, `stock_status`) VALUES
(1, 'RV4538967', '435H636892', 'UBA900P', '2019-03-28', 2, 2, 1, 1, 'SOLD'),
(2, 'X21546G536', '536GEY6091', 'UAB237K', '2019-03-27', 9, 4, 2, 1, 'SOLD'),
(3, 'BZ54660900', '63789H5367', 'UAS340G', '2019-03-28', 2, 3, 4, 1, 'SOLD'),
(4, 'RV4562789', '546G5369', 'UAT536L', '2019-03-28', 9, 4, 3, 1, 'SOLD'),
(5, 'EL5460278', '546HY663', 'UAP670Y', '2019-03-28', 2, 1, 5, 1, 'SOLD'),
(6, 'C340896789', '5664890H8', 'UBC456L', '2019-03-28', 10, 4, 4, 1, 'SOLD'),
(7, 'X204090897', '5647829001', 'UBA674A', '2019-03-28', 9, 2, 2, 1, 'SOLD'),
(8, 'C350267190', '536HG5626', 'UAZ987X', '2019-03-28', 9, 4, 4, 1, 'SOLD'),
(9, 'X20546H6367', '53H6536901', 'UAT456G', '2019-03-29', 10, 2, 2, 1, 'SOLD'),
(10, 'X20178908', '536T67780', 'UAX661B', '2019-03-30', 6, 4, 2, 2, 'NOT SOLD'),
(11, 'EF54681901', '53618719G', 'UAS678Y', '2019-03-30', 6, 4, 5, 2, 'NOT SOLD');

-- --------------------------------------------------------

--
-- Table structure for table `stock_color`
--

DROP TABLE IF EXISTS `stock_color`;
CREATE TABLE IF NOT EXISTS `stock_color` (
  `id_stock_color` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_stock_color`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_color`
--

INSERT INTO `stock_color` (`id_stock_color`, `color_name`) VALUES
(1, 'MAROON'),
(2, 'GOLD'),
(3, 'DEEP BLUE'),
(4, 'WHITE');

-- --------------------------------------------------------

--
-- Table structure for table `stock_name`
--

DROP TABLE IF EXISTS `stock_name`;
CREATE TABLE IF NOT EXISTS `stock_name` (
  `id_stock_name` int(11) NOT NULL AUTO_INCREMENT,
  `stock_make` varchar(45) NOT NULL,
  `stock_model` varchar(45) NOT NULL,
  `stock_manufacturer` varchar(45) NOT NULL,
  PRIMARY KEY (`id_stock_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_name`
--

INSERT INTO `stock_name` (`id_stock_name`, `stock_make`, `stock_model`, `stock_manufacturer`) VALUES
(1, 'RAV4', '2010', 'TOYOTA'),
(2, 'PREMIO', 'X20', 'TOYOTA'),
(3, 'RAV4', '2015', 'TOYOTA'),
(4, 'BENZ', 'C350', 'FORD'),
(5, 'ISUZU ELF', '350', 'ISUZU');

-- --------------------------------------------------------

--
-- Table structure for table `stock_prices`
--

DROP TABLE IF EXISTS `stock_prices`;
CREATE TABLE IF NOT EXISTS `stock_prices` (
  `id_stock_price` int(11) NOT NULL AUTO_INCREMENT,
  `stock_price` decimal(60,2) NOT NULL,
  `occurred_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_stock_price_type` int(11) NOT NULL,
  `id_stock` int(11) NOT NULL,
  PRIMARY KEY (`id_stock_price`),
  KEY `fk_stock_prices_stock_price_types1_idx` (`id_stock_price_type`),
  KEY `fk_stock_prices_stock1_idx` (`id_stock`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_prices`
--

INSERT INTO `stock_prices` (`id_stock_price`, `stock_price`, `occurred_on`, `id_stock_price_type`, `id_stock`) VALUES
(1, '15000000.00', '2019-03-28 06:53:19', 1, 1),
(2, '17000000.00', '2019-03-28 21:56:20', 2, 1),
(3, '2000000.00', '2019-03-28 06:57:24', 1, 2),
(4, '3000000.00', '2019-03-28 21:58:40', 2, 2),
(5, '32000000.00', '2019-03-28 07:24:26', 1, 3),
(6, '34000000.00', '2019-03-29 01:26:35', 2, 3),
(7, '6000000.00', '2019-03-28 10:34:36', 1, 4),
(8, '7500000.00', '2019-03-29 01:34:58', 2, 4),
(9, '5600000.00', '2019-03-28 10:43:57', 1, 5),
(10, '7000000.00', '2019-03-29 01:44:15', 2, 5),
(11, '24000000.00', '2019-03-28 10:47:07', 1, 6),
(12, '26000000.00', '2019-03-29 01:48:23', 2, 6),
(13, '20000000.00', '2019-03-28 10:56:14', 1, 7),
(14, '22000000.00', '2019-03-29 01:56:33', 2, 7),
(15, '19500000.00', '2019-03-29 07:03:26', 1, 8),
(16, '21000000.00', '2019-03-29 10:06:15', 2, 8),
(17, '8000000.00', '2019-03-29 07:11:29', 1, 9),
(18, '12000000.00', '2019-03-29 10:12:42', 2, 9),
(19, '6000000.00', '2019-03-30 05:14:31', 1, 10),
(20, '7500000.00', '2019-03-30 08:15:01', 2, 10),
(21, '5000000.00', '2019-03-30 05:47:08', 1, 11),
(22, '6750000.00', '2019-03-30 08:47:27', 2, 11);

-- --------------------------------------------------------

--
-- Table structure for table `stock_price_types`
--

DROP TABLE IF EXISTS `stock_price_types`;
CREATE TABLE IF NOT EXISTS `stock_price_types` (
  `id_stock_price_type` int(11) NOT NULL AUTO_INCREMENT,
  `price_type` varchar(45) NOT NULL,
  PRIMARY KEY (`id_stock_price_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_price_types`
--

INSERT INTO `stock_price_types` (`id_stock_price_type`, `price_type`) VALUES
(1, 'PURCHASE'),
(2, 'SALE');

-- --------------------------------------------------------

--
-- Table structure for table `stock_type`
--

DROP TABLE IF EXISTS `stock_type`;
CREATE TABLE IF NOT EXISTS `stock_type` (
  `id_stock_type` int(11) NOT NULL AUTO_INCREMENT,
  `stock_type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_stock_type`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_type`
--

INSERT INTO `stock_type` (`id_stock_type`, `stock_type_name`) VALUES
(1, 'NEW'),
(2, 'USED');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `user_address` varchar(45) NOT NULL,
  `telephone` varchar(45) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `usertype` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `user_password` varchar(45) NOT NULL,
  `id_company_account` int(11) NOT NULL,
  PRIMARY KEY (`id_user`),
  KEY `fk_users_company_accounts1_idx` (`id_company_account`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `name`, `user_address`, `telephone`, `email`, `usertype`, `username`, `user_password`, `id_company_account`) VALUES
(1, 'Gift Emmanuel', 'Mbarara', '0784156404', 'aluanuel@gmail.com', 'Admin', 'Alua', 'eacac6866ff84ca578737abe9ae17683f5bbb528', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_password`
--

DROP TABLE IF EXISTS `user_password`;
CREATE TABLE IF NOT EXISTS `user_password` (
  `id_user_password` int(11) NOT NULL AUTO_INCREMENT,
  `user_password` varchar(45) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_user_password`),
  KEY `fk_user_password_users1_idx` (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `fk_clients_client_types1` FOREIGN KEY (`id_client_type`) REFERENCES `client_types` (`id_client_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `client_orders`
--
ALTER TABLE `client_orders`
  ADD CONSTRAINT `fk_client_orders_clients1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_client_orders_stock1` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `expenditures`
--
ALTER TABLE `expenditures`
  ADD CONSTRAINT `expenditures_ibfk_1` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_expenditures_expenditure_sources1` FOREIGN KEY (`id_expenditure_source`) REFERENCES `expenditure_sources` (`id_expenditure_source`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `fk_incomes_income_sources1` FOREIGN KEY (`id_income_source`) REFERENCES `income_sources` (`id_income_source`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `license`
--
ALTER TABLE `license`
  ADD CONSTRAINT `fk_license_company_accounts1` FOREIGN KEY (`id_company_account`) REFERENCES `company_accounts` (`id_company_account`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`id_stock_price_type`) REFERENCES `stock_price_types` (`id_stock_price_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `payment_schedules`
--
ALTER TABLE `payment_schedules`
  ADD CONSTRAINT `payment_schedules_ibfk_1` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `payment_schedules_ibfk_2` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `fk_stock_stock_color` FOREIGN KEY (`id_stock_color`) REFERENCES `stock_color` (`id_stock_color`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_stock_stock_name1` FOREIGN KEY (`id_stock_name`) REFERENCES `stock_name` (`id_stock_name`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_stock_stock_type1` FOREIGN KEY (`id_stock_type`) REFERENCES `stock_type` (`id_stock_type`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_client`) REFERENCES `clients` (`id_client`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stock_prices`
--
ALTER TABLE `stock_prices`
  ADD CONSTRAINT `fk_stock_prices_stock1` FOREIGN KEY (`id_stock`) REFERENCES `stock` (`id_stock`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_stock_prices_stock_price_types1` FOREIGN KEY (`id_stock_price_type`) REFERENCES `stock_price_types` (`id_stock_price_type`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_company_accounts1` FOREIGN KEY (`id_company_account`) REFERENCES `company_accounts` (`id_company_account`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_password`
--
ALTER TABLE `user_password`
  ADD CONSTRAINT `fk_user_password_users1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
