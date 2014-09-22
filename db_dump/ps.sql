-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 22, 2014 at 03:48 PM
-- Server version: 5.6.15
-- PHP Version: 5.5.16-1+deb.sury.org~precise+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ps`
--

-- --------------------------------------------------------

--
-- Table structure for table `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
`id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `file_pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `feedback` text COLLATE utf8_unicode_ci,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `status` enum('ACTIVE','UNACTIVE') COLLATE utf8_unicode_ci DEFAULT 'ACTIVE'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `name`, `description`, `file_pdf`, `video`, `feedback`, `deleted`, `status`) VALUES
(1, 'modul 1', NULL, NULL, NULL, NULL, 0, 'ACTIVE'),
(2, 'modul 2', NULL, NULL, NULL, NULL, 0, 'ACTIVE'),
(3, 'modul 3', NULL, NULL, NULL, NULL, 0, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`id` int(11) unsigned NOT NULL,
  `number` int(11) DEFAULT NULL,
  `status` enum('ACTIVE','UNACTIVE') DEFAULT 'ACTIVE',
  `deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `number`, `status`, `deleted`) VALUES
(1, 123, 'ACTIVE', 0),
(2, 456, 'ACTIVE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
`id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` enum('ACTIVE','UNACTIVE') COLLATE utf8_unicode_ci DEFAULT 'ACTIVE',
  `deleted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `status`, `deleted`) VALUES
(1, 'p1', 'product 1', 'ACTIVE', 0),
(2, 'p2', 'product 2\n', 'ACTIVE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requirement`
--

CREATE TABLE IF NOT EXISTS `requirement` (
`id` int(11) unsigned NOT NULL,
  `description` text,
  `status` enum('ACTIVE','UNACTIVE') DEFAULT 'ACTIVE',
  `deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `requirement`
--

INSERT INTO `requirement` (`id`, `description`, `status`, `deleted`) VALUES
(1, 'requirement 1', 'ACTIVE', 0),
(2, 'requirement 2', 'ACTIVE', 0),
(3, 'requirement 3', 'ACTIVE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `status` enum('ACTIVE','UNACTIVE') NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `deleted`, `status`) VALUES
(1, 'administrator', 0, 'ACTIVE'),
(2, 'developer', 0, 'ACTIVE'),
(3, 'technical', 0, 'ACTIVE'),
(4, 'hotline', 0, 'ACTIVE'),
(5, 'planer', 0, 'ACTIVE'),
(6, 'entwickler', 0, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE IF NOT EXISTS `service` (
`id` int(11) unsigned NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `requirement_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('ACTIVE','UNACTIVE') DEFAULT 'ACTIVE',
  `deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `product_id`, `requirement_id`, `order_id`, `role_id`, `name`, `description`, `created`, `modified`, `status`, `deleted`) VALUES
(6, 1, 2, 1, 2, 'asfdsdfadsf', NULL, '2014-09-22 12:07:46', '2014-09-22 12:07:46', 'ACTIVE', 0),
(7, 1, 2, 1, 2, 'asfdsdfadsf', NULL, '2014-09-22 12:20:54', '2014-09-22 12:20:54', 'ACTIVE', 0),
(8, 1, 1, 1, 2, 'AAAAAA', NULL, '2014-09-22 12:28:11', '2014-09-22 12:28:11', 'ACTIVE', 0),
(9, 1, 1, 1, 2, 'asdfasdfdf', NULL, '2014-09-22 12:28:48', '2014-09-22 12:28:48', 'ACTIVE', 0),
(10, 1, 2, 1, 2, 'test 1', NULL, '2014-09-22 15:40:21', '2014-09-22 15:40:21', 'ACTIVE', 0),
(11, 2, 3, 2, 4, 'tes 2', NULL, '2014-09-22 15:47:11', '2014-09-22 15:47:11', 'ACTIVE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `service_modul`
--

CREATE TABLE IF NOT EXISTS `service_modul` (
`id` int(11) unsigned NOT NULL,
  `modul_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `service_modul`
--

INSERT INTO `service_modul` (`id`, `modul_id`, `service_id`, `position`) VALUES
(4, 1, 6, 1),
(5, 2, 6, 2),
(6, 3, 6, 3),
(7, 1, 7, 1),
(8, 2, 7, 2),
(9, 3, 7, 3),
(10, 1, 8, 1),
(11, 2, 8, 2),
(12, 3, 8, 3),
(13, 1, 9, 1),
(14, 2, 9, 2),
(15, 3, 9, 3),
(16, 2, 10, 1),
(17, 2, 10, 1),
(18, 3, 10, 2),
(19, 2, 10, 1),
(20, 3, 10, 2),
(21, 2, 11, 1),
(22, 3, 11, 2),
(23, 2, 11, 1),
(24, 3, 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `organisation_id` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `status` enum('ACTIVE','UNACTIVE') COLLATE utf8_unicode_ci DEFAULT 'ACTIVE'
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `mail`, `password`, `role_id`, `organisation_id`, `deleted`, `status`) VALUES
(1, 'Danny Wagner', 'wagner@expositio.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, NULL, 0, 'ACTIVE'),
(2, 'Thorsten Klein', 'klein@expositio.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, NULL, 0, 'ACTIVE'),
(5, 'Sandra Caspers', 'sandra.caspers@revierkoenig.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, NULL, 0, 'ACTIVE'),
(4, 'Sandra Rappl', 'sandra.rappl@revierkoenig.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, NULL, 0, 'ACTIVE'),
(6, 'Carla Gatter', 'carla.gatter@revierkoenig.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, NULL, 0, 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `modul`
--
ALTER TABLE `modul`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirement`
--
ALTER TABLE `requirement`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_modul`
--
ALTER TABLE `service_modul`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `requirement`
--
ALTER TABLE `requirement`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `service_modul`
--
ALTER TABLE `service_modul`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
