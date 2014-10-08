-- phpMyAdmin SQL Dump
-- version 4.2.3deb1.precise~ppa.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 08, 2014 at 06:02 PM
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
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) unsigned NOT NULL,
  `comment` text,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `service_id`, `created`, `modified`, `deleted`) VALUES
(3, 'Không chỉ nổi danh với tài năng ngay từ những ngày đầu đến với môn thể dục nghệ thuật, Son Yeon Jae còn được biết đến như là một trong những mỹ nữ thể thao xinh đẹp bậc nhất xứ sở Kim Chi.\n\nBốn năm trước, Son đã xuất sắc mang về huy chương đồng cho môn thể dục dụng cụ Hàn Quốc khi chỉ mới chưa đầy 17 tuổi.\n\nNăm nay, khi vừa bước qua ở tuổi 20, Son được kỳ vọng sẽ mang về HCV cho đoàn Hàn Quốc ở môn thể dục nghệ thuật nữ. Không phụ lòng mong đợi của người hâm mộ nước chủ nhà, cô gái xinh năm 1994 đã xuất sắc giành được ngôi vị cao nhất của phần thi dung toàn năng với tổng số điểm sau bốn phần thi là 71,699 điểm, bỏ xa VĐV đoạt huy chương bạc là Deng Senyue đến gần hai điểm.\n\nTrước đó, trong ngày thi hôm qua, Son cũng đã xuất sắc cùng các đồng đội giành huy chương bạc nội dung đồng đội.\n\nVới chiếc HCV Asiad 17 lần này cộng với tài năng và sắc đẹp của mình, chắc chắn Son Yeon Jae sẽ còn ‘gây sốt’ trên cộng đồng mạng trong những ngày tới. ', 1, 25, '2014-10-02 13:51:31', '2014-10-02 13:51:31', 0),
(4, 'sdafdsfdf', 1, 25, '2014-10-02 13:51:34', '2014-10-02 13:51:34', 0),
(5, 'Hellooooooooooo ', 1, 25, '2014-10-02 13:51:43', '2014-10-02 13:51:43', 0),
(7, 'yahoo', 1, 25, '2014-10-02 13:53:56', '2014-10-02 13:53:56', 0),
(8, 'lelelel', 1, 9, '2014-10-02 13:54:15', '2014-10-02 13:54:15', 0),
(9, 'Phuoc khùng', 1, 25, '2014-10-02 14:22:21', '2014-10-02 14:22:21', 0),
(10, 'fgzds', 1, 24, '2014-10-08 11:02:09', '2014-10-08 11:02:09', 0),
(11, 'aaaaa', 1, 22, '2014-10-08 11:06:44', '2014-10-08 11:06:44', 0);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE IF NOT EXISTS `document` (
`id` int(11) unsigned NOT NULL,
  `modul_id` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` enum('VIDEO','PDF') DEFAULT 'PDF',
  `description` text,
  `status` enum('ACTIVE','UNACTIVE') DEFAULT 'ACTIVE',
  `deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `modul_id`, `link`, `type`, `description`, `status`, `deleted`) VALUES
(15, 4, 'Hello Module', 'PDF', '123123123234', 'ACTIVE', 0),
(16, 4, 'Hello Module', 'PDF', '', 'ACTIVE', 0),
(17, 4, 'Hello Module', 'PDF', '', 'ACTIVE', 0),
(18, 5, 'asdf', 'PDF', 'sdfdfdf', 'ACTIVE', 0);

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
  `type` enum('Standard','Normal') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Standard',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `status` enum('ACTIVE','UNACTIVE') COLLATE utf8_unicode_ci DEFAULT 'ACTIVE'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `modul`
--

INSERT INTO `modul` (`id`, `name`, `description`, `file_pdf`, `video`, `feedback`, `type`, `deleted`, `status`) VALUES
(1, 'modul 1', '', NULL, NULL, NULL, 'Standard', 0, 'ACTIVE'),
(2, 'modul 2', NULL, NULL, NULL, NULL, 'Normal', 0, 'ACTIVE'),
(3, 'modul 3', NULL, NULL, NULL, NULL, 'Normal', 0, 'ACTIVE'),
(4, 'AAAAA', 'sdafdsf', NULL, NULL, NULL, 'Normal', 0, 'ACTIVE'),
(5, 'test 123123', 'test', NULL, NULL, NULL, 'Normal', 0, 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `modul_roles`
--

CREATE TABLE IF NOT EXISTS `modul_roles` (
  `id` int(11) unsigned NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `modul_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
`id` int(11) unsigned NOT NULL,
  `number` int(11) DEFAULT NULL,
  `status` enum('Finish','Unfinished') DEFAULT 'Unfinished',
  `deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `number`, `status`, `deleted`) VALUES
(1, 123, 'Finish', 0),
(2, 456, 'Unfinished', 0);

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
  `deleted` tinyint(4) DEFAULT '0',
  `type` enum('Standard','Normal') DEFAULT 'Normal',
  `customer_view` enum('Allow','Deny') DEFAULT 'Deny'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `product_id`, `requirement_id`, `order_id`, `role_id`, `name`, `description`, `created`, `modified`, `status`, `deleted`, `type`, `customer_view`) VALUES
(6, 1, 2, 1, 2, 'asfdsdfadsf', NULL, '2014-09-22 12:07:46', '2014-09-22 12:07:46', 'ACTIVE', 0, 'Normal', 'Allow'),
(7, 1, 2, 1, 2, 'asfdsdfadsf', NULL, '2014-09-22 12:20:54', '2014-09-22 12:20:54', 'ACTIVE', 0, 'Normal', 'Allow'),
(8, 1, 1, 0, 2, 'AAAAAA', NULL, '2014-09-22 12:28:11', '2014-09-22 12:28:11', 'ACTIVE', 0, 'Normal', 'Allow'),
(9, 1, 1, 1, 2, 'asdfasdfdf', NULL, '2014-09-22 12:28:48', '2014-09-22 12:28:48', 'ACTIVE', 0, 'Normal', 'Allow'),
(10, 1, 2, 0, 2, 'test 1', NULL, '2014-09-22 15:40:21', '2014-09-22 15:40:21', 'ACTIVE', 0, 'Normal', 'Allow'),
(11, 2, 3, 2, 4, 'tes 2', NULL, '2014-09-22 15:47:11', '2014-09-22 15:47:11', 'ACTIVE', 0, 'Standard', 'Allow'),
(12, 1, 1, 1, NULL, 'test 3', NULL, '2014-10-01 14:49:23', '2014-10-01 14:49:23', 'ACTIVE', 0, 'Standard', 'Allow'),
(13, 1, 1, 1, NULL, 'test 3', NULL, '2014-10-01 14:49:23', '2014-10-01 14:49:23', 'ACTIVE', 0, 'Standard', 'Allow'),
(14, 1, 2, 1, NULL, 'tes 4', NULL, '2014-10-01 14:50:45', '2014-10-01 14:50:45', 'ACTIVE', 0, 'Standard', 'Allow'),
(15, 1, 2, 1, NULL, 'tes 4', NULL, '2014-10-01 14:50:45', '2014-10-01 14:50:45', 'ACTIVE', 0, 'Standard', 'Allow'),
(16, 1, 1, 1, NULL, 'testt', NULL, '2014-10-01 14:54:22', '2014-10-01 14:54:22', 'ACTIVE', 0, 'Standard', 'Allow'),
(17, 1, 1, 1, NULL, 'testt', NULL, '2014-10-01 14:54:22', '2014-10-01 14:54:22', 'ACTIVE', 0, 'Standard', 'Allow'),
(18, 1, 2, 1, NULL, 'test 5', NULL, '2014-10-01 14:55:05', '2014-10-01 14:55:05', 'ACTIVE', 0, 'Standard', 'Allow'),
(19, 1, 2, 1, NULL, 'test 5', NULL, '2014-10-01 14:55:05', '2014-10-01 14:55:05', 'ACTIVE', 0, 'Standard', 'Allow'),
(20, 1, 1, 0, NULL, 'test 6', NULL, '2014-10-01 14:55:58', '2014-10-01 14:55:58', 'ACTIVE', 0, 'Standard', 'Allow'),
(21, 1, 1, 1, NULL, 'test 6', NULL, '2014-10-01 14:55:58', '2014-10-01 14:55:58', 'ACTIVE', 0, 'Standard', 'Allow'),
(22, 1, 2, 1, NULL, 'test3', NULL, '2014-10-01 14:58:01', '2014-10-01 14:58:01', 'ACTIVE', 0, 'Standard', 'Allow'),
(23, 1, 2, 0, NULL, 'test3', NULL, '2014-10-01 14:58:01', '2014-10-01 14:58:01', 'ACTIVE', 0, 'Standard', 'Allow'),
(24, 1, 1, 1, NULL, 'dasfdsfdaaa', NULL, '2014-10-01 14:59:27', '2014-10-01 14:59:27', 'ACTIVE', 0, 'Standard', 'Allow'),
(25, 1, 1, 1, NULL, 'dasfdsfdaaa', NULL, '2014-10-01 14:59:27', '2014-10-01 14:59:27', 'ACTIVE', 0, 'Normal', 'Allow'),
(26, 1, 1, 1, NULL, 'AAAAA', NULL, '2014-10-01 14:59:57', '2014-10-01 14:59:57', 'ACTIVE', 0, 'Standard', 'Allow'),
(27, 1, 1, 1, NULL, 'AAAAA', NULL, '2014-10-01 14:59:57', '2014-10-01 14:59:57', 'ACTIVE', 0, 'Standard', 'Allow'),
(28, 1, 1, 1, NULL, 'TTTTTTT', NULL, '2014-10-01 15:20:01', '2014-10-01 15:20:01', 'ACTIVE', 0, 'Standard', 'Allow'),
(29, 1, 1, 0, NULL, 'test 6', NULL, '2014-10-08 17:35:07', '2014-10-08 17:35:07', 'ACTIVE', 0, 'Normal', 'Allow'),
(30, 2, 1, 0, NULL, 'AAAAAA', NULL, '2014-10-08 17:39:18', '2014-10-08 17:39:18', 'ACTIVE', 0, 'Standard', 'Allow');

-- --------------------------------------------------------

--
-- Table structure for table `service_modul`
--

CREATE TABLE IF NOT EXISTS `service_modul` (
`id` int(11) unsigned NOT NULL,
  `modul_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=138 ;

--
-- Dumping data for table `service_modul`
--

INSERT INTO `service_modul` (`id`, `modul_id`, `service_id`, `position`) VALUES
(6, 3, 6, 3),
(9, 3, 7, 3),
(15, 3, 9, 3),
(55, 4, 11, 1),
(56, 1, 11, 2),
(57, 3, 11, 3),
(58, 2, 11, 4),
(59, 1, 12, 1),
(60, 2, 12, 2),
(61, 3, 12, 3),
(62, 1, 13, 1),
(63, 2, 13, 2),
(64, 3, 13, 3),
(65, 1, 14, 1),
(66, 2, 14, 2),
(67, 1, 15, 1),
(68, 2, 15, 2),
(69, 2, 16, 1),
(70, 3, 16, 2),
(71, 4, 16, 3),
(72, 2, 17, 1),
(73, 3, 17, 2),
(74, 4, 17, 3),
(75, 3, 18, 1),
(76, 4, 18, 2),
(77, 3, 19, 1),
(78, 4, 19, 2),
(80, 4, 21, 1),
(91, 1, 26, 1),
(92, 2, 26, 2),
(93, 3, 26, 3),
(94, 4, 26, 4),
(95, 1, 27, 1),
(96, 2, 27, 2),
(97, 3, 27, 3),
(98, 4, 27, 4),
(99, 1, 28, 1),
(100, 2, 28, 2),
(101, 3, 28, 3),
(109, 2, 25, 1),
(112, 2, 24, 1),
(113, 1, 24, 2),
(120, 2, 22, 1),
(121, 3, 22, 2),
(122, 1, 22, 3),
(126, 4, 29, 1),
(127, 4, 20, 1),
(128, 1, 30, 1),
(129, 2, 30, 2),
(130, 3, 30, 3),
(131, 3, 8, 1),
(132, 4, 8, 2),
(133, 1, 10, 1),
(134, 2, 10, 2),
(135, 4, 10, 3),
(136, 1, 23, 1),
(137, 2, 23, 2);

-- --------------------------------------------------------

--
-- Table structure for table `service_roles`
--

CREATE TABLE IF NOT EXISTS `service_roles` (
`id` int(11) unsigned NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `service_roles`
--

INSERT INTO `service_roles` (`id`, `role_id`, `service_id`) VALUES
(4, 1, 25),
(5, 2, 25),
(6, 5, 25),
(8, 2, 24),
(11, 2, 22),
(15, 2, 29),
(16, 2, 20),
(17, 2, 30),
(18, 2, 8),
(19, 2, 10),
(20, 2, 23);

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
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
 ADD PRIMARY KEY (`id`);

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
-- Indexes for table `service_roles`
--
ALTER TABLE `service_roles`
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
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `modul`
--
ALTER TABLE `modul`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
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
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `service_modul`
--
ALTER TABLE `service_modul`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=138;
--
-- AUTO_INCREMENT for table `service_roles`
--
ALTER TABLE `service_roles`
MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
