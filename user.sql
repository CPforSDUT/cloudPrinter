# Host: localhost  (Version: 5.5.53)
# Date: 2018-09-15 13:53:35
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

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

INSERT INTO `delfiles` VALUES ('415e34806fa731d3ce1b22bd902682c1','1536935729'),('dad6e437c83a6b90f1d2661927844c54','1536927958'),('88b7f92ad47e10a31eb917cc279e1ee8','1536927851'),('dab0954aec917ca150c85d9ffe329abc','1536922516'),('f4dcc03e9cd18bdff85b598d162f03cd','1536922510'),('414250ac41e0c84207b84469f937506c','1536922508'),('2a4c629ff0adbe2699cb872810058b15','1536990132'),('c5b36d233d0909ce7029b375bb9b9375','1536989746'),('7ee04343ca09d616d8eb7cadc6a9f475','1536989631'),('597153ae8fd23d1cd10e41afb3aef97c','1536989568'),('a7f2b46652abc38eb5120e02a84c1bee','1536989336'),('1bbcb123613aeeee03df12b9b8277324','1536988941'),('fd5d7eaa99e4beb8ab02e9f72490c98e','1536988887'),('28186c8fc35f869678d779afa3cde7d2','1536975085'),('929c3c465c26be64cfdd375421c3463c','1536975085'),('c4e59ecbffd61b663a6ab29bfc4594ad','1536974370'),('da523a7fa5e15cb3174f6d322fd0f631','1536973846'),('433a93b3adade55e5843eca35cef64e5','1536973845'),('0f7408764fcf049b10b5a316fab89c02','1536973119'),('f12393c87e00d32400c3fcde3dea51cc','1536972857'),('3564111f52e6ed700171f9417fcfd657','1536972476'),('036c2706254ad22e9369e7b87aee8c8a','1536970869'),('196','1536913469'),('195','1536913467'),('194','1536913464'),('193','1536913462'),('192','1536913460'),('191','1536913458'),('190','1536913456'),('9448d37f8af420ba94d5b9478c8ddf58','1536913300');

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

INSERT INTO `fileinfo` VALUES ('1bbcb123613aeeee03df12b9b8277324','upload/bb078becbb2331b647b0997ee5c2fc7931f4f7a61f6fd5ade949180db210576e.doc','1',1,16,-1,'1','123.doc',''),('1bbcb123613aeeee03df12b9b8277324','upload/b00f18f7419f9d63cd6e07f505a5121639133203ad2b9a7b4651ec0f89748e14.txt','1',1,16,-1,'1','1.txt',''),('fd5d7eaa99e4beb8ab02e9f72490c98e','upload/b00f18f7419f9d63cd6e07f505a5121639133203ad2b9a7b4651ec0f89748e14.txt','1',1,16,-1,'1','1.txt',''),('fd5d7eaa99e4beb8ab02e9f72490c98e','upload/bb078becbb2331b647b0997ee5c2fc7931f4f7a61f6fd5ade949180db210576e.doc','1',1,16,-1,'1','123.doc',''),('02594fc443c67f116f04d33df75a696c','upload/ae9387a67419138ed9dd38150ff2ae44b3388f53d67d55a5b1e9ba0750c717d3.doc','1',1,16,-1,'1','%u5DE5%u4F5C%u603B%u7ED3.doc',''),('0f7408764fcf049b10b5a316fab89c02','upload/ae9387a67419138ed9dd38150ff2ae44b3388f53d67d55a5b1e9ba0750c717d3.doc','1',1,16,-1,'1','%u5DE5%u4F5C%u603B%u7ED3.doc',''),('bfb182bb2ccee70ba8141259b37a676d','upload/b0b64f373faf584a422b7579eb19a33c165d2e8361262e9e237c0d3871cbe927.php','1',1,16,-1,'1','gene.php',''),('036c2706254ad22e9369e7b87aee8c8a','upload/7fd0de8dbfb795b1f48c3ba11715a55d4ec39e1fdc5986572cbed34067432705.docx','1',1,16,-1,'1','%u91D1%u878D%u4E60%u9898.docx',''),('f12393c87e00d32400c3fcde3dea51cc','upload/ddb8527c19c7df0dfdb6f3c698963a60d1d4538a50b521e265b431bd226c0918.doc','1',1,32,-1,'1','%u8BE6%u7EC6%u8BBE%u8BA1%u8BF4%u660E%u4E66.doc',''),('7c3939fc9b4bf82e211efe03939c7cb7','upload/3e7c731edd5f56ab3f5b62f443fde931197dcc84c55accc5461ddaface97f849.doc','1',1,16,-1,'1','%u9700%u6C42%u5206%u6790%u8BF4%u660E%u4E66.doc',''),('ff1ca3ed903ea0604802517a85e55f7d','upload/e6f214ff5ccbbe6e7abcf309138cdcb46d3fe3915e9bbbe8dd3c15afb439f708.ref_default_overrides','1',1,16,-1,'1','pref_default_overrides',''),('ff1ca3ed903ea0604802517a85e55f7d','upload/35d92c86c1c054d1c03f4e58b83681bbfd8573143ee5e4cfb4cbd788a1ffc107.pri','1',1,16,-1,'1','Resources.pri',''),('ff1ca3ed903ea0604802517a85e55f7d','upload/9835d337bfd5eabcd0cf098c215fc1551862e45f356b4b016780b221ba09f09a.json','1',1,16,-1,'1','installation_status.json',''),('dab0954aec917ca150c85d9ffe329abc','upload/db086ba9dafaebdad5678665ee06eeea3dba5b72dc5dfeecf267aaf473783368.txt','1',1,16,-1,'1','%21%21%21%21.txt',''),('8070ad3c69b800947a97983182d00ad7','upload/42aba5029d7eb7051327c7168eab47ff3b53c3641632d0ca03dcbc139c05e76e.jpg','1',1,16,-1,'1','1.jpg',''),('4ca161c5d0124988393310914f2df56a','upload/7fbc3c70019973cb43e24bd47ad4c7577f9fe10929cf4e873c17262624ed9f1c.py','1',1,16,-1,'1','o.py',''),('a7f2b46652abc38eb5120e02a84c1bee','upload/d176fb6884bc94b2851f694f1babfa422edddbab7e69855ae89166916ce12d20.doc','1',1,16,-1,'1','%u6982%u8981%u8BBE%u8BA1%u8BF4%u660E%u4E66.doc',''),('597153ae8fd23d1cd10e41afb3aef97c','upload/d176fb6884bc94b2851f694f1babfa422edddbab7e69855ae89166916ce12d20.doc','1',1,16,-1,'1','%u6982%u8981%u8BBE%u8BA1%u8BF4%u660E%u4E66.doc',''),('7ee04343ca09d616d8eb7cadc6a9f475','upload/424aa27f24e99d754067553a3400a0df163a726cc89efeba26423a22a7c7b340.docx','1',1,16,-1,'1','%u5B89%u88C5%u90E8%u7F72%u8BF4%u660E%u4E66.docx',''),('c5b36d233d0909ce7029b375bb9b9375','upload/bb078becbb2331b647b0997ee5c2fc7931f4f7a61f6fd5ade949180db210576e.doc','1',1,16,-1,'1','123.doc',''),('2a4c629ff0adbe2699cb872810058b15','upload/c8407737e06742de4ef74563509398217e3879567061757cea0eb5dde4c39659.docx','1',1,16,-1,'1','111.docx','');

#
# Structure for table "orderids"
#

CREATE TABLE `orderids` (
  `orderId` char(32) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "orderids"
#

INSERT INTO `orderids` VALUES ('2a4c629ff0adbe2699cb872810058b15'),('c5b36d233d0909ce7029b375bb9b9375'),('7ee04343ca09d616d8eb7cadc6a9f475'),('597153ae8fd23d1cd10e41afb3aef97c'),('a7f2b46652abc38eb5120e02a84c1bee'),('1bbcb123613aeeee03df12b9b8277324'),('fd5d7eaa99e4beb8ab02e9f72490c98e'),('28186c8fc35f869678d779afa3cde7d2'),('929c3c465c26be64cfdd375421c3463c'),('02594fc443c67f116f04d33df75a696c'),('c4e59ecbffd61b663a6ab29bfc4594ad'),('bfb182bb2ccee70ba8141259b37a676d'),('da523a7fa5e15cb3174f6d322fd0f631'),('433a93b3adade55e5843eca35cef64e5'),('0f7408764fcf049b10b5a316fab89c02'),('7c3939fc9b4bf82e211efe03939c7cb7'),('f12393c87e00d32400c3fcde3dea51cc'),('3564111f52e6ed700171f9417fcfd657'),('036c2706254ad22e9369e7b87aee8c8a'),('415e34806fa731d3ce1b22bd902682c1'),('dad6e437c83a6b90f1d2661927844c54'),('8070ad3c69b800947a97983182d00ad7'),('88b7f92ad47e10a31eb917cc279e1ee8'),('dab0954aec917ca150c85d9ffe329abc'),('f4dcc03e9cd18bdff85b598d162f03cd'),('414250ac41e0c84207b84469f937506c'),('4ca161c5d0124988393310914f2df56a'),('9448d37f8af420ba94d5b9478c8ddf58'),('dd5da350f197c059c6874f93b5f1eafb'),('23344f469c41b39d598551044b7477ae'),('2d4e9bfb5ef644cd8e5e332e7f7632be'),('7423269e715dac8838dcc266fc3dceaf'),('917278c56939f99daff1fb6df6f3a8fc'),('d5a3f135dfe73e9e56c52f158f5325e9'),('05b8de92960468531323acb861a51bca'),('56fdc0ab5bdd5ddd016afb29d8ed0d0a'),('18c362de7321aa55df472d69a9182909'),('b775cc4e72ae5f202fb9c1ac65bfb01b'),('2e22f32b1a3e00f4ac9eea7ec641115b'),('c05a2e87fef7071b4a4cfadc658dfd66'),('d1b34fbf4cb8262b30823ae0b7f8d6ae'),('2e7f3524e3863a9be6a051a207170a49'),('79581c1aa829d8a69208ff6fd7eabf52'),('dd1a41d05504452dc1261f6f0f2f3d1a'),('1063d286af7e10aa3e721e9fe7db2db1'),('919370b39bd9c77ab15da583ad6d5abf'),('47d9a1f429e46ccd111ecbcbfdebe422'),('ff1ca3ed903ea0604802517a85e55f7d'),('6a4c35a53f0cec8fd77b7aac7d44379f'),('96f84ff893f047715861f4f1ba60b37a'),('d436e13ffc0edb721c6c22ea60ed3a51'),('c08545de9606b324a7e3cf47b15452fe'),('4179d28fb53ae7f4b289ff02aa723d09'),('7df774cd941edf0b256c1e2b0fce6393'),('ecfddd91beeb8ee80cf71b9bb1bbffbf'),('08d59edc2f28efd9015e182d05d94c66'),('97259cef7681d0a8a46b3f1eda4934d2');

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

INSERT INTO `orderinfo` VALUES ('02594fc443c67f116f04d33df75a696c','wlwwlw','yanshi12','201809150930',1,'','977752','nn'),('4ca161c5d0124988393310914f2df56a','wlwwlw','wlwwlw1','201809141623',1,'','336096','cn'),('7c3939fc9b4bf82e211efe03939c7cb7','wlwwlw','yanshi12','201809170858',1,'','754730','nn'),('8070ad3c69b800947a97983182d00ad7','wlwwlw','wlwwlw2','201809142025',1,'','383804','nn'),('bfb182bb2ccee70ba8141259b37a676d','wlwwlw','shangjia','201809150914',1,'','824960','nn'),('ff1ca3ed903ea0604802517a85e55f7d','wlwwlw','wlwwlw3','201809130857',1,'','174212','nn');

#
# Structure for table "printerinfo"
#

CREATE TABLE `printerinfo` (
  `username` char(15) NOT NULL,
  `color` char(1) NOT NULL DEFAULT '1',
  `paperType` int(11) NOT NULL DEFAULT '16',
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "printerinfo"
#

INSERT INTO `printerinfo` VALUES ('shangjia','1',16);

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
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

#
# Data for table "user"
#

INSERT INTO `user` VALUES ('admini','admini','3','','','','','','','','13280672532'),('ceshi123','12345aaa','1','','','','%20MMFVCXVB','','','1','17853318195'),('shangjia','12345aaa','2','%u5C71%u4E1C%u7701','%u6DC4%u535A%u5E02','%u5F20%u5E97%u533A','%u5C71%u4E1C%u7406%u5DE5%u5927%u5B66','118.066656','36.840069','1','17853318199'),('wlwwlw','621129a','1','','','','111','','','1','17853318193'),('wlwwlw1','621129a','2','%u5C71%u4E1C%u7701','%u6F4D%u574A%u5E02','%u660C%u4E50%u53BF','%u5C71%u4E1C%u7406%u5DE5%u5927%u5B661%u53F7%u5E97','118.823245','36.693899','1','17853318193'),('wlwwlw2','621129a','2','%u5C71%u4E1C%u7701','%u6DC4%u535A%u5E02','%u5F20%u5E97%u533A','%u5C71%u4E1C%u7406%u5DE5%u5927%u5B661%u53F7%u5E97','118.010356','36.819897','1','17853318194'),('wlwwlw3','621129a','2','%u5C71%u4E1C%u7701','%u6DC4%u535A%u5E02','%u5F20%u5E97%u533A','%u5C71%u4E1C%u7406%u5DE5%u5927%u5B66','118.054077','36.803775','1','17853318181'),('wyttxs','wslzd9877','1','','','','','','','1','13280672532'),('yanshi11','621129aa','2','%u5C71%u4E1C%u7701','%u6D4E%u5357%u5E02','%u5929%u6865%u533A','%u5C71%u4E1C%u7701%u6D4E%u5357%u5E02%u5927%u660E%u6E56%u9644%u8FD1','117.02008','36.678964','1','17853316172'),('yanshi12','621129aa','2','%u5C71%u4E1C%u7701','%u6D4E%u5357%u5E02','%u5386%u4E0B%u533A','%u5C71%u4E1C%u7701%u6D4E%u5357%u5E02%u5927%u660E%u6E56%u65C1','117.070242','36.665649','1','17853319172'),('yanshi13','621129aa','2','%u5C71%u4E1C%u7701','%u6D4E%u5357%u5E02','%u5E02%u4E2D%u533A','%u5C71%u4E1C%u7701%u6D4E%u5357%u5E02%u5927%u660E%u9644%u8FD1','117.023099','36.66727','1','17853316170');
