<?php
  require_once 'connect.php';

  // Определим собственный класс исключений для ошибок MySQL
  class MySQL_Exception extends Exception {
    public function __construct($message) {
      parent::__construct($message);
    }
  }
?>
<?php
header("Content-Type: text/html; charset=utf-8"); 
session_start();
$_SESSION['test'] = $_SERVER['REMOTE_ADDR']; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Валидация на стороне сервера</title>
	<meta charset="utf-8" />
	<link rel="stylesheet" href="CSS/style.css" />
</head>
<body>

	<header>
		<h2 class="center text">Контакты</h2>
		<p class="center">Внесите данные в текстовые поля</p>
	</header>
<form action="app/check.php" method="post" action="index.php">
<div class="center brd">

	<div>
		<label class="center">Имя 
			<ul class="center"><input name="name" type="text" class="pole" id="name" value="<?php echo $_SESSION['nameR']; $_SESSION['nameR'] = '';?>" placeholder="name" pattern="[A-Za-zА-Яа-я]{2,20}" required/></ul>
		</label>
	</div>
	<div>
		<label class="center">Фамилия
			<ul class="center"><input name="surname" type="text" class="pole" id="surname" value="<?php echo $_SESSION['surnameR']; $_SESSION['surnameR'] = '';?>" placeholder="surname" pattern="[A-Za-zА-Яа-я]{2,50}" required/></ul>
		</label>
	<div>
		<label class="center">Email
			<ul class="center"><input name="email" type="text" class="pole" id="email" value="<?php echo $_SESSION['emailR']; $_SESSION['emailR'] = '';?>" placeholder="Email" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" required/></ul>
		</label>
	</div>
	<div>
		<label class="center">Сообщение
			<ul class="center"><br /><textarea name="message" value="<?php echo $_SESSION['messageR']; $_SESSION['messageR'] = '';?>" class="pole" cols="25" rows="5" pattern="[A-Za-zА-Яа-я]{2,150}" required></textarea></ul>
		</label>
	</div>
<p><input type='submit' class="button center" value='Отправить'></p>
</div>
<br>
      <?php 
      echo $_SESSION['error'];
      $_SESSION['error'] = ''; 
      ?>
</form>
</body>
</html>