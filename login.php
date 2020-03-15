<!doctype html>

<html>
<head>
	<meta charset="utf-8">
	<title>登录-光环弹性统计</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./css/login-main.css">

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
		<?php include 'head.php'; ?>
		<?php setcookie("command","login") ?>
		<div class="row" id="content-div">
			<div class="col-lg-6 col-md-6 hidden-sm hidden-xs">
				<p id="content-text-1">为了无法统计的价值！</p>
				<p id="content-text-2">弹性部署，云端管理<br>打造最具创造力的统计系统！</p>
			</div>
			<div class="col-lg-5 col-md-5" id="input-div" align="center">
				<p id="login-title">登录系统</p>
				<form action="./login.php" method="post">
					<div class="input-group input-div">
						<span class="input-group-addon" id="basic-addon1">账号</span>
						<input name="user" type="text" class="form-control" placeholder="请输入账号" aria-describedby="basic-addon1">
					</div>
					<div class="input-group input-div">
						<span class="input-group-addon" id="basic-addon1">密码</span>
						<input name="power" type="password" class="form-control" placeholder="请输入密码" aria-describedby="basic-addon1">
					</div>
					<a id="forget_password">忘记密码？</a>
					<a id="register" href="./register.php">注册</a>
					<button type="submit" class="btn btn-success" id="login-btn">登录</button>
					</from>
					<?php
					include_once 'api.php';
					if ( $respond = login() ) {
						echo "<div class=\"alert alert-danger\" role=\"alert\">" . $respond . "</div>";
					}
					?>
			</div>
		</div>
	</div>
</body>
</html>