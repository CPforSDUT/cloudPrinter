<?php
/*
 *                             <tr>
                                <td class="tc"><input onclick="checkbox(1)" type="checkbox"></td>
                                <td>未打印</td>
                                <td>17853311111</td>
                                <td>admin</td>
                                <td>2018-08-10 21:11</td>
                                <td>
                                    <a class="link-download" href="document.php?orderId=" >下载</a>
                                    <a class="link-update" onclick="okOrder('orderId')">打印完成</a>
                                    <a class="link-del" onclick="delOrder('orderId')">删除</a>
                                </td>
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
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '3'){
    header("location:/index.php");
}
$username = mysql_escape_string($_SESSION['user']);
$password = mysql_escape_string($_SESSION['pass']);
$pageNum = $_POST['pageNum'] - 1;
if($pageNum < 0)$pageNum = 0;
if(isset($_POST['sorted'])){
    $sorted = mysql_escape_string($_POST['sorted']);
}
else {
    $sorted = false;
}
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(mysql_fetch_array(mysql_query("select * from user where username='$username' and password='$password' and type='3'")) == false){
    header("location:/index.php");
    exit();
}
if(isset($_POST['search']))
{
    $search = mysql_escape_string($_POST['search']);
}


$visit = "where 1=1 and orderState!='9' ";
if(isset($_POST['sorted']))
{
    switch ($_POST['sorted'])
    {
        case '1':
            $visit = $visit."and orderState != '2'";
            break;
    }
}
if(isset($_POST['search']))
{
    $search = mysql_escape_string($_POST['search']);
    $visit = $visit."and (consumer='$search' or business='$search') ";
}

$eNum = "select count(*) from orderinfo " .$visit;
$eNum = mysql_query($eNum);
$eNum = mysql_fetch_array($eNum);
$eNum = $eNum['count(*)'];
echo "<p style='display: none' id='eNum'>$eNum</p>";
$pageNum *= 7;
$result = mysql_query("select * from orderinfo $visit limit $pageNum,7");

for ($i = 0 ;$i < 7 && $row = mysql_fetch_array($result)  ; )
{
    if($row['orderState'] == '9'){
        continue;
    }
    echo "<tr>";
    switch ($row['orderState'])
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
    $orderState = $row['deleted'] == 'cn' ? "被买家删除": ($row['deleted'] == 'bn' ? "被商家删除":$orderState);
    $consumer = $row['consumer'];
    $business = $row['business'];
    $time = toPureTime($row['deadline']);
    $orderId = $row['orderId'];
    echo "<td class=\"tc\"><input onclick=\"checkbox('$orderId',$i)\" id='check$i' type=\"checkbox\"></td>\n";
     echo "<td id='$orderId'>$orderState</td>";
     echo "<td><a href='usermt.php?keyword=$consumer'>$consumer</a></td>";
     echo "<td><a href='shopmt.php?keyword=$business'>$business</a></td>";
     echo "<td>$time</td>";
     echo "<td>";
     echo "<a class=\"link-download\" href=\"document.php?orderId=$orderId\" >下载</a> ";
    echo "<a class=\"link-del\" onclick=\"delOrder('$orderId',$i)\" id='del$i'>删除</a>\n";
     echo "</td>";
    echo "</tr>";
    $i += 1;
}
