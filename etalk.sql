/*
Navicat MySQL Data Transfer

Source Server         : me
Source Server Version : 50556
Source Host           : 139.196.122.42:3306
Source Database       : etalk

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2019-02-26 13:06:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `e_fd_users`
-- ----------------------------
DROP TABLE IF EXISTS `e_fd_users`;
CREATE TABLE `e_fd_users` (
  `fuid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fid` int(10) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `created` int(10) unsigned DEFAULT '0',
  `status` int(10) unsigned DEFAULT '1',
  PRIMARY KEY (`fuid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e_fd_users
-- ----------------------------
INSERT INTO `e_fd_users` VALUES ('2', '10', 'zjz', '0', '1');
INSERT INTO `e_fd_users` VALUES ('3', '126', 'xin', '0', '1');
INSERT INTO `e_fd_users` VALUES ('4', '2', 'bbb', '0', '1');
INSERT INTO `e_fd_users` VALUES ('5', '21', 'qqq', '0', '1');
INSERT INTO `e_fd_users` VALUES ('6', '24', 'å¼ å®¶çœŸ', '0', '1');

-- ----------------------------
-- Table structure for `e_users`
-- ----------------------------
DROP TABLE IF EXISTS `e_users`;
CREATE TABLE `e_users` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `password` varchar(64) DEFAULT NULL,
  `created` int(10) unsigned DEFAULT '0',
  `status` int(10) unsigned DEFAULT '1',
  `sessionid` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of e_users
-- ----------------------------
INSERT INTO `e_users` VALUES ('1', 'zjz', 'e10adc3949ba59abbe56e057f20f883e', '0', '1', null);
INSERT INTO `e_users` VALUES ('2', 'bbb', 'e10adc3949ba59abbe56e057f20f883e', '0', '1', null);
INSERT INTO `e_users` VALUES ('3', '5445', 'e10adc3949ba59abbe56e057f20f883e', '0', '1', null);
INSERT INTO `e_users` VALUES ('4', '6555555', 'e10adc3949ba59abbe56e057f20f883e', '0', '1', null);
INSERT INTO `e_users` VALUES ('5', '6555555', 'e10adc3949ba59abbe56e057f20f883e', '0', '1', null);
INSERT INTO `e_users` VALUES ('6', 'xin', 'e10adc3949ba59abbe56e057f20f883e', '0', '1', null);
INSERT INTO `e_users` VALUES ('7', '修改用户名se', 'e6e0b46fab13c5d60bc1f805146f2626', '0', '1', null);
INSERT INTO `e_users` VALUES ('8', '修改用户名se', 'e6e0b46fab13c5d60bc1f805146f2626', '0', '1', null);
INSERT INTO `e_users` VALUES ('9', 'aaa', 'e6e0b46fab13c5d60bc1f805146f2626', '0', '1', null);
INSERT INTO `e_users` VALUES ('10', 'aaaa', 'e10adc3949ba59abbe56e057f20f883e', '0', '1', null);
INSERT INTO `e_users` VALUES ('11', 'qqq', '202cb962ac59075b964b07152d234b70', '0', '1', null);
INSERT INTO `e_users` VALUES ('12', '张家真', 'e10adc3949ba59abbe56e057f20f883e', '0', '1', null);
