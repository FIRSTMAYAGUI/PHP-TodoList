<?php
 declare(strict_types=1);
 
function get_username(object $pdo, string $username)
{
    $query = "SELECT user_name FROM users WHERE user_name = :username;";
    $stmt = $pdo->prepare($query);
    $stmt -> bindParam(":username", $username);
    $stmt -> execute();

    $results = $stmt -> fetch(PDO::FETCH_ASSOC);//fetch only one data from the database
    return $results;
}

function set_user(object $pdo, string $confirm_pwd,  string $username, string $pwd)
{
    if($confirm_pwd === $pwd ){
        $query = "INSERT INTO users (user_name, user_pwd) VALUES (:username, :pwd);";
        $stmt = $pdo->prepare($query);
        
        $options = ["cost" => 12];
    
        $hashed_pwd = password_hash($pwd, PASSWORD_BCRYPT, $options);
    
        $stmt -> bindParam(":username", $username);
        $stmt -> bindParam(":pwd", $hashed_pwd);
        
        $stmt -> execute();
    
        $results = $stmt -> fetch(PDO::FETCH_ASSOC);//fetch only one data from the database
        return $results;
    }
}