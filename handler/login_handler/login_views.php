<?php
declare(strict_types=1);

function Redirect_to_task()
{
    if (isset($_SESSION["User_User_id"])){
        /* echo "You are logged in as"." ". $_SESSION["User_User_Name"]; */
        header("Location: ../../pages/tasks.php");
    } else {
        /* echo "You are not logged in"; */
        header("Lcation: ../../index.php");
    }
}

function check_login_errors()
{
    if(isset($_SESSION["Login_errors"])){
        $errors = $_SESSION["Login_errors"];

      /*   echo"<br>"; */

        foreach ($errors as $error){
            echo'
                <div class="error">
                    <small class="red">'.$error.'</small>
                </div>
            ';
        }

        unset($_SESSION["Login_errors"]);
    }
    else if (isset($_GET["login"]) && $_GET["login"] === "success"){
       header("Location: ../../pages/tasks.php");
    }
}