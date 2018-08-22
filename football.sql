/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 100131
Source Host           : localhost:3306
Source Database       : football

Target Server Type    : MYSQL
Target Server Version : 100131
File Encoding         : 65001

Date: 2018-08-22 10:04:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for football_league
-- ----------------------------
DROP TABLE IF EXISTS `football_league`;
CREATE TABLE `football_league` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of football_league
-- ----------------------------
INSERT INTO `football_league` VALUES ('6', 'asqweqweqw');

-- ----------------------------
-- Table structure for football_team
-- ----------------------------
DROP TABLE IF EXISTS `football_team`;
CREATE TABLE `football_team` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `strip` varchar(255) DEFAULT NULL,
  `football_leagueid` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `football_leagueid` (`football_leagueid`),
  CONSTRAINT `f_leagueid` FOREIGN KEY (`football_leagueid`) REFERENCES `football_league` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of football_team
-- ----------------------------
