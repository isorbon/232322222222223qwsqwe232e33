<?php

$hostname = "localhost";           //хост
$databasename = "altair";                   //имя базы
$username = "root";               //пользователь БД
$password = "";              //пароль пользователя БД
$login = "";
$sekretkey= "b963445ee9a60cf0fc19c87a3a5f82d";
//---------------------------------------------------------
$connection = mysqli_connect($hostname, $username, $password);
if (!$connection){
    die("Не удалось подключиться" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, $databasename);
mysql_query('SET NAMES utf8');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

function f_screening($text){
	$text = strip_tags($text); //убирает html теги
	$text = htmlspecialchars($text); // защита от xss
	$text = mysql_escape_string($text);
	$text = trim($text);
	return $text;
}

function insert($connection,$sql)
{
      if (mysqli_query($connection, $sql)) {
          } else 
          {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}
function qwerty($connection,$query)
{
   $re = mysqli_query($connection,$query) or trigger_error(mysqli_error().$query);
   return  $re;
}
