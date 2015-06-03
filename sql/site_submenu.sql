/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : detoxthai

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-06-03 12:01:13
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for site_submenu
-- ----------------------------
DROP TABLE IF EXISTS `site_submenu`;
CREATE TABLE `site_submenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `menu_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status_menu` int(11) NOT NULL,
  `main_menu_id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of site_submenu
-- ----------------------------
INSERT INTO `site_submenu` VALUES ('3', 'codeerror', 'ปฎิทินกิจกรรมล้างพิษตับ', '0', '14', '13');
INSERT INTO `site_submenu` VALUES ('5', 'codeerror', 'การเตรียมตัวมาเข้าค่ายล้างพิษตับ', '0', '14', '15');
INSERT INTO `site_submenu` VALUES ('6', 'codeerror', 'รวมภาพกิจกรรมล้างพิษตับ', '0', '14', '16');
INSERT INTO `site_submenu` VALUES ('19', 'imu', 'รวมภาพกิจกรรมล้างพิษตับ', '0', '36', '50');
INSERT INTO `site_submenu` VALUES ('17', 'imu', 'ปฎิทินกิจกรรมล้างพิษตับ', '0', '36', '48');
INSERT INTO `site_submenu` VALUES ('18', 'imu', 'การเตรียมตัวมาเข้าค่ายล้างพิษตับ', '0', '36', '49');
INSERT INTO `site_submenu` VALUES ('20', 'test', 'ปฎิทินกิจกรรมล้างพิษตับ', '0', '40', '55');
INSERT INTO `site_submenu` VALUES ('21', 'test', 'การเตรียมตัวมาเข้าค่ายล้างพิษตับ', '0', '40', '56');
INSERT INTO `site_submenu` VALUES ('22', 'test', 'รวมภาพกิจกรรมล้างพิษตับ', '0', '40', '57');
INSERT INTO `site_submenu` VALUES ('23', 'testdetox', 'ปฎิทินกิจกรรมล้างพิษตับ', '0', '44', '62');
INSERT INTO `site_submenu` VALUES ('24', 'testdetox', 'การเตรียมตัวมาเข้าค่ายล้างพิษตับ', '0', '44', '63');
INSERT INTO `site_submenu` VALUES ('25', 'testdetox', 'รวมภาพกิจกรรมล้างพิษตับ', '0', '44', '64');
INSERT INTO `site_submenu` VALUES ('26', 'test', 'ปฎิทินกิจกรรมล้างพิษตับ', '0', '48', '69');
INSERT INTO `site_submenu` VALUES ('27', 'test', 'การเตรียมตัวมาเข้าค่ายล้างพิษตับ', '0', '48', '70');
INSERT INTO `site_submenu` VALUES ('28', 'test', 'รวมภาพกิจกรรมล้างพิษตับ', '0', '48', '71');
