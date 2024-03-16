<?php 
include "connect.php"; 
session_start();

$email = $_POST['email'];
$username =$_POST['username'];
$user_id = $_SESSION['user'];
$queryUserCheck = mysqli_query($con,"UPDATE `users` SET `username`='$username',`email`='$email' WHERE user_id = $user_id"); 
echo "<script>
alert(\"готово\"); 
location.href='page.php';
</script>";
?>