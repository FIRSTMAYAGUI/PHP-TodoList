<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = htmlspecialchars($_POST["name"]);
    $userpwd = htmlspecialchars($_POST["pwd"]);

    try{

        require_once "../db_connect.php";
        require_once "login_model.php";
        require_once "login_controller.php";

        //Error handler
        $errors = [];

        $result = get_username($pdo, $username);
        if(verify_if_username_is_wrong($result)){
            $errors["login_incorrect"] = "Incorrect login information!";
        }

        if(!verify_if_username_is_wrong($result) && verify_if_the_password_wrong($userpwd, $result["user_pwd"])){
            $errors["password_incorrect"] = "Incorrect login information!";
        }

        require_once "../config_session.php";

        if($errors){
            $_SESSION["Login_errors"] = $errors;

            header("Location: ../../pages/login_form.php");
            die();
        }

        if(!$errors){
                $_SESSION["user_id"] = $result["user_id"];
                $_SESSION["user_name"] = $result["user_name"];
        }

        header("Location: ../../pages/tasks.php?login=success");
        
        $pdo = null;
        $pstmt = null;

        die();

    }  catch(PDOException $e){
        die("Query failed: " . $e->getMessage());
    }

} else{
    header("Location: ../../pages/login_form.php?login=failed");
    die();
}

?>