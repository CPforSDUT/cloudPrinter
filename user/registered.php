<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
    $user = mysql_escape_string($_POST["username"]);
    $pass = mysql_escape_string($_POST["password"]);
    $type = mysql_escape_string($_POST["type"]);
    $phone = mysql_escape_string($_POST["phone"]);
    if($type == '2'){
        $province = escape($_POST["province"]);
        $area = escape($_POST["area"]);
        $city = escape($_POST["city"]);
        $lo = mysql_escape_string($_POST["lo"]);
        $la = mysql_escape_string($_POST["la"]);
        $other = escape($_POST["other"]);
    }
    else {
        $province = '';
        $area = '';
        $city = '';
        $lo = '';
        $la = '';
        $other = '';
    }
    $result = mysql_query("SELECT * FROM user WHERE username= \"$user\"");
    $row = mysql_fetch_array($result);

    if($row == null)
    {
        mysql_query("INSERT INTO user (username, password,type,la,lo,province,city,area,other,state,phone) VALUES (\"$user\", \"$pass\",\"$type\",\"$la\",\"$lo\",\"$province\",\"$city\",\"$area\",\"$other\",\"1\",\"$phone\")");
        if($type == '1'){
            mysql_query("insert into alloc (username) values('$user')");
        }
        else {
            mysql_query("insert into printerinfo (username) values('$user')");
            mysql_query("insert into aisort (username) values('$user')");
            mysql_query("insert into pay (username) values('$user')");
        }
        mysql_close($con);
        header("location:/index.php?login=");
    }
    else
    {
        echo "<script>alert('用户名已存在。');window.history.back(-1); </script>";

    }

}