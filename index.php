<!DOCTYPE html>
<html lang="zh-CN">
<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['type'] == '2') {
        header("location:/admin/index.php");
    }
    else{
        header("location:/newOrder.php");
    }
}
?>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>云打印</title>
  <link rel="stylesheet" href="css/jquery.fullPage.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/layui.css">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" type="text/css" href="/css/master.css">
  <link rel="stylesheet" href="css/buttons.css">
  <link rel="stylesheet" href="css/intru.css">
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
			sectionsColor: ['#33aafe', '', '#fff', '#33aafe'],
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
            <input type="text" name="username" class="button button-rounded button-tiny" id="username" style="text-align:left;"placeholder="请输入账号" />
            <input type="password" name="password"  class="button button-rounded button-tiny" id="password" style="text-align:left;" placeholder="请输入密码" />
        <button id="dl" type="submit" class="button button-3d button-primary button-rounded">立即登陆</button>
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
            您的浏览器不支持 video 标签。请使用更先进的浏览器,如<a href="http://www.google.cn/chrome/browser/" target="_blank">Chrome浏览器</a>或<a href="http://www.firefox.com.cn/download/" target="_blank">Firefox浏览器</a>
        </video>
		

        <h3>云打印</h3>
        <p class="speak">上传您的文档并选择最近的打印店，即刻体验快捷高效的打印新方式。</p>
        <br>
        <center>
            <a class="layui-btn layui-btn-radius layui-btn-primary" onclick="showlogin()">登 录</a>
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
                            <a href="/index.php?login=">登录</a> | <a href="/user/registeredView.php">注册</a>
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
                            <a class="button button-glow button-border button-rounded button-primary button-jumbo" id="start" onclick="showlogin()">创建新订单</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section">
		<div class="set-white">
			<div class="title">支持多种设备传输打印</div>
				<div class="animation"><img src="image/animation.gif" id="ani"></div>
				<div class="bk-down">
					<div class="left">
						<div class="up">通过浏览器打印</div>
						<div class="down">兼容手机端/pc端多种浏览器,只需安装浏览器即可选择文件上传打印</div>
					</div>
					<div class="right1" >
						<img src="image/upload.png" id="ys" style="width:502px; height:332px;">
					</div>
				</div>
			</div>
	</div>
  	<div class="section">
			
				  <div class="title">为何要使用云打印功能？</div>
			  <div class="bk">
				  <div class="up">
					  <div class="left">
						  <div class="bt"><img src="image/safe.png"/>&nbsp;&nbsp;安全可靠</div>
						  <div class="nr">一旦打印完成，用户可以随时选择删除在服务器的相应文档。</div>
					  </div>
					  <div class="right">
						  <div class="bt"><img src="image/fb.png" />&nbsp;&nbsp;方便实用</div>
						  <div class="nr">用户可以通过任意设备浏览器传输文件，实现随时下单。</div>
					  </div>
				  </div>

				  <div class="down">
					  <div class="left">
						  <div class="bt"><img src="image/mb.png" />&nbsp;&nbsp;打印迅速</div>
						  <div class="nr">用户通过提取码可以实现到店即取，为用户节省时间。</div>
					  </div>
					  <div class="right">
						  <div class="bt"><img src="image/hb.png" />&nbsp;&nbsp;货比三家</div>
						  <div class="nr">多家打印店提供服务，用户可以自由选择打印店。</div>
					  </div>
				  </div>
			  </div>
		
  	</div>
    <script>
        <?php
        if(isset($_GET['login']) == true){
            echo "showlogin();";
        }
        ?>
    </script>

</body>
</html>
