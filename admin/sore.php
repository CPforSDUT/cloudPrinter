<!doctype html>
<?php
function toPureTime($dirtyTime)
{
    $year = substr($dirtyTime,0,4);
    $month = substr($dirtyTime,4,2);
    $day = substr($dirtyTime,6,2);
    $hours = substr($dirtyTime,8,2);
    $min = substr($dirtyTime,10,2);
    $pure =  "$year-$month-$day $hours:$min";
    return $pure;
}
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
    header("location:/index.php");
}
$username = $_SESSION['user'];
if(isset($_GET['exCode']))
{
    $exCode = $_GET['exCode'];
    $con = mysql_connect("localhost", "root", "wslzd9877");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("user", $con);
    $result = mysql_query("select * from orderinfo where exCode='$exCode' and business='$username'");
    $row = mysql_fetch_array($result);
}
else {
    $row = false;
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
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">输入提取码</span></div>
        </div>
        <div class="search-wrap">
            <form action="sore.php" method="get">
                <table class="search-tab">
                    <tr>
                        <th width="130">请输入提取码：</th>
                        <td><input class="common-text" id="exCode" name="exCode"></td>
                        <td><input class="btn btn-primary btn2" name="btn-submit" value="提取" type="submit"></td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="result-wrap">
            <table class="result-tab" width="100%">
                <tr>
                    <th>买家</th>
                    <th>提取时间</th>
                    <th>打印状态</th>
                    <th>其他信息</th>
                    <th>其它</th>
                </tr>
                <?php
                if($row != false)
                {
                    $consumer = $row['consumer'];
                    $deadline = toPureTime($row['deadline']);
                    $orderState = $row['orderState'] == '1' ? '未打印' : '打印完成';
                    $otherInfo = unescape($row['orderInfo']);
                    $orderId = $row['orderId'];
                    echo "<tr>";
                    echo "<td>$consumer</td>";
                    echo "<td>$deadline</td>";
                    echo "<td>$orderState</td>";
                    echo "<td>$otherInfo</td>";
                    echo "<td><a href='document.php?orderId=$orderId'>查看文件</a></td>";
                    echo "</tr>";
                }
                ?>
        </div>
    </div>
    <!--/main-->
</div>
</body>
</html>
