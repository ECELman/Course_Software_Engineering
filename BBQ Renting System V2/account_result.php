<?php

  require_once("dbtools.inc.php");
  
  //建立資料連接
  $link = create_connection();
  
  $account = $_COOKIE["account"];
			
  //執行 SELECT 陳述式取得使用者資料
    $sql = "SELECT * FROM user Where id = '$account'";
    $result = execute_sql($link, "bbq_database", $sql);
	
	$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
	
	$account = $row{"id"};
	$password = $row{"password"};
	
  //關閉資料連接	
  mysqli_close($link);
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>身分驗證成功</title>
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
		margin-top: 30px;
		margin-right: 200px;
		margin-left: 200px;
	}
	</style>
	<table border='3'  align='center' class = 'table table-striped' bordercolor='rhba(255,255,255,0)'>
		<tr class='info'> 
			<td colspan='2' align='center'> 
				<label><font size='5'>恭喜您通過身分驗證，您的資料如下：</font></label>
			</td>
		</tr> 
		<tr> 
			<td align='center'> 
				<label><font size='5'>帳號：</font></label>
			</td>
			<td align='center'>
				 <label><font color="#FF0000" size='5'><?php echo $account ?></font></label>
			</td>
		</tr>
		<tr> 
			<td align='center'> 
				<label><font size='5'>密碼：</font></label>
			</td>
			<td align='center'>
				 <label><font color="#FF0000" size='5'><?php echo $password ?></font></label>
			</td>
		</tr>
		<tr class='danger'> 
			<td colspan='2' align='center'> 
				<label><font size='5'>請牢記您的帳號及密碼，然後再登入網站。</font></label>
			</td>
		</tr>
		<tr>
          <td colspan='2' align="center"> 
			<div class="form-group">
				<div class="col-sm-offset-0 col-sm-0">
					<br>
					<button type="button" class="btn btn-success" onClick='location.href="login.html"'><label><font size='4'>登入網站</label></font></button>
				</div>
			</div>
          </td>
		</tr>
	</table>
    </p>
  </body>
</html>