<?php
    require_once("dbtools.inc.php");
	
    //取得 modify.php 網頁的表單資料
	$title = $_POST["title"];
	$message = $_POST["message"];
		
    //建立資料連接
    $link = create_connection();
				
    //執行 UPDATE 陳述式來更新使用者資料
		$sql = "UPDATE new_message SET message = '$message' WHERE title = '$title'";
		$result = execute_sql($link, "bbq_database", $sql);
		
    //關閉資料連接
    mysqli_close($link);
?>
<!doctype html>
<html>
  <head>
    <title>修改公告訊息成功</title>
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
		margin-bottom: 100px;
		margin-top: 50px;
		margin-right: 200px;
		margin-left: 200px;
	}
	</style>
    <center>
      <img src="revise.png"><br><br>
      <font size="5"><label>公告訊息 <?php echo $title ?> 已經修改成功。</label></font>
	  <div class="form-group">
				<div class="col-sm-offset-0 col-sm-20">
					<br>
					<button type="button" class="btn btn-primary" onClick='location.href="modify_message.php"'>回修改管理頁面</button>
				</div>
		</div>
    </center>        
  </body>
</html>

<?php
	setcookie("id", "0");
    setcookie("passed", "TRUE");
?>