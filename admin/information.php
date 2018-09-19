<!doctype html>
<?php
session_start();
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
if(isset($_GET['set']))
{
    $state = $_GET['state'];
    $paperType = $_GET['paperType'];
    $color = $_GET['color'];
    $province = $_GET['province'];
    $city = $_GET['city'];
    $area = $_GET['area'];
    $other = $_GET['other'];
    $lo = $_GET['lo'];
    $la = $_GET['la'];
	$A0=$_GET['costA0'];$A1=$_GET['costA1'];$A2=$_GET['costA2'];$A3=$_GET['costA3'];$A4=$_GET['costA4'];$A5=$_GET['costA5'];
	$A6=$_GET['costA6'];$A7=$_GET['costA7'];$A8=$_GET['costA8'];$A9=$_GET['costA9'];$A10=$_GET['costA10'];

	$B0=$_GET['costB0'];$B1=$_GET['costB1'];$B2=$_GET['costB2'];$B3=$_GET['costB3'];$B4=$_GET['costB4'];$B5=$_GET['costB5'];
	$B6=$_GET['costB6'];$B7=$_GET['costB7'];$B8=$_GET['costB8'];$B9=$_GET['costB9'];$B10=$_GET['costB10'];
    $caiyin = $_GET['caiyin'];
	
    //echo "UPDATE user SET state='$state',province='$province',city='$city',area='$area',other='$other',lo='$lo',la='$la' WHERE username='$username'";
    //echo "UPDATE printerinfo SET color='$color',paperType='$paperType' WHERE username='$username'";
    mysql_query("UPDATE user SET state='$state',province='$province',city='$city',area='$area',other='$other',lo='$lo',la='$la' WHERE username='$username'");
    mysql_query("UPDATE printerinfo SET color='$color',paperType='$paperType',A0='$A0',A1='$A1',A2='$A2',A3='$A3',A4='$A4',A5='$A5',A6='$A6',A7='$A7',A8='$A8',A9='$A9',A10='$A10',B0='$B0',B1='$B1',B2='$B2',B3='$B3',B4='$B4',B5='$B5',B6='$B6',B7='$B7',B8='$B8',B9='$B9',B10='$B10',colorBuff='$caiyin' WHERE username='$username'");

}
$result = mysql_query("select * from user where username='$username'");
$row = mysql_fetch_array($result);
$province = $row['province'];
$city = $row['city'];
$area = $row['area'];
$other = $row['other'];
$state = $row['state'];
$lo = $row['lo'];
$la = $row['la'];

$result = mysql_query("select * from printerinfo where username='$username'");
$row = mysql_fetch_array($result);
if($row == false)
{
    mysql_query("INSERT INTO printerinfo (username)VALUES (\"$username\")");
}
$result = mysql_query("select * from printerinfo where username='$username'");
$row = mysql_fetch_array($result);
$paperType = $row['paperType'];
$color = $row['color'];
$colorBuff = $row['colorBuff'];
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
        var paperType = Array();
        var paperSizes2 = Array(1,2,4,8,16,32,64,128,256,512,1024,2048,4096,8192,16384,32768,65536,131072,262144,524288,1048576,2097152);
        function paperTypeToNum() {
            var res = 0;
            for(var i = 1 ; i <= 22 ; i ++){
                if(paperType[i] == true){
                    res |= paperSizes2[i-1];
                }
            }
            return res;
        }
        function submitInfo() {
			
            var state,color,province,city,area,other,paperNum,lo,la,caiyin;
			var send;
			var types = ["costA0","costA1","costA2","costA3","costA4","costA5","costA6","costA7","costA8","costA9","costA10","costB0","costB1","costB2","costB3","costB4","costB5","costB6","costB7","costB8","costB9","costB10"];
            province = escape(document.getElementById("province").value);
            city = escape(document.getElementById("city").value);
            area = escape(document.getElementById("area").value);
            other = escape(document.getElementById("other").value);
            lo = document.getElementById("lo").value;
            la = document.getElementById("la").value;
            var caiyin = document.getElementById("caiyin").value;
            paperNum =  paperTypeToNum();
            if(document.getElementById("state").options[0].selected == true){
                state = '1';
            }
            else {
                state = '2';
            }
            if(document.getElementById("color").options[0].selected == true){
                color = '1';
            }
            else {
                color = '2';
            }
			send = 'information.php?'+'set=1&state='+state+'&color='+color+'&province='+province+'&city='+city+'&area='+area+'&other='+other+'&paperType='+paperNum+"&lo="+lo+"&la="+la;
			
			for(var i = 0,costs ; i < 22 ; i ++){
				costs = document.getElementById(types[i]).value;
				send = send + "&" + types[i] + "=" + costs;
			}
			send = send + "&caiyin="+caiyin;
			 window.location.href=send;
        }

        function paperTypeToArray(num) {
            for (var i = 1;num > 0 ; num = parseInt(num/2),i ++){
                if(num%2 == 1) {
                    paperType[i] = true;
                }
                else {
                    paperType[i] = false;
                }
            }
        }
        function paperTypeToCheckbox() {
            var each;
            for (each in paperType){
                if(paperType[each] == true){
                    document.getElementById("printType"+each).checked = true;
                }
            }
        }
        function paperTypeClick(num) {

            if(document.getElementById("printType"+num).checked == true) {
                paperType[num] = true;
            }
            else {
                paperType[num] = false;
            }
        }
        function init() {

                <?php

            echo "var state='$state',paperType='$paperType',color='$color',province='$province',city='$city',area='$area',other='$other',lo='$lo',la='$la';";
                ?>

                document.getElementById("province").value = unescape(province);
                document.getElementById("city").value = unescape(city);
                document.getElementById("area").value = unescape(area);
                document.getElementById("other").value = unescape(other);
                document.getElementById("lo").value = lo;
                document.getElementById("la").value = la;
                paperTypeToArray(paperType);
                paperTypeToCheckbox();
                if(state == '1'){
                    document.getElementById("state").options[0].selected = true;
                }
                else {
                    document.getElementById("state").options[1].selected = true;
                }
                if(color == '1'){
                    document.getElementById("color").options[0].selected = true;
                }
                else {
                    document.getElementById("color").options[1].selected = true;
                }

        }

        function check_pwd(){
            console.log(2);
            var code2 =document.getElementById("pass1").value;
            var reg2 = /^\w{6,16}$/;
            if(reg2.test(code2)) {
                return true;
            } else {
                alert("密码错误,必须为6-16位字母或数字或下划线");
                return false;
            }

        }
        function check() {


            var pass1,pass1c;
            pass1 =document.getElementById("pass1").value;
            pass1c = document.getElementById("pass1c").value;
            if(pass1!=pass1c){
                alert("请重新确认密码！");
                return false;
            }
            return check_pwd();
        }
        function submit() {
            if(check() != false){
                var pass1 =document.getElementById("pass1").value;
                var passo = document.getElementById("passo").value;
                var submit = new XMLHttpRequest();
                submit.open("post","control/changePwd.php",false);
                submit.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                submit.send("password="+pass1+"&oPassword="+passo);
                if(submit.responseText == 'ok'){
                    alert("修改成功");
                    window.location.href="/user/logout.php";
                }
                else {
                    alert("出现错误，请确认旧密码正确。");
                }
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
                        <li><a href="order.php"><i class="icon-font">&#xe005;</i>所有订单</a></li>
                        <li><a href="sore.php"><i class="icon-font">&#xe004;</i>输入提取码</a></li>

                        <li><a href="people.php"><i class="icon-font">&#xe001;</i>用户管理</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#"><i class="icon-font">&#xe018;</i>商家信息设置</a>
                    <ul class="sub-menu">
                        <li><a href="#state"><i class="icon-font">&#xe000;</i>营业状态</a></li>
                        <li><a href="#print_info"><i class="icon-font">&#xe018;</i>打印参数</a></li>
                        <li><a href="#location"><i class="icon-font">&#xe021;</i>地理位置</a></li>
                        <li><a href="#persionnal"><i class="icon-font">&#xe014;</i>修改密码</a></li>
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
                <h1>商家信息设置</h1>
            </div>

            <div class="result-content">
              <div class="search-wrap">
                  <div class="search-content">
                          <table class="search-tab">
                              <tr>
                                  <th width="120">营业状态：</th>
                                  <td>
                                      <select name="business-state" id="state">
                                          <option value="0">关店</option>
                                          <option value="1">开店</option>
                                      </select>
                                  </td>
                              </tr>
                          </table>
                  </div>
            </div>

            <div class="result-content" id="print_info">
              <div class="search-wrap">
                  <div class="search-content">
                          <table class="search-tab">
                              <tr>
                                  <th>
                                  <div id="zhizhang">
                                  <label class="res-lab">纸张价格（元）：</label>
                                  </div>
                                  <table id="res-box">
                                    <tr>
                                        <th>
                                        <span class="res-info"><input name="printer-information" id="printType5" type="checkbox" value="" onclick="paperTypeClick(5)" />A4&nbsp;&nbsp;</span><input value="<?PHP echo $row['A4'];?>" id="costA4" type="number" placeholder="单价" style="width:40px;"/>
                                        </th>
                                        <th>
                                        <span class="res-info"><input name="printer-information" id="printType17" type="checkbox" value="" onclick="paperTypeClick(17)" />B5&nbsp;&nbsp;</span><input value="<?PHP echo $row['B5'];?>" id="costB5" type="number" placeholder="单价" style="width:40px;"/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th><span class="res-info"><input name="printer-information" id="printType1" type="checkbox" value="" onclick="paperTypeClick(1)"/>A0&nbsp;&nbsp;</span><input value="<?PHP echo $row['A0'];?>" id="costA0" type="number" placeholder="单价" style="width:40px;"/></th>
                                        <th><span class="res-info"><input name="printer-information" id="printType12" type="checkbox" value="" onclick="paperTypeClick(12)" />B0&nbsp;&nbsp;</span><input value="<?PHP echo $row['B0'];?>" id="costB0"  type="number" placeholder="单价" style="width:40px;"/>
                                      </th>
                                    </tr>
                                    <tr>
                                        <th><span class="res-info"><input name="printer-information" id="printType2" type="checkbox" value="" onclick="paperTypeClick(2)" />A1&nbsp;&nbsp;</span><input value="<?PHP echo $row['A1'];?>" id="costA1" type="number" placeholder="单价" style="width:40px;"/></th>
                                        <th><span class="res-info"><input name="printer-information" id="printType13" type="checkbox" value="" onclick="paperTypeClick(13)" />B1&nbsp;&nbsp;</span><input value="<?PHP echo $row['B1'];?>" id="costB1" type="number" placeholder="单价" style="width:40px;"/></th>
                                    </tr>
                                    <tr>
                                        <th><span class="res-info"><input name="printer-information" id="printType3" type="checkbox" value="" onclick="paperTypeClick(3)" />A2&nbsp;&nbsp;</span><input value="<?PHP echo $row['A2'];?>" id="costA2" type="number" placeholder="单价" style="width:40px;"/></th>
                                        <th><span class="res-info"><input name="printer-information" id="printType14" type="checkbox" value="" onclick="paperTypeClick(14)" />B2&nbsp;&nbsp;</span><input value="<?PHP echo $row['B2'];?>" id="costB2" type="number" placeholder="单价" style="width:40px;"/></th>
                                    </tr>
                                    <tr>
                                        <th><span class="res-info"><input name="printer-information" id="printType4" type="checkbox" value="" onclick="paperTypeClick(4)" />A3&nbsp;&nbsp;</span><input value="<?PHP echo $row['A3'];?>" id="costA3" type="number" placeholder="单价" style="width:40px;"/></th>
                                        <th><span class="res-info"><input name="printer-information" id="printType15" type="checkbox" value="" onclick="paperTypeClick(15)" />B3&nbsp;&nbsp;</span><input value="<?PHP echo $row['B3'];?>" id="costB3" type="number" placeholder="单价" style="width:40px;"/></th>
                                    </tr>
                                    <tr>
                                        <th><span class="res-info"><input name="printer-information" id="printType6" type="checkbox" value="" onclick="paperTypeClick(6)" />A5&nbsp;&nbsp;</span><input value="<?PHP echo $row['A5'];?>" id="costA5" type="number" placeholder="单价" style="width:40px;"/></th>
                                        <th><span class="res-info"><input name="printer-information" id="printType16" type="checkbox" value="" onclick="paperTypeClick(16)" />B4&nbsp;&nbsp;</span><input value="<?PHP echo $row['B4'];?>" id="costB4" type="number" placeholder="单价" style="width:40px;"/></th>
                                    </tr>
                                    <tr>
                                        <th><span class="res-info"><input name="printer-information" id="printType7" type="checkbox" value="" onclick="paperTypeClick(7)" />A6&nbsp;&nbsp;</span><input value="<?PHP echo $row['A6'];?>" id="costA6" type="number" placeholder="单价" style="width:40px;"/></th>
                                        <th><span class="res-info"><input name="printer-information" id="printType18" type="checkbox" value="" onclick="paperTypeClick(18)" />B6&nbsp;&nbsp;</span><input value="<?PHP echo $row['B6'];?>" id="costB6" type="number" placeholder="单价" style="width:40px;"/></th>
                                    </tr>
                                    <tr>
                                        <th><span class="res-info"><input name="printer-information" id="printType8" type="checkbox" value="" onclick="paperTypeClick(8)" />A7&nbsp;&nbsp;</span><input value="<?PHP echo $row['A7'];?>" id="costA7" type="number" placeholder="单价" style="width:40px;"/></th>
                                        <th><span class="res-info"><input name="printer-information" id="printType19" type="checkbox" value="" onclick="paperTypeClick(19)" />B7&nbsp;&nbsp;</span><input value="<?PHP echo $row['B7'];?>" id="costB7" type="number" placeholder="单价" style="width:40px;"/></th>
                                    </tr>
                                    <tr>
                                        <th><span class="res-info"><input name="printer-information" id="printType9" type="checkbox" value="" onclick="paperTypeClick(9)" />A8&nbsp;&nbsp;</span><input value="<?PHP echo $row['A8'];?>" id="costA8" type="number" placeholder="单价" style="width:40px;"/></th>
                                        <th><span class="res-info"><input name="printer-information" id="printType20" type="checkbox" value="" onclick="paperTypeClick(20)" />B8&nbsp;&nbsp;</span><input value="<?PHP echo $row['B8'];?>" id="costB8" type="number" placeholder="单价" style="width:40px;"/></th>
                                    </tr>
                                    <tr>
                                        <th><span class="res-info"><input name="printer-information" id="printType10" type="checkbox" value="" onclick="paperTypeClick(10)" />A9&nbsp;&nbsp;</span><input value="<?PHP echo $row['A9'];?>" id="costA9" type="number" placeholder="单价" style="width:40px;"/></th>
                                        <th><span class="res-info"><input name="printer-information" id="printType21" type="checkbox" value="" onclick="paperTypeClick(21)" />B9&nbsp;&nbsp;</span><input value="<?PHP echo $row['B9'];?>" id="costB9" type="number" placeholder="单价" style="width:40px;"/></th>
                                    </tr>
                                    <tr>
                                        <th><span class="res-info"><input name="printer-information" id="printType11" type="checkbox" value="" onclick="paperTypeClick(11)" />A10</span><input value="<?PHP echo $row['A10'];?>" id="costA10" type="number" placeholder="单价" style="width:40px;"/></th>
                                        <th><span class="res-info"><input name="printer-information" id="printType22" type="checkbox" value="" onclick="paperTypeClick(22)" />B10</span><input value="<?PHP echo $row['B10'];?>" id="costB10" type="number" placeholder="单价" style="width:40px;"/>  </th>
                                    </tr>          
                                  </table>
                                      <br/>
                                      <!--<span class="res-info"><input name="printer-information" type="checkbox" value="" />铜版纸 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />照片 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />覆膜 </span>-->
                                  </th>
                              </tr>

                                <tr>
                                  <th>
                                  <label class="res-lab">彩色价格（元）：</label>
                                    <select name="business-state" id="color">
                                        <option value="0">否</option>
                                        <option value="1">是</option>
                                    </select>
                                    <input type="number" id="caiyin" placeholder="彩印加价" value="<?php echo $colorBuff;?>">
                                  </th>
                              </tr>
                          </table>


                  </div>
            </div>

            <div class="result-content" id="location">
              <div class="search-wrap">
                  <div class="search-content">
                          <table class="search-tab">
                              <tr>
                                  <th width="120">地理位置：</th>
                                  <td>
                                      <div id="map"><p style="position: absolute;top: 50%,right:50%">请设置使浏览器允许使用百度地图插件。</p></div>
                                      <input id="province" type="text" readonly>
                                      <input id="city" type="text" readonly>
                                      <input id="area" type="text" readonly>
                                      <input id="lo" type="text" readonly>
                                      <input id="la" type="text" readonly>
                                      <input id="other" type="text">
                                      <script type="text/javascript">
                                          var map = new BMap.Map("map");
                                          var point = new BMap.Point(116.404, 39.915);
                                          var x,y;
                                          map.centerAndZoom(point, 10);
                                          map.addControl(new BMap.GeolocationControl());
                                          map.addControl(new BMap.NavigationControl());
                                          var geolocation = new BMap.Geolocation();
                                          geolocation.getCurrentPosition(function(r){
                                              if(this.getStatus() == BMAP_STATUS_SUCCESS){
                                                  var mk = new BMap.Marker(r.point);
                                                  var center;
                                                  //map.addOverlay(mk);
                                                  map.panTo(r.point);
                                              }
                                              else {
                                                  alert('无法获取位置信息 错误码:'+this.getStatus());
                                              }
                                          });
                                          var lo = <?php echo $lo;?>;
                                          var la = <?php echo $la;?>;
                                          var pt = new BMap.Point(lo, la);
                                          var mark=new BMap.Marker(pt);
                                          map.addOverlay(mark);
                                          map.addEventListener("click", function(e){   //点击事件

                                              var myGeo = new BMap.Geocoder();
                                              myGeo.getLocation(new BMap.Point(e.point.lng ,e.point.lat ), function(result){
                                                  if (result){
                                                      var addComp = result.addressComponents;
                                                      var mark;
                                                      document.getElementById("province").value=addComp.province;
                                                      document.getElementById("city").value=addComp.city;
                                                      document.getElementById("area").value=addComp.district;
                                                      document.getElementById("la").value=e.point.lat;
                                                      document.getElementById("lo").value=e.point.lng;
                                                      map.clearOverlays();
                                                      pt = new BMap.Point(e.point.lng,e.point.lat);
                                                      mark=new BMap.Marker(pt);
                                                      map.addOverlay(mark);
                                                  }
                                              });
                                          })

                                      </script>

                                  </td>
                              </tr>
                          </table>
                  </div>
            </div>
            <div class="result-content">
                                <div class="search-wrap">
                                    <div class="search-content">
                                        <table class="search-tab">
                                            <tr>
                                                <th width="120">修改密码：</th>
                                                <td>
                                                    <table class="changepass" style="font-size:22px;display:inline-block;margin-left:240px">
                                                        <tr>
                                                            <td>
                                                                <span class="input_tab">旧密码</span>
                                                            </td>
                                                            <td><input class="pass" name="passo" id="passo" type="password"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="input_tab">新密码</span>
                                                                <td><input class="pass" name="pass1" id="pass1" type="password"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><span class="input_tab">确认新密码</span>
                                                                <td><input class="pass" name="pass1c" id="pass1c" type="password"></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2"><button class="button button-rounded button-plus"
                                                                    onclick="submit()">修改密码</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <p class="notice" style="color:red;font-size:12px;">*密码必须为6-12位字母或数字或下划线。</p>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
    <center>
<input class="btn btn-primary"id="sbt" value="提交" onclick="submitInfo()" type="submit" style="margin-top:10px;">
</center>

</div>
        <script type="text/javascript">init();</script>
</body>
</html>
