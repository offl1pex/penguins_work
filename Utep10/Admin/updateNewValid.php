<?php
include "../Connect.php";
$id = isset($_POST['id']) ? $_POST['id'] : false;
$title = isset($_POST['userHeading']) ? $_POST['userHeading'] : false;
$text = isset($_POST['userText']) ? $_POST['userText'] : false;
$file = ($_FILES['userAvatar']["size"] != 0) ? $_FILES['userAvatar'] : false;
$Category_id = isset($_POST['news']) ? $_POST['news'] : false;
function check_error($error, $id)
{
    return "<script>alert('$error'); location.href ='../admin? new= $id'; </script>";
}
$new_info = mysqli_fetch_assoc(mysqli_query($con, "SELECT * from News where news_id = $id"));
$check_update = false;
$query_update = "UPDATE news SET ";
if ($new_info["title"] != $title) {
    $query_update .= "title = '$title', ";
    $check_update = true;
}
if ($new_info["content"] != $text){
    $query_update .= "content = '$text', ";
    $check_update = true;
}
if ($new_info["category_id"] != $Category_id){
    $query_update .= "category_id = '$Category_id', ";
    $check_update = true;
}
if ($file) {
    $query_update .= "'image' = " . $file["name"];
    move_uploaded_file($file['tmp_name'], "../image/news/" . $file["name"]);
    $check_update = true;
}


if ($check_update){
    $query_update = substr($query_update, 0 , -2);
    $query_update .= " WHERE news_id = $id";
    var_dump($query_update);
    $result = mysqli_query($con, $query_update);
    if ($result) {
        echo check_error("Данные обновленны!", $id);
    } else {
        echo check_error("Ошибка обновления!" . mysqli_error($con), $id);
    }
} else {
    echo check_error("Данные актуальны!", $id);
}
// $query_update .= " WHERE news_id = $id";

// var_dump($query_update);