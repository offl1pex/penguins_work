<?php
include "../Connect.php";

$title = isset($_POST['userHeading'])?$_POST['userHeading']:false;
$text = isset($_POST['userText'])?$_POST['userText']:false;
$file = isset($_FILES['userAvatar']["tmp_name"])?$_FILES['userAvatar']:false;
$category_id = isset($_POST['news'])?$_POST['news']:false;

function check_error($error) {
    return "<script>alert('$error'); location.href = 'Index.php';</script>";
}

if ($title and $text and $category_id) {
    if (strlen($title) > 50) {
        echo check_error("Название не должно превышать 50 символов!");
    } else {
        $file_name = $file["name"];
        $result = mysqli_query($con, "INSERT INTO `News` (title, content, image, category_id) VALUES ('$title','$text', '$file_name',$category_id)");

        if ($result) {
            move_uploaded_file($file['tmp_name'], "../Image/News/$file_name");
            echo check_error("Новость успешно создана");
        } else {
            echo check_error("Произошла ошибка:" . mysqli_error($con));
        }
    }
    
} else {
    echo check_error("Все поля должны быть заполненны!");
}
// $userAvatar = $_FILES["userAvatar"];
// $userHeading = $_POST["userHeading"];
// $userText = $_POST["userText"];
// $userSelect = $_POST["userSelect"];
// $vivod = $userAvatar['name'];
// $q = "INSERT INTO `News` (`image`, `title`, `content`,`category_id`) VALUES ('$vivod','$userHeading', '$userText','1')";
// $request = mysqli_query($con, $q);
// var_dump($userSelect);
// var_dump($q);
// $rash = array('jpg', 'jpeg', 'png', 'svg');
//     if (strlen($userHeading) <= "20") {
//         echo "Нормальная длина <br>";
//     } else {
//         echo "Слишком много <br>";
//     }

//     if (empty($userHeading)) {
//         echo "Строка пустая <br>";
//     } else {
//         echo "Строка заполненна <br>";
//     }

//     if (empty($userText)) {
//         echo "Строка пустая <br>";
//     } else {
//         echo "Строка заполненна <br>";
//     }

//     if (in_array(explode('.', $userAvatar['name'])[1], $rash)){
//         echo "Изображение!";
//     } else {
//         echo "Ошибка!!!!!!!!!!!!!!!!!!!!!!!!!!!";
//     }


?>