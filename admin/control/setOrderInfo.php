<?php
session_start();
if(isset($_SESSION['user']) == false){
    header("location:/user/loginView.php");
}
$username = $_SESSION['user'];
$method = $_POST['method'];
$orderId = $_POST['orderId'];
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$result = mysql_query("select * from orderinfo where orderId = '$orderId'");
$row = mysql_fetch_array($result);
if($row['business'] != $username){
    //echo "select * from orderinfo where orderId = '$orderId'";
    //echo $row['business']."1".$username;
}
switch ($method)
{
    case 'okOrder':
        mysql_query("UPDATE orderinfo SET orderState='2' WHERE orderId='$orderId'");
        break;
    case 'delete':
        if($row['deleted'] == 'cn'){
            mysql_query("delete from orderinfo where orderId='$orderId'");
        }
        else {
            mysql_query("UPDATE orderinfo SET deleted='bn' WHERE orderId='$orderId'");
        }
}
