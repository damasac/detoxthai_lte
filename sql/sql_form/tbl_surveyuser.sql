/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : detoxthai_lte

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-06-05 19:15:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tbl_surveyuser
-- ----------------------------
DROP TABLE IF EXISTS `tbl_surveyuser`;
CREATE TABLE `tbl_surveyuser` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `startdate` datetime DEFAULT NULL,
  `enddate` datetime DEFAULT NULL,
  `createdate` datetime DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of tbl_surveyuser
-- ----------------------------
INSERT INTO `tbl_surveyuser` VALUES ('13', '2015-02-04 00:00:00', '2015-02-08 00:00:00', '2015-02-04 11:01:12', 'ธัญญสมุย', '5', 'บอล');
INSERT INTO `tbl_surveyuser` VALUES ('14', '2015-02-04 00:00:00', '2015-02-05 00:00:00', '2015-02-04 20:49:29', 'ธัญญสมุย', '6', 'Kongvut');
INSERT INTO `tbl_surveyuser` VALUES ('4', '2015-02-04 00:00:00', '2015-02-08 00:00:00', '2015-02-04 10:22:46', 'Codeerror', '7', 'Codeerror');
INSERT INTO `tbl_surveyuser` VALUES ('5', '2015-02-04 00:00:00', '2015-02-08 00:00:00', '2015-02-04 10:23:41', 'Codeerror', '7', 'Codeerror');
INSERT INTO `tbl_surveyuser` VALUES ('15', '2015-02-04 00:00:00', '2015-02-08 00:00:00', '2015-02-10 13:06:53', 'ธัญสมุย', '10', 'Beta');
INSERT INTO `tbl_surveyuser` VALUES ('16', '2015-02-24 00:00:00', '2015-02-24 00:00:00', '2015-02-24 15:50:53', 'Codeerror', '7', 'Codeerror');
INSERT INTO `tbl_surveyuser` VALUES ('17', '2015-02-27 00:00:00', '2015-02-27 00:00:00', '2015-02-27 10:28:46', 'ที่บ้าน', '16', 'domodo1123@gmail.com');
