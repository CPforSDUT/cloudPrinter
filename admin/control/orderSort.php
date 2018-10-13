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
function testp($arr,$method)
{
    if($method == 'e')
    {
        echo $arr;
        return ;
    }
    foreach($arr as $each)
    {
        echo $each." ";
    }
}
function getOrderInfo($username,$Now){
    $ex = mysql_query("select * from aisort where username='$username'");
    $ex = mysql_fetch_array($ex);
    $ex = $ex['doOrder'];
    if($ex == 'null') {
        $sql = mysql_query("select * from orderinfo where business='$username' and deleted='nn' and deadline>'$Now'  and (orderState='1' or orderState='9' or orderState='0') order by orderId");
    }
    else {
        $sql = mysql_query("select * from orderinfo where business='$username' and deleted='nn' and deadline>'$Now' and orderId!='$ex'  and (orderState='1' or orderState='9' or orderState='0') order by orderId");
    }
    $arr = array();
    while($each = mysql_fetch_array($sql)) {
        array_push($arr,$each);
    }
    return $arr;
}
function getOrderNum($username,$Now)
{
    $ex = mysql_query("select * from aisort where username='$username'");
    $ex = mysql_fetch_array($ex);
    $ex = $ex['doOrder'];
    if($ex == 'null') {
        $count = mysql_query("select count(*) from orderinfo where business='$username' and deleted='nn' and deadline>'$Now' and (orderState='1' or orderState='9' or orderState='0') order by orderId");
    }
    else {
        $count = mysql_query("select count(*) from orderinfo where business='$username' and deleted='nn' and deadline>'$Now' and orderId!='$ex'  and (orderState='1' or orderState='9' or orderState='0') order by orderId");
    }
    $count = mysql_fetch_array($count);
    return $count['count(*)'];
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
function getSpeed($username)
{
    $speed = mysql_query("select * from aisort where username='$username'");
    $speed = mysql_fetch_array($speed);
    return $speed['speed'];
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

/*function otherJudge($lifes,$dTimes,$timeS)
{
    $score = 0;
    for($i = 1 ; $i < count($lifes) ; $i ++)
    {
        if($dTimes[$lifes[$i]] >= $dTimes[$lifes[$i - 1]]){
            $score += 5;
        }
        else {
			$score -= 5;
        }
    }
	if($score < 0){
		return 0;
	}
	else {
		return $score;
	}
}*/
function judge($lifes,$username,$data,$fakeNow)
{
    $Now = time();
    $dTimes = getOrderDTime($data);
    $speed = getSpeed($username);
    $nTimes = getOrderNTime($speed,$data);
    $timeS = array();
    for($i = 0 ; $i < count($lifes);$i ++)
    {
        $start = $Now;
        $end = $start + $nTimes[$lifes[$i]];
        $timeS[$lifes[$i]] = $end;
        $Now = $end;
    }
    $score = 0;
    for($i = 0 ; $i < count($lifes) ; $i ++)
    {
        if($dTimes[$lifes[$i]] > $timeS[$lifes[$i]] || $dTimes[$lifes[$i]] < time()){
            $score += 1;
        }
    }
    /*if(count($lifes) == $score) {
        return $score + otherJudge($lifes,$dTimes,$timeS);
    }else {*/
        return $score;
    /*}*/
}

function randLifes($username,$Now)
{
    $count = getOrderNum($username,$Now);
    $lifes = array();
    for($i = 0 ; $i < $count ; $i ++)
    {
        $which = rand(0,$count - 1);
        while(isset($visit[$which]) == true){
            $which = ($which + 1)%$count;
        }
        $visit[$which] = true;
        array_push($lifes,$which);
    }
    return $lifes;
}
function natSelect($username,$dnas,$data,$Now)
{
    $all = 0;
    $lifePower = array();
    $field = array();
    for ($i = 0 ; $i < count($dnas) ; $i++)
    {
        $thisLife = judge($dnas[$i],$username,$data,$Now);
        array_push($lifePower,$thisLife);
        $all += $thisLife;
    }

    $zeroZone = array();
    for ($i = 0 ; $i < count($lifePower) ; $i++)
    {
        $thisPower = ($all == 0) ? 0 : ($lifePower[$i]*1.0)/$all;
        $lifePower[$i] = $thisPower;
        if($thisPower == 0){
            array_push($zeroZone,$i);
        }

        for($j = 0 ; $j < $thisPower * 10000 ; $j ++){
            array_push($field,$i);
        }
    }
    if(count($zeroZone) > 0){
        while(count($field) < 10000) {
            array_push($field,$zeroZone[rand(0,count($zeroZone) - 1)]);
        }
    }
    $newLifes = array();
    for($i = 0 ; $i < count($dnas) ; $i ++)
    {
        $which = rand(0,count($field) - 1);
        array_push($newLifes,$dnas[$field[$which]]);
    }
    return $newLifes;
}
function vari($dna)
{
    $p1 = rand(0,count($dna) - 1);
    $p2 = rand(0,count($dna) - 1);
    $temp = $dna[$p1];
    $dna[$p1] = $dna[$p2];
    $dna[$p2] = $temp;
    return $dna;
}
function hybrids(&$dnas,$varpos)
{
    for($i = 0 ; $i < count($dnas) ; $i ++)
    {
        $point = rand(0,count($dnas[$i]) - 1);
        $new = array_merge(array_slice($dnas[$i],$point) , array_slice($dnas[$i],0,$point));
        if($varpos*1000 > rand(0,1000)){
            $new = vari($new);
        }
        $dnas[$i] = $new;
    }
    return ;
}
function findBatter($lifes,$username,$Now,$old,$data)
{
    $orderNum = getOrderNum($username,$Now);
    $thiss = judge($lifes,$username,$data,strtotime(toPureTime($Now)));
    if($thiss >= $orderNum && $thiss > $old){
        return $thiss;
    }
    else {
        return $old;
    }
}

session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '1'){
    header("location:/index.php");
}
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$username = mysql_escape_string($_GET['business']);
if(getOrderNum($username,$Now) <= 0){
    echo "ok";
    exit();
}
$exx = mysql_query("select * from aisort where username='$username'");
$exx = mysql_fetch_array($exx);
$ex = $exx['doOrder'];
$Now = $exx['time'];
if($Now == 'null')
{
    $Now = time();
    $Now = date("YmdHi",$Now);
}
$allOrder = getOrderInfo($username,$Now);
$best = 0;
$bestLife = 0;
$times = 0;
$dnas = array();
for($i = 0 ; $i < 50 ; $i ++) {
    array_push($dnas,randLifes($username,$Now));
}

do{
    $dnas = natSelect($username,$dnas,$allOrder,$Now);
    hybrids($dnas,0.1);
    foreach ($dnas as $each)
    {
        $thiss = findBatter($each,$username,$Now,$best,$allOrder);
        if($best < $thiss){
            $best = $thiss;
            $bestLife = $each;
        }
    }
    $time += 1;
}while(($time < 50 || $best == 0) && $time<100);
if($best != 0)
{

    if($ex == 'null'){
        for($i = 1 ; $i < count($bestLife) ; $i ++)
        {
            if($bestLife[$i] > $bestLife[0]){
                $bestLife[$i] -= 1;
            }
        }
        $sort = implode("|",array_slice($bestLife,1));
        $doOrder = $allOrder[$bestLife[0]]['orderId'];
        $arr = sprintf("update aisort set sort='%s',doOrder='%s',time='$Now' where username='$username'",$sort,$doOrder);
    }
    else {
        $sort = implode("|",$bestLife);
        $arr = "update aisort set sort='$sort',time='$Now' where username='$username'";
    }
    mysql_query($arr);
    echo 'ok';
}
else {
    echo "failure";
}