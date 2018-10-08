<?php
  require_once("dbtools.inc.php");
  header("Content-type: text/html; charset=utf-8");
	
  //取得表單資料
  $account = $_POST["account"]; 	
  $password = $_POST["password"];

  //建立資料連接
  $link = create_connection();
					
  //檢查帳號密碼是否正確
  $sql = "SELECT * FROM user Where id = '$account' AND password = '$password'";
  $result = execute_sql($link, "bbq_database", $sql);

  //如果帳號密碼錯誤
  if (mysqli_num_rows($result) == 0)
  {
	$sql = "SELECT * FROM user Where id = '$account'";
    $result = execute_sql($link, "bbq_database", $sql);
	
	if(mysqli_num_rows($result) == 0)
	{
		//釋放 $result 佔用的記憶體
		mysqli_free_result($result);
				
		//關閉資料連接	
		mysqli_close($link);
		
		echo "<script type='text/javascript'>";
		echo "alert('查無此帳號，請先加入會員，再做登入的動作');";
		echo "history.back()";
		echo "</script>";
	}
	else
	{
		$sql = "SELECT * FROM check_login_time Where account = '$account'";
		$result = execute_sql($link, "bbq_database", $sql);
		
		if(mysqli_num_rows($result) == 0)
		{
			$count = 1;
			
			$sql = "INSERT INTO check_login_time (account, count) 
				VALUES ('$account', '$count')";
				
			$result = execute_sql($link, "bbq_database", $sql);
			
			echo "<script type='text/javascript'>";
			echo "alert('帳號密碼錯誤，請查明後再登入');";
			echo "history.back()";
			echo "</script>";
		}
		else
		{
			$row = mysqli_fetch_assoc($result);
		
			$account = $row{"account"};
			$count = $row{"count"};
			$time = $row{"time"};
			
			if($count == 2)
			{
				@$time_hour = date (H); 
				@$time_min = date(i);
				$total = $time_hour*60 + $time_min;
				
				$sql = "UPDATE check_login_time SET time = '$total' WHERE account = '$account'";
				$result = execute_sql($link, "bbq_database", $sql);
			}
			
			if($count == 3)
			{	
				@$time_hour = date (H); 
				@$time_min = date(i);
				$total = $time_hour*60 + $time_min;
				
				if($time!=NULL)
				{
					if($total - $time == 60)
					{
						$count = 1;
				
						$sql = "UPDATE check_login_time SET time = '$total', count = '$count' WHERE account = '$account'";
						$result = execute_sql($link, "bbq_database", $sql);
						
						echo "<script type='text/javascript'>";
						echo "alert('帳號密碼錯誤，請查明後再登入');";
						echo "history.back()";
						echo "</script>";
					}
				}
				else
				{	
					$sql = "UPDATE check_login_time SET time = '$total' WHERE account = '$account'";
					$result = execute_sql($link, "bbq_database", $sql);
				}
							
				echo "<script type='text/javascript'>";
				echo "alert('帳號密碼錯誤次數超過3次，此帳號將被封鎖1小時');";
				echo "history.back()";
				echo "</script>";
			}
			else
			{
				$count++;
				
				$sql = "UPDATE check_login_time SET count = '$count' WHERE account = '$account'";
				$result = execute_sql($link, "bbq_database", $sql);
					
				//顯示訊息要求使用者輸入正確的帳號密碼
				echo "<script type='text/javascript'>";
				echo "alert('帳號密碼錯誤，請查明後再登入');";
				echo "history.back()";
				echo "</script>";
			}
		}
				
		//關閉資料連接	
		mysqli_close($link);
	}	
}
	
  //如果帳號密碼正確
  else
  {  
    //取得 id 欄位
    $id = mysqli_fetch_object($result)->id;
	
    //釋放 $result 佔用的記憶體	
    mysqli_free_result($result);
	
	$sql = "SELECT * FROM check_login_time Where account = '$account'";
	$result = execute_sql($link, "bbq_database", $sql);
	
	if(mysqli_num_rows($result) != 0)
	{
		$row = mysqli_fetch_assoc($result);
		
		$account = $row{"account"};
		$count = $row{"count"};
		$time = $row{"time"};
		
		if($count == 3)
		{
			@$time_hour = date (H); 
			@$time_min = date(i);
			$total = $time_hour*60 + $time_min;
			
			if($total - $time == 60)
			{
				$sql = "DELETE FROM check_login_time Where account = '$account'";
				$result = execute_sql($link, "bbq_database", $sql);
				
				//關閉資料連接	
				mysqli_close($link);

				//將使用者資料加入 cookies
				setcookie("id", $id);
				setcookie("passed", "TRUE");		
				header("location:main.php");
			}
			else
			{
				//關閉資料連接	
				mysqli_close($link);
				
				echo "<script type='text/javascript'>";
				echo "alert('帳號密碼錯誤次數超過3次，此帳號將被封鎖1小時');";
				echo "history.back()";
				echo "</script>";
			}
		}
		else
		{
			$sql = "DELETE FROM check_login_time Where account = '$account'";
			$result = execute_sql($link, "bbq_database", $sql);
			
			//關閉資料連接	
			mysqli_close($link);

			//將使用者資料加入 cookies
			setcookie("id", $id);
			setcookie("passed", "TRUE");		
			header("location:main.php");
		}
	}
	else
	{
		//關閉資料連接	
		mysqli_close($link);

		//將使用者資料加入 cookies
		setcookie("id", $id);
		setcookie("passed", "TRUE");		
		header("location:main.php");
	}
  }
?>
