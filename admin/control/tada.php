<?php
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
$time = time();
$one = date("YmdHi",$time + 1800);
$two = date("YmdHi",$time + 1800);$time += 1800;
$thr = date("YmdHi",$time + 3600);
$four = $two = date("YmdHi",$time + 3600);
mysql_query("insert into orderinfo (orderId,consumer,business,deadline,orderState,exCode,deleted) values ('1','wlwwlw','yanshi12','$one','123456','nn')");
mysql_query("insert into orderinfo (orderId,consumer,business,deadline,orderState,exCode,deleted) values ('2','wlwwlw','yanshi12','$two','123457','nn')");
mysql_query("insert into orderinfo (orderId,consumer,business,deadline,orderState,exCode,deleted) values ('3','wlwwlw','yanshi12','$thr','123458','nn')");
mysql_query("insert into orderinfo (orderId,consumer,business,deadline,orderState,exCode,deleted) values ('4','wlwwlw','yanshi12','$four','123459','nn')");
mysql_query("update aisort set sort='0123' where username='yanshi12'");

