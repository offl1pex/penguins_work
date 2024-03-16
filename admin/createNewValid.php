  <?php
  //    $rash = ['jpeg','svg','png','jpg'];
  //   $newTitle= $_POST["newTitle"];
  //   $newsText = $_POST["newsText"];
  //   $newsCat = $_POST["newsCat"];
  //   if (strlen($newTitle) > 20) {
  //       echo "Ошибка: Название новости не должно превышать 20 символов. " ;
  //       echo "<br>";
  //   }
  //   if (!is_string($newTitle)) {
  //       echo "Ошибка: Название новости должно быть строкой. ";
  //       echo "<br>";
  //   }

  //   if (!is_string($newsText)) {
  //       echo "Ошибка: Текст новости должен быть строкой. " ;
  //       echo "<br>";
  //   }

  //   if (!is_string($newsCat)) {
  //       echo "Ошибка: Категория новости должна быть строкой. ";
  //       echo "<br>";
  //   }

  //   if (strlen($newTitle) == 0) {
  //       echo 'Ошибка: строка с заголовком пустая,введите данные!';
  //       echo "<br>";
  //   }
  //   if (strlen($newTitle) == 0) {
  //       echo 'Ошибка: строка с текстом пустая,введите данные!';
  //       echo "<br>";
  //   }
  //   $newsImg = $_FILES['newsImg'];
  //   $destination = "imeges/" . $newsImg['name'];
  //   $filename = $newsImg["tmp_name"];
  //   $check_upload = move_uploaded_file($filename, $destination);
  //   if ($check_upload) {
  //       echo "Изображение успешно загружено. ";
  //       echo "<br>";
  //   } else {
  //       echo "Ошибка при загрузке изображения. ";
  //   }

  //    if (in_array(explode('.', $newsImg['name'])[1], $rash)){
  //       echo "Изображение!";

  //    } else {
  //        echo "Ошибка!!!!!!!!!!!!!!!!!!!!!!!!!!!";
  //    }

  //   $allowedTypes = ['imege/jpeg', 'imege/png', 'imege/gif'];
  //   $newsImg = $_FILES['newsImg']; 
  //   $filename = $newsImg["tmp_name"]; 
  //   $imageType = $newsImg['type'];
  //   if (in_array($imageType, $allowedTypes)) { 
  //       echo "Ошибка: Недопустимый тип изображения. "; 
  //       } else { 
  //       $destination = "imeges/avatars/" . $newsImg['name']; 
  //       $check_upload = move_uploaded_file($filename, $destination); 
  //       if ($check_upload) { 
  //       echo "Изображение успешно загружено. "; 
  //       } else { 
  //       echo "Ошибка при загрузке изображения. "; 
  //       } 
  //       } 

  //   include "connect.php"; // выражение include включает и выполняет указанный файл 
  //   $query = "INSERT INTO `news`(image, title, content, category_id) VALUES ('news1.png','Пингвинята','Маленькие пингвины',1)";
  // // Выполнение запроса
  //    $result = mysqli_query($con, $query);



  // $userAvatar = $_FILES["newsImg"];
  // $userHeading = $_POST["newTitle"];
  // $userText = $_POST["newsText"];
  // // $userSelect = $_POST["userSelect"];
  // $vivod = $userAvatar['name'];
  // $q = "INSERT INTO News (image, title, content,category_id) VALUES ('$vivod','$userHeading', '$userText','')";
  // $request = mysqli_query($con, $q);
  // // var_dump($userSelect);
  // var_dump($q);

  include "../connect.php";

  $title = isset($_POST['newTitle']) ? $_POST['newTitle'] : false;
  $text = isset($_POST['newsText']) ? $_POST['newsText'] : false;
  $file = isset($_FILES['newsImg']["tmp_name"]) ? $_FILES['newsImg'] : false;
  $category_id = isset($_POST['newsCat']) ? $_POST['newsCat'] : false;

  function check_error($error)
  {
    return "<script> alert('$error');location.href ='/admin';</script>";
  }


  if ($title and $file and $category_id) {
    if (strlen($title) > 50)
      echo check_error("Название не должно превышать 50 символов");
    else {
      $file_name = $file["name"];
      $result = mysqli_query($con, "INSERT INTO news (title, content, image, category_id) VALUES ('$title','$text', '$file_name',$category_id)");
      if ($result) {
        move_uploaded_file($file["tmp_name"], "imeges/news/$file_name");
        echo check_error("Новость успешно создана:");
      } else
        echo check_error("Произошла ошибка:" . mysqli_error($con));
    }
  } else {
    echo check_error("Все поля должны быть заполнены!");
  }

  ?>