<?php
    session_start();

    require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'global.php';
    require __DIR__ . DS . '..' . DS . 'connection.php';
    require __DIR__ . DS . '..' . DS . 'class' . DS . 'ListsClass.php';

    $data = json_encode($_POST);

    $listsClass = new ListsClass($pdo);
    $delete     = $listsClass->delete($data);

    if ($delete) {
        header("location: ../../index.php?page=dashboard&act=delete-list&status=1");
    }
    else {
        header("location: ../../index.php?page=dashboard&act=delete-list&status=0");
    }
?>