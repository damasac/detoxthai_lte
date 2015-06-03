/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : detoxthai

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-06-03 12:00:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for site_detail
-- ----------------------------
DROP TABLE IF EXISTS `site_detail`;
CREATE TABLE `site_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_province` int(11) NOT NULL,
  `site_amphur` int(11) NOT NULL,
  `site_district` int(11) NOT NULL,
  `site_house_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_village_no` int(11) NOT NULL,
  `site_muban` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_postal_code` int(11) NOT NULL,
  `site_telephone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `site_mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `create_user` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of site_detail
-- ----------------------------
INSERT INTO `site_detail` VALUES ('14', 'Detox สุขภาพดี', 'detox', '1', '26', '171', '5', '5', '5', '555', '555', '555', '7', '2015-04-21 00:00:00');
INSERT INTO `site_detail` VALUES ('13', 'Codeerror สุขภาพดี', 'codeerror', '21', '281', '2459', '1', '3', 'ลำหอก', '32110', '-', '0876471994', '7', '2015-04-21 00:00:00');
INSERT INTO `site_detail` VALUES ('10', 'DAMASAC สุขภาพดีมากๆ', 'damasac', '28', '393', '3491', '44', '44', '44', '4444', '4444', '4444', '1', '2015-04-21 00:00:00');
INSERT INTO `site_detail` VALUES ('16', 'ภาณุวัฒน์ล้างพิษตับ', 'panuwat', '32', '486', '4373', '', '0', '', '0', '', '', '1', '2015-04-27 15:02:54');
INSERT INTO `site_detail` VALUES ('25', 'ไอมิวสุขภาพดี', 'imu', '21', '281', '2459', '1', '3', 'ลำหอก', '32110', '0000000000', '0000000000', '7', '2015-05-06 15:38:23');
INSERT INTO `site_detail` VALUES ('26', 'test', 'test', '0', '0', '0', '', '0', '', '0', '', '', '1', '2015-05-19 15:02:30');
INSERT INTO `site_detail` VALUES ('27', 'TEST', 'testdetox', '0', '0', '0', '', '0', '', '0', '', '', '1', '2015-05-19 15:05:07');
INSERT INTO `site_detail` VALUES ('28', 'TEST', 'test', '28', '410', '3690', '123', '1', 'test', '40010', '0811111111', '081111111', '1', '2015-05-19 15:05:49');
