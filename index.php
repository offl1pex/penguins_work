<?php      
    include "connect.php";
    include "header.php";
    $query_get_category = "select * from categories"; 

    $cat = isset($_GET["cat"]) ? $_GET["cat"] : false; 

    if ($cat == false) {
        $news_all = mysqli_query($con, "select * from news");
    }
    else {
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
<style>
    @import url('https://fonts.googleapis.com/css2?family=Lato&display=swap'); 
*{ 
    margin: 0; 
    padding: 0; 
} 
.text-main{ 
    list-style-type: none; 
} 
.cards {
    width: 100%;
    display: flex;
    justify-content: space-around;
}
.card {
    margin-top: 50px;
    width: 600px;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.nav-header{ 
    display: flex; 
    width: 100%; 
    align-items: baseline; 
    justify-content: space-around; 
    border-bottom: 2px solid #D9DADB ; 

} 

.nav-header h2{ 
    color: var(--Base-Grey-100, #262D33); 
    font-family: Lato; 
    font-size: 14px; 
    font-style: normal; 
    font-weight: 400; 
    line-height: 20px;  
} 
.namePost1{ 
    color: var(--Base-Grey-100, #262D33); 
text-align: center; 
font-family: Roboto Slab; 
font-size: 40px; 
font-style: normal; 
font-weight: 700; 
line-height: 50px; /* 125% */ 
}  
header h1{ 
text-align: center 
} 
.submit-button{ 
    width: 119px; 
    height: 40px; 
    flex-shrink: 0; 
    border-radius: 20px; 
    background: var(--Blue-Blue-75, #4592FF); 
} 
.zagolovok{ 
    width: 313px; 
    height: 40px; 
    flex-shrink: 0; 
    border-radius: 5px; 
    border: 1px solid var(--Base-Grey-15, #D9DADB); 
    background: var(--Base-White, #FFF); 
} 
.searcch-block{ 
    display: flex; 
    align-items: baseline; 
} 

form{ 
    display: flex; 
    flex-direction: column; 
    align-items: center; 
} 
.poisk{ 
    border: none; 
    width: 300px; 
    height: 50px; 
} 
.vhod a{ 
    color: black; 
    text-decoration: none; 
} 
.text-name{ 
    display: flex; 
    color: var(--Base-Grey-85, #4B5157); 
    font-family: Lato; 
    font-size: 14px; 
    font-style: normal; 
    font-weight: 400; 
    line-height: 20px; 
    gap: 100px; 
    align-items: baseline; 
    justify-content: center; 
} 
.pogoda{ 
    display: flex; 
    align-items: baseline; 
    color: var(--Base-Grey-85, #4B5157); 
    font-family: Lato; 
    font-size: 14px; 
    font-style: normal; 
    font-weight: 400; 
    line-height: 20px; 

} 
/* блок с main */ 
main{ 
    background-color:#262D33 ; 
    width: 100%; 
    height: 200px; 
} 
.text-main{ 
    height: 200px; 
    display: flex; 
    justify-content: center; 
    gap: 30px; 
    color: #FFF; 
    color: var(--Base-White, #FFF); 
    font-family: Lato; 
    font-size: 24px; 
    font-style: normal; 
    font-weight: 400; 
    line-height: 20px;  
    letter-spacing: 0.5px; 
    text-transform: uppercase; 
    align-items: center;
    } 
.text-main a{ 
    text-decoration: none; 
    color: #FFF; 

} 

#newsCat, 
#newsCat option{ 
        width: 313px; 
        height: 40px; 
        border-radius: 5px; 
        border: 1px solid var(--Base-Grey-15, #D9DADB); 
        background: var(--Base-White, #FFF); 
        color: var(--Base-Grey-50, #939699); 
        font-family: Lato; 
        font-size: 14px; 
        font-style: normal; 
        font-weight: 400; 
        line-height: 20px; 
}
.images {
    height: 300px;
}
</style>