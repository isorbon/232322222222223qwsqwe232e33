<?php
session_start();
header('Content-Type: text/html;charset=utf-8');
ini_set('session.bug_compat_warn', 0);
ini_set('display_errors', 'Off');
?>
<!doctype html>
<head>
<title>
	Панель администратора
</title>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="styles/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />	
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php

function eror_sh()
{
	$bmsg = "Не правильные данные:";
	include_once('blocks/moduls/auz_admin.php');			
}
require 'blocks/moduls/config.php';
if(isset($_POST['login'])&&isset($_POST['password']))
{
	$login = f_screening($_POST['login']);
	$password = f_screening($_POST['password']);

				if($login != ""&& strlen(login)>= 4 && $password != "" )
				{
					$res =qwerty($connection,"SELECT * FROM admin WHERE login ='$login'"); 
					$myrow = mysqli_fetch_array($res);
					$count = mysqli_num_rows($res);
					if ($count == 1)
					{
						$password2=md5(md5($password.$sekretkey).reverse);
						
						$fio2=$myrow['fio'];	
						if ($myrow['password']==$password2) {
							$gmsg ="Добро пожаловать $fio2";
							$_SESSION['fio'] = $myrow['fio'];
							$_SESSION['login'] = $myrow['login'];

							include_once('blocks/moduls/admin_user.php');	
						}else{
						eror_sh();

						}
					
					}else{
				
						eror_sh();
					}


				}else
					{
						eror_sh();
					}
}else{
	if ($_SESSION['fio']!="" &&$_SESSION['login']!="") {
		include_once('blocks/moduls/admin_user.php');	
	}else	
	include_once('blocks/moduls/auz_admin.php');
}
?>
</body>
</html>


