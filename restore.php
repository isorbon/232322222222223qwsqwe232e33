<?php
session_start();
header('Content-Type: text/html;charset=utf-8');
ini_set('session.bug_compat_warn', 0);
ini_set('display_errors', 'Off');
?>
<!doctype html>
<head>
<title>
Добавления администратора
</title>
<link href="styles/style.css" rel="stylesheet" type="text/css" />
<link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="styles/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />	
</head>
<body>

<?php
echo '<title>Форма добавления пользователя администратора</title>
<div class="login-page">
  	<div class="form">
  	<h4>
  	Добавления администратора
  	</h4>

		<form class="login-form" action="" method="post">
			<input  name="fio" placeholder="Ф.И.О." autofocus="" required="" type="text" size="50" maxlength="70" autocomplete="off"/>
			<input  name="login" placeholder="Логин" autofocus="" required="" type="text" size="6" maxlength="15" autocomplete="off"/>
			<input  name="password" type="password" placeholder="Пароль" size="10" required="" maxlength="15"/><br />
			<input  name="password2" type="password" placeholder="Повторите пароль" size="10" required="" maxlength="15"/><br />
			 <input  name="secret_key" type="password" placeholder="Введите секретный ключ для регистрации"  required="" /><br />
			<input class="a_submit" name="submit" type="submit" value="войти" />
	</form>
	</div>
	</div>
';
require 'blocks/moduls/config.php';
if(isset($_POST['login'])&&isset($_POST['password'])&&isset($_POST['fio'])&&isset($_POST['password2'])&&isset($_POST['secret_key']))
{
	$login = f_screening($_POST['login']);
	$password = f_screening($_POST['password']);
	$password2 = f_screening($_POST['password2']);
	$fio = f_screening($_POST['fio']);
	$skey = f_screening($_POST['secret_key']);
		$fmsg = "Не правильные данные:";
	if ($password==$password2&&strlen($fio)>4&&strlen($login)>=4&&strlen($password)>5 &&$skey==$sekretkey) 
	{
		insert($connection,"insert into admin(fio,login,password) values('$fio','$login','".md5(md5($password.$skey).reverse)."' )"); 
	echo "
		<script>
		alert(\"Получился!\");
		</script>";	
	
	}else
	{ 
		echo "
		<script>
		alert(\"Не правильные данные\");
		</script>";
		
	}
}
?>
</body>
</html>