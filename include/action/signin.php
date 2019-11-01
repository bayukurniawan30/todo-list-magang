<?php
    session_start();

    require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'global.php';
    require __DIR__ . DS . '..' . DS . 'connection.php';
    require __DIR__ . DS . '..' . DS . 'class' . DS . 'UsersClass.php';

    $data = json_encode($_POST);

    $usersClass = new UsersClass($pdo);
    $signin     = $usersClass->signin($data);

    if ($signin) {
        header("location: ../../index.php?page=dashboard");
    }
    else {
        header("location: ../../index.php?status=0");
    }
?>