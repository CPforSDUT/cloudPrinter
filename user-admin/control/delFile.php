<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] == '2'){
    header("location:/index.php");
}
$username = $_SESSION['user'];
$password = $_SESSION['pass'];
$orderId = $_POST['orderId'];
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password'")) == false){
    header("location:/index.php");
    exit();
}
$result = mysql_query("select * from orderinfo where orderId = '$orderId'");
$row = mysql_fetch_array($result);
if(strnatcasecmp($username,$row['consumer']) == 0){

    if($row['deleted'] == 'bn'){
        mysql_query("delete from orderinfo where orderId='$orderId'");
        $tIme =  time();
        mysql_query("INSERT INTO delfiles (orderId, time)VALUES (\"$orderId\", \"$tIme\")");
    }
    else {
        mysql_query("UPDATE orderinfo SET deleted='cn' WHERE orderId='$orderId'");
    }
}



