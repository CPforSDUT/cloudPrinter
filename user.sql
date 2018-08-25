

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";




CREATE TABLE IF NOT EXISTS `delfiles` (
  `orderId` char(32) NOT NULL,
  `time` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;




CREATE TABLE IF NOT EXISTS `fileinfo` (
  `orderId` char(32) NOT NULL,
  `filePath` varchar(100) NOT NULL,
  `color` char(1) NOT NULL DEFAULT '1',
  `num` int(11) NOT NULL DEFAULT '1',
  `paperType` int(11) NOT NULL DEFAULT '16',
  `filename` varchar(1000) NOT NULL,
  `otherInfo` varchar(500) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;





CREATE TABLE IF NOT EXISTS `orderids` (
  `orderId` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `orderinfo` (
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


CREATE TABLE IF NOT EXISTS `printerinfo` (
  `username` char(15) NOT NULL,
  `color` char(1) NOT NULL DEFAULT '1',
  `paperType` int(11) NOT NULL DEFAULT '8',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `user` (
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
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
