/*
Navicat MySQL Data Transfer

Source Server         : Server
Source Server Version : 50535
Source Host           : 127.0.0.1:3306
Source Database       : devcms

Target Server Type    : MYSQL
Target Server Version : 50535
File Encoding         : 65001

Date: 2014-03-08 00:14:20
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
-- Table structure for be_block_relations
-- ----------------------------
DROP TABLE IF EXISTS `be_block_relations`;
CREATE TABLE `be_block_relations` (
  `parent` varchar(255) NOT NULL,
  `child` varchar(255) NOT NULL,
  `version` int(11) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  PRIMARY KEY (`parent`,`child`,`version`),
  KEY `version_parent` (`parent`,`version`),
  KEY `version` (`version`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_block_relations
-- ----------------------------

-- ----------------------------
-- Table structure for be_blocks
-- ----------------------------
DROP TABLE IF EXISTS `be_blocks`;
CREATE TABLE `be_blocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `global` enum('yes','no') CHARACTER SET latin1 DEFAULT 'no',
  `type` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `data` longblob,
  `options` blob,
  `active` enum('yes','no') CHARACTER SET latin1 DEFAULT 'yes',
  PRIMARY KEY (`id`,`version`),
  UNIQUE KEY `name_version_unique` (`version`,`name`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
INSERT INTO `be_link_permissions` VALUES ('1', '1');
INSERT INTO `be_link_permissions` VALUES ('1', '2');
INSERT INTO `be_link_permissions` VALUES ('1', '3');
INSERT INTO `be_link_permissions` VALUES ('1', '4');
INSERT INTO `be_link_permissions` VALUES ('1', '5');
INSERT INTO `be_link_permissions` VALUES ('2', '1');
INSERT INTO `be_link_permissions` VALUES ('2', '2');
INSERT INTO `be_link_permissions` VALUES ('2', '3');
INSERT INTO `be_link_permissions` VALUES ('2', '4');
INSERT INTO `be_link_permissions` VALUES ('2', '5');
INSERT INTO `be_link_permissions` VALUES ('3', '1');
INSERT INTO `be_link_permissions` VALUES ('3', '2');
INSERT INTO `be_link_permissions` VALUES ('3', '3');
INSERT INTO `be_link_permissions` VALUES ('3', '4');
INSERT INTO `be_link_permissions` VALUES ('3', '5');
INSERT INTO `be_link_permissions` VALUES ('4', '1');
INSERT INTO `be_link_permissions` VALUES ('4', '2');
INSERT INTO `be_link_permissions` VALUES ('4', '3');
INSERT INTO `be_link_permissions` VALUES ('4', '4');
INSERT INTO `be_link_permissions` VALUES ('4', '5');
INSERT INTO `be_link_permissions` VALUES ('5', '2');
INSERT INTO `be_link_permissions` VALUES ('6', '1');
INSERT INTO `be_link_permissions` VALUES ('6', '2');
INSERT INTO `be_link_permissions` VALUES ('6', '3');
INSERT INTO `be_link_permissions` VALUES ('6', '4');
INSERT INTO `be_link_permissions` VALUES ('6', '5');
INSERT INTO `be_link_permissions` VALUES ('7', '1');
INSERT INTO `be_link_permissions` VALUES ('7', '2');
INSERT INTO `be_link_permissions` VALUES ('7', '3');
INSERT INTO `be_link_permissions` VALUES ('7', '4');
INSERT INTO `be_link_permissions` VALUES ('7', '5');
INSERT INTO `be_link_permissions` VALUES ('8', '1');
INSERT INTO `be_link_permissions` VALUES ('8', '2');
INSERT INTO `be_link_permissions` VALUES ('8', '3');
INSERT INTO `be_link_permissions` VALUES ('8', '4');
INSERT INTO `be_link_permissions` VALUES ('8', '5');
INSERT INTO `be_link_permissions` VALUES ('9', '1');
INSERT INTO `be_link_permissions` VALUES ('9', '2');
INSERT INTO `be_link_permissions` VALUES ('9', '3');
INSERT INTO `be_link_permissions` VALUES ('9', '4');
INSERT INTO `be_link_permissions` VALUES ('9', '5');
INSERT INTO `be_link_permissions` VALUES ('10', '1');
INSERT INTO `be_link_permissions` VALUES ('10', '2');
INSERT INTO `be_link_permissions` VALUES ('10', '3');
INSERT INTO `be_link_permissions` VALUES ('10', '4');
INSERT INTO `be_link_permissions` VALUES ('10', '5');
INSERT INTO `be_link_permissions` VALUES ('11', '1');
INSERT INTO `be_link_permissions` VALUES ('11', '2');
INSERT INTO `be_link_permissions` VALUES ('11', '3');
INSERT INTO `be_link_permissions` VALUES ('11', '4');
INSERT INTO `be_link_permissions` VALUES ('11', '5');
INSERT INTO `be_link_permissions` VALUES ('12', '1');
INSERT INTO `be_link_permissions` VALUES ('12', '2');
INSERT INTO `be_link_permissions` VALUES ('12', '3');
INSERT INTO `be_link_permissions` VALUES ('12', '4');
INSERT INTO `be_link_permissions` VALUES ('12', '5');
INSERT INTO `be_link_permissions` VALUES ('13', '1');
INSERT INTO `be_link_permissions` VALUES ('13', '2');
INSERT INTO `be_link_permissions` VALUES ('13', '3');
INSERT INTO `be_link_permissions` VALUES ('13', '4');
INSERT INTO `be_link_permissions` VALUES ('13', '5');
INSERT INTO `be_link_permissions` VALUES ('14', '1');
INSERT INTO `be_link_permissions` VALUES ('14', '2');
INSERT INTO `be_link_permissions` VALUES ('14', '3');
INSERT INTO `be_link_permissions` VALUES ('14', '4');
INSERT INTO `be_link_permissions` VALUES ('14', '5');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_links
-- ----------------------------
INSERT INTO `be_links` VALUES ('1', 'Home', '/', '', null, '0', '1');
INSERT INTO `be_links` VALUES ('2', 'Pages', '', '', null, '0', '2');
INSERT INTO `be_links` VALUES ('3', 'Login', '/admin/main/login', '', null, '0', '3');
INSERT INTO `be_links` VALUES ('4', 'Edit This Site', '/admin', '', null, '0', '4');
INSERT INTO `be_links` VALUES ('5', 'Logout', '/admin/main/logout', '', null, '0', '5');
INSERT INTO `be_links` VALUES ('6', 'About', '/page-about-us.html', '', null, '2', '1');
INSERT INTO `be_links` VALUES ('7', 'Contact', '/page-contact.html', '', null, '2', '0');
INSERT INTO `be_links` VALUES ('8', 'FAQ', '/page-faq.html', '', null, '2', '0');
INSERT INTO `be_links` VALUES ('9', 'Features', '/page-features.html', '', null, '2', '0');
INSERT INTO `be_links` VALUES ('10', 'Portfolio', '/page-portfolio.html', '', null, '2', '0');
INSERT INTO `be_links` VALUES ('11', 'Projects', '/page-projects.html', '', null, '2', '0');
INSERT INTO `be_links` VALUES ('12', 'Resume', '/page-resume.html', '', null, '2', '0');
INSERT INTO `be_links` VALUES ('13', 'Service', '/page-service.html', '', null, '2', '0');
INSERT INTO `be_links` VALUES ('14', 'Timeline', '/page-timeline.html', '', null, '2', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_module_permissions
-- ----------------------------
INSERT INTO `be_module_permissions` VALUES ('1', '1', '2', 'frontend');
INSERT INTO `be_module_permissions` VALUES ('2', '1', '3', 'frontend');
INSERT INTO `be_module_permissions` VALUES ('3', '1', '1', 'backend');
INSERT INTO `be_module_permissions` VALUES ('4', '2', '2', 'frontend');
INSERT INTO `be_module_permissions` VALUES ('5', '2', '3', 'frontend');
INSERT INTO `be_module_permissions` VALUES ('6', '2', '1', 'backend');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_modules
-- ----------------------------
INSERT INTO `be_modules` VALUES ('1', 'Page', 'page', 'unknown', '0', '1394228161', 'true');
INSERT INTO `be_modules` VALUES ('2', 'Blog', 'blog', 'unknown', '0', '1394228780', 'true');

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
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_options
-- ----------------------------
INSERT INTO `be_options` VALUES ('1', 'active_frontend_theme', 'pro');
INSERT INTO `be_options` VALUES ('2', 'active_backend_theme', 'dashboard');
INSERT INTO `be_options` VALUES ('3', 'version', '2.0.20');

-- ----------------------------
-- Table structure for be_page_versions
-- ----------------------------
DROP TABLE IF EXISTS `be_page_versions`;
CREATE TABLE `be_page_versions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `author` int(11) DEFAULT NULL,
  `approver` int(11) NOT NULL DEFAULT '-1',
  `name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` enum('pending','submitted') CHARACTER SET latin1 DEFAULT 'pending',
  `active` enum('yes','no') CHARACTER SET latin1 DEFAULT 'no',
  `time_created` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `path_active` (`path`,`active`),
  KEY `path_status` (`path`,`status`),
  KEY `path` (`path`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_pages
-- ----------------------------
INSERT INTO `be_pages` VALUES ('1', 'About Us', 'about', '1394229679', '1', 'about-us');
INSERT INTO `be_pages` VALUES ('2', 'Contact', 'contact', '1394229700', '1', 'contact');
INSERT INTO `be_pages` VALUES ('3', 'FAQ', 'faq', '1394229749', '1', 'faq');
INSERT INTO `be_pages` VALUES ('4', 'Features', 'features', '1394229768', '1', 'features');
INSERT INTO `be_pages` VALUES ('5', 'Portfolio', 'portfolio', '1394229792', '1', 'portfolio');
INSERT INTO `be_pages` VALUES ('6', 'Projects', 'projects', '1394229807', '1', 'projects');
INSERT INTO `be_pages` VALUES ('7', 'Resume', 'resume', '1394229821', '1', 'resume');
INSERT INTO `be_pages` VALUES ('9', 'Timeline', 'timeline', '1394229843', '1', 'timeline');
INSERT INTO `be_pages` VALUES ('10', 'Service', 'service', '1394229877', '1', 'service');

-- ----------------------------
-- Table structure for be_post_comments
-- ----------------------------
DROP TABLE IF EXISTS `be_post_comments`;
CREATE TABLE `be_post_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `text` text,
  `time` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of be_post_comments
-- ----------------------------

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
