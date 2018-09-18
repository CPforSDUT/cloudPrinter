<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '1'){
    header("location:/index.php");
}
else {
    $username = mysql_escape_string($_SESSION['user']);
    $password = mysql_escape_string($_SESSION['pass']);
}
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password' and type='1'")) == false){
    header("location:/index.php");
    exit();
}
$orderId = mysql_escape_string($_POST['orderId']);
$score = mysql_escape_string($_POST['score']);
$business = mysql_query("select * from orderinfo where orderId='$orderId'");
$business = mysql_fetch_array($business);
if($business['orderState'] == '3'){
    exit();
}
$business = $business['business'];
$bScore = mysql_query("select * from user where username='$business' and type='2'");
$bScore = mysql_fetch_array($bScore);
$bScore = $bScore['score'];
$willPush = ($score-$bScore)/10.0;
$bScore += $willPush;
if($bScore <= 0.0){
    $bScore = 0.0;
}
else if($bScore >= 5.0){
    $bScore = 5.0;
}
mysql_query("update user set score='$bScore' where username='$business'");
mysql_query("update orderinfo set orderState='3' where orderId='$orderId'");