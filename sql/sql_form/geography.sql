/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : detoxthai_lte

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2015-06-05 19:14:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for geography
-- ----------------------------
DROP TABLE IF EXISTS `geography`;
CREATE TABLE `geography` (
  `GEO_ID` int(5) NOT NULL AUTO_INCREMENT,
  `GEO_NAME` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`GEO_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of geography
-- ----------------------------
INSERT INTO `geography` VALUES ('1', 'ภาคเหนือ');
INSERT INTO `geography` VALUES ('2', 'ภาคกลาง');
INSERT INTO `geography` VALUES ('3', 'ภาคตะวันออกเฉียงเหนือ');
INSERT INTO `geography` VALUES ('4', 'ภาคตะวันตก');
INSERT INTO `geography` VALUES ('5', 'ภาคตะวันออก');
INSERT INTO `geography` VALUES ('6', 'ภาคใต้');
