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
if(isset($_SESSION['user']) == false){
    header("location:/user/loginView.php");
}
$username = $_SESSION['user'];
$pageNum = $_POST['pageNum'] - 1;
if(isset($_POST['sorted'])){
    $sorted = $_POST['sorted'];
}
else {
    $sorted = false;
}
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
if(isset($_POST['search']))
{
    $search = $_POST['search'];
}
$visit = "select * from orderinfo where business = '$username'";
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
    $search = $_POST['search'];
    $visit = $visit."and consumer='$search'";
}
$result = mysql_query($visit);
for ($i = 0 ; $i < 7 * $pageNum   ; ) {
    $row = mysql_fetch_array($result);
    if($row['deleted'] == 'bn'){
        continue;
    }
    $i += 1;
}
for ($i = 0 ;$i < 7 && $row = mysql_fetch_array($result)  ; )
{
    if($row['deleted'] == 'bn'){
        continue;
    }
    echo "<tr>";
    $orderState = $row['orderState'] == '1' ? '未打印' : '打印完成';
    $consumer = $row['consumer'];
    $phoneGeter = mysql_query("select * from user where username = '$consumer'");
    $phoneGeter = mysql_fetch_array($phoneGeter);
    $cPhone = $phoneGeter['phone'];
    $time = toPureTime($row['deadline']);
    $orderId = $row['orderId'];
     echo "<td class=\"tc\"><input onclick=\"checkbox('$orderId')\" id='check$i' type=\"checkbox\"></td>";
     echo "<td id='$orderId'>$orderState</td>";
     echo "<td>$cPhone</td>";
     echo "<td>$consumer</td>";
     echo "<td>$time</td>";
     echo "<td>";
     echo "<a class=\"link-download\" href=\"document.php?orderId=$orderId\" >下载</a> ";
     echo "<a class=\"link-update\" onclick=\"okOrder('$orderId')\">打印完成</a> ";
     echo "<a class=\"link-del\" onclick=\"delOrder('$orderId')\">删除</a>";
     echo "</td>";
    echo "</tr>";
    $i += 1;
}
