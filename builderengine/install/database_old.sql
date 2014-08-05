/*
Navicat MySQL Data Transfer

Source Server         : Server
Source Server Version : 50529
Source Host           : 127.0.0.1:3306
Source Database       : dump

Target Server Type    : MYSQL
Target Server Version : 50529
File Encoding         : 65001

Date: 2013-10-26 18:02:32
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for be_alerts
-- ----------------------------
DROP TABLE IF EXISTS `be_alerts`;
CREATE TABLE `be_alerts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `tag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_alerts
-- ----------------------------

-- ----------------------------
-- Table structure for be_areas
-- ----------------------------
DROP TABLE IF EXISTS `be_areas`;
CREATE TABLE `be_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT '',
  `page` varchar(500) DEFAULT '',
  `global` enum('true','false') DEFAULT 'false',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_areas
-- ----------------------------

-- ----------------------------
-- Table structure for be_blocks
-- ----------------------------
DROP TABLE IF EXISTS `be_blocks`;
CREATE TABLE `be_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` longtext,
  `style` varchar(500) DEFAULT NULL,
  `static_style` varchar(255) DEFAULT NULL,
  `classes` varchar(255) DEFAULT '',
  `area` int(11) DEFAULT '0',
  `active` enum('true','false') DEFAULT 'true',
  `global` enum('true','false') DEFAULT 'false',
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`,`version`),
  FULLTEXT KEY `content` (`content`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_blocks
-- ----------------------------

-- ----------------------------
-- Table structure for be_cache
-- ----------------------------
DROP TABLE IF EXISTS `be_cache`;
CREATE TABLE `be_cache` (
  `id` varchar(255) NOT NULL,
  `object` blob,
  `timeout` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_cache
-- ----------------------------

-- ----------------------------
-- Table structure for be_link_permissions
-- ----------------------------
DROP TABLE IF EXISTS `be_link_permissions`;
CREATE TABLE `be_link_permissions` (
  `link_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  PRIMARY KEY (`link_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_link_permissions
-- ----------------------------
INSERT INTO `be_link_permissions` VALUES ('0', '3');
INSERT INTO `be_link_permissions` VALUES ('7', '2');
INSERT INTO `be_link_permissions` VALUES ('7', '3');
INSERT INTO `be_link_permissions` VALUES ('8', '2');
INSERT INTO `be_link_permissions` VALUES ('8', '3');
INSERT INTO `be_link_permissions` VALUES ('20', '1');
INSERT INTO `be_link_permissions` VALUES ('20', '2');
INSERT INTO `be_link_permissions` VALUES ('20', '3');
INSERT INTO `be_link_permissions` VALUES ('20', '4');
INSERT INTO `be_link_permissions` VALUES ('20', '5');
INSERT INTO `be_link_permissions` VALUES ('21', '1');
INSERT INTO `be_link_permissions` VALUES ('21', '2');
INSERT INTO `be_link_permissions` VALUES ('21', '3');
INSERT INTO `be_link_permissions` VALUES ('21', '4');
INSERT INTO `be_link_permissions` VALUES ('21', '5');
INSERT INTO `be_link_permissions` VALUES ('22', '1');
INSERT INTO `be_link_permissions` VALUES ('23', '1');
INSERT INTO `be_link_permissions` VALUES ('23', '2');
INSERT INTO `be_link_permissions` VALUES ('23', '3');
INSERT INTO `be_link_permissions` VALUES ('23', '4');
INSERT INTO `be_link_permissions` VALUES ('23', '5');

-- ----------------------------
-- Table structure for be_links
-- ----------------------------
DROP TABLE IF EXISTS `be_links`;
CREATE TABLE `be_links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `target` varchar(500) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT '0',
  `order` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_links
-- ----------------------------
INSERT INTO `be_links` VALUES ('7', 'Home', '/', '', '|nav|', '0', '1');
INSERT INTO `be_links` VALUES ('8', 'Blog', '/blog/index', '', '||', '0', '2');
INSERT INTO `be_links` VALUES ('20', 'Process', '/page-process.html', '', '||', '0', '3');
INSERT INTO `be_links` VALUES ('21', 'Clients', '/page-clients.html', '', '||', '0', '4');
INSERT INTO `be_links` VALUES ('22', 'Admin', '/admin', '', '||', '0', '10');
INSERT INTO `be_links` VALUES ('23', 'Contact Us', '/page-contact-us.html', '', '||', '0', '6');

-- ----------------------------
-- Table structure for be_module_permissions
-- ----------------------------
DROP TABLE IF EXISTS `be_module_permissions`;
CREATE TABLE `be_module_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` int(11) NOT NULL DEFAULT '0',
  `group` int(11) DEFAULT NULL,
  `access` enum('frontend','backend') DEFAULT 'frontend',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_module_permissions
-- ----------------------------
INSERT INTO `be_module_permissions` VALUES ('54', '1', '2', 'frontend');
INSERT INTO `be_module_permissions` VALUES ('55', '1', '3', 'frontend');
INSERT INTO `be_module_permissions` VALUES ('56', '1', '1', 'backend');
INSERT INTO `be_module_permissions` VALUES ('59', '2', '2', 'frontend');
INSERT INTO `be_module_permissions` VALUES ('60', '2', '3', 'frontend');
INSERT INTO `be_module_permissions` VALUES ('61', '2', '1', 'backend');
INSERT INTO `be_module_permissions` VALUES ('74', '4', '2', 'frontend');
INSERT INTO `be_module_permissions` VALUES ('75', '4', '3', 'frontend');
INSERT INTO `be_module_permissions` VALUES ('76', '4', '1', 'backend');

-- ----------------------------
-- Table structure for be_modules
-- ----------------------------
DROP TABLE IF EXISTS `be_modules`;
CREATE TABLE `be_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `version` varchar(255) DEFAULT NULL,
  `installer_id` int(11) DEFAULT NULL,
  `install_time` int(11) DEFAULT NULL,
  `active` enum('true','false') DEFAULT 'true',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_modules
-- ----------------------------
INSERT INTO `be_modules` VALUES ('1', 'Blog', 'blog', '1.1', '1', '123456', 'true');
INSERT INTO `be_modules` VALUES ('2', 'Pages', 'page', '1.1', '1', '1234561', 'true');
INSERT INTO `be_modules` VALUES ('4', 'Client', 'client', 'unknown', '0', '1382706363', 'true');

-- ----------------------------
-- Table structure for be_options
-- ----------------------------
DROP TABLE IF EXISTS `be_options`;
CREATE TABLE `be_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `value` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `option_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_options
-- ----------------------------
INSERT INTO `be_options` VALUES ('1', 'active_frontend_theme', 'metro');
INSERT INTO `be_options` VALUES ('2', 'active_backend_theme', 'dashboard');
INSERT INTO `be_options` VALUES ('3', 'version', '2.0');
INSERT INTO `be_options` VALUES ('4', 'registration_allowed', 'no');

-- ----------------------------
-- Table structure for be_page_versions
-- ----------------------------
DROP TABLE IF EXISTS `be_page_versions`;
CREATE TABLE `be_page_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `approver` int(11) NOT NULL DEFAULT '-1',
  `name` varchar(255) DEFAULT NULL,
  `status` enum('pending','submitted') DEFAULT 'pending',
  `active` enum('true','false') DEFAULT 'true',
  `time_created` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_page_versions
-- ----------------------------

-- ----------------------------
-- Table structure for be_pages
-- ----------------------------
DROP TABLE IF EXISTS `be_pages`;
CREATE TABLE `be_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slug` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_pages
-- ----------------------------
INSERT INTO `be_pages` VALUES ('1', 'Contact Us', 'contact-us', '1382797482', '1', 'contact-us');
INSERT INTO `be_pages` VALUES ('2', 'Clients', 'clients', '1382799135', '1', 'clients');
INSERT INTO `be_pages` VALUES ('3', 'Process', 'process', '1382799172', '1', 'process');

-- ----------------------------
-- Table structure for be_posts
-- ----------------------------
DROP TABLE IF EXISTS `be_posts`;
CREATE TABLE `be_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `block` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT '',
  `date_created` int(11) DEFAULT '0',
  `author` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `title_fulltext` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_posts
-- ----------------------------

-- ----------------------------
-- Table structure for be_user_group_link
-- ----------------------------
DROP TABLE IF EXISTS `be_user_group_link`;
CREATE TABLE `be_user_group_link` (
  `user` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  PRIMARY KEY (`user`,`group`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_user_group_link
-- ----------------------------

-- ----------------------------
-- Table structure for be_user_groups
-- ----------------------------
DROP TABLE IF EXISTS `be_user_groups`;
CREATE TABLE `be_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_user_groups
-- ----------------------------
INSERT INTO `be_user_groups` VALUES ('1', 'Administrators', 'Group for all users who should have access to the Admin Dashboard.');
INSERT INTO `be_user_groups` VALUES ('2', 'Members', 'Group for logged in users.');
INSERT INTO `be_user_groups` VALUES ('3', 'Guests', 'Group for non-logged in users.');
INSERT INTO `be_user_groups` VALUES ('4', 'Frontend Editor', 'Members of this group are able to make changes to the website pages. Still a member of Frontend Manager group must approve their changes.');
INSERT INTO `be_user_groups` VALUES ('5', 'Frontend Manager', 'Members of this group are able to approve changes made by the Frontend Editor group and switch page versions.');

-- ----------------------------
-- Table structure for be_users
-- ----------------------------
DROP TABLE IF EXISTS `be_users`;
CREATE TABLE `be_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `name` varchar(60) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `date_registered` int(11) DEFAULT NULL,
  `level` enum('Member','Administrator') DEFAULT 'Member',
  `last_activity` int(11) DEFAULT '0',
  `pass_reset_token` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `user_search_fulltext` (`username`,`name`,`email`),
  FULLTEXT KEY `username_fulltext` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of be_users
-- ----------------------------

-- ----------------------------
-- Table structure for be_visits
-- ----------------------------
DROP TABLE IF EXISTS `be_visits`;
CREATE TABLE `be_visits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) DEFAULT NULL,
  `page` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `timestamp` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_visits
-- ----------------------------
