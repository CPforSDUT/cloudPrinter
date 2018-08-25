<!DOCTYPE html>
<?php


$paperSizes = Array("A0","A1","A2","A3","A4","A5","A6","A7","A8","A9","A10","B0","B1","B2","B3","B4","B5","B6","B7","B8","B9","B10");
$paperSizes2 = Array(1,2,4,8,16,32,64,128,256,512,1024,2048,4096,8192,16384,32768,65536,131072,262144,524288,1048576,2097152);


$orderId = $_POST['orderId'];
$fileName = $_POST['fileName'];

session_start();
if(isset($_SESSION['user']) == false){
    header("location:/user/loginView.php");
}
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$result = mysql_query("SELECT * FROM fileinfo where orderId = '$orderId' and filename='$fileName'");
$row = mysql_fetch_array($result);
$num = $row['num'];
$color = $row['color'];
$paperType  = $row['paperType'];
$otherInfo = $row['otherInfo'];

for ($i = 0 ; $paperType!=$paperSizes2[$i] ;$i ++ );
$paperType = $paperSizes[$i];
echo "<p id=\"paperNum\">$num</p>";
echo "<p id=\"paperSize\">$paperType</p>";
echo "<p id=\"Color\">$color</p>";
echo "<p id=\"otherInfo\">$otherInfo</p>";

