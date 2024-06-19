<?php
include "Connect.php"; //выражение include включает и выполняет указанный файл
$news = mysqli_query($con, "SELECT * from `News`");

$filter = isset($_GET["cat"]) ? $_GET["cat"] : false;

$sort = isset($_GET["sort"]) ? $_GET["sort"] : false;

$search = isset($_GET["search"]) ? $_GET["search"] : false;

$query_search = "SELECT * FROM `News` WHERE `title` LIKE '%$search%'";

$search_result = mysqli_query($con, $query_search);

$query = "SELECT * FROM  news";

$id_news =  mysqli_num_rows(mysqli_query($con, "SELECT news_id FROM news"));

$param = "";

if ($filter) {
    $param .= "cat=$filter";
    $query = " SELECT * FROM News WHERE category_id = $filter ";
}
if ($sort) {
    $query  = " SELECT * FROM news ORDER BY publish_date $sort";
}
if ($sort && $filter) {
    $query  = " SELECT * FROM news WHERE category_id = $filter  ORDER BY publish_date $sort";
}

$query_news = "";



$news = mysqli_query($con, $query);

$page =  isset($_GET['page']) ? $_GET['page'] : 1;

$paginate_count = 3;

$offset = $page * $paginate_count - $paginate_count;

$news =  mysqli_query($con, $query. " LIMIT $paginate_count OFFSET $offset" ); // запрос на лимит записей

$count_news = mysqli_query($con, $query);

include "aheader.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Пингвины</title>
    <link rel="stylesheet" href="/CSS/reset.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel = "stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/CSS/style.css">
</head>

<body>
    <main>
        <section class="sort_1">
            <div class="sort">
                <ul class="list-group list-group-horizontal mt-5 mb-3">
                    <h4>Сортировка по дате публикации:</h4>
                    <li class="list-group-item">
                        <a href="/?sort=ASC<?= ($param != "") ? '&' . $param : '' ?>"><img width="30" src="asc-sort.png" alt=""></a>
                    </li>
                    <li class="list-group-item">
                        <a href="/?sort=DESC<?= ($param != "") ? '&' . $param : '' ?>"><img width="30" src="desc-sort.png" alt=""></a>
                    </li>
                </ul>
            </div>
        </section>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    for ($i = 1; $i <= ceil(mysqli_num_rows($count_news) / $paginate_count); $i++) { ?>
                        <li class="page-item"><a class="page-link" href="?page=<?= $i ?><?=$sort?'&sort='.$sort:''?><?=$filter?'&cat='.$filter:''?>">
                                <?= $i ?></a></li>
                    <?php } ?>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        <section class="last-news">
            <div class="container1">
                <?php
                //Выводится все карточки новостей
                if (mysqli_num_rows($news) == 0) {
                    echo "Данных нет";
                } else if (!empty($search)) {
                    while ($search_result_1 = mysqli_fetch_assoc($search_result)) {
                        echo "<div class = 'card'>";
                        $new_id =  $search_result_1["news_id"];
                        echo "<div class ='c_img'> <img src='image/news/" . $search_result_1['image'] . "'></div>";
                        echo "<a href ='oneNew.php?new=$new_id'>" . $search_result_1['title'] . "</a>";
                        echo "</div>";
                    }
                } else {
                    while ($new = mysqli_fetch_assoc($news)) {
                        echo "<div class = 'card'>";
                        $new_id = $new["news_id"];
                        echo "<div class ='c_img'> <img src='image/news/" . $new['image'] . "'></div>";
                        echo "<a href ='oneNew.php?new=$new_id'>" . $new['title'] . "</a>";
                        echo "</div>";
                    }
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>