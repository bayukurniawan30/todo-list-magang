<?php
    $status = isset($_GET['status']) ? $_GET['status'] : NULL; 
    if ($status == '0') {
        // Gagal
        $errorStatus = '<div class="uk-alert-danger" uk-alert>
            <a class="uk-alert-close" uk-close></a>
            <p>Sign in failed. Please try again.</p>
        </div>';
    }
    else {
        $errorStatus = '';
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign In - <?= APP_TITLE ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/uikit.min.css" />
        <script src="assets/js/uikit.min.js"></script>
        <script src="assets/js/uikit-icons.min.js"></script>
    </head>
    <body>
        <div class="uk-height-viewport uk-flex uk-flex-center uk-flex-middle uk-background-primary" uk-grid>
            <div class="uk-card uk-card-default uk-card-body uk-width-1-3">
                <h1 class="uk-text-center">ToDo List</h1>

                <h3 class="uk-margin-remove-bottom">Sign In</h3>
                <p class="uk-margin-remove-top">Please signin with your account</p>

                <form action="include/action/signin.php" method="post">
                    <div class="uk-margin">
                        <div class="uk-inline" style="width: 100%">
                            <span class="uk-form-icon" uk-icon="icon: user"></span>
                            <input id="input-username" class="uk-input" type="text" name="username" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <div class="uk-inline" style="width: 100%">
                            <span class="uk-form-icon" uk-icon="icon: lock"></span>
                            <input id="input-password" class="uk-input" type="password" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div style="width: 100%"><?= $errorStatus ?></div>
                    <div class="uk-margin uk-margin-remove-bottom">
                        <button class="uk-button uk-button-primary uk-align-center uk-margin-remove-bottom" type="submit">Sign In</button>
                        <p class="uk-text-center"><a href="?page=register">Don't have account? Register now</a></p>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>