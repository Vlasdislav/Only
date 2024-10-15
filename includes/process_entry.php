<?php
session_start();

include_once '../core/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlspecialchars(strip_tags($login));
    $password = htmlspecialchars(strip_tags($password));

    $token = $_POST['smart-token'] ?? '';

    $secretKey = 'ЗДЕСЬ_ДОЛЖЕН_БЫТЬ_СЕКРЕТНЫЙ_КЛЮЧ';

    $url = 'https://smartcaptcha.yandexcloud.net/validate';
    $data = [
        'secret' => $secretKey,
        'token' => $token,
        'ip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = [
        'http' => [
            'header'  => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data),
        ]
    ];
    
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);
    
    if ($result['status'] === 'ok') {
        echo "SmartCaptcha успешно пройдена!\n";
        try {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :login OR tel = :login");
            $stmt->execute([
                ':login' => $login,
            ]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['name'] = $user['name'];
                $_SESSION['user']['email'] = $user['email'];
                $_SESSION['user']['tel'] = $user['tel'];
                
                $_SESSION['status'] = "success";
                $_SESSION['message'] = "Успешный вход!";
                header('Location: ../profile');
            } else {
                $_SESSION['status'] = "error";
                $_SESSION['message'] = "Неправильный логин или пароль!";
                header('Location: ../entry');
            }
        } catch (PDOException $e) {
            echo "Ошибка: " . $e->getMessage() . "\n";
        }
    } else {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Не удалось пройти SmartCaptcha. Попробуйте снова.";
        header('Location: ../entry');
    }
} else {
    echo "Метод запроса не обработан\n";
}
