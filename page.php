<?php 
include "connect.php"; 
include "header.php"; 

$user_id = $_SESSION['user'];
$user = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `users` WHERE `user_id` = '$user_id'")); 
?>

<!DOCTYPE html>  
<html lang="en">  
<head>  
 <meta charset="UTF-8">  
   
 <title>Document</title>  
</head>  
<body>   
 <h1 class='Personal-cab'>Личный кабинет</h1>
 <form action="update_user.php" method="post">
   <label for="email">Email:</label>
   <input required type="text" name="email" value="<?php echo $user['email']; ?>">
   <br>
   <label for="username">Имя:</label>
   <input required type="text" name="username" value="<?php echo $user['username']; ?>">
   <br>
   <button type="submit">Отправить</button>
 </form>
</body>  
</html>  

<style>  
.Personal-cab {  
 text-align: center;  
}
</style>