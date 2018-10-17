<!DOCTYPE html>
<html lang="zh-CN">
<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['type'] == '2') {
        header("location:/admin/index.php");
    }
    else if($_SESSION['type'] == '1'){
        header("location:/newOrder.php");
    }
    else if($_SESSION['type'] == '3'){
        header("location:/super-admin/index.php");
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
					
                   layer.msg("用户名错误,必须为6-12位字母或数字或下划线");//alert("用户名错误,必须为6-12位字母或数字或下划线");
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
                layer.msg("密码错误,必须为6-16位字母或数字或下划线");
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
		var windowWidth = $(window).width();
			if(windowWidth < 640){
				$('#bosteam').fullpage({
			sectionsColor: ['', '', '#f3fcff', ''],
            navigation: false,
        });
			}
			if(windowWidth >= 640){
				$('#bosteam').fullpage({
			sectionsColor: ['', '', '#f3fcff', ''],
            navigation: true,
        });
			}
	
        
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
  <script type="text/javascript">
	function zduser(){
        var zduser_acc=document.getElementById("username");
        var zduser_pass=document.getElementById("password");
        zduser_acc.value="wlwwlw";
		zduser_pass.value="621129a";
    }
	function zdshang(){
        var zduser_acc=document.getElementById("username");
        var zduser_pass=document.getElementById("password");
        zduser_acc.value="yanshi12";
		zduser_pass.value="621129aa";
    }
	function zdadmin(){
        var zduser_acc=document.getElementById("username");
        var zduser_pass=document.getElementById("password");
        zduser_acc.value="admini";
		zduser_pass.value="admini";
    }
  </script>
</head>
<body>
<div class="black1" id="black1">
    <form class="login_box" id="login_box" action="/user/login.php" method="post" onsubmit="return check()">
            <a id="closebox"><i onclick="closelogin()" class="layui-icon layui-icon-close" style="font-size: 30px; color: #x1006;"></i></a>

            <nav id="login_title">登录</nav>
            <input type="text" name="username" class="button button-rounded button-tiny" id="username" style="text-align:left;"placeholder="请输入账号" value="wlwwlw" />
            <input type="password" name="password"  class="button button-rounded button-tiny" id="password" style="text-align:left;" placeholder="请输入密码" value="621129a" />
        <button id="dl" type="submit" class="button button-3d button-primary button-rounded">立即登录</button>
            <nav id="login_info">没有账号？<a href="/user/registeredView.php" id="zc">马上注册</a></nav>
            <br>
            <span class="login_tips"><a href="#" onclick="zduser()">用户账号:wlwwlw密码:621129a<br></a><a href="#" onclick="zdshang()">商家账号:yanshi12密码：621129aa<br></a><a href="#" onclick="zdadmin()">管理员账号：admini密码:admini<br></a></span>
    </form>
</div>
<div id="bosteam">
    <div class="section">
		
        <video id="bgvideo" autoplay="autoplay" width="100%">
		
			
		<source src="https://sdut1.oss-cn-beijing.aliyuncs.com/bg.mp4" type="video/mp4" />
           
            <!--
            <source src="https://sdut1.oss-cn-beijing.aliyuncs.com/bg.mp4" type="video/mp4" />
            还没转换这个格式
			
			<div class="video-bg-con">
                <video poster="" muted="muted" loop="" class="vidbacking-active-block-back" style="background: url('http://apk.dalongyun.com/dalongyun_page/v2.0.1/indexs/index-section1-bg.jpg') no-repeat center center; background-size: cover;opacity: 1;width:100%;height:100%; object-fit: fill">
                    <source src="http://apk.dalongyun.com/dalongyun_page/v2.0.1/indexs/bg.mp4" type="video/mp4">
                </video>
            </div>

			
			-->
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

    
    <div class="section">
		    <div class="hd" style="postion:fixed;top:0px;">
                <div class="header">
                    <div class="daohang" id="daohang">
                        <a href="newOrder.php"><img src="image/logo1.png" alt="logo" id="logo"></a>
                        <span>
                            <a href="#" onclick="showlogin()">登录</a> | <a href="/user/registeredView.php">注册</a>
                        </span>
                    </div>
                </div>
            </div>
		<div class="set-white">
			<div class="title">
                <nav>支持多种设备传输打印</nav>
                </div>
				<div class="animation"><img src="image/animation.gif" id="ani"></div>
				<div class="bk-down">
					<div class="left">
						<div class="up">通过浏览器打印</div>
						<div class="down">兼容手机端/PC端多种浏览器,只需安装浏览器即可选择文件上传打印</div>
					</div>
					<div class="right1" >
						<center>
						<img src="image/upload.png" id="ys" style="">
						</center>
					</div>
				</div>
		</div>
	</div>
	
  	<div class="section">
		    <div class="hd" style="postion:fixed;top:0px;">
                <div class="header">
                    <div class="daohang" id="daohang">
                        <a href="newOrder.php"><img src="image/logo1.png" alt="logo" id="logo"></a>
                        <span>
                            <a href="#" onclick="showlogin()">登录</a> | <a href="/user/registeredView.php">注册</a>
                        </span>
                    </div>
                </div>
            </div>
			<div class="set-white">
			<div class="title">
                <nav>为何要使用云打印功能？</nav>
                </div>
			  <div class="bk">
				  <div class="up">
					  <div class="left">
						  <div class="bt"><img src="image/safe.png" style="margin:1px;"/>&nbsp;&nbsp;安全可靠</div>
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
		
  	</div>
	
	
	<div class="section">
            <div class="hd" style="postion:fixed;top:0px;">
                <div class="header">
                    <div class="daohang" id="daohang">
                        <a href="newOrder.php"><img src="image/logo1.png" alt="logo" id="logo"></a>
                        <span>
                            <a href="#" onclick="showlogin()">登录</a> | <a href="/user/registeredView.php">注册</a>
                        </span>
                    </div>
                </div>
            </div>
            <div class="main">
                <div class="mt">
                <nav> </nav>

                </div>
                <div class="m1">
                    <div class="m2">
                        <div class="form" id="form0">
                            <a class="button button-glow button-border button-rounded button-primary button-jumbo" id="start" onclick="showlogin()">开始云打印</a>
                        </div>
                    </div>
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
