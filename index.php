<!DOCTYPE html>
<html lang="zh-CN">
<?php
session_start();
if(isset($_SESSION['user']))
{
    if($_SESSION['type'] == '2'){
        header("location:/admin/index.php");
    }
}
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>云打印</title>
  <link rel="stylesheet" href="css/jquery.fullPage.css">

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/layui.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="/css/master.css">
  <link rel="stylesheet" href="css/buttons.css">
  <script src="js/layui.all.js"></script>
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="js/jquery.fullPage.js"></script>
    <script type="text/javascript">
        function check_code() {
            console.log(1);
            //获取账号
            var code =document.getElementById("username").value;
            var reg = /^\w{6,12}$/;
            if(reg.test(code)) {
                return true;
            } else {
                alert("用户名错误,必须为6-12位字母或数字或下划线");
                return false;
            }
        }
        function check_pwd(){
            console.log(2);
            var code2 =document.getElementById("password").value;
            var reg2 = /^\w{6,16}$/;
            if(reg2.test(code2)) {
                return true;
            } else {
                alert("密码错误,必须为6-16位字母或数字或下划线");
                return false;
            }

        }
        function check() {
            return check_code() && check_pwd();
        }
    </script>
  <script type="text/javascript">


    function showlogin() {
            var black1 = document.getElementById("black1");
            black1.style.display = "block";
        }
    function closelogin() {
            var black1 = document.getElementById("black1");
            black1.style.display = "none";
        }
    $(function(){
        $('#bosteam').fullpage({
            navigation: true,
        });
        $(window).resize(function(){
            autoScrolling();
        });
        function autoScrolling(){
            var $ww = $(window).width();
            if($ww < 1024){
                $.fn.fullpage.setAutoScrolling(false);
            } else {
                $.fn.fullpage.setAutoScrolling(true);
            }
        }
        autoScrolling();
    });
    layui.use('element', function(){
        var element = layui.element;
        //…
    });



  </script>

</head>
<body>
<div class="black1" id="black1">
    <form class="login_box" id="login_box" action="/user/login.php" method="post" onsubmit="return check()">
            <a id="closebox"><i onclick="closelogin()" class="layui-icon layui-icon-close" style="font-size: 30px; color: #x1006;"></i></a>
            <nav>登录</nav>
            <input type="text" name="username" id="username" placeholder="请输入账号" />
            <input type="password" name="password" id="password" placeholder="请输入密码" />
        <button id="dl" type="submit" class="button button-block button-rounded button-primary button-large">立即登陆</button>
            <span>没有账号？马上<a href="/user/registeredView.php" id="zc">注册</a></span>
    </form>
</div>
<div id="bosteam">
    <div class="section">
        <video id="bgvideo" autoplay="autoplay" width="100%">
            <source src="bg.webm" type="video/webm" />
            <source src="bg.mp4" type="video/mp4" />
            <!--<source src="bg.ogv" type="video/ogg" />
            还没转换这个格式-->
            您的浏览器不支持 video 标签。请使用更先进的浏览器,如<a href="http://www.google.cn/chrome/browser/" target="_blank">Chrome浏览器</a>或<a href="http://www.firefox.com.cn/download/" target="_blank">Firefox浏览器</a>
        </video>

        <h3>云打印</h3>
        <p class="speak">上传您的文档并选择最近的打印店，即刻体验快捷高效的打印新方式。</p>
        <br>
        <center>
            <a class="layui-btn layui-btn-radius layui-btn-primary" href="/user/loginView.php">登 录</a>
            <a class="layui-btn layui-btn-radius layui-btn-primary" href="/user/registeredView.php">注 册</a>
        </center>
        <!--
              <ul class="layui-nav">   采用layui框架写导航
                <div class="logo">
                  <img src="images/cloud.png" />
                  <span>Cloud Printer</span>
                </div>
                <li class="layui-nav-item">
                  <a href="">登录</a>
                </li>
                <li class="layui-nav-item">
                  <a href="">注册<span class="layui-badge-dot"></span></a>
                </li>
              </ul>
            -->


    </div>

    <div class="container">
        <div class="section">
            <div class="hd">
                <div class="header">
                    <div class="daohang" id="daohang">
                        <a href="newOrder.php"><img src="image/logo1.png" alt="logo" id="logo"></a>
                        <span>
                            <a href="/user/loginView.php">登陆</a>&nbsp;|&nbsp;
                            <a href="/user/registeredView.php">注册</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="main">
                <div class="mt">
                    <span>开始云打印</span>
                </div>
                <div class="m1">
                    <div class="m2">
                        <div class="form" id="form0">
                            <a class="button button-glow button-border button-rounded button-primary button-jumbo" id="start" onclick="showAndHidden0()">创建新订单</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
  		<h3>第三屏</h3>
  	</div>
  	<div class="section">
  		<h3>第四屏</h3>
  		<p>这是最后一屏</p>
  	</div>

</body>
</html>
