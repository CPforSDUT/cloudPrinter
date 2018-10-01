<?php
function getSort($business)
{

    $my_curl = curl_init();    //初始化一个curl对象
    curl_setopt($my_curl, CURLOPT_URL, "http://127.0.0.1/admin/control/orderSort.php?business=$business");    //设置你需要抓取的URL
    curl_setopt($my_curl,CURLOPT_RETURNTRANSFER,1);    //设置是将结果保存到字符串中还是输出到屏幕上，1表示将结果保存到字符串
    curl_setopt($my_curl, CURLOPT_TIMEOUT, 600);
    $str = curl_exec($my_curl);    //执行请求
    curl_close($my_curl);    //关闭url请求
    return $str;    //输出抓取的结果
}
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '1'){

    echo "<script type='text/javascript'>alert(\"请重新登陆。\");</script>";
    echo "<script>window.location.href='/index.php';</script> ";
}
$username = mysql_escape_string($_SESSION['user']);
$password = mysql_escape_string($_SESSION['pass']);

$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);

if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password'")) == false){
    header("location:/index.php");
    exit();
}
$orderId =  mysql_escape_string($_POST["orderId"]);
$consumer = mysql_escape_string($_POST["consumer"]);
$deadline = mysql_escape_string($_POST["deadline"]);
$business = mysql_escape_string($_POST["business"]);
if($deadline < date("YmdHi",time()+600)){
    echo "exCode = 'failure';";
    exit();
}
if(mysql_fetch_array(mysql_query("select * from orderinfo where orderId='$orderId'"))!=false
    || mysql_fetch_array(mysql_query("select * from orderids where orderId='$orderId'"))==false
        || mysql_fetch_array(mysql_query("select * from user where username='$consumer' and type='1'"))==false
            || mysql_fetch_array(mysql_query("select * from user where username='$business' and type='2'"))==false){
        exit();
}
do{
    $exCode = rand(100000,999999);
    $check = mysql_query("select * from orderinfo where business='$business' and exCode='$exCode'");
    $check = mysql_fetch_array($check);
}while($check != false);
$hock = mysql_query("select * from aisort where username='$business'");
$hock = mysql_fetch_array($hock);
$hock = $hock['hock'];
$timeout = 0;
while($hock == 'y'){
    $timeout += 1;
    sleep(2);
    $hock = mysql_query("select * from aisort where username='$business'");
    $hock = mysql_fetch_array($hock);
    $hock = $hock['hock'];
    if($timeout >= 3){
        echo "exCode = 'timeout';";
        exit();
    }
}
mysql_query("update aisort set hock='y' where username='$business'");
if (true == mysql_query("INSERT INTO orderinfo (orderId, consumer,business,deadline,exCode,orderState)VALUES (\"$orderId\", \"$consumer\",\"$business\",\"$deadline\",\"$exCode\",\"9\")"))
{
    if(getSort($business) == 'ok'){
        mysql_query("update orderinfo set orderState='1' where orderId='$orderId'");
        echo "exCode = $exCode;";
        mysql_query("delete from delfiles where orderId='$orderId'");
    }
    else {
        mysql_query("delete from orderinfo where orderId='$orderId'");
        echo "exCode = 'failure';";
    }
    mysql_query("update aisort set hock='n' where username='$business'");

}
else {
    echo "exCode = 'failure';";
}
