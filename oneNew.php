<?php        
    include "connect.php"; // выражение include включает и выполняет указанный файл   
  
    $news_id = isset($_GET["new"])?$_GET["new"]:false;  
  
    $query_getNew = "select news.*,categories.name from news inner join categories on news.category_id = categories.category_id where news_id = '$news_id'";  
    $new_info = mysqli_fetch_assoc(mysqli_query($con, $query_getNew));  
      
    include "header.php";  
      
    // <div class='last-news'>    
  
            echo "<img src='imeges/news/".$new_info['image']."'>";  
            echo "<h1>" . $new_info['title'] . "</h1>";   
            echo"<p>" . $new_info['content'] . "</p>";  
            $date = date("d.m.Y h:i",strtotime($new_info['publish_date']));  
            $month = ["01"=> "Января",   
            "02"=> "Февраля",  
            "03"=> "Марта",  
            "04"=> "Апреля",  
            "05"=> "Мая",  
            "06"=> "Июня",  
            "07"=> "Июля",  
            "08"=> "Августа",  
            "09"=> "Сентября",  
            "10"=> "Октября",  
            "11"=> "Ноября",  
            "12"=> "Декабря",  
            ];  
            $m_text=$month[substr($date, 3,2)];  
            $publish_date = substr($date,0,2)." ".$m_text." ".substr($date, 6); 
            echo"<p>". $publish_date . "</p>"; 
            echo "<p>Категория: <b>".$new_info['name']."</b></p>";  
            echo "</div>";  
?>