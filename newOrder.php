<?php 
ob_start();
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] == '2'){
    header("location:/index.php");
}
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
$username = $_SESSION['user'];
$password = $_SESSION['pass'];
mysql_select_db("user", $con);
$weights = mysql_query("select * from alloc where username='$username'");
$weights = mysql_fetch_array($weights);
$costW = $weights['cost'];
$distanceW = $weights['distance'];
$scoreW = $weights['score'];
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password'")) == false){
    header("location:/index.php");
    exit();
}
session_set_cookie_params(24 * 3600);
do{
    $orderId = md5($username+time()+rand(0,getrandmax()));
    $result = mysql_query("SELECT * FROM orderids where orderId = \"$orderId\"");
    $row = mysql_fetch_array($result);
}while($row != false);
$tIme =  time();
mysql_query("INSERT INTO delfiles (orderId, time)VALUES (\"$orderId\", \"$tIme\")");

?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>云打印</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/js/dist/dropzone.css" rel="stylesheet" />
    <link href="/js/dist/basic.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/buttons.css">
    <link rel="stylesheet" href="css/layui.css">
    <script src="js/layui.all.js"></script>
    <script src="/js/dist/dropzone.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3" charset="UTF-8"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/library/TextIconOverlay/1.2/src/TextIconOverlay_min.js" charset="UTF-8"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/library/MarkerClusterer/1.2/src/MarkerClusterer_min.js" charset="UTF-8"></script>
    <link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
    <script src="//apps.bdimg.com/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/css/master.css">
	<style>
        .spinner {
            margin: 100px auto 0;
            width: 150px;
            text-align: center;
        }
        .spinner > div {
            width: 30px;
            height: 30px;
            background-color: #67CF22;

            border-radius: 100%;
            display: inline-block;
            -webkit-animation: bouncedelay 1.4s infinite ease-in-out;
            animation: bouncedelay 1.4s infinite ease-in-out;
            /* Prevent first frame from flickering when animation starts */
            -webkit-animation-fill-mode: both;
            animation-fill-mode: both;
        }
        .spinner .bounce1 {
            -webkit-animation-delay: -0.32s;
            animation-delay: -0.32s;
        }
        .spinner .bounce2 {
            -webkit-animation-delay: -0.16s;
            animation-delay: -0.16s;
        }
        @-webkit-keyframes bouncedelay {
            0%, 80%, 100% { -webkit-transform: scale(0.0) }
            40% { -webkit-transform: scale(1.0) }
        }
        @keyframes bouncedelay {
            0%, 80%, 100% {
                transform: scale(0.0);
                -webkit-transform: scale(0.0);
            } 40% {
                  transform: scale(1.0);
                  -webkit-transform: scale(1.0);
              }
        }
	.layui-laydate-footer span {
		margin-right: 1px;
		float:left;
	}
	</style>

    <script type="text/javascript">
        var selected,selectedId;
    </script>
    <script type="text/javascript">
        var orderId;
        var thisProvince = '';
        var myLo = -1,myLa = -1; //自己的坐标
        var myMark; //自己的坐标
        var walk;
        var maxDis,maxCost,maxScore;
        var cDis,cCost,cScore;
        function showAndHidden0() {
            var form0 = document.getElementById("form0");
            var form1 = document.getElementById("form1");
            form0.style.display = "none";
            form1.style.display = "block";
        }
        function showAndHidden1(orderId) {

            var form1 = document.getElementById("form1");
            var form2 = document.getElementById("form2");
            var files = new XMLHttpRequest();


            files.open("POST","/fileControl/getFiles.php",false);
            files.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            files.send("orderId="+orderId);
            if(files.responseText != '')
            {
                document.getElementById("choosefile").innerHTML = files.responseText;
                selected =document.getElementById("selected1").innerHTML;
                selectedId = "selected1";
                document.getElementById("selected1").style.color = "#fff";
                document.getElementById("selected1").style.fontSize = "16px";
                document.getElementById("selected1").style.background = "#3c7df1";
                getFileInfo(orderId,selected,1);
                form1.style.display = "none";
                form2.style.display = "block";
            }
            else {
                alert("你没有上传文件");
            }
        }
        function clearShopInfo() {
            document.getElementById('user_name').innerHTML = '';
            document.getElementById('other').innerHTML = '';
            document.getElementById("map_search").value = '';
            document.getElementById("state").innerText = '';
            document.getElementById("cost").innerText = '';
            document.getElementById("score").innerText = '';
            document.getElementById("distance").innerText = '';
            thisProvince = '';
        }
        function showAndHidden2() {
            var form2 = document.getElementById("form2");
            var form3 = document.getElementById("form3");
            form2.style.display = "none";
            form3.style.display = "block";
            clearShopInfo();
            if(myLo == -1 || myLa == -1) {
                try{
                    doIpLocation();
                }
                catch (e) {}
            }
            getTag(map);
        }
        function showAndHidden3() {
            var form2 = document.getElementById("form2");
            var form1 = document.getElementById("form1");
            form2.style.display = "none";
            form1.style.display = "block";
        }
        function showAndHidden4() {
            var form3 = document.getElementById("form3");
            var form2 = document.getElementById("form2");
            form3.style.display = "none";
            form2.style.display = "block";
        }
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
        function changefile(orderId,fileName) {
            var paperNum = document.getElementById("paper_num").value;
            var paperSize = document.getElementById("paper_size").value;
            var color = document.getElementById("color").value;
            var otherInfo = document.getElementById("other_info").value;
            var paperWay = document.getElementById("orientation").value;
            var setinfo = new XMLHttpRequest();

            setinfo.open("POST","/fileControl/setFileInfo.php",true);
            setinfo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            setinfo.send("paperNum="+paperNum+"&paperSize="+paperSize+"&color="+color+"&otherInfo="+escape(otherInfo)+"&orderId="+orderId+"&fileName="+escape(fileName)+"&paperWay="+paperWay);
            //alert("paperNum="+paperNum+"&paperSize="+paperSize+"&color="+color+"&otherInfo="+escape(otherInfo)+"&orderId="+orderId+"&fileName="+escape(fileName));
        }
        function getFileInfo(orderId,fileName,i) {
            var getInfo = new XMLHttpRequest();

            selected = fileName;
            document.getElementById(selectedId).removeAttribute("style");
            document.getElementById("selected"+i).style.color = "#fff";
            document.getElementById("selected"+i).style.fontSize = "18px";
            document.getElementById("selected"+i).style.background = "#3c7df1";
            selectedId = "selected" + i;

            getInfo.open("POST","/fileControl/getFileInfo.php",true);
            getInfo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            getInfo.send("orderId="+orderId+"&fileName="+escape(fileName));
            //alert("orderId="+orderId+"&fileName="+escape(fileName));
            getInfo.onreadystatechange=function()
            {
                if (getInfo.readyState==4 && getInfo.status==200)
                {
                    document.getElementById("show").innerHTML = getInfo.responseText;
                    //alert(getInfo.responseText);
                    /*(<p id='paperNum'>1</p><p id='paperSize'>A5</p><p id='color'>0</p><p id='otherInfo'></p>*/
                   var paperNum = document.getElementById("paper_num");
                    var paperSize = document.getElementById("paper_size");
                    var color = document.getElementById("color");
                    var otherInfo = document.getElementById("other_info");
                    var paper_way = document.getElementById("orientation");
                    var papers = document.getElementById("papers");

                    papers.innerHTML = document.getElementById("Papers").innerHTML;
                    paperNum.value = document.getElementById("paperNum").innerText;
                    otherInfo.value = unescape(document.getElementById("otherInfo").innerText);
                    paperSizes = Array("A0","A1","A2","A3","A4","A5","A6","A7","A8","A9","A10","B0","B1","B2","B3","B4","B5","B6","B7","B8","B9","B10");
                    for (var i = 0 ;paperSizes[i] != document.getElementById("paperSize").innerText ; i ++);
                    paperSize.options[i].selected = true;
                    if(document.getElementById("Color").innerText == "1"){
                        color.options[0].selected = true;
                    }
                    else {
                        color.options[1].selected = true;
                    }
                    if(document.getElementById("paperWay").innerText == '1'){
                        paper_way.options[0].selected = true;
                    }
                    else {
                        paper_way.options[1].selected = true;
                    }
                }
            }
        }
        function showShopInfo(info) {
            var province = unescape(info['province']);
            var city = unescape(info['city']);
            var area = unescape(info['area']);
            var other = unescape(info['other']);
            document.getElementById('user_name').innerHTML = info['username'];
            document.getElementById('other').innerHTML = other;
            document.getElementById("map_search").value = info['username'];
            var state;
            if(info['state'] == '1'){
                state = "打烊";
            }
            else {
                state= "开张";
            }
            document.getElementById("state").innerText = state;
        }
        function createTag(marker,info){

            //标注
            //var text = m;
            //var infoWindow = new BMap.InfoWindow(text);
            //marker.addEventListener("click", function () { this.openInfoWindow(infoWindow);document.getElementById('printname').value=infoWindow.getContent(); });
            marker.addEventListener("click", function (e) {
                showShopInfo(info);
                var point = new BMap.Point(myLo,myLa);
                distance = map.getDistance(point,info['pt']);
                document.getElementById("distance").innerHTML = (distance/1000).toFixed(2)+"km";
                document.getElementById("cost").innerHTML = info['cost'];
                document.getElementById("score").innerHTML = info['score'];
                cCost = info['cost'];
                cDis = distance;
                cScore = info['score'];
                walk.clearResults();
                walk.search(point ,info['pt']);
            });
        }
        function search(keyword)
        {
            var each;
            var point = new BMap.Point(myLo,myLa);
            for(each in where)
            {
                if(where[each]['username'].toLocaleLowerCase() == keyword.toLocaleLowerCase())
                {
                    showShopInfo(where[each]);
                    distance = map.getDistance(point,where[each]['pt']);
                    document.getElementById("distance").innerHTML = (distance/1000).toFixed(2)+"km";
                    document.getElementById("cost").innerHTML = where[each]['cost'];
                    document.getElementById("score").innerHTML = where[each]['score'];
                    cCost = where[each]['cost'];
                    cDis = distance;
                    cScore = where[each]['score'];
                    walk.clearResults();
                    walk.search(point ,where[each]['pt']);
                    break;
                }
            }
        }
        function randomNum(minNum,maxNum){
            switch(arguments.length){
                case 1:
                    return parseInt(Math.random()*minNum+1,10);
                    break;
                case 2:
                    return parseInt(Math.random()*(maxNum-minNum+1)+minNum,10);
                    break;
                default:
                    return 0;
                    break;
            }
        }
        function upWeights() {
            var update = new XMLHttpRequest();
            update.open("POST","upWeights.php",false);
            update.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            if(cScore != maxScore)scoreWeight += maxScore > cScore ? -5 : 5;
            if(cDis != maxDis)distanceWeight += maxDis < cDis ? -5 : 5;
            if(cCost != maxCost)costWeight += maxCost < cCost ? -5 : 5;
            update.send("costW="+costWeight+"&disW="+distanceWeight+"&scoreW="+scoreWeight);
        }
        function finishOrder(orderId,username) {
            var time = document.getElementById("datepicker").value;
            var deadline,exCode;
            var business = document.getElementById("user_name").innerHTML;
            var createOrder = new XMLHttpRequest();

            if(business != '')
            {
                deadline = time.substring(0,4) + time.substring(5,7) + time.substring(8,10) + time.substring(11,13) + time.substring(14,16);
                if(deadline.length != 12){
                    alert("请选择取件时间!");
                    return ;
                }
                upWeights();
                document.getElementById("waiting").style.display='block';
                createOrder.open("POST","/createNewOrder.php",true);
                createOrder.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                createOrder.timeout = 600000;
                createOrder.send("orderId="+orderId+"&consumer="+username+"&deadline="+deadline+"&business="+business);
                createOrder.onreadystatechange = function () {
                    if (createOrder.readyState == 4 && createOrder.status == 200) {
                        document.getElementById("waiting").style.display='none';
                        eval(createOrder.responseText);
                        if(typeof(exCode) == 'number') {
                            document.getElementById("exCode").innerHTML = "您的提取码：" + exCode + "（请牢记，提取时使用）";
                            document.getElementById("ok").style.visibility = "visible";
                            document.getElementById("ok").style.display = "block";
                        }
                        else if(exCode == 'timeout')
                        {
                            document.getElementById("nok").style.visibility = "visible";
                            document.getElementById("nok").style.display = "block";
                            document.getElementById("fail_info").innerHTML = "系统繁忙请稍后重试！";
                        }
                        else{
                            document.getElementById("nok").style.visibility = "visible";
                            document.getElementById("nok").style.display = "block";
                        }
                    }
                }

            }
            else {
                alert('请选择商家。');
            }
        }
        function getLocation() {
            var location = new XMLHttpRequest();
            location.open("GET","getLocation.php",false);
            location.send();
            eval(location.responseText);
            return tpoint;
        }
        function doIpLocation() {
            var point = new BMap.Point(c['content']['point']['x'],c['content']['point']['y']);
            map.centerAndZoom(point,13);
            map.addControl(new BMap.GeolocationControl());
            map.addControl(new BMap.NavigationControl());
            map.enableScrollWheelZoom(true);
            myLo = c['content']['point']['x'];
            myLa = c['content']['point']['y'];
        }
        function getTag(map) {
            var center = map.getCenter();
            var myGeo = new BMap.Geocoder();
            var myIcon = new BMap.Icon('image/icon.png',new BMap.Size(32,32));
            myGeo.getLocation(new BMap.Point(center.lng ,center.lat ), function(result){
                var addComp = result.addressComponents;
                var mapInfo = new XMLHttpRequest();
                if(thisProvince != addComp.province)
                {
                    thisProvince = addComp.province;
                    map.clearOverlays();
                    mapInfo.open("POST", "/user/getMapInfo.php", true);
                    mapInfo.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    mapInfo.send("province=" + escape(addComp.province) + "&orderId=" + orderId);
                    mapInfo.onreadystatechange = function () {
                        if (mapInfo.readyState == 4 && mapInfo.status == 200) {
                            var each;
                            eval(mapInfo.responseText);
                            for (each in where) {
                                pt = new BMap.Point(where[each]['lo'], where[each]['la']);
                                mark = new BMap.Marker(pt, {icon: myIcon});
                                mark.setAnimation(BMAP_ANIMATION_BOUNCE);
                                where[each]['pt'] = pt;
                                map.addOverlay(mark);
                                createTag(mark, where[each]);
                            }
                            if(myLo != -1 && myLa != -1)
                            {
                                setMyLocation(myLo,myLa,map);
                            }
                        }
                    }
                }
            });
        }

        function doAlloc(mark) {
            var maxWeightPoint = -1;
            var maxWeight;
            var each;

            var bestShop;
            var pt = new BMap.Point(myLo,myLa);
            if(where[0] == undefined){
                clearShopInfo();
                return ;
            }
            for(each in where)
            {

                var thisCost = where[each]['cost'] , thisScore = where[each]['score'];
                var thisDis = map.getDistance(pt,where[each]['pt']);

                var thisWeight = costWeight*(-thisCost) + distanceWeight*(-thisDis/1000) + (thisScore-2)*scoreWeight;
                if(maxWeightPoint == -1 || thisWeight > maxWeight)
                {
                    maxWeight = thisWeight;
                    maxWeightPoint = where[each]['pt'];
                    cDis = maxDis = thisDis;
                    cCost = maxCost = thisCost;
                    cScore = maxScore = thisScore;
                    bestShop = where[each];
                }
            }
            walk.clearResults();
            walk.search( pt,maxWeightPoint);
            map.addOverlay(mark);

            document.getElementById("distance").innerHTML = (maxDis/1000).toFixed(2)+"km";
            document.getElementById("cost").innerHTML = maxCost;
            document.getElementById("score").innerHTML = maxScore.toFixed(1);
            showShopInfo(bestShop);
        }
        function setMyLocation(lo,la,map)
        {
            var pt;
            myLa = la;
            myLo = lo;
            map.removeOverlay(myMark);
            pt = new BMap.Point(lo,la);
            myMark=new BMap.Marker(pt);
            doAlloc(myMark);
        }
    </script>
</head>

<body>
<div id="show" style="display: none"></div>
    <div class="container">
        <div class="hd">
        <div class="header">
            <div class="daohang" id="daohang">
                <a href="newOrder.php"><img src="image/logo1.png" alt="logo" id="logo"></a>
                <span id="uname"><?php echo "$username";?></span>
                <a href="#" id="caidanAndPic">
                    <img src="image/user_img1.png" alt="用户" id="user_pic" onmouseover="document.getElementById('user_pic').src='image/user_img.png'">
                    <div class="caidan" id="caidan">
                        <ul>
                            <li>
                                <a href="user-admin/user-information.php">个人信息</a>
                            </li>
                            <li>
                                <a href="user-admin/user-order.php">订单处理</a>
                            </li>
                            <li>
                                <a href="user-admin/user-information.php">修改密码</a>
                            </li>
             <!--               <li>
                                <a href="#">其他功能</a>
                            </li>-->
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
        </div>
        <div class="main">
        <div class="mt">
                    <nav> </nav>

                </div>
            <div class="m1">
                <div class="m2">
                    <div class="form" id="form0">
                    <a class="button button-glow button-border button-rounded button-primary button-jumbo" id="start" onclick="showAndHidden0()">创建新订单</a>
                    </div>
                    <div class="form" id="form1">

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
                        <span id="bage">*请上传最多8个不大于20M的文件</span>
                        <div class="go" id="go_one">
                                <!-- <button class="button button-highlight button-rounded button-large">上一步</button> -->
                                <button class="button button-action button-rounded button-large" onclick="showAndHidden1(<?php echo "'$orderId'";?>)">下一步</button>
                        </div>
                        <img src="/image/jdt1.png" class="jdt">
                        <?php
                        mysql_query("INSERT INTO orderids (orderId) VALUES (\"$orderId\")");
                        ?>
                    </div>
                    <div class="form" id="form2">
                        <form action="">
                            <!-- 自行添加及更改 -->
                            <div id="data_select">
                                <span>选择文件：</span>
                                <!-- <select id="choosefile" name="choosefile" data-edit-select="1" onmousedown="if(this.options.length>3){this.size=8}" onblur="this.size=0" onchange="this.size=0" style="position:absolute;z-index:1">
                                </select> -->
                                <div class="cf">

                                    <p id="selected" style="display:none;"></p>
                                    <p id="selctedId" style="display: none;"></p>
                                    <ul id="choosefile">
                                    </ul>
                                </div>
                            </div>
                            <div id="data_left">
                                <nav>纸张大小：</nav>
                                <nav>是否彩印：</nav>
                                <nav>打印数量：</nav>
                                <nav>纸张方向：</nav>
                                <nav>文档页数：</nav>
                                <nav>备注：</nav>
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
                                </select>
                                <br>
                                <select id="color">
                                    <option value="1" selected>否</option>
                                    <option value="2">是</option>
                                </select>
                                <br>
                                <input type="number" id="paper_num" value="1" onchange="if(document.getElementById('paper_num').value <= 0)document.getElementById('paper_num').value = 1"/>
                                <br>
                                <select  id="orientation">
                                    <option value="1" selected>竖版</option>
                                    <option value="2">横板</option>
                                </select>
                                <br>
                                <p id="papers" style="margin:0px;font-size:16px;">Loading...</p>
                                <textarea rows="6" cols="15" id="other_info"></textarea>
                            </div>
                            <script type="text/javascript">
                                var elements = new Array();
                                var element;
                                elements[0] = document.getElementById("paper_size");
                                elements[1] = document.getElementById("color");
                                elements[2] = document.getElementById("paper_num");
                                elements[3] = document.getElementById("other_info");
                                elements[4] = document.getElementById("orientation");
                                for (element in elements)
                                {
                                    elements[element].addEventListener("change",function () {
                                        changefile(<?php echo "'$orderId'";?>,selected);
                                    });
                                }
                            </script>
                        </form>
                        <img src="/image/jdt2.png" class="jdt">
                        <div class="go" id="go_two">
                        <button class="button button-highlight button-rounded button-large" onclick="showAndHidden3()">上一步</button>
                                <button class="button button-action button-rounded button-large" onclick="showAndHidden2()">下一步</button>
                        </div>
                        <!--<nav>打印参数</nav>-->
                    </div>

                    <div class="form" id="form3">
                        <form action="">
                            <input id="map_search" onchange="search(document.getElementById('map_search').value)" type="search" placeholder="输入打印店名来查找" size="50">
                        </form>
                        <div id="baiduMap"><p style="position: absolute;top: 50%,right:50%">请设置使浏览器允许使用百度地图插件。</p></div>
                        <div class="mapform" id="mapform">
                            <table cellspacing="0">
                                <thead>
                                <tr>
									 <td id="gettime1">提取时间</td>
                                    <td>店名</td>
                                    <td>地址</td>
                                    <td>距离</td>
                                    <td>价格</td>
                                    <td>评分</td>
                                    <td>营业</td>
                                   
                                </tr>
                                </thead>
                                <tbody>
                                <tr>    <!--这里是内容 -->
								    <td id="gettime"><center><input type="datetime" class="layui-input" id="datepicker"></center></td>
                                    <td id="user_name"></td>
                                    <td id="other"></td>
                                    <td id="distance"></td>
                                    <td id="cost"></td>
                                    <td id="score"></td>
                                    <td id="state"></td>
                                   
									<!--<input type="datetime-local" id="datepicker" date_format="mm-dd" style="border-style:none">-->
                                </tr>
                                </tbody>
								<script>
								layui.use('laydate', function(){
								  var laydate = layui.laydate;
								  
								  //执行一个laydate实例
								  laydate.render({
									elem: '#datepicker' //指定元素
									,format: 'yyyy-MM-dd HH:mm' //可任意组合
									,type: 'datetime'
									
								  });
								});
								</script>

                            </table>
						
                        </div>
                        <img src="/image/jdt3.png" class="jdt">
                        <div class="go" id="go_three">
                        <button class="button button-highlight button-rounded button-large" onclick="showAndHidden4()">上一步</button>
                                <button class="button button-caution button-rounded button-large" id="deadline" onclick="finishOrder(<?php echo "'$orderId','$username'";?>)">完成</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="footer">
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
        </div> -->
    </div>
    <div class="gray" id="ok" style="visibility: hidden">
                    <div class="finish" id="ok">
                        <!-- <i onclick="document.getElementById('ok').style.visibility='hidden'" class="layui-icon layui-icon-close" style="font-size: 24px; color: #x1006; position: absolute; right:0; margin:6px;"></i> -->
                        <img src="/image/true.png">
                        <nav>提交成功</nav>
                        <p id="exCode"></p>
                        <div id="fin">
                        <a href="/user-admin/user-order.php" class="button button-rounded">查看订单</a>
                        <a href="newOrder.php"  class="button button-rounded button-primary">再来一单</a>
                        </div>
                    </div>
            </div>
            <div class="gray" id="waiting" style="display:none;">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
            <div class="gray" id="nok" style="visibility: hidden">
                    <div class="finish" id="nok">
                        <!-- <i onclick="document.gestElementById('nok').style.visibility='hidden'" class="layui-icon layui-icon-close" style="font-size: 24px; color: #x1006; position: absolute; right:0; margin:6px;"></i> -->
                        <img src="/image/false.png">
                        <nav>提交失败</nav>
                        <p id="fail_info">提取时间未能满足您的需求，请换个时间</p>
                        <div id="fin">
                        <a href="#" onclick="document.getElementById('nok').style.display='none'" class="button button-rounded button-primary">重试</a>
                        </div>
                    </div>
            </div>
<script type="text/javascript">
    var orderId = <?php echo "'$orderId';";?>
    var map = new BMap.Map("baiduMap");
    var c = getLocation();
    var costWeight = <?php echo $costW;?>;
    var distanceWeight = <?php echo $distanceW;?>;
    var scoreWeight = <?php echo $scoreW;?>;
    walk = new BMap.RidingRoute(map, {
        renderOptions: {map: map},
        onMarkersSet:function(routes) {
            map.removeOverlay(routes[0].marker); //删除起点
            map.removeOverlay(routes[1].marker);//删除终点
        }
    });


    var point = new BMap.Point(116.98,36.67);
    map.centerAndZoom(point,13);
    map.addControl(new BMap.GeolocationControl());
    map.addControl(new BMap.NavigationControl());
    map.enableScrollWheelZoom(true);
    var geolocation = new BMap.Geolocation();
    geolocation.getCurrentPosition(function(r){
        if(myLo == -1 || myLa == -1)
        {
            if(this.getStatus() == BMAP_STATUS_SUCCESS){
                myLo = r.point.lng;
                myLa = r.point.lat;
                map.panTo(r.point);
            }
        }
    });

    map.addEventListener("dragend", function(result){
        getTag(map);
    });
    map.addEventListener("click", function(e){   //点击事件
        if(e.overlay){
            return ;
        }
        var myGeo = new BMap.Geocoder();
        myGeo.getLocation(new BMap.Point(e.point.lng,e.point.lat ), function(result){
            if (result){
                setMyLocation(e.point.lng,e.point.lat,map);
            }
        });
    });
</script>
</body>

</html>
<?php
ob_end_flush();
?>