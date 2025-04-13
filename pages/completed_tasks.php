<?php 
    require_once "../handler/db_connect.php";

    try {
        $query = "SELECT * FROM tasks WHERE checked = 1 ORDER BY created_at DESC;";
        $tasks = $pdo->prepare($query);
        $tasks->execute();
        $results = $tasks->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Query failed". $e -> getMessage());
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed task - Todo</title>
    <link rel="stylesheet" href="../css/complete.css">
</head>
<body>

    <div class="main-section">
        <div class="add-section">
            <h2>Completed Tasks</h2>
            <a href="tasks.php" class="btn"> Tasks</a>
        </div>
    </div>
    <div class="show-todo-section">
        <?php if(empty($results)){?>
            <div class="todo-item">
                <p>No Task Completed</p>
            </div>
        <?php }else{ ?>
            <?php foreach ($results as $result){?>
                <div class="todo-item">
                    <input type="checkbox" class="check-box" checked disabled>
                    <h2><?php echo $result["title"]?></h2>
                </div>
            <?php }?>
        <?php }?>
    </div>
    <?php /* print_r($results); */ ?>
</body>
</html>