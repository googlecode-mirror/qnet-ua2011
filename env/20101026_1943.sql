-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.41


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema qnet
--

CREATE DATABASE IF NOT EXISTS qnet;
USE qnet;

--
-- Definition of table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
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

--
-- Dumping data for table `comment`
--

/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


--
-- Definition of table `photo`
--

DROP TABLE IF EXISTS `photo`;
CREATE TABLE `photo` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `extension` varchar(45) NOT NULL,
  `path` varchar(45) NOT NULL,
  `size_kb` int(10) unsigned NOT NULL,
  `fk_id_user` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_photo` (`fk_id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `photo`
--

/*!40000 ALTER TABLE `photo` DISABLE KEYS */;
/*!40000 ALTER TABLE `photo` ENABLE KEYS */;


--
-- Definition of table `qanswer`
--

DROP TABLE IF EXISTS `qanswer`;
CREATE TABLE `qanswer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_queries` int(10) unsigned NOT NULL,
  `FK_users` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_qanswer_queries` (`FK_queries`),
  KEY `FK_qanswer_users` (`FK_users`),
  CONSTRAINT `FK_qanswer_users` FOREIGN KEY (`FK_users`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_qanswer_queries` FOREIGN KEY (`FK_queries`) REFERENCES `queries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qanswer`
--

/*!40000 ALTER TABLE `qanswer` DISABLE KEYS */;
INSERT INTO `qanswer` (`id`,`FK_queries`,`FK_users`) VALUES 
 (1,1,2),
 (2,1,3),
 (3,1,4),
 (4,1,5);
/*!40000 ALTER TABLE `qanswer` ENABLE KEYS */;


--
-- Definition of table `qanswer_qoption`
--

DROP TABLE IF EXISTS `qanswer_qoption`;
CREATE TABLE `qanswer_qoption` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_qanswer` int(10) unsigned NOT NULL,
  `FK_qoption` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_qanswer_qoption_1` (`FK_qanswer`),
  KEY `FK_qanswer_qoption_2` (`FK_qoption`),
  CONSTRAINT `FK_qanswer_qoption_1` FOREIGN KEY (`FK_qanswer`) REFERENCES `qanswer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_qanswer_qoption_2` FOREIGN KEY (`FK_qoption`) REFERENCES `qoption` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qanswer_qoption`
--

/*!40000 ALTER TABLE `qanswer_qoption` DISABLE KEYS */;
INSERT INTO `qanswer_qoption` (`id`,`FK_qanswer`,`FK_qoption`) VALUES 
 (1,1,1),
 (2,3,1),
 (3,2,2),
 (4,1,3),
 (5,3,3),
 (6,2,4),
 (7,4,1),
 (8,4,3);
/*!40000 ALTER TABLE `qanswer_qoption` ENABLE KEYS */;


--
-- Definition of table `qoption`
--

DROP TABLE IF EXISTS `qoption`;
CREATE TABLE `qoption` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(100) NOT NULL,
  `number` varchar(45) NOT NULL,
  `FK_question` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_question` (`FK_question`),
  CONSTRAINT `FK_question` FOREIGN KEY (`FK_question`) REFERENCES `question` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qoption`
--

/*!40000 ALTER TABLE `qoption` DISABLE KEYS */;
INSERT INTO `qoption` (`id`,`text`,`number`,`FK_question`) VALUES 
 (1,'Yes','1',1),
 (2,'No','2',1),
 (3,'Lot','1',2),
 (4,'Medium','2',2),
 (5,'Low','3',2);
/*!40000 ALTER TABLE `qoption` ENABLE KEYS */;


--
-- Definition of table `qsegment`
--

DROP TABLE IF EXISTS `qsegment`;
CREATE TABLE `qsegment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_queries` int(10) unsigned NOT NULL,
  `property` varchar(45) NOT NULL,
  `value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_qsegment_queries` (`FK_queries`),
  CONSTRAINT `FK_qsegment_queries` FOREIGN KEY (`FK_queries`) REFERENCES `queries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `qsegment`
--

/*!40000 ALTER TABLE `qsegment` DISABLE KEYS */;
INSERT INTO `qsegment` (`id`,`FK_queries`,`property`,`value`) VALUES 
 (1,1,'GENDER',0),
 (2,1,'AGE',0),
 (3,1,'AGE',1);
/*!40000 ALTER TABLE `qsegment` ENABLE KEYS */;


--
-- Definition of table `queries`
--

DROP TABLE IF EXISTS `queries`;
CREATE TABLE `queries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `FK_users` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_queries_users` (`FK_users`) USING BTREE,
  CONSTRAINT `FK_queries_users` FOREIGN KEY (`FK_users`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `queries`
--

/*!40000 ALTER TABLE `queries` DISABLE KEYS */;
INSERT INTO `queries` (`id`,`title`,`FK_users`,`date`) VALUES 
 (1,'Chocolate',1,'2010-10-20 06:15:00');
/*!40000 ALTER TABLE `queries` ENABLE KEYS */;


--
-- Definition of table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(300) NOT NULL,
  `FK_queries` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_queries` (`FK_queries`),
  CONSTRAINT `FK_queries` FOREIGN KEY (`FK_queries`) REFERENCES `queries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

/*!40000 ALTER TABLE `question` DISABLE KEYS */;
INSERT INTO `question` (`id`,`text`,`FK_queries`) VALUES 
 (1,'Do you like milka?',1),
 (2,'How much do you like kinder eggs?',1);
/*!40000 ALTER TABLE `question` ENABLE KEYS */;


--
-- Definition of table `question_variable`
--

DROP TABLE IF EXISTS `question_variable`;
CREATE TABLE `question_variable` (
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

--
-- Dumping data for table `question_variable`
--

/*!40000 ALTER TABLE `question_variable` DISABLE KEYS */;
INSERT INTO `question_variable` (`id`,`FK_statistics`,`FK_question`,`var`) VALUES 
 (1,1,1,1),
 (2,2,1,1),
 (3,2,2,2);
/*!40000 ALTER TABLE `question_variable` ENABLE KEYS */;


--
-- Definition of table `statistics`
--

DROP TABLE IF EXISTS `statistics`;
CREATE TABLE `statistics` (
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

--
-- Dumping data for table `statistics`
--

/*!40000 ALTER TABLE `statistics` DISABLE KEYS */;
INSERT INTO `statistics` (`id`,`title`,`FK_users`,`FK_queries`,`date`) VALUES 
 (1,'Interesting 2D...',1,1,'2010-10-20 12:30:00'),
 (2,'Interesting 3D...',1,1,'2010-10-20 18:45:00'),
 (3,'Not so interesting (1D)...',1,1,'2010-10-21 01:00:00');
/*!40000 ALTER TABLE `statistics` ENABLE KEYS */;


--
-- Definition of table `trackings`
--

DROP TABLE IF EXISTS `trackings`;
CREATE TABLE `trackings` (
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trackings`
--

/*!40000 ALTER TABLE `trackings` DISABLE KEYS */;
INSERT INTO `trackings` (`id`,`followedId`,`followerId`,`approved`,`notified`,`date`) VALUES 
 (1,1,2,1,0,'2010-10-21 07:15:00'),
 (2,1,3,0,0,'2010-10-21 13:30:00'),
 (3,2,1,1,0,'2010-10-21 19:45:00'),
 (4,2,3,0,0,'2010-10-22 02:00:00'),
 (5,3,4,1,0,'2010-10-22 08:15:00'),
 (6,4,5,1,0,'2010-10-22 14:30:00'),
 (7,5,4,1,0,'2010-10-22 20:45:00');
/*!40000 ALTER TABLE `trackings` ENABLE KEYS */;


--
-- Definition of table `user_variable`
--

DROP TABLE IF EXISTS `user_variable`;
CREATE TABLE `user_variable` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_statistics` int(10) unsigned NOT NULL,
  `property` varchar(45) NOT NULL,
  `var` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_variable_statistics` (`FK_statistics`),
  CONSTRAINT `FK_user_variable_statistics` FOREIGN KEY (`FK_statistics`) REFERENCES `statistics` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_variable`
--

/*!40000 ALTER TABLE `user_variable` DISABLE KEYS */;
INSERT INTO `user_variable` (`id`,`FK_statistics`,`property`,`var`) VALUES 
 (1,1,'RELIGION',0),
 (2,2,'GENDER',0),
 (3,3,'AGE',0);
/*!40000 ALTER TABLE `user_variable` ENABLE KEYS */;


--
-- Definition of table `userinfo`
--

DROP TABLE IF EXISTS `userinfo`;
CREATE TABLE `userinfo` (
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userinfo`
--

/*!40000 ALTER TABLE `userinfo` DISABLE KEYS */;
INSERT INTO `userinfo` (`id`,`FK_users`,`dateOfBirth`,`gender`,`maritalSt`,`studies`,`InstitutionName`,`currentLocation`,`religion`,`photo`) VALUES 
 (1,1,'14-11-1940','Male','Single','University','UA','Argentina','Catholic','img08'),
 (2,2,'15-11-1945','Female','Single','University','UA','Argentina','Musulman','img08'),
 (3,3,'16-11-1988','Male','Single','University','UA','Argentina','Musulman','img08'),
 (4,4,'17-11-2002','Female','Single','University','UA','Argentina','Catholic','img08'),
 (5,5,'20-11-1990','Male','Single','University','UA','Argentina','Catholic','img08');
/*!40000 ALTER TABLE `userinfo` ENABLE KEYS */;


--
-- Definition of table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `alive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`name`,`lastname`,`password`,`alive`) VALUES 
 (1,'Daniel','Gimenez','dg',1),
 (2,'Tomas','Alabes','ta',1),
 (3,'Mariano','Claveria','mc',1),
 (4,'Agustin','Miura','am',1),
 (5,'Daniel','Grane','dag',1);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
