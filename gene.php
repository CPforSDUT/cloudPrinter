<?php
function getBin($num)
{
    $long = 0;
    while($long < 8)
    {
        $ans[$long] = $num%2;
        $num /= 2;
        $long += 1;
    }

    for ($i = 0 ; $i < 8 ; $i ++)
    {
        $long -= 1;
        $ta[$long] = $ans[$i];
    }
    return $ta;
}
function getNum($arr,$len)
{
    $ans = 0;
    for($i = 0 ; $i < $len ; $i ++)
    {
        $ans <<= 1;
        $ans += $arr[$i];

    }
    return $ans;
}
function getLifePower($data,$len)
{
    $all = 0;
    for( $i = 0 ; $i < $len ; $i ++) {
        $all += $data[$i];
    }
    $thist = 0;
    for($i = 0 ; $i < $len ; $i ++)
    {
        $each = $data[$i];
        if($each == 0){
            $ans[$thist] = 0;
        }
        else {
            $ans[$thist] = $each/$all;
        }
        $thist += 1;
    }
    return $ans;
}
function natSelection($percents,$data,$much)//自然选择
{
    $thisi = 0;
    for ($j = 0 ; $j < $much ; $j ++){
        $each = $percents[$j];
        for ($i = 0 ; $i < $each*1000 ; $i ++){
            $res[$thisi] = $data[$j];
            $thisi += 1;
        }
    }
    for($i = 0 ; $i < $much ; $i ++)
    {
        $randex = rand(0,999);
        $ans[$i] = $res[$randex];
    }
    return $ans;
}

function hy($mask01 , $mask10,$a,$b)
{
    $a01 = $mask01 & $a;
    $a10 = $mask10 & $a;
    $b01 = $mask01 & $b;
    $b10 = $mask10 & $b;
    $na = $a01 + $b10;
    $nb = $a10 + $b01;
    $ans[0] = $na;
    $ans[1] = $nb;
    return $ans;
}
function hybrid($arr,$binLen) //两个杂交
{
    $a = $arr[0];
    $b = $arr[1];
    if($binLen < 2){
        return $arr;
    }
    else if($binLen == 2){
        $mask01 = 1;
        $mask10 = 2;
        return hy($mask01,$mask10,$a,$b);
    }
    $maskmove = rand(1,$binLen - 1);
    $mask01 = 0;
    for($i = 0 ; $i < $maskmove ; $i ++)
    {
        $mask01 <<= 1;
        $mask01 += 1;
    }
    $mask10 = ~$mask01;
    return hy($mask01,$mask10,$a,$b);
}
function getRandSort($len,$field,&$visit)
{
    for($i = 0 ; $i < $len ; $i ++)
    {
        $rand = rand(0,$field - 1);
        for(;isset($visit[$rand]) == true;$rand = ($rand + 1)%$field);
        $visit[$rand] = true;
        $rand1[$i] = $rand;
    }
    return $rand1;
}
function hybrids($arr,$len,$binLen)
{
    $rand1 = getRandSort($len/2,$len,$visit);
    $rand2 = getRandSort($len/2,$len,$visit);
    $index = 0;
    for($i = 0 ; $i < $len/2 ; $i ++)
    {
        $hya[0] = $arr[$rand1[$i]];
        $hya[1] = $arr[$rand2[$i]];
        $hya = hybrid($hya,$binLen);
        $ans[$index] = $hya[0];
        $ans[$index + 1] = $hya[1];
        $index += 2;
    }
    return $ans;
}
function varia($arr,$binLen,$percents)
{
    $index = 0;
    foreach($arr as $each)
    {
        $rand = rand(0,1000);
        if($rand < $percents*1000)
        {
            $which = rand(0,$binLen - 1);
            $numString = getBin($each);
            $numString[$which] = $numString[$which] == 0 ? 1 : 0;
            $ans[$index] = getNum($numString,8);
        }
        else {
            $ans[$index] = $each;
        }
        $index += 1;
    }
    return $ans;
}
function test($much,$life)
{
        for($i = 0 ; $i < $much ; $i ++)
        {
            $test = $life[$i];
            $test /= 51;
            $test = cos($test) + 1;
            $percents[$i] = $test;
        }
        return $percents;
}
function saop($arr)
{
    $len = count($arr);
    for($i = 0 ; $i < $len ; $i ++)
    {
        echo $arr[$i]." ";
    }
    echo "\n\n\n";
}
function start($much,$time)
{
    $best = -1;
    for($i = 0 ; $i < $much ; $i ++) {
        $life[$i] = rand(0,255);
    }
    //saop($life);//1
    for($i = 0 ; $i <$time ; $i ++)
    {
        $percents = test($much,$life);
        //saop($percents);//2
        $percents = getLifePower($percents,$much);
        //saop($percents);//3
        $life = natSelection($percents,$life,$much);
        //saop($life);//4
        $life = hybrids($life,$much,8);
        //saop($life);//5
        $life = varia($life,$much,0.1);
        //saop($life);//6
        foreach($life as $each)
        {
            if($best == -1 || sin($best) < sin($each/51))
            {
                $best = $each/51;
            }
        }
    }
    return $best;
}
$ans = start(100,90);
echo sin($ans)." ".$ans;
