/*
Navicat MySQL Data Transfer

Source Server         : localSql
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : detoxthai_lte

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-06-17 11:58:25
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
INSERT INTO `puser` VALUES ('2', '0874379405', '10470c3b4b1fed12c3baac014be15fac67c6e815', null, null, 'ภานุพงศ์', 'ศรีศุภเดชะ', '0874379405', '1', null, null, '', '', '', null, '2015-06-10 08:27:28');
INSERT INTO `puser` VALUES ('3', '0898412748', '10470c3b4b1fed12c3baac014be15fac67c6e815', null, null, 'รัก', 'สุขภาพ', '0898412748', '1', null, null, '', '', '', null, '2015-06-11 11:34:00');
INSERT INTO `puser` VALUES ('4', '0819750571', '10470c3b4b1fed12c3baac014be15fac67c6e815', null, null, 'ฟิน', 'นาเร่', '0819750571', '1', null, null, '', '', '', null, '2015-06-11 11:48:09');
INSERT INTO `puser` VALUES ('5', '8888888888', '10470c3b4b1fed12c3baac014be15fac67c6e815', null, null, 'sooso', 'ososos', '8888888888', '1', null, null, '', '', '', null, '2015-06-12 10:57:20');
INSERT INTO `puser` VALUES ('6', '0999999999', '10470c3b4b1fed12c3baac014be15fac67c6e815', null, null, 'ทดสอบ', 'ทดสอบ', '0999999999', '1', null, null, '', '', '', null, '2015-06-12 12:50:53');
INSERT INTO `puser` VALUES ('7', '0801841938', '10470c3b4b1fed12c3baac014be15fac67c6e815', null, null, 'พี่', 'นุ', '0801841938', '1', null, null, '', '', '', null, '2015-06-12 12:54:01');
INSERT INTO `puser` VALUES ('8', '0813332234', '10470c3b4b1fed12c3baac014be15fac67c6e815', null, null, 'เทา', 'เมส', '0813332234', '1', null, null, '', '', '', null, '2015-06-12 12:55:42');
INSERT INTO `puser` VALUES ('9', '1231231231', '876b2886307af779103980802fdba2b42b8e4ac2', null, null, 'aaa', 'aaa', '1231231231', '1', null, null, '', '', '', null, '2015-06-13 10:23:14');
INSERT INTO `puser` VALUES ('10', '1111111111', '5141ab1cced63b13ceb9d4431428462acce92c59', null, null, 'ฟหกฟหก', 'ฟหกฟหก', '1111111111', '1', null, null, '', '', '', null, '2015-06-13 10:24:06');
INSERT INTO `puser` VALUES ('11', '1232223232', '7b31f53f978339308fba99cdafa6a6b97263414f', null, null, 'ๅ/-/ๅ-', '-ๅ/-ๅ/-', '1232223232', '1', null, null, '', '', '', null, '2015-06-13 10:25:40');
