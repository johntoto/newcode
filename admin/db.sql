CREATE DATABASE IF NOT EXISTS `webmarketer` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `webmarketer`;

CREATE TABLE IF NOT EXISTS `businesses`
(
`businessId` int(11) PRIMARY KEY AUTO_INCREMENT,
`businessName` varchar(100) NOT NULL,
`slogan` varchar(200) DEFAULT NULL,
`addedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`category` varchar(200) NOT NULL,
`description` text NOT NULL,
`address` varchar(100) NOT NULL,
`city` varchar(100) NOT NULL,
`phoneNo` varchar(30) NOT NULL,
`owner` varchar(200) NOT NULL,
`profilePic` varchar(100) DEFAULT NULL,
`locatedAt` varchar(200) NOT NULL,
`website` varchar(100) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

CREATE TABLE IF NOT EXISTS `categories`
(
`categoryId` int(11) PRIMARY KEY AUTO_INCREMENT,
`categoryName` varchar(50) NOT NULL
);

CREATE TABLE IF NOT EXISTS `comments` (
`commentId` int(11) PRIMARY KEY AUTO_INCREMENT,
`fullName` varchar(100) NOT NULL,
`email` varchar(100) NOT NULL,
`comment` text NOT NULL,
`businessName` varchar(100) NOT NULL,
`addedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
`status` set('Read','Pending') NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

CREATE TABLE IF NOT EXISTS `customerservices` (
`serviceId` int(11) PRIMARY KEY AUTO_INCREMENT,
`businessName` varchar(100) NOT NULL,
`title` varchar(100) NOT NULL,
`description` text,
`addedOn` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

CREATE TABLE IF NOT EXISTS `offers` (
`offerId` int(11) PRIMARY KEY AUTO_INCREMENT,
`offerTitle` varchar(200) NOT NULL,
`description` text NOT NULL,
`addedOn` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
`validUntil` date NOT NULL,
`businessName` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `pics` (
`picId` int (11) PRIMARY KEY AUTO_INCREMENT,
`picture` varchar(100) NOT NULL,
`picTitle` varchar(100) NOT NULL,
`Details` text,
`dictureID` int(11) NOT NULL,
`businessName` varchar(100) NOT NULL,
`addedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

CREATE TABLE IF NOT EXISTS `towns` (
`townId` int(11) PRIMARY KEY AUTO_INCREMENT,
`townName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user` (
`userId` int(11) PRIMARY KEY AUTO_INCREMENT,
`userName` varchar(200) NOT NULL,
`fullName` varchar(200) DEFAULT NULL,
`idNumber` varchar(30) NOT NULL,
`email` varchar(200) DEFAULT NULL,
`city` varchar(100) NOT NULL,
`address` varchar(100) DEFAULT NULL,
`phoneNo` varchar(20) DEFAULT NULL,
`password` varchar(200) NOT NULL,
`administrator` set('YES','NO') NOT NULL DEFAULT 'NO',
`activated` set('YES','NO') NOT NULL DEFAULT 'NO'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
