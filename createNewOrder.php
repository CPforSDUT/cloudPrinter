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
mysql_select_db("user", $con);
$orderId = $_POST["orderId"];
$consumer = $_POST["consumer"];
$deadline = $_POST["deadline"];
$business = $_POST["business"];
do{
    $exCode = rand(100000,999999);
    $check = mysql_query("select * from orderinfo where business='$business' and exCode='$exCode'");
    $check = mysql_fetch_array($check);
}while($check != false);

if (true == mysql_query("INSERT INTO orderinfo (orderId, consumer,business,deadline,exCode)VALUES (\"$orderId\", \"$consumer\",\"$business\",\"$deadline\",\"$exCode\")"))
{
    echo $exCode;
    mysql_query("delete from delfiles where orderId = '$orderId'");
}
else {
    echo "failure";
}
