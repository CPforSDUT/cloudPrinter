<!doctype html>
<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] == '1'){
    header("location:/index.php");
}
$username = $_SESSION['user'];
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if (isset($_GET['orderId']))
{
    $orderId = $_GET['orderId'];
    $visit = "select count(*) from fileinfo where orderId='$orderId'";
    $result = mysql_query($visit);
    $row = mysql_fetch_array($result);
    $orderNum = $row['count(*)'];
}
else {
    header("location:order.php");
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
        var allPageNum = <?php echo floor($orderNum/7) + ($orderNum%7 > 0 ? 1 : 0);?>;
        var thisPageNum = 1;
        var orderId = <?php echo "'$orderId';"?>
        function getFiles(pageNum) {
            var geter = new XMLHttpRequest();
            var visit;
            geter.open("POST","control/getFiles.php",false);
            geter.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            visit = "pageNum=" + pageNum + "&orderId=" + orderId;
            geter.send(visit);
            document.getElementById("fileMain").innerHTML = geter.responseText;
        }
        function nextPage() {
            if(thisPageNum + 1 <= allPageNum)
            {
                thisPageNum += 1;
                getFiles(thisPageNum);
                document.getElementById("page_num_index").innerText = "第" + thisPageNum + "/" + allPageNum + "页";
            }
            else {
                alert("已到达最后一页。");
            }
        }
        function prevPage() {
            if(thisPageNum - 1 >= 1)
            {
                thisPageNum -= 1;
                getFiles(thisPageNum);
                document.getElementById("page_num_index").innerText = "第" + thisPageNum + "/" + allPageNum + "页";
            }
            else {
                document.getElementById("page_num_index").innerText = "第" + thisPageNum + "/" + allPageNum + "页";
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
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">文件管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="order.php" method="GET">
                    <table class="search-tab">
                        <tr>
                            <th width="120">选择分类:</th>
                            <td>
                                <select id="sorted" name="sorted">
                                    <option value="0">全部</option>
                                    <option value="1">未打印</option>
                                </select>
                            </td>
                            <th width="70">搜索客户:</th>
                            <td><input class="common-text"   value="" id="search"  name="search" type="text"></td>
                            <td><input class="btn btn-primary btn2" value="查询"  type="submit"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="result-wrap">
            <form name="myform" id="myform" method="post">
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <thead>
                            <tr>
                                <th>文件名</th>
                                <th>色彩</th>
                                <th>打印份数</th>
                                <th>纸张类型</th>
                                <th>其他信息</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id="fileMain">

                        </tbody>

                    </table>

                    <div class="list-page"><a onclick="prevPage()">上一页</a> <p id="page_num_index"></p> <a onclick="nextPage()">下一页</a></div>
                </div>
            </form>
        </div>
    </div>
    <!--/main-->
</div>
  <script type="text/javascript">
      getFiles(1);
      prevPage();
  </script>
</body>
</html>
