
DROP TABLE IF EXISTS `entres`;
CREATE TABLE IF NOT EXISTS `entres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `sorties`;
CREATE TABLE IF NOT EXISTS `sorties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
