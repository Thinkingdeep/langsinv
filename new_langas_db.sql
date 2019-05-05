-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 05, 2019 at 11:09 PM
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
  PRIMARY KEY (`id_client`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id_client_order`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `client_types`
--

DROP TABLE IF EXISTS `client_types`;
CREATE TABLE IF NOT EXISTS `client_types` (
  `id_client_type` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_client_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'LANGAS INVESTMENTS LTD', 'RWEBIKOONA SHOPPING MALL', '0772441872', 'sales@langasinvestments.com', 'www.langasinvestments.com', '2019-05-01 15:54:48');

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
  PRIMARY KEY (`id_expenditure`)
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id_income`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `income_sources`
--

DROP TABLE IF EXISTS `income_sources`;
CREATE TABLE IF NOT EXISTS `income_sources` (
  `id_income_source` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_income_source`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id_license`)
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
  PRIMARY KEY (`id_payment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  PRIMARY KEY (`id_payment_schedule`)
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
  `id_stock_type` int(11) NOT NULL,
  `id_stock_color` int(11) NOT NULL,
  `id_stock_name` int(11) NOT NULL,
  `id_stock_price_type` int(11) NOT NULL,
  `stock_status` varchar(20) NOT NULL,
  `stock_sold_to` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_stock`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_color`
--

DROP TABLE IF EXISTS `stock_color`;
CREATE TABLE IF NOT EXISTS `stock_color` (
  `id_stock_color` int(11) NOT NULL AUTO_INCREMENT,
  `color_name` varchar(45) NOT NULL,
  PRIMARY KEY (`id_stock_color`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_price_types`
--

DROP TABLE IF EXISTS `stock_price_types`;
CREATE TABLE IF NOT EXISTS `stock_price_types` (
  `id_stock_price_type` int(11) NOT NULL AUTO_INCREMENT,
  `price_type` varchar(45) NOT NULL,
  PRIMARY KEY (`id_stock_price_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stock_type`
--

DROP TABLE IF EXISTS `stock_type`;
CREATE TABLE IF NOT EXISTS `stock_type` (
  `id_stock_type` int(11) NOT NULL AUTO_INCREMENT,
  `stock_type_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id_stock_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `user_photo` varchar(200) NOT NULL DEFAULT 'assets/uploads/profile/default.png',
  `id_company_account` int(11) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_password`
--

DROP TABLE IF EXISTS `user_password`;
CREATE TABLE IF NOT EXISTS `user_password` (
  `id_user_password` int(11) NOT NULL AUTO_INCREMENT,
  `user_password` varchar(45) NOT NULL,
  `id_user` int(11) NOT NULL,
  PRIMARY KEY (`id_user_password`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_sessions`
--

DROP TABLE IF EXISTS `user_sessions`;
CREATE TABLE IF NOT EXISTS `user_sessions` (
  `id_user_session` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `hash` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
