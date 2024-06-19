<?php
include "Connect.php";
$query_get_category = "select * from categories";

session_start();

$id_date = isset($_GET[''])?$_GET['']:false;

$categories = mysqli_fetch_all(mysqli_query($con, $query_get_category)); //получаем результат запроса из переменной query_get_category 
//и преобразуем его в двухмерный массив, где каждый элемент это массив с построчным получением кортежей из тфблицы результата запроса 
$username = isset($_SESSION["user_id"]) ? mysqli_fetch_assoc(mysqli_query($con, "SELECT username FROM Users WHERE user_id=".$_SESSION["user_id"]))["username"]:false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пингвины</title>
    <link rel="stylesheet" href="/CSS/style.css">
    <link rel="stylesheet" href="/CSS/reset.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel = "stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
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
            <form id="search" action="/">
                <input type="search" name="search" id="searchText" placeholder="Поиск">
            </form>
        </div>
        <div class="header-div3">
            <?php if ($username) {?>
                <li><a href="/userpage.php">
                    <?= $username?>
                </a></li>
            <?php } ?>

            <li><a href='sign<?= (!$username)? "in" : "out" ?>.php' <img src="" alt=""><span><?= (!$username) ? "Вход" : "Выход" ?></span></a></li>
        </div>
    </div>
    <hr class="hr2">
    <div class="logo-date">
        <div>
            <a href = "/">Пингвины</a>
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
                // echo "<hr>";
            }
        ?>
        </div>
    </nav>
</body>
</html>