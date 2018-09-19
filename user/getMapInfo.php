<?php
function unescape($str) {
    $ret = '';
    $len = strlen ( $str );
    for($i = 0; $i < $len; $i ++) {
        if ($str [$i] == '%' && $str [$i + 1] == 'u') {
            $val = hexdec ( substr ( $str, $i + 2, 4 ) );
            if ($val < 0x7f)
                $ret .= chr ( $val );
            else if ($val < 0x800)
                $ret .= chr ( 0xc0 | ($val >> 6) ) . chr ( 0x80 | ($val & 0x3f) );
            else
                $ret .= chr ( 0xe0 | ($val >> 12) ) . chr ( 0x80 | (($val >> 6) & 0x3f) ) . chr ( 0x80 | ($val & 0x3f) );
            $i += 5;
        } else if ($str [$i] == '%') {
            $ret .= urldecode ( substr ( $str, $i, 3 ) );
            $i += 2;
        } else
            $ret .= $str [$i];
    }
    return $ret;
}
function getCost($username,$orderId)
{
    //获取商家设置的价格
    $types = array("A0","A1","A2","A3","A4","A5","A6","A7","A8","A9","A10","B0","B1","B2","B3","B4","B5","B6","B7","B8","B9","B10");
    $typebs = array(1,2,4,8,16,32,64,128,256,512,1024,2048,4096,8192,16384,32768,65536,131072,262144,524288,1048576,2097152);
    $cost = mysql_query("select * from printerinfo where username='$username'");
    $cost = mysql_fetch_array($cost);

//获取文件价格
    $filecosts = mysql_query("select * from fileinfo where orderId='$orderId'");
    $allCost = 0.0;
    while($filecost = mysql_fetch_array($filecosts))
    {
        $colorBuff = $filecost['color'] == '2' ? $cost['colorBuff'] : 0;
        $type = $filecost['paperType'];
        $paperNum = $filecost['paperNum'];
        for($i = 0 ; $typebs[$i] != $type;$i ++);
        $type = $types[$i];
        if($paperNum < 0){
            continue;
        }
        $allCost += ($cost[$type] + $colorBuff)*$paperNum;
    }
    return $allCost;
}
session_start();
$province = mysql_escape_string($_POST['province']);
$orderId = mysql_escape_string($_POST['orderId']);
if(isset($_SESSION['user']) == false){
    header("location:/index.php");
}
$con = mysql_connect("localhost","root","wslzd9877");
if (!$con)
{
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$needColor = '1';
$needType = 0;
$fileNeed = mysql_query("select * from fileinfo where orderId='$orderId'");
while($fileNeeds = mysql_fetch_array($fileNeed))
{
    if($fileNeeds['color'] == '2'){
        $needColor = '2';
    }
    $needType |= $fileNeeds['paperType'];
}

$result = mysql_query("SELECT * FROM user where province = '$province' and type='2'");
echo "where = Array();";
for($i = 0 ; $row = mysql_fetch_array($result);)
{
    $username = $row['username'];
    $score = $row['score'];
    $province = $row['province'];
    $city = $row['city'];
    $area = $row['area'];
    $other = $row['other'];
    $lo = $row['lo'];
    $la = $row['la'];
    $state = $row['state'];
    $color = '1';
    $paperType = 16;
    $printerInfo = mysql_query("select * from printerinfo where username='$username'");
    $printerInfo = mysql_fetch_array($printerInfo);
    $allCost = getCost($row['username'],$orderId);
    if($printerInfo != false)
    {
        $color = $printerInfo['color'];
        $paperType = $printerInfo['paperType'];
    }
    if($color == '1' && $needColor == '2'){
        continue;
    }
    if(($paperType&$needType)!= $needType ){
        continue;
    }
    echo "where[$i] = Array();";
    echo "where[$i]['cost']=$allCost;";
    echo "where[$i]['score']=$score;";
    echo "where[$i]['username'] = '$username';";
    echo "where[$i]['province'] = '$province';";
    echo "where[$i]['city'] = '$city';";
    echo "where[$i]['area'] = '$area';";
    echo "where[$i]['other'] = '$other';";
    echo "where[$i]['lo'] = $lo;";
    echo "where[$i]['la'] = $la;";
    echo "where[$i]['state'] = '$state';";
    $i += 1;
}
