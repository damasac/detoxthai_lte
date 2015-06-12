/*
 Navicat Premium Data Transfer

 Source Server         : Local
 Source Server Type    : MySQL
 Source Server Version : 50533
 Source Host           : localhost
 Source Database       : detoxthai_lte

 Target Server Type    : MySQL
 Target Server Version : 50533
 File Encoding         : utf-8

 Date: 06/10/2015 10:46:40 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `tb_facebook`
-- ----------------------------
DROP TABLE IF EXISTS `tb_facebook`;
CREATE TABLE `tb_facebook` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `FACEBOOK_ID` varchar(50) NOT NULL,
  `NAME` varchar(150) NOT NULL,
  `LINK` varchar(250) NOT NULL,
  `CREATE_DATE` datetime NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `ID` (`FACEBOOK_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

