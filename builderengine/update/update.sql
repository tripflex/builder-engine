/*
Navicat MySQL Data Transfer

Source Server         : hemus.rdb.superhosting.bg
Source Server Version : 50536
Source Host           : hemus.rdb.superhosting.bg:3306
Source Database       : bgbu1pzz_devcms

Target Server Type    : MYSQL
Target Server Version : 50536
File Encoding         : 65001

Date: 2014-05-21 20:40:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for be_builderpayment_addresses
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_addresses`;
CREATE TABLE `be_builderpayment_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address_line_1` varchar(255) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_addresses
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_link_order_bill_addr
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_link_order_bill_addr`;
CREATE TABLE `be_builderpayment_link_order_bill_addr` (
  `id` int(11) NOT NULL,
  `billingaddress_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_link_order_bill_addr
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_link_order_product
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_link_order_product`;
CREATE TABLE `be_builderpayment_link_order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_link_order_product
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_link_order_ship_addr
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_link_order_ship_addr`;
CREATE TABLE `be_builderpayment_link_order_ship_addr` (
  `id` int(11) NOT NULL,
  `shippingaddress_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_link_order_ship_addr
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_link_ship_user
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_link_ship_user`;
CREATE TABLE `be_builderpayment_link_ship_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shippingaddress_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_link_ship_user
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_order_products
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_order_products`;
CREATE TABLE `be_builderpayment_order_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `custom_data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_order_products
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_orders
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_orders`;
CREATE TABLE `be_builderpayment_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `custom_data` longblob,
  `payment_method` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `status` enum('pending','paid','canceled') DEFAULT 'pending',
  `billingaddress_id` int(11) DEFAULT NULL,
  `shippingaddress_id` int(11) DEFAULT NULL,
  `callback` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `gross` decimal(11,2) DEFAULT NULL,
  `paid_gross` decimal(11,2) DEFAULT '0.00',
  `shipped` enum('yes','no') DEFAULT 'no',
  `time_created` int(11) DEFAULT '0',
  `time_paid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_orders
-- ----------------------------

-- Update 2.0.26 ---
-- ----------------------------
-- Table structure for be_builderpayment_addresses
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_addresses`;
CREATE TABLE `be_builderpayment_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) DEFAULT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `address_line_1` varchar(255) DEFAULT NULL,
  `address_line_2` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_addresses
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_link_order_bill_addr
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_link_order_bill_addr`;
CREATE TABLE `be_builderpayment_link_order_bill_addr` (
  `id` int(11) NOT NULL,
  `billingaddress_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_link_order_bill_addr
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_link_order_product
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_link_order_product`;
CREATE TABLE `be_builderpayment_link_order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_link_order_product
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_link_order_ship_addr
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_link_order_ship_addr`;
CREATE TABLE `be_builderpayment_link_order_ship_addr` (
  `id` int(11) NOT NULL,
  `shippingaddress_id` int(11) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_link_order_ship_addr
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_link_ship_user
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_link_ship_user`;
CREATE TABLE `be_builderpayment_link_ship_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `shippingaddress_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_link_ship_user
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_order_products
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_order_products`;
CREATE TABLE `be_builderpayment_order_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `quantity` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `custom_data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_order_products
-- ----------------------------

-- ----------------------------
-- Table structure for be_builderpayment_orders
-- ----------------------------
DROP TABLE IF EXISTS `be_builderpayment_orders`;
CREATE TABLE `be_builderpayment_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(255) DEFAULT NULL,
  `order_id` int(11) DEFAULT NULL,
  `custom_data` longblob,
  `payment_method` varchar(255) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `status` enum('pending','paid','canceled') DEFAULT 'pending',
  `billingaddress_id` int(11) DEFAULT NULL,
  `shippingaddress_id` int(11) DEFAULT NULL,
  `callback` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT '0',
  `gross` decimal(11,2) DEFAULT NULL,
  `paid_gross` decimal(11,2) DEFAULT '0.00',
  `shipped` enum('yes','no') DEFAULT 'no',
  `time_created` int(11) DEFAULT '0',
  `time_paid` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of be_builderpayment_orders
-- ----------------------------

