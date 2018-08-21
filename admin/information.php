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
                        <li><a href="document.php"><i class="icon-font">&#xe006;</i>文件管理</a></li>
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
                <h1>商家信息设置</h1>
            </div>

            <div class="result-content">
              <div class="search-wrap">
                  <div class="search-content">
                      <form action="" method="post">
                          <table class="search-tab">
                              <tr>
                                  <th width="120">营业状态:</th>
                                  <td>
                                      <select name="business-state" id="">
                                          <option value="0">开店</option>
                                          <option value="1">关店</option>
                                      </select>
                                  </td>
                              </tr>
                          </table>
                      </form>
                  </div>
            </div>

            <div class="result-content">
              <div class="search-wrap">
                  <div class="search-content">
                      <form action="" method="post">
                          <table class="search-tab">
                              <tr>
                                  <th>
                                  <label class="res-lab">纸张类型：</label>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A0 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A1 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A2 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A3 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A4 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A5 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A6 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A7 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A8 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A9 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />A10 </span>
                                      <br />
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B0 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B1 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B2 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B3 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B4 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B5 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B6 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B7 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B8 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B9 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />B10 </span>
                                      <br/>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />铜版纸 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />照片 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />覆膜 </span>
                                  </th>
                              </tr>

                                <tr>
                                  <th>
                                  <label class="res-lab">是否支持彩色：</label>
                                    <select name="business-state" id="">
                                              <option value="0">彩色</option>
                                              <option value="1">黑白</option>
                                    </select>
                                  </th>
                              </tr>
                          </table>

                      </form>
                  </div>
            </div>

            <div class="result-content">
              <div class="search-wrap">
                  <div class="search-content">
                      <form action="" method="post">
                          <table class="search-tab">
                              <tr>
                                  <th width="120">地理位置</th>
                                  <td>
                                      此处插入地图定位
                                      <br><br><br><br><br><br><br>
                                  </td>
                              </tr>
                          </table>
                      </form>
                  </div>
            </div>


            <div class="result-content">
              <div class="search-wrap">
                  <div class="search-content">
                      <form action="" method="post">
                          <table class="search-tab">
                              <tr>
                                  <th width="120">头像</th>
                                  <td>
                                    <div class="con4">
                                       <canvas id="cvs" width="200" height="200"></canvas>
                                       <br>
                                       <span class="btn upload">上传头像<input type="file" class="upload_pic" id="upload" /></span>
                                  </td>
                              </tr>
                          </table>
                      </form>
                  </div>
            </div>

<center>
  <input class="btn btn-primary" value="提交" type="submit">
</center>

        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
