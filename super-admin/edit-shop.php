<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>超级管理员后台</title>
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
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
              <h1 class="topbar-logo none"><a href="index.php" class="navbar-brand">后台管理</a></h1>
              <ul class="navbar-list clearfix">
                  <li><a class="on" href="index.php">首页</a></li>

              </ul>
          </div>
          <div class="top-info-wrap">
              <ul class="top-info-list clearfix">

                  <li><a href="#">修改密码</a></li>
                  <li><a href="/user/logout.php">退出</a></li>
              </ul>
          </div>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span class="crumb-step">&gt;</span><a class="crumb-name" href="order.php">订单管理</a><span class="crumb-step">&gt;</span><span>插入订单</span></div>
        </div>
        <div class="result-wrap">
            <div class="result-content">
                <form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>
                            <tr>
                                <th>商户名：</th>
                                <td>
                                    <input class="common-text" id="title" name="title" size="50" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>密码：</th>
                                <td><input class="common-text" name="author" size="50" value="admin" type="text"></td>
                            </tr>
							<tr>
                                <th>详细地址：</th>
                                <td><input class="common-text" name="author" size="50" value="admin" type="text"></td>
                            </tr>
							<tr>
                                <th>电话号码：</th>
                                <td><input class="common-text" name="author" size="50" value="admin" type="text"></td>
                            </tr>
                            <tr>
                                <th></th>
                                <td>
                                    <input class="btn btn-primary btn6 mr10" value="提交" type="submit">
                                    <input class="btn btn6" onclick="history.go(-1)" value="返回" type="button">
                                </td>
                            </tr>
                        </tbody></table>
                </form>
            </div>
        </div>

    </div>
    <!--/main-->
</div>
</body>
</html>
