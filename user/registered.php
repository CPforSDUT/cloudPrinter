<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/10
 * Time: 23:12
 */
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
if(isset($_POST["username"])) {
    $con = mysql_connect("localhost", "root", "wslzd9877");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("user", $con);
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $type = $_POST["type"];
    $province = escape($_POST["province"]);
    $Area = escape($_POST["Area"]);
    $City = escape($_POST["City"]);
    $lo = $_POST["lo"];
    $la = $_POST["la"];
    $Other = escape($_POST["Other"]);
    $result = mysql_query("SELECT * FROM users WHERE username= \"$user\"");
    $row = mysql_fetch_array($result);
    if($row == null)
    {
        mysql_query("INSERT INTO users (username, password,type,la,lo,province,City,Area,Other) VALUES (\"$user\", \"$pass\",\"$type\",\"$la\",\"$lo\",\"$province\",\"$City\",\"$Area\",\"$Other\")");
        mysql_close($con);
        echo "success";
    }
    else
    {
        echo "failure";
    }

}