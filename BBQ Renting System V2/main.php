<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE["passed"];

  /*  如果 cookie 中的 passed 變數不等於 TRUE
      表示尚未登入網站，將使用者導向首頁 login.html	*/
  if ($passed != "TRUE")
  {
    header("location:login.html");
    exit();
  }

  $id = $_COOKIE["id"];
  require_once("dbtools.inc.php");
  //建立資料連接
  $link = create_connection();
?>
<!doctype html>
<html>
  <head>
    <title>我要訂位</title>
    <meta charset="utf-8">
  </head>
  <body>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style type="text/css">
	body
	{
		background-color:rgba(255,255,255,0.8);
		background-image: url("bbq.jpg");
		background-blend-mode: lighten;
	}
	</style>
	<p align="center" ><b><font size="8">會員專區</font></b></p>
    <p align="center">
	<?php
	    $ifadmin = false;
		$ifdeal_person = false;
		$sql = "SELECT COUNT(*) AS COUNT_RESULT FROM admin Where id = '$id'";
		$result = execute_sql($link, "bbq_database", $sql);
		$row = mysqli_fetch_assoc($result);
		if($row{"COUNT_RESULT"} == 1)
		{
			$ifadmin = true;
			header("location:index_system_manager.html");
		}
		$sql = "SELECT COUNT(*) AS COUNT_RESULT FROM deal_person Where id = '$id'";
		$result = execute_sql($link, "bbq_database", $sql);
		$row = mysqli_fetch_assoc($result);
		if($row{"COUNT_RESULT"} == 1)
		{
		    $ifdeal_person = true;
			header("location:index_handling_personel.html");
		}
		$sql = "SELECT COUNT(*) AS COUNT_RESULT FROM rent_person Where id = '$id'";
		$result = execute_sql($link, "bbq_database", $sql);
		$row = mysqli_fetch_assoc($result);
		if($row{"COUNT_RESULT"} == 1 && $ifadmin != true)
		{
			if($ifdeal_person != true)
	           header("location:index_rent_person.html");
		}
	?>
	  <a href="logout.php"><button type="button" class="btn btn-danger"><font size="5">登出網站</font></button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    </p>
  </body>
</html>