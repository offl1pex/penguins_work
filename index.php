<?php      
    include "connect.php";
    include "header.php";
    $query_get_category = "select * from categories"; 

    $cat = isset($_GET["cat"]) ? $_GET["cat"] : false; 

    if ($cat == false) {
        $news_all = mysqli_query($con, "select * from news");
    }
    else {
        error_reporting(0);
        if (mysqli_fetch_assoc(mysqli_query($con, "select * from news where category_id = $cat"))["category_id"] == NULL) {
            $news = "нет";
        } else {
            $news = mysqli_query($con, "select * from news where category_id = $cat");
        }
    }

    ?> 

    <!DOCTYPE html> 
    <html lang="en"> 
    <head> 
        <meta charset="UTF-8"> 
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title>Пингвины</title>
        <link rel='stylesheet' type='text/css' media='screen' href='/css/style.css'> 

    </head> 
    <body> 

    <nav> 


    <div id="main">
    <div class="last-news">
    <?php 
    echo "<div class='cards'>";
    if ($news == "нет"){
        echo "Данных нет!";
    } else {
        if (empty($news)){
            while($new = mysqli_fetch_assoc($news_all)){ 
                echo "<div class='card'>"; 
                echo "<h2 class='c_title'>" . $new['title'] . "</h2>"; 
                echo "<p>" . $new['content'] . "</p>"; 
                echo "<img class='images' src='Image/news/".$new['image']."'>";
                echo "</div>";
        }
            }
            else {
            while($new = mysqli_fetch_assoc($news)){ 
            echo "<div class='card'>"; 
            echo "<h2 class='c_title'>" . $new['title'] . "</h2>"; 
            echo "<p>" . $new['content'] . "</p>"; 
            echo "<img class='images' src='Image/news/".$new['image']."'>";
            echo "</div>";
        } } 
    }
    echo "</div>";
    ?> 
</div>
    </div>


    </body> 
</html>
