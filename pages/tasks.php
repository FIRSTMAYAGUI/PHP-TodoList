<?php
    require_once "../handler/config_session.php";
    require_once "../handler/db_connect.php";

   if (!isset($_SESSION["user_id"])) {
        header("Location: signup.php");
        exit();
    }
    
    $user_id = $_SESSION["user_id"];

    $query = "SELECT * FROM tasks WHERE user_id = :user_id ORDER BY task_id DESC";
    $tasks = $pdo->prepare($query);
    $tasks->bindParam(":user_id", $user_id);
    $tasks->execute();
    $results = $tasks->fetchAll(PDO::FETCH_ASSOC); 

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link rel="stylesheet" href="../css/task.css">
</head>
<body>
    
    <div class="main-section">
        <div class="add-section">
            <?php
                if (isset($_GET["message"]) && $_GET["message"] == "error") {
            ?>
                <form action="../handler/add_task.php" method="POST">
                    <input type="text" name="title" placeholder="You need to enter a task!" style="border-color: #ff6666;">
                    <div class="form-btn">
                        <button type="submit">Add Task &nbsp; <span>&#43;</span></button>
                        <a href="completed_tasks.php" class="btn">Completed Tasks</a>
                    </div>
                </form>
            <?php 
                } else { 
            ?>
                <form action="../handler/add_task.php" method="POST">
                    <input type="text" name="title" placeholder="Enter a task">
                    <div class="form-btn">
                        <button type="submit">Add Task &nbsp; <span>&#43;</span></button>
                        <a href="completed_tasks.php" class="btn">Completed Tasks</a>
                    </div>
                </form>
            <?php 
                }
            ?>          
        </div>
    </div>

    <div class="show-todo-section" style="margin-top: -24rem;">
            <div class="todo-item">
                <div class="empty">
                    <img src="../images/notebook.jpg" alt="image">
                </div>
            </div>
        <?php foreach($results as $result) {?>
            <div class="todo-item">
                <input type="checkbox" class="check-box" data_id="<?php echo $result["task_id"]?>"  
                <?php echo ($result["checked"] == 1) ? "checked ": ""; ?>>
                <h2><?php echo $result["title"]?></h2>
                <br>
                <small>Date Created:<?php echo $result["created_at"]?></small>
                <form method="POST">
                    <button type="submit" formaction="modify_task.php" class="edit" name="edit" value="<?php echo $result["task_id"]?>">edit</button>
                    <button type="submit" formaction="../handler/delete_task.php" class="remove-to-do delete" style="
                        width: 34px;
                        height: 20px;
                        font-family: sans-serif;
                        color: #fff;
                        background: rgb(224, 87, 74);
                        text-decoration: none;
                        padding: 2px;
                        cursor: pointer;
                    "
                    name="delete" 
                    value="<?php echo $result["task_id"]?>"
                    >del</button>
                </form>
            </div>
        <?php }?>
    </div>
    

    <script>
        document.querySelectorAll(".check-box").forEach(checkbox => {
        checkbox.addEventListener("change", function() {
            let taskId = this.getAttribute("data_id");
            let checked = this.checked ? 1 : 0;

            fetch("../handler/status.php", {
                method: "POST",
                headers: { "Content-Type": "application/x-www-form-urlencoded" },
                body: `task_id=${taskId}&checked=${checked}`
            })
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error("Error:", error));
        });
    });
    </script>
</body>
</html>