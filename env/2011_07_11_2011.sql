# --------------------------------------------------------
# Host:                         127.0.0.1
# Server version:               5.1.41
# Server OS:                    Win32
# HeidiSQL version:             6.0.0.3603
# Date/time:                    2011-10-30 13:47:33
# --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

# Dumping database structure for qnet
DROP DATABASE IF EXISTS `qnet`;
CREATE DATABASE IF NOT EXISTS `qnet` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `qnet`;


# Dumping structure for table qnet.comment
DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(45) NOT NULL,
  `FK_userId` int(10) unsigned NOT NULL,
  `FK_queryId` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_comment_user` (`FK_userId`),
  KEY `FK_comment_query` (`FK_queryId`),
  CONSTRAINT `FK_comment_user` FOREIGN KEY (`FK_userId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_comment_query` FOREIGN KEY (`FK_queryId`) REFERENCES `queries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

# Dumping data for table qnet.comment: ~0 rows (approximately)
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


# Dumping structure for table qnet.messages
DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` int(11) NOT NULL,
  `to_user` int(11) NOT NULL,
  `message_title` varchar(65) NOT NULL,
  `message_contents` longtext NOT NULL,
  `message_read` int(11) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.messages: ~0 rows (approximately)
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;


# Dumping structure for table qnet.photo
DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `extension` varchar(45) NOT NULL,
  `path` varchar(45) NOT NULL,
  `size_kb` int(10) unsigned NOT NULL,
  `fk_id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_photo` (`fk_id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

# Dumping data for table qnet.photo: 0 rows
/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;


# Dumping structure for table qnet.qanswer
DROP TABLE IF EXISTS `qanswer`;
CREATE TABLE IF NOT EXISTS `qanswer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_queries` int(10) unsigned NOT NULL,
  `FK_users` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_qanswer_queries` (`FK_queries`),
  KEY `FK_qanswer_users` (`FK_users`),
  CONSTRAINT `FK_qanswer_users` FOREIGN KEY (`FK_users`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_qanswer_queries` FOREIGN KEY (`FK_queries`) REFERENCES `queries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.qanswer: ~4 rows (approximately)
/*!40000 ALTER TABLE `qanswer` DISABLE KEYS */;
INSERT INTO `qanswer` (`id`, `FK_queries`, `FK_users`) VALUES
	(1, 1, 2),
	(2, 1, 3),
	(3, 1, 4),
	(4, 1, 5);
/*!40000 ALTER TABLE `qanswer` ENABLE KEYS */;


# Dumping structure for table qnet.qanswer_qoption
DROP TABLE IF EXISTS `qanswer_qoption`;
CREATE TABLE IF NOT EXISTS `qanswer_qoption` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_qanswer` int(10) unsigned NOT NULL,
  `FK_qoption` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_qanswer_qoption_1` (`FK_qanswer`),
  KEY `FK_qanswer_qoption_2` (`FK_qoption`),
  CONSTRAINT `FK_qanswer_qoption_1` FOREIGN KEY (`FK_qanswer`) REFERENCES `qanswer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_qanswer_qoption_2` FOREIGN KEY (`FK_qoption`) REFERENCES `qoption` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.qanswer_qoption: ~8 rows (approximately)
/*!40000 ALTER TABLE `qanswer_qoption` DISABLE KEYS */;
INSERT INTO `qanswer_qoption` (`id`, `FK_qanswer`, `FK_qoption`) VALUES
	(1, 1, 1),
	(2, 3, 1),
	(3, 2, 2),
	(4, 1, 3),
	(5, 3, 3),
	(6, 2, 4),
	(7, 4, 1),
	(8, 4, 3);
/*!40000 ALTER TABLE `qanswer_qoption` ENABLE KEYS */;


# Dumping structure for table qnet.qoption
DROP TABLE IF EXISTS `qoption`;
CREATE TABLE IF NOT EXISTS `qoption` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(100) NOT NULL,
  `number` varchar(45) NOT NULL,
  `FK_question` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_question` (`FK_question`),
  CONSTRAINT `FK_question` FOREIGN KEY (`FK_question`) REFERENCES `question` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.qoption: ~5 rows (approximately)
/*!40000 ALTER TABLE `qoption` DISABLE KEYS */;
INSERT INTO `qoption` (`id`, `text`, `number`, `FK_question`) VALUES
	(1, 'Yes', '1', 1),
	(2, 'No', '2', 1),
	(3, 'Lot', '1', 2),
	(4, 'Medium', '2', 2),
	(5, 'Low', '3', 2);
/*!40000 ALTER TABLE `qoption` ENABLE KEYS */;


# Dumping structure for table qnet.qsegment
DROP TABLE IF EXISTS `qsegment`;
CREATE TABLE IF NOT EXISTS `qsegment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_queries` int(10) unsigned NOT NULL,
  `property` varchar(45) NOT NULL,
  `value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_qsegment_queries` (`FK_queries`),
  CONSTRAINT `FK_qsegment_queries` FOREIGN KEY (`FK_queries`) REFERENCES `queries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.qsegment: ~3 rows (approximately)
/*!40000 ALTER TABLE `qsegment` DISABLE KEYS */;
INSERT INTO `qsegment` (`id`, `FK_queries`, `property`, `value`) VALUES
	(1, 1, 'GENDER', 0),
	(2, 1, 'AGE', 0),
	(3, 1, 'AGE', 1);
/*!40000 ALTER TABLE `qsegment` ENABLE KEYS */;


# Dumping structure for table qnet.queries
DROP TABLE IF EXISTS `queries`;
CREATE TABLE IF NOT EXISTS `queries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `FK_users` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_queries_users` (`FK_users`) USING BTREE,
  CONSTRAINT `FK_queries_users` FOREIGN KEY (`FK_users`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.queries: ~1 rows (approximately)
/*!40000 ALTER TABLE `queries` DISABLE KEYS */;
INSERT INTO `queries` (`id`, `title`, `FK_users`, `date`) VALUES
	(1, 'Chocolate', 1, '2011-10-26 18:45:00');
/*!40000 ALTER TABLE `queries` ENABLE KEYS */;


# Dumping structure for table qnet.question
DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(300) NOT NULL,
  `FK_queries` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_queries` (`FK_queries`),
  CONSTRAINT `FK_queries` FOREIGN KEY (`FK_queries`) REFERENCES `queries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.question: ~2 rows (approximately)
/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` (`id`, `text`, `FK_queries`) VALUES
	(1, 'Do you like milka?', 1),
	(2, 'How much do you like kinder eggs?', 1);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;


# Dumping structure for table qnet.question_variable
DROP TABLE IF EXISTS `question_variable`;
CREATE TABLE IF NOT EXISTS `question_variable` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_statistics` int(10) unsigned NOT NULL,
  `FK_question` int(10) unsigned NOT NULL,
  `var` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_question_variable` (`FK_question`),
  KEY `FK_question_variable_statistics` (`FK_statistics`),
  CONSTRAINT `FK_question_variable` FOREIGN KEY (`FK_question`) REFERENCES `question` (`id`),
  CONSTRAINT `FK_question_variable_statistics` FOREIGN KEY (`FK_statistics`) REFERENCES `statistics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.question_variable: ~3 rows (approximately)
/*!40000 ALTER TABLE `question_variable` DISABLE KEYS */;
INSERT INTO `question_variable` (`id`, `FK_statistics`, `FK_question`, `var`) VALUES
	(1, 1, 1, 1),
	(2, 2, 1, 1),
	(3, 2, 2, 2);
/*!40000 ALTER TABLE `question_variable` ENABLE KEYS */;


# Dumping structure for table qnet.statistics
DROP TABLE IF EXISTS `statistics`;
CREATE TABLE IF NOT EXISTS `statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `FK_users` int(10) unsigned NOT NULL,
  `FK_queries` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_statistic_users` (`FK_users`),
  KEY `FK_statistics_queries` (`FK_queries`),
  CONSTRAINT `FK_statistics_queries` FOREIGN KEY (`FK_queries`) REFERENCES `queries` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.statistics: ~3 rows (approximately)
/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` (`id`, `title`, `FK_users`, `FK_queries`, `date`) VALUES
	(1, 'Interesting 2D...', 1, 1, '2011-10-27 07:15:00'),
	(2, 'Interesting 3D...', 1, 1, '2011-10-26 06:15:00'),
	(3, 'Not so interesting (1D)...', 1, 1, '2011-10-27 01:00:00');
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;


# Dumping structure for table qnet.trackings
DROP TABLE IF EXISTS `trackings`;
CREATE TABLE IF NOT EXISTS `trackings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `followedId` int(10) unsigned NOT NULL,
  `followerId` int(10) unsigned NOT NULL,
  `approved` tinyint(1) unsigned NOT NULL,
  `notified` tinyint(1) unsigned NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_trackings_1` (`followedId`),
  KEY `FK_trackings_2` (`followerId`),
  CONSTRAINT `FK_trackings_1` FOREIGN KEY (`followedId`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_trackings_2` FOREIGN KEY (`followerId`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.trackings: ~12 rows (approximately)
/*!40000 ALTER TABLE `trackings` DISABLE KEYS */;
INSERT INTO `trackings` (`id`, `followedId`, `followerId`, `approved`, `notified`, `date`) VALUES
	(1, 1, 2, 1, 0, '2011-10-26 12:30:00'),
	(2, 1, 3, 0, 0, '2011-10-27 13:30:00'),
	(3, 2, 1, 1, 0, '2011-10-27 19:45:00'),
	(4, 2, 3, 0, 0, '2011-10-28 02:00:00'),
	(5, 3, 4, 1, 0, '2011-10-28 08:15:00'),
	(6, 4, 5, 1, 0, '2011-10-28 14:30:00'),
	(7, 5, 4, 1, 0, '2011-10-28 20:45:00'),
	(8, 6, 5, 1, 0, '2011-10-29 03:00:00'),
	(9, 5, 6, 1, 0, '2011-10-29 09:15:00'),
	(10, 8, 9, 1, 0, '2011-10-29 15:30:00'),
	(11, 7, 9, 1, 0, '2011-10-29 21:45:00'),
	(12, 10, 9, 1, 0, '2011-10-30 04:00:00');
/*!40000 ALTER TABLE `trackings` ENABLE KEYS */;


# Dumping structure for table qnet.userinfo
DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE IF NOT EXISTS `userinfo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_users` int(10) unsigned NOT NULL,
  `dateOfBirth` varchar(45) NOT NULL,
  `gender` varchar(45) NOT NULL,
  `maritalSt` varchar(45) NOT NULL,
  `studies` varchar(45) NOT NULL,
  `InstitutionName` varchar(45) NOT NULL,
  `currentLocation` varchar(45) NOT NULL,
  `religion` varchar(45) NOT NULL,
  `photo` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_userinfo_users` (`FK_users`),
  CONSTRAINT `FK_userinfo_users` FOREIGN KEY (`FK_users`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.userinfo: ~10 rows (approximately)
/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
INSERT INTO `userinfo` (`id`, `FK_users`, `dateOfBirth`, `gender`, `maritalSt`, `studies`, `InstitutionName`, `currentLocation`, `religion`, `photo`) VALUES
	(1, 1, '14-11-1940', 'Male', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08'),
	(2, 2, '15-11-1945', 'Female', 'Single', 'University', 'UA', 'Argentina', 'Musulman', 'img08'),
	(3, 3, '16-11-1988', 'Male', 'Single', 'University', 'UA', 'Argentina', 'Musulman', 'img08'),
	(4, 4, '17-11-2002', 'Female', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08'),
	(5, 5, '20-11-1990', 'Male', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08'),
	(6, 6, '20-11-1990', 'Male', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08'),
	(7, 7, '20-11-1990', 'Male', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08'),
	(8, 8, '20-11-1990', 'Male', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08'),
	(9, 9, '20-11-1990', 'Male', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08'),
	(10, 10, '20-11-1990', 'Male', 'Single', 'University', 'UA', 'Argentina', 'Catholic', 'img08');
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;


# Dumping structure for table qnet.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `alive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.users: ~10 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `lastname`, `mail`, `password`, `alive`) VALUES
	(1, 'Daniel', 'Gimenez', 'Daniel_Gimenez@mailinator.com', 'dg', 1),
	(2, 'Tomas', 'Alabes', 'Tomas_Alabes@mailinator.com', 'ta', 1),
	(3, 'Mariano', 'Claveria', 'Mariano_Claveria@mailinator.com', 'mc', 1),
	(4, 'Agustin', 'Miura', 'Agustin_Miura@mailinator.com', 'am', 1),
	(5, 'Daniel', 'Grane', 'Daniel_Grane@mailinator.com', 'dag', 1),
	(6, 'Damian', 'Minniti', 'Damian_Minniti@mailinator.com', 'dm', 1),
	(7, 'Martin', 'Sanchez', 'Martin_Sanchez@mailinator.com', 'ms', 1),
	(8, 'Pablo', 'Celentano', 'Pablo_Celentano@mailinator.com', 'pc', 1),
	(9, 'Jorge', 'Gonzales', 'Jorge_Gonzales@mailinator.com', 'jg', 1),
	(10, 'Pedro', 'Sorio', 'Pedro_Sorio@mailinator.com', 'ps', 1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


# Dumping structure for table qnet.user_variable
DROP TABLE IF EXISTS `user_variable`;
CREATE TABLE IF NOT EXISTS `user_variable` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_statistics` int(10) unsigned NOT NULL,
  `property` varchar(45) NOT NULL,
  `var` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_variable_statistics` (`FK_statistics`),
  CONSTRAINT `FK_user_variable_statistics` FOREIGN KEY (`FK_statistics`) REFERENCES `statistics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

# Dumping data for table qnet.user_variable: ~3 rows (approximately)
/*!40000 ALTER TABLE `user_variable` DISABLE KEYS */;
INSERT INTO `user_variable` (`id`, `FK_statistics`, `property`, `var`) VALUES
	(1, 1, 'RELIGION', 0),
	(2, 2, 'GENDER', 0),
	(3, 3, 'AGE', 0);
/*!40000 ALTER TABLE `user_variable` ENABLE KEYS */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
