<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_SESSION['test'] == $_SERVER['REMOTE_ADDR']) {
    $name = $_POST['name'];
	$surname = $_POST['surname'];
	$email = $_POST['email'];
	$message = $_POST['message'];
	$_SESSION['error'] = '';
	$flag = true;
	$surname = clean($surname);
	$email = clean($email);
	$message = clean($message);
	if (!empty($name) && check_length($name, 2, 25))
		{
			$name = clean($name);
		}
	else
		{
			$flag = false;
			$_SESSION['error'] = 'Ошибка! Недопустимое значение в поле Имя';
		}
		if (!empty($surname) && check_length($surname, 2, 25))
		{
			$surname = clean($surname);
		}
	else
		{
			$flag = false;
			$_SESSION['error'] = "Ошибка! Недопустимое значение в поле Фамилия";
		}
	if (!empty($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
		{
	    	$email = clean($_POST["email"]);
	    }
	else 
		{
			$flag = false;
			$_SESSION['error'] = 'Ошибка! Недопустимое значение в поле Email';
		}
		if(!empty($message) && check_length($message, 2, 25))
		{
			$message = clean($message);
		}
	else
		{
			$flag = false; 
			$_SESSION['error'] = "Ошибка! Недопустимое значение в поле Сообщение";
		}
	if($flag == true)
		{
			$fp = fopen('file.txt', 'a+');
			fwrite($fp, $name . "\n");
			fwrite($fp, $surname . "\n");
			fwrite($fp, $email . "\n");
			fwrite($fp, $message . "\n");
			fwrite($fp, "\n");
			fclose($fp);
		}
	}
}
else {$_SESSION['message'] = 'Ошибка доступа';}
$back = $_SERVER['HTTP_REFERER'];
		echo "
		<html>
  		<head>
  		<meta http-equiv='Refresh' content='0; URL=".$_SERVER['HTTP_REFERER']."'>
  		</head>
		</html>";
function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    return $value;
}
function check_length($value = "", $min, $max) {
    $result = (mb_strlen($value) < $min || mb_strlen($value) > $max);
    return !$result;
}

?>