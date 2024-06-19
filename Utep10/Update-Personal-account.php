<?php
include "Connect.php";
session_start();

$id = isset($_POST['ID']) ? $_POST['ID'] : false;
$email = isset($_POST['email']) ? $_POST['email'] : false;
$username = isset($_POST['username']) ? $_POST['username'] : false;

$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * from Users WHERE user_id = $id"));

$update_user = " UPDATE Users set ";
// изменение почты
if ($email != $user['email']) {

    $update_user .= " email = '$email' WHERE user_id = $id ";

    $result_update_user = mysqli_query($con, $update_user);

    echo "<script>alert('Данные обновленны!'); location.href = '/userpage.php' </script>";
}
//изменение ника
if ($username != $user['username']) {
    $update_user .= " username = '$username' WHERE user_id = $id ";

    $result_update_user = mysqli_query($con, $update_user);

    echo "<script>alert('Данные обновленны!'); location.href = '/userpage.php' </script>";
}
//изменение и ника и почты
if ($email != $user['email'] or $username != $user['username']) {

    $update_user .= " email = '$email', username = '$username' WHERE user_id = $id ";

    $result_update_user = mysqli_query($con, $update_user);

    echo "<script>alert('Данные обновленны!'); location.href = '/userpage.php' </script>";
}
if ($email = $user['email'] or $username == $user['username']) {

    echo "<script>alert('Данные актуальны!'); location.href = '/userpage.php' </script>";
}
?>