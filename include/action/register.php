<?php
    require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'global.php';
    require __DIR__ . DS . '..' . DS . 'connection.php';
    require __DIR__ . DS . '..' . DS . 'class' . DS . 'UsersClass.php';

    $data = json_encode($_POST);

    $usersClass = new UsersClass($pdo);
    $register   = $usersClass->register($data);

    if ($register) {
        header("location: ../../index.php");
    }
    else {
        header("location: ../../index.php?page=register&status=0");
    }
?>