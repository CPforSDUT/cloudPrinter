<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
</head>
<body>
<div class="topbar-wrap white">
    <div class="topbar-inner clearfix">
        <div class="topbar-logo-wrap clearfix">
            <h1 class="topbar-logo none"><a href="index.php" class="navbar-brand">后台管理</a></h1>
            <ul class="navbar-list clearfix">
                <li><a class="on" href="index.php">首页</a></li>
                <li><a href="#" target="_blank">网站首页</a></li>
            </ul>
        </div>
        <div class="top-info-wrap">
            <ul class="top-info-list clearfix">
                <li><a href="#">管理员</a></li>
                <li><a href="#">修改密码</a></li>
                <li><a href="#">退出</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="container clearfix">
    <div class="sidebar-wrap">
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
                <h1>使用帮助</h1>
            </div>
            <div class="result-content">
                <ul class="sys-info-list">
                    <li>
                        <label class="res-lab">第一步：</label><span class="res-info">查看所有订单</span><br>
                        <label class="res-lab">第二步：</label><span class="res-info">按照时间顺序依次打印订单</span><br>
                        <label class="res-lab">第三步：</label><span class="res-info">点击打印完成</span><br>
                        <label class="res-lab">第四步：</label><span class="res-info">继续打印</span><br>
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
