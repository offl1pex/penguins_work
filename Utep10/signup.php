<?php 
include "Connect.php";
include "aheader.php";
?>
<main>
    <div class="container">
        <h4 class="mb-4">Регистрация</h4>
        <form action="/DB/signup-DB.php" method="post">
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Электронная почта</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="nicname">
                <label for="floatingInput">Никнейм</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingInput" placeholder="Password">
                <label for="floatingInput">Пароль</label>
            </div>
            <button type="submit" class="btn btn-primary md-3">Зарегистрироваться</button>
            <div class="form-text">Нет аккунта?
                <a href="/signin.php" class="link-success link-offset-2">Войдите</a>
            </div>
        </form>
    </div>
</main>
</body>

</html>