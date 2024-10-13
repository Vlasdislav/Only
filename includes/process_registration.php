<?php
session_start();

include_once '../core/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm-password'];

    $password = htmlspecialchars(strip_tags($password));
    $$confirmPassword = htmlspecialchars(strip_tags($confirmPassword));

    if ($password !== $confirmPassword) {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Пароли не совпадают.";
        header('Location: ../registration');
        exit();
    }

    $name = $_POST['name'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];

    $name = htmlspecialchars(strip_tags($name));
    $tel = htmlspecialchars(strip_tags($tel));
    $email = htmlspecialchars(strip_tags($email));

    $password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :email OR tel = :tel");
        $stmt->execute([
            ':email' => $email,
            ':tel' => $tel
        ]);
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($user) > 0) {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "Пользователь с таким email или телефоном уже существует!";
            header('Location: ../registration');
            exit();
        }
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage() . "\n";
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, tel, email, password) VALUES (:name, :tel, :email, :password)");
        $stmt->execute([
            ':name' => $name,
            ':tel' => $tel,
            ':email' => $email,
            ':password' => $password
        ]);
        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Регистрация прошла успешно!";
        header('Location: ../entry');
    } catch (PDOException $e) {
        echo "Ошибка: " . $e->getMessage() . "\n";
    }
} else {
    echo "Метод запроса не обработан\n";
}
