<?php 
    session_start();
    require_once "../handler/db_connect.php";
    
    if (!isset($_SESSION["user_id"])) {
        header("Location: tasks.php");
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $task_id = $_POST['edit'];
        $user_id = $_SESSION["user_id"];

        try {
            $query = "SELECT * FROM tasks WHERE task_id = :task_id AND user_id = :userId";
            $stmt = $pdo->prepare($query);
            $stmt -> bindParam(':task_id', $task_id);
            $stmt -> bindParam(':userId', $user_id);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            $pdo = null;
        } catch (PDOException $e) {
            die("Query failed ". $e -> getMessage());
        }
    }
    else{
        /* header("Location: Task.php");
        exit(); */
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit task - Todo</title>
    <link rel="stylesheet" href="../css/modify.css">
</head>
<body>
    <div class="main-section">
        <div class="add-section">
            <h2>Modify Task</h2>
            <form action="../handler/update_task.php" method="POST">
                <input type="hidden" name="task_id" value="<?php echo $result['task_id']; ?>">
                <input type="text" name="title" value="<?php echo htmlspecialchars($result['title']); ?>" required>
                <div class="btn" style="
                    width: 100%;
                    display: flex;
                    align-items: end;
                "><button type="submit">Modify</button></div>
            </form>
        </div>
    </div>
</body>
</html>