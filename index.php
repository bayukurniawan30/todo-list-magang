<?php
    session_start();

    require __DIR__ . DIRECTORY_SEPARATOR . 'include' . DIRECTORY_SEPARATOR . 'global.php';

    // Connection
    require __DIR__ . DS . 'include' . DS . 'connection.php';
    // Global

    $page         = isset($_GET['page']) ? $_GET['page'] : NULL; 
    $userId       = isset($_SESSION['id']) ? $_SESSION['id'] : NULL; 
    $userPassword = isset($_SESSION['password']) ? $_SESSION['password'] : NULL; 

    switch ($page) {
        case "dashboard":
            require __DIR__ . DS . 'dashboard.php';
            break;
        case "register":
            require __DIR__ . DS . 'register.php';
            break;
        default:
            require __DIR__ . DS . 'login.php';
    }
?>