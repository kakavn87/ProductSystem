CREATE TABLE IF NOT EXISTS `profiles` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `profiles` ADD PRIMARY KEY (`id`);

ALTER TABLE `profiles` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `modul` ADD `outsourcing` TINYINT NOT NULL DEFAULT '0' ;