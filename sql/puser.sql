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

 Date: 06/03/2015 08:38:46 AM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `puser`
-- ----------------------------
DROP TABLE IF EXISTS `puser`;
CREATE TABLE `puser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hcode` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `area` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `district` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `amphur` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `createdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=161 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
--  Records of `puser`
-- ----------------------------
INSERT INTO `puser` VALUES ('1', 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', 'admin@admin.com', 'fadmin', 'ladmin', '1', '13777', '7', '400101', '4001', '40', '2015-05-22 15:17:01');

