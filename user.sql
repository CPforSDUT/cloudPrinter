-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2018 年 08 月 19 日 19:47
-- 服务器版本: 5.5.53-log
-- PHP 版本: 5.4.45

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `user`
--

-- --------------------------------------------------------

--
-- 表的结构 `delfiles`
--

CREATE TABLE IF NOT EXISTS `delfiles` (
  `orderId` char(32) NOT NULL,
  `time` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `fileinfo`
--

CREATE TABLE IF NOT EXISTS `fileinfo` (
  `orderId` char(32) NOT NULL,
  `filePath` varchar(100) NOT NULL,
  `color` char(1) NOT NULL DEFAULT '1',
  `num` int(11) NOT NULL DEFAULT '1',
  `paperType` int(11) NOT NULL DEFAULT '8',
  `filename` varchar(1000) NOT NULL,
  `otherInfo` varchar(500) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `orderids`
--

CREATE TABLE IF NOT EXISTS `orderids` (
  `orderId` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `orderinfo`
--

CREATE TABLE IF NOT EXISTS `orderinfo` (
  `orderId` char(32) NOT NULL,
  `consumer` char(15) NOT NULL,
  `business` char(15) NOT NULL,
  `deadline` varchar(13) NOT NULL,
  `orderState` int(11) NOT NULL,
  `orderInfo` varchar(400) NOT NULL,
  `exCode` char(6) NOT NULL,
  PRIMARY KEY (`orderId`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `printerinfo`
--

CREATE TABLE IF NOT EXISTS `printerinfo` (
  `username` char(15) NOT NULL,
  `color` char(1) NOT NULL,
  `paperType` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

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
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
