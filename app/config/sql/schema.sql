#App sql generated on: 2012-05-23 01:57:09 : 1337727429

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
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `report_id` int(10) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `todelete` tinyint(1) DEFAULT 0,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,	PRIMARY KEY  (`id`),
  KEY `report_id` (`report_id`));

CREATE TABLE `authors` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,	PRIMARY KEY  (`id`));

CREATE TABLE `celems` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `celem` varchar(255) NOT NULL,
  `number` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `celemgroup` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,	PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `number` (`number`));

CREATE TABLE `experts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `isadmin` tinyint(1) DEFAULT 0 NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,	PRIMARY KEY  (`id`),
  UNIQUE KEY `username` (`username`));

CREATE TABLE `pelems` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `celem_id` int(10) NOT NULL,
  `number` int(10) NOT NULL,	PRIMARY KEY  (`id`),
  KEY `celem_id` (`celem_id`));

CREATE TABLE `projectexperts` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `expert_id` int(10) NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,	PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`),
  KEY `expert_id` (`expert_id`));

CREATE TABLE `projects` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `expert_id` int(10) NOT NULL,
  `author_id` int(10) DEFAULT 0 NOT NULL,
  `name` text NOT NULL,
  `namesolicitare` text DEFAULT NULL,
  `projecttype` varchar(100) NOT NULL,
  `projecttypevizat` varchar(100) NOT NULL,
  `projectdomain` varchar(255) NOT NULL,
  `projectnumber` varchar(15) DEFAULT NULL,
  `projectdate` date DEFAULT NULL,
  `projectdatetext` varchar(20) DEFAULT NULL,
  `initiative` varchar(255) DEFAULT NULL,
  `reportnumber` int(10) NOT NULL,
  `reportimpact` tinyint(1) DEFAULT 0 NOT NULL,
  `numberpages` int(10) DEFAULT 0 NOT NULL,
  `datelimitparlament` date NOT NULL,
  `datelimitparlamenttext` varchar(20) NOT NULL,
  `datelimitexpert` date NOT NULL,
  `datelimitexperttext` varchar(20) NOT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `projectreportstate` int(2) DEFAULT 1 NOT NULL,
  `projectstate` int(2) DEFAULT 1 NOT NULL,
  `reportmultipleedit` tinyint(1) DEFAULT 0 NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,	PRIMARY KEY  (`id`),
  UNIQUE KEY `reportnumber` (`reportnumber`),
  KEY `expert_id` (`expert_id`),
  KEY `author_id` (`author_id`),
  KEY `projectnumber` (`projectnumber`),
  KEY `projectdomain` (`projectdomain`));

CREATE TABLE `reports` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) DEFAULT NULL,
  `reportdate` date NOT NULL,
  `reportdatetext` varchar(20) NOT NULL,
  `p02list1` varchar(50) DEFAULT NULL,
  `p02list2` varchar(50) DEFAULT NULL,
  `p02text1` text DEFAULT NULL,
  `p02option1` int(1) DEFAULT 0,
  `p02option2` int(1) DEFAULT 0,
  `p04text1` text DEFAULT NULL,
  `p05list1` varchar(50) DEFAULT NULL,
  `p05text1` text DEFAULT NULL,
  `p07text1` text DEFAULT NULL,
  `p07radio1` int(2) DEFAULT 0 NOT NULL,
  `p08text1` text DEFAULT NULL,
  `p08radio1` int(2) DEFAULT 0 NOT NULL,
  `p08radio2` int(22) DEFAULT 0 NOT NULL,
  `p09radio1` int(2) DEFAULT 0 NOT NULL,
  `p09radio2` int(2) DEFAULT 0 NOT NULL,
  `p09text1` text DEFAULT NULL,
  `p10text1` text DEFAULT NULL,
  `p10radio1` int(2) DEFAULT 0 NOT NULL,
  `p11text1` text DEFAULT NULL,
  `p11radio1` int(2) DEFAULT 0 NOT NULL,
  `p11radio2` int(2) DEFAULT 0 NOT NULL,
  `p12text1` text DEFAULT NULL,
  `p12radio1` int(2) DEFAULT 0 NOT NULL,
  `p12radio2` int(2) DEFAULT 0 NOT NULL,
  `p13text1` text DEFAULT NULL,
  `p13radio1` int(2) DEFAULT 0 NOT NULL,
  `p14text1` text DEFAULT NULL,
  `p14radio1` int(2) DEFAULT 0 NOT NULL,
  `p15text1` text DEFAULT NULL,
  `p15radio1` int(2) DEFAULT 0 NOT NULL,
  `p15radio2` int(2) DEFAULT 0 NOT NULL,
  `simplesubreport` text DEFAULT NULL,
  `concluzii` text DEFAULT NULL,
  `admincoments` text DEFAULT NULL,
  `reportstate` int(2) DEFAULT 0 NOT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,	PRIMARY KEY  (`id`),
  KEY `project_id` (`project_id`));

CREATE TABLE `subreports` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `report_id` int(10) DEFAULT NULL,
  `expert_id` varchar(10) DEFAULT NULL,
  `subreportorder` int(10) DEFAULT 0,
  `articol` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `obiectia` text DEFAULT NULL,
  `alteelemente` text DEFAULT NULL,
  `alteelementeacceptate` tinyint(1) DEFAULT 0 NOT NULL,
  `alteriscuri` text DEFAULT NULL,
  `alteriscuriacceptate` tinyint(1) DEFAULT 0 NOT NULL,
  `recomandarea` text DEFAULT NULL,
  `todelete` tinyint(1) DEFAULT 0,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,	PRIMARY KEY  (`id`),
  KEY `report_id` (`report_id`),
  KEY `expert_id` (`expert_id`));

CREATE TABLE `subreports_celems` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subreport_id` int(10) NOT NULL,
  `celem_id` int(10) NOT NULL,	PRIMARY KEY  (`id`),
  KEY `subreport_id` (`subreport_id`),
  KEY `celem_id` (`celem_id`));

CREATE TABLE `subreports_pelems` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `subreport_id` int(10) NOT NULL,
  `pelem_id` int(10) NOT NULL,	PRIMARY KEY  (`id`),
  KEY `subreport_id` (`subreport_id`),
  KEY `pelem_id` (`pelem_id`));

CREATE TABLE `templates` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `header` text DEFAULT NULL,
  `footer` text DEFAULT NULL,
  `headerpdf` text DEFAULT NULL,
  `footerpdf` text DEFAULT NULL,
  `date` date DEFAULT NULL,
  `datetext` varchar(20) DEFAULT NULL,
  `created` date DEFAULT NULL,
  `modified` date DEFAULT NULL,	PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`));

