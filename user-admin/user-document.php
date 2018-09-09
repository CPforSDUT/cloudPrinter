<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '1'){
    header("location:/index.php");
}
$orderId = mysql_escape_string($_GET['orderId']);
$username = mysql_escape_string($_SESSION['user']);
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<head>
    <title>cloud Print</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/layui.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <script src="../js/layui.all.js"></script>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/jquery.fullPage.js"></script>
    <script type="text/javascript">
        function getFiles() {
            var geter = new XMLHttpRequest();
            var visit;
            var orderId = <?php echo "'$orderId'";?>;
            geter.open("POST","control/getFiles.php",false);
            geter.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            visit =  "orderId=" + orderId;
            geter.send(visit);
            document.getElementById("fileMain").innerHTML = geter.responseText;
        }
        function showCaidan() {
            var caidan = document.getElementById("caidan");
            caidan.style.display = "block";
            document.getElementById("user_pic").src="../image/user_img1.png";
        }
        function hiddenCaidan() {
            var caidan = document.getElementById("caidan");
            caidan.style.display = "none";
            document.getElementById("user_pic").src="../image/user_img1.png";
        }
    </script>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="daohang" id="daohang" onmouseleave="hiddenCaidan()">
                <a href="/index.php"><img src="../image/logo1.png" alt="logo" id="logo"></a>
                <span id="uname"><?php echo "$username";?></span>
                <img src="../image/user_img1.png" alt="用户" id="user_pic" onclick="showCaidan()"  onmouseover="document.getElementById('user_pic').src='../image/user_img.png'">
                <div class="caidan" id="caidan">
                    <ul>
                        <li>
                            <a href="/newOrder.php">新订单</a>
                        </li>
                        <li>
                            <a href="/user-admin/user-information.php">个人信息</a>
                        </li>
                        <li>
                            <a href="/user-admin/user-order.php">订单处理</a>
                        </li>
                        <li>
                            <a href="/user-admin/user-information.php">修改密码</a>
                        </li>
                        <!--               <li>
                                           <a href="#">其他功能</a>
                                       </li>-->
                        <li>
                            <a href="/user/logout.php">退出账户</a>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
        <div class="main" style="background: #f9f9f9">
            <table class="layui-table">
                <colgroup>
                    <col width="150">
                    <col width="200">
                    <col>
                </colgroup>
                <thead>
                <tr>
                    <th>文件名</th>
                    <th>颜色</th>
                    <th>打印数量</th>
                    <th>纸张大小</th>
                    <th>纸张方向</th>
                    <th>备注</th>
                </tr>
                </thead>
                <tbody id="fileMain">
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    getFiles();
</script>
</html>
