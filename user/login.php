<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2018/7/16
 * Time: 8:33
 */

	
	
    header("Content-Type: text/html;charset=utf-8");
    $con = mysql_connect("localhost","root","wslzd9877");
    if (!$con)
    {
        die('Could not connect: ' . mysql_error());
    }
    mysql_select_db("user", $con);

session_set_cookie_params(24 * 3600);
session_start();

if(isset($_SESSION['user']) == false)
{
    $user = mysql_escape_string($_POST["username"]);
    $pass = mysql_escape_string($_POST["password"]);
    $_SESSION['user'] = $user;
    $_SESSION['pass'] = $pass;
    $result = mysql_query("SELECT * FROM user WHERE username= \"$user\"");
    $row = mysql_fetch_array($result);
    $_SESSION['user'] = $row['username'];
    $_SESSION['type'] = $row['type'];
    $truepass = $row['password'];
}

    if (isset($pass) && isset($truepass) && $pass == $truepass){
        $type = $_SESSION["type"];
        if($type == '2'){
            header("location:/admin/index.php");
        }
        else if($type == '1'){
            header("location:/newOrder.php");
        }
        else if($type == '3'){
            header("location:/super-admin/index.php");
        }
    }
    else {
        echo "<script type='text/javascript'>
		alert(\"用户名或密码错误\");</script>";
        session_destroy();
        echo "<script>window.location.href='/index.php?login=';</script> ";
    }