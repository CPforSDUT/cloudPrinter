<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="viewport" content="width=device-width"/>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="robots" content="noindex,nofollow" />
	<title>云打印安装文件</title>
	
</head>
<body class="bgrd">
<center>
<p id="logo"><img src="http://dayin.sdut1.com/image/logo1.png"></p>
<br>校园云打印 BOS团队
</center>
<div class="main">
<form method="post" action="setup-config.php?step=2">
<center><h1 class="screen-reader-text">设置您的数据库连接</h1>
	
	<table class="form-table">
		<tr>
			<th scope="row"><label for="dbname">数据库名</label></th>
			<td><input name="dbname" id="dbname" type="text" size="25" value="database" /></td>
			<td>安装在哪一个数据库？</td>
		</tr>
		<tr>
			<th scope="row"><label for="uname">用户名</label></th>
			<td><input name="uname" id="uname" type="text" size="25" value="用户名" /></td>
			<td>您的数据库用户名。</td>
		</tr>
		<tr>
			<th scope="row"><label for="pwd">密码</label></th>
			<td><input name="pwd" id="pwd" type="text" size="25" value="密码" autocomplete="off" /></td>
			<td>您的数据库密码。</td>
		</tr>
		<tr>
			<th scope="row"><label for="dbhost">数据库主机</label></th>
			<td><input name="dbhost" id="dbhost" type="text" size="25" value="localhost" /></td>
			<td>默认为<code>localhost</code>，其他改为自定义的。</td>
		</tr>
		<tr>
			<th scope="row"><label for="prefix">表前缀</label></th>
			<td><input name="prefix" id="prefix" type="text" value="sdut1_" size="25" /></td>
			<td>请输入表前缀</td>
		</tr>
	</table>
		<input type="hidden" name="language" value="zh_CN" />
	<p class="step"><input name="submit" type="submit" value="提交" class="button button-large" /></p>
	</center>
</form>
</div>
<script type='text/javascript' src='http://htmlblog.sdut1.com/wp-includes/js/jquery/jquery.js?ver=1.12.4'></script>
<script type='text/javascript' src='http://htmlblog.sdut1.com/wp-includes/js/jquery/jquery-migrate.min.js?ver=1.4.1'></script>
<script type='text/javascript' src='http://htmlblog.sdut1.com/wp-admin/js/language-chooser.min.js?ver=4.8'></script>
</body>
</html>