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
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '3'){
    header("location:/index.php");
}
else {
    $username = mysql_escape_string($_SESSION['user']);
}
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
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
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">用户管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="shopmt.php" method="get">
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
                            <td><input class="common-text" placeholder="关键字" name="keyword" value="" id="keyword" type="text"></td>
                            <td><input class="btn btn-primary btn2" value="查询" type="submit"></td>
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
                                $keyword = mysql_escape_string($_GET['keyword']);
                                $con = mysql_connect("localhost", "root", "wslzd9877");
                                if (!$con) {
                                    die('Could not connect: ' . mysql_error());
                                }
                                mysql_select_db("user", $con);

                        $count = "select count(*) as countnums from user where type='2'";

                        if(isset($_GET['keyword']) && $_GET['keyword']!=''){
                            $count = $count." and username='$keyword'";

                        }

                        $userobj=mysql_query($count);
                        $userrows=mysql_fetch_array($userobj);
                        $addcount=$userrows['countnums'];

                        $num=7;
                        $pages=ceil($addcount/$num);


                        $page=$_GET['page'];
                        if(isset($_GET['page'])==false)
                        {
                            $page=1;
                        }
                        if($page<=1)
                        {
                            $page=1;
                        }
                        if($page>$pages)
                        {
                            $page=$pages;
                        }

                        $offset=($page-1 < 0 ?0:$page-1 )*$num;
                        $pageup=$page-1;
                        $pagedown=$page+1;


                        $visit = "select * from user where type='2'";
                                if(isset($_GET['keyword']) == true && $_GET['keyword'] != ''){
                                    $visit = $visit . " and username='$keyword'";
                                    $pagedown = $pagedown.'&keyword='.$_GET['keyword'];
                                    $pageup= $pageup."&keyword=".$_GET['keyword'];
                                }

                                $result2 = mysql_query("$visit limit $offset,$num");
                                echo "$visit limit $offset,$num";
                                while( $row = mysql_fetch_array($result2)) {


                                    if($row != false ) {
                                        $consumer = $row['username'];
                                        $other = unescape($row['other']);
                                        $phone = $row['phone'];
                                        ?>
                                        <tr>
                                            <td><?php echo $consumer;?></td>
                                            <td><?php echo $other;?></td>
                                            <td><?php echo $phone;?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                        ?>
                    </table>
                    <div class="list-page"><a href="shopmt.php?page=<?php echo $pageup;?>">上一页</a><p id="pageNum"></p><a href="shopmt.php?page=<?php echo $pagedown;?>">下一页</a></div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
  <script type="text/javascript">

      <?php
      if(isset($_GET['keyword'])  && $_GET['keyword']!=''){
      ?>
      document.getElementById("keyword").value = <?php echo "'$keyword'";?>;
      <?php

      }
      echo "document.getElementById('pageNum').innerHTML='第$page/$pages 页';";
      ?>

  </script>
</body>

</html>
