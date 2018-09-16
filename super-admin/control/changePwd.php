<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '3'){
    header("location:/index.php");
}
$password = mysql_escape_string($_SESSION['pass']);
$username = mysql_escape_string($_SESSION['user']);
$upass = mysql_escape_string($_POST['password']);
$opass = mysql_escape_string($_POST['oPassword']);
if($opass == $password){
    $con = mysql_connect("localhost", "root", "wslzd9877");
    if (!$con) {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("user", $con);
    mysql_query("update user set password='$upass' where username='$username'");
    echo "ok";
}
else {
    echo "failure";
}
?>