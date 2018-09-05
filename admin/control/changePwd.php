<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] == '1'){
    header("location:/index.php");
}
$password = $_SESSION['pass'];
$username = $_SESSION['user'];
$upass = $_POST['password'];
$opass = $_POST['oPassword'];
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