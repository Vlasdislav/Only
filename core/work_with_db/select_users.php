<?php
include './core/config.php'; # For requests from root project

try {
    $sql = "SELECT * FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($users);
} catch (PDOException $e) {
    echo "Ошибка при выводе таблицы `users`: " . $e->getMessage() . "\n";
}
