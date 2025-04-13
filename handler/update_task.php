<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $task = $_POST["task_id"];
    $new_task = $_POST["title"];

    try {
        require_once "db_connect.php";

        $query = "UPDATE tasks SET title = :title WHERE task_id = :task_id;";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":title", $new_task);
        $stmt->bindParam(":task_id", $task);
        $stmt->execute();

        $pdo = null;

    } catch (PDOException $e) {
        die("Query failed:" . $e->getMessage());
    }

    if ($stmt->execute()) {
        // Redirect back to tasks.php after successful modification
        header("Location: ../pages/tasks.php?modified=success");
        exit(); // Stop script execution after redirect
    }
}
else{
    header("Location: ../pages/tasks.php?modified=failed");
}

