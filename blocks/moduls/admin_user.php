<div style="margin-top: 4%; margin-left: 4%;margin-right: 4%;" class="page-content inset">

<!-- Button trigger modal -->
<p class="text-center">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Показать дополнительные функции
</button>
</p>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Дополнительные функции</h4>
      </div>
      <div class="modal-body">        
			<form enctype="multipart/form-data" action="blocks/moduls/upload.php" method="post">
			<label class="btn btn-primary btn-file">
			    Загрузка данных
			    <input type="file" name="uploadfile" accept=".csv" style="display: none;"><br> 
			</label>
			<a class="btn btn-primary" href="/blocks/moduls/download.php">
				Выгрузка данных
			</a>
				<input type="submit" value="Отправить на сервер"  class="btn btn-default btn-file"/>
		</form>
      </div>
      <div class="modal-footer">
        
      </div>
    </div>
  </div>
</div>

 <div class="row">
<table  class="table table-hover" style="background: white;">
  <thead>
  <tr>
    <th>Улица</th>
    <th>Номер</br> дома</th>
    <th>Номер</br>квартиры</th>
    <th>Лицевой </br>счет</th>
    <?php
		$i = 1;
  		while($i<7){			
			echo "<th><abbr title='Идентификатор счетчика: $i'>ID $i</abbr></th>			
			       <th><abbr title='Показания счетчика: $i'>P $i</abbr></th>
			       <th><abbr title='Показания счетчика настоящие: $i'>PR $i</abbr></th>";
			 $i++;
		}

    ?>
    
   </tr>
  </thead>
  <tbody>
<?php 
$re=qwerty($connection,"SELECT distinct  u_date.street,u_date.house_number,u_date.apartment_number,users.id FROM  users JOIN u_date on users.ID = u_date.UID join uc on uc.id=users.id join ucd on ucd.id = uc.id");
		$i = 0;
  		while($row=mysqli_fetch_array($re))
  		{
			echo "<tr><td><h5>".$row['street']."</h5></td>";
			echo "<td><h5>".$row['house_number']."</h5></td>";
			echo "<td><h5>".$row['apartment_number']."</h5></td>";
			echo "<td><h5>".$row['id']."</h5></td>";
			$re2=qwerty($connection,"SELECT uc.counters,uc.pokaz,ucd.pokaz as np FROM uc join ucd  on uc.id=ucd.id join users on uc.ID = users.ID
WHERE uc.counters=ucd.counters and users.id= '".$row['id']."'");
while($ro=mysqli_fetch_array($re2)){
			 			 
 echo "<td><h5>"
 			.$ro['counters']."
		</h5></td>";
		echo "<td><h5>"
 			.$ro['pokaz']."
		</h5></td>";
				echo "<td><h5>"
 			.$ro['np']."
		</h5></td>";
		
}
echo "</tr>";
			$i++;
		}
       ?>
      
  
  </tbody>
</table>
</div>
</div>







