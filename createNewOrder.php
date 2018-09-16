<?php

session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '1'){

    echo "<script type='text/javascript'>alert(\"请重新登陆。\");</script>";
    echo "<script>window.location.href='/index.php';</script> ";
}
$username = mysql_escape_string($_SESSION['user']);
$password = mysql_escape_string($_SESSION['pass']);

$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);

if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password'")) == false){
    header("location:/index.php");
    exit();
}
$orderId =  mysql_escape_string($_POST["orderId"]);
$consumer = mysql_escape_string($_POST["consumer"]);
$deadline = mysql_escape_string($_POST["deadline"]);
$business = mysql_escape_string($_POST["business"]);
if(mysql_fetch_array(mysql_query("select * from orderinfo where orderId='$orderId'"))!=false
    || mysql_fetch_array(mysql_query("select * from orderids where orderId='$orderId'"))==false
        || mysql_fetch_array(mysql_query("select * from user where username='$consumer' and type='1'"))==false
            || mysql_fetch_array(mysql_query("select * from user where username='$business' and type='2'"))==false){
        exit();
}
do{
    $exCode = rand(100000,999999);
    $check = mysql_query("select * from orderinfo where business='$business' and exCode='$exCode'");
    $check = mysql_fetch_array($check);
}while($check != false);

if (true == mysql_query("INSERT INTO orderinfo (orderId, consumer,business,deadline,exCode)VALUES (\"$orderId\", \"$consumer\",\"$business\",\"$deadline\",\"$exCode\")"))
{
    echo "exCode = $exCode;";
    mysql_query("delete from delfiles where orderId = '$orderId'");
}
else {
    echo "exCode = 'failure';";
}
