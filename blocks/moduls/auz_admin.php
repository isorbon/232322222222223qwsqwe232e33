<?php
if(isset($bmsg))
{ 
	echo "<div class=\"alert alert-danger\" style=\"text-align: center;\">$bmsg</div>";
}elseif (isset($gmsg)) {
 	echo "<div class=\"alert alert-danger\" style=\"text-align: center;\">$gmsg</div>";
}
echo '<title>Форма входа</title>
<div class="login-page">
  	<div class="form">
	<h2>Вход в панель администратора</h2>
	<form class="login-form" action="" method="post">
			<input  name="login" placeholder="Логин" autofocus="" required="" type="text" size="6" maxlength="15" autocomplete="off"/>
			<input  name="password" type="password" placeholder="Пароль" size="10" required="" maxlength="15"/><br />
			<input  name="password2" type="password" placeholder="Повторите пароль" size="10" required="" maxlength="15"/><br />
			<input class="a_submit" name="submit" type="submit" value="войти" />
	</form>
	</div>
	</div>
';
?>


