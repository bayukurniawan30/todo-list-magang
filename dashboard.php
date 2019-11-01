<?php
    $userId       = isset($_SESSION['id']) ? $_SESSION['id'] : NULL; 
    $userPassword = isset($_SESSION['password']) ? $_SESSION['password'] : NULL; 

    if (empty($userId) && empty($userPassword)) {
        header("location: index.php");
    }

    require __DIR__ . DS . 'include' . DS . 'class' . DS . 'UsersClass.php';
    require __DIR__ . DS . 'include' . DS . 'class' . DS . 'CategoriesClass.php';
    require __DIR__ . DS . 'include' . DS . 'class' . DS . 'ListsClass.php';

    $act    = isset($_GET['act']) ? $_GET['act'] : NULL; 
    $status = isset($_GET['status']) ? $_GET['status'] : NULL; 
    $assign = isset($_GET['assign']) ? $_GET['assign'] : NULL; 
    $cat    = isset($_GET['cat']) ? $_GET['cat'] : NULL; 
    $alert  = NULL;

    $usersClass = new UsersClass($pdo);
    $user       = $usersClass->userData($_SESSION['id']);

    $categoriesClass = new CategoriesClass($pdo);
    $fetchCategories = $categoriesClass->fetch();

    $listsClass         = new ListsClass($pdo);
    $fetchTodayLists    = $listsClass->fetch($cat, 'today');
    $fetchTomorrowLists = $listsClass->fetch($cat, 'tomorrow');
    $fetchUpcomingLists = $listsClass->fetch($cat, 'upcoming');
    $fetchLists         = $listsClass->fetch($cat, $assign);


    switch ($act) {
        case "add-category":
            if ($status == '1') {
                $alert = '<div class="uk-alert-success" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>Success add category.</p>
                </div>';
            }
            elseif ($status == '0') {
                $alert = '<div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>Error add category. Please try again</p>
                </div>';
            }
            else {
                $alert = '';
            }

            break;
        case "add-list":
            if ($status == '1') {
                $alert = '<div class="uk-alert-success" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>Success add todo list.</p>
                </div>';
            }
            elseif ($status == '0') {
                $alert = '<div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>Error add todo list. Please try again</p>
                </div>';
            }
            else {
                $alert = '';
            }
            break;
        case "check-list":
            if ($status == '1') {
                $alert = '<div class="uk-alert-success" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>Success check todo list.</p>
                </div>';
            }
            elseif ($status == '0') {
                $alert = '<div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>Error check todo list. Please try again</p>
                </div>';
            }
            else {
                $alert = '';
            }
            break;
        case "delete-list":
            if ($status == '1') {
                $alert = '<div class="uk-alert-success" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>Success delete todo list.</p>
                </div>';
            }
            elseif ($status == '0') {
                $alert = '<div class="uk-alert-danger" uk-alert>
                    <a class="uk-alert-close" uk-close></a>
                    <p>Error delete todo list. Please try again</p>
                </div>';
            }
            else {
                $alert = '';
            }
            break;
        default:
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Dashboard - <?= APP_TITLE ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/uikit.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
        <script src="assets/js/uikit.min.js"></script>
        <script src="assets/js/uikit-icons.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <style>
            body {
                background: #efefef;
                min-height: 100vh;
            }
            .btn-white {
                background-color: #ffffff;
            }
            .btn-white:hover, .btn-white:focus {
                background-color: #ffffff;
            }
            .strike {
                text-decoration: line-through;
            }
        </style>
    </head>
    <body>
        <?php
            require __DIR__ . DS . 'dashboard-navbar.php';
            require __DIR__ . DS . 'dashboard-content.php';

            // Modals
            require __DIR__ . DS . 'dashboard-modal-add-category.php';
            require __DIR__ . DS . 'dashboard-modal-add-list.php';
            require __DIR__ . DS . 'dashboard-modal-check-list.php';
            require __DIR__ . DS . 'dashboard-modal-delete-list.php';
        ?>

        <script>
            // Check Buttons
            var btnCheckList = document.getElementsByClassName("btn-check-list");
            for (var i = 0; i < btnCheckList.length; i++) {
                btnCheckList[i].addEventListener("click", function() {
                    var btn   = this;
                    var id    = this.getAttribute("data-bind-id");
                    var todo  = this.getAttribute("data-bind-todo");
                    var list  = this.getAttribute("data-bind-list");
                    var modal = document.getElementById("#modal-check-list");
                    document.getElementById("check-bind-todo-id").value  = id; 
                    document.getElementById("check-bind-todo").innerHTML = todo; 
                    document.getElementById("check-bind-list").innerHTML = list; 
                    
                    UIkit.modal("#modal-check-list").show();

                    return false;
                });
            }

            // Delete Buttons
            var btnDeleteList = document.getElementsByClassName("btn-delete-list");
            for (var i = 0; i < btnDeleteList.length; i++) {
                btnDeleteList[i].addEventListener("click", function() {
                    var btn   = this;
                    var id    = this.getAttribute("data-bind-id");
                    var todo  = this.getAttribute("data-bind-todo");
                    var list  = this.getAttribute("data-bind-list");
                    var modal = document.getElementById("#modal-delete-list");
                    document.getElementById("delete-bind-todo-id").value  = id; 
                    document.getElementById("delete-bind-todo").innerHTML = todo; 
                    document.getElementById("delete-bind-list").innerHTML = list; 
                    
                    UIkit.modal("#modal-delete-list").show();

                    return false;
                });
            }
        </script>
    </body>
</html>