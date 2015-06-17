/*
Navicat MySQL Data Transfer

Source Server         : localSql
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : detoxthai_lte

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-06-17 12:01:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for puser
-- ----------------------------
DROP TABLE IF EXISTS `puser`;
CREATE TABLE `puser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nickname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tel` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hcode` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amphur` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `province` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isFristLogin` int(1) DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of puser
-- ----------------------------
INSERT INTO `puser` VALUES ('1', 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'admin@admin.com', null, 'fadmin', 'ladmin', '0812345678', '1', '13777', '7', '400101', '4001', '40', null, '2015-05-22 15:17:01');
