/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : detoxthai_lte

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-06-12 21:45:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_surveyprivate
-- ----------------------------
DROP TABLE IF EXISTS `tbl_surveyprivate`;
CREATE TABLE `tbl_surveyprivate` (
  `ref_id_user` int(10) NOT NULL,
  `p0a1b1c1` varchar(250) DEFAULT NULL,
  `p0a1b1c2` varchar(255) DEFAULT NULL,
  `p0a1b2` varchar(250) DEFAULT NULL,
  `p0a1b3` varchar(250) DEFAULT NULL,
  `p0a1b3c1` varchar(250) DEFAULT NULL,
  `p0a1b3c2` varchar(250) DEFAULT NULL,
  `p0a1b3c3` varchar(250) DEFAULT NULL,
  `p0a1b3c4` varchar(250) DEFAULT NULL,
  `p0a1b3c5` varchar(250) DEFAULT NULL,
  `p0a1b3c6` varchar(250) DEFAULT NULL,
  `p0a1b3c7` varchar(250) DEFAULT NULL,
  `p0a1b3c8` varchar(250) DEFAULT NULL,
  `p0a1b4` varchar(250) DEFAULT NULL,
  `p0a1b5` varchar(250) DEFAULT NULL,
  `p0a1b6` varchar(250) DEFAULT NULL,
  `p0a2b1c1` varchar(250) DEFAULT NULL,
  `p0a2b1c2` varchar(250) DEFAULT NULL,
  `p0a2b2` varchar(250) DEFAULT NULL,
  `p0a2b3` varchar(250) DEFAULT NULL,
  `p0a2b4` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ref_id_user`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
