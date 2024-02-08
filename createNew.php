<?php
include "connect.php";

$query_category = "SELECT * FROM `Categories` ";

$categories =  mysqli_fetch_all(mysqli_query($con, $query_category));



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="CSS/reset.css">
</head>

<body>
    <div class="header">
        <div class="header-div1">
            <img src="Image/Hamburger menu.png" alt="">
            <p>Разделы</p>
        </div>
        <hr class="hr1">
        <div class="header-div2">
            <img src="Image/Search.png" alt="">
            <label for="">
                <input type="search" name="" id="" placeholder="Поиск">
            </label>
        </div>
        <div class="header-div3">
            <img src="Image/Man.png" alt="">
            <a href="">Войти</a>
        </div>
    </div>
    <hr class="hr2">
    <div class="logo-date">
        <div>
            <p>Los pingvinos ve la managasrkar</p>
        </div>
        <div class="date-weather">
            <p>Monday, January 1, 2018</p>
            <div class="weather">
                <img src="Image/Sun.png" alt="">
                <p>- 23 °C</p>
            </div>
        </div>
    </div>
    <div class="section">
        <?php foreach ($categories as $cat) {
            $id_cat = $cat[0];
            $name = $cat[1];
            echo "<option class='section_option' value ='$id_cat'> $name</option>";
        }
        ?>
    </div>
    <form action="createNewValid.php" method="POST" enctype="multipart/form-data" id="form">
        <label for="userAvatar"></label>
        <input name="userAvatar" type="file" id="userAvatar">
        <br>
        <label for="user"></label>
        <input name="userHeading" type="text" id="userHeading" placeholder="Введите Заголовок">
        <br>
        <label for="userText"></label>
        <input name="userText" type="text" id="userText" placeholder="Введите текст">
        <br>
        <label for="userSelect"></label>
        <select name="news" id="userSelect">
            <?php
            foreach ($categories as $category) {
                $id_cat = $category[0];
                $name = $category[1];
                echo "<option value = '$id_cat'>$name</option>";
            }
            ?>
        </select>
        <br>
        <input type="submit" value="Создать пост" id="userSubmit">
    </form>
</body>

</html>