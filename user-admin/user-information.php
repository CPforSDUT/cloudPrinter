<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] == '2'){
    header("location:/index.php");
}
$username = mysql_escape_string($_SESSION['user']);
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$other = mysql_query("select * from user where username = '$username'");
$other = mysql_fetch_array($other);
$other = $other['other'];
?>
<head>
    <title>cloud Print</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/layui.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <script src="../js/layui.all.js"></script>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/jquery.fullPage.js"></script>
    <script type="text/javascript">
        function showCaidan() {
            var caidan = document.getElementById("caidan");
            caidan.style.display = "block";
            document.getElementById("user_pic").src="../image/user_img1.png";
        }
        function hiddenCaidan() {
            var caidan = document.getElementById("caidan");
            caidan.style.display = "none";
            document.getElementById("user_pic").src="../image/user_img1.png";
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="daohang" id="daohang"  onmouseleave="hiddenCaidan()">
                <a href="/index.php"><img src="../image/logo1.png" alt="logo" id="logo"></a>
                <span id="uname"><?php echo "$username";?></span>
                <img src="../image/user_img1.png" alt="用户" id="user_pic" onclick="showCaidan()" onmouseover="document.getElementById('user_pic').src='../image/user_img.png'">
                <div class="caidan" id="caidan">
                    <ul>
                        <li>
                            <a href="/newOrder.php">新订单</a>
                        </li>
                        <li>
                            <a href="/user-admin/user-information.php">个人信息</a>
                        </li>
                        <li>
                            <a href="/user-admin/user-order.php">订单处理</a>
                        </li>
                        <li>
                            <a href="/user-admin/user-information.php">修改密码</a>
                        </li>
                        <!--               <li>
                                           <a href="#">其他功能</a>
                                       </li>-->
                        <li>
                            <a href="/user/logout.php">退出账户</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="main">
            <div class="m1">
                <div class="m2">
                  <form class="layui-form" method="post" action="control/changeInfo.php" onsubmit="document.getElementById('address').value = escape(document.getElementById('address').value)">
                    <div class="layui-form-item">
                      <label class="layui-form-label" >地址</label>
                      <div class="layui-input-block">
                        <input type="text" id="address" name="address" required  lay-verify="required" placeholder="请输入常用收货地址"  autocomplete="off" class="layui-input">
                      </div>
                    </div>
                    <div class="layui-form-item" >
                      <label class="layui-form-label">密码</label>
                      <div class="layui-input-inline">
                        <input type="password" name="password"  placeholder="请输入新密码" autocomplete="off" class="layui-input">
                      </div>
                      <div class="layui-form-mid layui-word-aux">不修改请留空</div>
                    </div>
                    <div class="layui-form-item">
                        <!--<label class="layui-form-label">性别</label>
                        <div class="layui-input-block">
                          <input type="radio" name="sex" value="man" title="男">
                          <input type="radio" name="sex" value="woman" title="女" checked>
                          <input type="radio" name="sex" value="" title="中性" disabled>

                        </div>
                      </div>
                      <div class="layui-form-item layui-form-text">
                        <label class="layui-form-label">头像</label>
                        <button type="button" class="layui-btn" id="test1">
                          <i class="layui-icon">&#xe67c;</i>上传图片
                        </button>-->

                    </div>
                    <div class="layui-form-item">
                      <div class="layui-input-block" style="margin: 0 auto;height: 100%;width: 179px;text-align: center">
                        <button class="layui-btn" lay-submit lay-filter="formDemo" type="submit">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                      </div>
                    </div>
                  </form>
                  <script src="../js/layui.all.js"></script>
                  <script>
                  layui.use('form', function(){
                    var form = layui.form;

                    //各种基于事件的操作，下面会有进一步介绍
                  });
                  </script>

                  <script>
                      var address = <?php echo "'$other'";?>;
                      document.getElementById('address').value =  unescape(address);
                  layui.use('upload', function(){
                    var upload = layui.upload;

                    //执行实例
                    var uploadInst = upload.render({
                      elem: '#test1' //绑定元素
                      ,url: '/upload/' //上传接口
                      ,done: function(res){
                        //上传完毕回调
                      }
                      ,error: function(){
                        //请求异常回调
                      }
                    });
                  });
                  </script>

                </div>

            </div>
        </div>
    </div>
</body>

</html>
