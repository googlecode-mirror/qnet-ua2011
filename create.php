<?php

require_once dirname(__FILE__) . '\src\main\resources\php\qnet\util.php';
require_db();

use Qnet\dao\DBConnector;

$connector = new DBConnector();
$connection = $connector->createConnection();

$schema = "DROP DATABASE IF EXISTS `qnet`;";
mysql_query($schema) or die ("Error in query: $schema. " . mysql_error());
$schema = "CREATE DATABASE `qnet`;";
mysql_query($schema) or die ("Error in query: $schema. " . mysql_error());

$users = "DROP TABLE IF EXISTS `qnet`.`users`;";
mysql_query($users) or die ("Error in query: $users. " . mysql_error());
$users = "CREATE TABLE  `qnet`.`users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `alive` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($users) or die ("Error in query: $users. " . mysql_error());

$userinfo = "DROP TABLE IF EXISTS `qnet`.`userinfo`;";
mysql_query($userinfo) or die ("Error in query: $userinfo. " . mysql_error());
$userinfo = "CREATE TABLE  `qnet`.`userinfo` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($userinfo) or die ("Error in query: $userinfo. " . mysql_error());

$queries = "DROP TABLE IF EXISTS `qnet`.`queries`;";
mysql_query($queries) or die ("Error in query: $queries. " . mysql_error());
$queries = "CREATE TABLE  `qnet`.`queries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `FK_users` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_queries_users` (`FK_users`) USING BTREE,
  CONSTRAINT `FK_queries_users` FOREIGN KEY (`FK_users`) REFERENCES `users` (`id`)  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($queries) or die ("Error in query: $queries. " . mysql_error());

$question = "DROP TABLE IF EXISTS `qnet`.`question`;";
mysql_query($question) or die ("Error in query: $question. " . mysql_error());
$question = "CREATE TABLE  `qnet`.`question` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(300) NOT NULL,
  `FK_queries` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_queries` (`FK_queries`),
  CONSTRAINT `FK_queries` FOREIGN KEY (`FK_queries`) REFERENCES `queries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($question) or die ("Error in query: $question. " . mysql_error());

$qoption = "DROP TABLE IF EXISTS `qnet`.`qoption`;";
mysql_query($qoption) or die ("Error in query: $qoption. " . mysql_error());
$qoption = "CREATE TABLE  `qnet`.`qoption` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(100) NOT NULL,
  `number` varchar(45) NOT NULL,
  `FK_question` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_question` (`FK_question`),
  CONSTRAINT `FK_question` FOREIGN KEY (`FK_question`) REFERENCES `question` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($qoption) or die ("Error in query: $qoption. " . mysql_error());

$qanswer = "DROP TABLE IF EXISTS `qnet`.`qanswer`;";
mysql_query($qanswer) or die ("Error in query: $qanswer. " . mysql_error());
$qanswer = "CREATE TABLE  `qnet`.`qanswer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_queries` int(10) unsigned NOT NULL,
  `FK_users` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_qanswer_queries` (`FK_queries`),
  KEY `FK_qanswer_users` (`FK_users`),
  CONSTRAINT `FK_qanswer_users` FOREIGN KEY (`FK_users`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_qanswer_queries` FOREIGN KEY (`FK_queries`) REFERENCES `queries` (`id`)  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($qanswer) or die ("Error in query: $qanswer. " . mysql_error());

$qanswer_qoption = "DROP TABLE IF EXISTS `qnet`.`qanswer_qoption`;";
mysql_query($qanswer_qoption) or die ("Error in query: $qanswer_qoption. " . mysql_error());
$qanswer_qoption = "CREATE TABLE  `qnet`.`qanswer_qoption` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_qanswer` int(10) unsigned NOT NULL,
  `FK_qoption` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_qanswer_qoption_1` (`FK_qanswer`),
  KEY `FK_qanswer_qoption_2` (`FK_qoption`),
  CONSTRAINT `FK_qanswer_qoption_1` FOREIGN KEY (`FK_qanswer`) REFERENCES `qanswer` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_qanswer_qoption_2` FOREIGN KEY (`FK_qoption`) REFERENCES `qoption` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($qanswer_qoption) or die ("Error in query: $qanswer_qoption. " . mysql_error());

$comment = "DROP TABLE IF EXISTS `qnet`.`comment`;";
mysql_query($comment) or die ("Error in query: $comment. " . mysql_error());
$comment = "CREATE TABLE  `qnet`.`comment` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($comment) or die ("Error in query: $comment. " . mysql_error());

$statistics = "DROP TABLE IF EXISTS `qnet`.`statistics`;";
mysql_query($statistics) or die ("Error in query: $statistics. " . mysql_error());
$statistics = "CREATE TABLE  `qnet`.`statistics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `FK_users` int(10) unsigned NOT NULL,
  `FK_queries` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_statistic_users` (`FK_users`),
  KEY `FK_statistics_queries` (`FK_queries`),
  CONSTRAINT `FK_statistics_queries` FOREIGN KEY (`FK_queries`) REFERENCES `queries` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($statistics) or die ("Error in query: $statistics. " . mysql_error());

$q_var = "DROP TABLE IF EXISTS `qnet`.`question_variable`;";
mysql_query($q_var) or die ("Error in query: $q_var. " . mysql_error());
$q_var = "CREATE TABLE  `qnet`.`question_variable` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_statistics` int(10) unsigned NOT NULL,
  `FK_question` int(10) unsigned NOT NULL,
  `var` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_question_variable` (`FK_question`),
  KEY `FK_question_variable_statistics` (`FK_statistics`),
  CONSTRAINT `FK_question_variable` FOREIGN KEY (`FK_question`) REFERENCES `question` (`id`),
  CONSTRAINT `FK_question_variable_statistics` FOREIGN KEY (`FK_statistics`) REFERENCES `statistics` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($q_var) or die ("Error in query: $q_var. " . mysql_error());

$u_var = "DROP TABLE IF EXISTS `qnet`.`user_variable`;";
mysql_query($u_var) or die ("Error in query: $u_var. " . mysql_error());
$u_var = "CREATE TABLE  `qnet`.`user_variable` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FK_statistics` int(10) unsigned NOT NULL,
  `property` varchar(45) NOT NULL,
  `var` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_user_variable_statistics` (`FK_statistics`),
  CONSTRAINT `FK_user_variable_statistics` FOREIGN KEY (`FK_statistics`) REFERENCES `statistics` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($u_var) or die ("Error in query: $u_var. " . mysql_error());

$qsegment = "DROP TABLE IF EXISTS `qnet`.`qsegment`;";
mysql_query($qsegment) or die ("Error in query: $qsegment. " . mysql_error());
$qsegment = "CREATE TABLE `qnet`.`qsegment` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `FK_queries` INTEGER UNSIGNED NOT NULL,
  `property` VARCHAR(45) NOT NULL,
  `value` INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_qsegment_queries` FOREIGN KEY `FK_qsegment_queries` (`FK_queries`)
    REFERENCES `queries` (`id`)
    ON DELETE CASCADE
    ON UPDATE RESTRICT
)
ENGINE = InnoDB;";
mysql_query($qsegment) or die ("Error in query: $qsegment. " . mysql_error());

$messages_var = "DROP TABLE IF EXISTS `qnet`.`messages`;";
mysql_query($messages_var) or die ("Error in query: $messages_var. " . mysql_error());
$messages_var = "CREATE TABLE `qnet`.`messages` (
  `message_id` int(11) NOT NULL auto_increment,
  `from_user` varchar(65) character set latin1 collate latin1_general_ci NOT NULL,
  `to_user` varchar(65) character set latin1 collate latin1_general_ci NOT NULL,
  `message_title` varchar(65) NOT NULL,
  `message_contents` longtext NOT NULL,
  `message_read` int(11) NOT NULL default '0',
  PRIMARY KEY  (`message_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3;";
mysql_query($messages_var) or die ("Error in query: $messages_var. " . mysql_error());

$tracking_var = "DROP TABLE IF EXISTS `qnet`.`trackings`;";
mysql_query($tracking_var) or die ("Error in query: $tracking_var. " . mysql_error());
$tracking_var = "CREATE TABLE  `qnet`.`trackings` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
mysql_query($tracking_var) or die ("Error in query: $tracking_var. " . mysql_error());

$u_var = "DROP TABLE IF EXISTS `qnet`.`photo`;";
mysql_query($u_var) or die ("Error in query: $u_var. " . mysql_error());
$u_var = "CREATE TABLE `qnet`.`photo` (
  `id` INTEGER UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` TEXT NOT NULL,
  `extension` VARCHAR(45) NOT NULL,
  `path` VARCHAR(45) NOT NULL,
  `size_kb` INTEGER UNSIGNED NOT NULL,
  `fk_id_user` INTEGER UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `FK_user_photo` FOREIGN KEY `FK_user_photo` (`fk_id_user`)
    REFERENCES `users` (`id`)
    ON DELETE RESTRICT
    ON UPDATE RESTRICT
)";
mysql_query($u_var) or die ("Error in query: $u_var. " . mysql_error());

mysql_close($connection);
?>