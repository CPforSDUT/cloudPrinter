<!doctype html>
<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '3'){
    header("location:/index.php");
}
$username = mysql_escape_string($_SESSION['user']);
$password = mysql_escape_string($_SESSION['pass']);
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);

if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password'")) == false){
    header("location:/index.php");
    exit();
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
function escape($str) {
    preg_match_all ( "/[\xc2-\xdf][\x80-\xbf]+|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}|[\x01-\x7f]+/e", $str, $r );
    //匹配utf-8字符，
    $str = $r [0];
    $l = count ( $str );
    for($i = 0; $i < $l; $i ++) {
        $value = ord ( $str [$i] [0] );
        if ($value < 223) {
            $str [$i] = rawurlencode ( utf8_decode ( $str [$i] ) );
            //先将utf8编码转换为ISO-8859-1编码的单字节字符，urlencode单字节字符.
            //utf8_decode()的作用相当于iconv("UTF-8","CP1252",$v)。
        } else {
            $str [$i] = "%u" . strtoupper ( bin2hex ( iconv ( "UTF-8", "UCS-2", $str [$i] ) ) );
        }
    }
    return join ( "", $str );
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
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
		function init() {
            <?php
            if(isset($_GET['cUser']))
            {
                $cUser = $_GET['cUser'];
                $info = mysql_query("select * from user where username='$cUser'");
                $row = mysql_fetch_array($info);
                if($row != false)
                {
                    $cUser = $row['username'];
                    $cPass = $row['password'];
                    $cOther = unescape($row['other']);
                    $cPhone = $row['phone'];
                    echo "document.getElementById('cUser').value='$cUser';";
                    echo "document.getElementById('cPass').value='$cPass';";
                    echo "document.getElementById('cOther').value='$cOther';";
                    echo "document.getElementById('cPhone').value='$cPhone';";
                }
            }
            if(isset($_POST['cUser']))
            {
                $cUser = $_POST['cUser'];
                $cPass = $_POST['cPass'];
                $cOther = $_POST['cOther'];
                $cPhone = $_POST['cPhone'];
                echo "document.getElementById('cUser').value='$cUser';";
                echo "document.getElementById('cPass').value='$cPass';";
                echo "document.getElementById('cOther').value='$cOther';";
                echo "document.getElementById('cPhone').value='$cPhone';";
                $cOther = escape($cOther);
                mysql_query("UPDATE user SET username='$cUser',password='$cPass',other='$cOther',phone='$cPhone' where username='$cUser'");
                echo "alert('修改成功!');";
            }
            ?>
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
                <form action="edit-user.php" method="post" id="myform" name="myform" enctype="multipart/form-data">
                    <table class="insert-tab" width="100%">
                        <tbody>

                            <tr>
                                <th>用户名：</th>
                                <td>
                                    <input class="common-text" id="cUser" name="cUser" size="50" value="" type="text">
                                </td>
                            </tr>
                            <tr>
                                <th>密码：</th>
                                <td><input class="common-text" id="cPass" name="cPass" size="50" value="admin" type="password"></td>
                            </tr>
							<tr>
                                <th>详细地址：</th>
                                <td><input class="common-text" id="cOther" name="cOther" size="50" value="admin" type="text"></td>
                            </tr>
							<tr>
                                <th>电话号码：</th>
                                <td><input class="common-text" id="cPhone" name="cPhone" size="50" value="admin" type="text"></td>
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
      <script type="text/javascript">
          init();
      </script>
    <!--/main-->
</div>
</body>
</html>
