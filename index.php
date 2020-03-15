<!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>光环弹性统计系统-光环网域</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="./css/main.css">

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
		<div class="row" id="content-div">
			<div class="col-lg-4 col-lg-offset-1 col-md-offset-1 col-md-4">
				<img alt="show" id="show-img" src="img/tj.png">
			</div>
			<div class="col-lg-7 col-md-7">
				<p id="theme-text">弹性部署型统计系统</p>
				<p>光环弹性统计</p>
				<a href="./login.php" class="btn btn-green btn-lg" role="button">登录系统&nbsp&nbsp<i class="fa fa-paper-plane"></i></a>
				<a href="#develop-title" class="btn btn-xbk btn-lg" role="button">查看说明&nbsp&nbsp<i class="fa fa-book"></i></a>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12" id="support-div" align="center">
				<p>现在起全面支持在以下语言部署本统计系统</p>
				<div><img alt="E4a" src="img/QQ截图20190820193844.png">
					<img alt="E" src="img/QQ截图20190820193920.png">
					<img alt="php" src="img/QQ截图20190820194147.png">
					<img alt="javascript" src="img/QQ截图20190820194511.png">
				</div>
				<p id="support-text">探索不止于此，更多语言接入请结合开发文档自行探索。</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-md-12" id="support-div" align="center">
				<p id="develop-title">开发文档</p>
			</div>
		</div>
			<div class="row">
				<div class="col-lg-1 title-head-div col-xs-1 col-md-1">
					<p id="title-head">#</p>
				</div>
				<div class="col-lg-10 col-xs-10 col-md-10">
					<p id="title">系统统计原理</p>
				</div>
				<div class="col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10">
					<p id="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;向接口“http://count.ray-o.cn/api.php?type=add&appkey=[你申请的appkey]”发起GET请求，每请求一次系统计数一个访问量，几乎没有延迟数据立马能完成展现。</p>
				</div>
				<div class="col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10">
					<p id="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;向接口“http://count.ray-o.cn/api.php?type=addOnlineNumber&appkey=[你申请的appkey]”发起频率为4500ms的GET请求，系统能较准确的统计在线人数，5秒内没有连续访问，视为用户下线，下线判断有1秒钟的误差，请不要更改对该接口的GET请求频率，服务器程序会每隔5秒回收一次缓存，统计精度由这个决定，不是加大请求频率就可以实现更高的精度，这样做毫无意义，只会浪费更多的算力。如果减小请求频率会造成统计精度丢失，所以也不要减小请求频率。</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-1 title-head-div col-xs-1 col-md-1">
					<p id="title-head">#</p>
				</div>
				<div class="col-lg-10 col-xs-10 col-md-10">
					<p id="title">javascript接入</p>
				</div>
				<div class="col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10">
					<p id="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;可以使用ajax来实现，具体代码为：</p>
				</div>
				<div class="col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10">
					<p id="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&ltscript&gt var xmlhttp; if ( window.XMLHttpRequest ) { xmlhttp = new XMLHttpRequest(); } else { xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" ); xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" ); xmlhttp.open("GET","http://count.ray-o.cn/api.php?type=add&appkey=[你申请的appkey]",false); xmlhttp.send();	&ltscript&gt</p>
				</div>
				<div class="col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10">
					<p id="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;本代码用于插入网站公共页头或者页脚或者首页，来统计这些页面刷新的次数。</p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-1 title-head-div col-xs-1 col-md-1">
					<p id="title-head">#</p>
				</div>
				<div class="col-lg-10 col-xs-10 col-md-10">
					<p id="title">其他语言接入</p>
				</div>
				<div class="col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10">
					<p id="content">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请参考系统原理探索，我计划再做几个例程，有空再上线吧。</p>
				</div>
				<div class="col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10">
				<p id="support-text">以上，列出了几种环境下的应用和本产品原理，如果你弄清楚了调用原理，你能很轻松的将其接入不同的代码环境，使本系统在更多的环境中生效。</p>
				</div>
			  <div class="col-lg-12 col-md-12" id="support-div" align="center">
					<p id="contact-div">联系方式</p>
			  </div>
				<div class="col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10" id="support-div">
					<img class="contact-img" alt="众测群" src="img/qrcode_1566360421046.jpg"><img class="contact-img" alt="开发者QQ" src="img/qrcode_1566360395577.jpg">
				</div>
				<div class="col-lg-10 col-lg-offset-1 col-md-offset-1 col-md-10">
					<p id="support-text">建议加群，如果要加我QQ请备注来自光环统计。</p>
				</div>
			</div>
			<div class="row" align="center">
				<div class="col-lg-12" id="foot-div col-md-12" >
					<p>光环弹性统计 为了无法计算的价值！<br>Copyright © ray-o.cn</p>
				</div>
			</div>
	</div>

    <!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
    <!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
	<!--count开始统计自身，使用ajax实现-->
	<script>
		var xmlhttp;
			if ( window.XMLHttpRequest ) {
				// IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
				xmlhttp = new XMLHttpRequest();
			} else {
				// IE6, IE5 浏览器执行代码
				xmlhttp = new ActiveXObject( "Microsoft.XMLHTTP" );
			}
		xmlhttp.open("GET","http://count.ray-o.cn/api.php?type=add&appkey=713c9adb61499833bff3e96a5ac78952",false);
		xmlhttp.send();	
	</script>
  </body>
</html>