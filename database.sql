/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.25-MariaDB : Database - chat_application
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`chat_application` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `chat_application`;

/*Table structure for table `chat` */

DROP TABLE IF EXISTS `chat`;

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_msg` longtext NOT NULL,
  `sent_by` int(11) NOT NULL,
  `sent_on` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`chat_id`),
  KEY `sent_by` (`sent_by`),
  CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`sent_by`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

/*Data for the table `chat` */

insert  into `chat`(`chat_id`,`chat_msg`,`sent_by`,`sent_on`) values 
(1,'mmmmmmmmmmmmmmmmmmmmmmmmmm',2,'1713561584'),
(2,'my name is',2,'1713561897'),
(3,'myyyyy',1,'1713563187'),
(4,'okk',1,'1713563222'),
(5,'kkkkk',1,'1713563347'),
(6,'My name is ahsan',3,'1713564175'),
(7,'my name is moiz',5,'1713564288'),
(8,'today is saturday\n',1,'1713582842'),
(9,'i should do some work\n',1,'1713582866'),
(10,'this is not fair',1,'1713583304'),
(11,'okk',1,'1713583438');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `is_online` tinyint(1) NOT NULL DEFAULT 0,
  `last_login` varchar(50) DEFAULT NULL,
  `profile_image` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user` */

insert  into `user`(`user_id`,`first_name`,`last_name`,`email`,`password`,`is_online`,`last_login`,`profile_image`) values 
(1,'Talha','Khan','talha@gmail.com','talha',0,'1713583937','talha.jpeg'),
(2,'Qasim','Moosani','qasim@gmail.com','qasim',0,'1713564478','qasim.jpg'),
(3,'Ahsan','Ali','ahsan@gmail.com','ahsan',0,'1713564255','ahsan.jpg'),
(4,'Khaleeque','Ahmed','khaleeque@gmail.com','khaleeque',0,'1713564502','khaleeque.jpg'),
(5,'Abdul','Moiz','moiz@gmail.com','moiz',0,'1713583967','moiz.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
