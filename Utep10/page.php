<?php
include "aheader.php";
include "Connect.php";

$user_id = $_COOKIE['user_id'];
$query = "SELECT * FROM `Users` WHERE `user_id` = '$user_id'";
$user_query = mysqli_query($con, $query);
$user = mysqli_fetch_assoc($user_query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>

<body>
    <h1>Личный кабинет</h1>
    <?php
    echo "<h1>Электронная почта " . $user['email'] . "</h1>";
    echo "<h1>Никнейм " . $user['username'] . "</h1>";
    ?>
    <a href="exit.php">Что бы выйти нажмите по ссылке.</a>

</body>

</html>