
CREATE TABLE IF NOT EXISTS `document` (
`id` int(11) unsigned NOT NULL,
  `modul_id` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` enum('VIDEO','PDF') DEFAULT 'PDF',
  `description` text,
  `status` enum('ACTIVE','UNACTIVE') DEFAULT 'ACTIVE',
  `deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;