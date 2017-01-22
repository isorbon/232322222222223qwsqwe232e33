<?php
if(isset($bmsg))
{ 
	echo "<div class=\"alert alert-danger\" style=\"text-align: center;\">$bmsg</div>";
}elseif (isset($gmsg)) {
 	echo "<div class=\"alert alert-danger\" style=\"text-align: center;\">$gmsg</div>";
}

$qw2="SELECT uc.counters,uc.pokaz,ucd.pokaz as np FROM uc join ucd  on uc.id=ucd.id join users on uc.ID = users.ID
WHERE uc.counters=ucd.counters and users.id= '".f_screening($_SESSION['ID'])."'";
$qw="SELECT uc.counters, uc.pokaz from users JOIN uc on users.id=uc.ID WHERE uc.ID= '".f_screening($_SESSION['ID'])."'";
$result = array();
$re=qwerty($connection,$qw);
		$count = mysqli_num_rows($re);		
		$i = 0;
  		while($row=mysqli_fetch_array($re)){
			 $result[$i] = array ($row['counters'],$row['pokaz']);
			 $i++;
		}
		$reski = array();
		$re=qwerty($connection,$qw2);
		$count2 = mysqli_num_rows($re);		
	if ($count2>0) 
	{		
		
		$i = 0;
  		while($row=mysqli_fetch_array($re)){
			 $reski[$i] = array($row['counters'],$row['pokaz'],$row['np']);
			 $i++;
		}
	}	
echo '
<div  style="margin-left:20%;margin-right:20%;margin-top:7%;margin-bottom:7%; background:white;border-radius: 5px;">
<div class="row">
	<title>Форма входа</title>
	<h2 class="text-center" >Личный кабинет потребителя</h2>
	<h4 class="text-center" >';
	echo "Адресс: ".$_SESSION['street']." д.".$_SESSION['house_number']." к.".$_SESSION['apartment_number'];
	echo '</h4>

		<form action="" method="post" style="padding: 40px">
		<input id="log" name="fio" placeholder="Ф.И.О" autofocus="" required="true" type="text" autocomplete="off"
			 class="form-control" />
			<br />
			<abbr title="Номер телефона">
			<input class="form-control" type="tel" name="tel_number"  pattern = "+7[0-9]{3}-[0-9]{2}-[0-9]{2}" placeholder="+79123-45-67">
			</abbr>
			<br />
			<input id="pass" name="email" class="form-control" type="email" placeholder="@MAIL адресс" size="50"  maxlength="51"/><br />
			<p>
			<h4 class="text-center" >
			Показания приборов учета
			</h4>
			</p>			
			<table  class="table table-bordered">
			<thead>
			<tr>
			<th>
			<abbr title="идентификатор счетчика">
			ID счетчика
			</abbr>
			</th>
			<th>
			<abbr title="Последний платеж">
			предыдущие показания
			</abbr>			
			</th>
			<th>
			Настоящие показания
			</th>
			</tr>
			</thead>
			<tbody>
			';
			for ($i=0; $i <$count; $i++) { 
				echo '
				<tr>
        <td>
          <h5>';
         echo $result[$i][0];
					    
echo '
              </h5>
        </td>';

				echo '
        <td>
          <h5>';
          if ($count2>0) {
             echo 	$reski[$i][2];
          }else

         echo $result[$i][1];
					    
echo '
              </h5>
        </td>';
        echo "
        <td>
            <h5>
          	<input type='number' name='id$i'>
            </h5>
          </td>
          </tr>";
        }
         echo '
        
			</tbody>
		</table>
		';
		echo '
			<input type="checkbox" name="your-g" value="unit-in-group" required/>
			<label for="your-g" class="text-center" >
			<abbr title="Согласие на передачу информации в электронной форме уведомления, в том числе персональных данных по открытым каналам связи сети интернет"> 
			Согласие на передачу информации в электронной форме уведомления...
			</abbr>
			</label>
			<br/>
			<div class=" text-center">
			<input class="btn btn-primary"  name="submit" type="submit" value="Передать показания" />
			</div>
	</form>
</div>	
</div>
';
if(isset($_POST['tel_number'])&&isset($_POST['email'])&&isset($_POST['fio']))
{
	$tel_number = f_screening($_POST['tel_number']);
	$email = f_screening($_POST['email']);
	$fio = f_screening($_POST['fio']);
	insert($connection,"update users set telephone = $tel_number WHERE ID = '".f_screening($_SESSION['ID'])."'");
	insert($connection,"update users set email= '$email' WHERE ID = '".f_screening($_SESSION['ID'])."'");
	insert($connection,"update users set fio= '$fio' WHERE ID = '".f_screening($_SESSION['ID'])."'");		
	$c1 = mysqli_num_rows(qwerty($connection,$qw2));		
if ($c1>0) {
	insert($connection,"delete from ucd where id= '".f_screening($_SESSION['ID'])."'");
}
	$re=qwerty($connection,$qw);
	$i=0;
	while($row=mysqli_fetch_array($re))
	{
			insert($connection,"insert into ucd(ID, counters, pokaz) values('".f_screening($_SESSION['ID'])."','".f_screening($row['counters'])."',".f_screening($_POST["id$i"]).")");
			$i++;
	}
echo "
<scrypt>alert('Система принял ваши данные!!!');
//document.getElementById('gud').submit();
</script>
";	
}
?>
</body>
</html>


