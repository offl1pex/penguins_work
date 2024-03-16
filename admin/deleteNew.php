<?php 
 
    include "../connect.php"; 
 
    $id_new = isset($_GET ["new"]) ? $_GET ["new"] : false; //isset — Определяет, была ли установлена переменная значением, отличным от null
 
    $query_delete = "DELETE FROM news WHERE news_id = $id_new"; 
 
    $result = mysqli_query($con, $query_delete); 
 
    if($result){ 
        echo "<script>alert('Данные удалены!'); location:href = '/admin';</script>"; 
        header("Location: /admin"); 
    } 
    else{ 
        echo "<script> alert('Ошибка удаления!".mysqli_error($con)."'); location:href = '/admin';</script>"; 
    }     
?>