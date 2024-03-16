<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"  
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="  
    crossorigin="anonymous" referrerpolicy="no-referrer"> 
</script> 
<?php 
include "Connect.php"; 
$query_get_category = "select * from categories"; 
$categories = mysqli_fetch_all(mysqli_query($con, $query_get_category)); 
session_start();
$username = isset($_SESSION["user"]) ? mysqli_fetch_assoc(mysqli_query($con, 'select username from users where user_id =' . $_SESSION["user"]))["username"] : false;

?> 
<!DOCTYPE html> 
<html> 

<head> 
    <meta charset='utf-8'> 
    <meta http-equiv='X-UA-Compatible' content='IE=edge'> 
    <title>Page Title</title> 
    <meta name='viewport' content='width=device-width, initial-scale=1'> 
    <link rel='stylesheet' type='text/css' media='screen' href='css/style.css'> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>  

 
    <script src='main.js'></script> 
</head> 
 
<body> 
    <header> 
        <div class="nav-header"> 
            <h2>Разделы</h2> 
            <div class="searcch-block"> 
                <img src="imeges/Search.svg" alt="" class="poisc_img"> 
                <form id="search-form" action="/" method="get"> 
                <input type="search" id='search' name="search" placeholder="Поиск"> 
            </form> 
            </div> 
     

            <div class="vhod">
            <?php if ($username) { ?>
                <a href="/page.php" class="pers-name"><?= $username ?></a>
            <?php } ?>
                <?php if(!isset($_SESSION["user"])) { ?>
                    <a href="auto.php">Вход</a>/<a href="reg.php">Регистрация</a>
                <?php } else { ?>
                    <a href="signout.php">Выход</a>
                <?php } ?>
            </div>
                
        </div> 
        <div class="text-name"> 
            <h1 class="namePost1"><a href="/">Пингвины</a></h1> 
            <h3>Понедельник, Январь 1, 2018</h3> 
            <div class="pogoda"> 
                <img src="imeges/Sun.svg" alt="" class="poisc_img"> 
                <h3>-23°C</h3> 
            </div> 
        </div> 
    </header> 
    <main> 
        <div class="text-main"> 
             
            <?php 
            foreach ($categories as $category) { 
                echo "<li><a   href='/?cat=$category[0]'>$category[1]</a></li>"; 
            } 
            ?> 
        </div> 
    </main> 
 
    <script>  
        $('#search-form').on ('keyup', function (e)){  
            <?php   
                $searching = isset($_GET['search'])? $_GET['search']: false;   
                ?>  
        }  
    </script>