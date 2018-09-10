<!doctype html>
<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '3'){
    header("location:/index.php");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>超级管理员后台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"">
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
	<script src="js/hanbao.js"></script> 
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
	<script type="text/javascript">
		function menu()
		{
			if(document.getElementById('menu').style.display == 'none'){
				document.getElementById('menu').style.display='block';
			}
			else {
				document.getElementById('menu').style.display='none';
			}
		}
	</script>
</head>
<body>

<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.php" class="navbar-brand">商家后台</a></h1>
			  <ul class="navbar-list clearfix">
                  <li><a class="on" href="index.php">首页</a></li>

              </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">

                <li><a href="changePass.php">修改密码</a></li>
                <li><a href="/user/logout.php">退出</a></li>
            </ul>
        </div>
		
		<span onclick="menu()"><i class="fa fa-bars"></i></span>
		
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap" id="menu">
        <div class="sidebar-title">
            <h1>超管后台</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>订单管理</a>
                    <ul class="sub-menu">
                        <li><a href="order.php"><i class="icon-font">&#xe005;</i>所有订单</a></li>
						<li><a href="document.php"><i class="icon-font">&#xe005;</i>所有文件</a></li>
                        
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>账号管理</a>
                    <ul class="sub-menu">
                      <li><a href="shopmt.php"><i class="icon-font">&#xe000;</i>商家管理</a></li>
                      <li><a href="usermt.php"><i class="icon-font">&#xe018;</i>用户管理</a></li>
                    
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!--/sidebar-->
    <div class="main-wrap">
        <div class="crumb-wrap">
            <div class="crumb-list"><i class="icon-font">&#xe06b;</i><span>欢迎使用云打印系统<span></span></span></div>
        </div>
                    <?php
                    $con = mysql_connect("localhost", "root", "wslzd9877");
                    if (!$con) {
                        die('Could not connect: ' . mysql_error());
                    }
                    mysql_select_db("user", $con);
                    $obj2=mysql_query("select count(*) as count2 from user where type='2'");
                    $rows2=mysql_fetch_array($obj2);
                    $obj1=mysql_query("select count(*) as count2 from user where type='1'");
                    $rows1=mysql_fetch_array($obj1);
                    $objorderinfo=mysql_query("select count(*) as countorderinfo from orderinfo");
                    $rowsorderinfo=mysql_fetch_array($objorderinfo);
                    $objfileinfo=mysql_query("select count(*) as countfileinfo from fileinfo");
                    $rowsfileinfo=mysql_fetch_array($objfileinfo);


                    ?>

        <div class="result-wrap">
            <div class="result-title">
                <h1>系统概况显示</h1>
            </div>
            <div class="result-content">
                <ul class="sys-info-list">
                    <li>
                        <label class="res-lab">商家：</label><span class="res-info"><?php echo $rows2['count2'];?>位</span><br>
                        <label class="res-lab">用户：</label><span class="res-info"><?php echo $rows1['count2'];?>位</span><br>
                        <label class="res-lab">订单：</label><span class="res-info"><?php echo $rowsorderinfo['countorderinfo'];?>个</span><br>
                        <label class="res-lab">文件：</label><span class="res-info"><?php echo $rowsfileinfo['countfileinfo'];?>个</span><br>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
