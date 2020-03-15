<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<title>项目管理中心-光环统计</title>

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/admin-index.css">

	<link href="//netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
	<!-- HTML5 shim 和 Respond.js 是为了让 IE8 支持 HTML5 元素和媒体查询（media queries）功能 -->
	<!-- 警告：通过 file:// 协议（就是直接将 html 页面拖拽到浏览器中）访问页面时 Respond.js 不起作用 -->
	<!--[if lt IE 9]>
      <script src="https://cdn.jsdelivr.net/npm/html5shiv@3.7.3/dist/html5shiv.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/respond.js@1.4.2/dest/respond.min.js"></script>
    <![endif]-->
</head>

<body onresize = testWindowsWidth()>
	<div class="container">
		<?php include '../head.php'; ?>
		<?php setcookie("command","addObject") ?>
		<div class="row" id="content-div">
			<div class="col-lg-3">
				<p id="title-text">#&nbsp;项目管理中心</p>
			</div>
			<form action="./index.php" method="post">
				<div class="col-lg-4 col-lg-offset-4  col-xs-9 add-div">
					<div class="input-group" id="add-input">
						<span class="input-group-addon" id="basic-addon1">新增项目</span>
						<input name="mark" type="text" class="form-control" placeholder="请输入项目标记（名称）" aria-describedby="basic-addon1">
					</div>
				</div>
				<div class="col-lg-1 col-xs-3 add-div">
					<button id="add-button" type="submit" class="btn btn-success">确认增加</button>
				</div>
			</form>
				<?php
				include_once '../api.php';
				if($respond = setUpAppKey()){
					header("Refresh:1;url=./");
					echo "<p id=\"tip\">"."系统提示：".$respond."</p>";
				}
				?>
		</div>
		<div class="row">
			<div class="col-lg-12 table-responsive">
				<table class="table">
					<caption>项目管理</caption>
					<thead>
						<tr>
							<th>ID</th>
							<th>appkey</th>
							<th>备注</th>
							<th>操作</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<?php
							printAppKey();
							?>
						</tr>
						<script>
							function testWindowsWidth(){
								if(document.documentElement.clientWidth <= 532){
									//document.getElementById('appkey-td').innerHTML = '请在电脑上查看';
								}
							}
							testWindowsWidth();
						</script>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
	<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
	<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>