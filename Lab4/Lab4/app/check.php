<?php
	error_reporting(0);
	$db_host = 'localhost';
	$db_user = 'root';
	$db_password = 'root';
	$db_name = 'lab4';
	
	$link = mysqli_connect($db_host, $db_user, $db_password, $db_name);
	if (!$link) {
    	die('<p style="color:red">'.mysqli_connect_errno().' - '.mysqli_connect_error().'</p>');
	}
		mysqli_query($link, "SET NAMES utf8");
		
	echo "<p>Успешное подключение!</p>";
header("Content-Type: text/html; charset=utf-8");
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $surname = $email = $message = '';
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email =  $_POST["email"];
    $message = $_POST["message"];
	$_SESSION['nameR'] = $_POST["name"];
	$_SESSION['surnameR'] = $_POST["surname"];
	$_SESSION['emailR'] = $_POST["email"];
	$_SESSION['messageR'] = $_POST["message"];
	$_SESSION['error'] = '';
	$flag = true;
	if (preg_match("[A-Za-zА-Яа-я]{2,20}", $_POST["name"]))
		{
			$name = substr($_POST["name"],2,20);
			$name = trim($_POST["name"]);
			$name = htmlspecialchars(stripslashes($name));
		}
	else
		{
			$flag = false;
			$_SESSION['error'] = 'Ошибка! Недопустимое значение в поле Имя';
		}
		if (preg_match("[A-Za-zА-Яа-я]{2,20}", $_POST["surname"]))
		{
			$surname = substr($_POST["surname"],2,20);
			$surname = trim($_POST["surname"]);
			$surname = htmlspecialchars(stripslashes($surname));
    	}
	else
		{
			$flag = false;
			$_SESSION['error'] = "Ошибка! Недопустимое значение в поле Фамилия";
		}
	if (preg_match("[A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8}", $_POST["email"]))  
	 {
        $email = substr($_POST["email"],0,32);
		$email = htmlspecialchars(stripslashes($email)); 
     }
	else 
		{
			$flag = false;
			$_SESSION['error'] = 'Ошибка! Недопустимое значение в поле Email';
		}
		if(preg_match("[А-Я][а-я]{2,150}", $_POST["message"]))
		{
			$message = substr($_POST["message"],2,150);
			// $message = htmlspecialchars(stripslashes($message));
		}
		else
		{
			$flag = false; 
			$_SESSION['error'] = "Ошибка! Недопустимое значение в поле Сообщение";
		}
	if($flag == true)
		{
			$stmt = $link->prepare("INSERT INTO registration (name, surname, email, message) VALUES (?, ?, ?, ?)");
			$stmt->bind_param("ssss", $name, $surname, $email, $message);
			$stmt->execute();
		}
	
}
else {$_SESSION['error'] = 'Ошибка доступа';}
$back = $_SERVER['HTTP_REFERER'];
		echo "
		<html>
  		<head>
  		<meta http-equiv='Refresh' content='0; URL=".$_SERVER['HTTP_REFERER']."'>
  		</head>
		</html>";
?>