<?php
$paperNum = mysql_escape_string($_POST['paperNum']);
$paperSize = mysql_escape_string($_POST['paperSize']);
$color = mysql_escape_string($_POST['color']);
$otherInfo = mysql_escape_string($_POST['otherInfo']);
$orderId = mysql_escape_string($_POST['orderId']);
$fileName = mysql_escape_string($_POST['fileName']);
$paperWay = mysql_escape_string($_POST['paperWay']);
$paperSizes = Array("A0","A1","A2","A3","A4","A5","A6","A7","A8","A9","A10","B0","B1","B2","B3","B4","B5","B6","B7","B8","B9","B10");
$paperSizes2 = Array(1,2,4,8,16,32,64,128,256,512,1024,2048,4096,8192,16384,32768,65536,131072,262144,524288,1048576,2097152);

for ($i = 0 ; $i < 22 ; $i ++)
{
    if($paperSizes[$i] == $paperSize)
    {
        $paperSize = $paperSizes2[$i];
        break;
    }
}
session_start();
if(isset($_SESSION['user']) == false){
    header("location:/index.php");
}
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
//echo"UPDATE fileinfo SET color='$color',num='$paperNum',paperType='$paperSize',otherInfo='$otherInfo' WHERE orderId=$orderId";
mysql_query("UPDATE fileinfo SET color='$color',num='$paperNum',paperType='$paperSize',otherInfo='$otherInfo',paperWay='$paperWay' WHERE orderId='$orderId' and filename='$fileName'");