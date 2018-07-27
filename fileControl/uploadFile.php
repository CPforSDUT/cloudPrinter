<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
if (isset($_POST["username"]))
{
    echo "<script type='text/javascript'>alert(\"请重新登陆。\");</script>";
    echo "<script>window.location.href='/index.php';</script> ";
}
    if ($_FILES["file"]["error"] > 0)
    {
        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
    }
    else {
        $hashname = hash_file('sha256', $_FILES["file"]["tmp_name"], false);
        if (file_exists("upload/" . "$hashname." . substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1)) == false) {
            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . "$hashname." . substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1));
        }
        $username = $_POST["username"];
        $printname = $_POST["printname"];

        $con = mysql_connect("localhost", "root", "wslzd9877");
        if (!$con) {
            die('Could not connect: ' . mysql_error());
        }
        mysql_select_db("user", $con);
        $result = mysql_query("SELECT * FROM users WHERE username= \"$printname\" and type = \"2\"");
        $row = mysql_fetch_array($result);
        if ($row == null) {
            echo "<script type='text/javascript'>alert(\"不存在该店家\");</script>";
            echo "<script>window.location.href='/index.php';</script> ";
        }
        else{
            echo unescape("商家详细地址:".$row["province"]." ".$row["City"]." ".$row["Area"]." ".$row["Other"]);
        }
        mysql_query("INSERT INTO file (username, printname, filename)VALUES (\"$username\", \"$printname\",\"upload/" . "$hashname." . substr($_FILES["file"]["name"], strrpos($_FILES["file"]["name"], '.') + 1) . "\")");
        mysql_close($con);
        echo "<br />状态:发送成功";
    }

?>