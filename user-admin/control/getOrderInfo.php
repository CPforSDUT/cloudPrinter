<?php
/*
<tr>
<td>user</td>
<td>2018-11-11</td>
<td>已完成</td>
<td><a href="#">删除</a>||<a href="#">查看</a></td>
</tr>
 */
function toPureTime($dirtyTime)
{
    $year = substr($dirtyTime,0,4);
    $month = substr($dirtyTime,4,2);
    $day = substr($dirtyTime,6,2);
    $hours = substr($dirtyTime,8,2);
    $min = substr($dirtyTime,10,2);
    $pure =  "$year-$month-$day $hours:$min";
    return $pure;
}
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] == '2'){
    header("location:/index.php");
}
else {
    $username = $_SESSION['user'];
}
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$infos = mysql_query("select * from orderinfo where consumer='$username' and deleted!='cn'");
while($info = mysql_fetch_array($infos))
{
    $time = toPureTime($info['deadline']);
    $state = $info['orderState'] == '1' ? "未打印":"打印完成";
    $orderId = $info['orderId'];
    $business = $info['business'];
    echo "<tr>";
    echo "<td>$business</td>";
    echo "<td>$time</td>";
    echo "<td>$state</td>";
    echo "<td><a href='#' onclick=\"delOrder('$orderId')\"=>删除</a>||<a href='user-document.php?orderId=$orderId'>查看</a></td>";
    echo "<tr>";
}