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
(1,	1,	2013,	'Ormond Family Faculty Fellow',	' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed egestas dapibus lectus non dignissim. Pellentesque auctor ornare urna, volutpat condimentum quam porttitor at. Vestibulum tincidunt diam in eros aliquam luctus. Donec sagittis a purus a porttitor. Sed non feugiat enim. Donec eget metus erat. Vivamus sed consequat orci. Aenean commodo lectus sed purus auctor ullamcorper.'),
(2,	1,	2015,	'Distinguished Scientific Achievement Award',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed egestas dapibus lectus non dignissim. Pellentesque auctor ornare urna, volutpat condimentum quam porttitor at. Vestibulum tincidunt diam in eros aliquam luctus. Donec sagittis a purus a porttitor. Sed non feugiat enim. Donec eget metus erat. Vivamus sed consequat orci. Aenean commodo lectus sed purus auctor ullamcorper. ');

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
(1,	1,	'Bc',	'Bachelor of IT',	2010,	'University Palacky'),
(2,	1,	'PhD',	'Doctor of programming',	2014,	'Parallel Universe');

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
(1,	1,	'Time, Money and Happiness'),
(2,	1,	'The Power of Story'),
(3,	1,	'Building Innovative Brands'),
(4,	1,	'Cultural Psychology');

DROP TABLE IF EXISTS `photos`;
CREATE TABLE `photos` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `path` varchar(512) COLLATE utf8_czech_ci NOT NULL,
  `relative_path` varchar(512) COLLATE utf8_czech_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `photos_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `photos` (`id`, `user_id`, `name`, `path`, `relative_path`) VALUES
(57,	1,	'photo_572791cb988aa.jpg',	'O:\\PHP projects\\ScientistBook\\app\\models/../../www/galleries/1/photo_572791cb988aa.jpg',	'/galleries/1/photo_572791cb988aa.jpg'),
(58,	1,	'photo_572791cb9ba36.jpg',	'O:\\PHP projects\\ScientistBook\\app\\models/../../www/galleries/1/photo_572791cb9ba36.jpg',	'/galleries/1/photo_572791cb9ba36.jpg'),
(59,	1,	'photo_572791cb9e8c6.jpg',	'O:\\PHP projects\\ScientistBook\\app\\models/../../www/galleries/1/photo_572791cb9e8c6.jpg',	'/galleries/1/photo_572791cb9e8c6.jpg'),
(60,	1,	'photo_572791cba0ab8.jpg',	'O:\\PHP projects\\ScientistBook\\app\\models/../../www/galleries/1/photo_572791cba0ab8.jpg',	'/galleries/1/photo_572791cba0ab8.jpg'),
(61,	1,	'photo_572791cba2a1d.jpg',	'O:\\PHP projects\\ScientistBook\\app\\models/../../www/galleries/1/photo_572791cba2a1d.jpg',	'/galleries/1/photo_572791cba2a1d.jpg'),
(62,	1,	'photo_572791e2ac753.jpg',	'O:\\PHP projects\\ScientistBook\\app\\models/../../www/galleries/1/photo_572791e2ac753.jpg',	'/galleries/1/photo_572791e2ac753.jpg'),
(63,	1,	'photo_57279354487ce.jpg',	'O:\\PHP projects\\ScientistBook\\app\\models/../../www/galleries/1/photo_57279354487ce.jpg',	'/galleries/1/photo_57279354487ce.jpg'),
(64,	1,	'photo_572a357a655e5.jpeg',	'O:\\PHP projects\\ScientistBook\\app\\models/../../www/galleries/1/photo_572a357a655e5.jpeg',	'/galleries/1/photo_572a357a655e5.jpeg');

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
(1,	1,	'Full Professor',	'Stanford University, Graduate School of Business',	2004,	2008),
(2,	1,	'General Atlantic Professor',	'Columbia University, Graduate School of Business',	2010,	NULL);

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
(1,	1,	'Some project',	'Very short description of the project.',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'),
(2,	1,	'Another Project',	'Another Very short description of the project.',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.');

DROP TABLE IF EXISTS `publications`;
CREATE TABLE `publications` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type_id` int(11) unsigned NOT NULL,
  `title` varchar(128) COLLATE utf8_czech_ci NOT NULL,
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
(1,	1,	3,	'Cultivating admiration in brands: Warmth, competence, and landin',	'Emily N. Garbinsky, Kathleen D. Vohs',	'Journal of Consumer Psychology, Volume 22, Issue 2, April 2012, Pages 191-194',	'Although a substantial amount of research has examined the constructs of warmth and competence, far less has examined how these constructs develop and what benefits may accrue when warmth and competence are cultivated. Yet there are positive consequences, both emotional and behavioral, that are likely to occur when brands hold perceptions of both. In this paper, we shed light on when and how warmth and competence are jointly promoted in brands, and why these reputations matter.',	2015,	NULL),
(2,	1,	1,	'The Dragonfly Effect: Quick, Effective, and Powerful Ways To Use Social Media to Drive Social Change',	'Emily N. Garbinsky, Kathleen D. Vohs',	'John Wiley & Sons | September 28, 2010 | ISBN-10: 0470614153',	'Many books teach the mechanics of using Facebook, Twitter, and YouTube to compete in business. But no book addresses how to harness the incredible power of social media to make a difference. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',	1999,	NULL);

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
(1,	1,	'Preclinical Endodnotics',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices ac elit sit amet porttitor. Suspendisse congue, erat vulputate pharetra mollis, est eros fermentum nibh, vitae rhoncus est arcu vitae elit.',	1995,	1998),
(2,	1,	'Endodontics Postdoctoral AEGD Program',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices ac elit sit amet porttitor. Suspendisse congue, erat vulputate pharetra mollis, est eros fermentum nibh, vitae rhoncus est arcu vitae elit.',	2005,	2008),
(3,	1,	'Endodontics Postdoctoral AEGD Program',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices ac elit sit amet porttitor. Suspendisse congue, erat vulputate pharetra mollis, est eros fermentum nibh, vitae rhoncus est arcu vitae elit.',	2011,	NULL),
(4,	1,	'Preclinical Endodnotics',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultrices ac elit sit amet porttitor. Suspendisse congue, erat vulputate pharetra mollis, est eros fermentum nibh, vitae rhoncus est arcu vitae elit.',	2013,	NULL);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_czech_ci NOT NULL,
  `name` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `surname` varchar(32) COLLATE utf8_czech_ci NOT NULL,
  `bio` text COLLATE utf8_czech_ci,
  `facility` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `research_summary` text COLLATE utf8_czech_ci,
  `contact_info` text COLLATE utf8_czech_ci,
  `phone` varchar(32) COLLATE utf8_czech_ci DEFAULT NULL,
  `skype` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `twitter` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `linked_in` varchar(64) COLLATE utf8_czech_ci DEFAULT NULL,
  `gravatar_email` varchar(128) COLLATE utf8_czech_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

INSERT INTO `users` (`id`, `email`, `password`, `name`, `surname`, `bio`, `facility`, `research_summary`, `contact_info`, `phone`, `skype`, `twitter`, `linked_in`, `gravatar_email`) VALUES
(1,	'info@ondratom.cz',	'aba74e0e50ac8e433a33fc23c9e4f828f6f5a622',	'Ondřej',	'Tom',	'A social psychologist and marketer, Jennifer Doe is the General Atlantic Professor of Marketing and Ormond Family Faculty at Stanford University’s Graduate School of Business. Her research spans time, money and happiness. She focuses on questions such as: What actually makes people happy, as opposed to what they think makes them happy? ',	'Harward University',	'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',	'I would be happy to talk to you if you need my assistance in your research or whether you need bussiness administration support for your company. Though I have limited time for students but I Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',	'123456789',	'odisek',	'twitter',	'linked',	NULL),
(13,	'info@ondratom.czz',	'018f4d7f06cb8626e1756452581373e05ae41c56',	'oto',	'oto',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);