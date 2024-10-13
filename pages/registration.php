<?php session_start();
if (isset($_SESSION['user'])) {
    header('Location: ./profile');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../assets/style/index.css">
    <link rel="stylesheet" href="../assets/style/forms.css">
</head>
<body>
    <div class="container">
        <form class="form" action="../includes/process_registration.php" method="POST">
            <h2>Регистрация</h2>
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="tel">Телефон</label>
                <input type="tel" id="tel" name="tel" required>
            </div>
            <div class="form-group">
                <label for="email">Электронная почта</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Подтверждение пароля</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <span class="form-maybe">Если есть аккаунт &#8212; <a href="./entry">войдите</a></span>
            <?php if (isset($_SESSION['status'])): ?>
                <div class="alert alert-<?= $_SESSION['status'] ?>">
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['status']);
                        unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>
            <button type="submit">Зарегистрироваться</button>
        </form>
    </div>
</body>
</html>
