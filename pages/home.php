<?php session_start(); ?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Домашняя страница</title>
    <link rel="stylesheet" href="../assets/style/index.css">
    <link rel="stylesheet" href="../assets/style/pages.css">
</head>
<body>
    <div class="container">
        <h1>Добро пожаловать на наш сайт!</h1>
        <p>Пожалуйста, войдите в свой аккаунт или зарегистрируйтесь, если у вас еще нет учетной записи.</p>       
        <div class="buttons">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="./profile" class="button">Профиль</a>
                <a href="../includes/logout.php" class="button">Выйти</a>
            <?php else: ?>
                <a href="./entry" class="button">Вход</a>
                <a href="./registration" class="button">Регистрация</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
