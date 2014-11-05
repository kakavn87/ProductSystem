CREATE TABLE IF NOT EXISTS `profiles` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `profiles` ADD PRIMARY KEY (`id`);

ALTER TABLE `profiles` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `modul` ADD `outsourcing` TINYINT NOT NULL DEFAULT '0' ;

-- 10-29-2014
--
-- Table structure for table `applications`
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
-- Table structure for table `modul_applies`
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
-- Table structure for table `modul_requirements`
--

CREATE TABLE IF NOT EXISTS `modul_requirements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `modul_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `developer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

----------------------------------------------------------------------------
-- 11/5/2014

--
-- Table structure for table `modul_requirements`
--
DROP TABLE IF EXISTS `modul_requirements`;
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

DROP TABLE IF EXISTS `profiles`;
CREATE TABLE IF NOT EXISTS `profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `operator` varchar(20) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `type` enum('organization','modul','provider') DEFAULT 'organization',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;
