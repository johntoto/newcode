-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2017 at 04:14 PM
-- Server version: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webmarketer`
--

-- --------------------------------------------------------

--
-- Table structure for table `businesses`
--

CREATE TABLE `businesses` (
  `businessId` int(11) NOT NULL,
  `businessName` varchar(100) NOT NULL,
  `slogan` varchar(200) DEFAULT NULL,
  `addedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `address` varchar(100) NOT NULL,
  `phoneNo` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `owner` varchar(200) NOT NULL,
  `profilePic` varchar(100) NOT NULL,
  `locatedAt` varchar(200) NOT NULL,
  `website` varchar(100) DEFAULT NULL,
  `activeLevel` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `businesses`
--

INSERT INTO `businesses` (`businessId`, `businessName`, `slogan`, `addedOn`, `category`, `description`, `address`, `phoneNo`, `email`, `owner`, `profilePic`, `locatedAt`, `website`, `activeLevel`) VALUES
(1, 'Homeland Company', 'This is an awesome busfiness that fits your desires and for your luxury.', '2017-04-08 06:55:16', '1', 'We deal with all salon products and offer a wide range of other services.', '123-123', '0714417023', 'master@yahoo.com', '1', 'help-mountains-Lord-wallpaper_1366x768.jpg', '6', 'www.sots.com', 4),
(2, 'Almond technologies', 'Dream big', '2017-03-11 06:20:16', '7', 'We make your dreams a reality', '86656', '987656', 'master@yahoo.com', '1', 'help-mountains-Lord-wallpaper_1366x768.jpg', '4', 'www.almond.com', 2),
(3, 'Chomelea engineering firm', 'It is within you', '2017-03-24 08:36:01', '8', 'Have the best', '89747', '34455', 'master@yahoo.com', '2', 'tooplate_image_05.jpg', '4', 'www.chomelea,com', 3),
(5, 'Aberdares Computer Repair shop', 'Nothing is impossible', '2017-03-14 07:02:01', '2', 'We give our service to the best satisfaction of the client', '1233', '9048', 'master@yahoo.com', '12', 'tooplate_image_05.jpg', '1', 'www.aberdares.com', 2),
(6, 'Luvon Designs', 'We make your love a reality', '2017-03-18 10:40:47', '7', 'All the great designs and artistic builds', '3234', '0714417023', 'master@yahoo.com', '2', 'It-is-good-to-praise-the-Lord-christian-wallpaper-hd_1366x768.jpg', '5', 'www.luvondsigns.com', 1),
(8, 'One stop Duti Shop', 'dfsdz', '2017-04-04 20:13:03', '2', 'wert', '3234', '0714417023', 'sots@gmail.com', '2', 'computer-hd-wallpaper-21.jpg', '11', 'www.sots.com', 2),
(9, 'Copun Fashion', 'Clothes speak louder than words', '2017-04-03 19:10:15', '5', 'We create fashion designed to suit your taste', '1242', '2444', 'coupo@yahoo.com', '5', '1920x1200-data-out-38-45407257-business-wallpaper.jpg', '13', 'www.copun.com', 1),
(10, 'donut manenoz', 'men eat', '2017-04-05 09:50:30', '6', 'sells hot donut with no holes at the center', '65686 mombasa', '0721255065', 'donut@gmail.com', '1', 'be962eaa0889fb7a1085f4241e9a89b63cb8d827.jpg', '1', 'www.donut.co.ckg', 2);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categoryId` int(11) NOT NULL,
  `categoryName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categoryId`, `categoryName`) VALUES
(1, 'House management Agency'),
(2, 'Law Firm'),
(3, 'Computers and  Accesories'),
(6, 'Grocery &amp; Agricultural Products'),
(7, 'Electronics Shop'),
(8, 'Security Agency'),
(9, 'Plumbers'),
(10, 'Data Security'),
(11, 'E-commerce');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cityId` int(11) NOT NULL,
  `cityName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityId`, `cityName`) VALUES
(1, 'Nairobi'),
(2, 'kisumu'),
(3, 'Mombasa'),
(4, 'Naks Vegas'),
(5, 'NewKings');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `commentId` int(11) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `businessId` int(11) NOT NULL,
  `addedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`commentId`, `fullName`, `email`, `comment`, `businessId`, `addedOn`) VALUES
(1, 'dodohat', 'dodo@gmail.com', 'That product was awesome', 1, '2017-03-08 08:42:42'),
(2, 'sijui', 'onetrade@yahoo.com', 'wwwwwwwwwwwwwww', 8, '2017-03-22 16:58:35'),
(3, 'erty', 'wrr', 'ewr', 8, '2017-03-22 17:00:06'),
(4, 'Udeko', 'chomelea@outlook.com', 'We are detos', 8, '2017-03-22 17:03:42'),
(5, 'Hello', 'hello@yahoo.com', 'Hello was here to see it\r\n', 8, '2017-03-22 17:39:25'),
(6, 'mambo', 'johntoto67@gmail.com', 'wee', 1, '2017-04-11 14:27:37'),
(7, 'Dodo', 'johntoto67@gmail.com', 'Beautiful product', 1, '2017-04-11 14:27:59'),
(8, 'mambo', 'igkufk@gmail.com', 'Poor devices', 1, '2017-04-11 14:28:18'),
(9, 'mambo', 'johntoto67@gmail.com', 'Woow so beautiful', 1, '2017-04-11 14:28:34'),
(10, 'capsule', 'capsule$@gmail.com', 'Oooooh so sweet and deliciously made', 10, '2017-04-14 01:22:27'),
(11, 'Dodo', 'robmainah@gmail.com', 'hjbh', 10, '2017-04-15 17:48:39');

-- --------------------------------------------------------

--
-- Table structure for table `customerservices`
--

CREATE TABLE `customerservices` (
  `serviceId` int(11) NOT NULL,
  `businessId` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `addedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customerservices`
--

INSERT INTO `customerservices` (`serviceId`, `businessId`, `title`, `description`, `addedOn`) VALUES
(1, 1, 'Buy ', 'saasfghjkl./', '2017-03-17 21:10:41'),
(5, 5, 'wert', 'wertyuio', '2017-03-17 21:40:33'),
(6, 4, 'Brand new devices', 'new devices', '2017-03-17 21:42:49'),
(8, 3, 'New shoes', 'nop', '2017-03-17 21:42:57'),
(9, 2, 'wert', 'asdfgh', '2017-03-17 21:42:23'),
(10, 8, 'Buy one get two', 'Buy one get', '2017-03-22 18:14:25'),
(11, 1, 'free vouchers', 'Buy one get ', '2017-03-22 18:14:17');

-- --------------------------------------------------------

--
-- Table structure for table `offers`
--

CREATE TABLE `offers` (
  `offerId` int(11) NOT NULL,
  `offerTitle` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `addedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `validUntil` date NOT NULL,
  `businessId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offers`
--

INSERT INTO `offers` (`offerId`, `offerTitle`, `description`, `addedOn`, `validUntil`, `businessId`) VALUES
(4, 'free vouchers', 'buy more stand a chance to win prizws', '2017-03-10 18:19:42', '2017-03-30', 1),
(5, 'Soaps offer', 'Buy 1liter and get one', '2017-03-10 19:53:12', '2017-03-30', 4),
(8, 'New shoes', 'New shoes', '2017-03-11 08:39:38', '2018-03-12', 5),
(12, 'free goodies', 'Just come and get goodies', '2017-03-11 14:14:22', '2017-12-02', 7),
(13, 'Brand new devices', 'Get new things for your house and work', '2017-03-11 14:16:28', '2018-03-12', 7),
(14, 'Buy one get two', 'We are giving out free gifts', '2017-03-21 18:38:17', '2017-03-29', 8),
(15, 'free vouchers', 'Free buying vouchers for those who buy severally', '2017-03-21 18:45:43', '2017-03-31', 2),
(16, 'Soaps offer', 'Buy any product for free', '2017-03-21 18:49:19', '2017-03-30', 1),
(17, 'New donutoz', 'Free donutoz', '2017-04-14 02:33:46', '2017-04-15', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pics`
--

CREATE TABLE `pics` (
  `picId` int(11) NOT NULL,
  `picture` varchar(100) NOT NULL,
  `picTitle` varchar(100) NOT NULL,
  `businessId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pics`
--

INSERT INTO `pics` (`picId`, `picture`, `picTitle`, `businessId`) VALUES
(1, '931be13d624e67ef17f5ff953e4fc6dd.jpg', 'dd', 1),
(2, '5846ca675fea38ddb7cc746599c60897.jpg', 'So beautiful', 2),
(3, 'ca826080d537ff2f4c4751aaec4728e1.jpg', 'New fashio', 1),
(7, 'b2a368ae918b17df1046b43b91674f43.jpg', 'Latest style', 10),
(8, 'gourmet-grocery-store.jpg', 'New foods', 10);

-- --------------------------------------------------------

--
-- Table structure for table `towns`
--

CREATE TABLE `towns` (
  `townId` int(11) NOT NULL,
  `townName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `towns`
--

INSERT INTO `towns` (`townId`, `townName`) VALUES
(1, 'Mombasa'),
(2, 'Nyeri'),
(3, 'Kisumu'),
(4, 'Kiambu'),
(5, 'Eldoret'),
(6, 'Busia'),
(9, 'Kericho'),
(10, 'Kitui'),
(11, 'Garrisa'),
(12, 'Mtwapa'),
(13, 'Mwingi'),
(14, 'mwala');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` int(11) NOT NULL,
  `userName` varchar(200) NOT NULL,
  `fullName` varchar(200) DEFAULT NULL,
  `idNumber` varchar(30) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `city` int(11) NOT NULL,
  `town` varchar(50) NOT NULL DEFAULT 'Lampun',
  `address` varchar(100) DEFAULT NULL,
  `phoneNo` varchar(20) DEFAULT NULL,
  `addedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(200) NOT NULL,
  `administrator` set('YES','NO') NOT NULL DEFAULT 'NO',
  `activated` set('YES','NO') NOT NULL DEFAULT 'NO',
  `entry` int(11) NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `fullName`, `idNumber`, `email`, `city`, `town`, `address`, `phoneNo`, `addedOn`, `password`, `administrator`, `activated`, `entry`) VALUES
(1, 'user', 'User', '8777', 'johntoto67@gmail.com', 3, 'Lampun', '123', '567', '2017-04-03 21:32:46', 'user', 'NO', 'YES', 2),
(2, 'admin', 'Admin', '4677', 'admin@yahoo.com', 5, 'Lampun', '123', '1234', '2017-04-03 21:32:46', 'Admin', 'YES', 'YES', 2),
(4, 'johnnie', 'Master', '1234', 'master@yahoo.com', 4, 'Lampun', '123', '1234', '2017-04-03 21:32:46', 'john', 'NO', 'NO', 2),
(6, 'mercy', 'Jane mercy', '1234', 'a@gmail.com', 2, 'Lampun', '123', '1234', '2017-04-03 21:32:46', 'john', 'NO', 'NO', 2),
(7, 'johngg', 'John kim', '1234', 'a@gmail.com', 2, 'Lampun', '123', '1234', '2017-04-03 21:32:46', 'john', 'YES', 'NO', 2),
(8, 'marion', 'Marion Haddon', '1234', 'marion@gmail.com', 2, 'Lampun', '123', '1234', '2017-04-03 21:32:46', 'john', 'NO', 'YES', 2),
(9, 'joh', 'john kim', '1234', 'a@gmail.com', 2, 'Lampun', '123', '34455', '2017-04-03 21:32:46', '1234', 'NO', 'YES', 2),
(10, 'muhindi', 'kamamu Muhindi', '2453', 'muhindi@yahoo.com', 3, 'Lampun', '3444', '8944', '2017-04-03 21:32:46', 'Muhindi', 'NO', 'YES', 2),
(11, 'marion2', 'Marion Ohando', '344', 'marion@gmail.com', 4, 'Lampun', '44', '334', '2017-04-03 21:32:46', 'Marion', 'NO', 'YES', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `businesses`
--
ALTER TABLE `businesses`
  ADD PRIMARY KEY (`businessId`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categoryId`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityId`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`commentId`);

--
-- Indexes for table `customerservices`
--
ALTER TABLE `customerservices`
  ADD PRIMARY KEY (`serviceId`);

--
-- Indexes for table `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`offerId`);

--
-- Indexes for table `pics`
--
ALTER TABLE `pics`
  ADD PRIMARY KEY (`picId`);

--
-- Indexes for table `towns`
--
ALTER TABLE `towns`
  ADD PRIMARY KEY (`townId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `businesses`
--
ALTER TABLE `businesses`
  MODIFY `businessId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cityId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `commentId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `customerservices`
--
ALTER TABLE `customerservices`
  MODIFY `serviceId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `offers`
--
ALTER TABLE `offers`
  MODIFY `offerId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pics`
--
ALTER TABLE `pics`
  MODIFY `picId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `towns`
--
ALTER TABLE `towns`
  MODIFY `townId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
