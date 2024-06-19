<?php
session_start();
$email = strip_tags(trim($_POST['email']));
$pass = strip_tags(trim($_POST['password']));

require "../Connect.php";

$result = mysqli_query($con, "SELECT * FROM `Users` WHERE `email` = '$email' and `pass` = '$pass'");

$user = mysqli_fetch_assoc($result);

if (count($user) == 0) {
    echo "Такой пользователь не найден";
    exit();
} else if (count($user) == 1) {
    echo "Логин или пароль введены неверно";
    exit();
} else {
    $_SESSION["user_id"] = $user["user_id"];

    header('Location: /userpage.php');
}
?>