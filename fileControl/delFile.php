<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/8/17
 * Time: 23:58
 */
session_start();
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
if (isset($_SESSION["user"]) == false)
{
    echo "<script type='text/javascript'>alert(\"请重新登陆。\");</script>";
    echo "<script>window.location.href='/index.php';</script> ";
}
$before = $_POST['filename'];
$filename = unescape($before );
$orderId = $_POST['orderId'];
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$result = mysql_query("select * from fileinfo where orderId = '$orderId' and filename = '$filename'");
$row = mysql_fetch_array($result);
$hashPath = $row['filePath'];

$filename = $before ;
mysql_query("delete from fileinfo where orderId = '$orderId' and filename = '$filename'");
$result = mysql_query("select * from fileinfo where filePath = '$hashPath'");
$row = mysql_fetch_array($result);
if($row == null) {
    unlink($hashPath);
}