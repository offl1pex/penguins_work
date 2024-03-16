
<?php 
include "connect.php"; //выражение include включает и выполняет указанный файл 
$query_get_category = "select * from categories";  

$categories = mysqli_fetch_all(mysqli_query($con, $query_get_category)); 

$paginate_count = 3;//limit n
$page = isset($_GET['page'])?$_GET['page']:1;    
$offset = $page * $paginate_count - $paginate_count;//offset m

include "header.php"; 

$news = mysqli_query($con, "select * from news"); 

$id_cat = isset($_GET['cat'])? $_GET['cat']:false; 
$sort = isset($_GET['sort'])?$_GET['sort']:false;     
$category = isset($_GET['category'])?$_GET['category']:false;   

$query_newcat = "SELECT * FROM news"; 

if ($id_cat) { 
    $query_newcat .= " WHERE category_id = '$id_cat'"; 
} 
else if ($category) { $id_cat = $category; 
    $query_newcat .= " WHERE category_id = '$id_cat'";} 

if ($sort) { 
    $sort_order = ($sort == 'asc') ? 'ASC' : 'DESC'; 
    $query_newcat .= " ORDER BY publish_date $sort_order"; 
} 
if($searching){  
    $query_newcat = "SELECT * FROM news WHERE title LIKE '%$searching%'";   
} 
$result = mysqli_query($con, $query_newcat); 
$search = isset($_GET["search"]) ? $_GET["search"] : false; 

$result = mysqli_query($con,   $query_newcat . " LIMIT $paginate_count OFFSET $offset" ); 

$count_students = mysqli_num_rows( mysqli_query($con,   $query_newcat ));
?> 

<div class="container">
    <form action = "" method="get"> 
    <input type="hidden" name="page" value="<?=$page?>">
    <label for="sort">Сортировать по дате:</label> 
        <select name="sort" id="sort"> 
            <option value="">Без сортировки</option> 
            <option value="asc" <?= ($sort and $sort == "asc") ? "selected" : ""; ?>>По возрастанию</option> 
            <option value="desc" <?= ($sort and $sort == "desc") ? "selected" : ""; ?>>По убыванию</option> 
        </select> 
        <input type="hidden" value="<?=$id_cat?>" name='category'> 
        <button type="submit">Применить</button> 
    </form> 
        <main1> 
            <div class="cards"> 
                <?php 
            if (mysqli_num_rows($result) == 0) { 
                echo "Нет новостей"; 
            } else { 
                while ($new = mysqli_fetch_assoc($result)) {  
                    echo "<div class='card'>";  
                    $new_id = $new['news_id'];  
                    $new_date = $new['publish_date'];  
                    echo "<img src='imeges/news/" . $new['image']. "'>";  
                    echo "<a href='oneNew.php?new=$new_id'>" . $new['title'] . "</a>";  
                    echo "</div>";  
                } 
            }
                ?> 
            </div> 
        </main1> 
        <nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
        </li>
        <?php
        for($i=1; $i <= ceil($count_students/$paginate_count ); $i++){?>
            <li class="page-item"><a class="page-link" href = "?page=<?=$i?><?=($sort)?'&sort=' .$sort:''?><?=($id_cat)?'&category=' .$id_cat:''?>">
                <?=$i?>
            </a></li>
    <?php } ?>
    
        <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
        </li>
    </ul>
    </nav>
</div>
</body> 
</html>