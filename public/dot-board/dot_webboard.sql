/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50721
Source Host           : localhost:3306
Source Database       : dot_webboard

Target Server Type    : MYSQL
Target Server Version : 50721
File Encoding         : 65001

Date: 2018-11-22 15:03:25
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for phpbb_acl_groups
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_acl_groups`;
CREATE TABLE `phpbb_acl_groups` (
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_setting` tinyint(2) NOT NULL DEFAULT '0',
  KEY `group_id` (`group_id`),
  KEY `auth_opt_id` (`auth_option_id`),
  KEY `auth_role_id` (`auth_role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_acl_groups
-- ----------------------------
INSERT INTO `phpbb_acl_groups` VALUES ('1', '0', '91', '0', '1');
INSERT INTO `phpbb_acl_groups` VALUES ('1', '0', '100', '0', '1');
INSERT INTO `phpbb_acl_groups` VALUES ('1', '0', '118', '0', '1');
INSERT INTO `phpbb_acl_groups` VALUES ('5', '0', '0', '5', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('5', '0', '0', '1', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('2', '0', '0', '6', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('3', '0', '0', '6', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('4', '0', '0', '5', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('4', '0', '0', '10', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('1', '1', '0', '17', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('2', '1', '0', '17', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('3', '1', '0', '17', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('6', '1', '0', '17', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('1', '2', '0', '17', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('2', '2', '0', '15', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('3', '2', '0', '15', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('4', '2', '0', '21', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('5', '2', '0', '14', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('5', '2', '0', '10', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('6', '2', '0', '19', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('7', '0', '0', '23', '0');
INSERT INTO `phpbb_acl_groups` VALUES ('7', '2', '0', '24', '0');

-- ----------------------------
-- Table structure for phpbb_acl_options
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_acl_options`;
CREATE TABLE `phpbb_acl_options` (
  `auth_option_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `auth_option` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_global` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_local` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `founder_only` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`auth_option_id`),
  UNIQUE KEY `auth_option` (`auth_option`)
) ENGINE=MyISAM AUTO_INCREMENT=125 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_acl_options
-- ----------------------------
INSERT INTO `phpbb_acl_options` VALUES ('1', 'f_', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('2', 'f_announce', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('3', 'f_announce_global', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('4', 'f_attach', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('5', 'f_bbcode', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('6', 'f_bump', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('7', 'f_delete', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('8', 'f_download', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('9', 'f_edit', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('10', 'f_email', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('11', 'f_flash', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('12', 'f_icons', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('13', 'f_ignoreflood', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('14', 'f_img', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('15', 'f_list', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('16', 'f_list_topics', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('17', 'f_noapprove', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('18', 'f_poll', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('19', 'f_post', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('20', 'f_postcount', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('21', 'f_print', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('22', 'f_read', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('23', 'f_reply', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('24', 'f_report', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('25', 'f_search', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('26', 'f_sigs', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('27', 'f_smilies', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('28', 'f_sticky', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('29', 'f_subscribe', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('30', 'f_user_lock', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('31', 'f_vote', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('32', 'f_votechg', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('33', 'f_softdelete', '0', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('34', 'm_', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('35', 'm_approve', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('36', 'm_chgposter', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('37', 'm_delete', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('38', 'm_edit', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('39', 'm_info', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('40', 'm_lock', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('41', 'm_merge', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('42', 'm_move', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('43', 'm_report', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('44', 'm_split', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('45', 'm_softdelete', '1', '1', '0');
INSERT INTO `phpbb_acl_options` VALUES ('46', 'm_ban', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('47', 'm_pm_report', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('48', 'm_warn', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('49', 'a_', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('50', 'a_aauth', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('51', 'a_attach', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('52', 'a_authgroups', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('53', 'a_authusers', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('54', 'a_backup', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('55', 'a_ban', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('56', 'a_bbcode', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('57', 'a_board', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('58', 'a_bots', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('59', 'a_clearlogs', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('60', 'a_email', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('61', 'a_extensions', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('62', 'a_fauth', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('63', 'a_forum', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('64', 'a_forumadd', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('65', 'a_forumdel', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('66', 'a_group', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('67', 'a_groupadd', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('68', 'a_groupdel', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('69', 'a_icons', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('70', 'a_jabber', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('71', 'a_language', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('72', 'a_mauth', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('73', 'a_modules', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('74', 'a_names', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('75', 'a_phpinfo', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('76', 'a_profile', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('77', 'a_prune', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('78', 'a_ranks', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('79', 'a_reasons', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('80', 'a_roles', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('81', 'a_search', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('82', 'a_server', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('83', 'a_styles', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('84', 'a_switchperm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('85', 'a_uauth', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('86', 'a_user', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('87', 'a_userdel', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('88', 'a_viewauth', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('89', 'a_viewlogs', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('90', 'a_words', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('91', 'u_', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('92', 'u_attach', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('93', 'u_chgavatar', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('94', 'u_chgcensors', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('95', 'u_chgemail', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('96', 'u_chggrp', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('97', 'u_chgname', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('98', 'u_chgpasswd', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('99', 'u_chgprofileinfo', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('100', 'u_download', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('101', 'u_hideonline', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('102', 'u_ignoreflood', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('103', 'u_masspm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('104', 'u_masspm_group', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('105', 'u_pm_attach', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('106', 'u_pm_bbcode', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('107', 'u_pm_delete', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('108', 'u_pm_download', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('109', 'u_pm_edit', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('110', 'u_pm_emailpm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('111', 'u_pm_flash', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('112', 'u_pm_forward', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('113', 'u_pm_img', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('114', 'u_pm_printpm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('115', 'u_pm_smilies', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('116', 'u_readpm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('117', 'u_savedrafts', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('118', 'u_search', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('119', 'u_sendemail', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('120', 'u_sendim', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('121', 'u_sendpm', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('122', 'u_sig', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('123', 'u_viewonline', '1', '0', '0');
INSERT INTO `phpbb_acl_options` VALUES ('124', 'u_viewprofile', '1', '0', '0');

-- ----------------------------
-- Table structure for phpbb_acl_roles
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_acl_roles`;
CREATE TABLE `phpbb_acl_roles` (
  `role_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `role_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `role_description` text COLLATE utf8_bin NOT NULL,
  `role_type` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `role_order` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`),
  KEY `role_type` (`role_type`),
  KEY `role_order` (`role_order`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_acl_roles
-- ----------------------------
INSERT INTO `phpbb_acl_roles` VALUES ('1', 'ROLE_ADMIN_STANDARD', 0x524F4C455F4445534352495054494F4E5F41444D494E5F5354414E44415244, 'a_', '1');
INSERT INTO `phpbb_acl_roles` VALUES ('2', 'ROLE_ADMIN_FORUM', 0x524F4C455F4445534352495054494F4E5F41444D494E5F464F52554D, 'a_', '3');
INSERT INTO `phpbb_acl_roles` VALUES ('3', 'ROLE_ADMIN_USERGROUP', 0x524F4C455F4445534352495054494F4E5F41444D494E5F5553455247524F5550, 'a_', '4');
INSERT INTO `phpbb_acl_roles` VALUES ('4', 'ROLE_ADMIN_FULL', 0x524F4C455F4445534352495054494F4E5F41444D494E5F46554C4C, 'a_', '2');
INSERT INTO `phpbb_acl_roles` VALUES ('5', 'ROLE_USER_FULL', 0x524F4C455F4445534352495054494F4E5F555345525F46554C4C, 'u_', '3');
INSERT INTO `phpbb_acl_roles` VALUES ('6', 'ROLE_USER_STANDARD', 0x524F4C455F4445534352495054494F4E5F555345525F5354414E44415244, 'u_', '1');
INSERT INTO `phpbb_acl_roles` VALUES ('7', 'ROLE_USER_LIMITED', 0x524F4C455F4445534352495054494F4E5F555345525F4C494D49544544, 'u_', '2');
INSERT INTO `phpbb_acl_roles` VALUES ('8', 'ROLE_USER_NOPM', 0x524F4C455F4445534352495054494F4E5F555345525F4E4F504D, 'u_', '4');
INSERT INTO `phpbb_acl_roles` VALUES ('9', 'ROLE_USER_NOAVATAR', 0x524F4C455F4445534352495054494F4E5F555345525F4E4F415641544152, 'u_', '5');
INSERT INTO `phpbb_acl_roles` VALUES ('10', 'ROLE_MOD_FULL', 0x524F4C455F4445534352495054494F4E5F4D4F445F46554C4C, 'm_', '3');
INSERT INTO `phpbb_acl_roles` VALUES ('11', 'ROLE_MOD_STANDARD', 0x524F4C455F4445534352495054494F4E5F4D4F445F5354414E44415244, 'm_', '1');
INSERT INTO `phpbb_acl_roles` VALUES ('12', 'ROLE_MOD_SIMPLE', 0x524F4C455F4445534352495054494F4E5F4D4F445F53494D504C45, 'm_', '2');
INSERT INTO `phpbb_acl_roles` VALUES ('13', 'ROLE_MOD_QUEUE', 0x524F4C455F4445534352495054494F4E5F4D4F445F5155455545, 'm_', '4');
INSERT INTO `phpbb_acl_roles` VALUES ('14', 'ROLE_FORUM_FULL', 0x524F4C455F4445534352495054494F4E5F464F52554D5F46554C4C, 'f_', '7');
INSERT INTO `phpbb_acl_roles` VALUES ('15', 'ROLE_FORUM_STANDARD', 0x524F4C455F4445534352495054494F4E5F464F52554D5F5354414E44415244, 'f_', '5');
INSERT INTO `phpbb_acl_roles` VALUES ('16', 'ROLE_FORUM_NOACCESS', 0x524F4C455F4445534352495054494F4E5F464F52554D5F4E4F414343455353, 'f_', '1');
INSERT INTO `phpbb_acl_roles` VALUES ('17', 'ROLE_FORUM_READONLY', 0x524F4C455F4445534352495054494F4E5F464F52554D5F524541444F4E4C59, 'f_', '2');
INSERT INTO `phpbb_acl_roles` VALUES ('18', 'ROLE_FORUM_LIMITED', 0x524F4C455F4445534352495054494F4E5F464F52554D5F4C494D49544544, 'f_', '3');
INSERT INTO `phpbb_acl_roles` VALUES ('19', 'ROLE_FORUM_BOT', 0x524F4C455F4445534352495054494F4E5F464F52554D5F424F54, 'f_', '9');
INSERT INTO `phpbb_acl_roles` VALUES ('20', 'ROLE_FORUM_ONQUEUE', 0x524F4C455F4445534352495054494F4E5F464F52554D5F4F4E5155455545, 'f_', '8');
INSERT INTO `phpbb_acl_roles` VALUES ('21', 'ROLE_FORUM_POLLS', 0x524F4C455F4445534352495054494F4E5F464F52554D5F504F4C4C53, 'f_', '6');
INSERT INTO `phpbb_acl_roles` VALUES ('22', 'ROLE_FORUM_LIMITED_POLLS', 0x524F4C455F4445534352495054494F4E5F464F52554D5F4C494D495445445F504F4C4C53, 'f_', '4');
INSERT INTO `phpbb_acl_roles` VALUES ('23', 'ROLE_USER_NEW_MEMBER', 0x524F4C455F4445534352495054494F4E5F555345525F4E45575F4D454D424552, 'u_', '6');
INSERT INTO `phpbb_acl_roles` VALUES ('24', 'ROLE_FORUM_NEW_MEMBER', 0x524F4C455F4445534352495054494F4E5F464F52554D5F4E45575F4D454D424552, 'f_', '10');

-- ----------------------------
-- Table structure for phpbb_acl_roles_data
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_acl_roles_data`;
CREATE TABLE `phpbb_acl_roles_data` (
  `role_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_setting` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`,`auth_option_id`),
  KEY `ath_op_id` (`auth_option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_acl_roles_data
-- ----------------------------
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '49', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '51', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '52', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '53', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '55', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '56', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '57', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '61', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '62', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '63', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '64', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '65', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '66', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '67', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '68', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '69', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '72', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '74', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '76', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '77', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '78', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '79', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '85', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '86', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '87', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '88', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '89', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('1', '90', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '49', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '52', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '53', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '62', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '63', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '64', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '65', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '72', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '77', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '85', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '88', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('2', '89', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '49', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '52', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '53', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '55', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '66', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '67', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '68', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '78', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '85', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '86', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '88', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('3', '89', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '49', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '50', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '51', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '52', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '53', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '54', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '55', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '56', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '57', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '58', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '59', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '60', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '61', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '62', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '63', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '64', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '65', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '66', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '67', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '68', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '69', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '70', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '71', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '72', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '73', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '74', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '75', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '76', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '77', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '78', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '79', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '80', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '81', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '82', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '83', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '84', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '85', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '86', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '87', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '88', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '89', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('4', '90', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '91', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '92', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '93', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '94', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '95', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '96', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '97', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '98', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '99', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '100', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '101', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '102', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '103', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '104', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '105', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '106', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '107', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '108', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '109', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '110', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '111', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '112', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '113', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '114', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '115', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '116', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '117', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '118', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '119', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '120', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '121', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '122', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '123', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('5', '124', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '91', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '92', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '93', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '94', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '95', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '98', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '99', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '100', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '101', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '103', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '104', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '105', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '106', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '107', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '108', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '109', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '110', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '113', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '114', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '115', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '116', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '117', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '118', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '119', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '120', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '121', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '122', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('6', '124', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '91', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '93', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '94', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '95', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '98', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '99', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '100', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '101', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '106', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '107', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '108', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '109', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '112', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '113', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '114', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '115', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '116', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '121', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '122', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('7', '124', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '91', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '93', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '94', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '95', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '98', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '100', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '101', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '122', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '124', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '103', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '104', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '116', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('8', '121', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '91', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '94', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '95', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '98', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '99', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '100', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '101', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '106', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '107', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '108', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '109', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '112', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '113', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '114', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '115', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '116', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '121', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '122', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '124', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('9', '93', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '34', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '35', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '46', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '36', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '37', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '38', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '39', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '40', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '41', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '42', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '47', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '43', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '45', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '44', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('10', '48', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '34', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '35', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '37', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '38', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '39', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '40', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '41', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '42', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '47', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '43', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '45', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '44', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('11', '48', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '34', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '37', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '38', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '39', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '47', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '43', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('12', '45', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('13', '34', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('13', '35', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('13', '38', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '2', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '3', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '4', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '5', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '6', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '10', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '11', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '12', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '13', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '18', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '26', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '33', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '28', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '30', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('14', '32', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '4', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '5', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '6', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '10', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '12', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '26', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '32', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('15', '33', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('16', '1', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('17', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '5', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '10', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '26', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('18', '33', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('19', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '4', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '5', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '10', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '26', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '33', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('20', '17', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '4', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '5', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '6', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '7', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '10', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '12', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '18', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '26', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '32', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('21', '33', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '1', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '5', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '8', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '9', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '10', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '14', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '15', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '16', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '17', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '18', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '19', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '20', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '21', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '22', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '23', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '24', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '25', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '26', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '27', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '29', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '31', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('22', '33', '1');
INSERT INTO `phpbb_acl_roles_data` VALUES ('23', '99', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('23', '103', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('23', '104', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('23', '121', '0');
INSERT INTO `phpbb_acl_roles_data` VALUES ('24', '17', '0');

-- ----------------------------
-- Table structure for phpbb_acl_users
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_acl_users`;
CREATE TABLE `phpbb_acl_users` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_role_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `auth_setting` tinyint(2) NOT NULL DEFAULT '0',
  KEY `user_id` (`user_id`),
  KEY `auth_option_id` (`auth_option_id`),
  KEY `auth_role_id` (`auth_role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_acl_users
-- ----------------------------
INSERT INTO `phpbb_acl_users` VALUES ('2', '0', '0', '5', '0');

-- ----------------------------
-- Table structure for phpbb_attachments
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_attachments`;
CREATE TABLE `phpbb_attachments` (
  `attach_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_msg_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `in_message` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `poster_id` int(10) unsigned NOT NULL DEFAULT '0',
  `is_orphan` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `physical_filename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `real_filename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `download_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `attach_comment` text COLLATE utf8_bin NOT NULL,
  `extension` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `mimetype` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `filesize` int(20) unsigned NOT NULL DEFAULT '0',
  `filetime` int(11) unsigned NOT NULL DEFAULT '0',
  `thumbnail` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`attach_id`),
  KEY `filetime` (`filetime`),
  KEY `post_msg_id` (`post_msg_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_id` (`poster_id`),
  KEY `is_orphan` (`is_orphan`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_attachments
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_banlist
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_banlist`;
CREATE TABLE `phpbb_banlist` (
  `ban_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ban_userid` int(10) unsigned NOT NULL DEFAULT '0',
  `ban_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ban_email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ban_start` int(11) unsigned NOT NULL DEFAULT '0',
  `ban_end` int(11) unsigned NOT NULL DEFAULT '0',
  `ban_exclude` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ban_give_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`ban_id`),
  KEY `ban_end` (`ban_end`),
  KEY `ban_user` (`ban_userid`,`ban_exclude`),
  KEY `ban_email` (`ban_email`,`ban_exclude`),
  KEY `ban_ip` (`ban_ip`,`ban_exclude`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_banlist
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_bbcodes
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_bbcodes`;
CREATE TABLE `phpbb_bbcodes` (
  `bbcode_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `bbcode_tag` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_helpline` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_match` text COLLATE utf8_bin NOT NULL,
  `bbcode_tpl` mediumtext COLLATE utf8_bin NOT NULL,
  `first_pass_match` mediumtext COLLATE utf8_bin NOT NULL,
  `first_pass_replace` mediumtext COLLATE utf8_bin NOT NULL,
  `second_pass_match` mediumtext COLLATE utf8_bin NOT NULL,
  `second_pass_replace` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`bbcode_id`),
  KEY `display_on_post` (`display_on_posting`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_bbcodes
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_bookmarks
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_bookmarks`;
CREATE TABLE `phpbb_bookmarks` (
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`,`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_bookmarks
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_bots
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_bots`;
CREATE TABLE `phpbb_bots` (
  `bot_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `bot_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `bot_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `bot_agent` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bot_ip` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`bot_id`),
  KEY `bot_active` (`bot_active`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_bots
-- ----------------------------
INSERT INTO `phpbb_bots` VALUES ('1', '1', 'AdsBot [Google]', '3', 'AdsBot-Google', '');
INSERT INTO `phpbb_bots` VALUES ('2', '1', 'Alexa [Bot]', '4', 'ia_archiver', '');
INSERT INTO `phpbb_bots` VALUES ('3', '1', 'Alta Vista [Bot]', '5', 'Scooter/', '');
INSERT INTO `phpbb_bots` VALUES ('4', '1', 'Ask Jeeves [Bot]', '6', 'Ask Jeeves', '');
INSERT INTO `phpbb_bots` VALUES ('5', '1', 'Baidu [Spider]', '7', 'Baiduspider', '');
INSERT INTO `phpbb_bots` VALUES ('6', '1', 'Bing [Bot]', '8', 'bingbot/', '');
INSERT INTO `phpbb_bots` VALUES ('7', '1', 'Exabot [Bot]', '9', 'Exabot', '');
INSERT INTO `phpbb_bots` VALUES ('8', '1', 'FAST Enterprise [Crawler]', '10', 'FAST Enterprise Crawler', '');
INSERT INTO `phpbb_bots` VALUES ('9', '1', 'FAST WebCrawler [Crawler]', '11', 'FAST-WebCrawler/', '');
INSERT INTO `phpbb_bots` VALUES ('10', '1', 'Francis [Bot]', '12', 'http://www.neomo.de/', '');
INSERT INTO `phpbb_bots` VALUES ('11', '1', 'Gigabot [Bot]', '13', 'Gigabot/', '');
INSERT INTO `phpbb_bots` VALUES ('12', '1', 'Google Adsense [Bot]', '14', 'Mediapartners-Google', '');
INSERT INTO `phpbb_bots` VALUES ('13', '1', 'Google Desktop', '15', 'Google Desktop', '');
INSERT INTO `phpbb_bots` VALUES ('14', '1', 'Google Feedfetcher', '16', 'Feedfetcher-Google', '');
INSERT INTO `phpbb_bots` VALUES ('15', '1', 'Google [Bot]', '17', 'Googlebot', '');
INSERT INTO `phpbb_bots` VALUES ('16', '1', 'Heise IT-Markt [Crawler]', '18', 'heise-IT-Markt-Crawler', '');
INSERT INTO `phpbb_bots` VALUES ('17', '1', 'Heritrix [Crawler]', '19', 'heritrix/1.', '');
INSERT INTO `phpbb_bots` VALUES ('18', '1', 'IBM Research [Bot]', '20', 'ibm.com/cs/crawler', '');
INSERT INTO `phpbb_bots` VALUES ('19', '1', 'ICCrawler - ICjobs', '21', 'ICCrawler - ICjobs', '');
INSERT INTO `phpbb_bots` VALUES ('20', '1', 'ichiro [Crawler]', '22', 'ichiro/', '');
INSERT INTO `phpbb_bots` VALUES ('21', '1', 'Majestic-12 [Bot]', '23', 'MJ12bot/', '');
INSERT INTO `phpbb_bots` VALUES ('22', '1', 'Metager [Bot]', '24', 'MetagerBot/', '');
INSERT INTO `phpbb_bots` VALUES ('23', '1', 'MSN NewsBlogs', '25', 'msnbot-NewsBlogs/', '');
INSERT INTO `phpbb_bots` VALUES ('24', '1', 'MSN [Bot]', '26', 'msnbot/', '');
INSERT INTO `phpbb_bots` VALUES ('25', '1', 'MSNbot Media', '27', 'msnbot-media/', '');
INSERT INTO `phpbb_bots` VALUES ('26', '1', 'Nutch [Bot]', '28', 'http://lucene.apache.org/nutch/', '');
INSERT INTO `phpbb_bots` VALUES ('27', '1', 'Online link [Validator]', '29', 'online link validator', '');
INSERT INTO `phpbb_bots` VALUES ('28', '1', 'psbot [Picsearch]', '30', 'psbot/0', '');
INSERT INTO `phpbb_bots` VALUES ('29', '1', 'Sensis [Crawler]', '31', 'Sensis Web Crawler', '');
INSERT INTO `phpbb_bots` VALUES ('30', '1', 'SEO Crawler', '32', 'SEO search Crawler/', '');
INSERT INTO `phpbb_bots` VALUES ('31', '1', 'Seoma [Crawler]', '33', 'Seoma [SEO Crawler]', '');
INSERT INTO `phpbb_bots` VALUES ('32', '1', 'SEOSearch [Crawler]', '34', 'SEOsearch/', '');
INSERT INTO `phpbb_bots` VALUES ('33', '1', 'Snappy [Bot]', '35', 'Snappy/1.1 ( http://www.urltrends.com/ )', '');
INSERT INTO `phpbb_bots` VALUES ('34', '1', 'Steeler [Crawler]', '36', 'http://www.tkl.iis.u-tokyo.ac.jp/~crawler/', '');
INSERT INTO `phpbb_bots` VALUES ('35', '1', 'Telekom [Bot]', '37', 'crawleradmin.t-info@telekom.de', '');
INSERT INTO `phpbb_bots` VALUES ('36', '1', 'TurnitinBot [Bot]', '38', 'TurnitinBot/', '');
INSERT INTO `phpbb_bots` VALUES ('37', '1', 'Voyager [Bot]', '39', 'voyager/', '');
INSERT INTO `phpbb_bots` VALUES ('38', '1', 'W3 [Sitesearch]', '40', 'W3 SiteSearch Crawler', '');
INSERT INTO `phpbb_bots` VALUES ('39', '1', 'W3C [Linkcheck]', '41', 'W3C-checklink/', '');
INSERT INTO `phpbb_bots` VALUES ('40', '1', 'W3C [Validator]', '42', 'W3C_Validator', '');
INSERT INTO `phpbb_bots` VALUES ('41', '1', 'YaCy [Bot]', '43', 'yacybot', '');
INSERT INTO `phpbb_bots` VALUES ('42', '1', 'Yahoo MMCrawler [Bot]', '44', 'Yahoo-MMCrawler/', '');
INSERT INTO `phpbb_bots` VALUES ('43', '1', 'Yahoo Slurp [Bot]', '45', 'Yahoo! DE Slurp', '');
INSERT INTO `phpbb_bots` VALUES ('44', '1', 'Yahoo [Bot]', '46', 'Yahoo! Slurp', '');
INSERT INTO `phpbb_bots` VALUES ('45', '1', 'YahooSeeker [Bot]', '47', 'YahooSeeker/', '');

-- ----------------------------
-- Table structure for phpbb_config
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_config`;
CREATE TABLE `phpbb_config` (
  `config_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `config_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `is_dynamic` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`config_name`),
  KEY `is_dynamic` (`is_dynamic`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_config
-- ----------------------------
INSERT INTO `phpbb_config` VALUES ('active_sessions', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_attachments', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_autologin', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_gravatar', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_local', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_remote', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_upload', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_avatar_remote_upload', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_bbcode', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_birthdays', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_bookmarks', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_cdn', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_emailreuse', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_password_reset', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_forum_notify', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_live_searches', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_mass_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_name_chars', 'USERNAME_CHARS_ANY', '0');
INSERT INTO `phpbb_config` VALUES ('allow_namechange', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_nocensors', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_pm_attach', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_pm_report', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_post_flash', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_post_links', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_privmsg', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_quick_reply', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_bbcode', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_flash', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_img', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_links', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_sig_smilies', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_smilies', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allow_topic_notify', '1', '0');
INSERT INTO `phpbb_config` VALUES ('allowed_schemes_links', 'http,https,ftp', '0');
INSERT INTO `phpbb_config` VALUES ('assets_version', '2', '0');
INSERT INTO `phpbb_config` VALUES ('attachment_quota', '52428800', '0');
INSERT INTO `phpbb_config` VALUES ('auth_bbcode_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('auth_flash_pm', '0', '0');
INSERT INTO `phpbb_config` VALUES ('auth_img_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('auth_method', 'db', '0');
INSERT INTO `phpbb_config` VALUES ('auth_smilies_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_filesize', '6144', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_gallery_path', 'images/avatars/gallery', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_max_height', '90', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_max_width', '90', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_min_height', '20', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_min_width', '20', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_path', 'images/avatars/upload', '0');
INSERT INTO `phpbb_config` VALUES ('avatar_salt', '383535b403df076c452437e1c439d114', '0');
INSERT INTO `phpbb_config` VALUES ('board_contact', 'sawang1990@gmail.com', '0');
INSERT INTO `phpbb_config` VALUES ('board_contact_name', '', '0');
INSERT INTO `phpbb_config` VALUES ('board_disable', '0', '0');
INSERT INTO `phpbb_config` VALUES ('board_disable_msg', '', '0');
INSERT INTO `phpbb_config` VALUES ('board_email', 'sawang1990@gmail.com', '0');
INSERT INTO `phpbb_config` VALUES ('board_email_form', '0', '0');
INSERT INTO `phpbb_config` VALUES ('board_email_sig', 'Thanks, The Management', '0');
INSERT INTO `phpbb_config` VALUES ('board_hide_emails', '1', '0');
INSERT INTO `phpbb_config` VALUES ('board_index_text', '', '0');
INSERT INTO `phpbb_config` VALUES ('board_timezone', 'UTC', '0');
INSERT INTO `phpbb_config` VALUES ('browser_check', '1', '0');
INSERT INTO `phpbb_config` VALUES ('bump_interval', '10', '0');
INSERT INTO `phpbb_config` VALUES ('bump_type', 'd', '0');
INSERT INTO `phpbb_config` VALUES ('cache_gc', '7200', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_plugin', 'core.captcha.plugins.gd', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd', '1', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_foreground_noise', '0', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_x_grid', '25', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_y_grid', '25', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_wave', '0', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_3d_noise', '1', '0');
INSERT INTO `phpbb_config` VALUES ('captcha_gd_fonts', '1', '0');
INSERT INTO `phpbb_config` VALUES ('confirm_refresh', '1', '0');
INSERT INTO `phpbb_config` VALUES ('check_attachment_content', '1', '0');
INSERT INTO `phpbb_config` VALUES ('check_dnsbl', '0', '0');
INSERT INTO `phpbb_config` VALUES ('chg_passforce', '0', '0');
INSERT INTO `phpbb_config` VALUES ('contact_admin_form_enable', '1', '0');
INSERT INTO `phpbb_config` VALUES ('cookie_domain', 'localhost', '0');
INSERT INTO `phpbb_config` VALUES ('cookie_name', 'phpbb3_bz875', '0');
INSERT INTO `phpbb_config` VALUES ('cookie_path', '/', '0');
INSERT INTO `phpbb_config` VALUES ('cookie_secure', '', '0');
INSERT INTO `phpbb_config` VALUES ('coppa_enable', '0', '0');
INSERT INTO `phpbb_config` VALUES ('coppa_fax', '', '0');
INSERT INTO `phpbb_config` VALUES ('coppa_mail', '', '0');
INSERT INTO `phpbb_config` VALUES ('database_gc', '604800', '0');
INSERT INTO `phpbb_config` VALUES ('dbms_version', '5.7.21', '0');
INSERT INTO `phpbb_config` VALUES ('default_dateformat', 'D M d, Y g:i a', '0');
INSERT INTO `phpbb_config` VALUES ('default_style', '1', '0');
INSERT INTO `phpbb_config` VALUES ('display_last_edited', '1', '0');
INSERT INTO `phpbb_config` VALUES ('display_last_subject', '1', '0');
INSERT INTO `phpbb_config` VALUES ('display_order', '0', '0');
INSERT INTO `phpbb_config` VALUES ('edit_time', '0', '0');
INSERT INTO `phpbb_config` VALUES ('extension_force_unstable', '0', '0');
INSERT INTO `phpbb_config` VALUES ('delete_time', '0', '0');
INSERT INTO `phpbb_config` VALUES ('email_check_mx', '1', '0');
INSERT INTO `phpbb_config` VALUES ('email_enable', '1', '0');
INSERT INTO `phpbb_config` VALUES ('email_force_sender', '0', '0');
INSERT INTO `phpbb_config` VALUES ('email_max_chunk_size', '50', '0');
INSERT INTO `phpbb_config` VALUES ('email_package_size', '20', '0');
INSERT INTO `phpbb_config` VALUES ('enable_accurate_pm_button', '1', '0');
INSERT INTO `phpbb_config` VALUES ('enable_confirm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('enable_mod_rewrite', '0', '0');
INSERT INTO `phpbb_config` VALUES ('allow_board_notifications', '1', '0');
INSERT INTO `phpbb_config` VALUES ('enable_pm_icons', '1', '0');
INSERT INTO `phpbb_config` VALUES ('enable_post_confirm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_enable', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_http_auth', '0', '0');
INSERT INTO `phpbb_config` VALUES ('feed_limit_post', '15', '0');
INSERT INTO `phpbb_config` VALUES ('feed_limit_topic', '10', '0');
INSERT INTO `phpbb_config` VALUES ('feed_overall_forums', '0', '0');
INSERT INTO `phpbb_config` VALUES ('feed_overall', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_forum', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_topic', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_topics_new', '1', '0');
INSERT INTO `phpbb_config` VALUES ('feed_topics_active', '0', '0');
INSERT INTO `phpbb_config` VALUES ('feed_item_statistics', '1', '0');
INSERT INTO `phpbb_config` VALUES ('flood_interval', '15', '0');
INSERT INTO `phpbb_config` VALUES ('force_server_vars', '0', '0');
INSERT INTO `phpbb_config` VALUES ('form_token_lifetime', '7200', '0');
INSERT INTO `phpbb_config` VALUES ('form_token_mintime', '0', '0');
INSERT INTO `phpbb_config` VALUES ('form_token_sid_guests', '1', '0');
INSERT INTO `phpbb_config` VALUES ('forward_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('forwarded_for_check', '0', '0');
INSERT INTO `phpbb_config` VALUES ('full_folder_action', '2', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_mysql_max_word_len', '254', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_mysql_min_word_len', '4', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_native_common_thres', '5', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_native_load_upd', '1', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_native_max_chars', '14', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_native_min_chars', '3', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_postgres_max_word_len', '254', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_postgres_min_word_len', '4', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_postgres_ts_name', 'simple', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_sphinx_indexer_mem_limit', '512', '0');
INSERT INTO `phpbb_config` VALUES ('fulltext_sphinx_stopwords', '0', '0');
INSERT INTO `phpbb_config` VALUES ('gzip_compress', '0', '0');
INSERT INTO `phpbb_config` VALUES ('help_send_statistics', '1', '0');
INSERT INTO `phpbb_config` VALUES ('help_send_statistics_time', '0', '0');
INSERT INTO `phpbb_config` VALUES ('hot_threshold', '25', '0');
INSERT INTO `phpbb_config` VALUES ('icons_path', 'images/icons', '0');
INSERT INTO `phpbb_config` VALUES ('img_create_thumbnail', '0', '0');
INSERT INTO `phpbb_config` VALUES ('img_display_inlined', '1', '0');
INSERT INTO `phpbb_config` VALUES ('img_link_height', '0', '0');
INSERT INTO `phpbb_config` VALUES ('img_link_width', '0', '0');
INSERT INTO `phpbb_config` VALUES ('img_max_height', '0', '0');
INSERT INTO `phpbb_config` VALUES ('img_max_thumb_width', '400', '0');
INSERT INTO `phpbb_config` VALUES ('img_max_width', '0', '0');
INSERT INTO `phpbb_config` VALUES ('img_min_thumb_filesize', '12000', '0');
INSERT INTO `phpbb_config` VALUES ('ip_check', '3', '0');
INSERT INTO `phpbb_config` VALUES ('ip_login_limit_max', '50', '0');
INSERT INTO `phpbb_config` VALUES ('ip_login_limit_time', '21600', '0');
INSERT INTO `phpbb_config` VALUES ('ip_login_limit_use_forwarded', '0', '0');
INSERT INTO `phpbb_config` VALUES ('jab_enable', '0', '0');
INSERT INTO `phpbb_config` VALUES ('jab_host', '', '0');
INSERT INTO `phpbb_config` VALUES ('jab_password', '', '0');
INSERT INTO `phpbb_config` VALUES ('jab_package_size', '20', '0');
INSERT INTO `phpbb_config` VALUES ('jab_port', '5222', '0');
INSERT INTO `phpbb_config` VALUES ('jab_use_ssl', '0', '0');
INSERT INTO `phpbb_config` VALUES ('jab_username', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_base_dn', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_email', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_password', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_port', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_server', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_uid', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_user', '', '0');
INSERT INTO `phpbb_config` VALUES ('ldap_user_filter', '', '0');
INSERT INTO `phpbb_config` VALUES ('legend_sort_groupname', '0', '0');
INSERT INTO `phpbb_config` VALUES ('limit_load', '0', '0');
INSERT INTO `phpbb_config` VALUES ('limit_search_load', '0', '0');
INSERT INTO `phpbb_config` VALUES ('load_anon_lastread', '0', '0');
INSERT INTO `phpbb_config` VALUES ('load_birthdays', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_cpf_memberlist', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_cpf_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_cpf_viewprofile', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_cpf_viewtopic', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_db_lastread', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_db_track', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_jquery_url', '//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js', '0');
INSERT INTO `phpbb_config` VALUES ('load_jumpbox', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_moderators', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_notifications', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_online', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_online_guests', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_online_time', '5', '0');
INSERT INTO `phpbb_config` VALUES ('load_onlinetrack', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_search', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_tplcompile', '0', '0');
INSERT INTO `phpbb_config` VALUES ('load_unreads_search', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_user_activity', '1', '0');
INSERT INTO `phpbb_config` VALUES ('load_user_activity_limit', '5000', '0');
INSERT INTO `phpbb_config` VALUES ('max_attachments', '3', '0');
INSERT INTO `phpbb_config` VALUES ('max_attachments_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('max_autologin_time', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_filesize', '262144', '0');
INSERT INTO `phpbb_config` VALUES ('max_filesize_pm', '262144', '0');
INSERT INTO `phpbb_config` VALUES ('max_login_attempts', '3', '0');
INSERT INTO `phpbb_config` VALUES ('max_name_chars', '20', '0');
INSERT INTO `phpbb_config` VALUES ('max_num_search_keywords', '10', '0');
INSERT INTO `phpbb_config` VALUES ('max_pass_chars', '100', '0');
INSERT INTO `phpbb_config` VALUES ('max_poll_options', '10', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_chars', '60000', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_font_size', '200', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_img_height', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_img_width', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_smilies', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_post_urls', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_quote_depth', '3', '0');
INSERT INTO `phpbb_config` VALUES ('max_reg_attempts', '5', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_chars', '255', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_font_size', '200', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_img_height', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_img_width', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_smilies', '0', '0');
INSERT INTO `phpbb_config` VALUES ('max_sig_urls', '5', '0');
INSERT INTO `phpbb_config` VALUES ('min_name_chars', '3', '0');
INSERT INTO `phpbb_config` VALUES ('min_pass_chars', '6', '0');
INSERT INTO `phpbb_config` VALUES ('min_post_chars', '1', '0');
INSERT INTO `phpbb_config` VALUES ('min_search_author_chars', '3', '0');
INSERT INTO `phpbb_config` VALUES ('mime_triggers', 'body|head|html|img|plaintext|a href|pre|script|table|title', '0');
INSERT INTO `phpbb_config` VALUES ('new_member_post_limit', '3', '0');
INSERT INTO `phpbb_config` VALUES ('new_member_group_default', '0', '0');
INSERT INTO `phpbb_config` VALUES ('override_user_style', '0', '0');
INSERT INTO `phpbb_config` VALUES ('pass_complex', 'PASS_TYPE_ANY', '0');
INSERT INTO `phpbb_config` VALUES ('plupload_salt', '6d78bb61143159e73c21c243ee008691', '0');
INSERT INTO `phpbb_config` VALUES ('pm_edit_time', '0', '0');
INSERT INTO `phpbb_config` VALUES ('pm_max_boxes', '4', '0');
INSERT INTO `phpbb_config` VALUES ('pm_max_msgs', '50', '0');
INSERT INTO `phpbb_config` VALUES ('pm_max_recipients', '0', '0');
INSERT INTO `phpbb_config` VALUES ('posts_per_page', '10', '0');
INSERT INTO `phpbb_config` VALUES ('print_pm', '1', '0');
INSERT INTO `phpbb_config` VALUES ('queue_interval', '60', '0');
INSERT INTO `phpbb_config` VALUES ('ranks_path', 'images/ranks', '0');
INSERT INTO `phpbb_config` VALUES ('read_notification_expire_days', '30', '0');
INSERT INTO `phpbb_config` VALUES ('read_notification_gc', '86400', '0');
INSERT INTO `phpbb_config` VALUES ('remote_upload_verify', '0', '0');
INSERT INTO `phpbb_config` VALUES ('require_activation', '0', '0');
INSERT INTO `phpbb_config` VALUES ('referer_validation', '0', '0');
INSERT INTO `phpbb_config` VALUES ('script_path', '/dot-board', '0');
INSERT INTO `phpbb_config` VALUES ('search_block_size', '250', '0');
INSERT INTO `phpbb_config` VALUES ('search_gc', '7200', '0');
INSERT INTO `phpbb_config` VALUES ('search_interval', '0', '0');
INSERT INTO `phpbb_config` VALUES ('search_anonymous_interval', '0', '0');
INSERT INTO `phpbb_config` VALUES ('search_type', '\\phpbb\\search\\fulltext_native', '0');
INSERT INTO `phpbb_config` VALUES ('search_store_results', '1800', '0');
INSERT INTO `phpbb_config` VALUES ('secure_allow_deny', '1', '0');
INSERT INTO `phpbb_config` VALUES ('secure_allow_empty_referer', '1', '0');
INSERT INTO `phpbb_config` VALUES ('secure_downloads', '0', '0');
INSERT INTO `phpbb_config` VALUES ('server_name', 'localhost', '0');
INSERT INTO `phpbb_config` VALUES ('server_port', '80', '0');
INSERT INTO `phpbb_config` VALUES ('server_protocol', 'http://', '0');
INSERT INTO `phpbb_config` VALUES ('session_gc', '3600', '0');
INSERT INTO `phpbb_config` VALUES ('session_length', '3600', '0');
INSERT INTO `phpbb_config` VALUES ('site_desc', 'Dot weboard', '0');
INSERT INTO `phpbb_config` VALUES ('site_home_url', '', '0');
INSERT INTO `phpbb_config` VALUES ('site_home_text', '', '0');
INSERT INTO `phpbb_config` VALUES ('sitename', 'http://dot.go.th', '0');
INSERT INTO `phpbb_config` VALUES ('smilies_path', 'images/smilies', '0');
INSERT INTO `phpbb_config` VALUES ('smilies_per_page', '50', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_auth_method', 'PLAIN', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_delivery', '0', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_host', '', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_password', '', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_port', '', '0');
INSERT INTO `phpbb_config` VALUES ('smtp_username', '', '0');
INSERT INTO `phpbb_config` VALUES ('teampage_memberships', '1', '0');
INSERT INTO `phpbb_config` VALUES ('teampage_forums', '1', '0');
INSERT INTO `phpbb_config` VALUES ('topics_per_page', '25', '0');
INSERT INTO `phpbb_config` VALUES ('tpl_allow_php', '0', '0');
INSERT INTO `phpbb_config` VALUES ('upload_icons_path', 'images/upload_icons', '0');
INSERT INTO `phpbb_config` VALUES ('upload_path', 'files', '0');
INSERT INTO `phpbb_config` VALUES ('use_system_cron', '0', '0');
INSERT INTO `phpbb_config` VALUES ('version', '3.2.4', '0');
INSERT INTO `phpbb_config` VALUES ('warnings_expire_days', '90', '0');
INSERT INTO `phpbb_config` VALUES ('warnings_gc', '14400', '0');
INSERT INTO `phpbb_config` VALUES ('cache_last_gc', '1542871817', '1');
INSERT INTO `phpbb_config` VALUES ('cron_lock', '0', '1');
INSERT INTO `phpbb_config` VALUES ('database_last_gc', '1542859436', '1');
INSERT INTO `phpbb_config` VALUES ('last_queue_run', '0', '1');
INSERT INTO `phpbb_config` VALUES ('newest_user_colour', 'AA0000', '1');
INSERT INTO `phpbb_config` VALUES ('newest_user_id', '2', '1');
INSERT INTO `phpbb_config` VALUES ('newest_username', 'root', '1');
INSERT INTO `phpbb_config` VALUES ('num_files', '0', '1');
INSERT INTO `phpbb_config` VALUES ('num_posts', '1', '1');
INSERT INTO `phpbb_config` VALUES ('num_topics', '1', '1');
INSERT INTO `phpbb_config` VALUES ('num_users', '1', '1');
INSERT INTO `phpbb_config` VALUES ('plupload_last_gc', '0', '1');
INSERT INTO `phpbb_config` VALUES ('rand_seed', '55e9e0c189f480226cbd7e65e6bf4caf', '1');
INSERT INTO `phpbb_config` VALUES ('rand_seed_last_update', '1542809696', '1');
INSERT INTO `phpbb_config` VALUES ('read_notification_last_gc', '1542860219', '1');
INSERT INTO `phpbb_config` VALUES ('record_online_date', '1542860198', '1');
INSERT INTO `phpbb_config` VALUES ('record_online_users', '1', '1');
INSERT INTO `phpbb_config` VALUES ('search_indexing_state', '', '1');
INSERT INTO `phpbb_config` VALUES ('search_last_gc', '1542871820', '1');
INSERT INTO `phpbb_config` VALUES ('session_last_gc', '1542871712', '1');
INSERT INTO `phpbb_config` VALUES ('upload_dir_size', '0', '1');
INSERT INTO `phpbb_config` VALUES ('warnings_last_gc', '1542859861', '1');
INSERT INTO `phpbb_config` VALUES ('board_startdate', '1542809695', '0');
INSERT INTO `phpbb_config` VALUES ('default_lang', 'en', '0');
INSERT INTO `phpbb_config` VALUES ('allow_viglink_phpbb', '1', '0');
INSERT INTO `phpbb_config` VALUES ('viglink_last_gc', '1542862731', '1');
INSERT INTO `phpbb_config` VALUES ('viglink_enabled', '0', '0');
INSERT INTO `phpbb_config` VALUES ('viglink_ask_admin_last', '1542860514', '0');
INSERT INTO `phpbb_config` VALUES ('viglink_ask_admin', '', '0');
INSERT INTO `phpbb_config` VALUES ('phpbb_viglink_api_key', 'e4fd14f5d7f2bb6d80b8f8da1354718c', '0');
INSERT INTO `phpbb_config` VALUES ('viglink_convert_account_url', '', '0');
INSERT INTO `phpbb_config` VALUES ('viglink_api_siteid', '421aa90e079fa326b6494f812ad13e79', '0');
INSERT INTO `phpbb_config` VALUES ('questionnaire_unique_id', '3y53v7io3sgmds73', '0');

-- ----------------------------
-- Table structure for phpbb_config_text
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_config_text`;
CREATE TABLE `phpbb_config_text` (
  `config_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `config_value` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`config_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_config_text
-- ----------------------------
INSERT INTO `phpbb_config_text` VALUES ('contact_admin_info', '');
INSERT INTO `phpbb_config_text` VALUES ('contact_admin_info_uid', '');
INSERT INTO `phpbb_config_text` VALUES ('contact_admin_info_bitfield', '');
INSERT INTO `phpbb_config_text` VALUES ('contact_admin_info_flags', 0x37);

-- ----------------------------
-- Table structure for phpbb_confirm
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_confirm`;
CREATE TABLE `phpbb_confirm` (
  `confirm_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `confirm_type` tinyint(3) NOT NULL DEFAULT '0',
  `code` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `seed` int(10) unsigned NOT NULL DEFAULT '0',
  `attempts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`,`confirm_id`),
  KEY `confirm_type` (`confirm_type`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_confirm
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_disallow
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_disallow`;
CREATE TABLE `phpbb_disallow` (
  `disallow_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `disallow_username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`disallow_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_disallow
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_drafts
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_drafts`;
CREATE TABLE `phpbb_drafts` (
  `draft_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `save_time` int(11) unsigned NOT NULL DEFAULT '0',
  `draft_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `draft_message` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`draft_id`),
  KEY `save_time` (`save_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_drafts
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_ext
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_ext`;
CREATE TABLE `phpbb_ext` (
  `ext_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ext_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ext_state` text COLLATE utf8_bin NOT NULL,
  UNIQUE KEY `ext_name` (`ext_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_ext
-- ----------------------------
INSERT INTO `phpbb_ext` VALUES ('phpbb/viglink', '1', 0x623A303B);

-- ----------------------------
-- Table structure for phpbb_extensions
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_extensions`;
CREATE TABLE `phpbb_extensions` (
  `extension_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `extension` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_extensions
-- ----------------------------
INSERT INTO `phpbb_extensions` VALUES ('1', '1', 'gif');
INSERT INTO `phpbb_extensions` VALUES ('2', '1', 'png');
INSERT INTO `phpbb_extensions` VALUES ('3', '1', 'jpeg');
INSERT INTO `phpbb_extensions` VALUES ('4', '1', 'jpg');
INSERT INTO `phpbb_extensions` VALUES ('5', '1', 'tif');
INSERT INTO `phpbb_extensions` VALUES ('6', '1', 'tiff');
INSERT INTO `phpbb_extensions` VALUES ('7', '1', 'tga');
INSERT INTO `phpbb_extensions` VALUES ('8', '2', 'gtar');
INSERT INTO `phpbb_extensions` VALUES ('9', '2', 'gz');
INSERT INTO `phpbb_extensions` VALUES ('10', '2', 'tar');
INSERT INTO `phpbb_extensions` VALUES ('11', '2', 'zip');
INSERT INTO `phpbb_extensions` VALUES ('12', '2', 'rar');
INSERT INTO `phpbb_extensions` VALUES ('13', '2', 'ace');
INSERT INTO `phpbb_extensions` VALUES ('14', '2', 'torrent');
INSERT INTO `phpbb_extensions` VALUES ('15', '2', 'tgz');
INSERT INTO `phpbb_extensions` VALUES ('16', '2', 'bz2');
INSERT INTO `phpbb_extensions` VALUES ('17', '2', '7z');
INSERT INTO `phpbb_extensions` VALUES ('18', '3', 'txt');
INSERT INTO `phpbb_extensions` VALUES ('19', '3', 'c');
INSERT INTO `phpbb_extensions` VALUES ('20', '3', 'h');
INSERT INTO `phpbb_extensions` VALUES ('21', '3', 'cpp');
INSERT INTO `phpbb_extensions` VALUES ('22', '3', 'hpp');
INSERT INTO `phpbb_extensions` VALUES ('23', '3', 'diz');
INSERT INTO `phpbb_extensions` VALUES ('24', '3', 'csv');
INSERT INTO `phpbb_extensions` VALUES ('25', '3', 'ini');
INSERT INTO `phpbb_extensions` VALUES ('26', '3', 'log');
INSERT INTO `phpbb_extensions` VALUES ('27', '3', 'js');
INSERT INTO `phpbb_extensions` VALUES ('28', '3', 'xml');
INSERT INTO `phpbb_extensions` VALUES ('29', '4', 'xls');
INSERT INTO `phpbb_extensions` VALUES ('30', '4', 'xlsx');
INSERT INTO `phpbb_extensions` VALUES ('31', '4', 'xlsm');
INSERT INTO `phpbb_extensions` VALUES ('32', '4', 'xlsb');
INSERT INTO `phpbb_extensions` VALUES ('33', '4', 'doc');
INSERT INTO `phpbb_extensions` VALUES ('34', '4', 'docx');
INSERT INTO `phpbb_extensions` VALUES ('35', '4', 'docm');
INSERT INTO `phpbb_extensions` VALUES ('36', '4', 'dot');
INSERT INTO `phpbb_extensions` VALUES ('37', '4', 'dotx');
INSERT INTO `phpbb_extensions` VALUES ('38', '4', 'dotm');
INSERT INTO `phpbb_extensions` VALUES ('39', '4', 'pdf');
INSERT INTO `phpbb_extensions` VALUES ('40', '4', 'ai');
INSERT INTO `phpbb_extensions` VALUES ('41', '4', 'ps');
INSERT INTO `phpbb_extensions` VALUES ('42', '4', 'ppt');
INSERT INTO `phpbb_extensions` VALUES ('43', '4', 'pptx');
INSERT INTO `phpbb_extensions` VALUES ('44', '4', 'pptm');
INSERT INTO `phpbb_extensions` VALUES ('45', '4', 'odg');
INSERT INTO `phpbb_extensions` VALUES ('46', '4', 'odp');
INSERT INTO `phpbb_extensions` VALUES ('47', '4', 'ods');
INSERT INTO `phpbb_extensions` VALUES ('48', '4', 'odt');
INSERT INTO `phpbb_extensions` VALUES ('49', '4', 'rtf');
INSERT INTO `phpbb_extensions` VALUES ('50', '5', 'swf');
INSERT INTO `phpbb_extensions` VALUES ('51', '6', 'mp3');
INSERT INTO `phpbb_extensions` VALUES ('52', '6', 'mpeg');
INSERT INTO `phpbb_extensions` VALUES ('53', '6', 'mpg');
INSERT INTO `phpbb_extensions` VALUES ('54', '6', 'ogg');
INSERT INTO `phpbb_extensions` VALUES ('55', '6', 'ogm');

-- ----------------------------
-- Table structure for phpbb_extension_groups
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_extension_groups`;
CREATE TABLE `phpbb_extension_groups` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `cat_id` tinyint(2) NOT NULL DEFAULT '0',
  `allow_group` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `download_mode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `upload_icon` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `max_filesize` int(20) unsigned NOT NULL DEFAULT '0',
  `allowed_forums` text COLLATE utf8_bin NOT NULL,
  `allow_in_pm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_extension_groups
-- ----------------------------
INSERT INTO `phpbb_extension_groups` VALUES ('1', 'IMAGES', '1', '1', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('2', 'ARCHIVES', '0', '1', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('3', 'PLAIN_TEXT', '0', '0', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('4', 'DOCUMENTS', '0', '0', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('5', 'FLASH_FILES', '5', '0', '1', '', '0', '', '0');
INSERT INTO `phpbb_extension_groups` VALUES ('6', 'DOWNLOADABLE_FILES', '0', '0', '1', '', '0', '', '0');

-- ----------------------------
-- Table structure for phpbb_forums
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_forums`;
CREATE TABLE `phpbb_forums` (
  `forum_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `left_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `right_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_parents` mediumtext COLLATE utf8_bin NOT NULL,
  `forum_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_desc` text COLLATE utf8_bin NOT NULL,
  `forum_desc_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_desc_options` int(11) unsigned NOT NULL DEFAULT '7',
  `forum_desc_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_link` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_style` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules` text COLLATE utf8_bin NOT NULL,
  `forum_rules_link` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_rules_options` int(11) unsigned NOT NULL DEFAULT '7',
  `forum_rules_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_topics_per_page` smallint(4) unsigned NOT NULL DEFAULT '0',
  `forum_type` tinyint(4) NOT NULL DEFAULT '0',
  `forum_status` tinyint(4) NOT NULL DEFAULT '0',
  `forum_last_post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_last_poster_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_last_post_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `forum_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `forum_flags` tinyint(4) NOT NULL DEFAULT '32',
  `display_on_index` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_indexing` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_icons` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_prune` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `prune_next` int(11) unsigned NOT NULL DEFAULT '0',
  `prune_days` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_viewed` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `prune_freq` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_subforum_list` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `forum_options` int(20) unsigned NOT NULL DEFAULT '0',
  `forum_posts_approved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_posts_unapproved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_posts_softdeleted` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_approved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_unapproved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `forum_topics_softdeleted` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `enable_shadow_prune` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `prune_shadow_days` mediumint(8) unsigned NOT NULL DEFAULT '7',
  `prune_shadow_freq` mediumint(8) unsigned NOT NULL DEFAULT '1',
  `prune_shadow_next` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`forum_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `forum_lastpost_id` (`forum_last_post_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_forums
-- ----------------------------
INSERT INTO `phpbb_forums` VALUES ('1', '0', '1', '4', '', 'Your first category', '', '', '7', '', '', '', '0', '', '', '', '', '7', '', '0', '0', '0', '1', '2', '', '1542809695', 'root', 'AA0000', '32', '1', '1', '1', '0', '0', '0', '0', '0', '1', '0', '0', '0', '0', '0', '0', '0', '0', '7', '1', '0');
INSERT INTO `phpbb_forums` VALUES ('2', '1', '2', '3', 0x613A313A7B693A313B613A323A7B693A303B733A31393A22596F75722066697273742063617465676F7279223B693A313B693A303B7D7D, 'Your first forum', 0x4465736372697074696F6E206F6620796F757220666972737420666F72756D2E, '', '7', '', '', '', '0', '', '', '', '', '7', '', '0', '1', '0', '1', '2', 'Welcome to phpBB3', '1542809695', 'root', 'AA0000', '48', '1', '1', '1', '0', '0', '0', '0', '0', '1', '0', '1', '0', '0', '1', '0', '0', '0', '7', '1', '0');

-- ----------------------------
-- Table structure for phpbb_forums_access
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_forums_access`;
CREATE TABLE `phpbb_forums_access` (
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`forum_id`,`user_id`,`session_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_forums_access
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_forums_track
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_forums_track`;
CREATE TABLE `phpbb_forums_track` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mark_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_forums_track
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_forums_watch
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_forums_watch`;
CREATE TABLE `phpbb_forums_watch` (
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `notify_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  KEY `forum_id` (`forum_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_stat` (`notify_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_forums_watch
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_groups
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_groups`;
CREATE TABLE `phpbb_groups` (
  `group_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_type` tinyint(4) NOT NULL DEFAULT '1',
  `group_founder_manage` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_skip_auth` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_desc` text COLLATE utf8_bin NOT NULL,
  `group_desc_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_desc_options` int(11) unsigned NOT NULL DEFAULT '7',
  `group_desc_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_display` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_avatar` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_avatar_type` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_avatar_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `group_avatar_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `group_rank` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_sig_chars` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_receive_pm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `group_message_limit` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_legend` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_max_recipients` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`group_id`),
  KEY `group_legend_name` (`group_legend`,`group_name`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_groups
-- ----------------------------
INSERT INTO `phpbb_groups` VALUES ('1', '3', '0', '0', 'GUESTS', '', '', '7', '', '0', '', '', '0', '0', '0', '', '0', '0', '0', '0', '5');
INSERT INTO `phpbb_groups` VALUES ('2', '3', '0', '0', 'REGISTERED', '', '', '7', '', '0', '', '', '0', '0', '0', '', '0', '0', '0', '0', '5');
INSERT INTO `phpbb_groups` VALUES ('3', '3', '0', '0', 'REGISTERED_COPPA', '', '', '7', '', '0', '', '', '0', '0', '0', '', '0', '0', '0', '0', '5');
INSERT INTO `phpbb_groups` VALUES ('4', '3', '0', '0', 'GLOBAL_MODERATORS', '', '', '7', '', '0', '', '', '0', '0', '0', '00AA00', '0', '0', '0', '2', '0');
INSERT INTO `phpbb_groups` VALUES ('5', '3', '1', '0', 'ADMINISTRATORS', '', '', '7', '', '0', '', '', '0', '0', '0', 'AA0000', '0', '0', '0', '1', '0');
INSERT INTO `phpbb_groups` VALUES ('6', '3', '0', '0', 'BOTS', '', '', '7', '', '0', '', '', '0', '0', '0', '9E8DA7', '0', '0', '0', '0', '5');
INSERT INTO `phpbb_groups` VALUES ('7', '3', '0', '0', 'NEWLY_REGISTERED', '', '', '7', '', '0', '', '', '0', '0', '0', '', '0', '0', '0', '0', '5');

-- ----------------------------
-- Table structure for phpbb_icons
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_icons`;
CREATE TABLE `phpbb_icons` (
  `icons_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `icons_url` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `icons_width` tinyint(4) NOT NULL DEFAULT '0',
  `icons_height` tinyint(4) NOT NULL DEFAULT '0',
  `icons_alt` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `icons_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`icons_id`),
  KEY `display_on_posting` (`display_on_posting`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_icons
-- ----------------------------
INSERT INTO `phpbb_icons` VALUES ('1', 'misc/fire.gif', '16', '16', '', '1', '1');
INSERT INTO `phpbb_icons` VALUES ('2', 'smile/redface.gif', '16', '16', '', '9', '1');
INSERT INTO `phpbb_icons` VALUES ('3', 'smile/mrgreen.gif', '16', '16', '', '10', '1');
INSERT INTO `phpbb_icons` VALUES ('4', 'misc/heart.gif', '16', '16', '', '4', '1');
INSERT INTO `phpbb_icons` VALUES ('5', 'misc/star.gif', '16', '16', '', '2', '1');
INSERT INTO `phpbb_icons` VALUES ('6', 'misc/radioactive.gif', '16', '16', '', '3', '1');
INSERT INTO `phpbb_icons` VALUES ('7', 'misc/thinking.gif', '16', '16', '', '5', '1');
INSERT INTO `phpbb_icons` VALUES ('8', 'smile/info.gif', '16', '16', '', '8', '1');
INSERT INTO `phpbb_icons` VALUES ('9', 'smile/question.gif', '16', '16', '', '6', '1');
INSERT INTO `phpbb_icons` VALUES ('10', 'smile/alert.gif', '16', '16', '', '7', '1');

-- ----------------------------
-- Table structure for phpbb_lang
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_lang`;
CREATE TABLE `phpbb_lang` (
  `lang_id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `lang_iso` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_dir` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_english_name` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_local_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_author` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`lang_id`),
  KEY `lang_iso` (`lang_iso`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_lang
-- ----------------------------
INSERT INTO `phpbb_lang` VALUES ('1', 'en', 'en', 'British English', 'British English', 'phpBB Limited');

-- ----------------------------
-- Table structure for phpbb_log
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_log`;
CREATE TABLE `phpbb_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `reportee_id` int(10) unsigned NOT NULL DEFAULT '0',
  `log_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `log_time` int(11) unsigned NOT NULL DEFAULT '0',
  `log_operation` text COLLATE utf8_bin NOT NULL,
  `log_data` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `log_type` (`log_type`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `reportee_id` (`reportee_id`),
  KEY `user_id` (`user_id`),
  KEY `log_time` (`log_time`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_log
-- ----------------------------
INSERT INTO `phpbb_log` VALUES ('1', '0', '1', '0', '0', '0', '0', '::1', '1542809736', 0x4C4F475F4D4F44554C455F414444, 0x613A313A7B693A303B733A32303A224143505F5649474C494E4B5F53455454494E4753223B7D);
INSERT INTO `phpbb_log` VALUES ('2', '0', '1', '0', '0', '0', '0', '', '1542809736', 0x4C4F475F4558545F454E41424C45, 0x613A313A7B693A303B733A31333A2270687062622F7669676C696E6B223B7D);
INSERT INTO `phpbb_log` VALUES ('3', '2', '1', '0', '0', '0', '0', '::1', '1542809738', 0x4C4F475F4552524F525F454D41494C, 0x613A313A7B693A303B733A3332363A223C7374726F6E673E454D41494C2F5048502F6D61696C28293C2F7374726F6E673E3C6272202F3E3C656D3E2F646F742D626F6172642F696E7374616C6C2F6170702E7068702F696E7374616C6C3C2F656D3E3C6272202F3E3C6272202F3E4572726E6F20323A206D61696C28293A204661696C656420746F20636F6E6E65637420746F206D61696C736572766572206174202671756F743B6C6F63616C686F73742671756F743B20706F72742032352C2076657269667920796F7572202671756F743B534D54502671756F743B20616E64202671756F743B736D74705F706F72742671756F743B2073657474696E6720696E207068702E696E69206F722075736520696E695F7365742829206174205B524F4F545D2F696E636C756465732F66756E6374696F6E735F6D657373656E6765722E706870206C696E6520313930393C6272202F3E223B7D);
INSERT INTO `phpbb_log` VALUES ('4', '0', '2', '0', '0', '0', '0', '::1', '1542809738', 0x4C4F475F494E5354414C4C5F494E5354414C4C4544, 0x613A313A7B693A303B733A353A22332E322E34223B7D);
INSERT INTO `phpbb_log` VALUES ('5', '0', '2', '0', '0', '0', '0', '::1', '1542860510', 0x4C4F475F41444D494E5F415554485F53554343455353, '');
INSERT INTO `phpbb_log` VALUES ('6', '0', '2', '0', '0', '0', '0', '::1', '1542861127', 0x4C4F475F5354594C455F414444, 0x613A313A7B693A303B733A31303A2253696D706C6963697479223B7D);
INSERT INTO `phpbb_log` VALUES ('7', '0', '2', '0', '0', '0', '0', '::1', '1542861148', 0x4C4F475F5354594C455F414444, 0x613A313A7B693A303B733A31353A2253696D706C69636974792047726179223B7D);
INSERT INTO `phpbb_log` VALUES ('8', '0', '2', '0', '0', '0', '0', '::1', '1542861410', 0x4C4F475F5354594C455F454449545F44455441494C53, 0x613A313A7B693A303B733A31303A2253696D706C6963697479223B7D);
INSERT INTO `phpbb_log` VALUES ('9', '0', '2', '0', '0', '0', '0', '::1', '1542861445', 0x4C4F475F5354594C455F454449545F44455441494C53, 0x613A313A7B693A303B733A393A2270726F73696C766572223B7D);
INSERT INTO `phpbb_log` VALUES ('10', '0', '2', '0', '0', '0', '0', '::1', '1542861765', 0x4C4F475F5354594C455F414444, 0x613A313A7B693A303B733A31353A2253696D706C69636974792041717561223B7D);
INSERT INTO `phpbb_log` VALUES ('11', '0', '2', '0', '0', '0', '0', '::1', '1542861845', 0x4C4F475F5354594C455F44454C455445, 0x613A313A7B693A303B733A33323A2253696D706C696369747920417175612C2053696D706C69636974792047726179223B7D);
INSERT INTO `phpbb_log` VALUES ('12', '0', '2', '0', '0', '0', '0', '::1', '1542861861', 0x4C4F475F5354594C455F454449545F44455441494C53, 0x613A313A7B693A303B733A393A2270726F73696C766572223B7D);
INSERT INTO `phpbb_log` VALUES ('13', '0', '2', '0', '0', '0', '0', '::1', '1542861866', 0x4C4F475F5354594C455F44454C455445, 0x613A313A7B693A303B733A31303A2253696D706C6963697479223B7D);
INSERT INTO `phpbb_log` VALUES ('14', '0', '2', '0', '0', '0', '0', '::1', '1542862004', 0x4C4F475F5354594C455F414444, 0x613A313A7B693A303B733A31303A2253696D706C6963697479223B7D);
INSERT INTO `phpbb_log` VALUES ('15', '0', '2', '0', '0', '0', '0', '::1', '1542862015', 0x4C4F475F5354594C455F414444, 0x613A313A7B693A303B733A31353A2253696D706C69636974792041717561223B7D);
INSERT INTO `phpbb_log` VALUES ('16', '0', '2', '0', '0', '0', '0', '::1', '1542862015', 0x4C4F475F5354594C455F414444, 0x613A313A7B693A303B733A31353A2253696D706C696369747920426C7565223B7D);
INSERT INTO `phpbb_log` VALUES ('17', '0', '2', '0', '0', '0', '0', '::1', '1542862015', 0x4C4F475F5354594C455F414444, 0x613A313A7B693A303B733A32303A2253696D706C6963697479204461726B20426C7565223B7D);
INSERT INTO `phpbb_log` VALUES ('18', '0', '2', '0', '0', '0', '0', '::1', '1542862015', 0x4C4F475F5354594C455F414444, 0x613A313A7B693A303B733A31353A2253696D706C69636974792047726179223B7D);
INSERT INTO `phpbb_log` VALUES ('19', '0', '2', '0', '0', '0', '0', '::1', '1542862015', 0x4C4F475F5354594C455F414444, 0x613A313A7B693A303B733A32313A2253696D706C6963697479204C6967687420426C7565223B7D);
INSERT INTO `phpbb_log` VALUES ('20', '0', '2', '0', '0', '0', '0', '::1', '1542862015', 0x4C4F475F5354594C455F414444, 0x613A313A7B693A303B733A32313A2253696D706C696369747920537465656C20426C7565223B7D);
INSERT INTO `phpbb_log` VALUES ('21', '0', '2', '0', '0', '0', '0', '::1', '1542862031', 0x4C4F475F5354594C455F454449545F44455441494C53, 0x613A313A7B693A303B733A31303A2253696D706C6963697479223B7D);
INSERT INTO `phpbb_log` VALUES ('22', '0', '2', '0', '0', '0', '0', '::1', '1542871831', 0x4C4F475F41444D494E5F415554485F53554343455353, '');
INSERT INTO `phpbb_log` VALUES ('23', '0', '2', '0', '0', '0', '0', '::1', '1542871864', 0x4C4F475F5354594C455F44454C455445, 0x613A313A7B693A303B733A3132393A2253696D706C696369747920537465656C20426C75652C2053696D706C6963697479204C6967687420426C75652C2053696D706C696369747920477261792C2053696D706C6963697479204461726B20426C75652C2053696D706C696369747920426C75652C2053696D706C696369747920417175612C2053696D706C6963697479223B7D);

-- ----------------------------
-- Table structure for phpbb_login_attempts
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_login_attempts`;
CREATE TABLE `phpbb_login_attempts` (
  `attempt_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `attempt_browser` varchar(150) COLLATE utf8_bin NOT NULL DEFAULT '',
  `attempt_forwarded_for` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `attempt_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `username_clean` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '0',
  KEY `att_ip` (`attempt_ip`,`attempt_time`),
  KEY `att_for` (`attempt_forwarded_for`,`attempt_time`),
  KEY `att_time` (`attempt_time`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_login_attempts
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_migrations
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_migrations`;
CREATE TABLE `phpbb_migrations` (
  `migration_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `migration_depends_on` text COLLATE utf8_bin NOT NULL,
  `migration_schema_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `migration_data_done` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `migration_data_state` text COLLATE utf8_bin NOT NULL,
  `migration_start_time` int(11) unsigned NOT NULL DEFAULT '0',
  `migration_end_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`migration_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_migrations
-- ----------------------------
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\local_url_bbcode', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31325F726331223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_0', 0x613A303A7B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_1', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F315F726331223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31305F726333223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F39223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc2', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31305F726331223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_10_rc3', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31305F726332223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31315F726332223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11_rc1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3130223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_11_rc2', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31315F726331223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31325F726333223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc2', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31325F726331223B7D, '1', '1', '', '1542809713', '1542809713');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_12_rc3', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31325F726332223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31335F726331223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13_pl1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3133223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_13_rc1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3132223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_14', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31345F726331223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_14_rc1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3133223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_1_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F30223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F325F726332223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_2_rc2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F325F726331223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_3', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F335F726331223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_3_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F32223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_4', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F345F726331223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_4_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F33223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5', 0x613A313A7B693A303B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F355F7263317061727432223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F34223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_5_rc1part2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F355F726331223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F365F726334223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F35223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F365F726331223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc3', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F365F726332223B7D, '1', '1', '', '1542809714', '1542809714');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_6_rc4', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F365F726333223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F375F726332223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_pl1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F37223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F36223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_7_rc2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F375F726331223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_8', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F385F726331223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_8_rc1', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F375F706C31223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F395F726334223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc1', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F38223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc2', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F395F726331223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc3', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F395F726332223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v30x\\release_3_0_9_rc4', 0x613A313A7B693A303B733A34373A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F395F726333223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\acp_prune_users_module', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746131223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\acp_style_components_module', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\allow_cdn', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6A71756572795F757064617465223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\alpha1', 0x613A31383A7B693A303B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C6C6F63616C5F75726C5F6262636F6465223B693A313B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3132223B693A323B733A35373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6163705F7374796C655F636F6D706F6E656E74735F6D6F64756C65223B693A333B733A33393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C6C6F775F63646E223B693A343B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C617574685F70726F76696465725F6F61757468223B693A353B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C61766174617273223B693A363B733A34303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C626F617264696E646578223B693A373B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636F6E6669675F64625F74657874223B693A383B733A34353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C666F72676F745F70617373776F7264223B693A393B733A34313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6D6F645F72657772697465223B693A31303B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6D7973716C5F66756C6C746578745F64726F70223B693A31313B733A34303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E616D65737061636573223B693A31323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E735F63726F6E223B693A31333B733A36303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E5F6F7074696F6E735F7265636F6E76657274223B693A31343B733A33383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C706C75706C6F6164223B693A31353B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7369676E61747572655F6D6F64756C655F61757468223B693A31363B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C736F667464656C6574655F6D63705F6D6F64756C6573223B693A31373B733A33383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7465616D70616765223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\alpha2', 0x613A323A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C70686131223B693A313B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E735F63726F6E5F7032223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\alpha3', 0x613A343A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C70686132223B693A313B733A34323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6176617461725F7479706573223B693A323B733A33393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F726473223B693A333B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\auth_provider_oauth', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F30223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\auth_provider_oauth2', 0x613A313A7B693A303B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C617574685F70726F76696465725F6F61757468223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\avatars', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1542809715', '1542809715');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\avatar_types', 0x613A323A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C61766174617273223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\beta1', 0x613A373A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C70686133223B693A313B733A34323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F7264735F7032223B693A323B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C706F7374677265735F66756C6C746578745F64726F70223B693A333B733A36333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6368616E67655F6C6F61645F73657474696E6773223B693A343B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6C6F636174696F6E223B693A353B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C736F66745F64656C6574655F6D6F645F636F6E7665727432223B693A363B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7563705F706F707570706D5F6D6F64756C65223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\beta2', 0x613A333A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746131223B693A313B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6163705F7072756E655F75736572735F6D6F64756C65223B693A323B733A35393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6C6F636174696F6E5F636C65616E7570223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\beta3', 0x613A363A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746132223B693A313B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C617574685F70726F76696465725F6F6175746832223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C626F6172645F636F6E746163745F6E616D65223B693A333B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6A71756572795F75706461746532223B693A343B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6C6976655F73656172636865735F636F6E666967223B693A353B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7072756E655F736861646F775F746F70696373223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\beta4', 0x613A333A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746133223B693A313B733A36393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C657874656E73696F6E735F76657273696F6E5F636865636B5F666F7263655F756E737461626C65223B693A323B733A35383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C72657365745F6D697373696E675F636170746368615F706C7567696E223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\boardindex', 0x613A303A7B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\board_contact_name', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746132223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\bot_update', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726336223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\captcha_plugins', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726332223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\config_db_text', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\contact_admin_acp_module', 0x613A303A7B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\contact_admin_form', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636F6E6669675F64625F74657874223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\dev', 0x613A353A7B693A303B733A34303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C657874656E73696F6E73223B693A313B733A34353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7374796C655F7570646174655F7032223B693A323B733A34313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C74696D657A6F6E655F7032223B693A333B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7265706F727465645F706F7374735F646973706C6179223B693A343B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6D6967726174696F6E735F7461626C65223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\extensions', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\extensions_version_check_force_unstable', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\forgot_password', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\gold', 0x613A323A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726336223B693A313B733A34303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C626F745F757064617465223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\jquery_update', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\jquery_update2', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6A71756572795F757064617465223B7D, '1', '1', '', '1542809716', '1542809716');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\live_searches_config', 0x613A303A7B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\migrations_table', 0x613A303A7B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\mod_rewrite', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\mysql_fulltext_drop', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\namespaces', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notifications', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notifications_cron', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E73223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notifications_cron_p2', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E735F63726F6E223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notifications_schema_fix', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E73223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notifications_use_full_name', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726333223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\notification_options_reconvert', 0x613A313A7B693A303B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E735F736368656D615F666978223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\passwords', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\passwords_convert_p1', 0x613A313A7B693A303B733A34323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F7264735F7032223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\passwords_convert_p2', 0x613A313A7B693A303B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F7264735F636F6E766572745F7031223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\passwords_p2', 0x613A313A7B693A303B733A33393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F726473223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\plupload', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\postgres_fulltext_drop', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_aol', 0x613A313A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7961686F6F5F636C65616E7570223B7D, '1', '1', '', '1542809717', '1542809717');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_aol_cleanup', 0x613A313A7B693A303B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F616F6C223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_change_load_settings', 0x613A313A7B693A303B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F616F6C5F636C65616E7570223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_cleanup', 0x613A323A7B693A303B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F696E74657265737473223B693A313B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6F636375706174696F6E223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_contact_field', 0x613A313A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6F6E5F6D656D6265726C697374223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_facebook', 0x613A333A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_field_validation_length', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726333223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_googleplus', 0x613A333A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_icq', 0x613A313A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_icq_cleanup', 0x613A313A7B693A303B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F696371223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_interests', 0x613A323A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_location', 0x613A323A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B693A313B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6F6E5F6D656D6265726C697374223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_location_cleanup', 0x613A313A7B693A303B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6C6F636174696F6E223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_occupation', 0x613A313A7B693A303B733A35323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F696E74657265737473223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_on_memberlist', 0x613A313A7B693A303B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636C65616E7570223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_show_novalue', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_skype', 0x613A333A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_twitter', 0x613A333A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_types', 0x613A313A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C70686132223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_website', 0x613A323A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6F6E5F6D656D6265726C697374223B693A313B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6963715F636C65616E7570223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_website_cleanup', 0x613A313A7B693A303B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F77656273697465223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_wlm', 0x613A313A7B693A303B733A35383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F776562736974655F636C65616E7570223B7D, '1', '1', '', '1542809718', '1542809718');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_wlm_cleanup', 0x613A313A7B693A303B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F776C6D223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_yahoo', 0x613A313A7B693A303B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F776C6D5F636C65616E7570223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_yahoo_cleanup', 0x613A313A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7961686F6F223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\profilefield_youtube', 0x613A333A7B693A303B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F636F6E746163745F6669656C64223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F73686F775F6E6F76616C7565223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F7479706573223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\prune_shadow_topics', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc1', 0x613A393A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6265746134223B693A313B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636F6E746163745F61646D696E5F6163705F6D6F64756C65223B693A323B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636F6E746163745F61646D696E5F666F726D223B693A333B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70617373776F7264735F636F6E766572745F7032223B693A343B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F66616365626F6F6B223B693A353B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F676F6F676C65706C7573223B693A363B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F736B797065223B693A373B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F74776974746572223B693A383B733A35303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F796F7574756265223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc2', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726331223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc3', 0x613A353A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726332223B693A313B733A34353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636170746368615F706C7567696E73223B693A323B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C72656E616D655F746F6F5F6C6F6E675F696E6465786573223B693A333B733A34313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7365617263685F74797065223B693A343B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C746F7069635F736F72745F757365726E616D65223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc4', 0x613A323A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726333223B693A313B733A35373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C6E6F74696669636174696F6E735F7573655F66756C6C5F6E616D65223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc5', 0x613A333A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726334223B693A313B733A36363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C70726F66696C656669656C645F6669656C645F76616C69646174696F6E5F6C656E677468223B693A323B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C72656D6F76655F6163705F7374796C65735F6361636865223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rc6', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726335223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\remove_acp_styles_cache', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C726334223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\rename_too_long_indexes', 0x613A313A7B693A303B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F30223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\reported_posts_display', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\reset_missing_captcha_plugin', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\search_type', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\signature_module_auth', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\softdelete_mcp_modules', 0x613A323A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B693A313B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C736F667464656C6574655F7032223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\softdelete_p1', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\softdelete_p2', 0x613A323A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B693A313B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C736F667464656C6574655F7031223B7D, '1', '1', '', '1542809719', '1542809719');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\soft_delete_mod_convert', 0x613A313A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C616C70686133223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\soft_delete_mod_convert2', 0x613A313A7B693A303B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C736F66745F64656C6574655F6D6F645F636F6E76657274223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\style_update_p1', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\style_update_p2', 0x613A313A7B693A303B733A34353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C7374796C655F7570646174655F7031223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\teampage', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\timezone', 0x613A313A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3131223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\timezone_p2', 0x613A313A7B693A303B733A33383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C74696D657A6F6E65223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\topic_sort_username', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v310\\ucp_popuppm_module', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C646576223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\add_jabber_ssl_context_config_options', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313130223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\add_latest_topics_index', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313130223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\add_log_time_index', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333139223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\add_smtp_ssl_context_config_options', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313130223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\increase_size_of_dateformat', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333137223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\increase_size_of_emotion', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313130223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\m_pm_report', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333136726331223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\m_softdelete_global', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333131223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\plupload_last_gc_dynamic', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333132223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\profilefield_remove_underscore_from_alpha', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333131223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\profilefield_yahoo_update_url', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333132223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\remove_duplicate_migrations', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313130223B7D, '1', '1', '', '1542809720', '1542809720');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\style_update', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C676F6C64223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\update_custom_bbcodes_with_idn', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333132223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\update_hashes', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313130223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v311', 0x613A323A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C676F6C64223B693A313B733A34323A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7374796C655F757064617465223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v3110', 0x613A313A7B693A303B733A33383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313130726331223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v3110rc1', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333139223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v3111', 0x613A313A7B693A303B733A33383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313131726331223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v3111rc1', 0x613A383A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313130223B693A313B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C6164645F6C6F675F74696D655F696E646578223B693A323B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C696E6372656173655F73697A655F6F665F656D6F74696F6E223B693A333B733A36373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C6164645F6A61626265725F73736C5F636F6E746578745F636F6E6669675F6F7074696F6E73223B693A343B733A36353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C6164645F736D74705F73736C5F636F6E746578745F636F6E6669675F6F7074696F6E73223B693A353B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7570646174655F686173686573223B693A363B733A35373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C72656D6F76655F6475706C69636174655F6D6967726174696F6E73223B693A373B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C6164645F6C61746573745F746F706963735F696E646578223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v3112', 0x613A313A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313131223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v312', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333132726331223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v312rc1', 0x613A323A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333131223B693A313B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C6D5F736F667464656C6574655F676C6F62616C223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v313', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333133726332223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v313rc1', 0x613A353A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31335F726331223B693A313B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C706C75706C6F61645F6C6173745F67635F64796E616D6963223B693A323B733A37313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C70726F66696C656669656C645F72656D6F76655F756E64657273636F72655F66726F6D5F616C706861223B693A333B733A35393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C70726F66696C656669656C645F7961686F6F5F7570646174655F75726C223B693A343B733A36303A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7570646174655F637573746F6D5F6262636F6465735F776974685F69646E223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v313rc2', 0x613A323A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31335F706C31223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333133726331223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v314', 0x613A323A7B693A303B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F3134223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333134726332223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v314rc1', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333133223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v314rc2', 0x613A323A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763330785C72656C656173655F335F305F31345F726331223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333134726331223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v315', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333135726331223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v315rc1', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333134223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v316', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333136726331223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v316rc1', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333135223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v317', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333137726331223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v317pl1', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333137223B7D, '1', '1', '', '1542809721', '1542809721');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v317rc1', 0x613A323A7B693A303B733A34313A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C6D5F706D5F7265706F7274223B693A313B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333136223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v318', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333138726331223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v318rc1', 0x613A323A7B693A303B733A35373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C696E6372656173655F73697A655F6F665F64617465666F726D6174223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333137706C31223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v319', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333139726331223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v31x\\v319rc1', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333138223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\add_help_phpbb', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C76333230726331223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\allowed_schemes_links', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C646576223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\announce_global_permission', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C646576223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\cookie_notice', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C76333230726332223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\default_data_type_ids', 0x613A323A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C763332306132223B693A313B733A34323A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C6F617574685F737461746573223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\dev', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333136223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\font_awesome_update', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C646576223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\icons_alt', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C646576223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\log_post_id', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C646576223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\notifications_board', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C646576223B7D, '1', '1', '', '1542809722', '1542809722');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\oauth_states', 0x613A313A7B693A303B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C617574685F70726F76696465725F6F61757468223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\remote_upload_validation', 0x613A313A7B693A303B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C763332306132223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\remove_outdated_media', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C646576223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\remove_profilefield_wlm', 0x613A313A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C646576223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\report_id_auto_increment', 0x613A313A7B693A303B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C64656661756C745F646174615F747970655F696473223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\text_reparser', 0x613A323A7B693A303B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331305C636F6E746163745F61646D696E5F666F726D223B693A313B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C616C6C6F7765645F736368656D65735F6C696E6B73223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\v320', 0x613A323A7B693A303B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C696E6372656173655F73697A655F6F665F656D6F74696F6E223B693A313B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C636F6F6B69655F6E6F74696365223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\v320a1', 0x613A393A7B693A303B733A33333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C646576223B693A313B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C616C6C6F7765645F736368656D65735F6C696E6B73223B693A323B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C616E6E6F756E63655F676C6F62616C5F7065726D697373696F6E223B693A333B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C72656D6F76655F70726F66696C656669656C645F776C6D223B693A343B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C666F6E745F617765736F6D655F757064617465223B693A353B733A33393A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C69636F6E735F616C74223B693A363B733A34313A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C6C6F675F706F73745F6964223B693A373B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C72656D6F76655F6F757464617465645F6D65646961223B693A383B733A34393A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C6E6F74696669636174696F6E735F626F617264223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\v320a2', 0x613A333A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333137726331223B693A313B733A34333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C746578745F7265706172736572223B693A323B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C763332306131223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\v320b1', 0x613A343A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333137706C31223B693A313B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C763332306132223B693A323B733A35373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C696E6372656173655F73697A655F6F665F64617465666F726D6174223B693A333B733A35313A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C64656661756C745F646174615F747970655F696473223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\v320b2', 0x613A333A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333138223B693A313B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C763332306231223B693A323B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C72656D6F74655F75706C6F61645F76616C69646174696F6E223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\v320rc1', 0x613A333A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333139223B693A313B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C7265706F72745F69645F6175746F5F696E6372656D656E74223B693A323B733A33363A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C763332306232223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v320\\v320rc2', 0x613A333A7B693A303B733A35373A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C72656D6F76655F6475706C69636174655F6D6967726174696F6E73223B693A313B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C6164645F6C6F675F74696D655F696E646578223B693A323B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C6164645F68656C705F7068706262223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\cookie_notice_p2', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C76333230223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\email_force_sender', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333231223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\enable_accurate_pm_button', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333232223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\fix_user_styles', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C76333230223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\forum_topics_per_page_type', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333233223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\f_list_topics_permission_add', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333231223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\load_user_activity_limit', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C76333230223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\merge_duplicate_bbcodes', 0x613A303A7B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\remove_imagick', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333234726331223B7D, '1', '1', '', '1542809723', '1542809723');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\update_prosilver_bitfield', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333231223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\user_notifications_table_index_p1', 0x613A313A7B693A303B733A34363A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C636F6F6B69655F6E6F746963655F7032223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\user_notifications_table_index_p2', 0x613A313A7B693A303B733A36333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C757365725F6E6F74696669636174696F6E735F7461626C655F696E6465785F7031223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\user_notifications_table_index_p3', 0x613A313A7B693A303B733A36333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C757365725F6E6F74696669636174696F6E735F7461626C655F696E6465785F7032223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\user_notifications_table_reduce_column_sizes', 0x613A313A7B693A303B733A36333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C757365725F6E6F74696669636174696F6E735F7461626C655F696E6465785F7033223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\user_notifications_table_remove_duplicates', 0x613A313A7B693A303B733A36353A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C757365725F6E6F74696669636174696F6E735F7461626C655F74656D705F696E646578223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\user_notifications_table_temp_index', 0x613A313A7B693A303B733A37343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C757365725F6E6F74696669636174696F6E735F7461626C655F7265647563655F636F6C756D6E5F73697A6573223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\user_notifications_table_unique_index', 0x613A313A7B693A303B733A37323A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C757365725F6E6F74696669636174696F6E735F7461626C655F72656D6F76655F6475706C696361746573223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\v321', 0x613A323A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313131223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333231726331223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\v321rc1', 0x613A343A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332305C76333230223B693A313B733A33383A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313131726331223B693A323B733A35343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C6C6F61645F757365725F61637469766974795F6C696D6974223B693A333B733A36373A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C757365725F6E6F74696669636174696F6E735F7461626C655F756E697175655F696E646578223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\v322', 0x613A323A7B693A303B733A33353A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C7633313132223B693A313B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333232726331223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\v322rc1', 0x613A363A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333231223B693A313B733A34353A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C6669785F757365725F7374796C6573223B693A323B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C7570646174655F70726F73696C7665725F6269746669656C64223B693A333B733A34383A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C656D61696C5F666F7263655F73656E646572223B693A343B733A35383A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C665F6C6973745F746F706963735F7065726D697373696F6E5F616464223B693A353B733A35333A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C6D657267655F6475706C69636174655F6262636F646573223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\v323', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333233726332223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\v323rc1', 0x613A323A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333232223B693A313B733A35353A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C656E61626C655F61636375726174655F706D5F627574746F6E223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\v323rc2', 0x613A313A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333233726331223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\v324', 0x613A323A7B693A303B733A33373A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333234726331223B693A313B733A34343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C72656D6F76655F696D616769636B223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\db\\migration\\data\\v32x\\v324rc1', 0x613A323A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C76333233223B693A313B733A35363A225C70687062625C64625C6D6967726174696F6E5C646174615C763332785C666F72756D5F746F706963735F7065725F706167655F74797065223B7D, '1', '1', '', '1542809724', '1542809724');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\viglink\\migrations\\viglink_data', 0x613A313A7B693A303B733A33343A225C70687062625C64625C6D6967726174696F6E5C646174615C763331785C76333132223B7D, '1', '1', '', '1542809736', '1542809736');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\viglink\\migrations\\viglink_data_v2', 0x613A313A7B693A303B733A33383A225C70687062625C7669676C696E6B5C6D6967726174696F6E735C7669676C696E6B5F64617461223B7D, '1', '1', '', '1542809736', '1542809736');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\viglink\\migrations\\viglink_ask_admin', 0x613A313A7B693A303B733A34313A225C70687062625C7669676C696E6B5C6D6967726174696F6E735C7669676C696E6B5F646174615F7632223B7D, '1', '1', '', '1542809736', '1542809736');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\viglink\\migrations\\viglink_ask_admin_wait', 0x613A313A7B693A303B733A34333A225C70687062625C7669676C696E6B5C6D6967726174696F6E735C7669676C696E6B5F61736B5F61646D696E223B7D, '1', '1', '', '1542809736', '1542809736');
INSERT INTO `phpbb_migrations` VALUES ('\\phpbb\\viglink\\migrations\\viglink_cron', 0x613A313A7B693A303B733A33383A225C70687062625C7669676C696E6B5C6D6967726174696F6E735C7669676C696E6B5F64617461223B7D, '1', '1', '', '0', '0');

-- ----------------------------
-- Table structure for phpbb_moderator_cache
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_moderator_cache`;
CREATE TABLE `phpbb_moderator_cache` (
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `group_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `display_on_index` tinyint(1) unsigned NOT NULL DEFAULT '1',
  KEY `disp_idx` (`display_on_index`),
  KEY `forum_id` (`forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_moderator_cache
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_modules
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_modules`;
CREATE TABLE `phpbb_modules` (
  `module_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `module_enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `module_display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `module_basename` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_class` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `left_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `right_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `module_langname` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_mode` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `module_auth` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`module_id`),
  KEY `left_right_id` (`left_id`,`right_id`),
  KEY `module_enabled` (`module_enabled`),
  KEY `class_left_id` (`module_class`,`left_id`)
) ENGINE=MyISAM AUTO_INCREMENT=208 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_modules
-- ----------------------------
INSERT INTO `phpbb_modules` VALUES ('1', '1', '1', '', 'acp', '0', '1', '68', 'ACP_CAT_GENERAL', '', '');
INSERT INTO `phpbb_modules` VALUES ('2', '1', '1', '', 'acp', '1', '4', '17', 'ACP_QUICK_ACCESS', '', '');
INSERT INTO `phpbb_modules` VALUES ('3', '1', '1', '', 'acp', '1', '18', '45', 'ACP_BOARD_CONFIGURATION', '', '');
INSERT INTO `phpbb_modules` VALUES ('4', '1', '1', '', 'acp', '1', '46', '53', 'ACP_CLIENT_COMMUNICATION', '', '');
INSERT INTO `phpbb_modules` VALUES ('5', '1', '1', '', 'acp', '1', '54', '67', 'ACP_SERVER_CONFIGURATION', '', '');
INSERT INTO `phpbb_modules` VALUES ('6', '1', '1', '', 'acp', '0', '69', '88', 'ACP_CAT_FORUMS', '', '');
INSERT INTO `phpbb_modules` VALUES ('7', '1', '1', '', 'acp', '6', '70', '75', 'ACP_MANAGE_FORUMS', '', '');
INSERT INTO `phpbb_modules` VALUES ('8', '1', '1', '', 'acp', '6', '76', '87', 'ACP_FORUM_BASED_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES ('9', '1', '1', '', 'acp', '0', '89', '116', 'ACP_CAT_POSTING', '', '');
INSERT INTO `phpbb_modules` VALUES ('10', '1', '1', '', 'acp', '9', '90', '103', 'ACP_MESSAGES', '', '');
INSERT INTO `phpbb_modules` VALUES ('11', '1', '1', '', 'acp', '9', '104', '115', 'ACP_ATTACHMENTS', '', '');
INSERT INTO `phpbb_modules` VALUES ('12', '1', '1', '', 'acp', '0', '117', '174', 'ACP_CAT_USERGROUP', '', '');
INSERT INTO `phpbb_modules` VALUES ('13', '1', '1', '', 'acp', '12', '118', '153', 'ACP_CAT_USERS', '', '');
INSERT INTO `phpbb_modules` VALUES ('14', '1', '1', '', 'acp', '12', '154', '163', 'ACP_GROUPS', '', '');
INSERT INTO `phpbb_modules` VALUES ('15', '1', '1', '', 'acp', '12', '164', '173', 'ACP_USER_SECURITY', '', '');
INSERT INTO `phpbb_modules` VALUES ('16', '1', '1', '', 'acp', '0', '175', '224', 'ACP_CAT_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES ('17', '1', '1', '', 'acp', '16', '178', '187', 'ACP_GLOBAL_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES ('18', '1', '1', '', 'acp', '16', '188', '199', 'ACP_FORUM_BASED_PERMISSIONS', '', '');
INSERT INTO `phpbb_modules` VALUES ('19', '1', '1', '', 'acp', '16', '200', '209', 'ACP_PERMISSION_ROLES', '', '');
INSERT INTO `phpbb_modules` VALUES ('20', '1', '1', '', 'acp', '16', '210', '223', 'ACP_PERMISSION_MASKS', '', '');
INSERT INTO `phpbb_modules` VALUES ('21', '1', '1', '', 'acp', '0', '225', '240', 'ACP_CAT_CUSTOMISE', '', '');
INSERT INTO `phpbb_modules` VALUES ('22', '1', '1', '', 'acp', '21', '230', '235', 'ACP_STYLE_MANAGEMENT', '', '');
INSERT INTO `phpbb_modules` VALUES ('23', '1', '1', '', 'acp', '21', '226', '229', 'ACP_EXTENSION_MANAGEMENT', '', '');
INSERT INTO `phpbb_modules` VALUES ('24', '1', '1', '', 'acp', '21', '236', '239', 'ACP_LANGUAGE', '', '');
INSERT INTO `phpbb_modules` VALUES ('25', '1', '1', '', 'acp', '0', '241', '260', 'ACP_CAT_MAINTENANCE', '', '');
INSERT INTO `phpbb_modules` VALUES ('26', '1', '1', '', 'acp', '25', '242', '251', 'ACP_FORUM_LOGS', '', '');
INSERT INTO `phpbb_modules` VALUES ('27', '1', '1', '', 'acp', '25', '252', '259', 'ACP_CAT_DATABASE', '', '');
INSERT INTO `phpbb_modules` VALUES ('28', '1', '1', '', 'acp', '0', '261', '284', 'ACP_CAT_SYSTEM', '', '');
INSERT INTO `phpbb_modules` VALUES ('29', '1', '1', '', 'acp', '28', '262', '265', 'ACP_AUTOMATION', '', '');
INSERT INTO `phpbb_modules` VALUES ('30', '1', '1', '', 'acp', '28', '266', '275', 'ACP_GENERAL_TASKS', '', '');
INSERT INTO `phpbb_modules` VALUES ('31', '1', '1', '', 'acp', '28', '276', '283', 'ACP_MODULE_MANAGEMENT', '', '');
INSERT INTO `phpbb_modules` VALUES ('32', '1', '1', '', 'acp', '0', '285', '286', 'ACP_CAT_DOT_MODS', '', '');
INSERT INTO `phpbb_modules` VALUES ('33', '1', '1', 'acp_attachments', 'acp', '3', '19', '20', 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('34', '1', '1', 'acp_attachments', 'acp', '11', '105', '106', 'ACP_ATTACHMENT_SETTINGS', 'attach', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('35', '1', '1', 'acp_attachments', 'acp', '11', '107', '108', 'ACP_MANAGE_EXTENSIONS', 'extensions', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('36', '1', '1', 'acp_attachments', 'acp', '11', '109', '110', 'ACP_EXTENSION_GROUPS', 'ext_groups', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('37', '1', '1', 'acp_attachments', 'acp', '11', '111', '112', 'ACP_ORPHAN_ATTACHMENTS', 'orphan', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('38', '1', '1', 'acp_attachments', 'acp', '11', '113', '114', 'ACP_MANAGE_ATTACHMENTS', 'manage', 'acl_a_attach');
INSERT INTO `phpbb_modules` VALUES ('39', '1', '1', 'acp_ban', 'acp', '15', '165', '166', 'ACP_BAN_EMAILS', 'email', 'acl_a_ban');
INSERT INTO `phpbb_modules` VALUES ('40', '1', '1', 'acp_ban', 'acp', '15', '167', '168', 'ACP_BAN_IPS', 'ip', 'acl_a_ban');
INSERT INTO `phpbb_modules` VALUES ('41', '1', '1', 'acp_ban', 'acp', '15', '169', '170', 'ACP_BAN_USERNAMES', 'user', 'acl_a_ban');
INSERT INTO `phpbb_modules` VALUES ('42', '1', '1', 'acp_bbcodes', 'acp', '10', '91', '92', 'ACP_BBCODES', 'bbcodes', 'acl_a_bbcode');
INSERT INTO `phpbb_modules` VALUES ('43', '1', '1', 'acp_board', 'acp', '3', '21', '22', 'ACP_BOARD_SETTINGS', 'settings', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('44', '1', '1', 'acp_board', 'acp', '3', '23', '24', 'ACP_BOARD_FEATURES', 'features', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('45', '1', '1', 'acp_board', 'acp', '3', '25', '26', 'ACP_AVATAR_SETTINGS', 'avatar', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('46', '1', '1', 'acp_board', 'acp', '3', '27', '28', 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('47', '1', '1', 'acp_board', 'acp', '10', '93', '94', 'ACP_MESSAGE_SETTINGS', 'message', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('48', '1', '1', 'acp_board', 'acp', '3', '29', '30', 'ACP_POST_SETTINGS', 'post', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('49', '1', '1', 'acp_board', 'acp', '10', '95', '96', 'ACP_POST_SETTINGS', 'post', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('50', '1', '1', 'acp_board', 'acp', '3', '31', '32', 'ACP_SIGNATURE_SETTINGS', 'signature', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('51', '1', '1', 'acp_board', 'acp', '3', '33', '34', 'ACP_FEED_SETTINGS', 'feed', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('52', '1', '1', 'acp_board', 'acp', '3', '35', '36', 'ACP_REGISTER_SETTINGS', 'registration', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('53', '1', '1', 'acp_board', 'acp', '4', '47', '48', 'ACP_AUTH_SETTINGS', 'auth', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('54', '1', '1', 'acp_board', 'acp', '4', '49', '50', 'ACP_EMAIL_SETTINGS', 'email', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('55', '1', '1', 'acp_board', 'acp', '5', '55', '56', 'ACP_COOKIE_SETTINGS', 'cookie', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('56', '1', '1', 'acp_board', 'acp', '5', '57', '58', 'ACP_SERVER_SETTINGS', 'server', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('57', '1', '1', 'acp_board', 'acp', '5', '59', '60', 'ACP_SECURITY_SETTINGS', 'security', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('58', '1', '1', 'acp_board', 'acp', '5', '61', '62', 'ACP_LOAD_SETTINGS', 'load', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('59', '1', '1', 'acp_bots', 'acp', '30', '267', '268', 'ACP_BOTS', 'bots', 'acl_a_bots');
INSERT INTO `phpbb_modules` VALUES ('60', '1', '1', 'acp_captcha', 'acp', '3', '37', '38', 'ACP_VC_SETTINGS', 'visual', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('61', '1', '0', 'acp_captcha', 'acp', '3', '39', '40', 'ACP_VC_CAPTCHA_DISPLAY', 'img', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('62', '1', '1', 'acp_contact', 'acp', '3', '41', '42', 'ACP_CONTACT_SETTINGS', 'contact', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('63', '1', '1', 'acp_database', 'acp', '27', '253', '254', 'ACP_BACKUP', 'backup', 'acl_a_backup');
INSERT INTO `phpbb_modules` VALUES ('64', '1', '1', 'acp_database', 'acp', '27', '255', '256', 'ACP_RESTORE', 'restore', 'acl_a_backup');
INSERT INTO `phpbb_modules` VALUES ('65', '1', '1', 'acp_disallow', 'acp', '15', '171', '172', 'ACP_DISALLOW_USERNAMES', 'usernames', 'acl_a_names');
INSERT INTO `phpbb_modules` VALUES ('66', '1', '1', 'acp_email', 'acp', '30', '269', '270', 'ACP_MASS_EMAIL', 'email', 'acl_a_email && cfg_email_enable');
INSERT INTO `phpbb_modules` VALUES ('67', '1', '1', 'acp_extensions', 'acp', '23', '227', '228', 'ACP_EXTENSIONS', 'main', 'acl_a_extensions');
INSERT INTO `phpbb_modules` VALUES ('68', '1', '1', 'acp_forums', 'acp', '7', '71', '72', 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum');
INSERT INTO `phpbb_modules` VALUES ('69', '1', '1', 'acp_groups', 'acp', '14', '155', '156', 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group');
INSERT INTO `phpbb_modules` VALUES ('70', '1', '1', 'acp_groups', 'acp', '14', '157', '158', 'ACP_GROUPS_POSITION', 'position', 'acl_a_group');
INSERT INTO `phpbb_modules` VALUES ('71', '1', '1', 'acp_help_phpbb', 'acp', '5', '63', '64', 'ACP_HELP_PHPBB', 'help_phpbb', 'acl_a_server');
INSERT INTO `phpbb_modules` VALUES ('72', '1', '1', 'acp_icons', 'acp', '10', '97', '98', 'ACP_ICONS', 'icons', 'acl_a_icons');
INSERT INTO `phpbb_modules` VALUES ('73', '1', '1', 'acp_icons', 'acp', '10', '99', '100', 'ACP_SMILIES', 'smilies', 'acl_a_icons');
INSERT INTO `phpbb_modules` VALUES ('74', '1', '1', 'acp_inactive', 'acp', '13', '119', '120', 'ACP_INACTIVE_USERS', 'list', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('75', '1', '1', 'acp_jabber', 'acp', '4', '51', '52', 'ACP_JABBER_SETTINGS', 'settings', 'acl_a_jabber');
INSERT INTO `phpbb_modules` VALUES ('76', '1', '1', 'acp_language', 'acp', '24', '237', '238', 'ACP_LANGUAGE_PACKS', 'lang_packs', 'acl_a_language');
INSERT INTO `phpbb_modules` VALUES ('77', '1', '1', 'acp_logs', 'acp', '26', '243', '244', 'ACP_ADMIN_LOGS', 'admin', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES ('78', '1', '1', 'acp_logs', 'acp', '26', '245', '246', 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES ('79', '1', '1', 'acp_logs', 'acp', '26', '247', '248', 'ACP_USERS_LOGS', 'users', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES ('80', '1', '1', 'acp_logs', 'acp', '26', '249', '250', 'ACP_CRITICAL_LOGS', 'critical', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES ('81', '1', '1', 'acp_main', 'acp', '1', '2', '3', 'ACP_INDEX', 'main', '');
INSERT INTO `phpbb_modules` VALUES ('82', '1', '1', 'acp_modules', 'acp', '31', '277', '278', 'ACP', 'acp', 'acl_a_modules');
INSERT INTO `phpbb_modules` VALUES ('83', '1', '1', 'acp_modules', 'acp', '31', '279', '280', 'UCP', 'ucp', 'acl_a_modules');
INSERT INTO `phpbb_modules` VALUES ('84', '1', '1', 'acp_modules', 'acp', '31', '281', '282', 'MCP', 'mcp', 'acl_a_modules');
INSERT INTO `phpbb_modules` VALUES ('85', '1', '1', 'acp_permission_roles', 'acp', '19', '201', '202', 'ACP_ADMIN_ROLES', 'admin_roles', 'acl_a_roles && acl_a_aauth');
INSERT INTO `phpbb_modules` VALUES ('86', '1', '1', 'acp_permission_roles', 'acp', '19', '203', '204', 'ACP_USER_ROLES', 'user_roles', 'acl_a_roles && acl_a_uauth');
INSERT INTO `phpbb_modules` VALUES ('87', '1', '1', 'acp_permission_roles', 'acp', '19', '205', '206', 'ACP_MOD_ROLES', 'mod_roles', 'acl_a_roles && acl_a_mauth');
INSERT INTO `phpbb_modules` VALUES ('88', '1', '1', 'acp_permission_roles', 'acp', '19', '207', '208', 'ACP_FORUM_ROLES', 'forum_roles', 'acl_a_roles && acl_a_fauth');
INSERT INTO `phpbb_modules` VALUES ('89', '1', '1', 'acp_permissions', 'acp', '16', '176', '177', 'ACP_PERMISSIONS', 'intro', 'acl_a_authusers || acl_a_authgroups || acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('90', '1', '0', 'acp_permissions', 'acp', '20', '211', '212', 'ACP_PERMISSION_TRACE', 'trace', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('91', '1', '1', 'acp_permissions', 'acp', '18', '189', '190', 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('92', '1', '1', 'acp_permissions', 'acp', '18', '191', '192', 'ACP_FORUM_PERMISSIONS_COPY', 'setting_forum_copy', 'acl_a_fauth && acl_a_authusers && acl_a_authgroups && acl_a_mauth');
INSERT INTO `phpbb_modules` VALUES ('93', '1', '1', 'acp_permissions', 'acp', '18', '193', '194', 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('94', '1', '1', 'acp_permissions', 'acp', '17', '179', '180', 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES ('95', '1', '1', 'acp_permissions', 'acp', '13', '123', '124', 'ACP_USERS_PERMISSIONS', 'setting_user_global', 'acl_a_authusers && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES ('96', '1', '1', 'acp_permissions', 'acp', '18', '195', '196', 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('97', '1', '1', 'acp_permissions', 'acp', '13', '125', '126', 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('98', '1', '1', 'acp_permissions', 'acp', '17', '181', '182', 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES ('99', '1', '1', 'acp_permissions', 'acp', '14', '159', '160', 'ACP_GROUPS_PERMISSIONS', 'setting_group_global', 'acl_a_authgroups && (acl_a_aauth || acl_a_mauth || acl_a_uauth)');
INSERT INTO `phpbb_modules` VALUES ('100', '1', '1', 'acp_permissions', 'acp', '18', '197', '198', 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('101', '1', '1', 'acp_permissions', 'acp', '14', '161', '162', 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('102', '1', '1', 'acp_permissions', 'acp', '17', '183', '184', 'ACP_ADMINISTRATORS', 'setting_admin_global', 'acl_a_aauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('103', '1', '1', 'acp_permissions', 'acp', '17', '185', '186', 'ACP_GLOBAL_MODERATORS', 'setting_mod_global', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('104', '1', '1', 'acp_permissions', 'acp', '20', '213', '214', 'ACP_VIEW_ADMIN_PERMISSIONS', 'view_admin_global', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('105', '1', '1', 'acp_permissions', 'acp', '20', '215', '216', 'ACP_VIEW_USER_PERMISSIONS', 'view_user_global', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('106', '1', '1', 'acp_permissions', 'acp', '20', '217', '218', 'ACP_VIEW_GLOBAL_MOD_PERMISSIONS', 'view_mod_global', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('107', '1', '1', 'acp_permissions', 'acp', '20', '219', '220', 'ACP_VIEW_FORUM_MOD_PERMISSIONS', 'view_mod_local', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('108', '1', '1', 'acp_permissions', 'acp', '20', '221', '222', 'ACP_VIEW_FORUM_PERMISSIONS', 'view_forum_local', 'acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('109', '1', '1', 'acp_php_info', 'acp', '30', '271', '272', 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo');
INSERT INTO `phpbb_modules` VALUES ('110', '1', '1', 'acp_profile', 'acp', '13', '127', '128', 'ACP_CUSTOM_PROFILE_FIELDS', 'profile', 'acl_a_profile');
INSERT INTO `phpbb_modules` VALUES ('111', '1', '1', 'acp_prune', 'acp', '7', '73', '74', 'ACP_PRUNE_FORUMS', 'forums', 'acl_a_prune');
INSERT INTO `phpbb_modules` VALUES ('112', '1', '1', 'acp_prune', 'acp', '13', '129', '130', 'ACP_PRUNE_USERS', 'users', 'acl_a_userdel');
INSERT INTO `phpbb_modules` VALUES ('113', '1', '1', 'acp_ranks', 'acp', '13', '131', '132', 'ACP_MANAGE_RANKS', 'ranks', 'acl_a_ranks');
INSERT INTO `phpbb_modules` VALUES ('114', '1', '1', 'acp_reasons', 'acp', '30', '273', '274', 'ACP_MANAGE_REASONS', 'main', 'acl_a_reasons');
INSERT INTO `phpbb_modules` VALUES ('115', '1', '1', 'acp_search', 'acp', '5', '65', '66', 'ACP_SEARCH_SETTINGS', 'settings', 'acl_a_search');
INSERT INTO `phpbb_modules` VALUES ('116', '1', '1', 'acp_search', 'acp', '27', '257', '258', 'ACP_SEARCH_INDEX', 'index', 'acl_a_search');
INSERT INTO `phpbb_modules` VALUES ('117', '1', '1', 'acp_styles', 'acp', '22', '231', '232', 'ACP_STYLES', 'style', 'acl_a_styles');
INSERT INTO `phpbb_modules` VALUES ('118', '1', '1', 'acp_styles', 'acp', '22', '233', '234', 'ACP_STYLES_INSTALL', 'install', 'acl_a_styles');
INSERT INTO `phpbb_modules` VALUES ('119', '1', '1', 'acp_update', 'acp', '29', '263', '264', 'ACP_VERSION_CHECK', 'version_check', 'acl_a_board');
INSERT INTO `phpbb_modules` VALUES ('120', '1', '1', 'acp_users', 'acp', '13', '121', '122', 'ACP_MANAGE_USERS', 'overview', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('121', '1', '0', 'acp_users', 'acp', '13', '133', '134', 'ACP_USER_FEEDBACK', 'feedback', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('122', '1', '0', 'acp_users', 'acp', '13', '135', '136', 'ACP_USER_WARNINGS', 'warnings', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('123', '1', '0', 'acp_users', 'acp', '13', '137', '138', 'ACP_USER_PROFILE', 'profile', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('124', '1', '0', 'acp_users', 'acp', '13', '139', '140', 'ACP_USER_PREFS', 'prefs', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('125', '1', '0', 'acp_users', 'acp', '13', '141', '142', 'ACP_USER_AVATAR', 'avatar', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('126', '1', '0', 'acp_users', 'acp', '13', '143', '144', 'ACP_USER_RANK', 'rank', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('127', '1', '0', 'acp_users', 'acp', '13', '145', '146', 'ACP_USER_SIG', 'sig', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('128', '1', '0', 'acp_users', 'acp', '13', '147', '148', 'ACP_USER_GROUPS', 'groups', 'acl_a_user && acl_a_group');
INSERT INTO `phpbb_modules` VALUES ('129', '1', '0', 'acp_users', 'acp', '13', '149', '150', 'ACP_USER_PERM', 'perm', 'acl_a_user && acl_a_viewauth');
INSERT INTO `phpbb_modules` VALUES ('130', '1', '0', 'acp_users', 'acp', '13', '151', '152', 'ACP_USER_ATTACH', 'attach', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('131', '1', '1', 'acp_words', 'acp', '10', '101', '102', 'ACP_WORDS', 'words', 'acl_a_words');
INSERT INTO `phpbb_modules` VALUES ('132', '1', '1', 'acp_users', 'acp', '2', '5', '6', 'ACP_MANAGE_USERS', 'overview', 'acl_a_user');
INSERT INTO `phpbb_modules` VALUES ('133', '1', '1', 'acp_groups', 'acp', '2', '7', '8', 'ACP_GROUPS_MANAGE', 'manage', 'acl_a_group');
INSERT INTO `phpbb_modules` VALUES ('134', '1', '1', 'acp_forums', 'acp', '2', '9', '10', 'ACP_MANAGE_FORUMS', 'manage', 'acl_a_forum');
INSERT INTO `phpbb_modules` VALUES ('135', '1', '1', 'acp_logs', 'acp', '2', '11', '12', 'ACP_MOD_LOGS', 'mod', 'acl_a_viewlogs');
INSERT INTO `phpbb_modules` VALUES ('136', '1', '1', 'acp_bots', 'acp', '2', '13', '14', 'ACP_BOTS', 'bots', 'acl_a_bots');
INSERT INTO `phpbb_modules` VALUES ('137', '1', '1', 'acp_php_info', 'acp', '2', '15', '16', 'ACP_PHP_INFO', 'info', 'acl_a_phpinfo');
INSERT INTO `phpbb_modules` VALUES ('138', '1', '1', 'acp_permissions', 'acp', '8', '77', '78', 'ACP_FORUM_PERMISSIONS', 'setting_forum_local', 'acl_a_fauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('139', '1', '1', 'acp_permissions', 'acp', '8', '79', '80', 'ACP_FORUM_PERMISSIONS_COPY', 'setting_forum_copy', 'acl_a_fauth && acl_a_authusers && acl_a_authgroups && acl_a_mauth');
INSERT INTO `phpbb_modules` VALUES ('140', '1', '1', 'acp_permissions', 'acp', '8', '81', '82', 'ACP_FORUM_MODERATORS', 'setting_mod_local', 'acl_a_mauth && (acl_a_authusers || acl_a_authgroups)');
INSERT INTO `phpbb_modules` VALUES ('141', '1', '1', 'acp_permissions', 'acp', '8', '83', '84', 'ACP_USERS_FORUM_PERMISSIONS', 'setting_user_local', 'acl_a_authusers && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('142', '1', '1', 'acp_permissions', 'acp', '8', '85', '86', 'ACP_GROUPS_FORUM_PERMISSIONS', 'setting_group_local', 'acl_a_authgroups && (acl_a_mauth || acl_a_fauth)');
INSERT INTO `phpbb_modules` VALUES ('143', '1', '1', '', 'mcp', '0', '1', '10', 'MCP_MAIN', '', '');
INSERT INTO `phpbb_modules` VALUES ('144', '1', '1', '', 'mcp', '0', '11', '22', 'MCP_QUEUE', '', '');
INSERT INTO `phpbb_modules` VALUES ('145', '1', '1', '', 'mcp', '0', '23', '36', 'MCP_REPORTS', '', '');
INSERT INTO `phpbb_modules` VALUES ('146', '1', '1', '', 'mcp', '0', '37', '42', 'MCP_NOTES', '', '');
INSERT INTO `phpbb_modules` VALUES ('147', '1', '1', '', 'mcp', '0', '43', '52', 'MCP_WARN', '', '');
INSERT INTO `phpbb_modules` VALUES ('148', '1', '1', '', 'mcp', '0', '53', '60', 'MCP_LOGS', '', '');
INSERT INTO `phpbb_modules` VALUES ('149', '1', '1', '', 'mcp', '0', '61', '68', 'MCP_BAN', '', '');
INSERT INTO `phpbb_modules` VALUES ('150', '1', '1', 'mcp_ban', 'mcp', '149', '62', '63', 'MCP_BAN_USERNAMES', 'user', 'acl_m_ban');
INSERT INTO `phpbb_modules` VALUES ('151', '1', '1', 'mcp_ban', 'mcp', '149', '64', '65', 'MCP_BAN_IPS', 'ip', 'acl_m_ban');
INSERT INTO `phpbb_modules` VALUES ('152', '1', '1', 'mcp_ban', 'mcp', '149', '66', '67', 'MCP_BAN_EMAILS', 'email', 'acl_m_ban');
INSERT INTO `phpbb_modules` VALUES ('153', '1', '1', 'mcp_logs', 'mcp', '148', '54', '55', 'MCP_LOGS_FRONT', 'front', 'acl_m_ || aclf_m_');
INSERT INTO `phpbb_modules` VALUES ('154', '1', '1', 'mcp_logs', 'mcp', '148', '56', '57', 'MCP_LOGS_FORUM_VIEW', 'forum_logs', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES ('155', '1', '1', 'mcp_logs', 'mcp', '148', '58', '59', 'MCP_LOGS_TOPIC_VIEW', 'topic_logs', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES ('156', '1', '1', 'mcp_main', 'mcp', '143', '2', '3', 'MCP_MAIN_FRONT', 'front', '');
INSERT INTO `phpbb_modules` VALUES ('157', '1', '1', 'mcp_main', 'mcp', '143', '4', '5', 'MCP_MAIN_FORUM_VIEW', 'forum_view', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES ('158', '1', '1', 'mcp_main', 'mcp', '143', '6', '7', 'MCP_MAIN_TOPIC_VIEW', 'topic_view', 'acl_m_,$id');
INSERT INTO `phpbb_modules` VALUES ('159', '1', '1', 'mcp_main', 'mcp', '143', '8', '9', 'MCP_MAIN_POST_DETAILS', 'post_details', 'acl_m_,$id || (!$id && aclf_m_)');
INSERT INTO `phpbb_modules` VALUES ('160', '1', '1', 'mcp_notes', 'mcp', '146', '38', '39', 'MCP_NOTES_FRONT', 'front', '');
INSERT INTO `phpbb_modules` VALUES ('161', '1', '1', 'mcp_notes', 'mcp', '146', '40', '41', 'MCP_NOTES_USER', 'user_notes', '');
INSERT INTO `phpbb_modules` VALUES ('162', '1', '1', 'mcp_pm_reports', 'mcp', '145', '30', '31', 'MCP_PM_REPORTS_OPEN', 'pm_reports', 'acl_m_pm_report');
INSERT INTO `phpbb_modules` VALUES ('163', '1', '1', 'mcp_pm_reports', 'mcp', '145', '32', '33', 'MCP_PM_REPORTS_CLOSED', 'pm_reports_closed', 'acl_m_pm_report');
INSERT INTO `phpbb_modules` VALUES ('164', '1', '1', 'mcp_pm_reports', 'mcp', '145', '34', '35', 'MCP_PM_REPORT_DETAILS', 'pm_report_details', 'acl_m_pm_report');
INSERT INTO `phpbb_modules` VALUES ('165', '1', '1', 'mcp_queue', 'mcp', '144', '12', '13', 'MCP_QUEUE_UNAPPROVED_TOPICS', 'unapproved_topics', 'aclf_m_approve');
INSERT INTO `phpbb_modules` VALUES ('166', '1', '1', 'mcp_queue', 'mcp', '144', '14', '15', 'MCP_QUEUE_UNAPPROVED_POSTS', 'unapproved_posts', 'aclf_m_approve');
INSERT INTO `phpbb_modules` VALUES ('167', '1', '1', 'mcp_queue', 'mcp', '144', '16', '17', 'MCP_QUEUE_DELETED_TOPICS', 'deleted_topics', 'aclf_m_approve');
INSERT INTO `phpbb_modules` VALUES ('168', '1', '1', 'mcp_queue', 'mcp', '144', '18', '19', 'MCP_QUEUE_DELETED_POSTS', 'deleted_posts', 'aclf_m_approve');
INSERT INTO `phpbb_modules` VALUES ('169', '1', '1', 'mcp_queue', 'mcp', '144', '20', '21', 'MCP_QUEUE_APPROVE_DETAILS', 'approve_details', 'acl_m_approve,$id || (!$id && aclf_m_approve)');
INSERT INTO `phpbb_modules` VALUES ('170', '1', '1', 'mcp_reports', 'mcp', '145', '24', '25', 'MCP_REPORTS_OPEN', 'reports', 'aclf_m_report');
INSERT INTO `phpbb_modules` VALUES ('171', '1', '1', 'mcp_reports', 'mcp', '145', '26', '27', 'MCP_REPORTS_CLOSED', 'reports_closed', 'aclf_m_report');
INSERT INTO `phpbb_modules` VALUES ('172', '1', '1', 'mcp_reports', 'mcp', '145', '28', '29', 'MCP_REPORT_DETAILS', 'report_details', 'acl_m_report,$id || (!$id && aclf_m_report)');
INSERT INTO `phpbb_modules` VALUES ('173', '1', '1', 'mcp_warn', 'mcp', '147', '44', '45', 'MCP_WARN_FRONT', 'front', 'aclf_m_warn');
INSERT INTO `phpbb_modules` VALUES ('174', '1', '1', 'mcp_warn', 'mcp', '147', '46', '47', 'MCP_WARN_LIST', 'list', 'aclf_m_warn');
INSERT INTO `phpbb_modules` VALUES ('175', '1', '1', 'mcp_warn', 'mcp', '147', '48', '49', 'MCP_WARN_USER', 'warn_user', 'aclf_m_warn');
INSERT INTO `phpbb_modules` VALUES ('176', '1', '1', 'mcp_warn', 'mcp', '147', '50', '51', 'MCP_WARN_POST', 'warn_post', 'acl_m_warn && acl_f_read,$id');
INSERT INTO `phpbb_modules` VALUES ('177', '1', '1', '', 'ucp', '0', '1', '14', 'UCP_MAIN', '', '');
INSERT INTO `phpbb_modules` VALUES ('178', '1', '1', '', 'ucp', '0', '15', '28', 'UCP_PROFILE', '', '');
INSERT INTO `phpbb_modules` VALUES ('179', '1', '1', '', 'ucp', '0', '29', '38', 'UCP_PREFS', '', '');
INSERT INTO `phpbb_modules` VALUES ('180', '1', '1', 'ucp_pm', 'ucp', '0', '39', '48', 'UCP_PM', '', '');
INSERT INTO `phpbb_modules` VALUES ('181', '1', '1', '', 'ucp', '0', '49', '54', 'UCP_USERGROUPS', '', '');
INSERT INTO `phpbb_modules` VALUES ('182', '1', '1', '', 'ucp', '0', '55', '60', 'UCP_ZEBRA', '', '');
INSERT INTO `phpbb_modules` VALUES ('183', '1', '1', 'ucp_attachments', 'ucp', '177', '10', '11', 'UCP_MAIN_ATTACHMENTS', 'attachments', 'acl_u_attach');
INSERT INTO `phpbb_modules` VALUES ('184', '1', '1', 'ucp_auth_link', 'ucp', '178', '26', '27', 'UCP_AUTH_LINK_MANAGE', 'auth_link', 'authmethod_oauth');
INSERT INTO `phpbb_modules` VALUES ('185', '1', '1', 'ucp_groups', 'ucp', '181', '50', '51', 'UCP_USERGROUPS_MEMBER', 'membership', '');
INSERT INTO `phpbb_modules` VALUES ('186', '1', '1', 'ucp_groups', 'ucp', '181', '52', '53', 'UCP_USERGROUPS_MANAGE', 'manage', '');
INSERT INTO `phpbb_modules` VALUES ('187', '1', '1', 'ucp_main', 'ucp', '177', '2', '3', 'UCP_MAIN_FRONT', 'front', '');
INSERT INTO `phpbb_modules` VALUES ('188', '1', '1', 'ucp_main', 'ucp', '177', '4', '5', 'UCP_MAIN_SUBSCRIBED', 'subscribed', '');
INSERT INTO `phpbb_modules` VALUES ('189', '1', '1', 'ucp_main', 'ucp', '177', '6', '7', 'UCP_MAIN_BOOKMARKS', 'bookmarks', 'cfg_allow_bookmarks');
INSERT INTO `phpbb_modules` VALUES ('190', '1', '1', 'ucp_main', 'ucp', '177', '8', '9', 'UCP_MAIN_DRAFTS', 'drafts', '');
INSERT INTO `phpbb_modules` VALUES ('191', '1', '1', 'ucp_notifications', 'ucp', '179', '36', '37', 'UCP_NOTIFICATION_OPTIONS', 'notification_options', '');
INSERT INTO `phpbb_modules` VALUES ('192', '1', '1', 'ucp_notifications', 'ucp', '177', '12', '13', 'UCP_NOTIFICATION_LIST', 'notification_list', 'cfg_allow_board_notifications');
INSERT INTO `phpbb_modules` VALUES ('193', '1', '0', 'ucp_pm', 'ucp', '180', '40', '41', 'UCP_PM_VIEW', 'view', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES ('194', '1', '1', 'ucp_pm', 'ucp', '180', '42', '43', 'UCP_PM_COMPOSE', 'compose', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES ('195', '1', '1', 'ucp_pm', 'ucp', '180', '44', '45', 'UCP_PM_DRAFTS', 'drafts', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES ('196', '1', '1', 'ucp_pm', 'ucp', '180', '46', '47', 'UCP_PM_OPTIONS', 'options', 'cfg_allow_privmsg');
INSERT INTO `phpbb_modules` VALUES ('197', '1', '1', 'ucp_prefs', 'ucp', '179', '30', '31', 'UCP_PREFS_PERSONAL', 'personal', '');
INSERT INTO `phpbb_modules` VALUES ('198', '1', '1', 'ucp_prefs', 'ucp', '179', '32', '33', 'UCP_PREFS_POST', 'post', '');
INSERT INTO `phpbb_modules` VALUES ('199', '1', '1', 'ucp_prefs', 'ucp', '179', '34', '35', 'UCP_PREFS_VIEW', 'view', '');
INSERT INTO `phpbb_modules` VALUES ('200', '1', '1', 'ucp_profile', 'ucp', '178', '16', '17', 'UCP_PROFILE_PROFILE_INFO', 'profile_info', 'acl_u_chgprofileinfo');
INSERT INTO `phpbb_modules` VALUES ('201', '1', '1', 'ucp_profile', 'ucp', '178', '18', '19', 'UCP_PROFILE_SIGNATURE', 'signature', 'acl_u_sig');
INSERT INTO `phpbb_modules` VALUES ('202', '1', '1', 'ucp_profile', 'ucp', '178', '20', '21', 'UCP_PROFILE_AVATAR', 'avatar', 'cfg_allow_avatar');
INSERT INTO `phpbb_modules` VALUES ('203', '1', '1', 'ucp_profile', 'ucp', '178', '22', '23', 'UCP_PROFILE_REG_DETAILS', 'reg_details', '');
INSERT INTO `phpbb_modules` VALUES ('204', '1', '1', 'ucp_profile', 'ucp', '178', '24', '25', 'UCP_PROFILE_AUTOLOGIN_KEYS', 'autologin_keys', '');
INSERT INTO `phpbb_modules` VALUES ('205', '1', '1', 'ucp_zebra', 'ucp', '182', '56', '57', 'UCP_ZEBRA_FRIENDS', 'friends', '');
INSERT INTO `phpbb_modules` VALUES ('206', '1', '1', 'ucp_zebra', 'ucp', '182', '58', '59', 'UCP_ZEBRA_FOES', 'foes', '');
INSERT INTO `phpbb_modules` VALUES ('207', '1', '1', '\\phpbb\\viglink\\acp\\viglink_module', 'acp', '3', '43', '44', 'ACP_VIGLINK_SETTINGS', 'settings', 'ext_phpbb/viglink && acl_a_board');

-- ----------------------------
-- Table structure for phpbb_notifications
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_notifications`;
CREATE TABLE `phpbb_notifications` (
  `notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `notification_type_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `item_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `item_parent_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `notification_read` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `notification_time` int(11) unsigned NOT NULL DEFAULT '1',
  `notification_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`notification_id`),
  KEY `item_ident` (`notification_type_id`,`item_id`),
  KEY `user` (`user_id`,`notification_read`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_notifications
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_notification_types
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_notification_types`;
CREATE TABLE `phpbb_notification_types` (
  `notification_type_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `notification_type_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `notification_type_enabled` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`notification_type_id`),
  UNIQUE KEY `type` (`notification_type_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_notification_types
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_oauth_accounts
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_oauth_accounts`;
CREATE TABLE `phpbb_oauth_accounts` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `provider` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `oauth_provider_id` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`user_id`,`provider`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_oauth_accounts
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_oauth_states
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_oauth_states`;
CREATE TABLE `phpbb_oauth_states` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `provider` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `oauth_state` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  KEY `user_id` (`user_id`),
  KEY `provider` (`provider`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_oauth_states
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_oauth_tokens
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_oauth_tokens`;
CREATE TABLE `phpbb_oauth_tokens` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `provider` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `oauth_token` mediumtext COLLATE utf8_bin NOT NULL,
  KEY `user_id` (`user_id`),
  KEY `provider` (`provider`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_oauth_tokens
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_poll_options
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_poll_options`;
CREATE TABLE `phpbb_poll_options` (
  `poll_option_id` tinyint(4) NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `poll_option_text` text COLLATE utf8_bin NOT NULL,
  `poll_option_total` mediumint(8) unsigned NOT NULL DEFAULT '0',
  KEY `poll_opt_id` (`poll_option_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_poll_options
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_poll_votes
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_poll_votes`;
CREATE TABLE `phpbb_poll_votes` (
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `poll_option_id` tinyint(4) NOT NULL DEFAULT '0',
  `vote_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `vote_user_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  KEY `topic_id` (`topic_id`),
  KEY `vote_user_id` (`vote_user_id`),
  KEY `vote_user_ip` (`vote_user_ip`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_poll_votes
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_posts
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_posts`;
CREATE TABLE `phpbb_posts` (
  `post_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_id` int(10) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poster_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `post_text` mediumtext COLLATE utf8_bin NOT NULL,
  `post_checksum` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_postcount` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `post_edit_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_edit_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_edit_user` int(10) unsigned NOT NULL DEFAULT '0',
  `post_edit_count` smallint(4) unsigned NOT NULL DEFAULT '0',
  `post_edit_locked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `post_visibility` tinyint(3) NOT NULL DEFAULT '0',
  `post_delete_time` int(11) unsigned NOT NULL DEFAULT '0',
  `post_delete_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `post_delete_user` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`post_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`),
  KEY `poster_ip` (`poster_ip`),
  KEY `poster_id` (`poster_id`),
  KEY `tid_post_time` (`topic_id`,`post_time`),
  KEY `post_username` (`post_username`),
  KEY `post_visibility` (`post_visibility`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_posts
-- ----------------------------
INSERT INTO `phpbb_posts` VALUES ('1', '1', '2', '2', '0', '::1', '1542809695', '0', '1', '1', '1', '1', '', 'Welcome to phpBB3', 0x5468697320697320616E206578616D706C6520706F737420696E20796F75722070687042423320696E7374616C6C6174696F6E2E2045766572797468696E67207365656D7320746F20626520776F726B696E672E20596F75206D61792064656C657465207468697320706F737420696620796F75206C696B6520616E6420636F6E74696E756520746F2073657420757020796F757220626F6172642E20447572696E672074686520696E7374616C6C6174696F6E2070726F6365737320796F75722066697273742063617465676F727920616E6420796F757220666972737420666F72756D206172652061737369676E656420616E20617070726F70726961746520736574206F66207065726D697373696F6E7320666F722074686520707265646566696E6564207573657267726F7570732061646D696E6973747261746F72732C20626F74732C20676C6F62616C206D6F64657261746F72732C206775657374732C207265676973746572656420757365727320616E64207265676973746572656420434F5050412075736572732E20496620796F7520616C736F2063686F6F736520746F2064656C65746520796F75722066697273742063617465676F727920616E6420796F757220666972737420666F72756D2C20646F206E6F7420666F7267657420746F2061737369676E207065726D697373696F6E7320666F7220616C6C207468657365207573657267726F75707320666F7220616C6C206E65772063617465676F7269657320616E6420666F72756D7320796F75206372656174652E204974206973207265636F6D6D656E64656420746F2072656E616D6520796F75722066697273742063617465676F727920616E6420796F757220666972737420666F72756D20616E6420636F7079207065726D697373696F6E732066726F6D207468657365207768696C65206372656174696E67206E65772063617465676F7269657320616E6420666F72756D732E20486176652066756E21, '5dd683b17f641daf84c040bfefc58ce9', '0', '', '', '1', '0', '', '0', '0', '0', '1', '0', '', '0');

-- ----------------------------
-- Table structure for phpbb_privmsgs
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_privmsgs`;
CREATE TABLE `phpbb_privmsgs` (
  `msg_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `root_level` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `author_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `message_time` int(11) unsigned NOT NULL DEFAULT '0',
  `enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `enable_sig` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `message_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `message_text` mediumtext COLLATE utf8_bin NOT NULL,
  `message_edit_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `message_edit_user` int(10) unsigned NOT NULL DEFAULT '0',
  `message_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `message_edit_time` int(11) unsigned NOT NULL DEFAULT '0',
  `message_edit_count` smallint(4) unsigned NOT NULL DEFAULT '0',
  `to_address` text COLLATE utf8_bin NOT NULL,
  `bcc_address` text COLLATE utf8_bin NOT NULL,
  `message_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`msg_id`),
  KEY `author_ip` (`author_ip`),
  KEY `message_time` (`message_time`),
  KEY `author_id` (`author_id`),
  KEY `root_level` (`root_level`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_privmsgs
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_privmsgs_folder
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_privmsgs_folder`;
CREATE TABLE `phpbb_privmsgs_folder` (
  `folder_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pm_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`folder_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_privmsgs_folder
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_privmsgs_rules
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_privmsgs_rules`;
CREATE TABLE `phpbb_privmsgs_rules` (
  `rule_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `rule_check` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_connection` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_string` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `rule_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `rule_group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_action` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rule_folder_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rule_id`),
  KEY `user_id` (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_privmsgs_rules
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_privmsgs_to
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_privmsgs_to`;
CREATE TABLE `phpbb_privmsgs_to` (
  `msg_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `pm_deleted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pm_new` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `pm_unread` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `pm_replied` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pm_marked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pm_forwarded` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `folder_id` int(11) NOT NULL DEFAULT '0',
  KEY `msg_id` (`msg_id`),
  KEY `author_id` (`author_id`),
  KEY `usr_flder_id` (`user_id`,`folder_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_privmsgs_to
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_profile_fields
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_profile_fields`;
CREATE TABLE `phpbb_profile_fields` (
  `field_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `field_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_type` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_ident` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_length` varchar(20) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_minlen` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_maxlen` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_novalue` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_default_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_validation` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_required` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_show_on_reg` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_hide` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_no_view` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `field_show_profile` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_show_on_vt` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_show_novalue` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_show_on_pm` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_show_on_ml` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_is_contact` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `field_contact_desc` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `field_contact_url` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`field_id`),
  KEY `fld_type` (`field_type`),
  KEY `fld_ordr` (`field_order`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_profile_fields
-- ----------------------------
INSERT INTO `phpbb_profile_fields` VALUES ('1', 'phpbb_location', 'profilefields.type.string', 'phpbb_location', '20', '2', '100', '', '', '.*', '0', '0', '0', '0', '1', '1', '1', '1', '0', '1', '1', '0', '', '');
INSERT INTO `phpbb_profile_fields` VALUES ('2', 'phpbb_website', 'profilefields.type.url', 'phpbb_website', '40', '12', '255', '', '', '', '0', '0', '0', '0', '1', '2', '1', '1', '0', '1', '1', '1', 'VISIT_WEBSITE', '%s');
INSERT INTO `phpbb_profile_fields` VALUES ('3', 'phpbb_interests', 'profilefields.type.text', 'phpbb_interests', '3|30', '2', '500', '', '', '.*', '0', '0', '0', '0', '0', '3', '1', '0', '0', '0', '0', '0', '', '');
INSERT INTO `phpbb_profile_fields` VALUES ('4', 'phpbb_occupation', 'profilefields.type.text', 'phpbb_occupation', '3|30', '2', '500', '', '', '.*', '0', '0', '0', '0', '0', '4', '1', '0', '0', '0', '0', '0', '', '');
INSERT INTO `phpbb_profile_fields` VALUES ('5', 'phpbb_aol', 'profilefields.type.string', 'phpbb_aol', '40', '5', '255', '', '', '.*', '0', '0', '0', '0', '0', '5', '1', '1', '0', '1', '1', '1', '', '');
INSERT INTO `phpbb_profile_fields` VALUES ('6', 'phpbb_icq', 'profilefields.type.string', 'phpbb_icq', '20', '3', '15', '', '', '[0-9]+', '0', '0', '0', '0', '0', '6', '1', '1', '0', '1', '1', '1', 'SEND_ICQ_MESSAGE', 'https://www.icq.com/people/%s/');
INSERT INTO `phpbb_profile_fields` VALUES ('7', 'phpbb_yahoo', 'profilefields.type.string', 'phpbb_yahoo', '40', '5', '255', '', '', '.*', '0', '0', '0', '0', '0', '8', '1', '1', '0', '1', '1', '1', 'SEND_YIM_MESSAGE', 'ymsgr:sendim?%s');
INSERT INTO `phpbb_profile_fields` VALUES ('8', 'phpbb_facebook', 'profilefields.type.string', 'phpbb_facebook', '20', '5', '50', '', '', '[\\w.]+', '0', '0', '0', '0', '1', '9', '1', '1', '0', '1', '1', '1', 'VIEW_FACEBOOK_PROFILE', 'http://facebook.com/%s/');
INSERT INTO `phpbb_profile_fields` VALUES ('9', 'phpbb_twitter', 'profilefields.type.string', 'phpbb_twitter', '20', '1', '15', '', '', '[\\w_]+', '0', '0', '0', '0', '1', '10', '1', '1', '0', '1', '1', '1', 'VIEW_TWITTER_PROFILE', 'http://twitter.com/%s');
INSERT INTO `phpbb_profile_fields` VALUES ('10', 'phpbb_skype', 'profilefields.type.string', 'phpbb_skype', '20', '6', '32', '', '', '[a-zA-Z][\\w\\.,\\-_]+', '0', '0', '0', '0', '1', '11', '1', '1', '0', '1', '1', '1', 'VIEW_SKYPE_PROFILE', 'skype:%s?userinfo');
INSERT INTO `phpbb_profile_fields` VALUES ('11', 'phpbb_youtube', 'profilefields.type.string', 'phpbb_youtube', '20', '3', '60', '', '', '[a-zA-Z][\\w\\.,\\-_]+', '0', '0', '0', '0', '1', '12', '1', '1', '0', '1', '1', '1', 'VIEW_YOUTUBE_CHANNEL', 'http://youtube.com/user/%s');
INSERT INTO `phpbb_profile_fields` VALUES ('12', 'phpbb_googleplus', 'profilefields.type.googleplus', 'phpbb_googleplus', '20', '3', '255', '', '', '[\\w]+', '0', '0', '0', '0', '1', '13', '1', '1', '0', '1', '1', '1', 'VIEW_GOOGLEPLUS_PROFILE', 'http://plus.google.com/%s');

-- ----------------------------
-- Table structure for phpbb_profile_fields_data
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_profile_fields_data`;
CREATE TABLE `phpbb_profile_fields_data` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `pf_phpbb_interests` mediumtext COLLATE utf8_bin NOT NULL,
  `pf_phpbb_occupation` mediumtext COLLATE utf8_bin NOT NULL,
  `pf_phpbb_location` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_youtube` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_twitter` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_googleplus` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_skype` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_facebook` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_icq` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_website` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_yahoo` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `pf_phpbb_aol` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_profile_fields_data
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_profile_fields_lang
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_profile_fields_lang`;
CREATE TABLE `phpbb_profile_fields_lang` (
  `field_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `option_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `field_type` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`field_id`,`lang_id`,`option_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_profile_fields_lang
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_profile_lang
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_profile_lang`;
CREATE TABLE `phpbb_profile_lang` (
  `field_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `lang_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `lang_explain` text COLLATE utf8_bin NOT NULL,
  `lang_default_value` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`field_id`,`lang_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_profile_lang
-- ----------------------------
INSERT INTO `phpbb_profile_lang` VALUES ('1', '1', 'LOCATION', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('2', '1', 'WEBSITE', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('3', '1', 'INTERESTS', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('4', '1', 'OCCUPATION', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('5', '1', 'AOL', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('6', '1', 'ICQ', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('7', '1', 'YAHOO', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('8', '1', 'FACEBOOK', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('9', '1', 'TWITTER', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('10', '1', 'SKYPE', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('11', '1', 'YOUTUBE', '', '');
INSERT INTO `phpbb_profile_lang` VALUES ('12', '1', 'GOOGLEPLUS', '', '');

-- ----------------------------
-- Table structure for phpbb_ranks
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_ranks`;
CREATE TABLE `phpbb_ranks` (
  `rank_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `rank_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `rank_min` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `rank_special` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `rank_image` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`rank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_ranks
-- ----------------------------
INSERT INTO `phpbb_ranks` VALUES ('1', 'Site Admin', '0', '1', '');

-- ----------------------------
-- Table structure for phpbb_reports
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_reports`;
CREATE TABLE `phpbb_reports` (
  `report_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reason_id` smallint(4) unsigned NOT NULL DEFAULT '0',
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_notify` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `report_closed` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `report_time` int(11) unsigned NOT NULL DEFAULT '0',
  `report_text` mediumtext COLLATE utf8_bin NOT NULL,
  `pm_id` int(10) unsigned NOT NULL DEFAULT '0',
  `reported_post_enable_bbcode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `reported_post_enable_smilies` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `reported_post_enable_magic_url` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `reported_post_text` mediumtext COLLATE utf8_bin NOT NULL,
  `reported_post_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `reported_post_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`report_id`),
  KEY `post_id` (`post_id`),
  KEY `pm_id` (`pm_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_reports
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_reports_reasons
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_reports_reasons`;
CREATE TABLE `phpbb_reports_reasons` (
  `reason_id` smallint(4) unsigned NOT NULL AUTO_INCREMENT,
  `reason_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `reason_description` mediumtext COLLATE utf8_bin NOT NULL,
  `reason_order` smallint(4) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`reason_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_reports_reasons
-- ----------------------------
INSERT INTO `phpbb_reports_reasons` VALUES ('1', 'warez', 0x54686520706F737420636F6E7461696E73206C696E6B7320746F20696C6C6567616C206F72207069726174656420736F6674776172652E, '1');
INSERT INTO `phpbb_reports_reasons` VALUES ('2', 'spam', 0x546865207265706F7274656420706F73742068617320746865206F6E6C7920707572706F736520746F2061647665727469736520666F7220612077656273697465206F7220616E6F746865722070726F647563742E, '2');
INSERT INTO `phpbb_reports_reasons` VALUES ('3', 'off_topic', 0x546865207265706F7274656420706F7374206973206F666620746F7069632E, '3');
INSERT INTO `phpbb_reports_reasons` VALUES ('4', 'other', 0x546865207265706F7274656420706F737420646F6573206E6F742066697420696E746F20616E79206F746865722063617465676F72792C20706C656173652075736520746865206675727468657220696E666F726D6174696F6E206669656C642E, '4');

-- ----------------------------
-- Table structure for phpbb_search_results
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_search_results`;
CREATE TABLE `phpbb_search_results` (
  `search_key` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `search_time` int(11) unsigned NOT NULL DEFAULT '0',
  `search_keywords` mediumtext COLLATE utf8_bin NOT NULL,
  `search_authors` mediumtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`search_key`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_search_results
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_search_wordlist
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_search_wordlist`;
CREATE TABLE `phpbb_search_wordlist` (
  `word_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word_text` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `word_common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `word_count` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`word_id`),
  UNIQUE KEY `wrd_txt` (`word_text`),
  KEY `wrd_cnt` (`word_count`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_search_wordlist
-- ----------------------------
INSERT INTO `phpbb_search_wordlist` VALUES ('1', 'this', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('2', 'is', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('3', 'an', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('4', 'example', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('5', 'post', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('6', 'in', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('7', 'your', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('8', 'phpbb3', '0', '2');
INSERT INTO `phpbb_search_wordlist` VALUES ('9', 'installation', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('10', 'everything', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('11', 'seems', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('12', 'to', '0', '2');
INSERT INTO `phpbb_search_wordlist` VALUES ('13', 'be', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('14', 'working', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('15', 'you', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('16', 'may', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('17', 'delete', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('18', 'if', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('19', 'like', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('20', 'and', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('21', 'continue', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('22', 'set', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('23', 'up', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('24', 'board', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('25', 'during', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('26', 'the', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('27', 'process', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('28', 'first', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('29', 'category', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('30', 'forum', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('31', 'are', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('32', 'assigned', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('33', 'appropriate', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('34', 'of', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('35', 'permissions', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('36', 'for', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('37', 'predefined', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('38', 'usergroups', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('39', 'administrators', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('40', 'bots', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('41', 'global', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('42', 'moderators', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('43', 'guests', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('44', 'registered', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('45', 'users', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('46', 'coppa', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('47', 'also', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('48', 'choose', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('49', 'do', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('50', 'not', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('51', 'forget', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('52', 'assign', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('53', 'all', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('54', 'these', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('55', 'new', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('56', 'categories', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('57', 'forums', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('58', 'create', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('59', 'it', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('60', 'recommended', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('61', 'rename', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('62', 'copy', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('63', 'from', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('64', 'while', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('65', 'creating', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('66', 'have', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('67', 'fun', '0', '1');
INSERT INTO `phpbb_search_wordlist` VALUES ('68', 'welcome', '0', '1');

-- ----------------------------
-- Table structure for phpbb_search_wordmatch
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_search_wordmatch`;
CREATE TABLE `phpbb_search_wordmatch` (
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `word_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title_match` tinyint(1) unsigned NOT NULL DEFAULT '0',
  UNIQUE KEY `un_mtch` (`word_id`,`post_id`,`title_match`),
  KEY `word_id` (`word_id`),
  KEY `post_id` (`post_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_search_wordmatch
-- ----------------------------
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '1', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '2', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '3', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '4', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '5', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '6', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '7', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '8', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '8', '1');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '9', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '10', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '11', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '12', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '12', '1');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '13', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '14', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '15', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '16', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '17', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '18', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '19', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '20', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '21', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '22', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '23', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '24', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '25', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '26', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '27', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '28', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '29', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '30', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '31', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '32', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '33', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '34', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '35', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '36', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '37', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '38', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '39', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '40', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '41', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '42', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '43', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '44', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '45', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '46', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '47', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '48', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '49', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '50', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '51', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '52', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '53', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '54', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '55', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '56', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '57', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '58', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '59', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '60', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '61', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '62', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '63', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '64', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '65', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '66', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '67', '0');
INSERT INTO `phpbb_search_wordmatch` VALUES ('1', '68', '1');

-- ----------------------------
-- Table structure for phpbb_sessions
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_sessions`;
CREATE TABLE `phpbb_sessions` (
  `session_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `session_last_visit` int(11) unsigned NOT NULL DEFAULT '0',
  `session_start` int(11) unsigned NOT NULL DEFAULT '0',
  `session_time` int(11) unsigned NOT NULL DEFAULT '0',
  `session_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_browser` varchar(150) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_forwarded_for` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_page` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `session_viewonline` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `session_autologin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `session_admin` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `session_forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`session_id`),
  KEY `session_time` (`session_time`),
  KEY `session_user_id` (`session_user_id`),
  KEY `session_fid` (`session_forum_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_sessions
-- ----------------------------
INSERT INTO `phpbb_sessions` VALUES ('f8fc779100465f7361cf0d91e81c25c4', '2', '1542864180', '1542871830', '1542873609', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.102 Safari/537.36', '', 'adm/index.php?i=acp_styles&mode=style', '1', '0', '1', '0');

-- ----------------------------
-- Table structure for phpbb_sessions_keys
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_sessions_keys`;
CREATE TABLE `phpbb_sessions_keys` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `last_login` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`key_id`,`user_id`),
  KEY `last_login` (`last_login`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_sessions_keys
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_sitelist
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_sitelist`;
CREATE TABLE `phpbb_sitelist` (
  `site_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `site_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `site_hostname` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `ip_exclude` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`site_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_sitelist
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_smilies
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_smilies`;
CREATE TABLE `phpbb_smilies` (
  `smiley_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `emotion` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `smiley_url` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT '',
  `smiley_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `smiley_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `smiley_order` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `display_on_posting` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`smiley_id`),
  KEY `display_on_post` (`display_on_posting`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_smilies
-- ----------------------------
INSERT INTO `phpbb_smilies` VALUES ('1', ':D', 'Very Happy', 'icon_e_biggrin.gif', '15', '17', '1', '1');
INSERT INTO `phpbb_smilies` VALUES ('2', ':-D', 'Very Happy', 'icon_e_biggrin.gif', '15', '17', '2', '1');
INSERT INTO `phpbb_smilies` VALUES ('3', ':grin:', 'Very Happy', 'icon_e_biggrin.gif', '15', '17', '3', '1');
INSERT INTO `phpbb_smilies` VALUES ('4', ':)', 'Smile', 'icon_e_smile.gif', '15', '17', '4', '1');
INSERT INTO `phpbb_smilies` VALUES ('5', ':-)', 'Smile', 'icon_e_smile.gif', '15', '17', '5', '1');
INSERT INTO `phpbb_smilies` VALUES ('6', ':smile:', 'Smile', 'icon_e_smile.gif', '15', '17', '6', '1');
INSERT INTO `phpbb_smilies` VALUES ('7', ';)', 'Wink', 'icon_e_wink.gif', '15', '17', '7', '1');
INSERT INTO `phpbb_smilies` VALUES ('8', ';-)', 'Wink', 'icon_e_wink.gif', '15', '17', '8', '1');
INSERT INTO `phpbb_smilies` VALUES ('9', ':wink:', 'Wink', 'icon_e_wink.gif', '15', '17', '9', '1');
INSERT INTO `phpbb_smilies` VALUES ('10', ':(', 'Sad', 'icon_e_sad.gif', '15', '17', '10', '1');
INSERT INTO `phpbb_smilies` VALUES ('11', ':-(', 'Sad', 'icon_e_sad.gif', '15', '17', '11', '1');
INSERT INTO `phpbb_smilies` VALUES ('12', ':sad:', 'Sad', 'icon_e_sad.gif', '15', '17', '12', '1');
INSERT INTO `phpbb_smilies` VALUES ('13', ':o', 'Surprised', 'icon_e_surprised.gif', '15', '17', '13', '1');
INSERT INTO `phpbb_smilies` VALUES ('14', ':-o', 'Surprised', 'icon_e_surprised.gif', '15', '17', '14', '1');
INSERT INTO `phpbb_smilies` VALUES ('15', ':eek:', 'Surprised', 'icon_e_surprised.gif', '15', '17', '15', '1');
INSERT INTO `phpbb_smilies` VALUES ('16', ':shock:', 'Shocked', 'icon_eek.gif', '15', '17', '16', '1');
INSERT INTO `phpbb_smilies` VALUES ('17', ':?', 'Confused', 'icon_e_confused.gif', '15', '17', '17', '1');
INSERT INTO `phpbb_smilies` VALUES ('18', ':-?', 'Confused', 'icon_e_confused.gif', '15', '17', '18', '1');
INSERT INTO `phpbb_smilies` VALUES ('19', ':???:', 'Confused', 'icon_e_confused.gif', '15', '17', '19', '1');
INSERT INTO `phpbb_smilies` VALUES ('20', '8-)', 'Cool', 'icon_cool.gif', '15', '17', '20', '1');
INSERT INTO `phpbb_smilies` VALUES ('21', ':cool:', 'Cool', 'icon_cool.gif', '15', '17', '21', '1');
INSERT INTO `phpbb_smilies` VALUES ('22', ':lol:', 'Laughing', 'icon_lol.gif', '15', '17', '22', '1');
INSERT INTO `phpbb_smilies` VALUES ('23', ':x', 'Mad', 'icon_mad.gif', '15', '17', '23', '1');
INSERT INTO `phpbb_smilies` VALUES ('24', ':-x', 'Mad', 'icon_mad.gif', '15', '17', '24', '1');
INSERT INTO `phpbb_smilies` VALUES ('25', ':mad:', 'Mad', 'icon_mad.gif', '15', '17', '25', '1');
INSERT INTO `phpbb_smilies` VALUES ('26', ':P', 'Razz', 'icon_razz.gif', '15', '17', '26', '1');
INSERT INTO `phpbb_smilies` VALUES ('27', ':-P', 'Razz', 'icon_razz.gif', '15', '17', '27', '1');
INSERT INTO `phpbb_smilies` VALUES ('28', ':razz:', 'Razz', 'icon_razz.gif', '15', '17', '28', '1');
INSERT INTO `phpbb_smilies` VALUES ('29', ':oops:', 'Embarrassed', 'icon_redface.gif', '15', '17', '29', '1');
INSERT INTO `phpbb_smilies` VALUES ('30', ':cry:', 'Crying or Very Sad', 'icon_cry.gif', '15', '17', '30', '1');
INSERT INTO `phpbb_smilies` VALUES ('31', ':evil:', 'Evil or Very Mad', 'icon_evil.gif', '15', '17', '31', '1');
INSERT INTO `phpbb_smilies` VALUES ('32', ':twisted:', 'Twisted Evil', 'icon_twisted.gif', '15', '17', '32', '1');
INSERT INTO `phpbb_smilies` VALUES ('33', ':roll:', 'Rolling Eyes', 'icon_rolleyes.gif', '15', '17', '33', '1');
INSERT INTO `phpbb_smilies` VALUES ('34', ':!:', 'Exclamation', 'icon_exclaim.gif', '15', '17', '34', '1');
INSERT INTO `phpbb_smilies` VALUES ('35', ':?:', 'Question', 'icon_question.gif', '15', '17', '35', '1');
INSERT INTO `phpbb_smilies` VALUES ('36', ':idea:', 'Idea', 'icon_idea.gif', '15', '17', '36', '1');
INSERT INTO `phpbb_smilies` VALUES ('37', ':arrow:', 'Arrow', 'icon_arrow.gif', '15', '17', '37', '1');
INSERT INTO `phpbb_smilies` VALUES ('38', ':|', 'Neutral', 'icon_neutral.gif', '15', '17', '38', '1');
INSERT INTO `phpbb_smilies` VALUES ('39', ':-|', 'Neutral', 'icon_neutral.gif', '15', '17', '39', '1');
INSERT INTO `phpbb_smilies` VALUES ('40', ':mrgreen:', 'Mr. Green', 'icon_mrgreen.gif', '15', '17', '40', '1');
INSERT INTO `phpbb_smilies` VALUES ('41', ':geek:', 'Geek', 'icon_e_geek.gif', '17', '17', '41', '1');
INSERT INTO `phpbb_smilies` VALUES ('42', ':ugeek:', 'Uber Geek', 'icon_e_ugeek.gif', '17', '18', '42', '1');

-- ----------------------------
-- Table structure for phpbb_styles
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_styles`;
CREATE TABLE `phpbb_styles` (
  `style_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `style_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `style_copyright` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `style_active` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `style_path` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'kNg=',
  `style_parent_id` int(4) unsigned NOT NULL DEFAULT '0',
  `style_parent_tree` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`style_id`),
  UNIQUE KEY `style_name` (`style_name`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_styles
-- ----------------------------
INSERT INTO `phpbb_styles` VALUES ('1', 'prosilver', '&copy; phpBB Limited', '1', 'prosilver', '//g=', '0', '');

-- ----------------------------
-- Table structure for phpbb_teampage
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_teampage`;
CREATE TABLE `phpbb_teampage` (
  `teampage_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `teampage_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `teampage_position` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `teampage_parent` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`teampage_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_teampage
-- ----------------------------
INSERT INTO `phpbb_teampage` VALUES ('1', '5', '', '1', '0');
INSERT INTO `phpbb_teampage` VALUES ('2', '4', '', '2', '0');

-- ----------------------------
-- Table structure for phpbb_topics
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_topics`;
CREATE TABLE `phpbb_topics` (
  `topic_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `icon_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_attachment` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_reported` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `topic_poster` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_time_limit` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_views` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_status` tinyint(3) NOT NULL DEFAULT '0',
  `topic_type` tinyint(3) NOT NULL DEFAULT '0',
  `topic_first_post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_first_poster_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `topic_first_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_last_poster_name` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_poster_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_subject` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_last_post_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_last_view_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_moved_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_bumped` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_bumper` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `poll_title` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `poll_start` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_length` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_max_options` tinyint(4) NOT NULL DEFAULT '1',
  `poll_last_vote` int(11) unsigned NOT NULL DEFAULT '0',
  `poll_vote_change` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `topic_visibility` tinyint(3) NOT NULL DEFAULT '0',
  `topic_delete_time` int(11) unsigned NOT NULL DEFAULT '0',
  `topic_delete_reason` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `topic_delete_user` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_posts_approved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_unapproved` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_posts_softdeleted` mediumint(8) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `forum_id_type` (`forum_id`,`topic_type`),
  KEY `last_post_time` (`topic_last_post_time`),
  KEY `fid_time_moved` (`forum_id`,`topic_last_post_time`,`topic_moved_id`),
  KEY `topic_visibility` (`topic_visibility`),
  KEY `forum_vis_last` (`forum_id`,`topic_visibility`,`topic_last_post_id`),
  KEY `latest_topics` (`forum_id`,`topic_last_post_time`,`topic_last_post_id`,`topic_moved_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_topics
-- ----------------------------
INSERT INTO `phpbb_topics` VALUES ('1', '2', '0', '0', '0', 'Welcome to phpBB3', '2', '1542809695', '0', '0', '0', '0', '1', 'root', 'AA0000', '1', '2', 'root', 'AA0000', 'Welcome to phpBB3', '1542809695', '972086460', '0', '0', '0', '', '0', '0', '1', '0', '0', '1', '0', '', '0', '1', '0', '0');

-- ----------------------------
-- Table structure for phpbb_topics_posted
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_topics_posted`;
CREATE TABLE `phpbb_topics_posted` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_posted` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_topics_posted
-- ----------------------------
INSERT INTO `phpbb_topics_posted` VALUES ('2', '1', '1');

-- ----------------------------
-- Table structure for phpbb_topics_track
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_topics_track`;
CREATE TABLE `phpbb_topics_track` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `forum_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `mark_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`topic_id`),
  KEY `forum_id` (`forum_id`),
  KEY `topic_id` (`topic_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_topics_track
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_topics_watch
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_topics_watch`;
CREATE TABLE `phpbb_topics_watch` (
  `topic_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `notify_status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  KEY `topic_id` (`topic_id`),
  KEY `user_id` (`user_id`),
  KEY `notify_stat` (`notify_status`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_topics_watch
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_users
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_users`;
CREATE TABLE `phpbb_users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_type` tinyint(2) NOT NULL DEFAULT '0',
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '3',
  `user_permissions` mediumtext COLLATE utf8_bin NOT NULL,
  `user_perm_from` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_ip` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_regdate` int(11) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `username_clean` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_password` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_passchg` int(11) unsigned NOT NULL DEFAULT '0',
  `user_email` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_email_hash` bigint(20) NOT NULL DEFAULT '0',
  `user_birthday` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_lastvisit` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastmark` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastpost_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_lastpage` varchar(200) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_last_confirm_key` varchar(10) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_last_search` int(11) unsigned NOT NULL DEFAULT '0',
  `user_warnings` tinyint(4) NOT NULL DEFAULT '0',
  `user_last_warning` int(11) unsigned NOT NULL DEFAULT '0',
  `user_login_attempts` tinyint(4) NOT NULL DEFAULT '0',
  `user_inactive_reason` tinyint(2) NOT NULL DEFAULT '0',
  `user_inactive_time` int(11) unsigned NOT NULL DEFAULT '0',
  `user_posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_lang` varchar(30) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_timezone` varchar(100) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_dateformat` varchar(64) COLLATE utf8_bin NOT NULL DEFAULT 'd M Y H:i',
  `user_style` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_rank` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_colour` varchar(6) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_new_privmsg` int(4) NOT NULL DEFAULT '0',
  `user_unread_privmsg` int(4) NOT NULL DEFAULT '0',
  `user_last_privmsg` int(11) unsigned NOT NULL DEFAULT '0',
  `user_message_rules` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_full_folder` int(11) NOT NULL DEFAULT '-3',
  `user_emailtime` int(11) unsigned NOT NULL DEFAULT '0',
  `user_topic_show_days` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_topic_sortby_type` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
  `user_topic_sortby_dir` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'd',
  `user_post_show_days` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_post_sortby_type` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 't',
  `user_post_sortby_dir` varchar(1) COLLATE utf8_bin NOT NULL DEFAULT 'a',
  `user_notify` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_notify_pm` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_notify_type` tinyint(4) NOT NULL DEFAULT '0',
  `user_allow_pm` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_viewonline` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_viewemail` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_allow_massemail` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_options` int(11) unsigned NOT NULL DEFAULT '230271',
  `user_avatar` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_avatar_type` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_avatar_width` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_avatar_height` smallint(4) unsigned NOT NULL DEFAULT '0',
  `user_sig` mediumtext COLLATE utf8_bin NOT NULL,
  `user_sig_bbcode_uid` varchar(8) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_sig_bbcode_bitfield` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_jabber` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_actkey` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_newpasswd` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_form_salt` varchar(32) COLLATE utf8_bin NOT NULL DEFAULT '',
  `user_new` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `user_reminded` tinyint(4) NOT NULL DEFAULT '0',
  `user_reminded_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username_clean` (`username_clean`),
  KEY `user_birthday` (`user_birthday`),
  KEY `user_email_hash` (`user_email_hash`),
  KEY `user_type` (`user_type`)
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_users
-- ----------------------------
INSERT INTO `phpbb_users` VALUES ('1', '2', '1', 0x3030303030303030303030673133796471380A6877627939773030303030300A687762793977303030303030, '0', '', '1542809695', 'Anonymous', 'anonymous', '', '0', '', '0', '', '0', '0', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', '', 'd M Y H:i', '1', '0', '', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '1', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '2stns3j3as1t2i13', '1', '0', '0');
INSERT INTO `phpbb_users` VALUES ('2', '3', '5', 0x7A696B307A6A7A696B307A6A7A696B307A670A6877627939773030303030300A7A696B307A6A7A696837756F, '0', '::1', '1542809695', 'root', 'root', '$2y$10$Ofk3tOVCBCxeZKvw7jVnM.cDGWS2oTbQDwy2dDRFj46lASNeBKFJO', '0', 'sawang1990@gmail.com', '295716350620', '', '1542864180', '0', '0', 'index.php', '', '0', '0', '0', '0', '0', '0', '1', 'en', '', 'D M d, Y g:i a', '1', '1', 'AA0000', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '1', '1', '1', '1', '230271', '', '', '0', '0', '', '', '', '', '', '', 'z7zl7d69f9eqvqh5', '1', '0', '0');
INSERT INTO `phpbb_users` VALUES ('3', '2', '6', '', '0', '', '1542809697', 'AdsBot [Google]', 'adsbot [google]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '3uq3hru2vj3lvkjg', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('4', '2', '6', '', '0', '', '1542809697', 'Alexa [Bot]', 'alexa [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'mrl85p3orwcew6zb', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('5', '2', '6', '', '0', '', '1542809697', 'Alta Vista [Bot]', 'alta vista [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '62bsppl4ss75d9an', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('6', '2', '6', '', '0', '', '1542809697', 'Ask Jeeves [Bot]', 'ask jeeves [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '7aoumxdsal6hbm22', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('7', '2', '6', '', '0', '', '1542809697', 'Baidu [Spider]', 'baidu [spider]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 's478adwf4czvw26g', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('8', '2', '6', '', '0', '', '1542809697', 'Bing [Bot]', 'bing [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '8x62fvkku467hgrq', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('9', '2', '6', '', '0', '', '1542809697', 'Exabot [Bot]', 'exabot [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'iv1oku61qnkfw6a6', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('10', '2', '6', '', '0', '', '1542809697', 'FAST Enterprise [Crawler]', 'fast enterprise [crawler]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 's49cvhb4pycxkr7d', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('11', '2', '6', '', '0', '', '1542809697', 'FAST WebCrawler [Crawler]', 'fast webcrawler [crawler]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'hjnirhrg7ggem4b4', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('12', '2', '6', '', '0', '', '1542809697', 'Francis [Bot]', 'francis [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'tvnqwiy7xjf0amrc', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('13', '2', '6', '', '0', '', '1542809697', 'Gigabot [Bot]', 'gigabot [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'glt8cyztudxnggru', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('14', '2', '6', '', '0', '', '1542809697', 'Google Adsense [Bot]', 'google adsense [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'tdl4ukl9jmtdel22', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('15', '2', '6', '', '0', '', '1542809697', 'Google Desktop', 'google desktop', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'f8sun037ew2ebtpi', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('16', '2', '6', '', '0', '', '1542809697', 'Google Feedfetcher', 'google feedfetcher', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'k09z6kv47qnks0o5', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('17', '2', '6', '', '0', '', '1542809697', 'Google [Bot]', 'google [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'e7mjrg9f1bqymh9p', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('18', '2', '6', '', '0', '', '1542809697', 'Heise IT-Markt [Crawler]', 'heise it-markt [crawler]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'yh2uqyapaer1zzi7', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('19', '2', '6', '', '0', '', '1542809697', 'Heritrix [Crawler]', 'heritrix [crawler]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '7booobk41d2f513i', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('20', '2', '6', '', '0', '', '1542809697', 'IBM Research [Bot]', 'ibm research [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'ircfqcq4n9b9def8', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('21', '2', '6', '', '0', '', '1542809697', 'ICCrawler - ICjobs', 'iccrawler - icjobs', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '7n43wz9j468m4ffh', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('22', '2', '6', '', '0', '', '1542809697', 'ichiro [Crawler]', 'ichiro [crawler]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '8y2diflhf94gtmgz', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('23', '2', '6', '', '0', '', '1542809697', 'Majestic-12 [Bot]', 'majestic-12 [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'b5djjxiuk7mxsow3', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('24', '2', '6', '', '0', '', '1542809697', 'Metager [Bot]', 'metager [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '668qayxod34j3sw3', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('25', '2', '6', '', '0', '', '1542809697', 'MSN NewsBlogs', 'msn newsblogs', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'kfk6h5f8wffgcybd', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('26', '2', '6', '', '0', '', '1542809697', 'MSN [Bot]', 'msn [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'xcvg4c4cscwdebob', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('27', '2', '6', '', '0', '', '1542809697', 'MSNbot Media', 'msnbot media', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'mt7hwmbv6u61yynu', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('28', '2', '6', '', '0', '', '1542809697', 'Nutch [Bot]', 'nutch [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'najor336vop96qnr', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('29', '2', '6', '', '0', '', '1542809697', 'Online link [Validator]', 'online link [validator]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'btulmoiv0mc89ok9', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('30', '2', '6', '', '0', '', '1542809697', 'psbot [Picsearch]', 'psbot [picsearch]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'gr5ymrtokgwbwggc', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('31', '2', '6', '', '0', '', '1542809697', 'Sensis [Crawler]', 'sensis [crawler]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'wi4lw4m0e15gyecy', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('32', '2', '6', '', '0', '', '1542809697', 'SEO Crawler', 'seo crawler', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'ygjccxa4udlpihwv', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('33', '2', '6', '', '0', '', '1542809697', 'Seoma [Crawler]', 'seoma [crawler]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '1zi9i6tyw2j0zc2q', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('34', '2', '6', '', '0', '', '1542809697', 'SEOSearch [Crawler]', 'seosearch [crawler]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '5uyf0b1d7mbehwzm', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('35', '2', '6', '', '0', '', '1542809697', 'Snappy [Bot]', 'snappy [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '2yozk6hebkv8izv2', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('36', '2', '6', '', '0', '', '1542809697', 'Steeler [Crawler]', 'steeler [crawler]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'c3r6xsmblqdiw5in', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('37', '2', '6', '', '0', '', '1542809697', 'Telekom [Bot]', 'telekom [bot]', '', '1542809697', '', '0', '', '0', '1542809697', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'p8x58kdloi66b9xb', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('38', '2', '6', '', '0', '', '1542809698', 'TurnitinBot [Bot]', 'turnitinbot [bot]', '', '1542809698', '', '0', '', '0', '1542809698', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'f9nmv6boepaflzbw', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('39', '2', '6', '', '0', '', '1542809698', 'Voyager [Bot]', 'voyager [bot]', '', '1542809698', '', '0', '', '0', '1542809698', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'vl0gz2flfrhnat34', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('40', '2', '6', '', '0', '', '1542809698', 'W3 [Sitesearch]', 'w3 [sitesearch]', '', '1542809698', '', '0', '', '0', '1542809698', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'w6bnlz3dm39h8jz1', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('41', '2', '6', '', '0', '', '1542809698', 'W3C [Linkcheck]', 'w3c [linkcheck]', '', '1542809698', '', '0', '', '0', '1542809698', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '7hc5wm8zdt9a3t4h', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('42', '2', '6', '', '0', '', '1542809698', 'W3C [Validator]', 'w3c [validator]', '', '1542809698', '', '0', '', '0', '1542809698', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'lzeosh7q5n8vho2b', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('43', '2', '6', '', '0', '', '1542809698', 'YaCy [Bot]', 'yacy [bot]', '', '1542809698', '', '0', '', '0', '1542809698', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '73dpnkl6zld0tah1', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('44', '2', '6', '', '0', '', '1542809698', 'Yahoo MMCrawler [Bot]', 'yahoo mmcrawler [bot]', '', '1542809698', '', '0', '', '0', '1542809698', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '5r6fjjyxvkf05brz', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('45', '2', '6', '', '0', '', '1542809698', 'Yahoo Slurp [Bot]', 'yahoo slurp [bot]', '', '1542809698', '', '0', '', '0', '1542809698', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'szx871iaemfbl6c3', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('46', '2', '6', '', '0', '', '1542809698', 'Yahoo [Bot]', 'yahoo [bot]', '', '1542809698', '', '0', '', '0', '1542809698', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', 'm13a8nb7bzh3ant3', '0', '0', '0');
INSERT INTO `phpbb_users` VALUES ('47', '2', '6', '', '0', '', '1542809698', 'YahooSeeker [Bot]', 'yahooseeker [bot]', '', '1542809698', '', '0', '', '0', '1542809698', '0', '', '', '0', '0', '0', '0', '0', '0', '0', 'en', 'UTC', 'D M d, Y g:i a', '1', '0', '9E8DA7', '0', '0', '0', '0', '-3', '0', '0', 't', 'd', '0', 't', 'a', '0', '1', '0', '0', '1', '1', '0', '230271', '', '', '0', '0', '', '', '', '', '', '', '90le00ihgkwy6uo1', '0', '0', '0');

-- ----------------------------
-- Table structure for phpbb_user_group
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_user_group`;
CREATE TABLE `phpbb_user_group` (
  `group_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_leader` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `user_pending` tinyint(1) unsigned NOT NULL DEFAULT '1',
  KEY `group_id` (`group_id`),
  KEY `user_id` (`user_id`),
  KEY `group_leader` (`group_leader`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_user_group
-- ----------------------------
INSERT INTO `phpbb_user_group` VALUES ('1', '1', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('2', '2', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('4', '2', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('5', '2', '1', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '3', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '4', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '5', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '6', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '7', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '8', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '9', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '10', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '11', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '12', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '13', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '14', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '15', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '16', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '17', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '18', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '19', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '20', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '21', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '22', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '23', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '24', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '25', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '26', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '27', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '28', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '29', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '30', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '31', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '32', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '33', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '34', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '35', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '36', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '37', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '38', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '39', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '40', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '41', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '42', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '43', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '44', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '45', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '46', '0', '0');
INSERT INTO `phpbb_user_group` VALUES ('6', '47', '0', '0');

-- ----------------------------
-- Table structure for phpbb_user_notifications
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_user_notifications`;
CREATE TABLE `phpbb_user_notifications` (
  `item_type` varchar(165) COLLATE utf8_bin NOT NULL DEFAULT '',
  `item_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `method` varchar(165) COLLATE utf8_bin NOT NULL DEFAULT '',
  `notify` tinyint(1) unsigned NOT NULL DEFAULT '1',
  UNIQUE KEY `itm_usr_mthd` (`item_type`,`item_id`,`user_id`,`method`),
  KEY `user_id` (`user_id`),
  KEY `uid_itm_id` (`user_id`,`item_id`),
  KEY `usr_itm_tpe` (`user_id`,`item_type`,`item_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_user_notifications
-- ----------------------------
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '2', 'notification.method.board', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '2', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '2', 'notification.method.board', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '2', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '3', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '3', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '4', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '4', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '5', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '5', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '6', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '6', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '7', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '7', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '8', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '8', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '9', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '9', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '10', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '10', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '11', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '11', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '12', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '12', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '13', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '13', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '14', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '14', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '15', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '15', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '16', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '16', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '17', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '17', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '18', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '18', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '19', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '19', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '20', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '20', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '21', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '21', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '22', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '22', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '23', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '23', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '24', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '24', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '25', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '25', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '26', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '26', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '27', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '27', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '28', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '28', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '29', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '29', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '30', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '30', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '31', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '31', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '32', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '32', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '33', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '33', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '34', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '34', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '35', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '35', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '36', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '36', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '37', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '37', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '38', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '38', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '39', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '39', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '40', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '40', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '41', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '41', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '42', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '42', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '43', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '43', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '44', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '44', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '45', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '45', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '46', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '46', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.post', '0', '47', 'notification.method.email', '1');
INSERT INTO `phpbb_user_notifications` VALUES ('notification.type.topic', '0', '47', 'notification.method.email', '1');

-- ----------------------------
-- Table structure for phpbb_warnings
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_warnings`;
CREATE TABLE `phpbb_warnings` (
  `warning_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `post_id` int(10) unsigned NOT NULL DEFAULT '0',
  `log_id` int(10) unsigned NOT NULL DEFAULT '0',
  `warning_time` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`warning_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_warnings
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_words
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_words`;
CREATE TABLE `phpbb_words` (
  `word_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `word` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  `replacement` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT '',
  PRIMARY KEY (`word_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_words
-- ----------------------------

-- ----------------------------
-- Table structure for phpbb_zebra
-- ----------------------------
DROP TABLE IF EXISTS `phpbb_zebra`;
CREATE TABLE `phpbb_zebra` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `zebra_id` int(10) unsigned NOT NULL DEFAULT '0',
  `friend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `foe` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`,`zebra_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Records of phpbb_zebra
-- ----------------------------
