<?php
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
function getSpeed($username)
{
    $speed = mysql_query("select * from aisort where username='$username'");
    $speed = mysql_fetch_array($speed);
    return $speed['speed'];
}
function getOrderInfo($username,$Now){
    $ex = mysql_query("select * from aisort where username='$username'");
    $ex = mysql_fetch_array($ex);
    $ex = $ex['doOrder'];
    $sql = mysql_query("select * from orderinfo where business='$username' and deleted='nn' and deadline>'$Now' and orderId!='$ex'  and (orderState='1' or orderState='9' or orderState='0') order by orderId");
    $arr = array();
    while($each = mysql_fetch_array($sql)) {
        array_push($arr,$each);
    }
    return $arr;
}
function getOrderDTime($data)
{

    $dTimes = array();
    for( $i = 0 ; $i < count($data) ; $i ++)
    {
        $each = $data[$i];
        array_push($dTimes,strtotime(toPureTime($each['deadline'])));
    }
    return $dTimes;
}
function getOrderNTime($speed,$allOrder)
{

    $aTimes = array();
    for($i = 0 ; $i < count($allOrder) ;$i ++)
    {
        $each = $allOrder[$i];
        $eOrderId = $each['orderId'];
        $eTime = 0;
        $files = mysql_query("select * from fileinfo where orderId='$eOrderId'");
        while($eFile = mysql_fetch_array($files))
        {
            $eFileNum = $eFile['num']*$eFile['paperNum'];
            $eTime += $eFileNum*$speed;
        }
        array_push($aTimes,$eTime);
    }
    return $aTimes;
}
function getOrderSort($username)
{
    $sort = mysql_query("select * from aisort where username='$username'");
    $sort = mysql_fetch_array($sort);
    $sort = $sort['sort'];
    $sort = explode("|",$sort);
    return $sort;
}

function firstOrder($username,$speed)
{

    $doOrder = mysql_query("select * from aisort where username='$username'");
    $doOrder = mysql_fetch_array($doOrder);
    $doOrder = $doOrder['doOrder'];
    if($doOrder == 'null'){
        return array('null');
    }
    $doOrder = mysql_query("select * from orderinfo where orderId='$doOrder'");
    $doOrder = mysql_fetch_array($doOrder);
    $tOrder = array();
    $tOrder['exCode'] = $doOrder['exCode'];
    $tOrder['consumer'] = $doOrder['consumer'];
    $tOrder['deadline'] = $doOrder['deadline'];
    $tOrder['deadTime'] = strtotime(toPureTime($doOrder['deadline']));
    $nTimes = getOrderNTime($speed,array($doOrder));
    $tOrder['needTime'] = $nTimes[0];
    $tOrder['orderId'] = $doOrder['orderId'];
    $tOrder['orderState'] = $doOrder['orderState'];
    return $tOrder;
}
function latestFTime(&$sorted,$Now)
{
    $earTime = array();
    $timePoint = $Now;
    for($i = 0 ; $i < count($sorted) ; $i ++)
    {
        $timePoint += $sorted[$i]['needTime'];
        array_push($earTime,$timePoint);
    }

    for ($i = 0 ; $i < count($sorted) ; $i ++) {

        $shortDis = $sorted[$i]['deadTime'] - $earTime[$i];
        for($j = $i + 1 ; $j < count($sorted) ; $j ++)
        {
			if($sorted[$j]['deadTime'] < time()){
				continue;
			}
            if($sorted[$j]['deadTime'] - $earTime[$j] < $shortDis){
                $shortDis = $sorted[$j]['deadTime'] - $earTime[$j];
            }
        }
        $sorted[$i]['latestF'] = date("Y-m-d H:i",$earTime[$i] + $shortDis);
    }
}
function sortBySort($sort,$allOrder,$dTimes,$nTimes,$username,$speed,$Now)
{

    $sorted = array();
    $fist = firstOrder($username,$speed);
    if($fist[0] == 'null'){
        return $sorted;
    }
    array_push($sorted,$fist);
    if(count($sort) == 1 && $sort[0] == ""){
        latestFTime($sorted,$Now);
        return $sorted;
    }
    for($i = 0 ; $i < count($sort) ; $i ++)
    {
        $tSort = $sort[$i];
        $tOrder = array();
        $tOrder['exCode'] = $allOrder[$tSort]['exCode'];
        $tOrder['consumer'] = $allOrder[$tSort]['consumer'];
        $tOrder['deadline'] = $allOrder[$tSort]['deadline'];
        $tOrder['orderId'] = $allOrder[$tSort]['orderId'];
        $tOrder['orderState'] = $allOrder[$tSort]['orderState'];
        $tOrder['deadTime'] = $dTimes[$tSort];
        $tOrder['needTime'] = $nTimes[$tSort];
        array_push($sorted,$tOrder);
    }
    latestFTime($sorted,$Now);
    return $sorted;
}
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '2'){
    header("location:/index.php");
}
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$username = mysql_escape_string($_SESSION['user']);
$password = mysql_escape_string($_SESSION['pass']);
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password' and type='2'")) == false){
    header("location:/index.php");
    exit();
}
$exit = mysql_query("select * from aisort where username='$username'");
if(mysql_fetch_array($exit)['doOrder'] == 'null'){
    exit();
}
$Now = mysql_query("select * from aisort where username='$username'");
$Now = mysql_fetch_array($Now);
$Now = $Now['time'];
$orderInfo = getOrderInfo($username,$Now);
$sort = getOrderSort($username);
$nTime = getOrderNTime(getSpeed($username),$orderInfo);
$dTime = getOrderDTime($orderInfo);
$speed = getSpeed($username);
$sorted = sortBySort($sort,$orderInfo,$dTime,$nTime,$username,$speed,strtotime(toPureTime($Now)));

for($i = 0 ; $i < count($sorted); $i ++)
{
    $tOrder = $sorted[$i];
    $tOrderId = $tOrder['orderId'];
    $tOrderState = $tOrder['orderState'];
    echo "<tr>";
    echo "<td>".($i+1)."</td>";
    echo "<td>".$tOrder['consumer']."</td>";
    echo "<td>".$tOrder['exCode']."</td>";
    echo "<td>".$tOrder['needTime']."秒</td>";
    if(time() > strtotime($tOrder['latestF'])){
        echo "<td style='color:red;'>".$tOrder['latestF']." (已延误)</td>";
    }
    else{
        echo "<td>".$tOrder['latestF']."</td>";
    }
    echo "<td>".toPureTime($tOrder['deadline'])."</td>";
    echo "<td><a class=\"link-download\" href=\"document.php?orderId=$tOrderId\" >下载</a> \n";
    if($tOrderState == '1')echo "<a class=\"link-update\" href=\"#\" onclick=\"okOrder('$tOrderId')\">打印完成</a>\n";
    echo "<a class=\"link-del\" href=\"#\" onclick=\"delOrder('$tOrderId')\">删除</a></td>";
    echo "</tr>";
}



