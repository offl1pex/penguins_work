<?php
include "../Connect.php";
include "../aheader.php";


$News = mysqli_fetch_all(mysqli_query($con, "select `news_id`, `title` from News"));

$id_new = isset($_GET["new"])?$_GET["new"]:false;

if ($id_new) {
    $new_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM `News` WHERE news_id = $id_new"));
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/CSS/reset.css">
    <link rel="stylesheet" href="/CSS/style.css">
</head>
<body>
    <div class="container">
        <h1 class="text_admin">Панель админа</h1>
        <div class="content">
            <section class="col_1">
                <ul class="col_1_ul">
                    <h2 class="ul_news">Список новостей:</h2>
                    <?php
                    foreach ($News as $new1) {
                        echo "<li><a href ='?new=" . $new1[0] . "'>" . $new1[1] . "</a>
                        <a class = 'adding_a' href = 'deleteNewValid.php?new=" . $new1[0] . "'><img src='../delete.png' alt=''></a></li>";
                    }
                    ?>
                    <a class = "adding_a" href = "/Admin/Index.php"><img src="/adding.png" alt=""></a>
                </ul>
            </section>
            <section class="col_2">
                    
                <h2><?= $id_new ? "Редактирование новости № $id_new ":"Создание новости";?></h2>
                <form action="<?=$id_new ? "update": "create";?>NewValid.php" method="POST" enctype="multipart/form-data" id="form">
                        <?php if ($id_new) {
                                echo "<div class ='c_img'> <img src='/Image/News/" . $new_info['image'] . "'></div>";
                            }
                        ?>
                    <?= $id_new ? "<input type = 'hidden' name = 'id' value = '$id_new'>" : "" ;?>
                    <label for="userAvatar"></label>
                    <input name="userAvatar" type="file" id="userAvatar">
                    <br>
                    <label for="user"></label>
                    <input name="userHeading" type="text" id="userHeading" placeholder="Введите Заголовок" value = '<?=$id_new?$new_info["title"]:"";?>'>
                    <br>
                    <label for="userText"></label>
                    <input name="userText" type="text" id="userText" placeholder="Введите текст" value = '<?=$id_new?$new_info["content"]:"";?>'>
                    <br>
                    <label for="userSelect"></label>
                    <select name="news" id="userSelect"  value = '<?=$id_new?$new_info["category_id"]:"";?>'>
                        <?php
                        foreach ($categories as $category) {
                            $id_cat = $category[0];
                            $name = $category[1];
                            $is_sel = ($id_cat == $new_info["category_id"]) ? "selected" : '';
                            echo "<option value = '$id_cat'". ($id_new ? $is_sel : '') . ">$name</option>";
                        }
                        ?>
                    </select>
                    <br>
                    <input type="submit" value="Создать пост" id="userSubmit">
                </form>

            </section>

        </div>
    </div>
    <!-- <?foreach ($NewsAll as $item):?>
                    <div>
                        <li><?=$item[2]?></li>
                    </div>
        <?endforeach;?> -->
</body>
</html>