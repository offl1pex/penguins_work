<?php
include "connect.php";
$query_get_category = "select * from categories";
$categories = mysqli_fetch_all(mysqli_query($con, $query_get_category));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">
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
            <a href="/auth.php">Войти</a>
            <a href="/reg.php">Регистрация</a>
            <a href="/admin"> Админ</a>
            <a href="Index.php"> Главная</a>
        </div>
    </div>
        </div>
    </div>
    <hr class="hr2">
    <div class="logo-date">
        <div>
            <a href='../index.php'>Пингвины</a>
        </div>
        <div class="date-weather">
            <p>Monday, January 1, 2018</p>
            <div class="weather">
                <img src="Image/Sun.png" alt="">
                <p>- 23 °C</p>
            </div>
        </div>
    </div>
    <nav>
        <div class="n_title">
            <h1 class="title"></h1>
        </div>
        <div class="section">
            <?php

            foreach ($categories as $category) {
                $cat_id = $category[0];
                echo "<li><a href = '/index.php?cat=$cat_id'>$category[1]</a></li>";
            }
            ?>
        </div>
    </nav>
</body>

</html>