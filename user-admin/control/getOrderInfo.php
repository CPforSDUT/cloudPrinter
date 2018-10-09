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
$infos = mysql_query("select * from orderinfo where consumer='$username' and deleted!='cn' and orderState!='9' order by deadline");
$info = mysql_fetch_array($infos);
if($info == false){
    echo "<div  style=\"text-align: center;position: absolute;width: 100%;\"><img style=\"max-width: 383px;min-width: 383px; overflow: hidden;margin: 0 auto;\" src='/image/no_file.png'/></div>";
}
else {
    do{
        if($info['orderState'] == '9'){
            continue;
        }
        $time = toPureTime($info['deadline']);
        switch ($info['orderState'])
        {
            case '0':
                $orderState =  '未支付';
                break;
            case '1':
                $orderState =  '未打印';
                break;
            case '2':
                $orderState = '打印完成';
                break;
            case '3':
                $orderState = '已评价';
                break;

        }
        $orderState = $info['deleted'] == 'bn' ? "被商家删除" : $orderState;
        $orderId = $info['orderId'];
        $business = $info['business'];
        echo "<tr id='$orderId'>";
        echo "<td>$business</td>";
        echo "<td>$time</td>";
        echo "<td>$orderState</td><td id='bt$orderId'>";
        echo "<a class=\"button button-pill button-tiny\" href='user-document.php?orderId=$orderId'>查看</a><a href='#' style='color=red;' class=\"button button-pill button-tiny\" onclick=\"delOrder('$orderId')\">删除</a>";
        if($info['orderState'] == '0')echo "<a class=\"button button-circle button-tiny\" style='color: white;background-color: #2196f3;' href='/alipay/pcPay.php?orderId=$orderId'>$</a>";
        if($info['orderState'] == '2')echo "<a class=\"button button-circle button-tiny\" style='color: white;background-color: #9E9E9E;' href='#' onclick=\"finish('$orderId')\">★</a>";
        echo "</td>";
        echo "<tr>";

    }while($info = mysql_fetch_array($infos));
}
