<?php
session_start();
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
function getOrderSort($username)
{
    $sort = mysql_query("select * from aisort where username='$username'");
    $sort = mysql_fetch_array($sort);
    $sort = $sort['sort'];
    if($sort == ''){
        return array();
    }
    $sort = explode("|",$sort);
    return $sort;
}
function sortDelete($username,$orderId)
{
    $exx = mysql_query("select * from aisort where username='$username'");
    $exx = mysql_fetch_array($exx);
    $ex = $exx['doOrder'];
    $Now = $exx['time'];
    $sort = getOrderSort($username);
    $allOrder = getOrderInfo($username,$Now);
    if($orderId == $ex)
    {
        if(count($sort) <= 0){
            $sql = "update aisort set sort='',doOrder='null',time='null' where username='$username'";
        }
        else {
            $newDoOrder = $allOrder[$sort[0]]['orderId'];
            $sort0 = $sort[0];
            $sort = array_slice($sort,1);
            for ($i = 0 ; $i < count($sort) ; $i ++){
                if($sort[$i] > $sort0){
                    $sort[$i] -= 1;
                }
            }
            $sort = implode("|",$sort);
            $sql = "update aisort set sort='$sort',doOrder='$newDoOrder' where username='$username'";
        }
        mysql_query($sql);
    }
    else {
        for($i = 0 ; $i < count($allOrder) && $allOrder[$i]['orderId']!=$orderId ; $i ++);
        $dSort = $i;
        if($dSort < count($allOrder))
        {
            for($i = 0 ; $i < count($sort) && $dSort != $sort[$i] ; $i ++);
            $newSort = array_slice($sort,0,$i) + array_slice($sort,$i + 1);

            for($j = 0 ; $j < count($newSort) ; $j ++){
                if($newSort[$j] > $dSort){
                    $newSort[$j] -= 1;
                }
            }
            $newSort = implode("|",$newSort);
            $sql = "update aisort set sort='$newSort' where username='$username'";
            mysql_query($sql);
        }
    }
}
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '1'){
    header("location:/index.php");
}
$username = mysql_escape_string($_SESSION['user']);
$password = mysql_escape_string($_SESSION['pass']);
$orderId = mysql_escape_string($_POST['orderId']);
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password' and type='1'")) == false){
    header("location:/index.php");
    exit();
}
$result = mysql_query("select * from orderinfo where orderId = '$orderId'");
$row = mysql_fetch_array($result);
if(strnatcasecmp($username,$row['consumer']) == 0){

    sortDelete($row['business'],$orderId);
    if($row['deleted'] == 'bn'){
        mysql_query("delete from orderinfo where orderId='$orderId'");
        $tIme =  time();
        mysql_query("INSERT INTO delfiles (orderId, time)VALUES (\"$orderId\", \"$tIme\")");
    }
    else {
        mysql_query("UPDATE orderinfo SET deleted='cn' WHERE orderId='$orderId'");
    }

}



