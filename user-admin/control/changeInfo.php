<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/9/2
 * Time: 20:03
 */
session_start();
if(isset($_SESSION['user']) == false){
    header("location:/user/loginView.php");
}
$username = $_SESSION['user'];
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$address = $_POST['address'];
$password = $_POST['password'];
if($address != ''){
    mysql_query("UPDATE user SET other='$address' WHERE username = '$username'");
}
if($password != ''){
    mysql_query("UPDATE user SET password='$password' WHERE username = '$username'");
}
header("location:/user-admin/user-order.php");