<!doctype html>

<html>
<head>
	<meta charset="utf-8">
	<title>注册-光环弹性统计</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./css/register-main.css">

	<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
	<!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
	<!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<div class="container">
		<?php include 'head.php' ?>
		<?php setcookie("command","register") ?>
		<div class="row" id="content-div">
			<div class="col-lg-6 col-md-6 hidden-sm hidden-xs">
				<p id="content-text-1">为了无法统计的价值!</p>
				<p id="content-text-2">弹性部署，云端管理<br>打造最具创造力的统计系统！</p>
			</div>
			<div class="col-lg-5 col-lg-offset-1 col-md-5" id="input-div" align="center">
				<p id="login-title">注册账号</p>
				<form action="./register.php" method="post">
					<div class="input-group input-div">
						<span class="input-group-addon" id="basic-addon1">账号</span>
						<input name="user" type="text" class="form-control" placeholder="请输入账号" aria-describedby="basic-addon1">
					</div>
					<div class="input-group input-div">
						<span class="input-group-addon" id="basic-addon1">密码</span>
						<input name="power" type="password" class="form-control" placeholder="请输入密码" aria-describedby="basic-addon1">
					</div>
					<div class="input-group input-div">
						<span class="input-group-addon" id="basic-addon1">重复</span>
						<input name="rePower" type="password" class="form-control" placeholder="请输再次入密码" aria-describedby="basic-addon1">
					</div>
					<div class="input-group input-div">
						<span class="input-group-addon" id="basic-addon1">邮箱</span>
						<input name="email" type="email" class="form-control" placeholder="请输入电子邮箱地址" aria-describedby="basic-addon1">
					</div>
					<div class="input-group input-div">
						<span class="input-group-addon" id="basic-addon1">QQ</span>
						<input name="QQ" type="number" class="form-control" placeholder="请输入QQ账号" aria-describedby="basic-addon1">
					</div>
					<a id="forget_password">忘记密码？</a>
					<a id="register" href="./login.php">登录</a>
					<button type="submit" class="btn btn-success" id="login-btn">注册</button>
					<?php
					include_once 'api.php';
					echo "<div class=\"alert alert-danger\" role=\"alert\">" .register()."</div>";
					?>
				</form>
			</div>
		</div>
	</div>
</body>
</html>