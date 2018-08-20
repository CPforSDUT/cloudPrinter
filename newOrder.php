<?php ob_start(); ?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>云打印</title>
    <link rel="stylesheet" type="text/css" href="/css/master.css">
    <link href="/js/dist/dropzone.css" rel="stylesheet" />
    <link href="/js/dist/basic.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/buttons.css">
    <script src="/js/dist/dropzone.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3" charset="UTF-8"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/library/TextIconOverlay/1.2/src/TextIconOverlay_min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/library/MarkerClusterer/1.2/src/MarkerClusterer_min.js" charset="UTF-8"></script>
    <style type="text/css">
        .dropzone {
            border: 2px dashed #0087F7;
            border-radius: 5px;
            background: white;
        }

        .dropzone {
            width: 600px;
            height: 300px;
        }

        .dropzone {
            font-size: 0.8em;
            font-weight: 200;
            display: block;
            margin-top: 1.4rem;
        }
    </style>
    <script type="text/javascript">  
        function showAndHidden1(orderId) {

            var form1 = document.getElementById("form1");
            var form2 = document.getElementById("form2");
            var files = new XMLHttpRequest();


            files.open("POST","/fileControl/getFiles.php",false);
            files.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            files.send("orderId="+orderId);
            if(files.responseText != '')
            {
                form1.style.display = "none";
                form2.style.display = "block";
                document.getElementById("choosefile").innerHTML = files.responseText;
            }
            else {
                alert("你没有上传文件");
            }
        }
        function showAndHidden2() {
            var form2 = document.getElementById("form2");
            var form3 = document.getElementById("form3");
            form2.style.display = "none";
            form3.style.display = "block";
        }
        function showCaidan() {
            var caidan = document.getElementById("caidan");
            caidan.style.display = "block";
        }
        function hiddenCaidan() {
            var caidan = document.getElementById("caidan");
            caidan.style.display = "none";
        }
        function changefile(orderId,fileName) {
            var paperNum = document.getElementById("paper_num").value;
            var paperSize = document.getElementById("paper_size").value;
            var color = document.getElementById("color").value;
            var otherInfo = document.getElementById("other_info").value;
            var setinfo = new XMLHttpRequest();
            setinfo.open("POST","/fileControl/setFileInfo.php",true);
            setinfo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            setinfo.send("paperNum="+paperNum+"&paperSize="+paperSize+"&color="+color+"&otherInfo="+escape(otherInfo)+"&orderId="+orderId+"&fileName="+fileName);
        }
        function getFileInfo(orderId,fileName) {
            var getInfo = new XMLHttpRequest();
            getInfo.open("POST","/fileControl/getFileInfo.php",true);
            getInfo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            getInfo.send("orderId="+orderId+"&fileName="+escape(fileName));
            getInfo.onreadystatechange=function()
            {
                if (getInfo.readyState==4 && getInfo.status==200)
                {
                    document.getElementById("show").innerHTML = getInfo.responseText;
                    /*(<p id='paperNum'>1</p><p id='paperSize'>A5</p><p id='color'>0</p><p id='otherInfo'></p>*/
                   var paperNum = document.getElementById("paper_num");
                    var paperSize = document.getElementById("paper_size");
                    var color = document.getElementById("color");
                    var otherInfo = document.getElementById("other_info");


                    paperNum.value = document.getElementById("paperNum").innerText;
                    otherInfo.value = document.getElementById("otherInfo").innerText;
                    paperSizes = Array("A0","A1","A2","A3","A4","A5","A6","A7","A8","A9","A10","B0","B1","B2","B3","B4","B5","B6","B7","B8","B9","B10");
                    for (var i = 0 ;paperSizes[i] != document.getElementById("paperSize").innerText ; i ++);
                    paperSize.options[i].selected = true;
                    if(document.getElementById("Color").innerText == "1"){
                        color.options[0].selected = true;
                    }
                    else {
                        color.options[1].selected = true;
                    }
                }
            }
        }
        function createTag(marker,info){

            //标注
            //var text = m;
            //var infoWindow = new BMap.InfoWindow(text);
            //marker.addEventListener("click", function () { this.openInfoWindow(infoWindow);document.getElementById('printname').value=infoWindow.getContent(); });
            marker.addEventListener("click", function () {
                document.getElementById('user_name').innerHTML = info['username'];
                document.getElementById('province').innerHTML = unescape(info['province']);
                document.getElementById('city').innerHTML = unescape(info['city']);
                document.getElementById('area').innerHTML = unescape(info['area']);
                document.getElementById('other').innerHTML = unescape(info['other']);
                var state;
                if(info['state'] == '1'){
                    state = "打烊";
                }
                else {
                    state= "开门";
                }
                document.getElementById("state").innerText = state;
            });
        }
    </script>
</head>

<body>
<div id="show" style="display: none"></div>
    <div class="container">
        <div class="header">
            <div class="daohang" id="daohang">
                <img src="image/logo1.png" alt="logo" id="logo">
                <span id="username">云打印</span>
                <a id="caidanAndPic">

                    <img src="image/user_img1.png" alt="用户" id="user_pic">

                    <div class="caidan" id="caidan">
                        <ul>
                            <li>
                                <a href="#">个人信息</a>
                            </li>
                            <li>
                                <a href="#">订单处理</a>
                            </li>
                            <li>
                                <a href="#">修改密码</a>
                            </li>
                            <li>
                                <a href="#">其他功能</a>
                            </li>
                            <li>
                                <a href="/user/logout.php">退出账户</a>
                            </li>
                        </ul>
                    </div>
                    <script type="text/javascript">
                        var userPic = document.getElementById("user_pic");
                        var daohang = document.getElementById("daohang");
                        userPic.addEventListener("click", function () {
                            showCaidan();
                        });
                        daohang.addEventListener("mouseleave", function () {
                            hiddenCaidan();
                        });
                    </script>
                </a>

            </div>

        </div>
        <div class="main">
            <span>请填写您的订单</span>
            <div class="m1">
                <div class="m2">
                    <div class="form" id="form1">
                        <?php
                            session_start();
                            if(isset($_SESSION['user']) == false){
                                header("location:/user/loginView.php");
                            }
                            $con = mysql_connect("localhost","root","wslzd9877");
                            if (!$con)
                            {
                                die('Could not connect: ' . mysql_error());
                            }
                            $username = $_SESSION['user'];
                            mysql_select_db("user", $con);
                            session_set_cookie_params(24 * 3600);
                            do{
                                $orderId = md5($username+time()+rand(0,getrandmax()));
                                $result = mysql_query("SELECT * FROM orderids where orderId = \"$orderId\"");
                                $row = mysql_fetch_array($result);
                            }while($row != false);
                            $tIme =  time();
                            mysql_query("INSERT INTO delfiles (orderId, time)VALUES (\"$orderId\", \"$tIme\")");
                        ?>
                        <form id="mydropzone" action="/fileControl/uploadFile.php" method="post" class="dropzone">
                            <!--<nav>请将文件拖拽至此</nav>-->
                            <input type="hidden"  name="orderId" value=<?php echo "'$orderId'";?> />
                        </form>

                        <script type="text/javascript">
                            var delFile=new XMLHttpRequest();
                            Dropzone.options.mydropzone = {
                                init: function () {
                                    this.on("removedfile", function (file) {
                                        /*if (this.getAcceptedFiles().length === 0) {
                                            alert('1');
                                        }*/
                                        delFile.open("POST","/fileControl/delFile.php",false);
                                        delFile.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                                        delFile.send('orderId='+<?php echo "'$orderId'";?>+'&filename='+escape(file.name));
                                        //alert(delFile.responseText);
                                    });
                                }
                            };
                        </script>


                        <span>*请上传不大于20M的文件</span>
                        <div class="go" id="go_one">
                            <a>
                                <button class="button button-caution button-rounded button-jumbo" onclick="showAndHidden1(<?php echo "'$orderId'";?>)">下一步</a>
                        </div>
                        <?php
                        mysql_query("INSERT INTO orderids (orderId) VALUES (\"$orderId\")");
                        ?>
                    </div>
                    <div class="form" id="form2">
                        <form action="">
                            <!-- 自行添加及更改 -->
                            <div id="data_select">
                                <span>选择文件：</span>
                                <select id="choosefile" name="choosefile" data-edit-select="1" onmousedown="if(this.options.length>3){this.size=8}" onblur="this.size=0" onchange="this.size=0" style="position:absolute;z-index:1">
                                </select>
                            </div>
                            <div id="data_left">
                                <nav>纸张大小：</nav>
                                <nav>是否彩印：</nav>
                                <nav>打印页数：</nav>
                                <nav>备注：</nav>
                                <nav>纸张方向：</nav>
                                <nav>纸张类型：</nav>
                                <nav>纸张颜色：</nav>
                                <nav>正反打印：</nav>
                                <nav>dpi：</nav>

                            </div>
                            <div id="data_right">
                                <select name="paper_size" id="paper_size">
                                    <option value="A0">A0</option>
                                    <option value="A1">A1</option>
                                    <option value="A2">A2</option>
                                    <option value="A3">A3</option>
                                    <option value="A4" selected>A4</option>
                                    <option value="A5">A5</option>
                                    <option value="A6">A6</option>
                                    <option value="A7">A7</option>
                                    <option value="A8">A8</option>
                                    <option value="A9">A9</option>
                                    <option value="A10">A10</option>
                                    <option value="B0">B0</option>
                                    <option value="B1">B1</option>
                                    <option value="B2">B2</option>
                                    <option value="B3">B3</option>
                                    <option value="B4">B4</option>
                                    <option value="B5">B5</option>
                                    <option value="B6">B6</option>
                                    <option value="B7">B7</option>
                                    <option value="B8">B8</option>
                                    <option value="B9">B9</option>
                                    <option value="B10">B10</option>
                                </select><br/>
                                <select  id="color">
                                    <option value="1">否</option>
                                    <option value="2">是</option>
                                </select>
                                <input type="number" id="paper_num" value="1"/>
                                <input type="text" id="other_info">
                            </div>
                            <script type="text/javascript">
                                var elements = new Array();
                                var element;
                                elements[0] = document.getElementById("paper_size");
                                elements[1] = document.getElementById("color");
                                elements[2] = document.getElementById("paper_num");
                                elements[3] = document.getElementById("other_info");
                                for (element in elements)
                                {
                                    elements[element].addEventListener("change",function () {
                                        var selectBar = document.getElementById("choosefile");
                                        changefile(<?php echo "'$orderId'";?>,selectBar.value);
                                    });
                                }
                                document.getElementById("data_select").addEventListener("mouseleave",function () {
                                    var selectBar = document.getElementById("choosefile");
                                    getFileInfo(<?php echo "\"$orderId\"";?>,selectBar.value);
                                });
                            </script>
                        </form>
                        <div class="go" id="go_two">
                            <a>
                                <button class="button button-caution button-rounded button-jumbo" onclick="showAndHidden2()">下一步</a>
                        </div>
                        <!--<nav>打印参数</nav>-->
                    </div>

                    <div class="form" id="form3">
                        <form action="">
                            <input id="map_search" type="search" placeholder="输入打印店名来查找" size="50">
                        </form>
                        <div id="baiduMap"></div>
                       <div class="mapform" id="mapform">
                            <table border="1" cellspacing="0">
                                <thead>
                                <tr>
                                    <td>店名</td>
                                    <td>距离</td>
                                    <td>省份</td>
                                    <td>城市</td>
                                    <td>区域</td>
                                    <td>详细地址</td>
                                    <td>营业状态</td>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>    <!--这里是内容 -->
                                    <td id="user_name"></td>
                                    <td id="distance"></td>
                                    <td id="province"></td>
                                    <td id="city"></td>
                                    <td id="area"></td>
                                    <td id="other"></td>
                                    <td id="state"></td>
                                </tr>
                               <!--<tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>-->
                                </tbody>
                            </table>
                        </div>
                        <div class="go" id="go_three">
                            <a>
                                <button class="button button-caution button-rounded button-jumbo">完成</a>
                        </div>

                    </div>

                </div>
            </div>

        </div>

        <div class="footer">
            <br>
            <br>
            <br>
            <nav>XXXX-XXXXXXXX</nav>
            <p>
                <a href="#">联系我们</a>|
                <a href="#">联系我们</a>|
                <a href="#">联系我们</a>|
                <a href="#">联系我们</a>
            </p>
        </div>
    </div>

<script type="text/javascript">

    var map = new BMap.Map("baiduMap");
    var point = new BMap.Point(116.38,39.90);
    map.centerAndZoom(point,8);
    map.addControl(new BMap.GeolocationControl());
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        map.panTo(r.point);
    });
    map.addEventListener("dragend", function(result){

        var center = map.getCenter();
        var myGeo = new BMap.Geocoder();
        myGeo.getLocation(new BMap.Point(center.lng ,center.lat ), function(result){
            var addComp = result.addressComponents;
            var mapInfo = new XMLHttpRequest();
            mapInfo.open("POST","/user/getMapInfo.php",true);
            mapInfo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            mapInfo.send("province="+escape(addComp.province));
            mapInfo.onreadystatechange=function() {
                if (mapInfo.readyState == 4 && mapInfo.status == 200) {
                    var each;
                    map.clearOverlays();
                    eval(mapInfo.responseText);
                    for (each in where)
                    {
                        pt = new BMap.Point(where[each]['lo'],where[each]['la']);
                        mark=new BMap.Marker(pt);
                        map.addOverlay(mark);
                        createTag(mark,where[each]);
                    }
                }
            }
        });
    });

</script>
</body>

</html>
<?php
ob_end_flush();
?>