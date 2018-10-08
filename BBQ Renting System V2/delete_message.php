<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>國立高雄大學露營烤肉區租借系統</title>
    <script type="text/javascript">
	
		
		
	//https://css-tricks.com/snippets/javascript/javascript-md5/
	//----------------------------------------------------------------------------
	function check_data()
	{
		if (document.dataForm.title.value.length == 0)
			alert("訊息標題欄位不可以空白哦！");
		else dataForm.submit();
	}
    </script>
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
    <h1 align="center"><b>刪除公告欄訊息</b></h1>
    <form action="delete_message_confirm.php" method="post" name="dataForm">
      <table width="40%" align="center">
        <tr>
          <td> 
		    <div class="form-group">
              <h2>請輸入欲刪除的公告欄標題：</h2> 
              <input name="title" type="text" size="15" class="form-control" placeholder="Title">
			</div>
          </td>
        </tr>
        <tr>
          <td align="center"> 
			<div class="form-group">
				<div class="col-sm-offset-0 col-sm-20">
				<button type="button" onClick="check_data()" class="btn btn-primary"><label>提交</label></button>　 
				<button type="reset" class="btn btn-default"><label>重填</label></button>
				<br><br><br><br>
				<table border='3'  align='center' class = 'table table-striped' bordercolor='rhba(255,255,255,0)'>
					<tr class='info'> 
						<td colspan='2' align='center'> 
							<label><font size='5'>公告列表</font></label>
						</td>
					</tr> 
					<tr> 
						<td align='center'> 
							<label><font size='5'>日期</font></label>
						</td>
						<td align='center'>
							<label><font size='5'>標題</font></label>
						</td>
					</tr>
					<?php
						require_once("dbtools.inc.php");
					
						//建立資料庫連接
						$link = create_connection();
						
						mysqli_select_db($link, "bbq_database"); //選擇資料庫bbq_database
						
						$sql = "SELECT * FROM new_message";
						
						$result = mysqli_query($link,$sql); //執行SQL查詢
						
						$total_records = mysqli_num_rows($result);  // 取得資料表裡頭總共有幾筆資料
						
						for($i = 1; $i <= $total_records; $i++)
						{	
							$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
					
							echo "<tr><td align='center'><label><font size='5'>";
							echo $row{"date"};
							echo "</font></label></td><td align='center'><label><font size='5'>";
							echo $row{"title"};
							echo "</font></label></td></tr>";
						}
					?>
				</table>
				<br><br><br><br>
				<button type="button" class="btn btn-warning" OnClick='location.href="main.php"'><font size="5"><label>回管理頁面</label></font></button>
				</div>
			</div>
          </td>
        </tr>
	  </table>
    </form>
  </body>
</html>
