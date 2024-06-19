<?php 
include "Connect.php";
include "aheader.php";
session_start();
$id = $_SESSION['user_id'];
$user = mysqli_fetch_array(mysqli_query($con, "SELECT * from users where user_id = $id"));
?>
<main>

    <div class="container">
        <h2>
            Личный кабинет
        </h2>
        <form action="/Update-Personal-account.php" method = "POST">
            <div class="mb-3">
                <input type="hidden" name = "ID" value="<?=$id?>">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name = "email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $user["email"] ?>">
                <label for="exampleInputEmail1" class="form-label">Nickname</label>
                <input type="text" name = "username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= $user["username"] ?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</main>
</body>
</html>