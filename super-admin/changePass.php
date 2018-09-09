<?php
session_start();
if(isset($_SESSION['user']) == false || $_SESSION['type'] != '3'){
    header("location:/index.php");
}
$password = mysql_escape_string($_SESSION['pass']);

?>
<!DOCTYPE html>

<html lang="en" class=" js csstransitions"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">




<link href="./css/blankcur.css" rel="stylesheet"><title>CloudPrint密码修改中心</title>
<!--button-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" type="text/css" href="./css/normalize.css">
<link rel="stylesheet" type="text/css" href="./css/button.css">
<link rel="stylesheet" type="text/css" href="./css/button-r.css">
<!--/button-->

<link rel="stylesheet" type="text/css" href="./css/home.css">
</head>
<body style="">
<canvas id="c1" width="1366" height="1164"></canvas>
<canvas id="c2" width="1366" height="1164" style="top: -75.625px;"></canvas>
<div class="container">

<script type="text/javascript">

function check_pwd(){
    console.log(2);
    var code2 =document.getElementById("pass1").value;
    var reg2 = /^\w{6,16}$/;
    if(reg2.test(code2)) {
        return true;
    } else {
        alert("密码错误,必须为6-16位字母或数字或下划线");
        return false;
    }

}
function check() {


    var pass1,pass1c;
    pass1 =document.getElementById("pass1").value;
    pass1c = document.getElementById("pass1c").value;
    if(pass1!=pass1c){
        alert("请重新确认密码！");
        return false;
    }
    return check_pwd();
}
function submit() {
    if(check() != false){
        var pass1 =document.getElementById("pass1").value;
        var passo = document.getElementById("passo").value;
        var submit = new XMLHttpRequest();
        submit.open("post","control/changePwd.php",false);
        submit.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        submit.send("password="+pass1+"&oPassword="+passo);
        if(submit.responseText == 'ok'){
            alert("修改成功");
            window.location.href="/user/logout.php";
        }
        else {
            alert("出现错误，请确认旧密码正确。");
        }
    }

}
</script>

<div id="content">
<div class="page">
<div class="titlee"><div class="back"></div><font class="titleee"><font class="lanzh">更改密码</font></div>
<p class="notice"><b><font class="lanzh">切勿使用常用密码！</font></b></p>
<p class="notice" style="color:red"><font class="lanzh">密码必须为6-12位字母或数字或下划线。</font>
<table border="0" align="center" style="font-size:22px;display:inline-block;margin-top:40px">


<tr height="50">
    <td align="left"><font class="lanzh">旧密码</font></td>
    <td><input class="pass" name="passo" id="passo"></td>
</tr>
<tr height="50">

    <td align="left"><font class="lanzh">新密码</font>
<td><input class="pass" name="pass1" id="pass1"></td></tr>

<tr height="50"><td align="left"><font class="lanzh">确认新密码
<td><input class="pass" name="pass1c" id="pass1c"></td></tr>

<tr height="60"><td colspan="2"><font class="alterpassalert" style="color:red"></font></td></tr>
<tr height="60"><td colspan="2"><font class="alterpassbut" onclick="submit()"><font class="lanzh">修改密码</font><font class="lanen lannone">Submit</font></font></td></tr>
</tbody></table>




</div>
</div>


</div>

<script src="./css/index.js"></script>




<link rel="stylesheet" href="./css/diglossia.css">
<div class="diglossiafix">
<div class="diglossiafixa"><img src="./css/CHN.png" class="choose-zh fixlan"><img src="./css/GBR.png" class="choose-en fixlan"></div>
</div>
</body></html>