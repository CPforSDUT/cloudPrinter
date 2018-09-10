<?php
$con = mysql_connect("localhost", "root", "wslzd9877");
if (!$con) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("user", $con);
for ($i = 156;$i < 202 ; $i ++)
{
    mysql_query("INSERT INTO orderinfo (orderId, consumer,business,deadline,exCode)VALUES (\"$i\", \"lxs0401\",\"lovers\",\"201810101010\",\"$i\")");
}
