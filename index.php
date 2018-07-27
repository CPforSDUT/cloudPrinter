<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <head>
        <title>云打印|cloudPrinter</title>
        <style type="text/css">
            #top
            {
                font-family: "Microsoft YaHei UI";
                color: white;
                text-align: center;
            }
            body {
                background-color: cadetblue;
                align-self: center;
                align-content: center;
                align-items: center;
                text-align: center;
                background-image: url("/image/back.jpeg");
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: cover;
            }
            #logincube{
                text-align: center; /*让div内部文字居中*/
                background-color: #fff;
                border-radius: 20px;
                width: 300px;
                height: 350px;
                margin: auto;
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
            }
        </style>
        <?php
        session_start();
        if(isset($_SESSION['user'])){
            $_POST['user'] = $_SESSION['user'];
            $_POST['pass'] = $_SESSION['pass'];
            echo "<script>location.href='/user/login.php';</script>";
        }
        ?>
    </head>
    <body>
        <h1 id="top" >.cloudPrinter</h1>

            <div id="logincube">
                <br /><br /><br /><br />
                <iframe frameborder="no"  style="height: 100%;margin:0 auto;" src="/user/loginView.php" >登陆</iframe>

            </div>
    </body>
</html>