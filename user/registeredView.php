<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB"
        crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" type="text/css" href="../css/registered.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <title>Regist</title>
    <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3" charset="UTF-8"></script>
    <script type="text/javascript">
       function check_code(s) {
            console.log(1);
           var code;
           //获取账号
            if(s == 1){
                code = document.getElementById("usernamE").value;
            }
            else {
                code = document.getElementById("usernamEE").value;
            }
            var reg = /^\w{6,12}$/;
            if(reg.test(code)) {
                return true;
            } else {
                alert("用户名错误,必须为6-12位字母或数字或下划线");
                return false;
            }
        }
        function check_pwd(s){
            console.log(2);
           var code2;
            if (s == 1){
                code2 =document.getElementById("password").value;
            }
            else {
                code2 =document.getElementById("passworD").value;
            }

            var reg2 = /^\w{6,16}$/;
            if(reg2.test(code2)) {
                return true;
            } else {
                alert("密码错误,必须为6-16位字母或数字或下划线");
                return false;
            }

        }
        function checkpone(s) {
           if(s == 1) {
               var phone = document.getElementById("phone1").value;
           }
           else{
               var phone = document.getElementById("phone2").value;
           }
           if(phone.length != 11)
           {
               alert("请不要中二， 输入正确的手机号。")
               return false;
           }
            return true;
        }
        function check(s) {
           if (s == 2)
           {
               var other = document.getElementById("other") , province = document.getElementById("province");
               if(other.value == '' || province.value == ''){
                   alert("请输入详细地址和选择你的坐标。");
                   return false;
               }
           }
            return check_code(s) && check_pwd(s) && checkpone(s);
        }

    </script>
</head>

<body>
    <div class="container">
        <div class="hd">
        <div class="header">
            <div class="daohang">
                <a href="/index.php"><img src="../image/logo1.png" alt="logo" id="logo"></a>
                <span>
                    <a href="/index.php?login=">登录</a> | <a href="/user/registeredView.php">注册</a>
                </span>
            </div>
        </div>
        </div>
        
        <div class="regist">
            <div id="accordion">
                <div class="card" id="card1">
                    <div class="card-header" id="headingOne">
                        <a class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            注册云打印用户
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <form action="/user/registered.php" method="post" onsubmit="return check(1)">
                                <div class="form" id="fo1">
                                    <nav class="biaoti">用户注册</nav>
                                    <HR align="center" width="100%" color="#3E5C76" SIZE="3">
                                    <div class="form_left">
                                        <nav>用户名：</nav>
                                        <nav>密码：</nav>
                                        <nav>手机：</nav>
                                    </div>
                                    <div class="form_right">
                                        <input type="text" name="username" id="usernamE">
                                        <br>
                                        <input type="password" name="password" id="password">
                                        <input type="text" name="phone" id="phone1">
                                        <input type="hidden" name="type" value="1" >
                                    </div>
                                </div>
                                <div class="submit" id="sb1">
                                    <button type="submit" class="button button-glow button-rounded button-raised button-primary" ">完成</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="card" id="card2">
                    <div class="card-header" id="headingTwo">
                        <a class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            成为云打印商家
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                        <div class="card-body">
                            <form action="/user/registered.php" method="post" onsubmit="return check(2)">
                                <div class="form" id="fo2">
                                    <nav class="biaoti" id="btTwo">商家注册</nav>
                                    <HR align="center" width="100%" color="#3E5C76" SIZE="3">
                                    <div class="fa">
                                    <div class="form_left">
                                        <nav>店铺名称：</nav>
                                        <nav>密码：</nav>
                                        <nav>详细地址：</nav>
                                        <nav>手机：</nav>
                                    </div>
                                    <div class="form_right">
                                        <input type="text" name="username" id="usernamEE">
                                        <br/>
                                        <input type="password" name="password" id="passworD">
                                        <br/>
                                        <input type="text" name="other" id="other">
                                        <br/>
                                        <input type="text" name="phone" id="phone2">
                                    </div>
                                    </div>
                                    <div class="fb">
                                    <div id="map"><p style="position: absolute;top: 50%,right:50%">请设置使浏览器允许使用百度地图插件。</p></div>
                                    <div id="position">
                                        <input type="hidden" name="type" value="2" />
                                        <table cellspacing="0" id="mapinfo">
                                            <thead>
                                                <tr id="tone">
                                                    <td id="shengfen">省份</td>
                                                    <td id="chengshi">城市</td>
                                                    <td id="quyu">区域</td>
                                                    <td id="jingdu">经</td>
                                                    <td id="weidu">纬</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="ttwo">    <!--这里是内容 -->
                                                    <td><input type="text" class="lo_box" name="province" id="province" readonly /></td>
                                                    <td><input type="text" class="lo_box" name="city" id="city" readonly /></td>
                                                    <td><input type="text" class="lo_box" name="area" id="area" readonly /></td>
                                                    <td><input type="text" class="lo_box" name="lo" id="lo" readonly /></td>
                                                    <td><input type="text" class="lo_box" name="la" id="la" readonly /></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    </div>
                                    
                                </div>

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
                                    map.addEventListener("click", function(e){   //点击事件

                                        var myGeo = new BMap.Geocoder();
                                        myGeo.getLocation(new BMap.Point(e.point.lng,e.point.lat ), function(result){
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
                                <div class="submit">
                                    <button type="submit" class="button button-glow button-rounded button-raised button-primary">完成</button>
                                    </div>
                            </form>
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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T"
        crossorigin="anonymous"></script>
</body>

</html>