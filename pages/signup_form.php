<?php
    require_once "../handler/config_session.php";
    require_once "../handler/signup_handler/signup_views.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Todo List</title>
    <link rel="stylesheet" href="../css/signup.css">
</head>
<body>

    <!-- signupform -->
    <div class="container">
        <div class="login-container">
            <form action="../handler/signup_handler/signup_validation.php" method="POST" class="form">
                <h1>Sign Up</h1>
                <?php signup_errors_check() ?>
                <?php signup_inputs() ?>
            </form>
        </div>
    </div>
</body>
</html>