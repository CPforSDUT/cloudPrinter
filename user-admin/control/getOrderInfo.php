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
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '1'){
    header("location:/index.php");
}
else {
    $username = mysql_escape_string($_SESSION['user']);
    $password = mysql_escape_string($_SESSION['pass']);
}
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password' and type='1'")) == false){
    header("location:/index.php");
    exit();
}
$infos = mysql_query("select * from orderinfo where consumer='$username' and deleted!='cn'");
$info = mysql_fetch_array($infos);
if($info == false){
    echo "<div  style=\"text-align: center;position: absolute;width: 100%;\"><img style=\"max-width: 383px;min-width: 383px; overflow: hidden;margin: 0 auto;\" src='/image/no_file.png'/></div>";
}
else {
    do{
        $time = toPureTime($info['deadline']);
        $state = $info['orderState'] == '1' ? "未打印":($info['orderState'] == '2' ? "打印完成" :"已评价");
        $state = $info['deleted'] == 'bn' ? "被商家删除" : $state;
        $orderId = $info['orderId'];
        $business = $info['business'];
        echo "<tr id='$orderId'>";
        echo "<td>$business</td>";
        echo "<td>$time</td>";
        echo "<td>$state</td><td id='bt$orderId'>";
        if($info['orderState'] != '3')echo "<a class=\"button button-pill button-tiny\"hreaf='#' onclick=\"finish('$orderId')\">完成订单</a>";
        echo "<a class=\"button button-rounded button-tiny\" href='user-document.php?orderId=$orderId'>查看</a><a href='#' style='color=red;' class=\"button button-rounded button-tiny\" onclick=\"delOrder('$orderId')\"=>删除</a>";
       echo "</td>";
        echo "<tr>";

    }while($info = mysql_fetch_array($infos));
}
