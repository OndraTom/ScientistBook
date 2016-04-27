SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `scientists`;
CREATE DATABASE `scientists` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_czech_ci */;
USE `scientists`;

DROP TABLE IF EXISTS `awards`;
CREATE TABLE `awards` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `year` smallint(4) unsigned NOT NULL,
  `title` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `description` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `awards_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `awards` (`id`, `user_id`, `year`, `title`, `description`) VALUES
(1,	1,	2015,	'taaatl',	'descripta');

DROP TABLE IF EXISTS `education`;
CREATE TABLE `education` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `full_title` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  `graduation_year` smallint(4) unsigned NOT NULL,
  `place` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `education_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `education` (`id`, `user_id`, `title`, `full_title`, `graduation_year`, `place`) VALUES
(1,	1,	'tajtl',	'fujtajtl',	NULL,	'placek'),
(2,	1,	'adsf',	'adsf',	2016,	'adsf');

DROP TABLE IF EXISTS `interests`;
CREATE TABLE `interests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `interests_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `interests` (`id`, `user_id`, `title`) VALUES
(1,	1,	'interesta');

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `path` varchar(512) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `photos_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

DROP TABLE IF EXISTS `positions`;
CREATE TABLE `positions` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `place` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `year_from` smallint(5) unsigned NOT NULL,
  `year_to` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `positions_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `positions` (`id`, `user_id`, `title`, `place`, `year_from`, `year_to`) VALUES
(1,	1,	'position',	'placek',	2012,	2014),
(2,	1,	'asdf',	'adsf',	1950,	NULL),
(3,	1,	'asdfasdf',	'asdfasdf',	1950,	2015),
(4,	1,	'aaaaa',	'asdfasdf',	2015,	NULL);

DROP TABLE IF EXISTS `projects`;
CREATE TABLE `projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8_czech_ci NOT NULL,
  `short_description` varchar(256) COLLATE utf8_czech_ci NOT NULL,
  `description` text COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `projects_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `projects` (`id`, `user_id`, `title`, `short_description`, `description`) VALUES
(1,	1,	'projj',	'shor',	'long');

DROP TABLE IF EXISTS `publications`;
CREATE TABLE `publications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `title` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `co_authors` varchar(512) COLLATE utf8_czech_ci NOT NULL,
  `paper_name` varchar(512) COLLATE utf8_czech_ci NOT NULL,
  `abstract` text COLLATE utf8_czech_ci NOT NULL,
  `year` smallint(5) unsigned NOT NULL,
  `link` varchar(256) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `publications_ibfk_2` FOREIGN KEY (`type_id`) REFERENCES `publication_types` (`id`),
  CONSTRAINT `publications_ibfk_4` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `publications` (`id`, `user_id`, `type_id`, `title`, `co_authors`, `paper_name`, `abstract`, `year`, `link`) VALUES
(1,	1,	1,	'jounar',	'cotor',	'papir',	'abstraktek',	1234,	'');

DROP TABLE IF EXISTS `publication_types`;
CREATE TABLE `publication_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `publication_types` (`id`, `title`) VALUES
(1,	'Journal Paper'),
(2,	'Conference Paper'),
(3,	'Book Chapter'),
(4,	'Book');

DROP TABLE IF EXISTS `teaching`;
CREATE TABLE `teaching` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `description` text COLLATE utf8_czech_ci NOT NULL,
  `year_from` smallint(5) unsigned NOT NULL,
  `year_to` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `teaching_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `teaching` (`id`, `user_id`, `title`, `description`, `year_from`, `year_to`) VALUES
(1,	1,	'teaching',	'descr',	4564,	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `bio` text COLLATE utf8_czech_ci,
  `facility` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `research_summary` text COLLATE utf8_czech_ci,
  `contact_info` text COLLATE utf8_czech_ci,
  `phone` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
  `mail` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `skype` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `twitter` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `linked_in` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `bio`, `facility`, `research_summary`, `contact_info`, `phone`, `mail`, `skype`, `twitter`, `linked_in`) VALUES
(1,	'admin',	'aba74e0e50ac8e433a33fc23c9e4f828f6f5a622',	'Ondřej',	'Tom',	'bio jak brnooo',	'faca',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);