<?php
session_start();

include_once '../core/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $login = $_POST['login'];

    $login = htmlspecialchars(strip_tags($login));

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
            exit();
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "Неправильный логин или пароль!";
            header('Location: ../entry');
            exit();
        }
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage() . "\n";
    }
} else {
    echo "Метод запроса не обработан\n";
}
