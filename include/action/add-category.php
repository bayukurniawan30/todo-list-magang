<?php
    session_start();

    require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'global.php';
    require __DIR__ . DS . '..' . DS . 'connection.php';
    require __DIR__ . DS . '..' . DS . 'class' . DS . 'CategoriesClass.php';

    $data = json_encode($_POST);

    $categoriesClass = new CategoriesClass($pdo);
    $add             = $categoriesClass->add($data);

    if ($add) {
        header("location: ../../index.php?page=dashboard&act=add-category&status=1");
    }
    else {
        header("location: ../../index.php?page=dashboard&act=add-category&status=0");
    }
?>