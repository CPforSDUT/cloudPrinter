<?php
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
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '3'){
    exit;
}

$username = mysql_escape_string($_SESSION['user']);
$password = mysql_escape_string($_SESSION['pass']);
$filePath = mysql_escape_string($_GET['filePath']);
$filename = unescape($_GET['filename']);
$orderId = mysql_escape_string($_GET['orderId']);

$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);

if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password'  and type ='3'")) == false){
    header("location:/index.php");
    exit();
}
$filePath = "../../../".$filePath;
    if( !file_exists($filePath)){
        exit;
    } else {
        header('Accept-Ranges: bytes');
        header('Accept-Length: ' . filesize($filePath));
        header('Content-Transfer-Encoding: binary');
        header('Content-type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.$filename);
        header('Content-Type: application/octet-stream; name='.$filename);
        if(is_file($filePath) && is_readable($filePath)){
            $file = fopen($filePath, "r");
            echo fread($file, filesize($filePath));
            fclose($file);
        }
    }

