<?php
    require_once "../handler/config_session.php";
    require_once "../handler/login_handler/login_views.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Todo List</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>
    <!-- loginform -->
    <div class="container">
        <div class="login-container">
            <form action="../handler/login_handler/login_validation.php" method="POST" class="form">
                <h1>Log in</h1>
                <?php check_login_errors() ?>
                <div class="inputs">
                    <input type="text" id="name" name="name" placeholder="Enter your name" required>
                    <input type="password" id="pwd" name="pwd" placeholder="Enter password" required>
                </div>
                <div class="btn">
                    <button type="submit">Log in</button>
                    <div class="login">
                        <small>No account?</small>
                        <a href="signup_form.php" class="btn">create account</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>