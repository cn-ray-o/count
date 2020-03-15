<link rel="stylesheet" type="text/css" href="/css/head-main.css">
<div class="row nav-div">
	<div class=col-lg-12>
		<a class="navbar-brand" href="/">
			<img alt="Brand" id="logo" src="/img/logo.png">
		</a>
		<ul class="nav nav-pills">
			<li role="presentation"><a href="/index.php" class="nav-a">首页</a></li>
			<?php
			setcookie("command",NULL);
			include 'api.php';
			if(cookieChecking()=="cookie正确"){
				echo "<li role=\"presentation\"><a href=\"/admin\" class=\"nav-a\">项目中心</a></li>";
			}else{
				echo "<li role=\"presentation\"><a href=\"/login.php\" class=\"nav-a\">登录</a></li>";
			}
			?>
			<li role="presentation"><a href="/index.php#contact-div" class="nav-a">联系</a></li>
		</ul>
	</div>
</div>
