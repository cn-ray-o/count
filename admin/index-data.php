<!DOCTYPE html>
<html lang="zh-CN">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	<title>数据阅览中心-光环统计</title>

	<!-- Bootstrap -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="/css/admin-index-data.css">

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
		<?php include '../head.php'; ?>
		<?php setcookie("command","dataShow") ?>
		<?php
		include_once '../api.php';
		?>
		<div class="row" id="content-div">
			<div class="col-lg-6">
				<p id="title-text">#&nbsp;数据阅览中心</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4 block-div">
				<p class="bloxk-text-1">今日启动数据</p>
				<?php
				echo "<p class=\"bloxk-text-2\">记录&nbsp;</p><p class=\"bloxk-text-3\">" . todayCount() . "</p><p class=\"bloxk-text-2\">&nbsp;人次</p>";
				?>
			</div>
			<div class="col-lg-4  block-div">
				<p class="bloxk-text-1">当前在线人数</p>
				<?php
				echo "<p class=\"bloxk-text-2\">记录&nbsp;</p><p class=\"bloxk-text-3\">" . onlineNumberCount() . "</p><p class=\"bloxk-text-2\">&nbsp;人次</p>";
				?>
			</div>
		</div>

		<!--打印近30天数据表-->
		<div class="row">
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>
			<div class="col-lg-12">
			<script>
				function testWindowsWidth(){
					if(document.documentElement.clientWidth <= 532){
						document.write("<canvas id=\"myChart\" width=\"400\" height=\"300\"></canvas>");
					}else{
						document.write("<canvas id=\"myChart\" width=\"400\" height=\"100\"></canvas>");
					}
				}
				testWindowsWidth();
			</script>
				
			</div>
			<script>
				var ctx = document.getElementById( 'myChart' );
				var myChart = new Chart( ctx, {
					type: 'line',
					data: {
						labels: [ <?php echo "'".date("Y年m月d日", strtotime( "-0 year -0 month -1 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -2 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -3 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -4 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -5 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -6 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -7 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -8 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -9 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -10 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -11 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -12 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -13 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -14 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -15 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -16 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -17 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -18 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -19 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -20 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -21 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -22 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -23 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -24 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -25 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -26 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -27 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -28 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -29 day" ))."'".","."'".date("Y年m月d日", strtotime( "-0 year -0 month -30 day" ))."'"?> ],
						datasets: [ {
							label: '# 近30日启动次数',
							<?php
							$countDay = Day30Count();
							
							function countDayNumber($i){
								global $countDay;
								if(preg_match( "/^[0-9]+$/", $countDay[ $i ])){
									return $countDay[ $i ];
								}
									return "0";
							}
							?>
							data: [<?php global $countDay;
								echo countDayNumber("30").",".countDayNumber("29").",".countDayNumber("28").",".countDayNumber("27").",".countDayNumber("26").",".countDayNumber("25").",".countDayNumber("24").",".countDayNumber("23").",".countDayNumber("22").",".countDayNumber("21").",".countDayNumber("20").",".countDayNumber("19").",".countDayNumber("18").",".countDayNumber("17").",".countDayNumber("16").",".countDayNumber("15").",".countDayNumber("14").",".countDayNumber("13").",".countDayNumber("12").",".countDayNumber("11").",".countDayNumber("10").",".countDayNumber("09").",".countDayNumber("08").",".countDayNumber("07").",".countDayNumber("06").",".countDayNumber("05").",".countDayNumber("04").",".countDayNumber("03").",".countDayNumber("02").",".countDayNumber("01");?> ],
							borderWidth: 1,
							backgroundColor: 'rgba(255,83,86,0.7)',
						} ]
					},
				} );
			</script>
		</div>
		<?php
		$countHour = hourCount();

		function countNumber( $i ) {
			global $countHour;
			//判断需要调用的时间段记录数的数组索引是否存在，不存在输出0
			if ( preg_match( "/^[0-9]+$/", $countHour[ $i ] ) ) {
				return "启动" . $countHour[ $i ] . "次";
			} else {
				return "启动0次";
			}
		}
		?>
		<div class="row">
			<div class="col-lg-12 table-responsive">
				<table class="table">
					<caption>分小时统计数据</caption>
					<thead>
						<tr>
							<th>00:00-01:00</th>
							<th>01:00-02:00</th>
							<th>02:00-03:00</th>
							<th>03:00-04:00</th>
							<th>04:00-05:00</th>
							<th>05:00-06:00</th>
							<th>06:00-07:00</th>
							<th>07:00-08:00</th>
							<th>08:00-09:00</th>
							<th>09:00-10:00</th>
							<th>10:00-11:00</th>
							<th>11:00-12:00</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php echo countNumber( "0" ); ?>
							</td>
							<td>
								<?php echo countNumber( "01" ); ?>
							</td>
							<td>
								<?php echo countNumber( "02" ); ?>
							</td>
							<td>
								<?php echo countNumber( "03" ); ?>
							</td>
							<td>
								<?php echo countNumber( "04" ); ?>
							</td>
							<td>
								<?php echo countNumber( "05" ); ?>
							</td>
							<td>
								<?php echo countNumber( "06" ); ?>
							</td>
							<td>
								<?php echo countNumber( "07" ); ?>
							</td>
							<td>
								<?php echo countNumber( "08" ); ?>
							</td>
							<td>
								<?php echo countNumber( "09" ); ?>
							</td>
							<td>
								<?php echo countNumber( "10" ); ?>
							</td>
							<td>
								<?php echo countNumber( "11" ); ?>
							</td>
						</tr>
					</tbody>
				</table>
				<table class="table">
					<thead>
						<tr>
							<th>12:00-13:00</th>
							<th>13:00-14:00</th>
							<th>14:00-15:00</th>
							<th>15:00-16:00</th>
							<th>16:00-17:00</th>
							<th>17:00-18:00</th>
							<th>18:00-19:00</th>
							<th>19:00-20:00</th>
							<th>20:00-21:00</th>
							<th>21:00-22:00</th>
							<th>22:00-23:00</th>
							<th>23:00-0:00</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<?php echo countNumber( "12" ); ?>
							</td>
							<td>
								<?php echo countNumber( "13" ); ?>
							</td>
							<td>
								<?php echo countNumber( "14" ); ?>
							</td>
							<td>
								<?php echo countNumber( "15" ); ?>
							</td>
							<td>
								<?php echo countNumber( "16" ); ?>
							</td>
							<td>
								<?php echo countNumber( "17" ); ?>
							</td>
							<td>
								<?php echo countNumber( "18" ); ?>
							</td>
							<td>
								<?php echo countNumber( "19" ); ?>
							</td>
							<td>
								<?php echo countNumber( "20" ); ?>
							</td>
							<td>
								<?php echo countNumber( "21" ); ?>
							</td>
							<td>
								<?php echo countNumber( "22" ); ?>
							</td>
							<td>
								<?php echo countNumber( "23" ); ?>
							</td>
						</tr>
					</tbody>
				</table>
				<div>
				</div>
			</div>
		</div>

		<!-- jQuery (Bootstrap 的所有 JavaScript 插件都依赖 jQuery，所以必须放在前边) -->
		<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
		<!-- 加载 Bootstrap 的所有 JavaScript 插件。你也可以根据需要只加载单个插件。 -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
</body>
</html>