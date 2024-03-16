<?php
include "connect.php";
session_start();
$login = htmlspecialchars(trim($_POST['email']),ENT_QUOTES); //  htmlspecialchars- Преобразование специальных символов в HTML-сущности, trim убирает лишние пробелы
// $name = htmlspecialchars(trim($_POST['username']), ENT_QUOTES);
$password = htmlspecialchars(trim($_POST['password']),ENT_QUOTES); 
$result = "SELECT * FROM Users WHERE email = '$login' and `password` = '$password'";
$result1 = mysqli_query($con, $result);
$user1 = mysqli_fetch_assoc($result1); // Конвертируем в массив
if(is_null ($user1) ){//is_null — Проверяет, равно ли значение переменной null
	echo "Такой пользователь не найден.";
	exit();
}
else if(count($user1) == 1){
	echo "Логин или пароль введены неверно";
	exit();
}

$_SESSION["user"]= $user1['user_id'];//наименование, значение, срок действия, путь к дирректории

header('Location: page.php');
//mysql_fetch_array - это функция для построчного чтения полученного массива данных, возвращает ассоциативный массив где ключами являются поля таблицы Бд
///mysql_fetch_assoc -возвращает построчно ассоциативный одномерный массив 
// mysqli_fetch_all - вывод двумерного массива со всеми записями из последнего запроса, обращение по индексу