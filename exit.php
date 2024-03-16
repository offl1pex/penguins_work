<?php 

setcookie('user', $user1['username'], time() - 3600, "/");
header('Location: /');

 ?>