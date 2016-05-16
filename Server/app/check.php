<?php
header("Content-Type: text/html; charset=utf-8");
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if ($_SESSION['test'] == $_SERVER['REMOTE_ADDR']) {
    $name = $surname = $email = $message = '';
	$_SESSION['nameR'] = $_POST["name"];
	$_SESSION['surnameR'] = $_POST["surname"];
	$_SESSION['emailR'] = $_POST["email"];
	$_SESSION['messageR'] = $_POST["message"];
	$_SESSION['error'] = '';
	$flag = true;
	if (!empty($_POST["name"]) && check_length($name, 2, 20))
		{
			$name = clean($_POST['name']);
		}
	else
		{
			$flag = false;
			$_SESSION['error'] = 'Ошибка! Недопустимое значение в поле Имя';
		}
		if (!empty($_POST["surname"]) && check_length($surname, 2, 50))
		{
			$surname = clean($_POST['surname']);
		}
	else
		{
			$flag = false;
			$_SESSION['error'] = "Ошибка! Недопустимое значение в поле Фамилия".$_POST["surname"];
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
		if(empty($message) || check_length($message, 2, 150))
		{
			$message = $_POST['message'];
		}
	else
		{
			$flag = false; 
			$_SESSION['error'] = "Ошибка! Недопустимое значение в поле Сообщение";
		}
	if($flag == true)
		{
			$_SESSION['error'] = 'Благодарим за регистрацию!'; 
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
else {$_SESSION['error'] = 'Ошибка доступа';}
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
    return $result;
}
?>