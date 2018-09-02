<!doctype html>
<?php
function unescape($str) {
    $ret = '';
    $len = strlen ( $str );
    for($i = 0; $i < $len; $i ++) {
        if ($str [$i] == '%' && $str [$i + 1] == 'u') {
            $val = hexdec ( substr ( $str, $i + 2, 4 ) );
            if ($val < 0x7f)
                $ret .= chr ( $val );
            else if ($val < 0x800)
                $ret .= chr ( 0xc0 | ($val >> 6) ) . chr ( 0x80 | ($val & 0x3f) );
            else
                $ret .= chr ( 0xe0 | ($val >> 12) ) . chr ( 0x80 | (($val >> 6) & 0x3f) ) . chr ( 0x80 | ($val & 0x3f) );
            $i += 5;
        } else if ($str [$i] == '%') {
            $ret .= urldecode ( substr ( $str, $i, 3 ) );
            $i += 2;
        } else
            $ret .= $str [$i];
    }
    return $ret;
}
session_start();
if(isset($_SESSION['user']) == false){
    header("location:/user/loginView.php");
}
else {
    $username = $_SESSION['user'];
}
?>
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
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">用户管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="people.php" method="get">
                    <table class="search-tab">
                        <tr>
                            <!--<th width="120">选择分类:</th>
                            <td>
                                <select name="search-sort" id="">
                                    <option value="0">全部</option>
                                    <option value="1">今日订单</option>
                                    <option value="2">昨日订单</option>
                                    <option value="3">本月订单</option>
                                    <option value="4">上月订单</option>
                                </select>
                            </td>-->
                            <th width="78">关键字:</th>
                            <td><input class="common-text" placeholder="关键字" name="keyword" value="" id="" type="text"></td>
                            <td><input class="btn btn-primary btn2" name="sub" value="查询" type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <!-- <div class="result-title">
                    <div class="result-list">
                        <a href="insert.php"><i class="icon-font"></i>新增订单</a>
                        <a id="batchDel" href="javascript:void(0)"><i class="icon-font"></i>批量删除</a>
                        <a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>
                    </div>
                </div> -->
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <tr>
                            <th>用户名</th>
                            <th>详细地址</th>
                            <th>联系方式</th>

                        </tr>
                        <?php
                            if(isset($_GET['keyword'])) {
                                $keyword = $_GET['keyword'];
                                $con = mysql_connect("localhost", "root", "wslzd9877");
                                if (!$con) {
                                    die('Could not connect: ' . mysql_error());
                                }
                                mysql_select_db("user", $con);
                                $result = mysql_query("select * from orderinfo where business='$username' and consumer='$keyword'");
                                $row = mysql_fetch_array($result);
                                if($row != false) {
                                    $result = mysql_query("select * from user where username='$keyword'");
                                    $row = mysql_fetch_array($result);
                                    if($row != false ) {
                                        $other = unescape($row['other']);
                                        $lo = $row['lo'];
                                        $la = $row['la'];
                                        $phone = $row['phone'];
                                        ?>
                                        <tr>
                                            <td><?php echo $keyword;?></td>
                                            <td><?php echo $other;?></td>
                                            <td><?php echo $phone;?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                        ?>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
