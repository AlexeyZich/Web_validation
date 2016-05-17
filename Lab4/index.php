<?php
$nameErr = $surnameErr = $emailErr = $messageErr = "";
$name = $surname = $email = $message = "";
$dbservername = "localhost";
$dbusername = "root";
$dbpassword = "root";
$dbname = "lab4";
$isValid = 1;
session_start();
$conn = new mysqli($dbservername, $dbusername, $dbpassword, $dbname);
if ($conn->connect_error) {
    die("Ошибка соединения с БД: " . $conn->connect_error);
}
if (!isset($_SESSION['token'])) {
	$_SESSION['token'] = md5(uniqid(rand(), TRUE));
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST['token'] != $_SESSION['token']) {
		$isValid = 0;
	}
	if (empty($_POST["name"])) {
		$nameErr = "Укажите имя";
		$isValid = 0;
	} else {
		$name = validate($_POST["surname"]);
		if (strlen($name) > 60){
			$nameErr = "Превышен лимит";
			$isValid = 0;
		}
		if (!preg_match("/^[А-Я][а-я]*/", $name)) {
			$nameErr = "Неверный формат"; 
			$isValid = 0;
		}
	}
	if (empty($_POST["surname"])) {
		$surnameErr = "Укажите Фамилию";
		$isValid = 0;
	} else {
		$surname = validate($_POST["surname"]);
		if (strlen($surname) > 60){
			$surnameErr = "Превышен лимит";
			$isValid = 0;
		}
		if (!preg_match("/^[А-Я][а-я]*/", $surname)) {
			$surnameErr = "Неверный формат"; 
			$isValid = 0;
		}
	}
	if (empty($_POST["email"])) {
		$emailErr = "Укажите e-mail";
		$isValid = 0;
	} else {
		$email = validate($_POST["email"]);
		if (strlen($email) > 60) {
			$emailErr = "Превышен лимит";
			$isValid = 0;
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$emailErr = "Неверный формат"; 
			$isValid = 0;
		}
	}
	if (empty($_POST["message"])) {
		$messageErr = "Напишите отзыв";
		$isValid = 0;
	} else {
		$message = validate($_POST["message"]);
		if (strlen($message) > 500) {
			$messageErr = "Превышен лимит";
			$isValid = 0;
		}
	}
	if ($isValid) {
		$stmt = $conn->prepare("INSERT INTO registr (name, surname, email, message) VALUES (?, ?, ?, ?)");
		$stmt->bind_param("sss", $name, $surname, $email, $message);
		$stmt->execute();
	}
}
function validate($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
include('index.html');
$conn->close();
?>