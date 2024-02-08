<?php
include "connect.php";
$title = isset($_POST['userHeading']) ? $_POST['userHeading'] : false;
$text = isset($_POST['userText']) ? $_POST['userText'] : false;
$file = isset($_FILES['userAvatar']["tmp_name"]) ? $_FILES['userAvatar'] : false;
$Category_id = isset($_POST['news']) ? $_POST['news'] : false;

function check_error($error)
{
    return "<script>alert('$error');
location.href ='../admin/Index.php';
</script>";
}

if ($title and $text and $Category_id) {
    if (strlen($title) > 50) {
        echo check_error("Название не должно превышать 50 символов!");
    } else {
        $file_name = $file["name"];
        $result = mysqli_query($con, "INSERT INTO News (title, content, image, category_id) VALUES ('$title','$text', '$file_name',$Category_id)");
        if ($result) {
            move_uploaded_file($file['tmp_name'], "image/news/$file_name");
            echo check_error("Новость успешно создана");
        } else {
            echo check_error("Произошла ошибка:" . mysqli_error($con));
        }
    }
} else {
    echo check_error("Все поля должны быть заполненны!");
}
