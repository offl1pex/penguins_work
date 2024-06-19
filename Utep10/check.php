<?php
$userHeading = $_POST["userHeading"];
$userText = $_POST["userText"];

// echo "Привет, $userName! Твой возраст: $userAge лет";
// if ($userAge < 18) {header("Location: child.php");}
// else {header("Location: adult.php");}

$userAvatar = $_FILES["userAvatar"];

// var_dump($userAvatar);
$destination = 'Image/Avatars/' .$userAvatar['name'];

$filename = $userAvatar["tmp_name"];

$check_upload = move_uploaded_file($filename, $destination);

var_dump($check_upload);
?>