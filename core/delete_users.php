<?php
include 'config.php';

$sql = "DELETE FROM users";

try {
    $pdo->exec($sql);
    echo "Таблица успешно удалена\n";
} catch (PDOException $e) {
    echo "Ошибка при удалении таблицы" . $e->getMessage() . "\n";
}
