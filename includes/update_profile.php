<?php
session_start();
include_once '../core/config.php';

if (!isset($_SESSION['user'])) {
    header('Location: ../entry.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $tel = htmlspecialchars(strip_tags($_POST['tel']));

    $userId = $_SESSION['user']['id'];

    try {
        $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, tel = :tel WHERE id = :id");
        $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':tel' => $tel,
            ':id' => $userId
        ]);

        $_SESSION['user']['name'] = $name;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['tel'] = $tel;

        $_SESSION['status'] = "success";
        $_SESSION['message'] = "Данные успешно обновлены!";
        header('Location: ../profile');
    } catch (PDOException $e) {
        $_SESSION['status'] = "error";
        $_SESSION['message'] = "Ошибка при обновлении данных: " . $e->getMessage();
        header('Location: ../profile');
    }
}
