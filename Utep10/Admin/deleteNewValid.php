<?php
include "../Connect.php";

$id_new = isset($_GET['new']) ? $_GET['new'] : false;

$delete = "DELETE FROM `News` WHERE `news_id` = $id_new";

print_r($id_new);

$result = mysqli_query($con, $delete);
if ($result) {
    echo "<script>alert('Данные удаленны'); location.href = '/Admin/' </script>";
} else {
    echo "<script>alert('Ошибка удаления " . mysqli_error($con) . "'); location.href = '/Admin/'</script>";
}