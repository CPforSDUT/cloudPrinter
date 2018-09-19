<?php
$ip = $_SERVER['REMOTE_ADDR'];
$html2 = file_get_contents("http://api.map.baidu.com/location/ip?ip=$ip&ak=04uLKfHLu2zT9eKoaSk2WsXC0ekF3aF3&coor=bd09ll");
echo "var tpoint=" . $html2 .";\n";