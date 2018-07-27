<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <link rel="stylesheet" type="text/css" href="/css/Buttons.css">
    <title>云打印|cloudPrinter</title>
    <style type="text/css">
        #top
        {
            font-family: "Microsoft YaHei UI";
            color: white;
            text-align: center;
        }
        body{
            background-image: url("/image/resback.png");
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            height:100%;margin:0px;padding:0px;
        }
        .btn {
            background:rgba(255, 251, 240, 0);
            border-style :none;
            color: white;
            text-align: center;
        }
        html{height:100%}
        #container{
            height:50%;
            top: 0;
            left: 0;
            margin: auto;
            border-radius: 30px;
        }
        .mid{
            text-align: center;
            color: #DDDDDD;
            border-radius: 20px;
            width: 80%;
            height: 100%;
            margin: auto;
            background:rgba(255, 251, 240, 0.3);
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }
    </style>


    <script type="text/javascript">
        function check_code() {
            console.log(1);
            //获取账号
            var code =
                document.getElementById("username").value;
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
            if(document.getElementById("la").value == ""){
                alert("请选择位置");
                return false;
            }
            return check_code() && check_pwd();
        }
    </script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3" charset="UTF-8"></script>
</head>
<body>
<h1 id="top" >.cloudPrinter</h1>

<div class="mid">
    <br />
    <form action="/user/registered.php" method="POST" onsubmit="return check()">
        <p>注册用户: <input type="text" name="username" id="username" class="button button-rounded button-tiny"></p>
        <p>注册密码: <input type="password" name="password" id="password" class="button button-rounded button-tiny"></p>
        <p>详细地址: <input type="text" name="Other" class="button button-rounded button-tiny"/></p>
        <p>   <input type="radio" name="type" value="1" checked class="button button-circle button-tiny"/>用户
            <input type="radio" name="type" value="2" class="button button-circle button-tiny"/>商家
        </p>

        <input type="submit" class="button button-primary button-rounded button-small">
        <br />
        <p style="color: white">选择您（商家/用户）的位置</p>
        <input type="text" name="province"  readonly="true" id="province" class="btn"/>
        <input type="text" name="City"  readonly="true" id="City" class="btn"/>
        <input type="text" name="Area"  readonly="true" id="Area" class="btn"/>
        <input type="text" name="lo"  readonly="true" id="lo" class="btn"/>
        <input type="text" name="la"  readonly="true" id="la" class="btn"/>
    </form>
    <div id="container" style="width: 62%"></div>

    <script type="text/javascript">
        var map = new BMap.Map("container");
        var point = new BMap.Point(116.404, 39.915);
        var x,y;
        map.centerAndZoom(point, 10);
        map.addControl(new BMap.GeolocationControl());
        map.addControl(new BMap.NavigationControl());
        map.addControl(new BMap.MapTypeControl());
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
        map.addEventListener("click", function(e){   //点击事件
            //alert(e.point.lng + ", " + e.point.lat);
            //if(!e.overlay){
            //  alert("aaaaaaaa");
            //}
            var myGeo = new BMap.Geocoder();
            center = map.getCenter()
            myGeo.getLocation(new BMap.Point(center.lng ,center.lat ), function(result){
                if (result){
                    var addComp = result.addressComponents;
                    var pt = null;
                    var i = 0;
                    var mark;
                    document.getElementById("province").value=addComp.province;
                    document.getElementById("City").value=addComp.city;
                    document.getElementById("Area").value=addComp.district;
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
</div>



</body>
</html>