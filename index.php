<?php
$requestUri = trim($_SERVER['REQUEST_URI'], '/');

switch ($requestUri) {
    case '':
        require __DIR__ . '/pages/home.php';
        break;
    case 'home':
        require __DIR__ . '/pages/home.php';
        break;
    case 'registration':
        require __DIR__ . '/pages/registration.php';
        break;
    case 'entry':
        require __DIR__ . '/pages/entry.php';
        break;
    case 'profile':
        require __DIR__ . '/pages/profile.php';
        break;
    default:
        require __DIR__ . '/pages/404.php';
        break;
}
