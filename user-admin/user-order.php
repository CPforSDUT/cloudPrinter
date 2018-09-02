<?php
session_start();
if(isset($_SESSION['user']) == false){
    header("location:/index.php");
}
$username = $_SESSION['user'];
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
    <title>cloud Print</title>
    <link rel="stylesheet" type="text/css" href="../css/master.css">
    <link rel="stylesheet" href="../css/layui.css">
    <link rel="stylesheet" href="../css/buttons.css">
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
    </script>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="daohang">
                <img src="../image/logo1.png" alt="logo" id="logo">
                <span><?php echo "$username";?></span>
                <img src="../image/user_img1.png" alt="用户" id="user_pic">
            </div>

            <div class="caidan">
                <ul>
                    <li>
                        <a href="#">个人信息</a>
                    </li>
                    <li>
                        <a href="#">订单处理</a>
                    </li>
                    <li>
                        <a href="#">修改密码</a>
                    </li>
                    <li>
                        <a href="#">其他功能</a>
                    </li>
                    <li>
                        <a href="#">退出账户</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main">
            <span>请填写您的订单</span>
            <div class="m1">
                <div class="m2">
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
        </div>
    </div>
</body>
<script>
    getOrderInfo();
</script>
</html>
