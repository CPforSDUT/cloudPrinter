

<?php
error_reporting(E_ALL^E_NOTICE);
function escape($str) {
    preg_match_all ( "/[\xc2-\xdf][\x80-\xbf]+|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}|[\x01-\x7f]+/e", $str, $r );
    //匹配utf-8字符，
    $str = $r [0];
    $l = count ( $str );
    for($i = 0; $i < $l; $i ++) {
        $value = ord ( $str [$i] [0] );
        if ($value < 223) {
            $str [$i] = rawurlencode ( utf8_decode ( $str [$i] ) );
            //先将utf8编码转换为ISO-8859-1编码的单字节字符，urlencode单字节字符.
            //utf8_decode()的作用相当于iconv("UTF-8","CP1252",$v)。
        } else {
            $str [$i] = "%u" . strtoupper ( bin2hex ( iconv ( "UTF-8", "UCS-2", $str [$i] ) ) );
        }
    }
    return join ( "", $str );
}
function unescape($str) {
	$ret = '';
	$len = strlen ( $str );
	for($i = 0; $i < $len; $i ++) {
		if ($str [$i] == '%' && $str [$i + 1] == 'u') {
			$val = hexdec ( substr ( $str, $i + 2, 4 ) );
			if ($val < 0x7f)
				$ret .= chr ( $val );
			else if ($val < 0x800)
				$ret .= chr ( 0xc0 | ($val >> 6) ) . chr ( 0x80 | ($val & 0x3f) );
			else
				$ret .= chr ( 0xe0 | ($val >> 12) ) . chr ( 0x80 | (($val >> 6) & 0x3f) ) . chr ( 0x80 | ($val & 0x3f) );
			$i += 5;
		} else if ($str [$i] == '%') {
			$ret .= urldecode ( substr ( $str, $i, 3 ) );
			$i += 2;
		} else
			$ret .= $str [$i];
	}
	return $ret;
}
?>
<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <head>
        <style type="text/css">
            html{height:100%}
            body{height:100%;margin:0px;padding:0px}
            #container{height:90%}
        </style>
        <script type="text/javascript" src="http://api.map.baidu.com/api?v=3.0&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3" charset="UTF-8"></script>
        <script type="text/javascript" src="http://api.map.baidu.com/library/TextIconOverlay/1.2/src/TextIconOverlay_min.js" charset="UTF-8"></script>
        <script type="text/javascript" src="http://api.map.baidu.com/library/MarkerClusterer/1.2/src/MarkerClusterer_min.js" charset="UTF-8"></script>
        <script type="text/javascript">

                function $_cookie(name,value) {
                    var date = new Date();

                    $livetime = 5 * 24 * 3600 * 1000;// cookie生命周期
                    date.setTime(date.getTime() + $livetime);
                    document.cookie = name + "=" + escape(value) + ";expires=" + date.toGMTString();
                }
            function createTag(marker,m){

                //标注
                var text = m;
                var infoWindow = new BMap.InfoWindow(text);
                marker.addEventListener("click", function () { this.openInfoWindow(infoWindow);document.getElementById('printname').value=infoWindow.getContent(); });
            }
            function check() {
                console.log(1);
                //获取账号
                var code = document.getElementById("printname").value;
                    var reg = /^\w{6,12}$/;
                    if(reg.test(code)) {
                        return true;
                    } else {
                        alert("商家用户名错误,必须为6-12位字母或数字或下划线");
                        return false;
                    }
            }

        </script>
    </head>
    <body>
        <?php
            session_start();
            if(isset($_SESSION['user']) == false){

                echo "<script type='text/javascript'>alert(\"请重新登陆。\");</script>";
                echo "<script>window.location.href='/index.php';</script> ";
            }
            ?>
        <form action="/fileControl/uploadFile.php" method="post" enctype="multipart/form-data" onsubmit="return check()">
                <label for="file">文件名：</label>
                <input type="file" name="file" id="file"><br \>
                <input type="text" name="username"  readonly="true"  value="<?php echo $_SESSION['user'];?>">
                <input type="text" name="printname" id="printname">
                <input type="submit" name="submit" value="提交">
        </form>
        <div id="container"></div>
        <?php
        $con = mysql_connect("localhost","root","wslzd9877");
        if (!$con)
        {
            die('Could not connect: ' . mysql_error());
        }

        mysql_select_db("user", $con);
        ?>
        <script type="text/javascript" charset="UTF-8">
            var map = new BMap.Map("container");
            var point = new BMap.Point(116.38,39.90);
            var x,y;
            <?php
            if(isset($_COOKIE['provinceip'])) {
                $html2 = file_get_contents("http://api.map.baidu.com/geocoder/v2/?output=json&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3&" . "address=" . unescape($_COOKIE['provinceip']).";");
                echo "var tpoint=" . $html2.";";
                echo "point = new BMap.Point(tpoint.result.location.lng,tpoint.result.location.lat);";
            }

            ?>
            map.centerAndZoom(point,8);
            map.addControl(new BMap.GeolocationControl());
            map.addControl(new BMap.NavigationControl());
            map.addControl(new BMap.MapTypeControl());

            var geolocation = new BMap.Geolocation();

            geolocation.getCurrentPosition(function(r){
                if(this.getStatus() == BMAP_STATUS_SUCCESS){
                    var mk = new BMap.Marker(r.point);
                    var center;
                    var myGeo = new BMap.Geocoder();
                    //map.addOverlay(mk);
                    map.panTo(r.point);
                    myGeo.getLocation(new BMap.Point(r.point.lng ,r.point.lat ), function(result){
                        if (result){
                            var addComp = result.addressComponents;
                            var pt = null;
                            var i = 0;
                            var mark;
                            $_cookie("province",addComp.province);
                            <?php
                            if(isset($_COOKIE["province"])) {
                                //session_destroy();
                                $province = $_COOKIE["province"];
                                $order = "SELECT * FROM users WHERE province = '$province' and type = '2'";
                                //echo "alert(\"".unescape($province)."\");";
                                $result = mysql_query("$order");

                                while($row = mysql_fetch_array($result)) {
                                    $lo = $row['lo'];
                                    $la = $row['la'];
                                    $printname = $row['username'];
                                    echo "pt = new BMap.Point($lo,$la);";
                                    echo "mark=new BMap.Marker(pt);";
                                    echo "map.addOverlay(mark);";
                                    echo "createTag(mark,\"$printname\");";
                                }
                            }
                            else {
                                echo "location.href='/fileControl/userView.php';";
                            }
                            ?>
                        }
                    });
                }
                else {
                    var pt = null;
                    var i = 0;
                    var mark;

<?php
                            $html = file_get_contents("http://pv.sohu.com/cityjson?ie=utf-8");
                            echo $html;

?>
                    $_cookie("provinceip",returnCitySN.cname);
<?php


                        if(isset($_COOKIE["provinceip"])) {
                                //session_destroy();
                            $province = $_COOKIE["provinceip"];
                            $order = "SELECT * FROM users WHERE province = '$province' and type = '2'";
                            //echo "alert(\"$order\");";
                            $result = mysql_query("$order");

                            while($row = mysql_fetch_array($result)) {
                                $lo = $row['lo'];
                                $la = $row['la'];
                                $printname = $row['username'];
                                echo "pt = new BMap.Point($lo,$la);";
                                echo "mark=new BMap.Marker(pt);";
                                echo "map.addOverlay(mark);";
                                echo "createTag(mark,\"$printname\");";
                            }
                        }
                        else {
                            echo "location.href='/fileControl/userView.php';";
                        }
?>
                }
            });

        </script>
    </body>
</html>
