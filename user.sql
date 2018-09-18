# Host: localhost  (Version: 5.5.53)
# Date: 2018-09-18 11:02:33
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "alloc"
#

DROP TABLE IF EXISTS `alloc`;
CREATE TABLE `alloc` (
  `username` char(16) NOT NULL,
  `cost` int(11) NOT NULL DEFAULT '60',
  `distance` int(11) NOT NULL DEFAULT '70',
  `score` int(11) NOT NULL DEFAULT '60'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "alloc"
#

/*!40000 ALTER TABLE `alloc` DISABLE KEYS */;
/*!40000 ALTER TABLE `alloc` ENABLE KEYS */;

#
# Structure for table "delfiles"
#

DROP TABLE IF EXISTS `delfiles`;
CREATE TABLE `delfiles` (
  `orderId` char(32) NOT NULL,
  `time` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "delfiles"
#

/*!40000 ALTER TABLE `delfiles` DISABLE KEYS */;
/*!40000 ALTER TABLE `delfiles` ENABLE KEYS */;

#
# Structure for table "fileinfo"
#

DROP TABLE IF EXISTS `fileinfo`;
CREATE TABLE `fileinfo` (
  `orderId` char(32) NOT NULL,
  `filePath` varchar(100) NOT NULL,
  `color` char(1) NOT NULL DEFAULT '1',
  `num` int(11) NOT NULL DEFAULT '1',
  `paperType` int(11) NOT NULL DEFAULT '16',
  `paperNum` int(11) DEFAULT '-1',
  `paperWay` char(1) CHARACTER SET utf32 NOT NULL DEFAULT '1',
  `filename` varchar(1000) NOT NULL,
  `otherInfo` varchar(500) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "fileinfo"
#

/*!40000 ALTER TABLE `fileinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `fileinfo` ENABLE KEYS */;

#
# Structure for table "orderids"
#

DROP TABLE IF EXISTS `orderids`;
CREATE TABLE `orderids` (
  `orderId` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "orderids"
#

/*!40000 ALTER TABLE `orderids` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderids` ENABLE KEYS */;

#
# Structure for table "orderinfo"
#

DROP TABLE IF EXISTS `orderinfo`;
CREATE TABLE `orderinfo` (
  `orderId` char(32) NOT NULL,
  `consumer` char(15) NOT NULL,
  `business` char(15) NOT NULL,
  `deadline` varchar(13) NOT NULL,
  `orderState` int(11) NOT NULL DEFAULT '1',
  `orderInfo` varchar(400) NOT NULL DEFAULT '',
  `exCode` char(6) NOT NULL,
  `deleted` char(2) NOT NULL DEFAULT 'nn',
  PRIMARY KEY (`orderId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "orderinfo"
#

/*!40000 ALTER TABLE `orderinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderinfo` ENABLE KEYS */;

#
# Structure for table "printerinfo"
#

DROP TABLE IF EXISTS `printerinfo`;
CREATE TABLE `printerinfo` (
  `username` char(15) NOT NULL,
  `color` char(1) NOT NULL DEFAULT '1',
  `paperType` int(11) NOT NULL DEFAULT '16',
  `A0` varchar(25) DEFAULT '8.0',
  `A1` varchar(25) DEFAULT '4.0',
  `A2` varchar(25) DEFAULT '2.0',
  `A3` varchar(25) DEFAULT '1.0',
  `A4` varchar(25) DEFAULT '0.5',
  `A5` varchar(25) DEFAULT '0.25',
  `A6` varchar(25) DEFAULT '0.25',
  `A7` varchar(25) DEFAULT '0.25',
  `A8` varchar(25) DEFAULT '0.25',
  `A9` varchar(25) DEFAULT '0.25',
  `A10` varchar(25) DEFAULT '0.25',
  `B0` varchar(25) DEFAULT '8.0',
  `B1` varchar(25) DEFAULT '4.0',
  `B2` varchar(25) DEFAULT '2.0',
  `B3` varchar(25) DEFAULT '1.0',
  `B4` varchar(25) DEFAULT '0.5',
  `B5` varchar(25) DEFAULT '0.25',
  `B6` varchar(25) DEFAULT '0.25',
  `B7` varchar(25) DEFAULT '0.25',
  `B8` varchar(25) DEFAULT '0.25',
  `B9` varchar(25) DEFAULT '0.25',
  `B10` varchar(25) DEFAULT '0.25',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "printerinfo"
#

/*!40000 ALTER TABLE `printerinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `printerinfo` ENABLE KEYS */;

#
# Structure for table "user"
#

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` char(15) NOT NULL,
  `password` varchar(16) NOT NULL,
  `type` char(1) NOT NULL,
  `province` char(50) NOT NULL,
  `city` char(50) NOT NULL,
  `area` char(50) NOT NULL,
  `other` varchar(400) NOT NULL,
  `lo` varchar(15) NOT NULL,
  `la` varchar(15) NOT NULL,
  `state` char(1) NOT NULL,
  `phone` char(11) NOT NULL,
  `score` varchar(11) DEFAULT '5.0',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
