/*
Navicat MySQL Data Transfer

Source Server         : online.detoxthai
Source Server Version : 50537
Source Host           : 61.19.254.15:3306
Source Database       : detoxthai_lte

Target Server Type    : MYSQL
Target Server Version : 50537
File Encoding         : 65001

Date: 2015-06-12 23:40:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_surveyprivate
-- ----------------------------
DROP TABLE IF EXISTS `tbl_surveyprivate`;
CREATE TABLE `tbl_surveyprivate` (
  `ref_id_user` int(10) NOT NULL,
  `status` varchar(10) DEFAULT NULL,
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
