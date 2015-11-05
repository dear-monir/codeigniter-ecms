-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2015 at 08:01 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `e-cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email_key` varchar(32) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `email`, `password`, `email_key`) VALUES
(1, 'Manoz', 'Debnath', 'monirbd41@yahoo.com', '5f4dcc3b5aa765d61d8327deb882cf99', '5f9545ac86f5283e210a193b1ee7ece6');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `category_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(5) NOT NULL DEFAULT '0',
  `last_modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `parent_id`, `sort_order`, `last_modified`) VALUES
(42, 0, 5, '2014-04-26 09:13:43'),
(43, 0, 1, '2014-04-26 09:16:19'),
(44, 0, 1, '2014-04-26 09:16:56'),
(45, 44, 1, '2013-09-23 12:18:46'),
(46, 0, 1, '2014-04-26 09:17:28'),
(47, 0, 1, '2014-04-26 09:17:46');

-- --------------------------------------------------------

--
-- Table structure for table `categories_description`
--

CREATE TABLE IF NOT EXISTS `categories_description` (
  `category_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `category_name` varchar(100) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories_description`
--

INSERT INTO `categories_description` (`category_id`, `language_id`, `category_name`) VALUES
(42, 4, 'Shirt'),
(43, 4, 'Laptop'),
(44, 4, 'Mobile'),
(45, 4, 'Nokia'),
(46, 4, 'Keyboard'),
(47, 4, 'Mouse'),
(42, 5, 'শার্ট'),
(43, 5, 'ল্যাপটপ'),
(44, 5, 'মোবাইল'),
(45, 5, ''),
(46, 5, 'কীবোর্ড'),
(47, 5, 'মাঊস');

-- --------------------------------------------------------

--
-- Table structure for table `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `configuration_group_id` int(11) NOT NULL,
  `configuration_id` int(11) NOT NULL,
  `configuration_key` varchar(255) NOT NULL,
  `configuration_title` varchar(80) NOT NULL,
  `configuration_value` varchar(255) NOT NULL,
  `configuration_description` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL DEFAULT '0',
  `date_added` date NOT NULL,
  `last_modified` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration`
--

INSERT INTO `configuration` (`configuration_group_id`, `configuration_id`, `configuration_key`, `configuration_title`, `configuration_value`, `configuration_description`, `sort_order`, `date_added`, `last_modified`) VALUES
(4, 1, '', 'Product Image Width', '120', 'The pixel width of product images', 1, '2013-04-26', '2013-04-26'),
(4, 2, '', 'Product Image Height', '80', 'The pixel height of product images', 2, '2013-04-26', '2013-04-26'),
(4, 3, '', 'Category Image Width', '120', 'The pixel width of category images', 3, '2013-04-26', '2013-04-26'),
(4, 4, '', 'Category Image Height', '100', 'The pixel  height of category images', 3, '2013-04-26', '2013-04-26'),
(1, 5, '', 'Store Name', 'My online store', 'The name of my store', 1, '2013-04-26', '2013-04-26'),
(1, 6, '', 'Store Owner', 'Monir', 'The name of my store owner', 2, '2013-04-26', '2013-04-26'),
(1, 7, '', 'E-Mail Address', 'monirbd41@yahoo.com', 'The e-mail address of my store owner', 3, '2013-04-26', '2013-04-26'),
(1, 8, '', 'E-Mail From', '"Monir" <monirbd41@yahoo.com>', 'The e-mail address used in (sent) e-mails', 4, '2013-04-26', '2013-04-26'),
(1, 9, 'SHOW_CATEGORY_COUNT', 'Show Category Counts', 'true', 'Count recursively how many products are in each category', 5, '2013-04-26', '2013-04-26'),
(2, 10, '', 'First Name', '3', 'Minimum length of first name', 1, '2013-04-26', '2013-04-26'),
(2, 11, '', 'Last Name', '3', 'Minimum length of last name', 2, '2013-04-26', '2013-04-26'),
(2, 12, '', 'Street Address', '5', 'Minimum length of street address', 3, '2013-04-26', '2013-04-26'),
(2, 13, '', 'Post Code', '4', 'Minimum length of post code', 4, '2013-04-26', '2013-04-26'),
(2, 14, '', 'City', '3', 'Minimum length of city', 5, '2013-04-26', '2013-04-26'),
(2, 15, '', 'Mobile Number', '5', 'Minimum length of mobile number', 6, '2013-04-26', '2013-04-26'),
(2, 16, '', 'Password', '6', 'Minimum length of password', 7, '2013-04-26', '2013-04-26'),
(2, 17, '', 'Credit Card Number', '10', 'Minimum length of credit card number', 8, '2013-04-26', '2013-04-26'),
(2, 18, '', 'Best Sellers', '5', 'Minimum number of best sellers to display', 9, '2013-04-27', '2013-04-27'),
(2, 19, '', 'Also Purchased', '5', 'Minimum number of products to display in the ''This Customer Also Purchased'' box', 10, '2013-04-27', '2013-04-27'),
(3, 20, '', 'Page Links', '5', 'Number of links displayed in each page', 1, '2013-04-27', '2013-04-27'),
(3, 21, '', 'Special Products', '5', 'Maximum number of products on special to display', 2, '2013-04-27', '2013-04-27'),
(3, 22, '', 'New Products Module', '5', 'Maximum number of new products to display in a category', 3, '2013-04-27', '2013-04-27'),
(3, 23, '', 'Products Expected', '5', 'Maximum number of products expected to display', 4, '2013-04-27', '2013-04-27'),
(3, 24, '', 'Categories To List Per Row', '3', 'How many categories to list per row', 5, '2013-04-27', '2013-04-27'),
(3, 25, '', 'Customer Order History Box', '5', 'Maximum number of products to display in the customer order history box', 6, '2013-04-27', '2013-04-27'),
(6, 26, '', 'Display Product Image', '1', 'Do you want to display the Product Image?', 1, '2013-04-27', '2013-04-27'),
(6, 27, '', 'Display Product Manufacturer Name', '2', 'Do you want to display the Product Manufacturer Name?', 2, '2013-04-27', '0000-00-00'),
(6, 28, '', 'Display Product Image', '1', 'Do you want to display the Product Image?', 1, '2013-04-27', '2013-04-27'),
(6, 29, '', 'Display Product Manufacturer Name', '2', 'Do you want to display the Product Manufacturer Name?', 2, '2013-04-27', '2013-04-27'),
(6, 30, '', 'Display Product Model', '3', 'Do you want to display the Product Model?', 3, '2013-04-27', '2013-04-27'),
(6, 31, '', 'Display Product Name', '4', 'Do you want to display the Product Name?', 4, '2013-04-27', '2013-04-27'),
(6, 32, '', 'Display Product Price', '5', 'Do you want to display the Product Price', 5, '2013-04-27', '2013-04-27'),
(6, 33, '', 'Display Product Quantity', '6', 'Do you want to display the Product Quantity?', 6, '2013-04-27', '2013-04-27'),
(6, 34, '', 'Display Product Weight', '7', 'Do you want to display the Product Weight?', 7, '2013-04-27', '2013-04-27'),
(6, 35, '', 'Display Buy Now column', '8', 'Do you want to display the Buy Now column?', 8, '2013-04-27', '2013-04-27'),
(6, 36, '', 'Display Category/Manufacturer Filter (0=disable; 1=enable)', '9', 'Do you want to display the Category/Manufacturer Filter?', 9, '2013-04-27', '2013-04-27'),
(6, 37, '', 'Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', '3', 'Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 10, '2013-04-27', '2013-04-27'),
(3, 38, '', 'Product Quantities In Shopping Cart', '99', 'Maximum number of product quantities that can be added to the shopping cart (0 for no limit)', 11, '2013-04-27', '2013-04-27'),
(9, 39, '', 'Categories', 'true_left', '', 1000, '2013-09-19', '2013-09-19'),
(9, 40, '', 'Manufacturers', 'true_left', '', 1010, '2013-09-19', '2013-09-19'),
(9, 41, '', 'Search', 'true_left', '', 1020, '2013-09-19', '2013-09-19'),
(9, 42, '', 'What''s New', 'true_left', '', 1030, '2013-09-19', '2013-09-19'),
(9, 43, '', 'Information', 'true_left', '', 1040, '2013-09-19', '2013-09-19'),
(9, 44, '', 'Specials', 'true_right', '', 1050, '2013-09-19', '2013-09-19'),
(9, 45, '', 'Reviews', 'true_right', '', 5000, '2013-09-19', '2013-09-19'),
(9, 46, '', 'Language', 'true_right', '', 5010, '2013-09-19', '2013-09-19'),
(9, 47, '', 'Currencies', 'true_right', '', 5020, '2013-09-19', '2013-09-19'),
(10, 48, 'DEFAULT_CURRENCY', 'Default Currency', '10', '', 0, '2013-12-09', '2013-12-09'),
(10, 49, 'DEFAULT_LANGUAGE', 'Default language', '4', '', 0, '2013-12-10', '2013-12-10'),
(7, 50, 'FLAT_RATE', 'Flat Rate', 'true', 'The shipping cost for all orders using this shipping method.', 0, '0000-00-00', '0000-00-00'),
(7, 51, 'PER_ITEM', 'Per Item', 'true', 'The shipping cost will be multiplied by the number of items in an order that uses this shipping method.', 0, '0000-00-00', '0000-00-00'),
(1, 52, 'PREV_NEXT_NAV_LOCATION', 'Sets the location of the Prev/Next Navigation Bar', 'top', '', 0, '0000-00-00', '0000-00-00'),
(1, 53, 'SHOW_PRODUCT_PER_PAGE', 'Set the nubmer of propducts will displayed per page', '3', '', 0, '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `configuration_group`
--

CREATE TABLE IF NOT EXISTS `configuration_group` (
  `configuration_group_id` int(11) NOT NULL,
  `configuration_group_title` varchar(80) NOT NULL,
  `configuration_group_description` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `configuration_group`
--

INSERT INTO `configuration_group` (`configuration_group_id`, `configuration_group_title`, `configuration_group_description`, `sort_order`, `status`) VALUES
(1, 'My Store', 'General information about my store', 1, 1),
(2, 'Minimum Values', 'The minimum values for functions / data', 2, 1),
(3, 'Maximum Values', 'The maximum values for functions / data', 3, 1),
(4, 'Images', 'Image parameters', 4, 1),
(5, 'Customer Details', 'Customer account configuration', 5, 1),
(6, 'Product Listing', 'Product Listing configuration options', 6, 1),
(7, 'Shipping', 'Shipping configuration options', 7, 1),
(8, 'E-Mail Options', 'General setting for E-Mail transport', 8, 1),
(9, 'Boxes', 'Box modules to be displayed', 9, 1),
(10, 'Hidden', 'HiddenConfiguration Group', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `country_id` int(11) NOT NULL,
  `country_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `country_code` varchar(2) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`country_id`, `country_name`, `country_code`) VALUES
(3, 'Australia', 'AU'),
(4, 'Bangladesh', 'BD');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `currency_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  `symbol` varchar(7) CHARACTER SET utf8 NOT NULL,
  `symbol_position` varchar(1) NOT NULL DEFAULT 'L',
  `value` float(13,8) NOT NULL,
  `decimal_point` varchar(1) NOT NULL,
  `thousands_point` varchar(1) NOT NULL,
  `decimal_places` varchar(1) NOT NULL,
  `last_modified` date NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`currency_id`, `title`, `code`, `symbol`, `symbol_position`, `value`, `decimal_point`, `thousands_point`, `decimal_places`, `last_modified`) VALUES
(10, 'American Dollar', 'USD', '$', 'L', 1.00000000, '.', ',', '2', '2014-01-02'),
(11, 'Taka', 'BDT', '৳', 'L', 77.00000000, '.', ',', '2', '2014-01-27');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_gender` varchar(11) NOT NULL,
  `customer_firstname` varchar(32) NOT NULL,
  `customer_lastname` varchar(32) NOT NULL,
  `customer_dob` varchar(20) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `customer_company` varchar(255) NOT NULL,
  `customer_street` varchar(255) NOT NULL,
  `customer_suburb` varchar(255) NOT NULL,
  `customer_postcode` varchar(255) NOT NULL,
  `customer_city` varchar(255) NOT NULL,
  `customer_state_id` int(11) NOT NULL,
  `customer_country_id` int(11) NOT NULL,
  `customer_telephone_no` varchar(32) NOT NULL,
  `customer_mobile_no` varchar(12) NOT NULL,
  `customer_password` varchar(32) CHARACTER SET utf8 NOT NULL,
  `logged_in` int(11) NOT NULL DEFAULT '0',
  `active` int(11) NOT NULL DEFAULT '0',
  `key` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customer_id`, `customer_gender`, `customer_firstname`, `customer_lastname`, `customer_dob`, `customer_email`, `customer_company`, `customer_street`, `customer_suburb`, `customer_postcode`, `customer_city`, `customer_state_id`, `customer_country_id`, `customer_telephone_no`, `customer_mobile_no`, `customer_password`, `logged_in`, `active`, `key`) VALUES
(8, 'male', 'manoz', 'debnath', '04-03-1990', 'manozcsejstu@gmail.com', 'justjust', 'R.N Road', 'Jessore', '7400', 'Jessore', 2, 4, '01926197802', '01926197902', '696d29e0940a4957748fe3fc9efd22a3', 1, 1, '1461528328ff3244627155aebcface7e');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `language_id` int(11) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `code` char(2) NOT NULL,
  `image_ext` varchar(4) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`language_id`, `name`, `code`, `image_ext`, `sort_order`) VALUES
(4, 'english', 'en', 'jpg', 0),
(5, 'Bangla', 'bd', 'jpg', 3);

-- --------------------------------------------------------

--
-- Table structure for table `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `manufacturer_id` int(11) NOT NULL,
  `manufacturer_name` varchar(50) NOT NULL,
  `image_ext` varchar(4) NOT NULL,
  `last_modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturer_id`, `manufacturer_name`, `image_ext`, `last_modified`) VALUES
(1, 'Sony', 'gif', '2013-09-27 10:06:56'),
(2, 'samsung', 'png', '2013-09-27 10:04:09'),
(3, 'HP', 'png', '2013-09-23 08:57:22'),
(4, 'Nokia', 'jpg', '2013-09-23 12:18:00'),
(5, 'logitech', 'png', '2013-09-27 09:56:00'),
(6, 'A-4tech', 'jpg', '2013-09-27 09:57:26'),
(7, 'Acer', 'png', '2013-09-27 10:02:57'),
(8, 'Shapno', 'png', '2013-09-27 10:09:25');

-- --------------------------------------------------------

--
-- Table structure for table `options_to_values`
--

CREATE TABLE IF NOT EXISTS `options_to_values` (
  `product_option_value_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options_to_values`
--

INSERT INTO `options_to_values` (`product_option_value_id`, `product_option_id`) VALUES
(1, 5),
(2, 6),
(3, 6),
(4, 5),
(5, 7),
(6, 7);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `delivery_fname` varchar(255) NOT NULL,
  `delivery_lname` varchar(255) NOT NULL,
  `delivery_gender` varchar(10) NOT NULL,
  `delivery_street_address` varchar(255) NOT NULL,
  `delivery_postcode` varchar(10) NOT NULL,
  `delivery_city` varchar(255) NOT NULL,
  `delivery_state` varchar(255) NOT NULL,
  `delivery_country` varchar(255) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `currency_value` float NOT NULL,
  `order_date` datetime NOT NULL,
  `total` float NOT NULL,
  `shipping_cost` float NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_id`, `delivery_fname`, `delivery_lname`, `delivery_gender`, `delivery_street_address`, `delivery_postcode`, `delivery_city`, `delivery_state`, `delivery_country`, `currency`, `currency_value`, `order_date`, `total`, `shipping_cost`, `status`) VALUES
(10, 8, 'manoz', 'debnath', 'male', 'just', 'just', 'just', 'Khulna', 'Bangladesh', 'USD', 1, '2014-07-06 23:59:40', 242.3, 5, '2'),
(11, 8, 'manoz', 'debnath', 'male', 'R.N Road', '7400', 'Jessore', 'Khulna', 'Bangladesh', 'USD', 1, '2014-07-07 23:52:28', 231.8, 5, '1'),
(12, 8, 'manoz', 'debnath', 'male', 'R.N Road', '7400', 'Jessore', 'Khulna', 'Bangladesh', 'USD', 1, '2014-07-07 23:54:28', 10.25, 5, '1'),
(13, 8, 'manoz', 'debnath', 'male', 'R.N Road', '7400', 'Jessore', 'Khulna', 'Bangladesh', 'USD', 1, '2014-07-08 00:02:08', 237.05, 5, '1'),
(14, 8, 'manoz', 'debnath', 'male', 'R.N Road', '7400', 'Jessore', 'Khulna', 'Bangladesh', 'USD', 1, '2014-07-08 00:04:13', 10.25, 5, '1'),
(15, 8, 'manoz', 'debnath', 'male', 'R.N Road', '7400', 'Jessore', 'Khulna', 'Bangladesh', 'BDT', 77, '2014-07-08 07:37:43', 15.5, 5, '1'),
(16, 8, 'manoz', 'debnath', 'male', 'R.N Road', '7400', 'Jessore', 'Khulna', 'Bangladesh', 'USD', 1, '2014-08-19 13:23:21', 264.5, 2, '1'),
(17, 8, 'manoz', 'debnath', 'male', 'R.N Road', '7400', 'Jessore', 'Khulna', 'Bangladesh', 'USD', 1, '2014-08-19 13:29:02', 6.25, 1, '1'),
(18, 8, 'manoz', 'debnath', 'male', 'R.N Road', '7400', 'Jessore', 'Khulna', 'Bangladesh', 'USD', 1, '2014-08-19 13:33:35', 6.25, 1, '1'),
(19, 8, 'manoz', 'debnath', 'male', 'R.N Road', '7400', 'Jessore', 'Khulna', 'Bangladesh', 'USD', 1, '2014-08-20 11:31:28', 6.25, 1, '1');

-- --------------------------------------------------------

--
-- Table structure for table `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` float NOT NULL,
  `product_tax` float NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `total_price` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_products`
--

INSERT INTO `orders_products` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `product_tax`, `product_quantity`, `total_price`) VALUES
(12, 10, 2, 'HP Laptop', 208, 10.8, 1, 226.8),
(13, 10, 7, 'Logitect-mouse', 5, 0.5, 2, 10.5),
(14, 11, 2, 'HP Laptop', 208, 10.8, 1, 226.8),
(15, 12, 6, 'Logitech-Keyboard', 5, 0.25, 1, 5.25),
(16, 13, 6, 'Logitech-Keyboard', 5, 0.25, 1, 5.25),
(17, 13, 2, 'HP Laptop', 208, 10.8, 1, 226.8),
(18, 14, 6, 'Logitech-Keyboard', 5, 0.25, 1, 5.25),
(19, 15, 4, 'Samsunng h30', 10, 0.5, 1, 10.5),
(20, 16, 4, 'স্যামসাঙ মোবাইল', 10, 0.5, 1, 10.5),
(21, 16, 3, 'এইচপি ল্যপ্টপ', 240, 12, 1, 252),
(22, 17, 6, 'Logitech-Keyboard', 5, 0.25, 1, 5.25),
(23, 18, 7, 'Logitect-mouse', 5, 0.25, 1, 5.25),
(24, 19, 6, 'Logitech-Keyboard', 5, 0.25, 1, 5.25);

-- --------------------------------------------------------

--
-- Table structure for table `orders_products_options`
--

CREATE TABLE IF NOT EXISTS `orders_products_options` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_option` varchar(255) NOT NULL,
  `product_option_value` varchar(255) NOT NULL,
  `product_option_value_price` float NOT NULL,
  `product_option_value_prefix` varchar(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_products_options`
--

INSERT INTO `orders_products_options` (`id`, `order_id`, `product_id`, `product_option`, `product_option_value`, `product_option_value_price`, `product_option_value_prefix`) VALUES
(8, 10, 2, 'color', 'Red', 4, '+'),
(9, 10, 2, 'memory', '2 GB', 4, '+'),
(10, 11, 2, 'color', 'Red', 4, '+'),
(11, 11, 2, 'memory', '2 GB', 4, '+'),
(12, 13, 2, 'color', 'Red', 4, '+'),
(13, 13, 2, 'memory', '2 GB', 4, '+');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_quantity` int(11) NOT NULL,
  `product_model` varchar(12) NOT NULL,
  `product_price` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  `last_modified` datetime NOT NULL,
  `date_available` date NOT NULL,
  `product_weight` decimal(5,2) NOT NULL,
  `product_status` tinyint(1) NOT NULL DEFAULT '1',
  `tax_class_id` int(11) NOT NULL,
  `manufacturer_id` int(11) NOT NULL,
  `product_ordered` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`category_id`, `product_id`, `product_quantity`, `product_model`, `product_price`, `date_added`, `last_modified`, `date_available`, `product_weight`, `product_status`, `tax_class_id`, `manufacturer_id`, `product_ordered`) VALUES
(42, 1, 20, 'M-007', '25.0000', '2013-09-21 00:15:06', '2014-07-08 07:53:57', '2013-09-21', '4.00', 1, 1, 8, 0),
(43, 2, 10, 'Pavilion G4', '200.0000', '2013-09-23 08:59:35', '2014-08-20 10:58:10', '2014-08-08', '2.00', 1, 1, 3, 0),
(43, 3, 4, 'Hp pro', '240.0000', '2013-09-23 09:01:24', '2014-08-20 10:57:26', '2014-08-08', '1.67', 1, 1, 3, 0),
(44, 4, 8, 'Samsung g40', '10.0000', '2013-09-23 12:04:48', '2014-07-08 07:56:46', '2013-09-23', '300.00', 1, 1, 2, 0),
(45, 5, 5, 'Nokia asa', '15.0000', '2013-09-23 12:20:23', '2014-07-08 07:56:26', '2013-09-23', '30.00', 1, 1, 4, 0),
(46, 6, 0, 'k750', '5.0000', '2013-09-27 09:38:06', '2014-07-08 07:57:47', '2013-09-27', '200.00', 1, 1, 5, 0),
(47, 7, 2, ' Logitech B1', '5.0000', '2013-09-27 09:50:57', '2014-07-08 07:59:25', '2013-09-27', '5.00', 1, 1, 5, 0),
(43, 8, 5, 'acer-2', '200.0000', '2013-09-27 10:54:34', '2014-07-08 07:55:37', '2013-09-27', '2.50', 1, 1, 7, 0),
(44, 9, 3, 'sony 06', '100.0000', '2013-09-27 11:01:10', '2014-07-08 07:57:15', '2013-09-27', '50.00', 1, 1, 1, 0),
(46, 10, 3, 'A4Tech-12', '5.0000', '2013-09-27 11:09:42', '2014-07-08 07:58:27', '2013-09-27', '120.00', 1, 1, 6, 0),
(43, 11, 25, 'X3', '400.0000', '2014-07-08 00:13:14', '2014-08-20 10:58:48', '2014-08-06', '2.00', 1, 1, 3, 0),
(43, 13, 20, 'X2', '400.0000', '2014-07-08 00:17:20', '2014-07-08 07:55:57', '2014-07-08', '2.00', 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `products_attributes`
--

CREATE TABLE IF NOT EXISTS `products_attributes` (
  `prodcut_attribute_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `product_option_value_id` int(11) NOT NULL,
  `option_value_price` decimal(15,4) NOT NULL,
  `price_prefix` varchar(1) NOT NULL DEFAULT '+'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_attributes`
--

INSERT INTO `products_attributes` (`prodcut_attribute_id`, `product_id`, `product_option_id`, `product_option_value_id`, `option_value_price`, `price_prefix`) VALUES
(1, 2, 5, 1, '4.0000', '+'),
(2, 2, 7, 5, '4.0000', '+'),
(3, 1, 5, 1, '12.0000', '+');

-- --------------------------------------------------------

--
-- Table structure for table `products_description`
--

CREATE TABLE IF NOT EXISTS `products_description` (
  `product_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `product_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `product_description` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_description`
--

INSERT INTO `products_description` (`product_id`, `language_id`, `product_name`, `product_description`) VALUES
(1, 4, 'T-shirt', '                        product size 	30\r\nAll Dry Weight 	No\r\nAll Liquid Weight 	No\r\nkitchen Utensils \r\nSize  60                                                                                                                                                                                                                    '),
(2, 4, 'HP Laptop', '                                                                                                                                                                                                                                                                            Processor - Intel® Celeron® 847 with Intel HD Graphics (1.1 GHz, 2 MB cache, 2 cores)\r\nScreen size - 14" diagonal HD BrightView LED-backlit (1366 x 768)\r\nMemory - 4 GB DDR3\r\nHard drive - 16 GB SATA SSD                                                                                                                                                                                                                                                                    '),
(3, 4, 'HP Laptop', '                                                                                                                                                                                                                                                                                                                                                                                   Processor - Intel® Core I3 847 with Intel HD Graphics (1.1 GHz, 2 MB cache, 2 cores)\r\nScreen size - 14" diagonal HD BrightView LED-backlit (1366 x 768)\r\nMemory - 4 GB DDR3\r\nHard drive - 16 GB SATA SSD                                                                                                                                                                                                                                                                                                                                             '),
(4, 4, 'Samsunng h30', '                                                                            New design and New feature are added                                                                                         '),
(5, 4, 'Nokia Asa', '                                                                                                                                                      OS: Android 4.2.1 Jelly Bean ; Display: 5.3" IPS HD ; Camera: 13 MP+3 MP ; CPU: 1.2 GHz (Quad Core) ; Memory: RAM 1GB, ROM 4GB ; Battery: 3000 mAh                                                                                                                                                              '),
(6, 4, 'Logitech-Keyboard', '                                                                         Logitech''s K750 wireless solar keyboard gets our Editors'' Choice Award for being an environmentally friendly alternative to traditional input devices with convenient extras and an affordable price.                                                                                                         '),
(7, 4, 'Logitect-mouse', '                                                                            High-Definition optical tracking (100 dpi) & easy text selection\r\n    Smooth tracker-with or without a mouse pad\r\n    Full-size comfort                                                                                                        '),
(8, 4, 'acer', '                                                                                                                                                                                                                                                             Processor - Intel® Celeron® 847 with Intel HD Graphics (1.1 GHz, 2 MB cache, 2 cores)\r\nScreen size - 14" diagonal HD BrightView LED-backlit (1366 x 768)\r\nMemory - 4 GB DDR3\r\nHard drive - 16 GB SATA SSD                                                                                                                                                                                                                                                              '),
(9, 4, 'sony mobile', '                                                         OS: Android 4.2.1 Jelly Bean ; Display: 5.3" IPS HD ; Camera: 13 MP+3 MP ; CPU: 1.2 GHz (Quad Core) ; Memory: RAM 1GB, ROM 4GB ; Battery: 3000 mAh                                                                           '),
(10, 4, 'A-4tech keyboard', '                                               A4tech K750 wireless solar keyboard gets our Editors'' Choice Award for being an environmentally friendly alternative to traditional input devices with convenient extras and an affordable price.                                                               '),
(1, 5, 'টি শার্ট', 'গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                    '),
(2, 5, 'এইচপি ল্যাপটপ', '                                                                গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                                                                    '),
(3, 5, 'এইচপি ল্যপ্টপ', '                                                                        গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                                                            '),
(4, 5, 'স্যামসাঙ মোবাইল', '                   গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                         '),
(5, 5, 'নকিয়া আশা', '                  গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                          '),
(6, 5, 'লজিটেক', '        গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                                    '),
(7, 5, 'লজিটেক', '                গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                            '),
(8, 5, 'এছার ল্যাপটপ', '         গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                                   '),
(9, 5, 'স্নি মোবাইল', '                 গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                           '),
(10, 5, 'এফরটেক কীবোর্ড', '                গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                            '),
(11, 4, 'Laptop x3', '                                                Processor - Intel® Celeron® 847 with Intel HD Graphics (1.1 GHz, 2 MB cache, 2 cores) Screen size - 14" diagonal HD BrightView LED-backlit (1366 x 768) Memory - 4 GB DDR3 Hard drive - 16 GB SATA SSD                                                                              '),
(11, 5, 'ল্যাপটপ', '                        গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।                    '),
(13, 4, 'Laptop x2', '                        Processor - Intel® Celeron® 847 with Intel HD Graphics (1.1 GHz, 2 MB cache, 2 cores) Screen size - 14" diagonal HD BrightView LED-backlit (1366 x 768) Memory - 4 GB DDR3 Hard drive - 16 GB SATA SSD                                                        '),
(13, 5, 'ল্যাপটপ', 'গ্রাহকদের কাছে সেবাটিকে আরও আকর্ষণীয় করতে ‘এখানেই ডট কম’ ওয়েবসাইটে সব ধরনের সেবা ও ফিচার বাংলা ও ইংরেজি দুই ভাষাতেই পাওয়া যাবে। দুই ভাষাতেই সারা দেশের গ্রাহকরা ওয়েবসাইটটি ব্যবহার করতে পারবেন। এখানে বিজ্ঞাপন ও ব্যবহারকারী সেলবাজারের মতই সব ধরনের সেবা পাবেন।        ');

-- --------------------------------------------------------

--
-- Table structure for table `products_images`
--

CREATE TABLE IF NOT EXISTS `products_images` (
  `image_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_ext` varchar(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_images`
--

INSERT INTO `products_images` (`image_id`, `product_id`, `image_ext`) VALUES
(9, 2, 'jpg'),
(10, 2, 'jpg'),
(11, 1, 'jpg'),
(12, 1, 'jpg'),
(13, 1, 'jpg'),
(14, 4, 'jpg'),
(15, 4, 'jpg'),
(16, 4, 'jpg'),
(17, 4, 'jpg'),
(18, 4, 'jpg'),
(19, 4, 'jpg'),
(20, 4, 'jpg'),
(21, 5, 'jpg'),
(22, 5, 'jpg'),
(23, 5, 'jpg'),
(24, 5, 'jpg'),
(25, 3, 'jpg'),
(26, 3, 'jpg'),
(27, 3, 'jpg'),
(28, 3, 'jpg'),
(29, 6, 'jpg'),
(30, 6, 'jpg'),
(31, 6, 'jpg'),
(32, 6, 'jpg'),
(33, 6, 'jpg'),
(34, 7, 'jpg'),
(35, 7, 'jpg'),
(36, 7, 'jpg'),
(37, 7, 'jpg'),
(38, 7, 'jpg'),
(39, 8, 'jpg'),
(40, 8, 'jpg'),
(41, 8, 'jpg'),
(42, 8, 'jpg'),
(43, 8, 'jpg'),
(44, 9, 'jpg'),
(45, 9, 'jpg'),
(46, 9, 'jpg'),
(47, 10, 'jpg'),
(48, 10, 'jpg'),
(49, 10, 'jpg'),
(50, 11, 'jpg'),
(51, 13, 'jpg');

-- --------------------------------------------------------

--
-- Table structure for table `products_options`
--

CREATE TABLE IF NOT EXISTS `products_options` (
  `product_option_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_options`
--

INSERT INTO `products_options` (`product_option_id`) VALUES
(5),
(6),
(7);

-- --------------------------------------------------------

--
-- Table structure for table `products_options_values`
--

CREATE TABLE IF NOT EXISTS `products_options_values` (
  `product_option_value_id` int(11) NOT NULL,
  `product_option_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `product_option_value_name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products_options_values`
--

INSERT INTO `products_options_values` (`product_option_value_id`, `product_option_id`, `language_id`, `product_option_value_name`) VALUES
(1, 5, 4, 'Red'),
(2, 6, 4, '17'),
(3, 6, 4, '32'),
(4, 5, 4, 'white'),
(5, 7, 4, '2 GB'),
(6, 7, 4, '8 GB'),
(1, 5, 5, 'লাল'),
(2, 6, 5, '17'),
(3, 6, 5, '32'),
(4, 5, 5, 'সাদা'),
(5, 7, 5, '2 GB'),
(6, 7, 5, '8 GB');

-- --------------------------------------------------------

--
-- Table structure for table `product_option_description`
--

CREATE TABLE IF NOT EXISTS `product_option_description` (
  `product_option_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `product_option_name` varchar(50) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_option_description`
--

INSERT INTO `product_option_description` (`product_option_id`, `language_id`, `product_option_name`) VALUES
(5, 4, 'color'),
(6, 4, 'Size'),
(7, 4, 'memory'),
(5, 5, 'রং'),
(6, 5, 'সাইজ'),
(7, 5, 'মেমোরি');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `review_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `review_rating` int(1) NOT NULL,
  `date_added` date NOT NULL,
  `last_modified` date NOT NULL,
  `review_status` tinyint(1) NOT NULL,
  `review_readed` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `product_id`, `customer_id`, `review_rating`, `date_added`, `last_modified`, `review_status`, `review_readed`) VALUES
(1, 1, 1, 4, '2013-09-23', '0000-00-00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `reviews_description`
--

CREATE TABLE IF NOT EXISTS `reviews_description` (
  `review_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `review_description` text CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews_description`
--

INSERT INTO `reviews_description` (`review_id`, `language_id`, `review_description`) VALUES
(1, 5, 'দারুণ টি-শার্ট!'),
(1, 4, 'Awesome T-shirt!');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_region`
--

CREATE TABLE IF NOT EXISTS `shipping_region` (
  `id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  `shipping_method_id` int(11) NOT NULL,
  `shipping_cost` float NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `shipping_region`
--

INSERT INTO `shipping_region` (`id`, `region_id`, `shipping_method_id`, `shipping_cost`) VALUES
(1, 2, 50, 5),
(3, 3, 50, 3),
(5, 2, 51, 1);

-- --------------------------------------------------------

--
-- Table structure for table `specials`
--

CREATE TABLE IF NOT EXISTS `specials` (
  `special_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `special_price` decimal(15,4) NOT NULL,
  `date_added` datetime NOT NULL,
  `last_modified` int(11) NOT NULL,
  `expire_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specials`
--

INSERT INTO `specials` (`special_id`, `product_id`, `special_price`, `date_added`, `last_modified`, `expire_date`, `status`) VALUES
(1, 1, '10.0000', '2013-09-23 11:16:46', 2014, '2014-07-16', 1),
(2, 2, '180.0000', '2013-09-23 11:35:56', 2014, '2014-08-30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`) VALUES
(1, 4, 'Dhaka'),
(2, 4, 'Khulna'),
(3, 4, 'Rangpur');

-- --------------------------------------------------------

--
-- Table structure for table `tax_classes`
--

CREATE TABLE IF NOT EXISTS `tax_classes` (
  `tax_class_id` int(11) NOT NULL,
  `tax_class_title` varchar(50) NOT NULL,
  `tax_class_description` varchar(255) NOT NULL,
  `last_modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_classes`
--

INSERT INTO `tax_classes` (`tax_class_id`, `tax_class_title`, `tax_class_description`, `last_modified`) VALUES
(1, 'Taxable Goods', 'The following types of products are included non-food, services, etc                                        ', '2013-07-23 10:05:10'),
(3, 'Another Taxt Class', 'Something else', '2013-04-09 15:30:39');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE IF NOT EXISTS `tax_rates` (
  `tax_rate_id` int(11) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `tax_rate` int(11) NOT NULL,
  `last_modified` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_rates`
--

INSERT INTO `tax_rates` (`tax_rate_id`, `tax_class_id`, `country_id`, `tax_rate`, `last_modified`) VALUES
(1, 1, 4, 5, '2014-07-04 21:06:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `configuration`
--
ALTER TABLE `configuration`
  ADD PRIMARY KEY (`configuration_id`);

--
-- Indexes for table `configuration_group`
--
ALTER TABLE `configuration_group`
  ADD PRIMARY KEY (`configuration_group_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`currency_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`language_id`);

--
-- Indexes for table `manufacturers`
--
ALTER TABLE `manufacturers`
  ADD PRIMARY KEY (`manufacturer_id`);

--
-- Indexes for table `options_to_values`
--
ALTER TABLE `options_to_values`
  ADD PRIMARY KEY (`product_option_value_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products`
--
ALTER TABLE `orders_products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_products_options`
--
ALTER TABLE `orders_products_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `products_attributes`
--
ALTER TABLE `products_attributes`
  ADD PRIMARY KEY (`prodcut_attribute_id`);

--
-- Indexes for table `products_images`
--
ALTER TABLE `products_images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `products_options`
--
ALTER TABLE `products_options`
  ADD PRIMARY KEY (`product_option_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `shipping_region`
--
ALTER TABLE `shipping_region`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specials`
--
ALTER TABLE `specials`
  ADD PRIMARY KEY (`special_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_classes`
--
ALTER TABLE `tax_classes`
  ADD PRIMARY KEY (`tax_class_id`);

--
-- Indexes for table `tax_rates`
--
ALTER TABLE `tax_rates`
  ADD PRIMARY KEY (`tax_rate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT for table `configuration`
--
ALTER TABLE `configuration`
  MODIFY `configuration_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `configuration_group`
--
ALTER TABLE `configuration_group`
  MODIFY `configuration_group_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `currency_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `language_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `manufacturers`
--
ALTER TABLE `manufacturers`
  MODIFY `manufacturer_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `options_to_values`
--
ALTER TABLE `options_to_values`
  MODIFY `product_option_value_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `orders_products`
--
ALTER TABLE `orders_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `orders_products_options`
--
ALTER TABLE `orders_products_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `products_attributes`
--
ALTER TABLE `products_attributes`
  MODIFY `prodcut_attribute_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `products_images`
--
ALTER TABLE `products_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `products_options`
--
ALTER TABLE `products_options`
  MODIFY `product_option_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shipping_region`
--
ALTER TABLE `shipping_region`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `specials`
--
ALTER TABLE `specials`
  MODIFY `special_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tax_classes`
--
ALTER TABLE `tax_classes`
  MODIFY `tax_class_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `tax_rate_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
