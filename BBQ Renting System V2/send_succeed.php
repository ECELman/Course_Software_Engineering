<?php	
    require_once("dbtools.inc.php");
    //建立資料連接
    $link = create_connection();
	
	$title = $_POST["title"];
	$message = $_POST["message"];
	$date = date("Y/m/d");
	if($title != NULL && $message != NULL)
	{
		//執行 INSERT INTO 陳述式取得使用者資料
		$sql = "INSERT INTO new_message (title, message, date) VALUES ('$title', '$message', '$date')";
		execute_sql($link, "bbq_database", $sql);
	}
?>
<!DOCTYPE HTML>

<html>

	<head>
	
		<title>訊息發布成功</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets4/css/Thank.css" />
		<noscript><link rel="stylesheet" href="assets4/css/noscript.css" /></noscript>
		
	</head>
	
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="logo">
							<span class="icon fa-diamond"></span>
						</div>
						<div class="content">
							<div class="inner">
								<h1>訊息發布成功</h1>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="index_system_manager.html">回到系統管理員專區</a></li>
							</ul>
						</nav>
					</header>

				<!-- Footer -->
					<footer id="footer">
					</footer>

			</div>

		<!-- BG -->
			<div id="bg"></div>

		<!-- Scripts -->
			<script src="assets4/js/jquery.min.js"></script>
			<script src="assets4/js/skel.min.js"></script>
			<script src="assets4/js/util.js"></script>
			<script src="assets4/js/main.js"></script>

	</body>
	
</html>
