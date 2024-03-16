<?php
include "../connect.php";

$id = isset($_POST['id']) ? $_POST['id'] : false;//isset — Определяет, была ли установлена переменная значением, отличным от null
$title = isset($_POST['newTitle']) ? $_POST['newTitle'] : false;
$text = isset($_POST['newsText']) ? $_POST['newsText'] : false;
$file = ($_FILES['newsImg']["size"] !=0) ? $_FILES['newsImg'] : false;
$category_id = isset($_POST['newsCat']) ? $_POST['newsCat'] : false;

function check_error($error,$id)
  {
    return "<script> alert('$error');location.href ='/admin?new=$id';</script>";
  }

  $new_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM news WHERE news_id='$id'"));

  $query_update= "UPDATE news SET ";
  $check_update = false; 
  
if($new_info["title"] != $title )
   { 
    $query_update .="title = '$title' , ";
    $check_update = true; 
    
}
if($new_info["content"] != $text ) 
{
    $query_update .="content = '$text' , ";
  $check_update = true; 

}
if($new_info["category_id"] != $category_id )
   { 
    $query_update .="category_id = '$category_id' , ";
  $check_update = true; 

}

if($file){
    $query_update .="image =". $file["name"];
    move_uploaded_file($file["tmp_name"], "../imeges/news/$file_name");
    $check_update = true; 


}

if ($check_update) {
    $query_update = substr($query_update, 0,-2);
    $query_update .= "WHERE news_id = $id";
    $result = mysqli_query($con, $query_update);
    
    if($result)echo check_error("Данный обновлены!" , $id);
    else echo check_error("Ошибка обновления!" .mysqli_error($con) , $id);
}
else{
    echo check_error("Данный актуальны" , $id);
}



?>