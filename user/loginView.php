<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
    <base target="_blank">
    <link rel="stylesheet" type="text/css" href="/css/Buttons.css">
    <script type="text/javascript">
        function check_code() {
            console.log(1);
            //获取账号
            var code =
                document.getElementById("username").value;
            var reg = /^\w{6,12}$/;
            if(reg.test(code)) {
                return true;
            } else {
                alert("用户名错误,必须为6-12位字母或数字或下划线");
                return false;
            }
        }
        function check_pwd(){
            console.log(2);
            var code2 =document.getElementById("password").value;
            var reg2 = /^\w{6,16}$/;
            if(reg2.test(code2)) {
                return true;
            } else {
                alert("密码错误,必须为6-16位字母或数字或下划线");
                return false;
            }

        }
        function check() {
            return check_code() && check_pwd();
        }
    </script>
</head>
<body>
<div style="text-align: center">
    <form action="/user/login.php" method="POST"onsubmit="return check()" target="_parent">
        <p>
            用户 <input type="text" name="username" id="username" class="button button-rounded button-tiny"/>
        </p>
        <br />
        <p>
            密码 <input type="password" name="password" id="password" class="button button-rounded button-tiny"/>
            <br /><br /><br />
            <input type="submit" value="登陆" class="button button-primary button-rounded button-small">
            <a href="/user/registeredView.php"><button type="button" class="button button-primary button-rounded button-small">注册</button></a>

    </form>

</div>
</body>
</html>