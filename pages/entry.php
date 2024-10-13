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
    <title>Вход</title>
    <link rel="stylesheet" href="../assets/style/index.css">
    <link rel="stylesheet" href="../assets/style/forms.css">
</head>
<body>
    <div class="container">
        <form class="form" action="../includes/process_entry.php" method="POST">
            <h2>Вход</h2>
            <div class="form-group">
                <label for="login">
                    Логин
                    <span class="tooltip">
                        <span class="icon">!</span>
                        <span class="tooltip-text">Электронная почта или номер телефона</span>
                    </span>
                </label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required>
            </div>
            <span class="form-maybe">Если нет аккаунта &#8212; <a href="./registration">зарегистрируйте</a></span>
            <?php if (isset($_SESSION['status'])): ?>
                <div class="alert alert-<?= $_SESSION['status'] ?>">
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['status']);
                        unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>
            <button type="submit">Войти</button>
        </form>
    </div>
</body>
</html>
