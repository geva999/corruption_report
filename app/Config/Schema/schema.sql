#App sql generated on: 2012-11-19 01:11:15 : 1353280275

DROP TABLE IF EXISTS `attachments`;
DROP TABLE IF EXISTS `authors`;
DROP TABLE IF EXISTS `celems`;
DROP TABLE IF EXISTS `experts`;
DROP TABLE IF EXISTS `pelems`;
DROP TABLE IF EXISTS `projectexperts`;
DROP TABLE IF EXISTS `projects`;
DROP TABLE IF EXISTS `reports`;
DROP TABLE IF EXISTS `subreports`;
DROP TABLE IF EXISTS `subreports_celems`;
DROP TABLE IF EXISTS `subreports_pelems`;
DROP TABLE IF EXISTS `templates`;


CREATE TABLE `attachments` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `report_id` int(10) NOT NULL COMMENT '',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `filename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `todelete` tinyint(1) DEFAULT '0' COMMENT '',
  `created` date DEFAULT NULL COMMENT '',
  `modified` date DEFAULT NULL COMMENT '',	PRIMARY KEY  (`id`),
  KEY `report_id` (`report_id`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `authors` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `created` date DEFAULT NULL COMMENT '',
  `modified` date DEFAULT NULL COMMENT '',	PRIMARY KEY  (`id`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `celems` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `celem` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `number` int(10) NOT NULL COMMENT '',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `celemgroup` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',	PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `number` (`number`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `experts` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `username` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `password` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `fullname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `isadmin` tinyint(1) DEFAULT '0' NOT NULL COMMENT '',
  `created` date DEFAULT NULL COMMENT '',
  `modified` date DEFAULT NULL COMMENT '',	PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `pelems` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `celem_id` int(10) NOT NULL COMMENT '',
  `number` int(10) NOT NULL COMMENT '',	PRIMARY KEY  (`id`),
  KEY `celem_id` (`celem_id`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `projectexperts` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `project_id` int(10) NOT NULL COMMENT '',
  `expert_id` int(10) NOT NULL COMMENT '',
  `created` date DEFAULT NULL COMMENT '',
  `modified` date DEFAULT NULL COMMENT '',	PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`),
  KEY `expert_id` (`expert_id`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `expert_id` int(10) NOT NULL COMMENT '',
  `author_id` int(10) DEFAULT 0 NOT NULL COMMENT '',
  `name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `namesolicitare` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `projecttype` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `projecttypevizat` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `projectdomain` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `projectnumber` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `projectdate` date DEFAULT NULL COMMENT '',
  `projectdatetext` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `initiative` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `reportnumber` int(10) NOT NULL COMMENT '',
  `reportimpact` tinyint(1) DEFAULT '0' NOT NULL COMMENT '',
  `numberpages` int(10) DEFAULT 0 NOT NULL COMMENT '',
  `datelimitparlament` date NOT NULL COMMENT '',
  `datelimitparlamenttext` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `datelimitexpert` date NOT NULL COMMENT '',
  `datelimitexperttext` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `filename` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `projectreportstate` int(2) DEFAULT 1 NOT NULL COMMENT '',
  `projectstate` int(2) DEFAULT 1 NOT NULL COMMENT '',
  `reportmultipleedit` tinyint(1) DEFAULT '0' NOT NULL COMMENT '',
  `created` date DEFAULT NULL COMMENT '',
  `modified` date DEFAULT NULL COMMENT '',	PRIMARY KEY  (`id`),
  UNIQUE KEY `reportnumber` (`reportnumber`),
  KEY `expert_id` (`expert_id`),
  KEY `author_id` (`author_id`),
  KEY `projectnumber` (`projectnumber`),
  KEY `projectdomain` (`projectdomain`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `reports` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `project_id` int(10) DEFAULT NULL COMMENT '',
  `reportdate` date NOT NULL COMMENT '',
  `reportdatetext` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `p02list1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p02list2` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p02text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p02option1` int(1) DEFAULT 0 COMMENT '',
  `p02option2` int(1) DEFAULT 0 COMMENT '',
  `p04text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p05list1` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p05text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p07text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p07radio1` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p08text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p08radio1` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p08radio2` int(22) DEFAULT 0 NOT NULL COMMENT '',
  `p09radio1` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p09radio2` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p09text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p10text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p10radio1` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p11text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p11radio1` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p11radio2` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p12text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p12radio1` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p12radio2` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p13text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p13radio1` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p14text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p14radio1` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p15text1` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `p15radio1` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `p15radio2` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `simplesubreport` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `concluzii` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `admincoments` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `reportstate` int(2) DEFAULT 0 NOT NULL COMMENT '',
  `created` date DEFAULT NULL COMMENT '',
  `modified` date DEFAULT NULL COMMENT '',	PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `subreports` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `report_id` int(10) DEFAULT NULL COMMENT '',
  `expert_id` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `subreportorder` int(10) DEFAULT 0 COMMENT '',
  `articol` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `text` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `obiectia` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `alteelemente` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `alteelementeacceptate` tinyint(1) DEFAULT '0' NOT NULL COMMENT '',
  `alteriscuri` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `alteriscuriacceptate` tinyint(1) DEFAULT '0' NOT NULL COMMENT '',
  `recomandarea` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `todelete` tinyint(1) DEFAULT '0' COMMENT '',
  `created` date DEFAULT NULL COMMENT '',
  `modified` date DEFAULT NULL COMMENT '',	PRIMARY KEY  (`id`),
  KEY `report_id` (`report_id`),
  KEY `expert_id` (`expert_id`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `subreports_celems` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `subreport_id` int(10) NOT NULL COMMENT '',
  `celem_id` int(10) NOT NULL COMMENT '',	PRIMARY KEY  (`id`),
  KEY `subreport_id` (`subreport_id`),
  KEY `celem_id` (`celem_id`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `subreports_pelems` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `subreport_id` int(10) NOT NULL COMMENT '',
  `pelem_id` int(10) NOT NULL COMMENT '',	PRIMARY KEY  (`id`),
  KEY `subreport_id` (`subreport_id`),
  KEY `pelem_id` (`pelem_id`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

CREATE TABLE `templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT '',
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '',
  `header` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `footer` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `headerpdf` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `footerpdf` text CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `date` date DEFAULT NULL COMMENT '',
  `datetext` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL COMMENT '',
  `created` date DEFAULT NULL COMMENT '',
  `modified` date DEFAULT NULL COMMENT '',	PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`))	DEFAULT CHARSET=utf8,
  COLLATE=utf8_general_ci,
  ENGINE=InnoDB;

