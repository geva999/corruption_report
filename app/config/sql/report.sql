-- phpMyAdmin SQL Dump
-- version 3.3.7deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 05, 2010 at 04:14 PM
-- Server version: 5.1.49
-- PHP Version: 5.3.3-1ubuntu9.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_report`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `report_id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `todelete` tinyint(1) DEFAULT '0',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `celems`
--

CREATE TABLE IF NOT EXISTS `celems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `celem` varchar(255) NOT NULL,
  `number` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `celemgroup` varchar(255) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `number` (`number`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `experts`
--

CREATE TABLE IF NOT EXISTS `experts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `isadmin` tinyint(1) NOT NULL DEFAULT '0',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pelems`
--

CREATE TABLE IF NOT EXISTS `pelems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `celem_id` int(10) unsigned NOT NULL,
  `number` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projectexperts`
--

CREATE TABLE IF NOT EXISTS `projectexperts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `expert_id` int(10) NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expert_id` int(10) unsigned NOT NULL,
  `author_id` int(10) unsigned NOT NULL DEFAULT '0',
  `name` text NOT NULL,
  `namesolicitare` text,
  `projecttype` varchar(100) NOT NULL,
  `projecttypevizat` varchar(100) NOT NULL,
  `projectdomain` varchar(255) NOT NULL,
  `projectnumber` varchar(15) DEFAULT NULL,
  `projectdate` date DEFAULT NULL,
  `projectdatetext` varchar(20) DEFAULT NULL,
  `initiative` varchar(255) DEFAULT NULL,
  `reportnumber` int(10) unsigned NOT NULL,
  `reportimpact` tinyint(1) NOT NULL DEFAULT '0',
  `numberpages` int(10) unsigned NOT NULL DEFAULT '0',
  `numberprojectsstandard` int(10) unsigned NOT NULL DEFAULT '0',
  `datelimitparlament` date NOT NULL,
  `datelimitparlamenttext` varchar(20) NOT NULL,
  `datelimitexpert` date NOT NULL,
  `datelimitexperttext` varchar(20) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `projectreportstate` tinyint(2) NOT NULL DEFAULT '1',
  `projectstate` tinyint(2) NOT NULL DEFAULT '1',
  `reportmultipleedit` tinyint(1) NOT NULL DEFAULT '0',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reportnumber` (`reportnumber`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) unsigned DEFAULT NULL,
  `reportdate` date NOT NULL,
  `reportdatetext` varchar(20) NOT NULL,
  `p02list1` varchar(50) DEFAULT NULL,
  `p02list2` varchar(50) DEFAULT NULL,
  `p02text1` text,
  `p02option1` smallint(1) DEFAULT '0',
  `p02option2` smallint(1) DEFAULT '0',
  `p04text1` text,
  `p05list1` varchar(50) DEFAULT NULL,
  `p05text1` text,
  `p07text1` text,
  `p07radio1` tinyint(2) NOT NULL DEFAULT '0',
  `p08text1` text,
  `p08radio1` tinyint(2) NOT NULL DEFAULT '0',
  `p08radio2` tinyint(22) NOT NULL DEFAULT '0',
  `p09radio1` tinyint(2) NOT NULL DEFAULT '0',
  `p09radio2` tinyint(2) NOT NULL DEFAULT '0',
  `p09text1` text,
  `p10text1` text,
  `p10radio1` tinyint(2) NOT NULL DEFAULT '0',
  `p11text1` text,
  `p11radio1` tinyint(2) NOT NULL DEFAULT '0',
  `p11radio2` tinyint(2) NOT NULL DEFAULT '0',
  `p12text1` text,
  `p12radio1` tinyint(2) NOT NULL DEFAULT '0',
  `p12radio2` tinyint(2) NOT NULL DEFAULT '0',
  `p13text1` text,
  `p13radio1` tinyint(2) NOT NULL DEFAULT '0',
  `p14text1` text,
  `p14radio1` tinyint(2) NOT NULL DEFAULT '0',
  `p15text1` text,
  `p15radio1` tinyint(2) NOT NULL DEFAULT '0',
  `p15radio2` tinyint(2) NOT NULL DEFAULT '0',
  `simplesubreport` longtext,
  `concluzii` longtext,
  `admincoments` text,
  `reportstate` tinyint(2) NOT NULL DEFAULT '0',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subreports`
--

CREATE TABLE IF NOT EXISTS `subreports` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `report_id` int(10) DEFAULT NULL,
  `expert_id` varchar(10) DEFAULT NULL,
  `subreportorder` int(10) unsigned DEFAULT '0',
  `articol` varchar(255) DEFAULT NULL,
  `text` longtext,
  `obiectia` longtext,
  `alteelemente` text,
  `alteelementeacceptate` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `alteriscuri` text,
  `alteriscuriacceptate` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `recomandarea` text,
  `todelete` tinyint(1) DEFAULT '0',
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subreports_celems`
--

CREATE TABLE IF NOT EXISTS `subreports_celems` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subreport_id` int(10) NOT NULL,
  `celem_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subreports_pelems`
--

CREATE TABLE IF NOT EXISTS `subreports_pelems` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subreport_id` int(10) NOT NULL,
  `pelem_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `templates`
--

CREATE TABLE IF NOT EXISTS `templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `header` text,
  `footer` text,
  `headerpdf` text,
  `footerpdf` text,
  `date` date DEFAULT NULL,
  `datetext` varchar(20) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC AUTO_INCREMENT=1 ;
