<?php
include './core/config.php'; #For requests from root project

$sql = "CREATE TABLE IF NOT EXISTS users (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name TEXT NOT NULL,
    tel TEXT NOT NULL UNIQUE,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
)";

try {
    $pdo->exec($sql);
    echo "Таблица успешно создана\n";
} catch (PDOException $e) {
    echo "Ошибка при создании таблицы" . $e->getMessage() . "\n";
}
