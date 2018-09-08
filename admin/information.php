<!doctype html>
<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] == '1'){
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
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password'")) == false){
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
    //echo "UPDATE user SET state='$state',province='$province',city='$city',area='$area',other='$other',lo='$lo',la='$la' WHERE username='$username'";
    //echo "UPDATE printerinfo SET color='$color',paperType='$paperType' WHERE username='$username'";
    mysql_query("UPDATE user SET state='$state',province='$province',city='$city',area='$area',other='$other',lo='$lo',la='$la' WHERE username='$username'");
    mysql_query("UPDATE printerinfo SET color='$color',paperType='$paperType' WHERE username='$username'");
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

?>
<html>
<head>
    <meta charset="UTF-8">
    <title>后台管理</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/common.css"/>
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
            var state,color,province,city,area,other,paperNum,lo,la;
            province = escape(document.getElementById("province").value);
            city = escape(document.getElementById("city").value);
            area = escape(document.getElementById("area").value);
            other = escape(document.getElementById("other").value);
            lo = document.getElementById("lo").value;
            la = document.getElementById("la").value;
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
            window.location.href='information.php?'+'set=1&state='+state+'&color='+color+'&province='+province+'&city='+city+'&area='+area+'&other='+other+'&paperType='+paperNum+"&lo="+lo+"&la="+la;
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
                        <li><a href="#state"><i class="icon-font">&#xe000;</i>营业状态</a></li>
                        <li><a href="#print_info"><i class="icon-font">&#xe018;</i>打印机参数</a></li>
                        <li><a href="#location"><i class="icon-font">&#xe021;</i>地理位置</a></li>
                        <li><a href="#persionnal"><i class="icon-font">&#xe014;</i>头像和其他</a></li>
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
                                  <th width="120">营业状态:</th>
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
                                  <label class="res-lab">纸张类型：</label>
                                      <span class="res-info"><input name="printer-information" id="printType1" type="checkbox" value="" onclick="paperTypeClick(1)"/>A0 </span>
                                      <span class="res-info"><input name="printer-information" id="printType2" type="checkbox" value="" onclick="paperTypeClick(2)" />A1 </span>
                                      <span class="res-info"><input name="printer-information" id="printType3" type="checkbox" value="" onclick="paperTypeClick(3)" />A2 </span>
                                      <span class="res-info"><input name="printer-information" id="printType4" type="checkbox" value="" onclick="paperTypeClick(4)" />A3 </span>
                                      <span class="res-info"><input name="printer-information" id="printType5" type="checkbox" value="" onclick="paperTypeClick(5)" />A4 </span>
                                      <span class="res-info"><input name="printer-information" id="printType6" type="checkbox" value="" onclick="paperTypeClick(6)" />A5 </span>
                                      <span class="res-info"><input name="printer-information" id="printType7" type="checkbox" value="" onclick="paperTypeClick(7)" />A6 </span>
                                      <span class="res-info"><input name="printer-information" id="printType8" type="checkbox" value="" onclick="paperTypeClick(8)" />A7 </span>
                                      <span class="res-info"><input name="printer-information" id="printType9" type="checkbox" value="" onclick="paperTypeClick(9)" />A8 </span>
                                      <span class="res-info"><input name="printer-information" id="printType10" type="checkbox" value="" onclick="paperTypeClick(10)" />A9 </span>
                                      <span class="res-info"><input name="printer-information" id="printType11" type="checkbox" value="" onclick="paperTypeClick(11)" />A10 </span>
                                      <br />
                                      <span class="res-info"><input name="printer-information" id="printType12" type="checkbox" value="" onclick="paperTypeClick(12)" />B0 </span>
                                      <span class="res-info"><input name="printer-information" id="printType13" type="checkbox" value="" onclick="paperTypeClick(13)" />B1 </span>
                                      <span class="res-info"><input name="printer-information" id="printType14" type="checkbox" value="" onclick="paperTypeClick(14)" />B2 </span>
                                      <span class="res-info"><input name="printer-information" id="printType15" type="checkbox" value="" onclick="paperTypeClick(15)" />B3 </span>
                                      <span class="res-info"><input name="printer-information" id="printType16" type="checkbox" value="" onclick="paperTypeClick(16)" />B4 </span>
                                      <span class="res-info"><input name="printer-information" id="printType17" type="checkbox" value="" onclick="paperTypeClick(17)" />B5 </span>
                                      <span class="res-info"><input name="printer-information" id="printType18" type="checkbox" value="" onclick="paperTypeClick(18)" />B6 </span>
                                      <span class="res-info"><input name="printer-information" id="printType19" type="checkbox" value="" onclick="paperTypeClick(19)" />B7 </span>
                                      <span class="res-info"><input name="printer-information" id="printType20" type="checkbox" value="" onclick="paperTypeClick(20)" />B8 </span>
                                      <span class="res-info"><input name="printer-information" id="printType21" type="checkbox" value="" onclick="paperTypeClick(21)" />B9 </span>
                                      <span class="res-info"><input name="printer-information" id="printType22" type="checkbox" value="" onclick="paperTypeClick(22)" />B10 </span>
                                      <br/>
                                      <!--<span class="res-info"><input name="printer-information" type="checkbox" value="" />铜版纸 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />照片 </span>
                                      <span class="res-info"><input name="printer-information" type="checkbox" value="" />覆膜 </span>-->
                                  </th>
                              </tr>

                                <tr>
                                  <th>
                                  <label class="res-lab">是否支持彩色：</label>
                                    <select name="business-state" id="color">
                                        <option value="0">否</option>
                                        <option value="1">是</option>
                                    </select>
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
                                  <th width="120">地理位置</th>
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
                                              center = map.getCenter();
                                              myGeo.getLocation(new BMap.Point(center.lng ,center.lat ), function(result){
                                                  if (result){
                                                      var addComp = result.addressComponents;
                                                      var pt = null;
                                                      var i = 0;
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

<!--
            <div class="result-content" id="persionnal">
              <div class="search-wrap">
                  <div class="search-content">
                      <form action="" method="post">
                          <table class="search-tab">
                              <tr>
                                  <th width="120">头像</th>
                                  <td>
                                    <div class="con4">
                                       <canvas id="cvs" width="200" height="200"></canvas>
                                       <br>
                                       <span class="btn upload">上传头像<input type="file" class="upload_pic" id="upload" /></span>
                                  </td>
                              </tr>
                          </table>
                      </form>
                  </div>
            </div>-->

<center>
  <input class="btn btn-primary" value="提交" onclick="submitInfo()" type="submit">
</center>
        </div>
    </div>
    <!--/main-->
</div>
                <script type="text/javascript">init();</script>
</body>
</html>
