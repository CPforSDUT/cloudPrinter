<!doctype html>
<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] == '1'){
    header("location:/index.php");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>商家后台管理</title>
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
            <h1>后台管理</h1>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li>
                    <a href="#"><i class="icon-font">&#xe003;</i>订单管理</a>
                    <ul class="sub-menu">
                        <li><a href="order.php"><i class="icon-font">&#xe005;</i>所有订单</a></li>
                        <li><a href="sore.php"><i class="icon-font">&#xe004;</i>输入提取码</a></li>

                        <li><a href="people.php"><i class="icon-font">&#xe001;</i>用户管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>商家信息设置</a>
                    <ul class="sub-menu">
                      <li><a href="information.php"><i class="icon-font">&#xe000;</i>营业状态</a></li>
                      <li><a href="information.php"><i class="icon-font">&#xe018;</i>打印机参数</a></li>
                      <li><a href="information.php"><i class="icon-font">&#xe021;</i>地理位置</a></li>
                      <li><a href="information.php"><i class="icon-font">&#xe014;</i>头像和其他</a></li>
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


        <div class="result-wrap">
            <div class="result-title">
                <h1>商家使用帮助</h1>
            </div>
            <div class="result-content">
                <ul class="sys-info-list">
                    <li>
                        <label class="res-lab">第一：</label><span class="res-info">查看所有订单</span><br>
                        <label class="res-lab">第二：</label><span class="res-info">按照时间顺序依次打印订单</span><br>
                        <label class="res-lab">第三：</label><span class="res-info">点击打印完成</span><br>
                        <label class="res-lab">第四：</label><span class="res-info">继续打印</span><br>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
