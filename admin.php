<?php      
    include "connect.php"; // выражение include включает и выполняет указанный файл 
    $news = mysqli_query($con, "select title from news");
    ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
</head>
<body>
<?php 
        while($new = mysqli_fetch_assoc($news)){ 
            echo "<div class='card'>"; 
            echo "<h2 class='c_title'>" . $new['title'] . "</h2>"; 
            echo "</div>"; 
        } 
    ?> 
</body>
</html>