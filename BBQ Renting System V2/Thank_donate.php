<?php	
    require_once("dbtools.inc.php");
    //建立資料連接
    $link = create_connection();
	
	$name = $_POST["name"];
	$email = $_POST["email"];
	$credit_card_number = $_POST["credit_card_number"];
	$money = $_POST["money"];
	$date = date("Y/m/d");
	
	if($name != NULL && $email != NULL && $credit_card_number != NULL && $money != NULL)
	{
		//執行 INSERT INTO 陳述式取得使用者資料
		$sql = "INSERT INTO donate (name, email, credit_card_number, money, date) VALUES ('$name', '$email', '$credit_card_number', '$money', '$date')";
		execute_sql($link, "bbq_database", $sql);
	}
?>
<!DOCTYPE HTML>

<html>

	<head>
	
		<title>感謝贊助</title>
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
								<h1>感謝贊助</h1>
								<p>您的支持就是我們的原動力</p><p>期待您下一次的到來</p>
							</div>
						</div>
						<nav>
							<ul>
								<li><a href="index_rent_person.html">回到租借人專區</a></li>
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
