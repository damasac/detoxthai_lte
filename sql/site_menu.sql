/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : detoxthai

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-06-03 12:01:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for site_menu
-- ----------------------------
DROP TABLE IF EXISTS `site_menu`;
CREATE TABLE `site_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_menu` int(11) NOT NULL DEFAULT '0',
  `content_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of site_menu
-- ----------------------------
INSERT INTO `site_menu` VALUES ('8', '1', 'ภาพกิจกรรม', '0', '6');
INSERT INTO `site_menu` VALUES ('6', '1', 'ข่าว', '0', '4');
INSERT INTO `site_menu` VALUES ('3', 'codeerror', 'หน้าหลัก', '0', '1');
INSERT INTO `site_menu` VALUES ('9', '1', 'ติดต่อเรา', '0', '7');
INSERT INTO `site_menu` VALUES ('11', 'codeerror', 'เกี่ยวกับเรา', '0', '9');
INSERT INTO `site_menu` VALUES ('12', 'detox', 'หน้าหลักนะจ๊ะ', '0', '10');
INSERT INTO `site_menu` VALUES ('13', '', 'หน้าหลักเด้อจาร', '0', '11');
INSERT INTO `site_menu` VALUES ('14', 'codeerror', 'คอร์สล้างพิษตับ', '0', '12');
INSERT INTO `site_menu` VALUES ('16', 'codeerror', 'ติดต่อเรา', '0', '18');
INSERT INTO `site_menu` VALUES ('37', 'imu', 'ติดต่อเรา', '0', '51');
INSERT INTO `site_menu` VALUES ('36', 'imu', 'คอร์สล้างพิษตับ', '0', '47');
INSERT INTO `site_menu` VALUES ('35', 'imu', 'เกี่ยวกับเรา', '0', '46');
INSERT INTO `site_menu` VALUES ('34', 'imu', 'หน้าหลัก', '0', '45');
INSERT INTO `site_menu` VALUES ('38', 'test', 'หน้าหลัก', '0', '52');
INSERT INTO `site_menu` VALUES ('39', 'test', 'เกี่ยวกับเรา', '0', '53');
INSERT INTO `site_menu` VALUES ('40', 'test', 'คอร์สล้างพิษตับ', '0', '54');
INSERT INTO `site_menu` VALUES ('41', 'test', 'ติดต่อเรา', '0', '58');
INSERT INTO `site_menu` VALUES ('42', 'testdetox', 'หน้าหลัก', '0', '59');
INSERT INTO `site_menu` VALUES ('43', 'testdetox', 'เกี่ยวกับเรา', '0', '60');
INSERT INTO `site_menu` VALUES ('44', 'testdetox', 'คอร์สล้างพิษตับ', '0', '61');
INSERT INTO `site_menu` VALUES ('45', 'testdetox', 'ติดต่อเรา', '0', '65');
INSERT INTO `site_menu` VALUES ('46', 'test', 'หน้าหลัก', '0', '66');
INSERT INTO `site_menu` VALUES ('47', 'test', 'เกี่ยวกับเรา', '0', '67');
INSERT INTO `site_menu` VALUES ('48', 'test', 'คอร์สล้างพิษตับ', '0', '68');
INSERT INTO `site_menu` VALUES ('49', 'test', 'ติดต่อเรา', '0', '72');
