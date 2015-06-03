/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50624
Source Host           : localhost:3306
Source Database       : detoxthai

Target Server Type    : MYSQL
Target Server Version : 50624
File Encoding         : 65001

Date: 2015-06-03 12:01:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for site_schedule
-- ----------------------------
DROP TABLE IF EXISTS `site_schedule`;
CREATE TABLE `site_schedule` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `schedule_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `schedule_date` date NOT NULL,
  `schedule_end_date` date NOT NULL,
  `price_per_person` int(11) NOT NULL,
  `schedule_desc` text COLLATE utf8_unicode_ci NOT NULL,
  `site_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of site_schedule
-- ----------------------------
INSERT INTO `site_schedule` VALUES ('9', 'ทดสอบ', '2015-04-14', '0000-00-00', '0', '&lt;div&gt;&lt;table&gt;&lt;tr&gt;&lt;td&gt;xxx&lt;br /&gt;&lt;/td&gt;&lt;td&gt;xxx&lt;br /&gt;&lt;/td&gt;&lt;/tr&gt;&lt;tr&gt;&lt;td&gt;xxx&lt;br /&gt;&lt;/td&gt;&lt;td&gt;xxx&lt;br /&gt;&lt;/td&gt;&lt;/tr&gt;&lt;/table&gt;&lt;/div&gt;\n', 'detox');
INSERT INTO `site_schedule` VALUES ('10', 'ทดสอบ2', '2015-04-20', '0000-00-00', '0', '&lt;div align=&quot;center&quot;&gt;&lt;iframe width=&quot;560&quot; height=&quot;315&quot; frameborder=&quot;0&quot; src=&quot;http://www.youtube.com/embed/EUgeB46JiXw?wmode=opaque&quot; data-youtube-id=&quot;EUgeB46JiXw&quot; allowfullscreen&gt;&lt;/iframe&gt;&lt;br /&gt;&lt;/div&gt;', 'detox');
INSERT INTO `site_schedule` VALUES ('11', 'ล้างพิษตับสุขภาพดีหลายๆ', '2015-05-12', '2015-05-15', '200', '&lt;div&gt;&lt;font color=&quot;#ff3333&quot;&gt;&lt;font size=&quot;5&quot;&gt;ล้างพิษตับราคาถูกเป็นกันเอง โรงแรม 7 ดาว มีที่นวดพร้อม เหล้าเบียไม่มี มีสระว่ายน้ำ&lt;/font&gt;&lt;/font&gt;&lt;/div&gt;\n', 'imu');
