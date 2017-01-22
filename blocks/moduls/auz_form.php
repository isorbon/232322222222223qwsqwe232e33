<?php
if(isset($bmsg))
{ 
	echo "<div class=\"alert alert-danger\" style=\"text-align: center;\">$bmsg</div>";
}
if (isset($gmsg)) {
 	echo "<div class=\"alert alert-danger\" style=\"text-align: center;\">$gmsg</div>";
}

echo '<title>Форма входа</title>
<div class="login-page">
  	<div class="form">
	<h2>Личный кабинет потребителя</h2>
	<form class="login-form" action="" method="post">
			<input  name="ID" placeholder="Лицевой счет" autofocus="" required="" type="text" size="6" maxlength="6" autocomplete="off"/>
			<input  name="house_number" type="text" placeholder="Номер дома" size="5" required="" maxlength="5"/><br />
			<input  name="apartment_number" type="text" placeholder="Номер квартиры" size="4" required="" maxlength="4"/><br />
			<input class="a_submit" name="submit" type="submit" value="войти" />
	</form>
	</div>
	</div>
';
?>


