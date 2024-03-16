
<?php      
    include "../connect.php"; // выражение include включает и выполняет указанный файл 
    include "../header.php";
    // $news = mysqli_fetch_all (mysqli_query($con, "select title from news"));//ресурс подключения(Ресурс представляет собой тип данных) и запрос для нашей бд,
    $news = mysqli_fetch_all (mysqli_query($con, "select news_id,title from news"));//ресурс подключения(Ресурс представляет собой тип данных) и запрос для нашей бд,


    $id_new = isset($_GET ["new"]) ? $_GET ["new"] : false;  
 
    if ($id_new) $new_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM news WHERE news_id = $id_new"));

    ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/style.css">
    <title>Админ панель</title>
</head>
<body>
    <h1>Панель администратора</h1>
<div class="content">
    <section class = col_1> 
        <h2>Список новостей:</h2>
        <ul>
            <?php 
            foreach($news as $new ){
                echo "<li> <a href='?new=" . $new[0] . "'>". $new[1]."</a>
                <a href = 'deleteNew.php?new=" .  $new[0] ."'><img src ='/imeges/icons/trash.png' class='munys'> </a>
                </li><hr>";
            }
            ?>
            <a href="/admin"><img src = "/imeges/icons/plus.png" class="plus_img"></a>
        </ul>
    </section>
    <section class="col_2">

    <h2><?= $id_new?"Редактирование  №$id_new":"Создание новости";?></h2> 
    <form action='<?= $id_new?"update":"create";?>NewValid.php' method="post" enctype="multipart/form-data">
    <div class="input-group">
    <?= $id_new?"<img src='/imeges/news/". $new_info['image'] . "' alt ='#' >": "";?>

    <?= $id_new?"<input type = 'hidden' name = 'id' value = '$id_new' >": "";?>

    </div>
        <label for="newsCat">Категории:</label>
        <select id="newsCat" name="newsCat">
            <?php
            foreach ($categories as $cat) {
                $id_cat = $cat[0];
                $name = $cat[1];
                $is_sel = ($id_cat == $new_info ['category_id'])? "selected" :'';

                echo "<option value ='$id_cat' " .($id_new ? $is_sel : '')." > $name </option>";
            }
            ?>

        </select><br><br>
        <label for="newTitle">Заголовок:</label>
        <input type="text" id="newTitle" name="newTitle" class="zagolovok" value='<?= $id_new?$new_info["title"] :"";?>'><br><br>

        <label for="newsText">Текст:</label><br>
        <input type="text" id="newsText" name="newsText" rows="4" cols="50" class="zagolovok" placeholder="Введите свою почту" value='<?= $id_new?$new_info["content"] :"";?>'></textarea><br><br>

        <label for="newsImg">Изображение:</label>
        <input type="file" id="newsImg" name="newsImg" accept="image/*" ><br><br>

        <input type="submit" value="Отправить" class="submit-button">
    </form>

    </section>
</div>
<?php 
        // while($new = mysqli_fetch_assoc($news)){ //возвращает подстрочно одномерный ассоциативный массив
        //     echo "<div class='card'>"; 
        //     echo "<h2 class='c_title'>" . $new['title'] . "</h2>"; 
        //     echo "</div>"; 
        // } 

    ?> 
</body>
</html>

<style>
    h1{
        text-align: center;
    }
a{
    color: black;
    font-size: 29px;
    text-decoration: none;
}
.content{
    display: flex;
    width: 100%;
    justify-content: space-around;
    
}
.plus_img{
    width: 50px;
    height: 50px;
}
.munys{
    width: 18px;
    height: 18px;
}

    </style>