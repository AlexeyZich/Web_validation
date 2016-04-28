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

<p>Имя: <input name="name" type="text"></p>

<p>Фамилия: <input name="surname" type="text"></p>

<p>E-mail: <input name="email" type="text"></p>

<p>Сообщение: <br /><textarea name="message" cols="30" rows="5"></textarea></p>

<p><input type='submit' value='Отправить'></p>

</form>
</body>
</html>