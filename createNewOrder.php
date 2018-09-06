<?php

session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] == '2'){

    echo "<script type='text/javascript'>alert(\"请重新登陆。\");</script>";
    echo "<script>window.location.href='/index.php';</script> ";
}
$username = $_SESSION['user'];
$password = $_SESSION['pass'];

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
$orderId = $_POST["orderId"];
$consumer = $_POST["consumer"];
$deadline = $_POST["deadline"];
$business = $_POST["business"];
if(mysql_fetch_array(mysql_query("select * from orderinfo where orderId='$orderId'"))!=false
    || mysql_fetch_array(mysql_query("select * from orderids where orderId='$orderId'"))==false
        || mysql_fetch_array(mysql_query("select * from user where consumer='$consumer'"))==false
            || mysql_fetch_array(mysql_query("select * from user where business='$business'"))==false){
    echo "failure";
        exit();
}
do{
    $exCode = rand(100000,999999);
    $check = mysql_query("select * from orderinfo where business='$business' and exCode='$exCode'");
    $check = mysql_fetch_array($check);
}while($check != false);

if (true == mysql_query("INSERT INTO orderinfo (orderId, consumer,business,deadline,exCode)VALUES (\"$orderId\", \"$consumer\",\"$business\",\"$deadline\",\"$exCode\")"))
{
    echo $exCode;
    mysql_query("delete from delfiles where orderId = '$orderId'");
}
else {
    echo "failure";
}
