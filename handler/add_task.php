<?php
session_start();
require_once "db_connect.php";

if (!isset($_SESSION["user_id"])) {
    header("Location: ../../pages/tasks.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $title = $_POST["title"];
    $user_id = $_SESSION["user_id"];

    if(empty($title)){
        header("Location: ../pages/tasks.php?message=error");
    } 
    
    else{
        try {

            $query = "INSERT INTO tasks (title, user_id) VALUES (:title, :user_id);";
            $stmt = $pdo->prepare($query);
            $stmt -> bindParam(":title", $title);
            $stmt -> bindParam(":user_id", $user_id);
            
            $stmt->execute();
            $pdo =  null;  
            $stmt = null;
            header("Location: ../pages/tasks.php");

            die();
        } catch (PDOException $e) {
            die("Query failed:" . $e->getMessage());
        }
        
    }
}
else{
    header("Location: .../pages/tasks.php?mesage=failed-add");
    die();
}