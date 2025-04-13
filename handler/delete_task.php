<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $delete = $_POST["delete"];

    try {
        require_once "db_connect.php";

        $query = "DELETE FROM tasks WHERE task_id = :taskid;";
        $stmt = $pdo->prepare($query);

        $stmt->bindParam(":taskid", $delete);
        $stmt->execute();

        $pdo = null;

    } catch (PDOException $e) {
        die("Query failed:" . $e->getMessage());
    }

    if ($stmt->execute()) {
        // Redirect back to Task.php after successful deletion
        header("Location: ../pages/tasks.php?deletion=success");
        exit(); // Stop script execution after redirect
    }
}
else{
    header("Location: ../pages/tasks.php?deletion=failed");
}

