<?php
  require_once '../connect.php';

  // Определим собственный класс исключений для ошибок MySQL
  class MySQL_Exception extends Exception {
    public function __construct($message) {
      parent::__construct($message);
    }
  }
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
	if (!empty($_POST["name"]) || preg_match("[A-Za-zА-Яа-я]{2,20}", $_POST["name"]))
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
		if (!empty($_POST["surname"]) || preg_match("[A-Za-zА-Яа-я]{2,20}", $_POST["surname"]))
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
	if (!empty($_POST["email"]) || preg_match("[A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8}", $_POST["email"]))  
	 {
        $email = substr($_POST["email"],0,32);
		$email = htmlspecialchars(stripslashes($email)); 
     }
	else 
		{
			$flag = false;
			$_SESSION['error'] = 'Ошибка! Недопустимое значение в поле Email';
		}
		if(!empty($_POST["message"]) || preg_match("[А-Я][а-я]{2,150}", $_POST["message"]))
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
	    	if(isset($_POST['go']))
	    	{
		      $named = $_POST['name'];
		      $surname = $_POST['surname'];
		      $email = $_POST['email'];
		      $message = $_POST['message'];
		      try {
		      $result1 = $link->query("INSERT INTO registration (name, surname, email, message, id) " .
		      "VALUES ('$named', '$surname', '$email', '$message', 'NULL')");
		        if (!$result1) throw new MySQL_Exception($link->error);
		      }
		       catch (Exception $ex) {
		       echo 'Ошибка при работе с MySQL: <b style="color:red;">'.$ex->getMessage().'</b>';
		      }
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

?>