<!DOCTYPE html>
<?php
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(isset($_GET['install']))
{
    mysql_query("CREATE TABLE IF NOT EXISTS `aisort` (  `username` char(15) DEFAULT NULL,  `sort` varchar(1000) DEFAULT NULL,  `speed` varchar(15) DEFAULT '3',  `doOrder` char(32) DEFAULT 'null',  `hock` char(1) DEFAULT 'n',  `time` char(13) DEFAULT 'null') ENGINE=MyISAM DEFAULT CHARSET=utf8");
    mysql_query("CREATE TABLE IF NOT EXISTS `alloc` (  `username` char(15) NOT NULL DEFAULT '',  `cost` int(11) NOT NULL DEFAULT '60',  `distance` int(11) NOT NULL DEFAULT '70',  `score` int(11) NOT NULL DEFAULT '60') ENGINE=MyISAM DEFAULT CHARSET=utf8");
    mysql_query("CREATE TABLE IF NOT EXISTS `delfiles` (  `orderId` char(32) NOT NULL,  `time` char(20) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
    mysql_query("CREATE TABLE IF NOT EXISTS `fileinfo` (  `orderId` char(32) NOT NULL,  `filePath` varchar(100) NOT NULL,  `color` char(1) NOT NULL DEFAULT '1',  `num` int(11) NOT NULL DEFAULT '1',  `paperType` int(11) NOT NULL DEFAULT '16',  `paperNum` int(11) DEFAULT '-1',  `paperWay` char(1) CHARACTER SET utf32 NOT NULL DEFAULT '1',  `filename` varchar(1000) NOT NULL,  `otherInfo` varchar(500) NOT NULL DEFAULT '') ENGINE=MyISAM DEFAULT CHARSET=utf8");
    mysql_query("CREATE TABLE IF NOT EXISTS `orderids` (  `orderId` char(32) NOT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
    mysql_query("CREATE TABLE IF NOT EXISTS `orderinfo` (  `orderId` char(32) NOT NULL,  `consumer` char(15) NOT NULL,  `business` char(15) NOT NULL,  `deadline` varchar(13) NOT NULL,  `orderState` int(11) NOT NULL DEFAULT '1',  `orderInfo` varchar(400) NOT NULL DEFAULT '',  `exCode` char(6) NOT NULL,  `deleted` char(2) NOT NULL DEFAULT 'nn',  PRIMARY KEY (`orderId`)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
    mysql_query("CREATE TABLE IF NOT EXISTS `printerinfo` (  `username` char(15) NOT NULL,  `color` char(1) NOT NULL DEFAULT '1',  `paperType` int(11) NOT NULL DEFAULT '16',  `A0` varchar(25) DEFAULT '8.0',  `A1` varchar(25) DEFAULT '4.0',  `A2` varchar(25) DEFAULT '2.0',  `A3` varchar(25) DEFAULT '1.0',  `A4` varchar(25) DEFAULT '0.5',  `A5` varchar(25) DEFAULT '0.25',  `A6` varchar(25) DEFAULT '0.25',  `A7` varchar(25) DEFAULT '0.25',  `A8` varchar(25) DEFAULT '0.25',  `A9` varchar(25) DEFAULT '0.25',  `A10` varchar(25) DEFAULT '0.25',  `B0` varchar(25) DEFAULT '8.0',  `B1` varchar(25) DEFAULT '4.0',  `B2` varchar(25) DEFAULT '2.0',  `B3` varchar(25) DEFAULT '1.0',  `B4` varchar(25) DEFAULT '0.5',  `B5` varchar(25) DEFAULT '0.25',  `B6` varchar(25) DEFAULT '0.25',  `B7` varchar(25) DEFAULT '0.25',  `B8` varchar(25) DEFAULT '0.25',  `B9` varchar(25) DEFAULT '0.25',  `B10` varchar(25) DEFAULT '0.25',  `colorBuff` varchar(25) DEFAULT '1.0',  PRIMARY KEY (`username`)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
    mysql_query("CREATE TABLE IF NOT EXISTS `user` (  `username` char(15) NOT NULL,  `password` varchar(16) NOT NULL,  `type` char(1) NOT NULL,  `province` char(50) NOT NULL,  `city` char(50) NOT NULL,  `area` char(50) NOT NULL,  `other` varchar(400) NOT NULL,  `lo` varchar(15) NOT NULL,  `la` varchar(15) NOT NULL,  `state` char(1) NOT NULL,  `phone` char(11) NOT NULL,  `score` varchar(11) DEFAULT '5.0',  PRIMARY KEY (`username`)) ENGINE=MyISAM DEFAULT CHARSET=utf8");
    mysql_query("CREATE TABLE IF NOT EXISTS `pay` (  `username` char(15) DEFAULT NULL,  `pubKey` varchar(1000) DEFAULT NULL,  `priKey` varchar(2000) DEFAULT NULL,  `appId` varchar(17) DEFAULT NULL) ENGINE=MyISAM DEFAULT CHARSET=utf8");
}

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex,nofollow" />
	<title>云打印安装文件</title>
    <link rel="stylesheet" type="text/css" href="/css/buttons.css" />
	
</head>
<body class="bgrd">
<center>
<p id="logo"><img src="http://dayin.sdut1.com/image/logo1.png"></p>
<br>校园云打印 BOS团队
</center>
<div class="main">
    <a class="button button-block button-rounded button-large" href="install.php?install=">用户名:root密码：wslzd9877，数据库地址：localhost，数据库：user。Begin Install</a>
</div>
<script type='text/javascript' src='http://htmlblog.sdut1.com/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='http://htmlblog.sdut1.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
<script type='text/javascript' src='http://htmlblog.sdut1.com/wp-admin/js/language-chooser.min.js?ver=4.8'></script>
</body>
</html>