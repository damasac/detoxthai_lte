/*
Navicat MySQL Data Transfer

Source Server         : localSql
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : thaipalliative_lte

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-05-27 08:06:33
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for formchoice
-- ----------------------------
DROP TABLE IF EXISTS `formchoice`;
CREATE TABLE `formchoice` (
  `choiceid` int(11) NOT NULL AUTO_INCREMENT,
  `formid` int(11) DEFAULT NULL,
  `fieldid` int(11) DEFAULT NULL,
  `choicevalue` varchar(255) DEFAULT NULL,
  `choicelabel` varchar(255) DEFAULT NULL,
  `choiceetc` int(11) DEFAULT NULL,
  `margin` tinyint(255) DEFAULT '2',
  `objlen` tinyint(255) DEFAULT '10',
  PRIMARY KEY (`choiceid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of formchoice
-- ----------------------------
