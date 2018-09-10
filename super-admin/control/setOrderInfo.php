<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '3'){
    header("location:/index.php");
}
$username = mysql_escape_string($_SESSION['user']);
$password = mysql_escape_string($_SESSION['pass']);
$method = mysql_escape_string($_POST['method']);
$orderId = mysql_escape_string($_POST['orderId']);
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password' and type='3'")) == false){
    header("location:/index.php");
    exit();
}
$result = mysql_query("select * from orderinfo where orderId = '$orderId'");
$row = mysql_fetch_array($result);
if($row != false)
{
    switch ($method)
    {
        case 'delete':
            mysql_query("delete from orderinfo where orderId='$orderId'");
            $tIme =  time();
            mysql_query("INSERT INTO delfiles (orderId, time)VALUES (\"$orderId\", \"$tIme\")");
            break;
    }

}

