<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penguins</title>
    <link rel="stylesheet" href="reset.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        // $userName = "Слава и Динар";
        // $userAge = 15;

        // echo "<b>Нас зовут - $userName</b><br>";

        // if ($userAge < 18) {header("Location: child.php");}
        // else {header("Location: adult.php")}
        // $a = 1;
        // do {
        //     if($userAge % $a == 0)
        //     {
        //         echo "$a <br>";
        //         $a++;
        //     }
        //     else {
        //         $a++;
        //     }
        // } while ($a <= $userAge);
        // for ($i = 1; $i <= $userAge; $i++) { 
        //     if ($userAge % $i == 0){
        //         echo "$i <br>";
        //     }
        // }

    ?>
    <form action="check.php" method = "POST" enctype = "multipart/form-data">
        <!-- <label for="userName">Введите имя:</label>
        <input name = "userName" type="text" id = "userName">
        <br>
        <label  for="userAge">Введите возраст:</label>
        <input name = "userAge" type="number" id = "userAge">
        <br>
        <label  for ="userAvatar">Загрузите изображение профиля:</label>
        <input name = "userAvatar" type="file" id = "userAvatar">
        <br>
        <input type="submit" value="Отправить"> -->
        <label  for ="userAvatar">Изображение</label>
        <input name = "userAvatar" type="file" id = "userAvatar">
        <br>
        <label for="user">Введите Заголовок:</label>
        <input name = "userHeading" type="text" id = "userHeading">
        <br>
        <label  for="userText">Введите текст:</label>
        <input name = "userText" type="text" id = "userText">
        <br>
        <select name="" id="">
            <option value="">Человек-Паук</option>
            <option value="">Веном</option>
            <option value="">Ящерица</option>
        </select>
        <br>
        <input type="submit" value="Создать пост">
    </form>
</body>
</html>