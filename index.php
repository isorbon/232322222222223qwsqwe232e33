<?php
session_start();
header('Content-Type: text/html;charset=utf-8');
ini_set('session.bug_compat_warn', 0);
ini_set('display_errors', 'Off');
?>
<!doctype html>
<head>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="styles/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />	
<meta charset="utf-8">
</head>
<body>
<?php
require 'blocks/moduls/config.php';
if(isset($_POST['submit']))if(f_screening($_POST['submit']) == 'закончить'){
	$_SESSION['ID'] = "";
	$_SESSION['house_number'] = "";
	$_SESSION['apartment_number'] = "";		
 }
if(isset($_POST['ID'])&&isset($_POST['house_number'])&&isset($_POST['apartment_number']))
{
	$ID = f_screening($_POST['ID']);
	$house_number = f_screening($_POST['house_number']);
	$apartment_number = f_screening($_POST['apartment_number']);    
				if(f_screening($_POST['ID']) != ""&& strlen(f_screening($_POST['ID']))==6 && $house_number !=""&&$apartment_number!="")
				{
		 			$res =qwerty($connection, "SELECT ID FROM users WHERE ID='$ID'");
		 			$myrow = mysqli_fetch_array($res);
					$count = mysqli_num_rows($res);
					if ($count == 1)
					{
						$_SESSION['ID'] = $myrow['ID'];
						$res =qwerty($connection, "SELECT * FROM u_date WHERE UID = '$ID' and apartment_number = '$apartment_number' and house_number = '$house_number'");
						$myrow = mysqli_fetch_array($res);
						$count = mysqli_num_rows($res);
						if ($count==1) {
							$_SESSION['house_number'] = $myrow['house_number'];
							$_SESSION['apartment_number'] = $myrow['apartment_number'];		
							$_SESSION['street'] = $myrow['street'];									
							$gmsg = "Добро пожаловать.";
							include('blocks/moduls/user.php');
						}else{
							$bmsg = "Не правильные данные.";
							include_once('blocks/moduls/auz_form.php');
						}

					}else
					{
						$bmsg = "Не правильные данные.";
						include_once('blocks/moduls/auz_form.php');
					}
					
				}else{
						$bmsg = "Не правильные данные.";
						include_once('blocks/moduls/auz_form.php');
				}			

}else
{
	if ($_SESSION['house_number']!="" &&$_SESSION['apartment_number']!=""&&$_SESSION['ID']!="")
	 {

		include_once('blocks/moduls/user.php');

	}else{
		include_once('blocks/moduls/auz_form.php');	
	}	
	
}

?>
</body>
</html>


