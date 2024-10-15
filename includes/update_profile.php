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
    $password = htmlspecialchars(strip_tags($_POST['password']));
    $new_password = htmlspecialchars(strip_tags($_POST['new_password']));

    $userId = $_SESSION['user']['id'];

    if ($password) {
        if ($new_password) {
            try {
                $new_password = password_hash($new_password, PASSWORD_DEFAULT);

                $stmt = $pdo->prepare("SELECT password FROM users WHERE id = :id");
                $stmt->execute([
                    ':id' => $userId
                ]);
            } catch (PDOException $e) {
                echo "Ошибка поиске пароля по `id`: " . $e->getMessage() . "\n";
            }
            try {
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if (password_verify($password, $user['password'])) {
                    $stmt = $pdo->prepare("UPDATE users SET name = :name, email = :email, tel = :tel, password = :password WHERE id = :id");
                    $stmt->execute([
                        ':name' => $name,
                        ':email' => $email,
                        ':tel' => $tel,
                        ':id' => $userId,
                        ':password' => $new_password
                    ]);

                    $_SESSION['user']['name'] = $name;
                    $_SESSION['user']['email'] = $email;
                    $_SESSION['user']['tel'] = $tel;
        
                    $_SESSION['status'] = "success";
                    $_SESSION['message'] = "Данные успешно обновлены!";
                    header('Location: ../profile');
                } else {
                    $_SESSION['status'] = "error";
                    $_SESSION['message'] = "Пароль введен не верно!";
                    header('Location: ../profile');
                }
            } catch (PDOException $e) {
                echo "Ошибка при обновлении данных: " . $e->getMessage() . "\n";
            }
        } else {
            $_SESSION['status'] = "error";
            $_SESSION['message'] = "Новый пароль не может быть пустым!";
            header('Location: ../profile');
        }
    } else {
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
            echo "Ошибка при обновлении данных: " . $e->getMessage() . "\n";
        }
    }
}
