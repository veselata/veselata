-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 14, 2015 at 11:42 AM
-- Server version: 5.5.43-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `solution`
--

-- --------------------------------------------------------

--
-- Table structure for table `boxes`
--

CREATE TABLE IF NOT EXISTS `boxes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text,
  `position` tinyint(1) unsigned NOT NULL,
  `sort_order` int(11) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `boxes`
--

INSERT INTO `boxes` (`id`, `title`, `description`, `position`, `sort_order`, `status`, `created_at`) VALUES
(1, 'About', '<p>My name is Veselina Spasova and this is a showcase of some of my personal projects. If you have any questions, feel free to <a href="/contact">contact me</a>.</p>', 2, 6, 1, '2014-10-08 16:03:52'),
(2, 'Get in touch', '<div class="item-row"><span class="glyphicon glyphicon-user"></span>Name</div>\n<p>Veselina Spasova</p>\n<div class="item-row"><span class="glyphicon glyphicon-envelope"></span>email</div>\n<p>vesi.spasova@gmail.com</p>\n<div class="item-row"><span class="glyphicon glyphicon glyphicon-phone-alt"></span>phone</div>\n<p>+ (359) 889 / 692923</p>\n<div class="item-row"><span class="glyphicon glyphicon glyphicon-home"></span>address</div>\n<p>Bulgaria, Sofia</p>', 2, 2, 1, '2014-10-08 13:37:58'),
(3, 'Send a message', '<p>Please use this <a href="/contact">form</a> to send me any comments or queries you may have. </p>', 1, 5, 1, '2014-10-08 16:10:13'),
(4, 'Download my CV', '<p>Don''t hesitate to download my resume.</p>\r\n<p class="download-content"><a href="/download/cv.pdf"><span class="glyphicon glyphicon-save"></span>Download</a></p>', 1, 4, 1, '2014-10-08 16:12:08'),
(5, 'Find me', '<ul class="aside-social clearfix">\n    <li><a class="btn btn-social-icon btn-github" href="https://github.com/veselata/" target="_blank">\n            <i class="fa fa-github"></i>\n        </a>\n    </li>\n    <li><a class="btn btn-social-icon btn-google-plus" href="https://plus.google.com/+VeselinaSpasova23" target="_blank">\n            <i class="fa fa-google-plus"></i>\n        </a>\n    </li>\n    <li><a class="btn btn-social-icon btn-linkedin" href="https://www.linkedin.com/in/veselinaspasova" target="_blank">\n            <i class="fa fa-linkedin"></i>\n        </a>\n    </li>\n    <li><a class="btn btn-social-icon btn-twitter" href="https://twitter.com/veselata" target="_blank">\n            <i class="fa fa-twitter"></i>\n        </a>\n    </li>\n</ul>\n', 1, 3, 1, '2014-10-08 16:12:58'),
(6, 'Personal traits', '<ul><li>Likes to take on challenges</li><li>Passion for creative new products and business ideas</li><li>Learn and apply quick new concept, technologies and tools</li><li>Practices clean and easy to read coding styles</li></ul>', 3, 1, 1, '2014-11-03 13:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text,
  `ip` varchar(32) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `subject`, `message`, `ip`, `created_at`) VALUES
(1, 'Veselina Spasova', 'veselina_spasova@abv.bg', 'Value is required and can''t be empty', 'Value is required and can''t be empty\r\nValue is required and can''t be empty\r\nValue is required and can''t be empty\r\nValue is required and can''t be empty\r\nValue is required and can''t be empty\r\nValue is required and can''t be empty\r\nValue is required and can''t be empty', '127.0.0.1', '2015-05-11 14:26:23');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` tinyint(1) unsigned NOT NULL,
  `item_id` int(11) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `file` varchar(255) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `sort_order` int(11) unsigned NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item_id` (`item_id`),
  KEY `item_id_2` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `type`, `item_id`, `title`, `file`, `status`, `sort_order`, `created_at`) VALUES
(1, 1, 1, 'Alerad', 'alerad.png', 1, 1, '2014-10-10 20:20:50'),
(2, 1, 1, 'Alerad', 'alerad1.png', 1, 2, '2014-10-11 18:16:00'),
(3, 1, 2, 'Terishop', 'terishop.png', 1, 3, '2014-10-11 18:17:14'),
(4, 1, 2, 'Terishop', 'terishop1.png', 1, 4, '2014-10-11 18:17:28'),
(5, 1, 3, 'Animalsbg', 'animalsbg.png', 1, 5, '2014-10-11 18:18:19'),
(6, 1, 3, 'Animalsbg', 'animalsbg1.png', 1, 6, '2014-10-11 18:18:29'),
(7, 1, 4, 'Enso', 'enso.png', 1, 7, '2014-10-11 18:23:07'),
(8, 1, 4, 'Enso', 'enso1.png', 1, 8, '2014-10-11 18:23:15'),
(9, 1, 5, 'solution', 'solution.png', 1, 9, '2014-10-11 18:24:01'),
(10, 1, 5, 'solution', 'solution1.png', 1, 10, '2014-10-11 18:24:09'),
(11, 1, 5, 'solution', 'solution2.png', 1, 11, '2014-10-11 18:24:26'),
(12, 1, 5, 'solution', 'solution3.png', 1, 12, '2014-10-11 18:24:37'),
(13, 1, 6, 'E-advokat', 'e-advokat.png', 1, 13, '2014-10-11 18:25:29'),
(14, 1, 6, 'E-advokat', 'e-advokat1.png', 1, 14, '2014-10-11 18:25:37'),
(15, 1, 7, 'Veselata', 'veselata.png', 1, 15, '2014-10-11 18:26:18'),
(16, 1, 7, 'Veselata', 'veselata1.png', 1, 16, '2014-10-11 18:26:27'),
(17, 1, 7, 'Veselata', 'veselata2.png', 1, 17, '2014-10-11 18:26:40');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip` varchar(32) NOT NULL,
  `extra` text,
  `is_blocked` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `is_track` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `item_id` int(11) unsigned DEFAULT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ip` (`ip`),
  KEY `is_track` (`is_track`),
  KEY `is_blocked` (`is_blocked`),
  KEY `item_id` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `ip`, `extra`, `is_blocked`, `is_track`, `item_id`, `created_at`) VALUES
(1, '127.0.0.1', '{"REDIRECT_STATUS":"200","HTTP_HOST":"solution.localhost","HTTP_USER_AGENT":"Mozilla\\/5.0 (X11; Ubuntu; Linux x86_64; rv:37.0) Gecko\\/20100101 Firefox\\/37.0","HTTP_ACCEPT":"text\\/html,application\\/xhtml+xml,application\\/xml;q=0.9,*\\/*;q=0.8","HTTP_ACCEPT_LANGUAGE":"en-US,en;q=0.5","HTTP_ACCEPT_ENCODING":"gzip, deflate","HTTP_REFERER":"http:\\/\\/solution.localhost\\/adminarea\\/","HTTP_COOKIE":"PHPSESSID=6e0ef56ff2a714d64879cc3404bf2ee7","HTTP_CONNECTION":"keep-alive","CONTENT_TYPE":"application\\/x-www-form-urlencoded","CONTENT_LENGTH":"120","PATH":"\\/usr\\/local\\/sbin:\\/usr\\/local\\/bin:\\/usr\\/sbin:\\/usr\\/bin:\\/sbin:\\/bin","SERVER_SIGNATURE":"\\u003Caddress\\u003EApache\\/2.4.7 (Ubuntu) Server at solution.localhost Port 80\\u003C\\/address\\u003E\\n","SERVER_SOFTWARE":"Apache\\/2.4.7 (Ubuntu)","SERVER_NAME":"solution.localhost","SERVER_ADDR":"127.0.1.1","SERVER_PORT":"80","REMOTE_ADDR":"127.0.0.1","DOCUMENT_ROOT":"\\/home\\/veselina\\/www\\/solution\\/public","REQUEST_SCHEME":"http","CONTEXT_PREFIX":"","CONTEXT_DOCUMENT_ROOT":"\\/home\\/veselina\\/www\\/solution\\/public","SERVER_ADMIN":"webmaster@localhost","SCRIPT_FILENAME":"\\/home\\/veselina\\/www\\/solution\\/public\\/index.php","REMOTE_PORT":"43637","REDIRECT_URL":"\\/adminarea\\/","GATEWAY_INTERFACE":"CGI\\/1.1","SERVER_PROTOCOL":"HTTP\\/1.1","REQUEST_METHOD":"POST","QUERY_STRING":"","REQUEST_URI":"\\/adminarea\\/","SCRIPT_NAME":"\\/index.php","PHP_SELF":"\\/index.php","REQUEST_TIME_FLOAT":1430823005.061,"REQUEST_TIME":1430823005,"argv":[],"argc":0}', 0, 0, NULL, '2015-05-05 13:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) unsigned NOT NULL DEFAULT '0',
  `menu` tinyint(1) unsigned NOT NULL,
  `route` varchar(255) DEFAULT NULL,
  `controller` varchar(100) DEFAULT NULL,
  `action` varchar(100) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `sort_order` int(11) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `parent_id`, `menu`, `route`, `controller`, `action`, `title`, `description`, `sort_order`, `status`, `created_at`) VALUES
(1, 0, 1, 'home', NULL, 'index', 'Home', '<p>As an enthusiastic and self-motivated developer, I feel balanced on front-end and back-end of web application development. Over the years, I had participant in develop, customization and maintains of web based application and my main focus is to fulfill client and business requirements. I am able to learn and apply quick new concept, technologies and development tools.</p>\n<h4>Technical Skills</h4>\n<ul>\n    <li>PHP(OOP), MySQL, Ajax, JavaScript, HTML, CSS, XML, JSON, automating tests(PHPUnit)</li>\n    <li>PHP Frameworks: Zend (1, 2), Yii, Slim</li>\n    <li>ORMs and DB Abstraction Layers: Doctrine</li>\n    <li>Template Engines: Smarty, Twig</li>\n    <li>JavaScript Libraries / Frameworks: jQuery, jQuery UI, Sencha ExtJs</li>\n</ul>\n<h4>Services</h4>\n<ul>\n    <li>Dynamic website development and customization  - includes coding and database design</li>\n    <li>Website maintenance - enhancing existing applications, editing content, fixing bugs, adding new functionalities and utilities for more interactivity</li>\n    <li>Customer service - close correspondence with customers to solve problems and queries</li>\n    <li>Website Marketing - online website promotion and search engine placement and optimisation</li>\n</ul>', 4, 1, '2014-10-03 00:00:00'),
(2, 0, 1, 'contact', NULL, 'index', 'Contact', '<p>You may leave a message using the form below and I''ll get back to you as soon as possible.</p>', 3, 1, '2014-10-03 12:38:06'),
(3, 0, 1, 'project', NULL, 'index', 'Projects', NULL, 2, 1, '2014-10-15 13:17:49'),
(4, 3, 1, 'project', NULL, 'view', 'Project Details', NULL, 1, 1, '2014-10-15 13:22:19');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `url` varchar(100) DEFAULT NULL,
  `thumb` varchar(255) NOT NULL,
  `likes` int(11) unsigned NOT NULL DEFAULT '0',
  `sort_order` int(11) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `name`, `description`, `url`, `thumb`, `likes`, `sort_order`, `status`, `created_at`) VALUES
(1, 'Alerad', '<p>Alerad is a small supplier of laminate, parquet floor and laminate floor accessories available in many different looks, styles, and textures. A small small company webiste to search and find laminate type that fit your need.</p>\n<p><strong>Used Technologies:</strong>\nPHP, MySQL, HTML, Jquery, CSS</p>\n', NULL, 'alerad.png', 0, 1, 1, '2014-10-09 12:36:41'),
(2, 'Terishop', '<p>Terishop in online store with free shipping anywhere in the world</p>\n<p><strong>Used Technologies:</strong>\nPHP, MySQL, HTML, Jquery, CSS</p>', NULL, 'terishop.png', 0, 2, 1, '2014-10-10 19:12:32'),
(3, 'Animalsbg', '<p>Animalsbg aims to provide a useful and interesting information about animals and your pet</p><p><strong>Used Technologies:</strong>\nPHP/ZF1, MySQL, HTML, Ajax, JQuery, CSSS</p>', 'http://animalsbg.com/', 'animalsbg.png', 0, 3, 1, '2014-10-09 12:36:41'),
(4, 'Ensotool', '<p>Enso is a simple website monitoring tool for my personal use.</p> \n<p><strong>Used Technologies:</strong>\nPHP/Slim, MySQL, HTML, Jquery, CSS</p>', 'http://ensotool.veselata.com', 'ensotool.png', 0, 4, 1, '2014-10-10 19:09:18'),
(5, 'Solution', '<p>Solution in my custom CMS</p>\n<p><strong>Used Technologies:</strong>\nPHP/ZF1, MySQL, HTML, Ajax, JQuery, CSSS</p>', 'http://solution.veselata.com/', 'solution.png', 0, 5, 1, '2014-10-10 19:11:09'),
(6, 'E-advokat', '<p>E-advokat - a web portal with resources of interest of legal advice and law guide.</p><p><strong>Used Technologies:</strong>\nPHP/ZF1, MySQL, HTML, Ajax, JQuery, CSSS</p>', 'http://e-advokat.bg', 'e-advokat.png', 0, 6, 1, '2014-10-10 19:14:03'),
(7, 'Veselata', '<p>Veselata - my old personal website</p><p><strong>Used Technologies:</strong>\nPHP/ZF2, MySQL, HTML,', 'http://veseto.ensotool.com/', 'veselata.png', 0, 7, 1, '2014-10-10 19:14:50');

-- --------------------------------------------------------

--
-- Table structure for table `project_tags`
--

CREATE TABLE IF NOT EXISTS `project_tags` (
  `project_id` int(11) unsigned NOT NULL,
  `tag_id` int(11) unsigned NOT NULL,
  KEY `project_id` (`project_id`,`tag_id`),
  KEY `tag_id` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project_tags`
--

INSERT INTO `project_tags` (`project_id`, `tag_id`) VALUES
(1, 3),
(1, 4),
(2, 3),
(3, 1),
(3, 2),
(4, 1),
(4, 4),
(5, 1),
(6, 1),
(6, 2),
(7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `sort_order`, `status`, `created_at`) VALUES
(1, 'web', 5, 1, '2014-10-06 16:07:49'),
(2, 'personal', 4, 1, '2014-10-06 16:08:15'),
(3, 'e-commerce', 3, 1, '2014-10-06 16:09:06'),
(4, 'nonprofit', 2, 1, '2014-10-06 16:09:33'),
(5, 'other', 1, 1, '2014-10-11 14:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type` tinyint(1) unsigned NOT NULL,
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `status`, `created_at`) VALUES
(1, 'Veselina', 'veselina', '$2y$10$2NmU6sSb7bRZkjYP3dmFJuoAJQg87ruUIwJ9tu7AW02Xt5gvbcVmy', 2, 1, '2014-09-30 00:00:00');

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `projects` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `project_tags`
--
ALTER TABLE `project_tags`
  ADD CONSTRAINT `project_tags_ibfk_1` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `project_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
