<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["task_id"], $_POST["checked"])) {
    require_once "db_connect.php";

    $task_id = $_POST["task_id"];
    $checked = $_POST["checked"];

    try {
        $query = "UPDATE tasks SET checked = :checked WHERE task_id = :task_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(":checked", $checked, PDO::PARAM_INT);
        $stmt->bindParam(":task_id", $task_id, PDO::PARAM_INT);
        $stmt->execute();

        echo "Task status updated successfully.";
        header("Location: ../pages/tasks.php");
    } catch (PDOException $e) {
        echo "Error updating task status: " . $e->getMessage();
    }
} else {
    header("Location: ../pages/tasks.php");
    exit();
}
?>