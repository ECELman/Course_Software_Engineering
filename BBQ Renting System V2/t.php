<?php
				require_once("dbtools.inc.php");
				$link = create_connection();
				
				$sql = "SELECT * FROM new_message";
				$result = execute_sql($link, "bbq_database", $sql);
				
				if(mysqli_num_rows($result) != 0)
				{
					$num = mysqli_num_rows($result);
					$row = mysqli_fetch_assoc($result);
					
					for($i = 0; $i<$num; $i++)
					{	
						$title = $row{"title"};
						$message = $row{"message"};
						//$new = "<div class=\"grid-8\"><h3>" + $title + "</h3><hr/><p>" + $message + "</p></div><hr/>";
						
						echo $title." / ".$message;
						
						$result++;
						$row = mysqli_fetch_assoc($result);
					}
				}
?>