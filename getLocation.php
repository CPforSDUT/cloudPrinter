<?php
$province = $_POST['province'];
$html2 = file_get_contents("http://api.map.baidu.com/geocoder/v2/?output=json&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3&" . "address=" . $province.";");
echo "var tpoint=" . $html2.";\n";
echo "var res = Array();\n";
echo "res[0]=tpoint['result']['location']['lng'];\n";
echo "res[1]=tpoint['result']['location']['lat'];\n";
echo "return res;\n";
?>