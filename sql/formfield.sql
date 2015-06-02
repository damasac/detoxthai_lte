/*
Navicat MySQL Data Transfer

Source Server         : localSql
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : thaipalliative_lte

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-05-27 08:07:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for formfield
-- ----------------------------
DROP TABLE IF EXISTS `formfield`;
CREATE TABLE `formfield` (
  `fieldid` int(11) NOT NULL AUTO_INCREMENT,
  `formid` int(11) DEFAULT NULL,
  `fieldname` varchar(255) DEFAULT NULL,
  `fieldvalue` varchar(255) DEFAULT NULL,
  `fieldhelp` varchar(255) DEFAULT NULL,
  `fieldtype` varchar(255) DEFAULT NULL,
  `valueprovince` varchar(100) DEFAULT NULL,
  `valueamphur` varchar(100) DEFAULT NULL,
  `valuetumbon` varchar(100) DEFAULT NULL,
  `haveTumbon` tinyint(11) DEFAULT NULL,
  `horder` tinyint(4) DEFAULT NULL,
  `forder` int(11) DEFAULT NULL,
  `margin` tinyint(4) NOT NULL DEFAULT '0',
  `objlen` tinyint(4) NOT NULL DEFAULT '12',
  PRIMARY KEY (`fieldid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of formfield
-- ----------------------------
