<?php

//格式化时区
date_default_timezone_set( "Asia/Shanghai" );

//数据库信息
include "config.php";

//任务响应核心调度中心
switch ( @$_GET[ "type" ] ) {
	case "add":
		respond();
		break;
	case "addOnlineNumber":
		onlineNumber();
		break;
	case "deleteAppKey":
		deleteAppKey();
		break;
	case "recoveryRespond":
		recoveryRespond();
		break;
	case "recoveryOnlineNumber":
		recoveryOnlineNumber();
		break;
	case "test":
		Day30Count();
		break;
}

//注册账号函数
function register() {
	if ( $_POST[ "user" ] <> "" && $_POST[ "power" ] <> "" && $_POST[ "rePower" ] <> "" && $_POST[ "email" ] <> "" && $_POST[ "QQ" ] <> "" ) {
		if ( !preg_match( "/^[a-z0-9]+$/", $_POST[ "user" ] ) ) {
			return "用户名只能由小写字母和数字组成，请重试。";
			exit();
		}
		if ( strlen( !( strlen( $_POST[ "power" ] ) >= 8 && strlen( $_POST[ "power" ] ) <= 16 ) ) ) {
			return "密码长度不能小于8或大于16，请重试。";
			exit();
		};
		if ( strlen( !( $_POST[ "power" ] == $_POST[ "rePower" ] ) ) ) {
			return "两次密码输入不同，请重试。";
			exit();
		};
		if ( strlen( !( strlen( $_POST[ "QQ" ] ) >= 5 && strlen( $_POST[ "QQ" ] ) <= 10 ) ) ) {
			return "QQ长度不能小于5或大于10，请重试。";
			exit();
		};
		global $serverName;
		global $userName;
		global $passWord;
		global $dbName;
		$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
		if ( $conn->connect_error ) {
			die( "系统错误" );
		}
		$sql = "INSERT INTO `user` (`ID`, `user`, `power`, `registrationTime`, `QQ`, `email`, `VIP`) VALUES (NULL, '" . $_POST[ "user" ] . "', '" . md5( $_POST[ "power" ] ) . "', '" . date( 'y' . 'm' . 'd' ) . "', '" . $_POST[ "QQ" ] . "', '" . $_POST[ "email" ] . "', '0');";
		if ( $conn->query( $sql ) === TRUE ) {
			return "注册成功";
			setcookie( "command", NULL );
		} else {
			return "用户名重复";
		}
		$conn->close();
	} else {
		return "请将信息全部填满再点击提交，谢谢！";
	}
}

//登录系统函数
function login() {
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;

	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}
	$sql = "SELECT * FROM `user` WHERE `user` = '" . $_POST[ "user" ] . "'";
	$result = $conn->query( $sql );
	if ( $result->num_rows > 0 ) {
		$row = $result->fetch_assoc();
		if ( $row[ "power" ] == md5( $_POST[ "power" ] ) ) {
			setcookie( "command", NULL );
			setcookie( "user", $_POST[ "user" ] );
			setcookie( "power", md5( $_POST[ "power" ] ) );
			header( 'Location: ./admin' );
			return "登陆成功";
		} else {
			return "账号或密码错误";
		}
	}

	$conn->close();

}

//cookie认证函数
function cookieChecking() {
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;
	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}

	$sql = "SELECT * FROM `user` WHERE `user` = '" . $_COOKIE[ "user" ] . "'";
	$result = $conn->query( $sql );
	if ( $result->num_rows > 0 ) {
		$row = $result->fetch_assoc();
		if ( $row[ "power" ] == $_COOKIE[ "power" ] ) {
			$conn->close();
			return "cookie正确";
		} else {
			$conn->close();
			return "cookie错误";
		}
	} else {
		return "找不到该cookie";
	}
}

//创建appkey项目
function setUpAppKey() {
	if ( !cookieChecking() == "cookie正确" ) {
		exit();
		echo "身份验证不通过";
	}
	if ( !$_POST[ "mark" ] == "" ) {
		global $serverName;
		global $userName;
		global $passWord;
		global $dbName;
		$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
		if ( $conn->connect_error ) {
			die( "系统错误" );
		}
		$sql = "set names utf8";
		$conn->query( $sql );
		$sql = "INSERT INTO `project` (`ID`, `appKey`, `sourceUser`, `mark`) VALUES (NULL, '" . md5( date( 'y' . 'm' . 'd' . 'H' . 'i' . 's' ) ) . "', '" . $_COOKIE[ "user" ] . "', '" . htmlspecialchars( $_POST[ "mark" ] ) . "');";
		if ( $conn->query( $sql ) === TRUE ) {
			return "添加成功，即将刷新!";
		} else {
			return "添加失败，请联系管理员!";
		}
		$conn->close();
	}
}

//打印输出appkey
function printAppKey() {
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;

	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}
	$sql = "set names utf8";
	$conn->query( $sql );
	$sql = "SELECT * FROM `project` WHERE `sourceUser` = '" . $_COOKIE[ "user" ] . "' LIMIT 0, 30 ";
	$result = $conn->query( $sql );
	if ( $result->num_rows > 0 ) {
		while ( $row = $result->fetch_assoc() ) {
			echo "<tr><td>" . $row[ "ID" ] . "</td>" . "<td id=\"appkey-td\">" . $row[ "appKey" ] . "</td>" . "<td>" . $row[ "mark" ] . "</td>" . "<td>" . "<a href=\"./index-data.php?appKey=" . $row[ "appKey" ] . "\">查看统计数据</a>" . "&nbsp;&nbsp;&nbsp;" . "<a href=\"/api.php?type=deleteAppKey&ID=" . $row[ "ID" ] . "\">删除项目</a>" . "</td></tr>";
		}
		$conn->close();
		return $result->fetch_assoc();
	} else {
		return "没有项目";
	}
}

//删除appkey
function deleteAppKey() {
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;

	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}

	$sql = "DELETE FROM project WHERE ID=" . $_GET[ "ID" ] . "";

	if ( $conn->query( $sql ) ) {
		echo "成功";
	} else {
		echo "失败";
	}
	$conn->close();
	header( 'Location: ./admin/index.php' );
}

//响应调用函数
function respond() {
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;
	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}

	$sql = "SELECT * FROM `project` WHERE `appKey` = '" . $_GET[ "appkey" ] . "' LIMIT 0, 30 ";
	$result = $conn->query( $sql );
	if ( !$result->num_rows == 1 ) {
		die( "系统错误，请检查appkey是否存在" );
	}
	$sql = "SELECT * FROM `respond` WHERE `appKey` = '" . $_GET[ "appkey" ] . "' AND `hour` = " . date( 'H' ) . " AND `time` = " . date( 'y' . 'm' . 'd' ) . "";
	$result = $conn->query( $sql );
	if ( $result->num_rows >= 1 ) {
		//这个时间点，该appkey有记录，累加即可
		$row = $result->fetch_assoc();
		$count = $row[ "count" ] + 1;
		$sql = "UPDATE `respond` SET `count`=" . $count . " WHERE `appKey` = '" . $_GET[ "appkey" ] . "' AND `hour` = " . date( 'H' ) . " AND `time` = " . date( 'y' . 'm' . 'd' ) . "";
		if ( $conn->query( $sql ) === TRUE ) {
			echo "计数成功";
		} else {
			echo "系统错误";
		}
	} else {
		//这个时间点，该appkey没有记录，新建一条
		$sql = "INSERT INTO `respond` (`ID`, `appKey`, `hour`, `count`, `time`) VALUES (NULL, '" . $_GET[ "appkey" ] . "', '" . date( 'H' ) . "', '1', '" . date( 'y' . 'm' . 'd' ) . "');";
		if ( $conn->query( $sql ) === TRUE ) {
			echo "计数成功";
		} else {
			echo "系统错误";
		}
	}
	$conn->close();
}

//统计在线人数接口函数
function onlineNumber() {
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;
	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}
	//建一条在线人数统计的数据库记录

	$sql = "INSERT INTO `onlinenumber` (`ID`, `appKey`, `ip`, `time`) VALUES (NULL, '" . $_GET[ "appkey" ] . "', '" . $_SERVER[ 'REMOTE_ADDR' ] . "', '" . date( 'y' . 'm' . 'd' . 'H' . 'i' . 's' ) . "');";
	if ( $conn->query( $sql ) === TRUE ) {
		echo "在线人数统计成功";
	} else {
		echo "系统错误";
	}
	$conn->close();
}

//今日启动数据展现
function todayCount() {
	$countHour = hourCount();
	return intval( $countHour[ "0" ] ) + intval( $countHour[ "01" ] ) + intval( $countHour[ "02" ] ) + intval( $countHour[ "03" ] ) + intval( $countHour[ "04" ] ) + intval( $countHour[ "05" ] ) + intval( $countHour[ "06" ] ) + intval( $countHour[ "07" ] ) + intval( $countHour[ "08" ] ) + intval( $countHour[ "09" ] ) + intval( $countHour[ "10" ] ) + intval( $countHour[ "11" ] ) + intval( $countHour[ "12" ] ) + intval( $countHour[ "13" ] ) + intval( $countHour[ "14" ] ) + intval( $countHour[ "15" ] ) + intval( $countHour[ "16" ] ) + intval( $countHour[ "17" ] ) + intval( $countHour[ "18" ] ) + intval( $countHour[ "19" ] ) + intval( $countHour[ "20" ] ) + intval( $countHour[ "21" ] ) + intval( $countHour[ "22" ] ) + intval( $countHour[ "23" ] );
}

//在线人数统计数据展现
function onlineNumberCount() {
	if ( !cookieChecking() == "cookie正确" ) {
		exit();
		echo "身份验证不通过";
	}
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;
	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}
	$sql = "SELECT COUNT(*) AS `行数`, `ip` FROM `onlinenumber` WHERE `appKey` = '" . $_GET[ "appKey" ] . "' GROUP BY `ip` ORDER BY `ip` LIMIT 0, 30 ";
	$result = $conn->query( $sql );

	return $result->num_rows;
}

//逐小时启动数展现
function hourCount() {
	if ( !cookieChecking() == "cookie正确" ) {
		exit();
		echo "身份验证不通过";
	}
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;
	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}
	$sql = "SELECT * FROM `respond` WHERE `appKey` = '" . $_GET[ "appKey" ] . "' AND `time` = " . date( 'y' . 'm' . 'd' ) . "";
	$result = $conn->query( $sql );
	if ( $result->num_rows > 0 ) {
		while ( $row = $result->fetch_assoc() ) {
			switch ( $row[ "hour" ] ) {
				case "0":
					$countHour[ "0" ] = $row[ "count" ];
					break;
				case "01":
					$countHour[ "01" ] = $row[ "count" ];
					break;
				case "02":
					$countHour[ "02" ] = $row[ "count" ];
					break;
				case "03":
					$countHour[ "03" ] = $row[ "count" ];
					break;
				case "04":
					$countHour[ "04" ] = $row[ "count" ];
					break;
				case "05":
					$countHour[ "05" ] = $row[ "count" ];
					break;
				case "06":
					$countHour[ "06" ] = $row[ "count" ];
					break;
				case "07":
					$countHour[ "07" ] = $row[ "count" ];
					break;
				case "08":
					$countHour[ "08" ] = $row[ "count" ];
					break;
				case "09":
					$countHour[ "09" ] = $row[ "count" ];
					break;
				case "10":
					$countHour[ "10" ] = $row[ "count" ];
					break;
				case "11":
					$countHour[ "11" ] = $row[ "count" ];
					break;
				case "12":
					$countHour[ "12" ] = $row[ "count" ];
					break;
				case "13":
					$countHour[ "13" ] = $row[ "count" ];
					break;
				case "14":
					$countHour[ "14" ] = $row[ "count" ];
					break;
				case "15":
					$countHour[ "15" ] = $row[ "count" ];
					break;
				case "16":
					$countHour[ "16" ] = $row[ "count" ];
					break;
				case "17":
					$countHour[ "17" ] = $row[ "count" ];
					break;
				case "18":
					$countHour[ "18" ] = $row[ "count" ];
					break;
				case "19":
					$countHour[ "19" ] = $row[ "count" ];
					break;
				case "20":
					$countHour[ "20" ] = $row[ "count" ];
					break;
				case "21":
					$countHour[ "21" ] = $row[ "count" ];
					break;
				case "22":
					$countHour[ "22" ] = $row[ "count" ];
					break;
				case "23":
					$countHour[ "23" ] = $row[ "count" ];
					break;
			}
		}
		return $countHour;
	} else {
		return "没有数据";
	}
}

//近30日启动数展现
function Day30Count() {
	if ( !cookieChecking() == "cookie正确" ) {
		exit();
		echo "身份验证不通过";
	}
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;
	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}
	$sql = "SELECT * FROM `respond` WHERE `appKey` = '" . $_GET[ "appKey" ] . "'";
	$result = $conn->query( $sql );
	if ( $result->num_rows > 0 ) {
		while ( $row = $result->fetch_assoc() ) {
			switch ( $row[ "time" ] ) {
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -30 day" ) ):
					$countDay[ "01" ] = intval( $countDay[ "01" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -29 day" ) ):
					$countDay[ "02" ] = intval( $countDay[ "02" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -28 day" ) ):
					$countDay[ "03" ] = intval( $countDay[ "03" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -27 day" ) ):
					$countDay[ "04" ] = intval( $countDay[ "04" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -26 day" ) ):
					$countDay[ "05" ] = intval( $countDay[ "05" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -25 day" ) ):
					$countDay[ "06" ] = intval( $countDay[ "06" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -24 day" ) ):
					$countDay[ "07" ] = intval( $countDay[ "07" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -23 day" ) ):
					$countDay[ "08" ] = intval( $countDay[ "08" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -22 day" ) ):
					$countDay[ "09" ] = intval( $countDay[ "09" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -21 day" ) ):
					$countDay[ "10" ] = intval( $countDay[ "10" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -20 day" ) ):
					$countDay[ "11" ] = intval( $countDay[ "11" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -19 day" ) ):
					$countDay[ "12" ] = intval( $countDay[ "12" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -18 day" ) ):
					$countDay[ "13" ] = intval( $countDay[ "13" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -17 day" ) ):
					$countDay[ "14" ] = intval( $countDay[ "14" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -16 day" ) ):
					$countDay[ "15" ] = intval( $countDay[ "15" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -15 day" ) ):
					$countDay[ "16" ] = intval( $countDay[ "16" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -14 day" ) ):
					$countDay[ "17" ] = intval( $countDay[ "17" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -13 day" ) ):
					$countDay[ "18" ] = intval( $countDay[ "18" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -12 day" ) ):
					$countDay[ "19" ] = intval( $countDay[ "19" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -11 day" ) ):
					$countDay[ "20" ] = intval( $countDay[ "20" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -10 day" ) ):
					$countDay[ "21" ] = intval( $countDay[ "21" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -9 day" ) ):
					$countDay[ "22" ] = intval( $countDay[ "22" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -8 day" ) ):
					$countDay[ "23" ] = intval( $countDay[ "23" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -7 day" ) ):
					$countDay[ "24" ] = intval( $countDay[ "24" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -6 day" ) ):
					$countDay[ "25" ] = intval( $countDay[ "25" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -5 day" ) ):
					$countDay[ "26" ] = intval( $countDay[ "26" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -4 day" ) ):
					$countDay[ "27" ] = intval( $countDay[ "27" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -3 day" ) ):
					$countDay[ "28" ] = intval( $countDay[ "28" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -2 day" ) ):
					$countDay[ "29" ] = intval( $countDay[ "29" ] ) + intval( $row[ "count" ] );
					break;
				case date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -1 day" ) ):
					$countDay[ "30" ] = intval( $countDay[ "30" ] ) + intval( $row[ "count" ] );
					break;
			}
		}
		return $countDay;
	} else {
		return "没有数据";
	}
}

//系统回收过期及失效respond表资源，该函数需要设置计划任务，5分钟执行一次。
function recoveryRespond() {
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;
	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}
	$sql = "SELECT * FROM `respond`";
	$result = $conn->query( $sql );
	if ( $result->num_rows >= 1 ) {
		while ( $row = $result->fetch_assoc() ) {
			//计算过期时间	
			$overdueTime = date( 'y' . 'm' . 'd', strtotime( "-0 year -0 month -30 day" ) );;
			if ( $row[ "time" ] < $overdueTime ) {
				$sql = "DELETE FROM respond WHERE time='" . $row[ "time" ] . "'";
				if ( $conn->query( $sql ) === TRUE ) {
					echo "处理成功；";
				} else {
					echo "系统错误";
				}
			}
		}
	}
}

//系统回收过期及失效onlineNumber资源，该函数需要设置计划任务，1分钟执行一次。
function recoveryOnlineNumber() {
	global $serverName;
	global $userName;
	global $passWord;
	global $dbName;
	$conn = new mysqli( $serverName, $userName, $passWord, $dbName );
	if ( $conn->connect_error ) {
		die( "系统错误" );
	}
	$sql = "SELECT * FROM `onlinenumber`";
	$result = $conn->query( $sql );
	if ( $result->num_rows >= 1 ) {
		while ( $row = $result->fetch_assoc() ) {
			//计算过期时间	
			$overdueTime = date( 'y' . 'm' . 'd' . 'H' . 'i' . 's', strtotime( "-0 year -0 month -0 day -0 hour -0 minute -5 second" ) );;
			if ( $row[ "time" ] < $overdueTime ) {
				$sql = "DELETE FROM onlinenumber WHERE time='" . $row[ "time" ] . "'";
				if ( $conn->query( $sql ) === TRUE ) {
					echo "处理成功；";
				} else {
					echo "系统错误";
				}
			}
		}
	}
}

?>