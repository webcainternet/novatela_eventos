-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 29, 2015 at 10:37 AM
-- Server version: 5.5.24-log
-- PHP Version: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";




--
-- Database: `511`
--

-- --------------------------------------------------------

--
-- Table structure for table `oc_banner`
--

DROP TABLE IF EXISTS `oc_banner`;
CREATE TABLE `oc_banner` (
  `banner_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`banner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `oc_banner`
--

INSERT INTO `oc_banner` (`banner_id`, `name`, `status`) VALUES
(15, 'Slideshow', 1),
(14, 'banners', 1);

-- --------------------------------------------------------

--
-- Table structure for table `oc_banner_image`
--

DROP TABLE IF EXISTS `oc_banner_image`;
CREATE TABLE `oc_banner_image` (
  `banner_image_id` int(11) NOT NULL AUTO_INCREMENT,
  `banner_id` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(3) NOT NULL DEFAULT '0',
  PRIMARY KEY (`banner_image_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=175 ;

--
-- Dumping data for table `oc_banner_image`
--

INSERT INTO `oc_banner_image` (`banner_image_id`, `banner_id`, `link`, `image`, `sort_order`) VALUES
(173, 14, 'index.php?route=product/product&amp;product_id=43', 'catalog/banner-5.jpg', 5),
(150, 15, '', 'catalog/slide-3.jpg', 3),
(172, 14, 'index.php?route=product/product&amp;product_id=42index.php?route=product/product&amp;product_id=42', 'catalog/banner-4.jpg', 4),
(149, 15, '', 'catalog/slide-2.jpg', 2),
(148, 15, '', 'catalog/slide-1.jpg', 1),
(171, 14, 'index.php?route=product/product&amp;product_id=42index.php?route=product/product&amp;product_id=42', 'catalog/banner-3.jpg', 3),
(170, 14, 'index.php?route=product/product&amp;product_id=42index.php?route=product/product&amp;product_id=42', 'catalog/banner-2.jpg', 2),
(169, 14, 'index.php?route=product/product&amp;product_id=42index.php?route=product/product&amp;product_id=42', 'catalog/banner-1.jpg', 1),
(174, 14, 'index.php?route=product/product&amp;product_id=42', 'catalog/banner-6.jpg', 6);

-- --------------------------------------------------------

--
-- Table structure for table `oc_banner_image_description`
--

DROP TABLE IF EXISTS `oc_banner_image_description`;
CREATE TABLE `oc_banner_image_description` (
  `banner_image_id` int(11) NOT NULL,
  `language_id` int(11) NOT NULL,
  `banner_id` int(11) NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`banner_image_id`,`language_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oc_banner_image_description`
--

INSERT INTO `oc_banner_image_description` (`banner_image_id`, `language_id`, `banner_id`, `title`, `description`) VALUES
(99, 1, 9, 'slide-1', ''),
(100, 1, 9, 'slide-2', ''),
(101, 1, 9, 'slide-3', ''),
(99, 2, 9, 'slide-1', ''),
(100, 2, 9, 'slide-2', ''),
(101, 2, 9, 'slide-3', ''),
(99, 3, 9, 'slide-1', ''),
(100, 3, 9, 'slide-2', ''),
(101, 3, 9, 'slide-3', ''),
(172, 1, 14, 'banner-4', 'School &amp; Office'),
(172, 2, 14, 'banner-4', 'School &amp; Office'),
(172, 3, 14, 'banner-4', 'School &amp; Office'),
(173, 1, 14, 'banner-5', 'Accessories'),
(173, 2, 14, 'banner-5', 'Accessories'),
(173, 3, 14, 'banner-5', 'Accessories'),
(174, 1, 14, 'banner-6', 'Cards &amp; Postage'),
(174, 2, 14, 'banner-6', 'Cards &amp; Postage'),
(174, 3, 14, 'banner-6', 'Cards &amp; Postage'),
(150, 2, 15, 'slide-3', '&lt;div&gt;\r\n&lt;h1&gt;Sit amet con&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet con&lt;/p&gt;\r\n&lt;a href=&quot;index.php?route=product/product&amp;product_id=30&quot;&gt;Shop Now!&lt;/a&gt;\r\n&lt;/div&gt;'),
(150, 3, 15, 'slide-3', '&lt;div&gt;\r\n&lt;h1&gt;Sit amet con&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet con&lt;/p&gt;\r\n&lt;a href=&quot;index.php?route=product/product&amp;product_id=30&quot;&gt;Shop Now!&lt;/a&gt;\r\n&lt;/div&gt;'),
(149, 3, 15, 'slide-2', '&lt;div&gt;\r\n&lt;h1&gt;Lorem ipsum dolor&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet con&lt;/p&gt;\r\n&lt;a href=&quot;index.php?route=product/product&amp;product_id=42&quot;&gt;Shop Now!&lt;/a&gt;\r\n&lt;/div&gt;'),
(150, 1, 15, 'slide-3', '&lt;div&gt;\r\n&lt;h1&gt;Sit amet con&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet con&lt;/p&gt;\r\n&lt;a href=&quot;index.php?route=product/product&amp;product_id=30&quot;&gt;Shop Now!&lt;/a&gt;\r\n&lt;/div&gt;'),
(149, 1, 15, 'slide-2', '&lt;div&gt;\r\n&lt;h1&gt;Lorem ipsum dolor&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet con&lt;/p&gt;\r\n&lt;a href=&quot;index.php?route=product/product&amp;product_id=42&quot;&gt;Shop Now!&lt;/a&gt;\r\n&lt;/div&gt;'),
(149, 2, 15, 'slide-2', '&lt;div&gt;\r\n&lt;h1&gt;Lorem ipsum dolor&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet con&lt;/p&gt;\r\n&lt;a href=&quot;index.php?route=product/product&amp;product_id=42&quot;&gt;Shop Now!&lt;/a&gt;\r\n&lt;/div&gt;'),
(148, 1, 15, 'slide-1', '&lt;div&gt;\r\n&lt;h1&gt;Destibulum lacin&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet con&lt;/p&gt;\r\n&lt;a href=&quot;index.php?route=product/product&amp;product_id=43&quot;&gt;Shop Now!&lt;/a&gt;\r\n&lt;/div&gt;'),
(148, 2, 15, 'slide-1', '&lt;div&gt;\r\n&lt;h1&gt;Destibulum lacin&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet con&lt;/p&gt;\r\n&lt;a href=&quot;index.php?route=product/product&amp;product_id=43&quot;&gt;Shop Now!&lt;/a&gt;\r\n&lt;/div&gt;'),
(148, 3, 15, 'slide-1', '&lt;div&gt;\r\n&lt;h1&gt;Destibulum lacin&lt;/h1&gt;\r\n&lt;p&gt;Lorem ipsum dolor sit amet con&lt;/p&gt;\r\n&lt;a href=&quot;index.php?route=product/product&amp;product_id=43&quot;&gt;Shop Now!&lt;/a&gt;\r\n&lt;/div&gt;'),
(171, 3, 14, 'banner-3', 'Clothing &amp; T-Shirts'),
(171, 2, 14, 'banner-3', 'Clothing &amp; T-Shirts'),
(171, 1, 14, 'banner-3', 'Clothing &amp; T-Shirts'),
(170, 3, 14, 'banner-2', 'Gifts'),
(170, 2, 14, 'banner-2', 'Gifts'),
(170, 1, 14, 'banner-2', 'Gifts'),
(169, 3, 14, 'banner-1', 'Mugs &amp; Cups'),
(169, 2, 14, 'banner-1', 'Mugs &amp; Cups'),
(169, 1, 14, 'banner-1', 'Mugs &amp; Cups');

-- --------------------------------------------------------

--
-- Table structure for table `oc_extension`
--

DROP TABLE IF EXISTS `oc_extension`;
CREATE TABLE `oc_extension` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(32) NOT NULL,
  `code` varchar(32) NOT NULL,
  PRIMARY KEY (`extension_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=440 ;

--
-- Dumping data for table `oc_extension`
--

INSERT INTO `oc_extension` (`extension_id`, `type`, `code`) VALUES
(23, 'payment', 'cod'),
(22, 'total', 'shipping'),
(57, 'total', 'sub_total'),
(58, 'total', 'tax'),
(59, 'total', 'total'),
(410, 'module', 'banner'),
(426, 'module', 'carousel'),
(390, 'total', 'credit'),
(387, 'shipping', 'flat'),
(349, 'total', 'handling'),
(350, 'total', 'low_order_fee'),
(389, 'total', 'coupon'),
(432, 'module', 'tm_fbbox'),
(408, 'module', 'account'),
(393, 'total', 'reward'),
(398, 'total', 'voucher'),
(407, 'payment', 'free_checkout'),
(427, 'module', 'featured'),
(428, 'module', 'parallax'),
(429, 'module', 'html'),
(430, 'module', 'tm_category'),
(433, 'module', 'bestseller'),
(434, 'module', 'latest'),
(435, 'module', 'special'),
(436, 'module', 'affiliate'),
(437, 'module', 'information'),
(438, 'module', 'tm_slideshow'),
(439, 'module', 'category');

-- --------------------------------------------------------

--
-- Table structure for table `oc_layout`
--

DROP TABLE IF EXISTS `oc_layout`;
CREATE TABLE `oc_layout` (
  `layout_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  PRIMARY KEY (`layout_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `oc_layout`
--

INSERT INTO `oc_layout` (`layout_id`, `name`) VALUES
(1, 'Home'),
(2, 'Product'),
(3, 'Category'),
(4, 'Default'),
(5, 'Manufacturer'),
(6, 'Account'),
(7, 'Checkout'),
(8, 'Contact'),
(9, 'Sitemap'),
(10, 'Affiliate'),
(11, 'Information'),
(12, 'Compare'),
(13, 'Search');

-- --------------------------------------------------------

--
-- Table structure for table `oc_layout_module`
--

DROP TABLE IF EXISTS `oc_layout_module`;
CREATE TABLE `oc_layout_module` (
  `layout_module_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `code` varchar(64) NOT NULL,
  `position` varchar(14) NOT NULL,
  `sort_order` int(3) NOT NULL,
  PRIMARY KEY (`layout_module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=404 ;

--
-- Dumping data for table `oc_layout_module`
--

INSERT INTO `oc_layout_module` (`layout_module_id`, `layout_id`, `code`, `position`, `sort_order`) VALUES
(398, 1, 'special.45', 'column_left', 2),
(397, 1, 'featured.28', 'content_top', 3),
(396, 1, 'banner.33', 'content_top', 2),
(395, 1, 'tm_slideshow.46', 'content_top', 1),
(354, 7, 'tm_category', 'column_left', 1),
(355, 12, 'tm_category', 'column_left', 1),
(400, 10, 'affiliate', 'column_left', 1),
(402, 4, 'tm_category', 'column_left', 1),
(403, 4, 'latest.44', 'column_left', 2),
(361, 13, 'tm_category', 'column_left', 1),
(399, 6, 'account', 'column_left', 2),
(360, 13, 'latest.44', 'column_left', 2),
(359, 5, 'tm_category', 'column_left', 1),
(394, 1, 'html.35', 'content_bottom', 1),
(393, 1, 'tm_category', 'column_left', 1),
(353, 3, 'tm_category', 'column_left', 1),
(352, 3, 'bestseller.43', 'column_left', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oc_layout_route`
--

DROP TABLE IF EXISTS `oc_layout_route`;
CREATE TABLE `oc_layout_route` (
  `layout_route_id` int(11) NOT NULL AUTO_INCREMENT,
  `layout_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `route` varchar(255) NOT NULL,
  PRIMARY KEY (`layout_route_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=156 ;

--
-- Dumping data for table `oc_layout_route`
--

INSERT INTO `oc_layout_route` (`layout_route_id`, `layout_id`, `store_id`, `route`) VALUES
(151, 6, 0, 'account/%'),
(153, 10, 0, 'affiliate/%'),
(129, 3, 0, 'product/category'),
(146, 1, 0, 'common/home'),
(147, 2, 0, 'product/product'),
(148, 11, 0, 'information/information'),
(130, 7, 0, 'checkout/%'),
(149, 8, 0, 'information/contact'),
(152, 9, 0, 'information/sitemap'),
(155, 4, 0, ''),
(136, 5, 0, 'product/manufacturer'),
(131, 12, 0, 'product/compare'),
(137, 13, 0, 'product/search');

-- --------------------------------------------------------

--
-- Table structure for table `oc_module`
--

DROP TABLE IF EXISTS `oc_module`;
CREATE TABLE `oc_module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `code` varchar(32) NOT NULL,
  `setting` text NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=50 ;

--
-- Dumping data for table `oc_module`
--

INSERT INTO `oc_module` (`module_id`, `name`, `code`, `setting`) VALUES
(33, 'banners', 'banner', 'a:5:{s:4:"name";s:7:"banners";s:9:"banner_id";s:2:"14";s:5:"width";s:3:"268";s:6:"height";s:3:"197";s:6:"status";s:1:"1";}'),
(28, 'Featured ', 'featured', 'a:6:{s:4:"name";s:9:"Featured ";s:7:"product";a:8:{i:0;s:2:"43";i:1;s:2:"40";i:2;s:2:"30";i:3;s:2:"42";i:4;s:2:"33";i:5;s:2:"46";i:6;s:2:"32";i:7;s:2:"28";}s:5:"limit";s:1:"6";s:5:"width";s:3:"268";s:6:"height";s:3:"268";s:6:"status";s:1:"1";}'),
(35, 'Bottom-block', 'html', 'a:3:{s:4:"name";s:12:"Bottom-block";s:18:"module_description";a:3:{i:1;a:2:{s:5:"title";s:12:"bottom-block";s:11:"description";s:599:"&lt;div class=&quot;container&quot;&gt;\r\n&lt;div class=&quot;row&quot;&gt;\r\n&lt;div class=&quot;col-sm-12&quot;&gt;\r\n&lt;div class=&quot;bottom-block-tx&quot;&gt;\r\n&lt;a href=&quot;index.php?route=account/voucher&quot;&gt;\r\n&lt;span class=&quot;tx-title&quot;&gt;Clearance&lt;/span&gt;&lt;span class=&quot;tx-block&quot;&gt;&lt;span&gt;&lt;span class=&quot;tx1&quot;&gt;get up to 50% off&lt;/span&gt; &lt;span&gt;lorem ipsum dolor sit amet conse ctetur adipisici&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\r\n&lt;/a&gt;\r\n&lt;/div&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;/div&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;/div&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;/div&gt;";}i:2;a:2:{s:5:"title";s:12:"bottom-block";s:11:"description";s:599:"&lt;div class=&quot;container&quot;&gt;\r\n&lt;div class=&quot;row&quot;&gt;\r\n&lt;div class=&quot;col-sm-12&quot;&gt;\r\n&lt;div class=&quot;bottom-block-tx&quot;&gt;\r\n&lt;a href=&quot;index.php?route=account/voucher&quot;&gt;\r\n&lt;span class=&quot;tx-title&quot;&gt;Clearance&lt;/span&gt;&lt;span class=&quot;tx-block&quot;&gt;&lt;span&gt;&lt;span class=&quot;tx1&quot;&gt;get up to 50% off&lt;/span&gt; &lt;span&gt;lorem ipsum dolor sit amet conse ctetur adipisici&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\r\n&lt;/a&gt;\r\n&lt;/div&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;/div&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;/div&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;/div&gt;";}i:3;a:2:{s:5:"title";s:12:"bottom-block";s:11:"description";s:599:"&lt;div class=&quot;container&quot;&gt;\r\n&lt;div class=&quot;row&quot;&gt;\r\n&lt;div class=&quot;col-sm-12&quot;&gt;\r\n&lt;div class=&quot;bottom-block-tx&quot;&gt;\r\n&lt;a href=&quot;index.php?route=account/voucher&quot;&gt;\r\n&lt;span class=&quot;tx-title&quot;&gt;Clearance&lt;/span&gt;&lt;span class=&quot;tx-block&quot;&gt;&lt;span&gt;&lt;span class=&quot;tx1&quot;&gt;get up to 50% off&lt;/span&gt; &lt;span&gt;lorem ipsum dolor sit amet conse ctetur adipisici&lt;/span&gt;&lt;/span&gt;&lt;/span&gt;\r\n&lt;/a&gt;\r\n&lt;/div&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;/div&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;/div&gt;\r\n\r\n\r\n\r\n\r\n\r\n&lt;/div&gt;";}}s:6:"status";s:1:"1";}'),
(46, 'Tm Slideshow', 'tm_slideshow', 'a:5:{s:4:"name";s:12:"Tm Slideshow";s:9:"banner_id";s:2:"15";s:5:"width";s:3:"870";s:6:"height";s:3:"549";s:6:"status";s:1:"1";}'),
(43, 'Bestsellers', 'bestseller', 'a:5:{s:4:"name";s:11:"Bestsellers";s:5:"limit";s:1:"1";s:5:"width";s:3:"268";s:6:"height";s:3:"268";s:6:"status";s:1:"1";}'),
(44, 'Latest Products', 'latest', 'a:5:{s:4:"name";s:15:"Latest Products";s:5:"limit";s:1:"1";s:5:"width";s:3:"268";s:6:"height";s:3:"268";s:6:"status";s:1:"1";}'),
(45, 'Specials', 'special', 'a:5:{s:4:"name";s:8:"Specials";s:5:"limit";s:1:"2";s:5:"width";s:3:"268";s:6:"height";s:3:"268";s:6:"status";s:1:"1";}');

-- --------------------------------------------------------

--
-- Table structure for table `oc_setting`
--

DROP TABLE IF EXISTS `oc_setting`;
CREATE TABLE `oc_setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(32) NOT NULL,
  `key` varchar(64) NOT NULL,
  `value` text NOT NULL,
  `serialized` tinyint(1) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4707 ;

--
-- Dumping data for table `oc_setting`
--

INSERT INTO `oc_setting` (`setting_id`, `store_id`, `code`, `key`, `value`, `serialized`) VALUES
(1, 0, 'shipping', 'shipping_sort_order', '3', 0),
(2, 0, 'sub_total', 'sub_total_sort_order', '1', 0),
(3, 0, 'sub_total', 'sub_total_status', '1', 0),
(4, 0, 'tax', 'tax_status', '1', 0),
(5, 0, 'total', 'total_sort_order', '9', 0),
(6, 0, 'total', 'total_status', '1', 0),
(7, 0, 'tax', 'tax_sort_order', '5', 0),
(8, 0, 'free_checkout', 'free_checkout_sort_order', '1', 0),
(9, 0, 'cod', 'cod_sort_order', '5', 0),
(10, 0, 'cod', 'cod_total', '0.01', 0),
(11, 0, 'cod', 'cod_order_status_id', '1', 0),
(12, 0, 'cod', 'cod_geo_zone_id', '0', 0),
(13, 0, 'cod', 'cod_status', '1', 0),
(14, 0, 'shipping', 'shipping_status', '1', 0),
(15, 0, 'shipping', 'shipping_estimator', '1', 0),
(27, 0, 'coupon', 'coupon_sort_order', '4', 0),
(28, 0, 'coupon', 'coupon_status', '1', 0),
(34, 0, 'flat', 'flat_sort_order', '1', 0),
(35, 0, 'flat', 'flat_status', '1', 0),
(36, 0, 'flat', 'flat_geo_zone_id', '0', 0),
(37, 0, 'flat', 'flat_tax_class_id', '9', 0),
(41, 0, 'flat', 'flat_cost', '5.00', 0),
(42, 0, 'credit', 'credit_sort_order', '7', 0),
(43, 0, 'credit', 'credit_status', '1', 0),
(53, 0, 'reward', 'reward_sort_order', '2', 0),
(54, 0, 'reward', 'reward_status', '1', 0),
(837, 0, 'category', 'category_status', '1', 0),
(158, 0, 'account', 'account_status', '1', 0),
(954, 0, 'affiliate', 'affiliate_status', '1', 0),
(94, 0, 'voucher', 'voucher_sort_order', '8', 0),
(95, 0, 'voucher', 'voucher_status', '1', 0),
(103, 0, 'free_checkout', 'free_checkout_status', '1', 0),
(104, 0, 'free_checkout', 'free_checkout_order_status_id', '1', 0),
(4706, 0, 'config', 'config_google_analytics', '', 0),
(4705, 0, 'config', 'config_error_filename', 'error.log', 0),
(4704, 0, 'config', 'config_error_log', '1', 0),
(4703, 0, 'config', 'config_error_display', '1', 0),
(4699, 0, 'config', 'config_maintenance', '0', 0),
(4700, 0, 'config', 'config_password', '1', 0),
(4701, 0, 'config', 'config_encryption', '756f1ab82eef761d6adce69503a0412a', 0),
(4702, 0, 'config', 'config_compression', '0', 0),
(4697, 0, 'config', 'config_file_ext_allowed', 'txt\r\npng\r\njpe\r\njpeg\r\njpg\r\ngif\r\nbmp\r\nico\r\ntiff\r\ntif\r\nsvg\r\nsvgz\r\nzip\r\nrar\r\nmsi\r\ncab\r\nmp3\r\nqt\r\nmov\r\npdf\r\npsd\r\nai\r\neps\r\nps\r\ndoc\r\nrtf\r\nxls\r\nppt\r\nodt\r\nods', 0),
(4698, 0, 'config', 'config_file_mime_allowed', 'text/plain\r\nimage/png\r\nimage/jpeg\r\nimage/gif\r\nimage/bmp\r\nimage/vnd.microsoft.icon\r\nimage/tiff\r\nimage/svg+xml\r\napplication/zip\r\napplication/x-rar-compressed\r\napplication/x-msdownload\r\napplication/vnd.ms-cab-compressed\r\naudio/mpeg\r\nvideo/quicktime\r\napplication/pdf\r\nimage/vnd.adobe.photoshop\r\napplication/postscript\r\napplication/msword\r\napplication/rtf\r\napplication/vnd.ms-excel\r\napplication/vnd.ms-powerpoint\r\napplication/vnd.oasis.opendocument.text\r\napplication/vnd.oasis.opendocument.spreadsheet', 0),
(4695, 0, 'config', 'config_seo_url', '0', 0),
(4696, 0, 'config', 'config_file_max_size', '300000', 0),
(4692, 0, 'config', 'config_secure', '0', 0),
(4693, 0, 'config', 'config_shared', '0', 0),
(4694, 0, 'config', 'config_robots', 'abot\r\ndbot\r\nebot\r\nhbot\r\nkbot\r\nlbot\r\nmbot\r\nnbot\r\nobot\r\npbot\r\nrbot\r\nsbot\r\ntbot\r\nvbot\r\nybot\r\nzbot\r\nbot.\r\nbot/\r\n_bot\r\n.bot\r\n/bot\r\n-bot\r\n:bot\r\n(bot\r\ncrawl\r\nslurp\r\nspider\r\nseek\r\naccoona\r\nacoon\r\nadressendeutschland\r\nah-ha.com\r\nahoy\r\naltavista\r\nananzi\r\nanthill\r\nappie\r\narachnophilia\r\narale\r\naraneo\r\naranha\r\narchitext\r\naretha\r\narks\r\nasterias\r\natlocal\r\natn\r\natomz\r\naugurfind\r\nbackrub\r\nbannana_bot\r\nbaypup\r\nbdfetch\r\nbig brother\r\nbiglotron\r\nbjaaland\r\nblackwidow\r\nblaiz\r\nblog\r\nblo.\r\nbloodhound\r\nboitho\r\nbooch\r\nbradley\r\nbutterfly\r\ncalif\r\ncassandra\r\nccubee\r\ncfetch\r\ncharlotte\r\nchurl\r\ncienciaficcion\r\ncmc\r\ncollective\r\ncomagent\r\ncombine\r\ncomputingsite\r\ncsci\r\ncurl\r\ncusco\r\ndaumoa\r\ndeepindex\r\ndelorie\r\ndepspid\r\ndeweb\r\ndie blinde kuh\r\ndigger\r\nditto\r\ndmoz\r\ndocomo\r\ndownload express\r\ndtaagent\r\ndwcp\r\nebiness\r\nebingbong\r\ne-collector\r\nejupiter\r\nemacs-w3 search engine\r\nesther\r\nevliya celebi\r\nezresult\r\nfalcon\r\nfelix ide\r\nferret\r\nfetchrover\r\nfido\r\nfindlinks\r\nfireball\r\nfish search\r\nfouineur\r\nfunnelweb\r\ngazz\r\ngcreep\r\ngenieknows\r\ngetterroboplus\r\ngeturl\r\nglx\r\ngoforit\r\ngolem\r\ngrabber\r\ngrapnel\r\ngralon\r\ngriffon\r\ngromit\r\ngrub\r\ngulliver\r\nhamahakki\r\nharvest\r\nhavindex\r\nhelix\r\nheritrix\r\nhku www octopus\r\nhomerweb\r\nhtdig\r\nhtml index\r\nhtml_analyzer\r\nhtmlgobble\r\nhubater\r\nhyper-decontextualizer\r\nia_archiver\r\nibm_planetwide\r\nichiro\r\niconsurf\r\niltrovatore\r\nimage.kapsi.net\r\nimagelock\r\nincywincy\r\nindexer\r\ninfobee\r\ninformant\r\ningrid\r\ninktomisearch.com\r\ninspector web\r\nintelliagent\r\ninternet shinchakubin\r\nip3000\r\niron33\r\nisraeli-search\r\nivia\r\njack\r\njakarta\r\njavabee\r\njetbot\r\njumpstation\r\nkatipo\r\nkdd-explorer\r\nkilroy\r\nknowledge\r\nkototoi\r\nkretrieve\r\nlabelgrabber\r\nlachesis\r\nlarbin\r\nlegs\r\nlibwww\r\nlinkalarm\r\nlink validator\r\nlinkscan\r\nlockon\r\nlwp\r\nlycos\r\nmagpie\r\nmantraagent\r\nmapoftheinternet\r\nmarvin/\r\nmattie\r\nmediafox\r\nmediapartners\r\nmercator\r\nmerzscope\r\nmicrosoft url control\r\nminirank\r\nmiva\r\nmj12\r\nmnogosearch\r\nmoget\r\nmonster\r\nmoose\r\nmotor\r\nmultitext\r\nmuncher\r\nmuscatferret\r\nmwd.search\r\nmyweb\r\nnajdi\r\nnameprotect\r\nnationaldirectory\r\nnazilla\r\nncsa beta\r\nnec-meshexplorer\r\nnederland.zoek\r\nnetcarta webmap engine\r\nnetmechanic\r\nnetresearchserver\r\nnetscoop\r\nnewscan-online\r\nnhse\r\nnokia6682/\r\nnomad\r\nnoyona\r\nnutch\r\nnzexplorer\r\nobjectssearch\r\noccam\r\nomni\r\nopen text\r\nopenfind\r\nopenintelligencedata\r\norb search\r\nosis-project\r\npack rat\r\npageboy\r\npagebull\r\npage_verifier\r\npanscient\r\nparasite\r\npartnersite\r\npatric\r\npear.\r\npegasus\r\nperegrinator\r\npgp key agent\r\nphantom\r\nphpdig\r\npicosearch\r\npiltdownman\r\npimptrain\r\npinpoint\r\npioneer\r\npiranha\r\nplumtreewebaccessor\r\npogodak\r\npoirot\r\npompos\r\npoppelsdorf\r\npoppi\r\npopular iconoclast\r\npsycheclone\r\npublisher\r\npython\r\nrambler\r\nraven search\r\nroach\r\nroad runner\r\nroadhouse\r\nrobbie\r\nrobofox\r\nrobozilla\r\nrules\r\nsalty\r\nsbider\r\nscooter\r\nscoutjet\r\nscrubby\r\nsearch.\r\nsearchprocess\r\nsemanticdiscovery\r\nsenrigan\r\nsg-scout\r\nshai''hulud\r\nshark\r\nshopwiki\r\nsidewinder\r\nsift\r\nsilk\r\nsimmany\r\nsite searcher\r\nsite valet\r\nsitetech-rover\r\nskymob.com\r\nsleek\r\nsmartwit\r\nsna-\r\nsnappy\r\nsnooper\r\nsohu\r\nspeedfind\r\nsphere\r\nsphider\r\nspinner\r\nspyder\r\nsteeler/\r\nsuke\r\nsuntek\r\nsupersnooper\r\nsurfnomore\r\nsven\r\nsygol\r\nszukacz\r\ntach black widow\r\ntarantula\r\ntempleton\r\n/teoma\r\nt-h-u-n-d-e-r-s-t-o-n-e\r\ntheophrastus\r\ntitan\r\ntitin\r\ntkwww\r\ntoutatis\r\nt-rex\r\ntutorgig\r\ntwiceler\r\ntwisted\r\nucsd\r\nudmsearch\r\nurl check\r\nupdated\r\nvagabondo\r\nvalkyrie\r\nverticrawl\r\nvictoria\r\nvision-search\r\nvolcano\r\nvoyager/\r\nvoyager-hc\r\nw3c_validator\r\nw3m2\r\nw3mir\r\nwalker\r\nwallpaper\r\nwanderer\r\nwauuu\r\nwavefire\r\nweb core\r\nweb hopper\r\nweb wombat\r\nwebbandit\r\nwebcatcher\r\nwebcopy\r\nwebfoot\r\nweblayers\r\nweblinker\r\nweblog monitor\r\nwebmirror\r\nwebmonkey\r\nwebquest\r\nwebreaper\r\nwebsitepulse\r\nwebsnarf\r\nwebstolperer\r\nwebvac\r\nwebwalk\r\nwebwatch\r\nwebwombat\r\nwebzinger\r\nwhizbang\r\nwhowhere\r\nwild ferret\r\nworldlight\r\nwwwc\r\nwwwster\r\nxenu\r\nxget\r\nxift\r\nxirq\r\nyandex\r\nyanga\r\nyeti\r\nyodao\r\nzao\r\nzippp\r\nzyborg', 0),
(4691, 0, 'config', 'config_fraud_status_id', '7', 0),
(4690, 0, 'config', 'config_fraud_score', '', 0),
(4689, 0, 'config', 'config_fraud_key', '', 0),
(4688, 0, 'config', 'config_fraud_detection', '0', 0),
(4687, 0, 'config', 'config_mail_alert', '', 0),
(4684, 0, 'config', 'config_ftp_root', '', 0),
(4685, 0, 'config', 'config_ftp_status', '0', 0),
(4686, 0, 'config', 'config_mail', 'a:7:{s:8:"protocol";s:4:"mail";s:9:"parameter";s:0:"";s:13:"smtp_hostname";s:0:"";s:13:"smtp_username";s:0:"";s:13:"smtp_password";s:0:"";s:9:"smtp_port";s:0:"";s:12:"smtp_timeout";s:0:"";}', 1),
(4683, 0, 'config', 'config_ftp_password', '', 0),
(4682, 0, 'config', 'config_ftp_username', '', 0),
(4681, 0, 'config', 'config_ftp_port', '21', 0),
(4680, 0, 'config', 'config_ftp_hostname', '192.168.9.2', 0),
(4679, 0, 'config', 'config_image_location_height', '50', 0),
(4678, 0, 'config', 'config_image_location_width', '268', 0),
(4677, 0, 'config', 'config_image_cart_height', '47', 0),
(4676, 0, 'config', 'config_image_cart_width', '47', 0),
(4675, 0, 'config', 'config_image_wishlist_height', '47', 0),
(4674, 0, 'config', 'config_image_wishlist_width', '47', 0),
(4673, 0, 'config', 'config_image_compare_height', '90', 0),
(4672, 0, 'config', 'config_image_compare_width', '90', 0),
(4671, 0, 'config', 'config_image_related_height', '221', 0),
(4670, 0, 'config', 'config_image_related_width', '221', 0),
(839, 0, 'tm_category', 'tm_category_status', '1', 0),
(4669, 0, 'config', 'config_image_additional_height', '88', 0),
(4668, 0, 'config', 'config_image_additional_width', '88', 0),
(4667, 0, 'config', 'config_image_product_height', '268', 0),
(4666, 0, 'config', 'config_image_product_width', '268', 0),
(4665, 0, 'config', 'config_image_popup_height', '800', 0),
(4663, 0, 'config', 'config_image_thumb_height', '800', 0),
(4664, 0, 'config', 'config_image_popup_width', '800', 0),
(4662, 0, 'config', 'config_image_thumb_width', '800', 0),
(4661, 0, 'config', 'config_image_category_height', '190', 0),
(4660, 0, 'config', 'config_image_category_width', '190', 0),
(4659, 0, 'config', 'config_icon', 'catalog/favicon.png', 0),
(4658, 0, 'config', 'config_logo', 'catalog/logo.png', 0),
(4656, 0, 'config', 'config_return_id', '0', 0),
(4657, 0, 'config', 'config_return_status_id', '2', 0),
(4655, 0, 'config', 'config_affiliate_mail', '0', 0),
(4654, 0, 'config', 'config_affiliate_id', '4', 0),
(4653, 0, 'config', 'config_affiliate_commission', '5', 0),
(4652, 0, 'config', 'config_affiliate_auto', '0', 0),
(4651, 0, 'config', 'config_affiliate_approval', '0', 0),
(4650, 0, 'config', 'config_stock_checkout', '0', 0),
(4649, 0, 'config', 'config_stock_warning', '0', 0),
(4648, 0, 'config', 'config_stock_display', '0', 0),
(4647, 0, 'config', 'config_order_mail', '0', 0),
(4646, 0, 'config', 'config_complete_status', 'a:1:{i:0;s:1:"5";}', 1),
(4644, 0, 'config', 'config_order_status_id', '1', 0),
(4645, 0, 'config', 'config_processing_status', 'a:1:{i:0;s:1:"2";}', 1),
(4643, 0, 'config', 'config_checkout_id', '5', 0),
(4642, 0, 'config', 'config_checkout_guest', '1', 0),
(4641, 0, 'config', 'config_cart_weight', '1', 0),
(4640, 0, 'config', 'config_api_id', '5', 0),
(4639, 0, 'config', 'config_invoice_prefix', 'INV-2013-00', 0),
(4638, 0, 'config', 'config_account_mail', '0', 0),
(4637, 0, 'config', 'config_account_id', '3', 0),
(4636, 0, 'config', 'config_login_attempts', '5', 0),
(4635, 0, 'config', 'config_customer_price', '0', 0),
(4634, 0, 'config', 'config_customer_group_display', 'a:1:{i:0;s:1:"1";}', 1),
(4633, 0, 'config', 'config_customer_group_id', '1', 0),
(4632, 0, 'config', 'config_customer_online', '0', 0),
(4631, 0, 'config', 'config_tax_customer', 'shipping', 0),
(4630, 0, 'config', 'config_tax_default', 'shipping', 0),
(4629, 0, 'config', 'config_tax', '0', 0),
(4628, 0, 'config', 'config_voucher_max', '1000', 0),
(4627, 0, 'config', 'config_voucher_min', '1', 0),
(4626, 0, 'config', 'config_review_mail', '0', 0),
(4625, 0, 'config', 'config_review_guest', '1', 0),
(4624, 0, 'config', 'config_review_status', '1', 0),
(4623, 0, 'config', 'config_limit_admin', '20', 0),
(4622, 0, 'config', 'config_product_description_length', '267', 0),
(4621, 0, 'config', 'config_product_limit', '6', 0),
(4620, 0, 'config', 'config_product_count', '1', 0),
(4619, 0, 'config', 'config_weight_class_id', '1', 0),
(4618, 0, 'config', 'config_length_class_id', '1', 0),
(4617, 0, 'config', 'config_currency_auto', '1', 0),
(4616, 0, 'config', 'config_currency', 'USD', 0),
(4615, 0, 'config', 'config_admin_language', 'en', 0),
(4614, 0, 'config', 'config_language', 'en', 0),
(4613, 0, 'config', 'config_zone_id', '3563', 0),
(4612, 0, 'config', 'config_country_id', '222', 0),
(4611, 0, 'config', 'config_layout_id', '4', 0),
(4610, 0, 'config', 'config_template', 'theme511', 0),
(4609, 0, 'config', 'config_meta_keyword', '', 0),
(4608, 0, 'config', 'config_meta_description', 'PrintStore online store', 0),
(4602, 0, 'config', 'config_telephone', '800-2345-6789', 0),
(4607, 0, 'config', 'config_meta_title', 'PrintStore online store', 0),
(4606, 0, 'config', 'config_comment', 'Aenean mattis efficitur metus eget ornare.', 0),
(4604, 0, 'config', 'config_image', '', 0),
(4605, 0, 'config', 'config_open', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 0),
(4603, 0, 'config', 'config_fax', '800-2345-6790', 0),
(4601, 0, 'config', 'config_email', 'admin@demolink.org', 0),
(4597, 0, 'config', 'config_name', 'PrintStore online store', 0),
(4598, 0, 'config', 'config_owner', 'PrintStore online store', 0),
(4599, 0, 'config', 'config_address', '4578 Marmora Road,Glasgow D04 89GR', 0),
(4600, 0, 'config', 'config_geocode', '42.3317600  -71.1211600', 0);


