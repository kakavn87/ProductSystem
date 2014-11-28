-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 27. Nov 2014 um 14:13
-- Server Version: 5.6.14
-- PHP-Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `product_3010`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `applications`
--

CREATE TABLE IF NOT EXISTS `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modul_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '0',
  `developer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `comment` text,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Daten für Tabelle `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `service_id`, `created`, `modified`, `deleted`) VALUES
(3, 'Không chỉ nổi danh với tài năng ngay từ những ngày đầu đến với môn thể dục nghệ thuật, Son Yeon Jae còn được biết đến như là một trong những mỹ nữ thể thao xinh đẹp bậc nhất xứ sở Kim Chi.\n\nBốn năm trước, Son đã xuất sắc mang về huy chương đồng cho môn thể dục dụng cụ Hàn Quốc khi chỉ mới chưa đầy 17 tuổi.\n\nNăm nay, khi vừa bước qua ở tuổi 20, Son được kỳ vọng sẽ mang về HCV cho đoàn Hàn Quốc ở môn thể dục nghệ thuật nữ. Không phụ lòng mong đợi của người hâm mộ nước chủ nhà, cô gái xinh năm 1994 đã xuất sắc giành được ngôi vị cao nhất của phần thi dung toàn năng với tổng số điểm sau bốn phần thi là 71,699 điểm, bỏ xa VĐV đoạt huy chương bạc là Deng Senyue đến gần hai điểm.\n\nTrước đó, trong ngày thi hôm qua, Son cũng đã xuất sắc cùng các đồng đội giành huy chương bạc nội dung đồng đội.\n\nVới chiếc HCV Asiad 17 lần này cộng với tài năng và sắc đẹp của mình, chắc chắn Son Yeon Jae sẽ còn ‘gây sốt’ trên cộng đồng mạng trong những ngày tới. ', 1, 25, '2014-10-02 13:51:31', '2014-10-02 13:51:31', 0),
(4, 'sdafdsfdf', 1, 25, '2014-10-02 13:51:34', '2014-10-02 13:51:34', 0),
(5, 'Hellooooooooooo ', 1, 25, '2014-10-02 13:51:43', '2014-10-02 13:51:43', 0),
(7, 'yahoo', 1, 25, '2014-10-02 13:53:56', '2014-10-02 13:53:56', 0),
(8, 'lelelel', 1, 9, '2014-10-02 13:54:15', '2014-10-02 13:54:15', 0),
(9, 'Phuoc khùng', 1, 25, '2014-10-02 14:22:21', '2014-10-02 14:22:21', 0),
(10, 'fgzds', 1, 24, '2014-10-08 11:02:09', '2014-10-08 11:02:09', 0),
(11, 'aaaaa', 1, 22, '2014-10-08 11:06:44', '2014-10-08 11:06:44', 0),
(12, 'hehehe', 1, 4, '2014-10-16 15:26:01', '2014-10-16 15:26:01', 0),
(13, 'asdfdsf', 1, 4, '2014-10-16 15:30:43', '2014-10-16 15:30:43', 0),
(14, 'sfasdfd', 1, 4, '2014-10-16 15:32:26', '2014-10-16 15:32:26', 0),
(15, 'yoo', 1, 4, '2014-10-16 15:32:51', '2014-10-16 15:32:51', 0),
(16, 'ten', 4, 4, '2014-10-16 15:38:18', '2014-10-16 15:38:18', 0),
(17, 'sadfdsfdsfdf', 6, 4, '2014-10-20 12:33:06', '2014-10-20 12:33:06', 0),
(18, 'aaaa', 5, 1, '2014-10-21 03:41:01', '2014-10-21 03:41:01', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `document`
--

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `modul_id` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` enum('VIDEO','PDF') DEFAULT 'PDF',
  `description` text,
  `status` enum('ACTIVE','UNACTIVE') DEFAULT 'ACTIVE',
  `deleted` tinyint(4) DEFAULT '0',
  `service_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Daten für Tabelle `document`
--

INSERT INTO `document` (`id`, `modul_id`, `link`, `type`, `description`, `status`, `deleted`, `service_id`) VALUES
(46, 3, 'uploads/pdf/a00b47e4f03a391c33b03efaca181008.pdf', 'PDF', '', 'ACTIVE', 0, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `document_services`
--

CREATE TABLE IF NOT EXISTS `document_services` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` enum('VIDEO','PDF') DEFAULT 'PDF',
  `description` text,
  `status` enum('ACTIVE','UNACTIVE') DEFAULT 'ACTIVE',
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Daten für Tabelle `document_services`
--

INSERT INTO `document_services` (`id`, `service_id`, `link`, `type`, `description`, `status`, `deleted`) VALUES
(27, 5, 'https://www.youtube.com/watch?v=jNNz9poyKJs', 'VIDEO', '', 'ACTIVE', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modul`
--

CREATE TABLE IF NOT EXISTS `modul` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `holder_id` int(11) DEFAULT NULL,
  `type` enum('main','sub','support','child') DEFAULT 'main',
  `color` varchar(255) DEFAULT NULL,
  `outsourcing` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Daten für Tabelle `modul`
--

INSERT INTO `modul` (`id`, `name`, `description`, `holder_id`, `type`, `color`, `outsourcing`) VALUES
(1, 'BBB', 'BBB', 5, 'main', '#e3fc03', 0),
(2, 'AAA', 'AAAA', 5, 'support', 'modul_bg_blau.png', 0),
(3, 'TEST', 'test', 5, 'main', 'modul_bg_orange.png', 0),
(4, 'background', 'DDD', 5, '', 'modul_bg_orange.png', 0),
(5, 'EEE', 'EEE', 5, 'support', '#0060b6', 0),
(6, 'hehe', '', 5, 'main', '#e3fc03', 0),
(7, 'ojoj', 'jojoj', 5, 'main', '#e3fc03', 0),
(8, 'aaaa', '', 5, 'main', '#e3fc03', 0),
(9, 'asdasd', '', 5, 'main', '#e3fc03', 0),
(10, 'sdddd', 'ddd', 5, 'main', '#e3fc03', 0),
(11, 'gaga', 'gaga', 5, 'main', '#e3fc03', 0),
(12, 'bobo', '', 5, 'sub', '#0d3839', 0),
(13, 'toto', '', 5, 'support', '#0060b6', 0),
(14, '', '', 5, 'child', '#fafafa', 0),
(15, 'yaya', 'yaya', 5, 'main', '#e3fc03', 0),
(16, 'tata', '', 5, 'child', '#fafafa', 0),
(17, '', '', 5, 'main', '#e3fc03', 0),
(18, 'lululu', 'hahah', 5, 'main', '#e3fc03', 0),
(19, 'ssh', 'ssh', 5, 'main', '#e3fc03', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modul_applies`
--

CREATE TABLE IF NOT EXISTS `modul_applies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` int(11) DEFAULT NULL,
  `status` enum('unselected','selected') COLLATE utf8_unicode_ci DEFAULT 'unselected',
  `partner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modul_patterns`
--

CREATE TABLE IF NOT EXISTS `modul_patterns` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `holder_id` int(11) DEFAULT NULL,
  `type` enum('main','sub','support','child') DEFAULT 'main',
  `color` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Daten für Tabelle `modul_patterns`
--

INSERT INTO `modul_patterns` (`id`, `name`, `description`, `holder_id`, `type`, `color`) VALUES
(1, 'TEST', 'test', 5, 'main', '#e3fc03'),
(2, 'AAA', 'AAAA', 5, 'main', '#e3fc03'),
(3, 'BBB', 'BBB', 5, 'main', '#e3fc03'),
(4, 'CCC', 'CCC', 5, 'main', '#e3fc03'),
(5, 'DDD', 'DDD', 5, 'main', '#e3fc03'),
(6, 'EEE', 'EEEbbb', 5, 'support', '#0060b6'),
(7, 'TESTDDD', 'test', 5, 'main', '#e3fc03'),
(8, 'heheheCCC', 'CCC', 6, 'main', '#d70318');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `modul_requirements`
--

CREATE TABLE IF NOT EXISTS `modul_requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `developer_id` int(11) DEFAULT NULL,
  `type` enum('organization','modul','provider') COLLATE utf8_unicode_ci DEFAULT 'organization',
  `operator` enum('>','<','<=','=','>=') COLLATE utf8_unicode_ci DEFAULT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `number` int(11) DEFAULT NULL,
  `status` enum('Finished','Unfinished') DEFAULT 'Unfinished',
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `order`
--

INSERT INTO `order` (`id`, `number`, `status`, `deleted`) VALUES
(1, 123, 'Finished', 0),
(2, 456, 'Unfinished', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` enum('ACTIVE','UNACTIVE') COLLATE utf8_unicode_ci DEFAULT 'ACTIVE',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Daten für Tabelle `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `status`, `deleted`) VALUES
(1, 'p1', 'product 1', 'ACTIVE', 0),
(2, 'p2', 'product 2\n', 'ACTIVE', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `profiles`
--

CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `operator` varchar(20) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `type` enum('organization','modul','provider') DEFAULT 'organization',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `profiles`
--

INSERT INTO `profiles` (`id`, `name`, `organization`, `user_id`, `operator`, `value`, `type`) VALUES
(1, 'Ausbildung', '', 2, '=', 'Abitur', 'modul');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `report_documents`
--

CREATE TABLE IF NOT EXISTS `report_documents` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `user_id` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `report_documents`
--

INSERT INTO `report_documents` (`id`, `name`, `description`, `user_id`, `deleted`) VALUES
(1, 'Records', NULL, 0, 0),
(2, 'Certifications', NULL, 0, 0),
(3, 'Feedback', '', 0, 0),
(4, 'Reports', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `report_document_details`
--

CREATE TABLE IF NOT EXISTS `report_document_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `report_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

--
-- Daten für Tabelle `report_document_details`
--

INSERT INTO `report_document_details` (`id`, `report_id`, `service_id`, `url`) VALUES
(12, 1, 4, ''),
(13, 2, 4, ''),
(14, 3, 4, ''),
(15, 4, 4, ''),
(16, 1, 1, ''),
(17, 2, 1, ''),
(18, 3, 1, ''),
(19, 4, 1, ''),
(58, 1, 5, ''),
(59, 2, 5, '');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `requirement`
--

CREATE TABLE IF NOT EXISTS `requirement` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `description` text,
  `status` enum('ACTIVE','UNACTIVE') DEFAULT 'ACTIVE',
  `deleted` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Daten für Tabelle `requirement`
--

INSERT INTO `requirement` (`id`, `description`, `status`, `deleted`) VALUES
(1, 'requirement 1', 'ACTIVE', 0),
(2, 'requirement 2', 'ACTIVE', 0),
(3, 'requirement 3', 'ACTIVE', 0);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT '0',
  `status` enum('ACTIVE','UNACTIVE') NOT NULL DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `role`
--

INSERT INTO `role` (`id`, `name`, `deleted`, `status`) VALUES
(1, 'administrator', 0, 'ACTIVE'),
(2, 'developer', 0, 'ACTIVE'),
(3, 'technical', 0, 'ACTIVE'),
(4, 'hotline', 0, 'ACTIVE'),
(5, 'partner', 0, 'ACTIVE'),
(6, 'entwickler', 0, 'ACTIVE'),
(7, 'customer', 0, 'ACTIVE');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `role_requirement`
--

CREATE TABLE IF NOT EXISTS `role_requirement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `service_id` int(11) NOT NULL,
  `operator` varchar(20) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `type` enum('organization','modul','provider') DEFAULT 'organization',
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Daten für Tabelle `role_requirement`
--

INSERT INTO `role_requirement` (`id`, `name`, `organization`, `service_id`, `operator`, `value`, `type`, `role_id`) VALUES
(1, 'Ausbildung', '', 5, '=', 'Abitur', 'modul', 5),
(31, 'ISO', '', 5, '=', '2000', 'organization', 5),
(36, 'ISO', '', 5, '=', '9001', 'modul', 5),
(37, 'ISO', '', 5, '=', '900144', 'modul', 5),
(38, 'ISO', '', 5, '=', '2121', 'organization', 5),
(40, 'ádfdas', '', 5, '=', '', 'organization', 5),
(41, 'ádfdas', '', 5, '=', '', 'organization', 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `service`
--

CREATE TABLE IF NOT EXISTS `service` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `requirement_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('ACTIVE','UNACTIVE','DONE') DEFAULT 'ACTIVE',
  `deleted` tinyint(4) DEFAULT '0',
  `type` enum('Standard','Normal') DEFAULT 'Normal',
  `customer_view` enum('Allow','Deny') DEFAULT 'Deny',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Daten für Tabelle `service`
--

INSERT INTO `service` (`id`, `product_id`, `requirement_id`, `order_id`, `name`, `description`, `created`, `modified`, `status`, `deleted`, `type`, `customer_view`) VALUES
(1, 1, 1, 1, 'AAA', NULL, '2014-10-15 14:15:26', '2014-10-15 14:15:26', 'ACTIVE', 0, 'Normal', 'Deny'),
(2, 1, 1, 1, 'AAA', NULL, '2014-10-15 14:23:34', '2014-10-15 14:23:34', 'ACTIVE', 0, 'Standard', 'Deny'),
(3, 1, 1, 1, 'ahasfgsdfdf', NULL, '2014-10-15 15:15:47', '2014-10-15 15:15:47', 'ACTIVE', 0, 'Standard', 'Deny'),
(4, 1, 1, 1, 'ahello', NULL, '2014-10-15 15:16:22', '2014-10-15 15:16:22', 'ACTIVE', 0, 'Normal', 'Allow'),
(5, 1, 1, 2, 'Wartung', NULL, '2014-11-20 13:26:36', '2014-11-20 13:26:36', 'ACTIVE', 0, 'Normal', 'Allow');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `service_modul`
--

CREATE TABLE IF NOT EXISTS `service_modul` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `modul_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `role` enum('developer','customer') DEFAULT 'developer',
  `status` enum('deny','allow') DEFAULT 'allow',
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=149 ;

--
-- Daten für Tabelle `service_modul`
--

INSERT INTO `service_modul` (`id`, `modul_id`, `service_id`, `position`, `role`, `status`, `user_id`) VALUES
(12, 4, 2, 1, 'developer', 'allow', 1),
(13, 1, 2, 2, 'developer', 'allow', 1),
(14, 2, 2, 3, 'developer', 'allow', 1),
(15, 3, 2, 4, 'developer', 'allow', 1),
(16, 4, 2, 1, 'customer', 'allow', 1),
(17, 5, 2, 2, 'customer', 'allow', 1),
(18, 11, 3, 1, 'developer', 'allow', 1),
(19, 12, 3, 2, 'developer', 'allow', 1),
(20, 13, 3, 3, 'developer', 'allow', 1),
(21, 16, 3, 1, 'customer', 'allow', 1),
(76, 13, 4, 1, 'developer', 'allow', 1),
(77, 1, 4, 2, 'developer', 'allow', 1),
(78, 11, 4, 3, 'developer', 'allow', 1),
(79, 12, 4, 4, 'developer', 'allow', 1),
(80, 2, 4, 5, 'developer', 'allow', 1),
(81, 16, 4, 1, 'customer', 'allow', 1),
(82, 2, 4, 2, 'customer', 'allow', 1),
(83, 4, 1, 1, 'developer', 'allow', 1),
(84, 1, 1, 2, 'developer', 'allow', 1),
(85, 2, 1, 3, 'developer', 'allow', 1),
(86, 3, 1, 4, 'developer', 'allow', 1),
(87, 4, 1, 1, 'customer', 'allow', 1),
(88, 5, 1, 2, 'customer', 'allow', 1),
(146, 2, 5, 1, 'developer', 'allow', 1),
(147, 4, 5, 2, 'developer', 'allow', 1),
(148, 3, 5, 3, 'developer', 'allow', 1);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `service_roles`
--

CREATE TABLE IF NOT EXISTS `service_roles` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Daten für Tabelle `service_roles`
--

INSERT INTO `service_roles` (`id`, `role_id`, `service_id`) VALUES
(3, 2, 2),
(4, 2, 3),
(16, 2, 4),
(17, 2, 1),
(37, 2, 5);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `stakeholders`
--

CREATE TABLE IF NOT EXISTS `stakeholders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Daten für Tabelle `stakeholders`
--

INSERT INTO `stakeholders` (`id`, `user_id`, `role`) VALUES
(5, 1, 'developer'),
(6, 2, 'partner');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `organisation_id` int(11) DEFAULT NULL,
  `deleted` tinyint(4) DEFAULT NULL,
  `status` enum('ACTIVE','UNACTIVE') COLLATE utf8_unicode_ci DEFAULT 'ACTIVE',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `name`, `mail`, `password`, `role_id`, `organisation_id`, `deleted`, `status`) VALUES
(1, 'Danny Wagner', 'developer@gmx.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, NULL, 0, 'ACTIVE'),
(2, 'Thorsten Klein', 'partner@gmx.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 5, NULL, 0, 'ACTIVE'),
(5, 'Sandra Caspers', 'sandra.caspers@revierkoenig.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 3, NULL, 0, 'ACTIVE'),
(4, 'Sandra Rappl', 'sandra.rappl@revierkoenig.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 2, NULL, 0, 'ACTIVE'),
(6, 'Carla Gatter', 'customer@gmx.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 7, NULL, 0, 'ACTIVE'),
(7, 'Linh Nguyen', 'admin@gmx.de', '7c4a8d09ca3762af61e59520943dc26494f8941b', 1, 1, 0, 'ACTIVE');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
