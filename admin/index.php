<?php
include "../connect.php";
include "../header.php";
$News = mysqli_fetch_all(mysqli_query($con, "SELECT `news_id`, `title` from News"));
$id_new = isset($_GET['new']) ? $_GET['new'] : false;
if ($id_new) {
    $new_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * from `News` where news_id = $id_new"));
}
?>


<body>
    <div class="container">
        <h1 class="text_admin">Панель админа</h1>
        <div class="content">
            <section class="col_1">
                <ul class="col_1_ul">
                    <h2 class="ul_news">Список новостей</h2>
                    <?php
                    foreach ($News as $new) {
                        echo "<li><a href ='?new=" . $new[0] . "'>" . $new[1] . "</a></li>";
                    }
                    ?>

                </ul>
                <a class="adding_a" href="/admin/Index.php"><img src="../image/add.png" alt=""></a>

            </section>
            <section class="col_2">
                <h2><?= $id_new ? "Редактирование новости №$id_new" : "Создание новости " ?></h2>

                <form action='<?= $id_new ? "update" : "create"; ?>NewValid.php' method="POST" enctype="multipart/form-data" id="form">
                    <?php if ($id_new) {
                        echo "<div class ='c_img'> <img  class='images_news' src='/image/news/" . $new_info['image'] . "'></div>";
                    }
                    ?>
                    <?= $id_new ? "<input type='hidden' name='id' value='$id_new'>" : ""; ?>


                    <label for="userAvatar"></label>
                    <input name="userAvatar" type="file" id="userAvatar">
                    <br>
                    <label for="user"></label>
                    <input name="userHeading" type="text" id="userHeading" placeholder="Введите Заголовок" value='<?= $id_new ? $new_info["title"] : ""; ?>'>
                    <br>
                    <label for="userText"></label>
                    <input name="userText" type="text" id="userText" placeholder="Введите текст" value='<?= $id_new ? $new_info["content"] : ""; ?>'>
                    <br>
                    <label for="userSelect"></label>
                    <select name="news" id="userSelect">
                        <?php
                        foreach ($categories as $category) {
                            $id_cat = $category[0];
                            $name = $category[1];
                            $is_sell = ($id_cat == $new_info["category_id"]) ? "selected" : '';
                            echo "<option value='$id_cat'" . ($id_new ? $is_sell : '') . ">$name</option>";
                        }
                        ?>

                    </select>
                    <br>
                    <input type="submit" value="Создать пост" id="userSubmit">
                </form>

            </section>

        </div>
    </div>
</body>

</html>