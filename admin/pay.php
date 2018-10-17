<!doctype html>
<?php
session_start();
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
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '2'){
    header("location:/index.php");
}
else {
    $username = mysql_escape_string($_SESSION['user']);
    $password = mysql_escape_string($_SESSION['pass']);
}
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password' and type='2'")) == false){
    header("location:/index.php");
    exit();
}
if(isset($_GET['appId']) && $_GET['appId'] != '')
{
    $pubKey = mysql_escape_string($_GET['pubKey']);
    $priKey = mysql_escape_string($_GET['priKey']);
    $appId = mysql_escape_string($_GET['appId']);
    mysql_query("update pay set pubKey='$pubKey',priKey='$priKey',appId='$appId' where username='$username'");
}
$pay = mysql_query("select * from pay where username='$username'");
$pay = mysql_fetch_array($pay);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3" charset="UTF-8"></script>
    <style type="text/css">
        #map{
            margin: auto;
            width: 600px;
            height: 320px;
            position: relative;
            border-radius: 6px;
            z-index: 10;
            /* border: 10px dashed #62c1fb; */
        }
    </style>
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
    <script type="text/javascript">
        function init() {
            document.getElementById("pub_key").value = "<?php echo $pay['pubKey'];?>";
            document.getElementById("pri_key").value = "<?php echo $pay['priKey'];?>";
            document.getElementById("app_id").value = "<?php echo $pay['appId'];?>";
        }
        function submitInfo() {

            var pubKey = encodeURIComponent(document.getElementById("pub_key").value);
            var priKey = encodeURIComponent(document.getElementById("pri_key").value);
            var appId = encodeURIComponent(document.getElementById("app_id").value);
            window.location.href="pay.php?pubKey="+pubKey+"&priKey="+priKey+"&appId="+appId;
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
                        <li><a href="information.php#state"><i class="icon-font">&#xe000;</i>营业状态</a></li>
                        <li><a href="information.php#print_info"><i class="icon-font">&#xe018;</i>打印参数</a></li>
                        <li><a href="information.php#location"><i class="icon-font">&#xe021;</i>地理位置</a></li>
                        <li><a href="information.php#persionnal"><i class="icon-font">&#xe014;</i>修改密码</a></li>
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
                <h1>支付信息设置</h1>
            </div>

            <div class="result-content">
              <div class="search-wrap">
                  <div class="search-content">
                          <table class="search-tab">
                              <tr>
                                  <th width="120">支付类型：</th>
                                  <td>
                                      <select name="business-state" id="state">
                                          <option value="0">支付宝2.0</option>
                                        
                                      </select>
                                  </td>
                              </tr>
							  <tr>
								 <th width="120">APPID*：</th>
								  <td>
                                       <input id="app_id" class="form-control" name="" data-rule-required='true' placeholder="不使用在线支付请留空" value="" />
                                  </td>
							  </tr>
							  <tr>
								 <th width="120">支付宝公钥*：</th>
								  <td>
                                      <textarea id="pub_key" name="" rows="4" data-rule-required='true' class="form-control"></textarea>

                                  </td>
							  </tr>
							  <tr>
								 <th width="120">应用私钥*：</th>
								  <td>
                                     <textarea id="pri_key" name="" style="" data-rule-required='true' rows="4" class="form-control"></textarea>
                                  </td>
							  </tr>
							 
                          </table>
                  </div>
            </div>

           
    <center>
<input class="btn btn-primary"id="sbt" value="提交" onclick="submitInfo()" type="submit" style="margin-top:10px;">
</center>

</div>
        <script type="text/javascript">init();</script>
</body>
</html>
