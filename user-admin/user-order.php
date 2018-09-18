<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '1'){
    header("location:/index.php");
}
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
    <link rel="stylesheet" href="../css/star.css">

    <script src="../js/layui.all.js"></script>
    <script src="../js/jquery-1.8.3.min.js"></script>
    <script src="../js/jquery.fullPage.js"></script>
    <script type="text/javascript">
        var orderInfo = Array();
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
            document.getElementById("user_pic").src="../image/user_img1.png";
        }
        function hiddenCaidan() {
            var caidan = document.getElementById("caidan");
            caidan.style.display = "none";
            document.getElementById("user_pic").src="../image/user_img1.png";
        }
        function judge(orderId) {
            var arr = ["starhalf","star1","star1half","star2","star2half","star3","star3half","star4","star4half","star5"];
            var score;
            var Judge = new XMLHttpRequest();
            for (score = 9 ; document.getElementById(arr[score]).checked == false ; score --);
            score += 1;
            score /= 2.0;
            Judge.open("POST","control/judge.php",false);
            Judge.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            Judge.send("orderId="+orderId+"&score="+score);
            getOrderInfo();
            orderInfo = Array();
            //document.getElementById("bt" + orderId).innerHTML = orderInfo['bt' + orderId];

        }
        function finish(orderId) {
            for(var each in orderInfo)
            {
                document.getElementById(each).innerHTML=orderInfo[each];
            }
            orderInfo = Array();
            orderInfo["bt"+orderId] = document.getElementById("bt" + orderId).innerHTML;
            document.getElementById("bt" + orderId).innerHTML = "<fieldset class='rating' id='judge' onchange=\"judge('"+orderId+"')\">\n" +
                "            <input type='radio' id='star5' name='rating' value='5' />\n" +
                "            <label class='full' for='star5' title='Awesome - 5 stars'></label>\n" +
                "                <input type='radio' id='star4half' name='rating' value='4 and a half' />\n" +
                "                <label class='half' for='star4half' title='Pretty good - 4.5 stars'></label>\n" +
                "                <input type='radio' id='star4' name='rating' value='4' />\n" +
                "                <label class='full' for='star4' title='Pretty good - 4 stars'></label>\n" +
                "                <input type='radio' id='star3half' name='rating' value='3 and a half' />\n" +
                "                <label class='half' for='star3half' title='Meh - 3.5 stars'></label>\n" +
                "                <input type='radio' id='star3' name='rating' value='3' />\n" +
                "                <label class='full' for='star3' title='Meh - 3 stars'></label>\n" +
                "                <input type='radio' id='star2half' name='rating' value='2 and a half' />\n" +
                "                <label class='half' for='star2half' title='Kinda bad - 2.5 stars'></label>\n" +
                "                <input type='radio' id='star2' name='rating' value='2' />\n" +
                "                <label class='full' for='star2' title='Kinda bad - 2 stars'></label>\n" +
                "                <input type='radio' id='star1half' name='rating' value='1 and a half' />\n" +
                "                <label class='half' for='star1half' title='Meh - 1.5 stars'></label>\n" +
                "                <input type='radio' id='star1' name='rating' value='1' />\n" +
                "                <label class='full' for='star1' title='Sucks big time - 1 star'></label>\n" +
                "                <input type='radio' id='starhalf' name='rating' value='half' />\n" +
                "                <label class='half' for='starhalf' title='Sucks big time - 0.5 stars'></label>\n" +
                "            </fieldset>";
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
