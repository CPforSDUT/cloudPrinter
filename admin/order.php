<!doctype html>
<?php
    session_start();
    if(isset($_SESSION['user']) == false || $_SESSION['type'] != '2'){
        header("location:/index.php");
    }
    $username = mysql_escape_string($_SESSION['user']);
?>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="http://dayin.sdut1.com/js/layui.all.js"></script>
	<link href="http://dayin.sdut1.com/css/layui.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
	<script src="https://cdn.bootcss.com/jquery/3.3.1/jquery.js"></script>
	<link href="https://cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <script type="text/javascript" src="js/libs/modernizr.min.js"></script>
    <script type="text/javascript">
        var allPageNum ;
        var lPENum;
        var allENum = -1;
        var thisPageNum = 1;
        var checkboxs = Array();

        <?php
            if(isset($_GET['sorted']))
            {
                $sorted = mysql_escape_string($_GET['sorted']);
        ?>
        var sorted = <?php echo "'$sorted';";?>
        <?php
            }else {
        ?>
            var sorted = false;
        <?php
            }
        ?>
        <?php
        if(isset($_GET['search']))
        {
        $search = mysql_escape_string($_GET['search']);
        ?>
        var search = <?php echo "'$search';";?>
        <?php
        }else {
        ?>
        var search = false;
        <?php
        }
        ?>
        function update() {
            getOrderInfo(thisPageNum);
            var newENum = document.getElementById("eNum").innerHTML;
            if(newENum > allENum)
            {
                if(allENum != -1){
					layer.open({
					  title: '您有新的订单'
					  ,content: '收到了新打印请求，请及时处理！'
					});     
  
                    
                }
                allENum = newENum;
                allPageNum = parseInt(allENum/7);
                if(allENum % 7 > 0){
                    allPageNum += 1;
                }
                lPENum = allENum % 7;
                if(lPENum == 0){
                    lPENum = 7;
                }

                document.getElementById("page_num_index").innerText = "第" + thisPageNum + "/" + allPageNum + "页";
            }

        }
        function getOrderInfo(pageNum) {
            var geter = new XMLHttpRequest();
            var visit;
            geter.open("POST","control/getOrderInfo.php",false);
            geter.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            visit = "pageNum=" + pageNum;
            if(sorted != false)
            {
                //alert(sorted);
                switch (sorted)
                {
                    case '1':
                        visit += "&sorted=1";
                        break;
                }
            }
            if(search != false && search != ''){
                visit += "&search=" + search;
            }
            geter.send(visit);
            document.getElementById("orderMain").innerHTML = geter.responseText;
        }
        function nextPage() {
            if(thisPageNum + 1 <= allPageNum)
            {
                thisPageNum += 1;
                getOrderInfo(thisPageNum);
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
                getOrderInfo(thisPageNum);
                document.getElementById("page_num_index").innerText = "第" + thisPageNum + "/" + allPageNum + "页";
            }
            else {
                document.getElementById("page_num_index").innerText = "第" + thisPageNum + "/" + allPageNum + "页";
            }
        }
        function okOrder(orderId){
            var setOrderInfo = new XMLHttpRequest();
            setOrderInfo.open("POST","control/setOrderInfo.php",false);
            setOrderInfo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            setOrderInfo.send("orderId="+orderId + "&method=okOrder");
            if(sorted == '1')
            {
                lPENum -= 1;
                if(lPENum == 0){
                    allPageNum -= 1;
                    if(thisPageNum > allPageNum){
                        thisPageNum = allPageNum;
                        getOrderInfo(thisPageNum);
                    }
                    if(thisPageNum > 0){
                        lPENum = 7;
                    }
                    document.getElementById("page_num_index").innerText = "第" + thisPageNum + "/" + allPageNum + "页";
                }
            }

            getOrderInfo(thisPageNum);
        }
        function delOrder(orderId) {
            var setOrderInfo = new XMLHttpRequest();
            setOrderInfo.open("POST","control/setOrderInfo.php",false);
            setOrderInfo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            setOrderInfo.send("orderId="+orderId + "&method=delete");
            document.getElementById(orderId).innerHTML = "已删除";
            lPENum -= 1;
            if(lPENum == 0){
                allPageNum -= 1;
                if(thisPageNum > allPageNum){
                    thisPageNum = allPageNum;
                    getOrderInfo(thisPageNum);
                }
                if(thisPageNum > 0){
                    lPENum = 7;
                }
                document.getElementById("page_num_index").innerText = "第" + thisPageNum + "/" + allPageNum + "页";
            }
            getOrderInfo(thisPageNum);
        }
        function checkbox(orderId) {
            if(checkboxs[orderId] == undefined) {
                checkboxs[orderId] = true;
            }
            else if(checkboxs[orderId] == true) {
                checkboxs[orderId] = false;
            }else {
                checkboxs[orderId] = true;
            }
        }
        function delOrders() {
            var each;
            for (each in checkboxs)
            {
                if(checkboxs[each] == true){
                    delOrder(each);
                }
            }
            document.getElementById("allChoose").checked = false;
        }
        function allChoose() {
            for(var i = 0 ; i < 7 ; i ++)
            {
                document.getElementById("check"+i).click();
            }
        }
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
                        <li><a href="sore.php"><i class="icon-font">&#xe004;</i>输入提取码</a></li>

                        <li><a href="people.php"><i class="icon-font">&#xe001;</i>用户管理</a></li>
                      </ul>
                  </li>
                  <li>
                      <a href="#"><i class="icon-font">&#xe018;</i>商家信息设置</a>
                      <ul class="sub-menu">
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
            <div class="crumb-list"><i class="icon-font"></i><a href="index.php">首页</a><span class="crumb-step">&gt;</span><span class="crumb-name">订单管理</span></div>
        </div>
        <div class="search-wrap">
            <div class="search-content">
                <form action="order.php" method="GET">
                    <table class="search-tab">
                        <tr>
                            <th width="90">选择分类:</th>
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
                <div class="result-title">
                    <div class="result-list">
                        <!--<a href="insert.php"><i class="icon-font"></i>新增订单</a>-->
                        <a id="batchDel" onclick="delOrders()"><i class="icon-font"></i>批量删除</a>
                        <!--<a id="updateOrd" href="javascript:void(0)"><i class="icon-font"></i>更新排序</a>-->
                    </div>
                </div>
            <div id="newOrderTips" style="display: none"><p>您有新订单!</p><a onclick="document.getElementById('newOrderTips').style.display='none'">x</a></div>
                <div class="result-content">
                    <table class="result-tab" width="100%">
                        <thead>
                            <tr>
                                <th class="tc" width="5%"><input onclick="allChoose()" id="allChoose" type="checkbox"></th>
                                <th>订单状态</th>
                                <th>发布人</th>
								<th>提取码</th>
                                <th>完成时间</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody id="orderMain">

                        </tbody>

                    </table>
                    <div class="list-page"><a onclick="prevPage()">上一页</a> <p id="page_num_index"></p> <a onclick="nextPage()">下一页</a></div>
                </div>
        </div>
    </div>
    <!--/main-->
      <script type="text/javascript">
          update();
          if(sorted != false){
              var sorter = document.getElementById("sorted");
              switch (sorted)
              {
                  case '1':
                      sorter.options[1].selected = true;
                      break;
              }
          }
          if(search != false)
          {
              document.getElementById("search").value = search;
          }
          setInterval("update()",10000);
      </script>
</div>
</body>
</html>
