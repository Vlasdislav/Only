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
                <label for="login" style="display: flex; align-items: center;">
                    <span>Логин</span>
                    <span class="tooltip">
                        <img class="icon" src="../assets/icons/attention.svg" alt="!">
                        <span class="tooltip-text">Электронная почта или номер телефона</span>
                    </span>
                </label>
                <input type="text" id="login" name="login" required>
            </div>
            <div class="form-group">
                <label for="password">Пароль</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div 
                style="height: 100px"
                id="captcha-container"
                class="smart-captcha"
                data-sitekey="ysc1_HJ3gLeT2x1qxOK81EbR7hiHtsKTOWvgWRU4bopQ7008dd190"
            ></div>
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
    <script src="https://smartcaptcha.yandexcloud.net/captcha.js" defer></script>
</body>
</html>
