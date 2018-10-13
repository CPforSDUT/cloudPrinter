# Host: localhost  (Version: 5.5.53)
# Date: 2018-10-11 18:04:40
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "aisort"
#

CREATE TABLE `aisort` (
  `username` char(15) DEFAULT NULL,
  `sort` varchar(1000) DEFAULT NULL,
  `speed` varchar(15) DEFAULT '3',
  `doOrder` char(32) DEFAULT 'null',
  `hock` char(1) DEFAULT 'n',
  `time` char(13) DEFAULT 'null'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "aisort"
#

INSERT INTO `aisort` VALUES ('yanshi11',NULL,'3','null','n','null'),('yanshi12','','3','null','n','null'),('yanshi13',NULL,'3','null','n','null');

#
# Structure for table "alloc"
#

CREATE TABLE `alloc` (
  `username` char(16) NOT NULL,
  `cost` int(11) NOT NULL DEFAULT '60',
  `distance` int(11) NOT NULL DEFAULT '70',
  `score` int(11) NOT NULL DEFAULT '60'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "alloc"
#

INSERT INTO `alloc` VALUES ('wlwwlw',60,70,60);

#
# Structure for table "delfiles"
#

CREATE TABLE `delfiles` (
  `orderId` char(32) NOT NULL,
  `time` char(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "delfiles"
#


#
# Structure for table "fileinfo"
#

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


#
# Structure for table "orderids"
#

CREATE TABLE `orderids` (
  `orderId` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "orderids"
#


#
# Structure for table "orderinfo"
#

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


#
# Structure for table "pay"
#

CREATE TABLE `pay` (
  `username` char(15) DEFAULT NULL,
  `pubKey` varchar(1000) DEFAULT NULL,
  `priKey` varchar(2000) DEFAULT NULL,
  `appId` varchar(17) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "pay"
#

INSERT INTO `pay` VALUES ('yanshi11',NULL,NULL,NULL),('yanshi12','MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAu4oP1qla3bVkkXUaBCulG4XdWrA8rvXzCm++atBLgvl6p/t5pvS7SmPF8/Cou9yZJsPioE89U4Pj9e1EslUE+2fFaSp1sjnpPey3evk+y9K2YKFbtaHTiXJCukHofhzo5SEnW0sknZmuQHwkh2+smmmnJIqRsVFDHiBikB0kp0U3Ldcat8EXu+TzYdPw1fUI+QoTAGYkccJ7/druMCXvqsD4rc24OM0u7aKDXgaEG35IAmycj5smXKkOFuvl3p6HaSwXzfHdoRZBuTfex2MsXFJUxvuMa4ssnR0s7t75MQYJYF1BUhJQLbxkEsL1RO84gipNJ+/1Q0X0RUcjeS6T8QIDAQAB','MIIEpQIBAAKCAQEAuxTWj8K5VDRz51fwR00dmF+VZZ9gJFeWgQbzdYQODaDa4deX2wJZJ2UhihxoxbyFPVcBTszIDq+Nb41bpL37GO7nNXAOMzSnJXeLy5hToCVsG5sNgEKV6+cf45lq7Ao7O75EwkuDw0/JBpBdU8qRKOym9a8c8L4c9YG2ks0dPfUQr+D3SbmNGiEVC5y5Qh5WMPM7txvXr+rcCxVBwJIdVAE3yNJ6+hTFiar7852BBzOXmOii/T01zuWAjGW5LR+bnFexmG1RWnTJy0vsYMwBiXt9BwC6LxsX4CnqYD0yRy0vlauSOSWd8rXGma4ccR2oKyff4X8lBFE7lBcUyRbCyQIDAQABAoIBAQCDiiNS8ZddnYPhJfPMLmygtpRU37q50tv/3ONRvYgkDPXZ1bzwQLZu/KyYb2E7p1IHzyUcQuBncwf/Z2UIcIwc+92VtTRGzL65mVSx0mj6MVXSEzNq+2ZueBPz8+s6C/eaCi5Obso2ieLOurLkN4nZPIwoMvgmTYYPGSVGEvJ8nJ8GnptHlzY1iiHth66GqbxydVLk/FAP67R/fhmXZn3f5Q2DRNJyUSwnka8owzE2tVofmp6bBghxYNgPEVV7VsEsIBz1+L3wo/O/NQeiLKZJ3hk08WQOtvlkVzVd5DqoI5jUtoGrLQefqDXZg02DtcFuxRifwajJiV2jne8rDRABAoGBAOV2yuvP8WUN1viBt/Rk0buik6FXpVEqCTJ7GZ2+0WverU08GEnrGF2T2sKnFbH/diJjRs1R9M7g0zWD8/6f7eO1+ZgnaSP8BUyQynM+rQEoib3q5tvt3v2jp6Ip+RCo3iltu5NVh61/UJ5Gi7B0AyrafhlD+yok4V1Te9Ea8eSvAoGBANC3Uk0KkWnBQ+/I84vlV5vSXRWawZvJ0O07ym9D4rVVfUOR9XLisv4Lg6cyS5NUrm5WZ+OX4RgLWmsfU02uXuSvElDJEtJ46fQk8iVy5bXDw69cCsvD7dXRZPvT/ZhOI/8WbhfySnUAo/irtLGjfD0ctz7xot2nsRKf64P8Yx4HAoGAPCYOfQ/ODBo7nnqKWNLQs2mjXyiVWhg1vvjLtzDcvnTpYpR9HWs1wNnP/zRDGJyJP+xcE9gG3u/KDX4gSD9t4UHDQmIaSmd2kCJoHxtvyBzzNkhL6ZyJ1ly+xWBRPE+3pI5yG+XQoeb8n/CID2HprqMFaOQMA3kVZhxLGX4BqFsCgYEAnEU2BOLtvz3qDOXrnAoKT2vxMBTf8zHnEUjcJ/SvENBCas4k9XDRTa73Ur8woM4dkBV30YtNCMCvYVdh+t6cxCJk10HFqvrHSHpFJ07guPgrUufaWXiIYbhXIMo3rMqM3xg/NATARNxG6RA+yWY7xlHyzdkD9WvyA5zjLL5SxA8CgYEAscajejfiWyXDXBik2v7MlszzIJ3zRnIgte2QtZw+/NtQp7n2wJ0o4ozG3xhxhgrKBNAw26YPLD3+tQc0Zo6HxjnuZvo+UJx2qdfEhisdNlgJVL+iP1aaAA94pBgblzpSG2iYGh5dJMKN1Zi4FaVkiCOqa1NVxWhd6WX8Vg4F9Ow=','2016092100561231'),('yanshi13',NULL,NULL,NULL);

#
# Structure for table "printerinfo"
#

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
  `colorBuff` varchar(25) DEFAULT '1.0',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "printerinfo"
#

INSERT INTO `printerinfo` VALUES ('yanshi11','1',16,'8.0','4.0','2.0','1.0','0.5','0.25','0.25','0.25','0.25','0.25','0.25','8.0','4.0','2.0','1.0','0.5','0.25','0.25','0.25','0.25','0.25','0.25','1.0'),('yanshi12','1',16,'8.0','4.0','2.0','1.0','0.5','0.25','0.25','0.25','0.25','0.25','0.25','8.0','4.0','2.0','1.0','0.5','0.25','0.25','0.25','0.25','0.25','0.25','1.0'),('yanshi13','1',16,'8.0','4.0','2.0','1.0','0.5','0.25','0.25','0.25','0.25','0.25','0.25','8.0','4.0','2.0','1.0','0.5','0.25','0.25','0.25','0.25','0.25','0.25','1.0');

#
# Structure for table "user"
#

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

INSERT INTO `user` VALUES ('admini','admini','3','','','','','','','','13280672532','5.0'),('wlwwlw','621129a','1','','','','','','','1','13280672532','5.0'),('yanshi11','621129aa','2','%u5C71%u4E1C%u7701','%u6D4E%u5357%u5E02','%u5929%u6865%u533A','%u5C71%u4E1C%u7701%u6D4E%u5357%u5E02%u5927%u660E%u6E56%u9644%u8FD1','117.02008','36.678964','1','17853316172','5.0'),('yanshi12','621129aa','2','%u5C71%u4E1C%u7701','%u6D4E%u5357%u5E02','%u5386%u4E0B%u533A','%u5C71%u4E1C%u7701%u6D4E%u5357%u5E02%u5927%u660E%u6E56%u65C1','117.070242','36.665649','1','17853319172','4.65575'),('yanshi13','621129aa','2','%u5C71%u4E1C%u7701','%u6D4E%u5357%u5E02','%u5E02%u4E2D%u533A','%u5C71%u4E1C%u7701%u6D4E%u5357%u5E02%u5927%u660E%u9644%u8FD1','117.023099','36.66727','1','17853316170','5.0');
