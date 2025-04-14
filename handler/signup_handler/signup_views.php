<?php
declare(strict_types=1);

function signup_inputs(){
    if(isset($_SESSION["signup_data"]["name"]) && isset($_SESSION["signup_errors"]["name_taken"])){
        echo '
        <div class="inputs">
            <input type="text" id="name" name="name" placeholder="Enter your name"  value='.$_SESSION["signup_data"]["name"].' required>
            <input type="password" id="pwd" name="pwd" placeholder="Enter password" required>
            <input type="password" id="pwd" name="confirm-pwd" placeholder="Confirm password" required>
        </div>
        <div class="btn">
            <button type="submit">Sign up</button>
            <div class="login">
                <small>already have an account?</small>
                <a href="login_form.php" class="btn">Log in</a>
            </div>
        </div>';
    }
    else{
        echo '
        <div class="inputs">
            <input type="text" id="name" name="name" placeholder="Enter your name"  value="" required>
            <input type="password" id="pwd" name="pwd" placeholder="Enter password" required>
            <input type="password" id="pwd" name="confirm-pwd" placeholder="Confirm password" required>
        </div>
        <div class="btn">
            <button type="submit">Sign up</button>
            <div class="login">
                <small>already have an account?</small>
                <a href="login_form.php" class="btn">Log in</a>
            </div>
        </div>';
    } 

}

function signup_errors_check()
{
    if(isset($_SESSION["signup_errors"])){
        $errors = $_SESSION["signup_errors"];

        foreach($errors as $error) /* this loop goes through all the errors that was defined in signup_handler.php file and looks for the appropriate error and displays it to the user*/
        {
          echo '
            <div class="error">
              <small class="red">'. $error .'</small>
            </div>';
        }

        unset($_SESSION["signup_errors"]);

    }
}

?>