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
$costW = mysql_escape_string($_POST['costW']);
$disW = mysql_escape_string($_POST['disW']);
$scoreW =mysql_escape_string($_POST['scoreW']);

mysql_query("update alloc set cost='$costW',distance='$disW',score='$scoreW' where username='$username'");