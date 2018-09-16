<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/9/2
 * Time: 20:03
 */
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '1'){
    header("location:/index.php");
}
$username = mysql_escape_string($_SESSION['user']);
$password = mysql_escape_string($_SESSION['pass']);
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password' and type='1'")) == false){
    header("location:/index.php");
    exit();
}
$address = mysql_escape_string($_POST['address']);
$password = mysql_escape_string($_POST['password']);
echo $password;

if($address != ''){
    mysql_query("UPDATE user SET other='$address' WHERE username = '$username'");
}

if($password != ''){
    mysql_query("UPDATE user SET password='$password' WHERE username = '$username'");
    header('location:/user/logout.php');
}
else {
    header("location:/user-admin/user-order.php");
}
