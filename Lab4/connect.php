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