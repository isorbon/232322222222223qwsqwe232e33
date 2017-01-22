<?php
header('Content-Type: text/html;charset=utf-8');
ini_set('session.bug_compat_warn', 0);
ini_set('display_errors', 'Off');
$uploaddir = '../upload/';

  function info($a='info',$b='файл загружается')
  {
  echo "<p id='sj2' class='alert alert-$a text-center'>
$b
</p>
";
  }
info();  
  ?>
  <!DOCTYPE html>
<html>
<head>
  <title></title>
<meta charset="utf-8">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

</head>
<body>
	<?php
unlink($uploaddir."report.csv");   
  $myfile = fopen($uploaddir."report.csv", "a") or die("Unable to open file!");
include 'config.php';
$re=qwerty($connection,"SELECT distinct  u_date.street,u_date.house_number,u_date.apartment_number,users.id FROM  users JOIN u_date on users.ID = u_date.UID join uc on uc.id=users.id join ucd on ucd.id = uc.id");
    $i = 0;
  
      while($row=mysqli_fetch_array($re))
      {        

      fwrite($myfile, $row['street'].";".$row['house_number'].";".$row['apartment_number'].";".$row['id'].";");
      $re2=qwerty($connection,"SELECT uc.counters,uc.pokaz,ucd.pokaz as np FROM uc join ucd  on uc.id=ucd.id join users on uc.ID = users.ID
      WHERE uc.counters=ucd.counters and users.id= '".$row['id']."'");
      
      while($ro=mysqli_fetch_array($re2))
      {        
        fwrite($myfile, $ro['counters'].";".$ro['pokaz'].";".$ro['np'].";");
      }
        fwrite($myfile, "\n");
      $i++;
    }

fclose($myfile);
info('success','Файл загружен!!!');  
$upload=$uploaddir."report.csv";
echo "<p style='margin:20%' class='text-center'>
<a class='btn btn-primary' href='$upload' download>Скачать файл</a>
</p>
";
?>
</body>
</html>


