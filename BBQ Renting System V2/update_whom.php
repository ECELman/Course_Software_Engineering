<?php
  //檢查 cookie 中的 passed 變數是否等於 TRUE
  $passed = $_COOKIE{"passed"};
	
  //如果 cookie 中的 passed 變數不等於 TRUE
  //表示尚未登入網站，將使用者導向首頁 login.html
  if ($passed != "TRUE")
  {
    header("location:login.html");
    exit();
  }
?>
<!doctype html>
<html>
  <head>
    <title>變更誰的訂單?</title>
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
		margin-top: 100px;
		margin-right: 500px;
		margin-left: 500px;
	}
	</style>
    <p align="center" ><b><font size="8">輸入欲修改的會員帳號</font></b></p>
	<form class="form-inline" name="dataForm" method="post" action="update_order.php" >
      <table border="3" align="center" class = "table table-striped" bordercolor="rhba(255,255,255,0)">
        <tr> 
		  <div class="form-group">
            <td colspan="2" bgcolor="#6666FF" align="center"> 
				<input type="text" name = "order_belongs_to" class="form-control" placeholder="Account" size="20">
			</div>
          </td>
        </tr>
		
        <tr bgcolor="#99FF99"> 
          <td colspan="2" align="CENTER"> 
			<div class="form-group">
				<button type="submit" class="btn btn-primary">送出</button></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="reset" class="btn btn-default">重填</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-default" onClick='location.href="main.php"'>回上頁</button>
				</div>
			</div>
          </td>
        </tr>	
      </table>
	  
	  <br><br><br><br>
				<table border='3'  align='center' class = 'table table-striped' bordercolor='rhba(255,255,255,0)'>
					<tr class='info'> 
						<td colspan='2' align='center'> 
							<label><font size='5'>會員名單</font></label>
						</td>
					</tr> 
					<tr> 
						<td align='center'> 
							<label><font size='5'>帳號</font></label>
						</td>
						<td align='center'>
							<label><font size='5'>姓名</font></label>
						</td>
					</tr>
					<?php
						require_once("dbtools.inc.php");
					
						//建立資料庫連接
						$link = create_connection();
						
						mysqli_select_db($link, "bbq_database"); //選擇資料庫bbq_database
						
						$sql = "SELECT rent_person.id, name 
						        FROM rent_person, user 
								WHERE rent_person.id = user.id";
						
						$result = mysqli_query($link,$sql); //執行SQL查詢
						
						$total_records = mysqli_num_rows($result);  // 取得資料表裡頭總共有幾筆資料
						
						for($i = 1; $i <= $total_records; $i++)
						{	
							$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
					
							echo "<tr><td align='center'><label><font size='5'>";
							echo $row{"id"};
							echo "</font></label></td><td align='center'><label><font size='5'>";
							echo $row{"name"};
							echo "</font></label></td></tr>";
						}
						
						setcookie("id", "0");
					?>
				</table>
	  
	  </form>
  </body>
</html>
