<!DOCTYPE html> 
    <html> 
    <head> 
        <meta charset='utf-8'> 
        <meta http-equiv='X-UA-Compatible' content='IE=edge'> 
        <title>Page Title</title> 
        <meta name='viewport' content='width=device-width, initial-scale=1'> 
        <link rel='stylesheet' type='text/css' media='screen' href='main.css'> 
        <script src='main.js'></script> 
    </head> 
    <body> 
    <?php        
            include "connect.php"; // выражение include включает и выполняет указанный файл   
 
            $news_id = isset($_GET["new"])?$_GET["new"]:false;  
 
            function date_new($date_old)
            {
              global  $mounth;
              $date = date("d.m.Y H:i:s", strtotime($date_old));
              return substr($date, 0,2 ). " " .  $mounth[substr($date, 3, 2 )] ." ". substr($date, 6 );
            }
 
            if($news_id){ 
                $query_getNew = "select news.*,categories.name from news inner join categories on news.category_id = categories.category_id where news_id = '$news_id'"; 
                $new_info = mysqli_fetch_assoc(mysqli_query($con, $query_getNew));  
                $comments_result = mysqli_query($con, "SELECT news_id, username, comment_text, comment_date FROM Comments JOIN Users ON Comments.user_id = Users.user_id  WHERE news_id = $news_id"); 
                $comments = mysqli_fetch_all($comments_result); 
            } else { 
                header("Location: /"); 
            } 
 
 
 
            include "header.php";  
 
            // <div class='last-news'>    
 
                    echo "<img src='imeges/news/".$new_info['image']."'>";  
                    echo "<h1>" . $new_info['title'] . "</h1>";   
                    echo"<p>" . $new_info['content'] . "</p>";  
                    echo "<p>Категория: <b>".$new_info['name']."</b></p>";  
 
                    $date = date("d m Y h:i:s",strtotime( $new_info['publish_date'])  ); 
                    $mounth = ["01"=> "Января", 
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
 
        $m_text = $mounth[ substr($date, 3,2 )]; 
        $publish_date = substr($date, 0,2 ). " " . $m_text ." ". substr($date, 6 ); 
                    echo"<p>". $publish_date. "</p>";  
                    echo "</div>";  
        ?> 
 
        <div id="commentaries">
            <h3>Комментарии</h3> 
            <?php 
 
                // Получение идентификатора новости
                $id_new = isset($_GET["new"]) ? $_GET["new"] : false;
 
                if ($id_new) {
                    // Запрос к базе данных для подсчета количества комментариев
                    $query = "SELECT COUNT(*) AS total_comments FROM Comments WHERE news_id = $id_new";
                    $result = mysqli_query($con, $query);
 
                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $total_comments = $row['total_comments'];
                        echo $total_comments . "<img style = 'width: 20px; height: 20px' src='imeges/free-icon-comments-2190508.png'>";
                    } else {
                        echo "Нет комментариев";
                    }
 
                    mysqli_free_result($result);
                } else {
                    echo "Неверный идентификатор новости";
                }
                ?>
        </div>
        <?php if ($username){?> 
        <form class="w-100" action="comment-DB.php" method="post"> 
            <input type="hidden" name ="id_new" value= "<?= $news_id?>"> 
            <div class="mb-3 d-flex"> 
                <label for="comment_text" class="form-label">Напишите комментарий</label> 
                <input type="text" name="comment_text" class="form-control" id="comment_text"> 
            </div> 
                <button type="submit" class="btn btn-primary">Отправить</button> 
 
        </form> 
        <?php } ?> 
 
        <?php if(mysqli_num_rows($comments_result)) {  
            foreach ($comments as $comment){ ?> 
                <div class="card text-left"> 
                    <div class="card-header"> 
                        <?= date_new($comment[3])  ?> 
                    </div> 
 
                    <div class="card-body"> 
                        <h6 class="card-subtitle mb-2 text-body-secondary"> 
                        Автор: <?= $comment [1] ?> 
                        </h6> 
                        <div class="card-text"> 
                            <?=$comment[2] ?> 
                        </div> 
                    </div> 
                </div> 
            <?php };  
        } else  
            echo "<i>Комментариев пока нет</i>"; 
        ?> 
    </body> 
    </html>