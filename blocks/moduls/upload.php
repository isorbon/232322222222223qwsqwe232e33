<?php 
header('Content-Type: text/html;charset=utf-8');
ini_set('session.bug_compat_warn', 0);
ini_set('display_errors', 'Off');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
   <title>
    Загрузка файла
  </title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> 
</head>
<body>
<?php 
require 'config.php';
$uploaddir = '../upload/';
if (isset($_FILES['uploadfile']['name'])) 
{
	$mimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
if(in_array($_FILES['file']['type'],$mimes))
{
  $uploadfile = $uploaddir.basename($_FILES['uploadfile']['name']);
  if (copy($_FILES['uploadfile']['tmp_name'], $uploadfile))
  {
   $bmsg="Файл успешно загружен на сервер";
      echo "<div class=\"alert  alert-success\" style=\"text-align: center;\">$bmsg</div>";
  $count=file($uploadfile);
  $co=count($count);
  foreach( $count as $key=>$value)
  {
      $count[$key] = iconv("WINDOWS-1251", "UTF-8", $value);
  }
   $bmsg="Подождите идет Загрузка данных в бд";
  echo "<div class=\"alert  alert-info\" style=\"text-align: center;\">$bmsg</div>";
for($i = 1; $i <=$co; $i++)
  {
  
  $result = csv($i,$count);  
  $ID=$result[3];
  $streat=$result[0];
  $house=$result[1];
  $apartment=$result[2];
  $sql="insert into users(ID) values ('$ID')";
  insert($connection,$sql);
  insert($connection,"insert into u_date(UID,street,house_number,apartment_number) values('$ID','$streat','$house','$apartment')");
  for($b = 4; $b <=count($result); $b+=2)
  {
    $t=$result[$b];
    $tp=($result[$b+1]);    
    if (strlen($t)>0&&$tp>0) {
    insert($connection,"insert into uc(ID,counters,pokaz) values('$ID','$t',$tp)");
    }
      
  }
  unlink($uploadfile);
  $bmsg="Все загружен!";
  echo "<div class=\"alert  alert-success\" style=\"text-align: center;\">$bmsg</div>";
}
  }

  else { 
  	$bmsg="Ошибка! Не удалось загрузить файл на сервер!";
  echo "<div class=\"alert alert-danger\" style=\"text-align: center;\">$bmsg</div>";
   exit; 
  }
}
} else {
		$bmsg="Ошибка! Не удалось загрузить файл на сервер!";
   echo "<div class=\"alert alert-danger\" style=\"text-align: center;\">$bmsg</div>";
  die();
}

  function csv($lines,$csv_lines)
  {
   if(is_array($csv_lines))
  {
     for($i = 0; $i < $lines; $i++)
    {
      $line = $csv_lines[$i];
      $line = trim($line);

      $first_char = true;

      $col_num = 0;
      $length = strlen($line);

      for($b = 0; $b < $length; $b++)
      {

        if($skip_char != true)
        {

          $process = true;

          if($first_char == true)
          {
            if($line[$b] == '"')
            {
              $terminator = '";';
              $process = false;
            }
            else
              $terminator = ';';
            $first_char = false;
          }


          if($line[$b] == '"')
          {
            $next_char = $line[$b + 1];

            if($next_char == '"')
              $skip_char = true;

            elseif($next_char == ';')
            {
              if($terminator == '";')
              {
                $first_char = true;
                $process = false;
                $skip_char = true;
              }
            }
          }


          if($process == true)
          {
            if($line[$b] == ';')
            {
               if($terminator == ';')
               {

                  $first_char = true;
                  $process = false;
               }
            }
          }

          if($process == true)
            $column .= $line[$b];

          if($b == ($length - 1))
          {
            $first_char = true;
          }

          if($first_char == true)
          {

            $values[$col_num] = $column;
            $column = '';
            $col_num++;
          }
        }
        else
          $skip_char = false;
      }
    }
  }
    return $values;
}
?>
</body>
</html>


