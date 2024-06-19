<?php
include "Connect.php";
include "aheader.php";
$new_id = isset($_GET["new"])?$_GET["new"]:false;

if ($new_id) {
    $query_getNew = "SELECT * from `News` where `news_id` = $new_id";
    $new_info = mysqli_fetch_assoc(mysqli_query($con, $query_getNew));
    $date = date("d:m:Y h:m:s", strtotime($new_info['publish_date']));
    $mount = [
        '01' => 'Январь',
        '02' => 'Ферваль',
        '03' => 'Март',
        '04' => 'Апрель',
        '05' => 'Май',
        '06' => 'Июнь',
        '07' => 'Июль',
        '08' => 'Август',
        '09' => 'Сентябрь',
        '10' => 'Октябрь',
        '11' => 'Ноябрь',
        '12' => 'Декабрь'
    ];


$publish_date = date_new($new_info['publish_date']);
$comments_result = mysqli_query($con, "SELECT * FROM `Comments` INNER JOIN Users on Users.user_id = Comments.user_id WHERE `news_id` = '$new_id'");
$comments = mysqli_fetch_all($comments_result);

} else {
    header("Location: /");
}
function date_new($date_old) {
    global $mount;
    $date = date("d:m:Y h:m:s", strtotime($date_old));
    return substr($date,0,2)." ". $mount[substr($date,3,2)] ." ".substr($date,6);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/CSS/reset.css">
    <link rel="stylesheet" href="/CSS/style.css">
    <title>Document</title>
</head>
    <body>
        <?php
        echo "<div class = 'card'>";
        echo "<div class = 'c_img'><img src = 'Image/News/".$new_info['image']. "'></div>";
        echo $publish_date;
        echo "<br>";
        echo $new_info['title'];
        echo "<br>";
        echo "<p class = 'description mb-3'>" . $new_info['content'] . "</p>";
        ?>
        <h3 class="mb-3">Комментарии <?= $count = mysqli_num_rows($comments_result)?><img src="/Image/free-icon-comment-5755460.png" alt="" width="50px" height="50px"></h3>
        <?php if ($username) { ?>
        <form class="w-100" action="/DB/comments-DB.php" method="post">
            <div class="mb-3 d-flex w-100">
                <div class="w-50">
                    <input type="hidden" name="id_new" value="<?= $new_id?>">
                    <label for="comment_text" class="form-label">Напишите комментарий</label>
                    <input type="text" class="form-control" id="comment_text" name="comment_text">
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </form>
        <?php } ?>
        <?php if($count) {
            foreach ($comments as $comment) {?>
                <div class="card">
                    <div class="card-header">
                        <?= date_new($comment[4])?>
                    </div>
                    <div class="card-body">
                        <?="<p>Автор: ".$comment[8]."</p>"?>
                    </div>
                    <p class="card-text">
                        <?= $comment[3]?>
                    </p>
                </div>
            <?php }
            ?>
        <?php 
        } else echo "<i>Комментариев пока нет</i>"
        ?>
        
    </body>
</html>