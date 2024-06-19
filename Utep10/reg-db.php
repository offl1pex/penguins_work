<?php 
include "Connect.php";
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING); // Удаляет все лишнее и записываем значение в переменную //$login
$name = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
$pass = filter_var(trim($_POST['pass']), FILTER_SANITIZE_STRING); 
if(mb_strlen($email) < 5 || mb_strlen($email) > 100){
	echo "Недопустимая длина логина";
	exit();
}
$result1 = mysqli_query($con,"SELECT * FROM `Users` WHERE `email` = '$email'");
$user1 = mysqli_fetch_assoc($result1); // Конвертируем в массив

if(!empty($user1)){
	echo "Данный логин уже используется!";
	exit();
}

$insert = mysqli_query($con, "INSERT INTO `Users`(`email`, `pass`, `username`) VALUES ('$email','$pass','$name')");
print_r($insert);

echo "<script>alert('Вы зарегистрировались'); location.href = '/' </script>";
?>