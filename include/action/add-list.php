<?php
    session_start();

    require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'global.php';
    require __DIR__ . DS . '..' . DS . 'connection.php';
    require __DIR__ . DS . '..' . DS . 'class' . DS . 'ListsClass.php';

    $data = json_encode($_POST);

    $listsClass = new ListsClass($pdo);
    $add        = $listsClass->add($data);

    if ($add) {
        header("location: ../../index.php?page=dashboard&act=add-list&status=1");
    }
    else {
        header("location: ../../index.php?page=dashboard&act=add-list&status=0");
    }
?>