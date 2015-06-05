/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : detoxthai_lte

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-06-05 19:15:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_education
-- ----------------------------
DROP TABLE IF EXISTS `tbl_education`;
CREATE TABLE `tbl_education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `edu_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_education
-- ----------------------------
INSERT INTO `tbl_education` VALUES ('1', 'ไม่ได้ศึกษา/ไม่มีวุฒิการศึกษา');
INSERT INTO `tbl_education` VALUES ('2', 'ก่อนประถมศึกษา');
INSERT INTO `tbl_education` VALUES ('3', 'ประถมศึกษา');
INSERT INTO `tbl_education` VALUES ('4', 'มัธยมศึกษา (ม.1-8) (ม.ศ.1-5) ประกาศนียบัตรวิชาชีพ (ปวช.)');
INSERT INTO `tbl_education` VALUES ('5', 'อนุปริญญา ประกาศนียบัตรวิชาชีพเทคนิค (ปวท.) ประกาศนียบัตรวิชาชีพชั้นสูง (ปวส.), นาฎศิลป์ชั้นสูง');
INSERT INTO `tbl_education` VALUES ('6', 'ปริญญาตรี ประกาศนียบัตรวิชาชีพเทคนิคครูชั้นสูง ประกาศนียบัตรบัณฑิต');
INSERT INTO `tbl_education` VALUES ('7', 'สูงกว่าปริญญาตรี ปริญญาโท, ประกาศนียบัตรบัณฑิตชั้นสูง ปริญญาเอก/เทียบเท่า');
INSERT INTO `tbl_education` VALUES ('8', 'ไม่ระบุ/ไม่ทราบ หมายถึง ไม่ได้ระบุไว้ตามที่กำหนด');
