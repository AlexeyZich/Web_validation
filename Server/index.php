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
			<ul class="center"><input name="name" type="text" class="pole" id="name" placeholder="name" pattern="[A-Za-zА-Яа-я]{2,20}" required/></ul>
		</label>
	</div>
	<div>
		<label class="center">Фамилия
			<ul class="center"><input name="surname" type="text" class="pole" id="surname" placeholder="surname" pattern="[A-Za-zА-Яа-я]{2,20}" required/></ul>
		</label>
	<div>
		<label class="center">Email
			<ul class="center"><input name="email" type="text" class="pole" id="email" placeholder="Email" pattern="([A-z0-9_.-]{1,})@([A-z0-9_.-]{1,}).([A-z]{2,8})" required/></ul>
		</label>
	</div>
	<div>
		<label class="center">Сообщение
			<ul class="center"><br /><textarea name="message" class="pole" cols="25" rows="5" pattern="[A-Za-zА-Яа-я]{2,150}" required></textarea></ul>
		</label>
	</div>
<p><input type='submit' class="button center" value='Отправить'></p>
</div>
</form>
</body>
</html>