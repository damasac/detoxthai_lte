/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : detoxthai

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-06-03 12:00:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for site_join
-- ----------------------------
DROP TABLE IF EXISTS `site_join`;
CREATE TABLE `site_join` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` int(11) NOT NULL,
  `birthdate` date NOT NULL,
  `houseno` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `moo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mooban` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alley` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province` int(11) NOT NULL,
  `amphur` int(11) NOT NULL,
  `district` int(11) NOT NULL,
  `postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `usernum` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of site_join
-- ----------------------------
INSERT INTO `site_join` VALUES ('1', 'ghjghj', 'ghjghj', '2', '2015-12-05', '1', '3', 'gfh', 'fgh', 'fghg', '34', '522', '4762', '99', 'gfh', 'fgh', 'fgh', '55', '9');
INSERT INTO `site_join` VALUES ('2', 'lok', 'klkl', '1', '2015-12-05', '8', '21', 'kl', 'kl', 'kl', '1', '21', '147', '65', 'kl', 'kl', '55kl', '5', '9');
INSERT INTO `site_join` VALUES ('3', 'tttt', 'ttt', '1', '2015-12-05', '1', '1', 'tt', 'tt', 'tt', '64', '870', '7847', '55', '55', '55', 'tt', '2', '9');
