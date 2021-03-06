<?php
    require_once("dbtools.inc.php");
	
	$account = $_POST["account"];
	$name = $_POST["name"];
	$identification = $_POST["identification"];
	$cellphone = $_POST["cellphone"]; 	
	$address = $_POST["address"];
	$email = $_POST["email"];
	$vat_number = $_POST["vat_number"];
		
    //建立資料連接
    $link = create_connection();
				
    //執行 SELECT 陳述式取得使用者資料
    $sql = "SELECT * FROM rent_person,user Where rent_person.id = '$account' AND user.id = '$account'";
    $result = execute_sql($link, "bbq_database", $sql);
	
	$row = mysqli_fetch_assoc($result); //將陣列以欄位名索引
	
	$temp_account = $row{"id"};
	$temp_name = $row{"name"};
	$temp_identification = $row{"identification"};
	$temp_cellphone = $row{"phone"};
	$temp_address = $row{"address"};
	$temp_email = $row{"mail"};
	$temp_vat_number = $row{"vat_number"};
	
	if($account == $temp_account &&
	   $name == $temp_name &&
	   $identification == $temp_identification &&
	   $cellphone == $temp_cellphone &&
	   $address == $temp_address &&
	   $email == $temp_email &&
	   $vat_number == $temp_vat_number)
	{
		setcookie("account", $account);
		header("location:account_result.php");
	}
	else
	{
		echo "<script type='text/javascript'>";
		echo "alert('身分驗證失敗，請確認所填寫資料正確');";
		echo "history.back()";
		echo "</script>";
	}
?>
<!doctype html>
<html>
  <head>
    <title>修改會員資料</title>
    <meta charset="utf-8">
    <script type="text/javascript">
	
		var MD5 = function (string) {

		   function RotateLeft(lValue, iShiftBits) {
				   return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits));
		   }

		   function AddUnsigned(lX,lY) {
				   var lX4,lY4,lX8,lY8,lResult;
				   lX8 = (lX & 0x80000000);
				   lY8 = (lY & 0x80000000);
				   lX4 = (lX & 0x40000000);
				   lY4 = (lY & 0x40000000);
				   lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF);
				   if (lX4 & lY4) {
						   return (lResult ^ 0x80000000 ^ lX8 ^ lY8);
				   }
				   if (lX4 | lY4) {
						   if (lResult & 0x40000000) {
								   return (lResult ^ 0xC0000000 ^ lX8 ^ lY8);
						   } else {
								   return (lResult ^ 0x40000000 ^ lX8 ^ lY8);
						   }
				   } else {
						   return (lResult ^ lX8 ^ lY8);
				   }
		   }

		   function F(x,y,z) { return (x & y) | ((~x) & z); }
		   function G(x,y,z) { return (x & z) | (y & (~z)); }
		   function H(x,y,z) { return (x ^ y ^ z); }
		   function I(x,y,z) { return (y ^ (x | (~z))); }

		   function FF(a,b,c,d,x,s,ac) {
				   a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac));
				   return AddUnsigned(RotateLeft(a, s), b);
		   };

		   function GG(a,b,c,d,x,s,ac) {
				   a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac));
				   return AddUnsigned(RotateLeft(a, s), b);
		   };

		   function HH(a,b,c,d,x,s,ac) {
				   a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac));
				   return AddUnsigned(RotateLeft(a, s), b);
		   };

		   function II(a,b,c,d,x,s,ac) {
				   a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac));
				   return AddUnsigned(RotateLeft(a, s), b);
		   };

		   function ConvertToWordArray(string) {
				   var lWordCount;
				   var lMessageLength = string.length;
				   var lNumberOfWords_temp1=lMessageLength + 8;
				   var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64;
				   var lNumberOfWords = (lNumberOfWords_temp2+1)*16;
				   var lWordArray=Array(lNumberOfWords-1);
				   var lBytePosition = 0;
				   var lByteCount = 0;
				   while ( lByteCount < lMessageLength ) {
						   lWordCount = (lByteCount-(lByteCount % 4))/4;
						   lBytePosition = (lByteCount % 4)*8;
						   lWordArray[lWordCount] = (lWordArray[lWordCount] | (string.charCodeAt(lByteCount)<<lBytePosition));
						   lByteCount++;
				   }
				   lWordCount = (lByteCount-(lByteCount % 4))/4;
				   lBytePosition = (lByteCount % 4)*8;
				   lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition);
				   lWordArray[lNumberOfWords-2] = lMessageLength<<3;
				   lWordArray[lNumberOfWords-1] = lMessageLength>>>29;
				   return lWordArray;
		   };

		   function WordToHex(lValue) {
				   var WordToHexValue="",WordToHexValue_temp="",lByte,lCount;
				   for (lCount = 0;lCount<=3;lCount++) {
						   lByte = (lValue>>>(lCount*8)) & 255;
						   WordToHexValue_temp = "0" + lByte.toString(16);
						   WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2);
				   }
				   return WordToHexValue;
		   };

		   function Utf8Encode(string) {
				   string = string.replace(/\r\n/g,"\n");
				   var utftext = "";

				   for (var n = 0; n < string.length; n++) {

						   var c = string.charCodeAt(n);

						   if (c < 128) {
								   utftext += String.fromCharCode(c);
						   }
						   else if((c > 127) && (c < 2048)) {
								   utftext += String.fromCharCode((c >> 6) | 192);
								   utftext += String.fromCharCode((c & 63) | 128);
						   }
						   else {
								   utftext += String.fromCharCode((c >> 12) | 224);
								   utftext += String.fromCharCode(((c >> 6) & 63) | 128);
								   utftext += String.fromCharCode((c & 63) | 128);
						   }

				   }

				   return utftext;
		   };

		   var x=Array();
		   var k,AA,BB,CC,DD,a,b,c,d;
		   var S11=7, S12=12, S13=17, S14=22;
		   var S21=5, S22=9 , S23=14, S24=20;
		   var S31=4, S32=11, S33=16, S34=23;
		   var S41=6, S42=10, S43=15, S44=21;

		   string = Utf8Encode(string);

		   x = ConvertToWordArray(string);

		   a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476;

		   for (k=0;k<x.length;k+=16) {
				   AA=a; BB=b; CC=c; DD=d;
				   a=FF(a,b,c,d,x[k+0], S11,0xD76AA478);
				   d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756);
				   c=FF(c,d,a,b,x[k+2], S13,0x242070DB);
				   b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE);
				   a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF);
				   d=FF(d,a,b,c,x[k+5], S12,0x4787C62A);
				   c=FF(c,d,a,b,x[k+6], S13,0xA8304613);
				   b=FF(b,c,d,a,x[k+7], S14,0xFD469501);
				   a=FF(a,b,c,d,x[k+8], S11,0x698098D8);
				   d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF);
				   c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1);
				   b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE);
				   a=FF(a,b,c,d,x[k+12],S11,0x6B901122);
				   d=FF(d,a,b,c,x[k+13],S12,0xFD987193);
				   c=FF(c,d,a,b,x[k+14],S13,0xA679438E);
				   b=FF(b,c,d,a,x[k+15],S14,0x49B40821);
				   a=GG(a,b,c,d,x[k+1], S21,0xF61E2562);
				   d=GG(d,a,b,c,x[k+6], S22,0xC040B340);
				   c=GG(c,d,a,b,x[k+11],S23,0x265E5A51);
				   b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA);
				   a=GG(a,b,c,d,x[k+5], S21,0xD62F105D);
				   d=GG(d,a,b,c,x[k+10],S22,0x2441453);
				   c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681);
				   b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8);
				   a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6);
				   d=GG(d,a,b,c,x[k+14],S22,0xC33707D6);
				   c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87);
				   b=GG(b,c,d,a,x[k+8], S24,0x455A14ED);
				   a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905);
				   d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8);
				   c=GG(c,d,a,b,x[k+7], S23,0x676F02D9);
				   b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A);
				   a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942);
				   d=HH(d,a,b,c,x[k+8], S32,0x8771F681);
				   c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122);
				   b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C);
				   a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44);
				   d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9);
				   c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60);
				   b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70);
				   a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6);
				   d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA);
				   c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085);
				   b=HH(b,c,d,a,x[k+6], S34,0x4881D05);
				   a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039);
				   d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5);
				   c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8);
				   b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665);
				   a=II(a,b,c,d,x[k+0], S41,0xF4292244);
				   d=II(d,a,b,c,x[k+7], S42,0x432AFF97);
				   c=II(c,d,a,b,x[k+14],S43,0xAB9423A7);
				   b=II(b,c,d,a,x[k+5], S44,0xFC93A039);
				   a=II(a,b,c,d,x[k+12],S41,0x655B59C3);
				   d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92);
				   c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D);
				   b=II(b,c,d,a,x[k+1], S44,0x85845DD1);
				   a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F);
				   d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0);
				   c=II(c,d,a,b,x[k+6], S43,0xA3014314);
				   b=II(b,c,d,a,x[k+13],S44,0x4E0811A1);
				   a=II(a,b,c,d,x[k+4], S41,0xF7537E82);
				   d=II(d,a,b,c,x[k+11],S42,0xBD3AF235);
				   c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB);
				   b=II(b,c,d,a,x[k+9], S44,0xEB86D391);
				   a=AddUnsigned(a,AA);
				   b=AddUnsigned(b,BB);
				   c=AddUnsigned(c,CC);
				   d=AddUnsigned(d,DD);
				}

			var temp = WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);

			return temp.toLowerCase();
		}
	
      function check_data()
      {
        if (document.dataForm.password.value != document.dataForm.re_password.value)
        {
          alert("「密碼確認」欄位與「使用者密碼」欄位一定要相同...");
          return false;
        }
        if (document.dataForm.name.value.length == 0)
        {
          alert("您一定要留下真實姓名哦！");
          return false;
        }
		if (document.dataForm.cellphone.value.length != 0 && (document.dataForm.cellphone.value.length > 10 || document.dataForm.cellphone.value.length < 10))
        {
          alert("您的行動電話格式輸入錯誤，請輸入確切的10碼!");
          return false;
        }
		if (document.dataForm.cellphone.value.length == 0)
        {
          alert("「電話」欄位忘了填哦...");
          return false;
        }
		if (document.dataForm.email.value.length == 0)
        {
          alert("「E-mail」欄位忘了填哦...");
          return false;
        }
		if (document.dataForm.vat_number.value.length != 0 && document.dataForm.vat_number.value != "No" && (document.dataForm.vat_number.value.length > 8 || document.dataForm.vat_number.value.length < 8))
        {
          alert("您的統一編號格式錯誤，請確切輸入8碼！");
          return false;
        }
		if (document.dataForm.address.value.length == 0)
        {
          document.dataForm.address.value = "No";
        }
		if (document.dataForm.vat_number.value.length == 0)
        {
          document.dataForm.vat_number.value = "No";
        }
		if (document.dataForm.password.value.length == 0)
        {
			document.dataForm.password.value = "No";
        }
		if(document.dataForm.password.value != "No")
		{
			document.dataForm.password.value = MD5(document.dataForm.password.value);
		}
		
        dataForm.submit();					
      }
    </script>			
  </head>
  <body cellpadding="100">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style type="text/css"> 
	body
	{
		background-color:rgba(255,255,255,0.8);
		background-image: url("bbq.jpg");
		background-blend-mode: lighten;
		margin-bottom: 100px;
		margin-right: 350px;
		margin-left: 350px;
	}
	</style>
	<p align="center" ><b><font size="8">會員資料修改</font></b></p>
    <form  class="form-inline" name="dataForm" method="post" action="DB_update.php" >
      <table border="3"  align="center" class = "table table-striped" bordercolor="rhba(255,255,255,0)">
        <tr class="info"> 
          <td colspan="2" bgcolor="#6666FF" align="center"> 
            <font size="5">請填入下列資料 (標示「*」欄位請務必填寫)</font>
          </td>
        </tr>
        <tr bgcolor="#99FF99"> 
			<div class="form-group">
				<td align="left"><label>*使用者帳號：</label></td>
				<?php 
					echo "<td><input type=\"text\" name = \"account\" class=\"form-control\" value = ";
				    echo $account;
					echo " placeholder=\"account\" size=\"20\" readonly>(請使用英文或數字鍵)</td>";
			    ?>
			</div>
        </tr>
        <tr bgcolor="#99FF99"> 
			<div class="form-group">
				<td align="left"><label>*使用者密碼：</label></td>
				<?php 
					echo "<td><input type=\"password\" name = \"password\" class=\"form-control\"";
					echo " placeholder=\"password\" size=\"20\">(請使用英文或數字鍵)</td>";
			    ?>
			</div>
        </tr>
        <tr bgcolor="#99FF99"> 
			<div class="form-group">
				<td align="left"><label>*密碼確認：</label></td>
				<?php
					echo "<td><input type=\"password\" name = \"re_password\" class=\"form-control\"";
					echo " placeholder=\"password\" size=\"20\">(再輸入一次密碼，並記下您的使用者名稱與密碼)</td>";
			    ?>
			</div>
        </tr>
        <tr bgcolor="#99FF99"> 
			<div class="form-group">
				<td align="left"><label>*姓名：</label></td>
				<?php
					echo "<td><input type=\"text\" name = \"name\" class=\"form-control\" value = ";
				    echo $name;
					echo " placeholder=\"姓名\" size=\"8\"></td>";
			    ?>
			</div>
        </tr>
        <tr bgcolor="#99FF99"> 
			<div class="form-group">
				<td align="left"><label>*身份：</label></td>
				<td> 
				<?php
					if($identification == 0)
					{
						echo "<input type=\"radio\" name=\"identification\" value=\"0\" checked>校內人士";
						echo "<input type=\"radio\" name=\"identification\" value=\"1\">校外人士";
					}
					else
					{
						echo "<input type=\"radio\" name=\"identification\" value=\"0\" >校內人士";
						echo "<input type=\"radio\" name=\"identification\" value=\"1\" checked>校外人士";
					}
			    ?>					
				</td>
			</div>
        </tr>
        <tr bgcolor="#99FF99"> 
			<div class="form-group">
				<td align="left"><label>*行動電話：</label></td>
				<?php
					echo "<td><input type=\"text\" name = \"cellphone\" class=\"form-control\" value = ";
				    echo $cellphone;
					echo " size=\"20\"></td>";
			    ?>
			</div>
        </tr>
        <tr bgcolor="#99FF99"> 
			<div class="form-group">
				<td align="left"><label>地址：</label></td>
				<?php
					echo "<td><input type=\"text\" name = \"address\" class=\"form-control\" value = ";
				    echo $address;
					echo " size=\"45\"></td>";
			    ?>
			</div>
		</tr>
        <tr bgcolor="#99FF99"> 
			<div class="form-group">
				<td align="left"><label>*E-mail：</label></td>
				<?php
					echo "<td><input type=\"text\" name = \"email\" class=\"form-control\" value = ";
				    echo $email;
					echo " size=\"30\"></td>";
			    ?>
			</div>
		</tr>
		<tr bgcolor="#99FF99"> 
			<div class="form-group">
				<td align="left"><label>統一編號：</label></td>
				<?php
					echo "<td><input type=\"text\" name = \"vat_number\" class=\"form-control\" value = ";
				    echo $vat_number;
					echo " size=\"20\"></td>";
			    ?>
			</div>
		</tr>
        <tr bgcolor="#99FF99"> 
          <td colspan="2" align="CENTER"> 
			<div class="form-group">
				<div class="col-sm-offset-0 col-sm-20">
					<button type="button" class="btn btn-primary" onClick="check_data()">修改資料</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="reset" class="btn btn-default">重新填寫</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<button type="button" class="btn btn-default" onClick='location.href="DB_select_person.php"'>取消修改</button>
				</div>
			</div>
          </td>
        </tr>
      </table>
    </form>
  </body>
</html>
<?php
    //釋放資源及關閉資料連接
    mysqli_free_result($result);
    mysqli_close($link);
?>