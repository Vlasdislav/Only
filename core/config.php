<?php

try {
    $pdo = new PDO('sqlite:'. __DIR__ . '/db/database.db');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Успешное подключение к БД.\n";
} catch (PDOException $e) {
    echo "Ошибка подключения к БД: " .  $e->getMessage() . "\n";
}
