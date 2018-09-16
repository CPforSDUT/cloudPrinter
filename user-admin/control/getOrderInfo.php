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
        $state = $info['orderState'] == '1' ? "未打印":"打印完成";
        $state = $info['deleted'] == 'bn' ? "被商家删除" : $state;
        $orderId = $info['orderId'];
        $business = $info['business'];
        echo "<tr>";
        echo "<td>$business</td>";
        echo "<td>$time</td>";
        echo "<td>$state</td>";
        echo "<td><a href='#' onclick=\"delOrder('$orderId')\"=>删除</a>|<a href='user-document.php?orderId=$orderId'>查看</a><a hreaf='#'>完成订单</a>";
        echo "<fieldset class='rating'>";
        echo "<input type='radio' id='star5' name='rating' value='5' />
        <label class='full' for='star5' title='Awesome - 5 stars'></label>
        <input type='radio' id='star4half' name='rating' value='4 and a half' />
        <label class='half' for='star4half' title='Pretty good - 4.5 stars'></label>
        <input type='radio' id='star4' name='rating' value='4' />
        <label class='full' for='star4' title='Pretty good - 4 stars'></label>
        <input type='radio' id='star3half' name='rating' value='3 and a half' />
        <label class='half' for='star3half' title='Meh - 3.5 stars'></label>
        <input type='radio' id='star3' name='rating' value='3' />
        <label class='full' for='star3' title='Meh - 3 stars'></label>
        <input type='radio' id='star2half' name='rating' value='2 and a half' />
        <label class='half' for='star2half' title='Kinda bad - 2.5 stars'></label>
        <input type='radio' id='star2' name='rating' value='2' />
        <label class='full' for='star2' title='Kinda bad - 2 stars'></label>
        <input type='radio' id='star1half' name='rating' value='1 and a half' />
        <label class='half' for='star1half' title='Meh - 1.5 stars'></label>
        <input type='radio' id='star1' name='rating' value='1' />
        <label class='full' for='star1' title='Sucks big time - 1 star'></label>
        <input type='radio' id='starhalf' name='rating' value='half' />
        <label class='half' for='starhalf' title='Sucks big time - 0.5 stars'></label>";
        echo "</fieldset>";
        echo "</td>";
        echo "<tr>";
    }while($info = mysql_fetch_array($infos));
}
