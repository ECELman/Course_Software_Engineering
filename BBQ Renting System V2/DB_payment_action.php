<?php
    //檢查 cookie 中的 passed 變數是否等於 TRUE
    $passed = $_COOKIE["passed"];

    /*  如果 cookie 中的 passed 變數不等於 TRUE，
    表示尚未登入網站，將使用者導向首頁 login.html */
    if ($passed != "TRUE")
    {
        header("location:login.html");
        exit();
    }
    else
    {
        require_once("dbtools.inc.php");
        $serial = $_POST["serial"];
        $over_day = $_POST["over"];
        $date = $_POST["date"];
        $bbq_cnt = $_POST["bbq_cnt"];
        $camp_cnt = $_POST["camp_cnt"];
        $show_cnt = $_POST["show_cnt"];
        $show_time = $_POST["show_time"];
        $price = $_POST["price"];
        header("Content-type: text/html; charset=utf-8");

        //建立資料連接
        $link = create_connection();
        //開始寫入資料庫
        //UPDATE receipt SET accept = 0 WHERE receipt_serial = 1; //recover
        $sql = "UPDATE receipt SET accept = 2 WHERE receipt_serial = ".$serial;
        $result = execute_sql($link, "bbq_database", $sql);
        if($over_day == 1)
        {
            $sql = "UPDATE receipt SET accept = 2 WHERE receipt_serial = ".($serial+1);
            $result = execute_sql($link, "bbq_database", $sql);
        }
?>
<?php
            # get user name
            $sql = "SELECT DISTINCT U.name, R.id FROM user U, receipt R Where U.id = R.id AND receipt_serial = ".$serial;
            $result = execute_sql($link, "bbq_database", $sql);
            $user = mysqli_fetch_array($result);
            if($bbq_cnt)
            {
                $sql = "SELECT DISTINCT time_interval FROM receipt R Where R.receipt_serial = ".$serial." AND receipt_no>=1 AND receipt_no<=12";
                $result = execute_sql($link, "bbq_database", $sql);
                $time = mysqli_fetch_array($result);
            }
			
			header("location:online_pay.html");
	}
?>

<?php
    //釋放資源及關閉資料連接
    mysqli_free_result($result);
    mysqli_close($link);
?>