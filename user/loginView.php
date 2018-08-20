<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/buttons.css">
    <link rel="stylesheet" type="text/css" href="/css/login.css">
    <title>Login</title>
    <script type="text/javascript">
        function check_code() {
            console.log(1);
            //获取账号
            var code =document.getElementById("username").value;
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
    <div class="login">
        <form id="login_box" action="/user/login.php" method="post" onsubmit="return check()">
            <nav>登录</nav>
            <input type="text" name="username" id="username" placeholder="请输入账号">
            <input type="password" name="password" id="password" placeholder="请输入密码">
            <input type="submit" value="立即登陆" id="dl">
            <span>没有账号？马上<a href="/user/registeredView.php" id="zc">注册</a></span>
        </form>
    </div>
</body>

</html>