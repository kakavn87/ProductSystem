
CREATE TABLE IF NOT EXISTS `document` (
`id` int(11) unsigned NOT NULL,
  `modul_id` int(11) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `type` enum('VIDEO','PDF') DEFAULT 'PDF',
  `description` text,
  `status` enum('ACTIVE','UNACTIVE') DEFAULT 'ACTIVE',
  `deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


##### 02-10-2014
CREATE TABLE IF NOT EXISTS `comments` (
`id` int(11) unsigned NOT NULL,
  `comment` text,
  `user_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `service` ADD `type` ENUM('Standard','Normal') NOT NULL DEFAULT 'Normal' ;
ALTER TABLE `service` ADD `customer_view` ENUM('Allow','Deny') NOT NULL DEFAULT 'Deny' ;

CREATE TABLE IF NOT EXISTS `service_roles` (
`id` int(11) unsigned NOT NULL,
  `role_id` int(11) DEFAULT NULL,
  `service_id` int(11) DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

