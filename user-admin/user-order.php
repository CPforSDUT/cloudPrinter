<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] == '2'){
    header("location:/index.php");
}
$username = mysql_escape_string($_SESSION['user']);
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
    <title>cloud Print</title>

    <link rel="stylesheet" href="../css/layui.css">
    <link rel="stylesheet" href="../css/buttons.css">
    <link rel="stylesheet" type="text/css" href="../css/master.css">

    <script src="../js/layui.all.js"></script>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/jquery.fullPage.js"></script>
    <script type="text/javascript">
        function getOrderInfo() {
            var orderInfo = new XMLHttpRequest();
            orderInfo.open('POST',"control/getOrderInfo.php",false);
            orderInfo.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            orderInfo.send();
            document.getElementById('orderMain').innerHTML = orderInfo.responseText;
        }
        function delOrder(orderId) {
            var delOrder = new XMLHttpRequest();
            delOrder.open("POST","control/delFile.php",false);
            delOrder.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            delOrder.send("orderId="+orderId);
            getOrderInfo();
        }
        function showCaidan() {
            var caidan = document.getElementById("caidan");
            caidan.style.display = "block";
            document.getElementById("user_pic").src="../image/user_img.png";
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
                <img src="../image/user_img1.png" alt="用户" id="user_pic" onclick="showCaidan()">
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
            <script type="text/javascript">
                var userPic = document.getElementById("user_pic");
                var daohang = document.getElementById("daohang");
                userPic.addEventListener("click", function () {
                    showCaidan();
                });
                daohang.addEventListener("mouseleave", function () {
                    hiddenCaidan();
                });
            </script>
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
                    <th>商家</th>
                    <th>取件时间</th>
                    <th>状态</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="orderMain">
                </tbody>
            </table>
        </div>
    </div>
</body>
<script>
    getOrderInfo();
</script>
</html>
