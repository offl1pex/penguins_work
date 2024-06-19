<?php
require "../Connect.php";
session_start();
$email = strip_tags(trim($_POST['email']));
$username = strip_tags(trim($_POST['username']));
$pass = strip_tags(trim($_POST['password']));

if(mb_strlen($username) < 5 || mb_strlen($username) > 100) {
    echo "Недопустимая длина логина"; 
    exit();
} 



$result1 = mysqli_query($con, "SELECT * FROM Users WHERE username = '$username'");
$user1 = mysqli_fetch_assoc($result1);

if(!empty($user1)) {
    echo "Данный логин уже используется!";
    exit();
} else {
    mysqli_query($con, "INSERT INTO Users (`username`, `pass`, `email`) VALUES ('$username', '$pass', '$email')");

    $_SESSION["user_id"] = mysqli_insert_id($con);

    header('Location: /userpage.php');
}
?>