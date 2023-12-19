-- Adminer 4.8.1 MySQL 8.0.35 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

CREATE TABLE `sex` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `sex` (`id`, `name`) VALUES
(1,	'Muž'),
(2,	'Žena'),
(3,	'Neznámo');

CREATE TABLE `yeti` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int NOT NULL,
  `height` int NOT NULL,
  `rating` int NOT NULL,
  `sex_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6525CCF5A2DB2A0` (`sex_id`),
  CONSTRAINT `FK_6525CCF5A2DB2A0` FOREIGN KEY (`sex_id`) REFERENCES `sex` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `yeti` (`id`, `name`, `weight`, `height`, `rating`, `sex_id`) VALUES
(10,	'Eva',	17,	11,	1,	2),
(11,	'Tonda',	17,	11,	2,	2),
(12,	'Pepa',	6,	8,	-1,	1),
(13,	'Pepa',	6,	8,	0,	1),
(14,	'Ondra',	6,	5,	-2,	1),
(15,	'Ondra',	6,	5,	2,	1),
(16,	'Honza',	100,	200,	0,	1),
(17,	'Honza',	100,	200,	1,	1),
(18,	'Jarda',	100,	200,	1,	1),
(19,	'Honza',	100,	200,	0,	1),
(20,	'Standa',	7,	5,	3,	1),
(21,	'Standa',	7,	5,	3,	1),
(22,	'Pavel',	6,	5,	1,	2),
(23,	'Ondra',	10,	10,	0,	3),
(24,	'Luboš',	5,	10,	0,	1),
(25,	'Tony',	4,	4,	3,	1),
(26,	'Petra',	10,	10,	-1,	2),
(27,	'Venca',	4,	4,	0,	1),
(28,	'Václav',	23,	7,	0,	1);

CREATE TABLE `yeti_votes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `yeti_id` int NOT NULL,
  `created_at` datetime NOT NULL,
  `vote` smallint NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A367A3636FD936CB` (`yeti_id`),
  CONSTRAINT `FK_A367A3636FD936CB` FOREIGN KEY (`yeti_id`) REFERENCES `yeti` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `yeti_votes` (`id`, `yeti_id`, `created_at`, `vote`) VALUES
(1,	25,	'2023-12-18 13:00:10',	1),
(2,	11,	'2023-12-19 13:05:45',	1),
(3,	25,	'2023-12-19 13:08:57',	1),
(4,	11,	'2023-12-19 13:09:01',	-1),
(5,	16,	'2023-12-19 13:09:07',	1),
(6,	18,	'2023-12-19 13:09:09',	1),
(7,	16,	'2023-12-19 13:09:13',	1),
(8,	15,	'2023-12-19 13:31:14',	1),
(9,	15,	'2023-12-19 13:32:31',	1),
(10,	25,	'2023-12-19 14:34:30',	1),
(11,	25,	'2023-12-19 14:34:47',	1),
(12,	25,	'2023-12-19 14:37:25',	-1),
(13,	25,	'2023-12-19 13:38:26',	1),
(14,	11,	'2023-12-19 13:53:51',	1),
(15,	11,	'2023-12-19 13:54:52',	1),
(16,	22,	'2023-12-19 13:54:57',	1),
(17,	21,	'2023-12-19 13:55:00',	1),
(18,	10,	'2023-12-19 13:55:26',	1),
(19,	21,	'2023-12-19 13:55:30',	1),
(20,	21,	'2023-12-19 13:55:34',	1),
(21,	21,	'2023-12-19 13:55:38',	1),
(22,	25,	'2023-12-19 13:55:47',	-1),
(23,	15,	'2023-12-19 13:55:51',	-1),
(24,	21,	'2023-12-19 13:55:58',	-1),
(25,	18,	'2023-12-19 13:57:57',	-1),
(26,	12,	'2023-12-19 14:01:32',	-1),
(27,	14,	'2023-12-19 14:02:03',	-1),
(28,	20,	'2023-12-19 15:53:20',	1),
(29,	18,	'2023-12-19 15:53:25',	1),
(30,	26,	'2023-12-19 15:53:29',	-1),
(31,	15,	'2023-12-19 16:02:16',	1),
(32,	13,	'2023-12-19 17:05:00',	1),
(33,	13,	'2023-12-19 17:05:05',	-1),
(34,	20,	'2023-12-19 17:05:09',	1),
(35,	23,	'2023-12-19 17:55:54',	-1),
(36,	14,	'2023-12-19 17:55:59',	-1),
(37,	17,	'2023-12-19 18:03:15',	1),
(38,	23,	'2023-12-19 21:17:38',	1),
(39,	20,	'2023-12-19 21:17:45',	1);

-- 2023-12-19 21:40:24
