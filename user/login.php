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
    $user = $_POST["username"];
    $pass = $_POST["password"];
    $_SESSION['user'] = $user;
    $_SESSION['pass'] = $pass;
    $result = mysql_query("SELECT * FROM users WHERE username= \"$user\"");
    $row = mysql_fetch_array($result);
    $_SESSION['type'] = $row['type'];
}

    if ($pass == $row['password']){
        echo "<script>alert('login successful!');</script>";
        $type = $row["type"];

        if($type != '2') {
            header("location:/fileControl/userView.php");
        }
        else {
            header("location:/fileControl/businessView.php");
        }
    }
    else {
        echo "<script type='text/javascript'>alert(\"用户名或密码错误\");</script>";
        echo "<script>window.location.href='/index.php';</script> ";
    }