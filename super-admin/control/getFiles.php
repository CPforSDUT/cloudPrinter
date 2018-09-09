
<?php
/*
 * <tr>
                                <td>
                                    <a class="link-download" href="#">下载</a>
                                    <a class="link-update" href="#">修改</a>
                                    <a class="link-del" href="#">删除</a>
                                </td>
                            </tr>
 */
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
function getFileType($fileType)
{
    $paperSizes = Array("A0","A1","A2","A3","A4","A5","A6","A7","A8","A9","A10","B0","B1","B2","B3","B4","B5","B6","B7","B8","B9","B10");
    $paperSizes2 = Array(1,2,4,8,16,32,64,128,256,512,1024,2048,4096,8192,16384,32768,65536,131072,262144,524288,1048576,2097152);
    for($i = 0 ; $paperSizes2[$i] != $fileType ; $i ++);
    return $paperSizes[$i];
}
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '3'){
    header("location:/index.php");
}
$username = mysql_escape_string($_SESSION['user']);
$password = mysql_escape_string($_SESSION['pass']);
$pageNum = $_POST['pageNum'] - 1;
$orderId = mysql_escape_string($_POST['orderId']);

$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password'")) == false){
    header("location:/index.php");
    exit();
}
$visit = "where 1=1 ";
if($orderId != 'false'){
    $visit = $visit . " and orderId='$orderId'";
}
if(mysql_fetch_array(mysql_query("select * from orderinfo $visit")) == false){
    exit();
}
$pageNum *= 7;
$result = mysql_query("select * from fileinfo $visit limit $pageNum,7");

for ($i = 0 ;$i < 7 && $row = mysql_fetch_array($result)  ; $i ++)
{
    $filePath = $row['filePath'];
    $color = $row['color'];
    $color = $color == '1' ? "黑白":"彩色";
    $num = $row['num'];
    $paperType = getFileType($row['paperType']);
    $filename = unescape($row['filename']);
    $otherInfo = unescape($row['otherInfo']);
    $paperWay = $row['paperWay'];
    $orderId = $row['orderId'];
    if($paperWay == '1'){
        $paperWay = '竖向';
    }
    else {
        $paperWay = '横向';
    }
    echo "<tr>";
    echo "<td>$filename</td>";
    echo "<td>$color</td>";
    echo "<td>$num</td>";
    echo "<td>$paperWay</td>";
    echo "<td>$paperType</td>";
    echo "<td>$otherInfo</td>";
    echo "<td><a class=\"link-download\" href=\"control/download.php?orderId=$orderId&filePath=$filePath&filename=$filename\">下载</a></td>";
    echo "</tr>";
}
