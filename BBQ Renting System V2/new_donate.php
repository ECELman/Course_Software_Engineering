<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <title>會員贊助</title>
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
				<label><font size='5'>會員贊助</font></label>
			</td>
		</tr> 
	</table>
	<br></br>
		<?php
				require_once("dbtools.inc.php");
				$link = create_connection();
							
				$sql = "SELECT * FROM donate";
				$result = execute_sql($link, "bbq_database", $sql);
				
				if(mysqli_num_rows($result) != 0)
				{
					$num = mysqli_num_rows($result);
					$row = mysqli_fetch_assoc($result);
					
					for($i = 0; $i<$num; $i++)
					{	
						$name = $row{"name"};
						$money = $row{"money"};
						$date = $row{"date"};
						$new =  "<table border='3'  align='center' class = 'table table-striped' bordercolor='rhba(255,255,255,0)'>"
								.
								"<tr class='info'> 
									<td colspan='2' align='center'> 
										<label><font size='5'>會員 : ".$name."</font></label>
									</td>
								 </tr>
								"
								.
								"
									<td align='center' width=\"30%\">
										 <label><font size='5'>贊助日期 : ".$date."</font></label>
									</td>
									<td align='center'>
										 <label><font size='5'>贊助金額 : $".$money."</font></label>
									</td>
								 </tr>
							    "
								.
								"</table><br></br><br></br>";
						echo $new;
						
						$result++;
						$row = mysqli_fetch_assoc($result);
					}
				}
				else
				{
					$new =  "<table border='3'  align='center' class = 'table table-striped' bordercolor='rhba(255,255,255,0)'>"
								.
								"<tr class='info'> 
									<td colspan='2' align='center'> 
										<label><font size='5'>暫無新回饋</font></label>
									</td>
								 </tr>
								"
								.
								"</table><br></br><br></br>";
					echo $new;
				}
		?>
		<center><button type="button" class="btn btn-warning" OnClick='location.href="index_system_manager.html"'><font size="5"><label>回管理頁面</label></font></button></center>
  </body>
</html>