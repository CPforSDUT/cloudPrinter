<?php

session_start();
if (isset($_SESSION["user"]) == false)
{
    echo "<script type='text/javascript'>alert(\"请重新登陆。\");</script>";
    echo "<script>window.location.href='/index.php';</script> ";
}
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
$orderId = $_POST["orderId"];
$consumer = $_POST["consumer"];
$deadline = $_POST["deadline"];
$business = $_POST["business"];
$exCode = $_POST["exCode"];
mysql_select_db("user", $con);
if (true == mysql_query("INSERT INTO orderinfo (orderId, consumer,business,deadline,exCode)VALUES (\"$orderId\", \"$consumer\",\"$business\",\"$deadline\",\"$exCode\")"))
{
    echo "ok";
    mysql_query("delete from delfiles where orderId = '$orderId'");
}
