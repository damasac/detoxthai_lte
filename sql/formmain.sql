/*
Navicat MySQL Data Transfer

Source Server         : localSql
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : thaipalliative_lte

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-05-27 08:07:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for formmain
-- ----------------------------
DROP TABLE IF EXISTS `formmain`;
CREATE TABLE `formmain` (
  `formid` int(11) NOT NULL AUTO_INCREMENT,
  `databaseid` int(11) DEFAULT NULL,
  `formname` varchar(255) DEFAULT NULL,
  `formdesc` varchar(255) DEFAULT NULL,
  `tablename` varchar(255) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL,
  `createdate` date DEFAULT NULL,
  `status_share` int(11) DEFAULT NULL,
  `public_add` int(11) DEFAULT NULL,
  `public_view` int(11) DEFAULT NULL,
  `public_edit` int(11) DEFAULT NULL,
  `public_delete` int(11) DEFAULT NULL,
  PRIMARY KEY (`formid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of formmain
-- ----------------------------
