<?php
include "Connect.php";
$email = filter_var(trim($_POST['email']));
$pass = filter_var(trim($_POST['pass']));
$result = "SELECT * FROM `Users` WHERE `email` = '$email' and `pass` = '$pass'";
$result1 = mysqli_query($con, $result);
$user1 = mysqli_fetch_assoc($result1); // Конвертируем в массив

if(count($user1) == 0){
	echo "<script>alert('Такой пользователь не найден.');</script>";
	exit();
}
else if(count($user1) == 1){
	echo "<script>alert('Логин или пароль введены не верно.');</script>";
	exit();
}

setcookie('user_id', $user1['user_id'], time() + 3600, "/");

header('Location: page.php');
?>