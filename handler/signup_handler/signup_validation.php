<?php
//Handling signup data

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = htmlspecialchars($_POST["name"]);
    $pwd = htmlspecialchars($_POST["pwd"]);
    $confirm_pwd = htmlspecialchars($_POST["confirm-pwd"]);
    
try {

    require_once "../db_connect.php"; //including code from the connection file 
    require_once "signup_model.php"; // including code from the signup_model file 
    require_once "signup_controller.php"; //including code from the signup_controller file 

    //Error checking

        $errors = [];
        
        if(verify_input($username, $pwd)){
            $errors["empty_input"] = "Fill in all the fields!";
        }

        if(verify_user_name($pdo, $username)){
            $errors["name_taken"] = "User already exist";
        }

        require_once "../config_session.php"; // including the code from the config_session file in other to start a session

        if($errors){
            $_SESSION["signup_errors"] = $errors; //stores the errors in the session variable array: $_SESSION["signup_errors"]

            /* $signupdata = [
                "user_name" => $username */
                 /* note that I can give the key array any name I just used u_name(user name) for it to make sense and because I've been using it at the start of my code. That is, at the place of u_name I could put username or user_name or simply name etc... */

            /* ]; */ //taking data entered by the user(except the password) and storing them in array

            $_SESSION["signup_data"] = $username; //storing the $signupdata in a session variable

            header("Location: ../../pages/signup_form.php"); //sends the user back to the front page if there is an error 

            die();  /* terminates the code to avoid the ones coming after from running if there is an error */
        }

        create_user($pdo, $confirm_pwd, $username, $pwd); //add the user to the database(DB) if no error

        /* $userId = set_user($pdo, $username, $pwd); */ // it sent me an error when this line is written

            $_SESSION["user_name"] = $username;
            $_SESSION["user_id"] = $pdo->lastInsertId();

        header("Location: ../../pages/tasks.php?signup=success"); //after adding the user to the DB, sends the user back to the main page 

            $pdo =  null;  
            $stmt = null;

        die(); //terminates the code

} catch (PDOException $e) {
     die("Query failed:" . $e->getMessage());
}
} else{
    header("Location: ../../pages/signup_form.php?signup=failed");
    die();
}