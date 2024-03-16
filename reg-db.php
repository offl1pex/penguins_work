<?php 
include "connect.php";

$login = htmlspecialchars(trim($_POST['email']),ENT_QUOTES); // Удаляет все лишнее и записываем значение в переменную //$login
$name = htmlspecialchars(trim($_POST['username']), ENT_QUOTES);
$pass = htmlspecialchars(trim($_POST['password']),ENT_QUOTES); 
if(mb_strlen($login) < 5 || mb_strlen($login) > 100){//mb_strlen — Получает длину строки
	echo "Недопустимая длина логина";
	exit();
}
$result1 = mysqli_query($con,"SELECT * FROM `users` WHERE `email` = '$login'");
$result2 = mysqli_query($con,"SELECT * FROM `users` WHERE `username` = '$name'");
$user1 = mysqli_fetch_assoc($result1); // Конвертируем в массив
$user2 = mysqli_fetch_assoc($result2); // Конвертируем в массив
if(!empty($user1)){//empty — Проверяет, пуста ли переменная
	echo "Данная почта уже используется!";
	exit();
}
if(!empty($user2)){//empty — Проверяет, пуста ли переменная
	echo "Данный логин уже используется!";
	exit();
}
$insert = mysqli_query($con,"INSERT INTO `users` (`username`, `password`, `email`)VALUES('$name', '$pass','$login' )");
$_SESSION["user_id"] = mysqli_insert_id($con);
header('Location: auto.php');
