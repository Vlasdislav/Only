<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('Location: ./home');
    exit();
}

$user = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/style/index.css">
    <link rel="stylesheet" href="../assets/style/forms.css">
    <title>Профиль пользователя</title>
</head>
<body>
    <div class="container">
        <form class="form" action="../includes/update_profile.php" method="POST">
            <h2>Профиль</h2>
            <div class="form-group">
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" value=<?= $user['name'] ?> required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value=<?= $user['email'] ?> required>
            </div>
            <div class="form-group">
                <label for="tel">Телефон</label>
                <input type="tel" id="tel" name="tel" value=<?= $user['tel'] ?> required>
            </div>
            <span class="edit-password-btn">Изменить пароль</span>
            <div class="edit-password-form">
                <div class="form-group">
                    <label for="password">Введите свой пароль</label>
                    <input type="password" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="new_password">Введите новый пароль</label>
                    <input type="password" id="new_password" name="new_password">
                </div>
            </div>
            <?php if (isset($_SESSION['status'])): ?>
                <div class="alert alert-<?= $_SESSION['status'] ?>">
                    <?php
                        echo $_SESSION['message'];
                        unset($_SESSION['status']);
                        unset($_SESSION['message']);
                    ?>
                </div>
            <?php endif; ?>
            <div class="buttons">
                <span class="form-maybe"><a href="./" class="button">Домой</a></span>
                <span class="form-maybe"><a href="../includes/logout.php" class="button">Выйти</a></span>
            </div>
            <button type="submit" class="button">Сохранить изменения</button>
        </form>
    </div>
    <script src="../assets/js/main.js"></script>
</body>
</html>
