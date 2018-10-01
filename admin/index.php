<!doctype html>
<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '2'){
    header("location:/index.php");
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>商家后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
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

                <li><a href="information.php">修改密码</a></li>
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
                        <li><a href="index.php"><i class="icon-font">&#xe017;</i>系统推荐订单</a></li>
                        <li><a href="order.php"><i class="icon-font">&#xe005;</i>所有订单</a></li>
                        <li><a href="sore.php"><i class="icon-font">&#xe004;</i>输入提取码</a></li>
                        <li><a href="people.php"><i class="icon-font">&#xe001;</i>用户管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>商家信息设置</a>
                    <ul class="sub-menu">
					<li><a href="pay.php"><i class="icon-font">&#xe022;</i>支付设置</a></li>
                      <li><a href="information.php"><i class="icon-font">&#xe000;</i>营业状态</a></li>
                      <li><a href="information.php"><i class="icon-font">&#xe018;</i>打印参数</a></li>
                      <li><a href="information.php"><i class="icon-font">&#xe021;</i>地理位置</a></li>
                      <li><a href="information.php"><i class="icon-font">&#xe014;</i>修改密码</a></li>
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
                <h1>推荐打印订单</h1>
            </div>
            <div class="result-content">
              <div class="search-wrap">
                  <div class="search-content">
                          <table class="search-tab">
                              <tr>
                                  <td>
                                    <span class="res-info">我们根据算法，综合考虑了打印页数、提取时间、打印份数及特殊要求等因素，智能为您推荐最先打印的订单，您也可以点击左侧所有订单自己进行选择。</span>
                                  </td>
                              </tr>
                          </table>
                  </div>
            </div>
			
			<div class="result-content">
                    <table class="result-tab" width="100%">
                        <thead>
                            <tr>
                                <th>打印顺序</th>
                                <th>客户</th>
								<th>提取码</th>
                                <th>提交顺序</th>
                                <th>用户提取时间</th>
                                <th>打印耗时</th>
								<th>预计完成时间</th>
                            </tr>
                        </thead>
                        <tbody id="orderMain">

                        </tbody>

                    </table>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
