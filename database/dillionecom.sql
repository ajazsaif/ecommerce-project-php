-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2020 at 08:44 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dillionecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_user`
--

CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_user`
--

INSERT INTO `admin_user` (`id`, `username`, `pass`, `role`) VALUES
(1, 'admin', '$2y$10$ardG.Ccq9RGnnZNvrHf1X.5MNsG9VWRiF3HvR1r9BPFUK47qNIvKi', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `analytics`
--

CREATE TABLE `analytics` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `analytics`
--

INSERT INTO `analytics` (`id`, `content`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `banner`
--

CREATE TABLE `banner` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `banner`
--

INSERT INTO `banner` (`id`, `image`, `type`) VALUES
(1, '5bc03fa926b27small-1.jpg', 'med'),
(2, '5bc03faed63cdsmall-2.jpg', 'med'),
(3, '5bc03fb447ef4small-3.jpg', 'med'),
(4, '5bc03fbab4a85small-4.jpg', 'med');

-- --------------------------------------------------------

--
-- Table structure for table `blog`
--

CREATE TABLE `blog` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog`
--

INSERT INTO `blog` (`id`, `name`, `image`, `description`) VALUES
(1, 'Lorem Ipsum is simply dummy', '5b7abf8279ee6blog.png', '&lt;p style=&quot;text-align:justify&quot;&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy textever since the 1500s, it to make a type specimen book. It has survived not only&lt;/p&gt;'),
(2, 'Lorem Ipsum is simply dummy', '5b7ac1c443c9bbanner-background-4.png', '&lt;p&gt;simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;'),
(3, 'Lorem Ipsum is simply dummy', '5b7ba541a6e6fbanner-background-3.png', '&lt;p&gt;simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `chat_code`
--

CREATE TABLE `chat_code` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_code`
--

INSERT INTO `chat_code` (`id`, `content`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `pincode` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `home`
--

CREATE TABLE `home` (
  `id` int(11) NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `home`
--

INSERT INTO `home` (`id`, `seo_title`, `seo_description`, `seo_keywords`) VALUES
(1, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `total_amount` float NOT NULL,
  `card_type` varchar(255) DEFAULT NULL,
  `holder_name` varchar(255) DEFAULT NULL,
  `card_number` varchar(255) DEFAULT NULL,
  `cvv` varchar(255) DEFAULT NULL,
  `exp_date_mm` varchar(255) DEFAULT NULL,
  `exp_date_yy` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zipcode` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `ship_method` varchar(255) DEFAULT NULL,
  `ship_charge` float DEFAULT 0,
  `coupon_code_id` int(11) DEFAULT NULL,
  `coupon_code_amnt` float DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `user_id`, `order_id`, `payment_mode`, `total_amount`, `card_type`, `holder_name`, `card_number`, `cvv`, `exp_date_mm`, `exp_date_yy`, `first_name`, `last_name`, `phone`, `address`, `city`, `state`, `zipcode`, `country`, `date`, `ship_method`, `ship_charge`, `coupon_code_id`, `coupon_code_amnt`) VALUES
(1, 1, 'ORD-72016332', '1', 1330, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 18:04:21', 'Local Shipping 10 to 15 business days', 30, NULL, 0),
(2, 1, 'ORD-74480302', '10', 1070, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 18:08:28', 'USPS/FedEx/Others Overnight Express Local Mail(USA/CANADA) 4 to 6 business days', 70, NULL, 0),
(3, 2, 'ORD-77498238', '1', 1260, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 18:15:23', 'USPS/DHL/FedEx Priority Mail International 6 to 10 business days', 60, NULL, 0),
(4, 2, 'ORD-31561647', '9', 1030, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 18:35:32', 'Local Shipping 10 to 15 business days', 30, NULL, 0),
(5, 2, 'ORD-47699428', '12', 530, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2020-10-16 18:42:28', 'Local Shipping 10 to 15 business days', 30, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_summary`
--

CREATE TABLE `order_summary` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `pro_name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `variant` varchar(255) DEFAULT NULL,
  `total_price` float NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `varient_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_summary`
--

INSERT INTO `order_summary` (`id`, `order_id`, `product_id`, `pro_name`, `price`, `quantity`, `variant`, `total_price`, `create_date`, `varient_id`) VALUES
(1, 'ORD-72016332', 5, 'Iphone', 1300, 1, 'golden', 1300, '2020-10-16 18:04:21', 13),
(2, 'ORD-74480302', 5, 'Iphone', 1000, 1, 'rosegold', 1000, '2020-10-16 18:08:28', 12),
(3, 'ORD-77498238', 6, 'Samsung A50', 600, 2, 'black', 1200, '2020-10-16 18:15:23', 15),
(4, 'ORD-31561647', 6, 'Samsung A50', 500, 2, 'blue', 1000, '2020-10-16 18:35:32', 14),
(5, 'ORD-47699428', 6, 'Samsung A50', 500, 1, 'blue', 500, '2020-10-16 18:42:28', 14);

-- --------------------------------------------------------

--
-- Table structure for table `payment_option`
--

CREATE TABLE `payment_option` (
  `id` int(11) NOT NULL,
  `name` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `serial_no` int(11) DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_option`
--

INSERT INTO `payment_option` (`id`, `name`, `city`, `state`, `country`, `zip`, `serial_no`) VALUES
(1, '1BvBMSEYstWetqTFn5Au4m4GFg7xJaNVN2', 'Bitcoin', 'bitcoin.png', '', '', 1),
(7, 'Paypal address', 'Paypal', 'paypal.png', '', '', 6),
(8, 'Cashapp wallet address', 'Cashapp', 'cash-app.png', '', '', 5),
(9, 'Ria money wallet address', 'Ria Money', 'ria.png', '', '', 4),
(10, 'Western Union address', 'Western Union', 'westurn.png', '', '', 3),
(12, 'Moneygram address', 'Moneygram', 'money-gram.png', NULL, NULL, 2),
(15, 'zelle address', 'zelle', NULL, NULL, NULL, 7),
(16, 'venmo address', 'venmo', NULL, NULL, NULL, 8);

-- --------------------------------------------------------

--
-- Table structure for table `privacy`
--

CREATE TABLE `privacy` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `privacy`
--

INSERT INTO `privacy` (`id`, `heading`, `content`, `seo_title`, `seo_keywords`, `seo_description`) VALUES
(1, 'Payment Option', '&lt;p style=&quot;text-align:justify&quot;&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;', 'Payment Option Page Edit', 'Payment Option Page Edit', 'Payment Option Page Edit');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `parent` int(100) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `price` float DEFAULT 1,
  `rating` varchar(255) DEFAULT NULL,
  `min_qty` int(11) DEFAULT 1,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `img_alt` varchar(255) DEFAULT NULL,
  `img_title` varchar(255) DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'p',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `additional_info` text DEFAULT NULL,
  `products_tag` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `parent`, `heading`, `price`, `rating`, `min_qty`, `description`, `image`, `slug`, `img_alt`, `img_title`, `seo_title`, `seo_keywords`, `seo_description`, `type`, `status`, `created_at`, `additional_info`, `products_tag`) VALUES
(1, 0, 'Category 1', 1, NULL, 1, '&lt;p&gt;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem&amp;nbsp;&lt;/p&gt;', '5f89a641ab647product.jpg', 'category-1', '', '', '', '', '', NULL, 'p', '2020-10-03 13:32:28', NULL, NULL),
(2, 0, 'Category 2', 1, NULL, 1, '&lt;p&gt;Category 2&lt;/p&gt;', '5f89a637e0ecfproduct.jpg', 'category-2', '', '', '', '', '', NULL, 'p', '2020-10-03 13:32:44', NULL, NULL),
(3, 0, 'Category 3', 1, NULL, 1, '&lt;p&gt;Category 3&lt;/p&gt;', '5f89a62dc4472product.jpg', 'category-3', '', '', '', '', '', NULL, 'p', '2020-10-03 13:32:59', NULL, NULL),
(4, 1, 'Laptop Silver black', 1, NULL, 1, '&lt;p&gt;&lt;strong&gt;Intel Core 2 Duo processor&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Powered by an Intel Core 2 Duo processor at speeds up to 2.16GHz, the new MacBook is the fastest ever.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;1GB memory, larger hard drives&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;The new MacBook now comes with 1GB of memory standard and larger hard drives for the entire line perfect for running more of your favorite applications and storing growing media collections.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Sleek, 1.08-inch-thin design&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;MacBook makes it easy to hit the road thanks to its tough polycarbonate case, built-in wireless technologies, and innovative MagSafe Power Adapter that releases automatically if someone accidentally trips on the cord.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Built-in iSight camera&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Right out of the box, you can have a video chat with friends or family,2 record a video at your desk, or take fun pictures with Photo Booth&lt;/p&gt;', '5f7843caa80e7product.jpg', 'laptop-silver-black', '', '', '', '', '', NULL, 'p', '2020-10-03 14:56:34', '&lt;table&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;td colspan=&quot;2&quot;&gt;&lt;strong&gt;Memory&lt;/strong&gt;&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;test 1&lt;/td&gt;\r\n			&lt;td&gt;8gb&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n\r\n&lt;table&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;td colspan=&quot;2&quot;&gt;&lt;strong&gt;Processor&lt;/strong&gt;&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;No. of Cores&lt;/td&gt;\r\n			&lt;td&gt;1&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;', NULL),
(5, 2, 'Iphone', 1, NULL, 1, '&lt;p&gt;&lt;strong&gt;ntel Core 2 Duo processor&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Powered by an Intel Core 2 Duo processor at speeds up to 2.16GHz, the new MacBook is the fastest ever.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;1GB memory, larger hard drives&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;The new MacBook now comes with 1GB of memory standard and larger hard drives for the entire line perfect for running more of your favorite applications and storing growing media collections.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Sleek, 1.08-inch-thin design&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;MacBook makes it easy to hit the road thanks to its tough polycarbonate case, built-in wireless technologies, and innovative MagSafe Power Adapter that releases automatically if someone accidentally trips on the cord.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Built-in iSight camera&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Right out of the box, you can have a video chat with friends or family,2 record a video at your desk, or take fun pictures with Photo Booth&lt;/p&gt;', '5f7844446ad55product.jpg', 'iphone', '', '', '', '', '', NULL, 'p', '2020-10-03 14:58:36', '&lt;table&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;td colspan=&quot;2&quot;&gt;&lt;strong&gt;Memory&lt;/strong&gt;&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;test 1&lt;/td&gt;\r\n			&lt;td&gt;8gb&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n\r\n&lt;table&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;td colspan=&quot;2&quot;&gt;&lt;strong&gt;Processor&lt;/strong&gt;&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;No. of Cores&lt;/td&gt;\r\n			&lt;td&gt;1&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;', NULL),
(6, 3, 'Samsung A50', 1, NULL, 1, '&lt;p&gt;&lt;strong&gt;Intel Core 2 Duo processor&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Powered by an Intel Core 2 Duo processor at speeds up to 2.16GHz, the new MacBook is the fastest ever.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;1GB memory, larger hard drives&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;The new MacBook now comes with 1GB of memory standard and larger hard drives for the entire line perfect for running more of your favorite applications and storing growing media collections.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Sleek, 1.08-inch-thin design&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;MacBook makes it easy to hit the road thanks to its tough polycarbonate case, built-in wireless technologies, and innovative MagSafe Power Adapter that releases automatically if someone accidentally trips on the cord.&lt;/p&gt;\r\n\r\n&lt;p&gt;&lt;strong&gt;Built-in iSight camera&lt;/strong&gt;&lt;/p&gt;\r\n\r\n&lt;p&gt;Right out of the box, you can have a video chat with friends or family,2 record a video at your desk, or take fun pictures with Photo Booth&lt;/p&gt;', '5f78449d9c707product.jpg', 'samsung-a50', '', '', '', '', '', NULL, 'p', '2020-10-03 15:00:05', '&lt;table&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;td colspan=&quot;2&quot;&gt;&lt;strong&gt;Memory&lt;/strong&gt;&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;test 1&lt;/td&gt;\r\n			&lt;td&gt;8gb&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;\r\n\r\n&lt;table&gt;\r\n	&lt;thead&gt;\r\n		&lt;tr&gt;\r\n			&lt;td colspan=&quot;2&quot;&gt;&lt;strong&gt;Processor&lt;/strong&gt;&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/thead&gt;\r\n	&lt;tbody&gt;\r\n		&lt;tr&gt;\r\n			&lt;td&gt;No. of Cores&lt;/td&gt;\r\n			&lt;td&gt;1&lt;/td&gt;\r\n		&lt;/tr&gt;\r\n	&lt;/tbody&gt;\r\n&lt;/table&gt;', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `join_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `terms`
--

CREATE TABLE `terms` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms`
--

INSERT INTO `terms` (`id`, `heading`, `content`, `seo_title`, `seo_keywords`, `seo_description`) VALUES
(1, 'Privacy Policy', '&lt;p style=&quot;text-align:justify&quot;&gt;&lt;strong&gt;Lorem Ipsum&lt;/strong&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;', 'Privacy Policy', 'Privacy Policy', 'Privacy Policy'),
(14, 'Shipping Policy', '&lt;p&gt;Shipping Policy&lt;/p&gt;', 'Shipping Policy', 'Shipping Policy', 'Shipping Policy'),
(15, 'Terms &amp; Condition', '&lt;p&gt;Terms&amp;nbsp;&amp;amp;&amp;nbsp;Condition&lt;/p&gt;', 'Terms &amp; Condition', 'Terms &amp; Condition', 'Terms &amp; Condition');

-- --------------------------------------------------------

--
-- Table structure for table `ti_about_us`
--

CREATE TABLE `ti_about_us` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `seo_keywords` text DEFAULT NULL,
  `seo_title` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ti_about_us`
--

INSERT INTO `ti_about_us` (`id`, `heading`, `description`, `image`, `seo_description`, `seo_keywords`, `seo_title`) VALUES
(1, '', '&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;\r\n\r\n&lt;p&gt;Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&amp;#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/p&gt;', 'about-text.jpg', 'Know About Us', 'Know About Us', 'Know About Us');

-- --------------------------------------------------------

--
-- Table structure for table `ti_attributes`
--

CREATE TABLE `ti_attributes` (
  `id` int(11) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `strength` varchar(255) DEFAULT NULL,
  `min_quantity` int(11) NOT NULL DEFAULT 1,
  `price` float NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ti_attributes`
--

INSERT INTO `ti_attributes` (`id`, `parent`, `size`, `strength`, `min_quantity`, `price`) VALUES
(9, 4, 'black', NULL, 1, 200),
(10, 4, 'silver', NULL, 1, 300),
(11, 4, 'green', NULL, 1, 300),
(12, 5, 'rosegold', NULL, 1, 1000),
(13, 5, 'golden', NULL, 1, 1300),
(14, 6, 'blue', NULL, 1, 500),
(15, 6, 'black', NULL, 1, 600);

-- --------------------------------------------------------

--
-- Table structure for table `ti_contact_us`
--

CREATE TABLE `ti_contact_us` (
  `id` int(11) NOT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `subheading` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_one` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `main_office` text DEFAULT NULL,
  `region_office` text DEFAULT NULL,
  `office_time` varchar(255) NOT NULL,
  `skype` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ti_contact_us`
--

INSERT INTO `ti_contact_us` (`id`, `heading`, `subheading`, `description`, `phone`, `phone1`, `email`, `email_one`, `address`, `main_office`, `region_office`, `office_time`, `skype`) VALUES
(1, '', '', '', '123456789', '32134654', 'info@gmail.com', 'info@gmail.com', NULL, 'Address', '', '', '32134654');

-- --------------------------------------------------------

--
-- Table structure for table `ti_coupon`
--

CREATE TABLE `ti_coupon` (
  `id` int(11) NOT NULL,
  `coupon_code` varchar(255) NOT NULL,
  `coupon_price` decimal(10,2) DEFAULT 0.00
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ti_coupon`
--

INSERT INTO `ti_coupon` (`id`, `coupon_code`, `coupon_price`) VALUES
(2, 'RAKHI20', '20.00');

-- --------------------------------------------------------

--
-- Table structure for table `ti_port`
--

CREATE TABLE `ti_port` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ti_port`
--

INSERT INTO `ti_port` (`id`, `name`, `icon`, `description`) VALUES
(1, 'Most Trusted', 'fa fa-bullhorn', '&lt;p style=&quot;text-align:justify&quot;&gt;We are the most-trusted entity of bulk services, especially known for the experience of exporting to world-class traders at wholesale price.&lt;/p&gt;'),
(2, 'Healthy Environment', 'fa fa-arrows', '&lt;p style=&quot;text-align:justify&quot;&gt;The producer and manufacturer of our company, work in the healthiest environment in the most organic way possible.&lt;/p&gt;'),
(3, 'Serves Originality', 'fa fa-archive', '&lt;p style=&quot;text-align:justify&quot;&gt;We deliver the requirements to you in bulk, are 100% unprocessed and raw, especially popular for originality, no chemicals are used during procession.&lt;/p&gt;'),
(4, 'Customer Friendly', 'fa fa-anchor', '&lt;p style=&quot;text-align:justify&quot;&gt;We respect our customers and thus provide them with the high-grade hospitality, without hesitation.&lt;/p&gt;'),
(5, 'What kind of products quality you provide?', '', '&lt;p&gt;We are the best sellers of marijuana and medical weed and our weed is of high quality.&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `ti_pro_review`
--

CREATE TABLE `ti_pro_review` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` int(10) NOT NULL DEFAULT 0,
  `name` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` int(2) NOT NULL DEFAULT 0,
  `read_status` tinyint(2) NOT NULL DEFAULT 0,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `type` char(10) DEFAULT 'review'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ti_pro_review`
--

INSERT INTO `ti_pro_review` (`id`, `product_id`, `rating`, `name`, `country`, `phone`, `email`, `title`, `message`, `status`, `read_status`, `create_date`, `type`) VALUES
(1, 206, 3, 'Tress kita', NULL, NULL, 'test@gmail.com', 'Gud Product', 'Gud PRoduct', 1, 1, '2020-07-31 15:27:50', 'review'),
(2, 206, 4, 'Tress kita', NULL, NULL, 'test@gmail.com', 'Amazing Products', 'Gud', 1, 1, '2020-07-31 21:15:07', 'review'),
(3, 6, 4, 'john', NULL, NULL, NULL, NULL, 'very gud product', 1, 1, '2020-10-04 19:36:32', 'review'),
(4, 4, 5, 'Jackob Kita', NULL, '987654444', 'jacki@ymail.com', NULL, 'ad', 0, 1, '2020-10-15 15:02:16', 'review'),
(5, 5, 5, 'Tress kita', NULL, NULL, 'test@gmail.com', NULL, 'asa', 0, 1, '2020-10-16 22:27:17', 'review');

-- --------------------------------------------------------

--
-- Table structure for table `ti_slider`
--

CREATE TABLE `ti_slider` (
  `id` int(100) NOT NULL,
  `image` varchar(255) NOT NULL,
  `fheading` text DEFAULT NULL,
  `sheading` text DEFAULT NULL,
  `img_alt` varchar(255) NOT NULL,
  `img_title` varchar(255) NOT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'p'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ti_slider`
--

INSERT INTO `ti_slider` (`id`, `image`, `fheading`, `sheading`, `img_alt`, `img_title`, `status`) VALUES
(11, '5f87f2ff80ffcslide3.jpg', '', '', '', '', 'p'),
(12, '5f89a4e7adbaeslide2.jpg', '', '', '', '', 'p'),
(13, '5f89a4dc671d2slide1.jpg', '', '', 'slide1', 'slide1', 'p');

-- --------------------------------------------------------

--
-- Table structure for table `ti_social_links`
--

CREATE TABLE `ti_social_links` (
  `id` int(11) NOT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twiter_link` varchar(255) DEFAULT NULL,
  `linkdin_link` varchar(255) DEFAULT NULL,
  `youtube` varchar(255) DEFAULT NULL,
  `google_plus` varchar(255) DEFAULT NULL,
  `pintrest` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ti_social_links`
--

INSERT INTO `ti_social_links` (`id`, `facebook_link`, `twiter_link`, `linkdin_link`, `youtube`, `google_plus`, `pintrest`) VALUES
(1, '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `ti_testi`
--

CREATE TABLE `ti_testi` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ti_testi`
--

INSERT INTO `ti_testi` (`id`, `name`, `image`, `date`, `description`) VALUES
(8, 'Jony', '5f87fd36a1badtestimonial.jpg', '2019-08-02', '&lt;p style=&quot;text-align:justify&quot;&gt;Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...&amp;quot; &amp;quot;There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain&lt;/p&gt;'),
(9, 'Ad sun', '5f87fd284d6f4testimonial.jpg', '2019-08-01', '&lt;p&gt;Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...&amp;quot; &amp;quot;There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain.&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `ti_tracking_history`
--

CREATE TABLE `ti_tracking_history` (
  `id` int(11) NOT NULL,
  `track_id` int(11) NOT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ti_tracking_history`
--

INSERT INTO `ti_tracking_history` (`id`, `track_id`, `date`, `time`, `location`, `status`, `remarks`) VALUES
(6, 9, '20-02-2018', '02:45pm', '54 Farndon Way Mansfield Nottinghamshire NG19 6SR UK', 'on hold', 'GOOD'),
(7, 8, '2018-03-10', '10:11 AM', 'jaipur', 'active', 'done'),
(8, 11, '12/06/2018', '4 pm', 'New Zealand', 'in transit', 'the package has been released from custom but you need to pay');

-- --------------------------------------------------------

--
-- Table structure for table `tracking`
--

CREATE TABLE `tracking` (
  `id` int(11) NOT NULL,
  `tracking_id` varchar(255) NOT NULL,
  `ship_name` varchar(255) DEFAULT NULL,
  `recv_name` varchar(255) DEFAULT NULL,
  `ship_phone` varchar(255) DEFAULT NULL,
  `recv_phone` varchar(255) DEFAULT NULL,
  `ship_add` text DEFAULT NULL,
  `recv_add` text DEFAULT NULL,
  `ship_email` varchar(255) DEFAULT NULL,
  `recv_email` varchar(255) DEFAULT NULL,
  `ship_type` varchar(255) DEFAULT NULL,
  `weight` varchar(255) DEFAULT NULL,
  `courier` varchar(255) DEFAULT NULL,
  `packages` varchar(255) DEFAULT NULL,
  `mode` varchar(255) DEFAULT NULL,
  `product` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `carrier_name` varchar(255) DEFAULT NULL,
  `ref_no` varchar(255) DEFAULT NULL,
  `dep_time` varchar(255) DEFAULT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `pickup_time` varchar(255) DEFAULT NULL,
  `pickup_date` varchar(255) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `expected_date` varchar(255) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tracking`
--

INSERT INTO `tracking` (`id`, `tracking_id`, `ship_name`, `recv_name`, `ship_phone`, `recv_phone`, `ship_add`, `recv_add`, `ship_email`, `recv_email`, `ship_type`, `weight`, `courier`, `packages`, `mode`, `product`, `quantity`, `payment_mode`, `carrier_name`, `ref_no`, `dep_time`, `origin`, `pickup_time`, `pickup_date`, `destination`, `status`, `expected_date`, `comments`, `date`) VALUES
(9, 'US75829', 'J. Marco', 'Brett Coupe', 'N/A', 'n/a@gmail.com', '1240 w 105th St #9,California, USA', '54 Farndon Way Mansfield  Nottinghamshire  NG19 6SR UK', 'alexmoghan002@gmail.com', 'n/a@gmail.com', 'air freight', '15kg', 'GBI', 'DISCREET', 'air', 'CONFIDENTIAL', '1', 'BIT COIN', 'Ups', '94659#J65', '10:45 AM', 'India', '01:30 PM', '02/23/2018', 'jaipur', 'ACTIVE', '02/23/2018', 'sajdvsadvasvdhsvad', '2018-02-17 08:51:31'),
(11, 'US61682', 'Terrific Pharmacy', 'Abhishek Sukhija', '7754993320', 'mikeuptain@gmail.com', '115 N Carmelita St', '115 N Carmelita St', 'mikeuptain@gmail.com', 'mikeuptain@gmail.com', 'air freight', '10 gm', 'DHL', '1', 'air', 'Viagra', '10 Pills', 'BIT COIN', 'Ups', '358964', '07:00 PM', 'New york', '07:15 PM', '06/30/2018', 'Florida', 'ON HOLD', '06/30/2018', 'the package is with custom now', '2018-06-12 06:46:01');

-- --------------------------------------------------------

--
-- Table structure for table `track_seo`
--

CREATE TABLE `track_seo` (
  `id` int(11) NOT NULL,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` text DEFAULT NULL,
  `seo_keywords` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `track_seo`
--

INSERT INTO `track_seo` (`id`, `seo_title`, `seo_description`, `seo_keywords`) VALUES
(1, 'Track', 'Track', 'Track');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `create_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modify_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'p',
  `img` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `user_type` varchar(50) DEFAULT 'Not Guest'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_address`
--

CREATE TABLE `user_address` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `comp_name` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `address_alt` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `address2` text DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_counter`
--

CREATE TABLE `visitor_counter` (
  `id` int(100) NOT NULL,
  `ip_address` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_user`
--
ALTER TABLE `admin_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `analytics`
--
ALTER TABLE `analytics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banner`
--
ALTER TABLE `banner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat_code`
--
ALTER TABLE `chat_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_summary`
--
ALTER TABLE `order_summary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_option`
--
ALTER TABLE `payment_option`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privacy`
--
ALTER TABLE `privacy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `terms`
--
ALTER TABLE `terms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ti_about_us`
--
ALTER TABLE `ti_about_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ti_attributes`
--
ALTER TABLE `ti_attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ti_contact_us`
--
ALTER TABLE `ti_contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ti_coupon`
--
ALTER TABLE `ti_coupon`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ti_port`
--
ALTER TABLE `ti_port`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ti_pro_review`
--
ALTER TABLE `ti_pro_review`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ti_slider`
--
ALTER TABLE `ti_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ti_social_links`
--
ALTER TABLE `ti_social_links`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ti_testi`
--
ALTER TABLE `ti_testi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ti_tracking_history`
--
ALTER TABLE `ti_tracking_history`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracking`
--
ALTER TABLE `tracking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track_seo`
--
ALTER TABLE `track_seo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`email`);

--
-- Indexes for table `user_address`
--
ALTER TABLE `user_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visitor_counter`
--
ALTER TABLE `visitor_counter`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_user`
--
ALTER TABLE `admin_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `analytics`
--
ALTER TABLE `analytics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `banner`
--
ALTER TABLE `banner`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog`
--
ALTER TABLE `blog`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chat_code`
--
ALTER TABLE `chat_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home`
--
ALTER TABLE `home`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_summary`
--
ALTER TABLE `order_summary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_option`
--
ALTER TABLE `payment_option`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `privacy`
--
ALTER TABLE `privacy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `terms`
--
ALTER TABLE `terms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ti_about_us`
--
ALTER TABLE `ti_about_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ti_attributes`
--
ALTER TABLE `ti_attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `ti_contact_us`
--
ALTER TABLE `ti_contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ti_coupon`
--
ALTER TABLE `ti_coupon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `ti_port`
--
ALTER TABLE `ti_port`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `ti_pro_review`
--
ALTER TABLE `ti_pro_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `ti_slider`
--
ALTER TABLE `ti_slider`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `ti_social_links`
--
ALTER TABLE `ti_social_links`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ti_testi`
--
ALTER TABLE `ti_testi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ti_tracking_history`
--
ALTER TABLE `ti_tracking_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tracking`
--
ALTER TABLE `tracking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `track_seo`
--
ALTER TABLE `track_seo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_address`
--
ALTER TABLE `user_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor_counter`
--
ALTER TABLE `visitor_counter`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
