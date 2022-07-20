<?php

require "../classes/task.php";

session_start();
$user_id = $_SESSION['user_id'];

$task = new Task;
$tasks_result = $task->getPastTasks($user_id);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAST TASKS</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- style sheet -->
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>
    
<?php
if($_SESSION['role'] == "U"){
    require_once "../navbar/nav-bar-user.php";
}else{
    require_once "../navbar/nav-bar-admin.php";
}
?>

<div  class="container-fluid">

    <main class="h-100 w-75 mx-auto mt-5">
        <h1 class="text-center">PAST TASKS</h1>

        <div class="row mb-2">
            <div class="col">
                <a href="task-add.php" class="text-decoration-none">
                <button type="button" class="btn btn-secondary d-block me-auto"><i class="fa-solid fa-circle-plus"></i> Add Task</button></a>
            </div>
            
        </div>

        <div class="card">
            <div class="card-body">
                <p class="card-text m-3">
                    <table class="table">
                        <tbody>

                            <?php
                            while($tasks_row = $tasks_result->fetch_assoc()){
                            ?>
                                    <tr>
                                    <td hidden><div class=""><?= $tasks_row['task_id'] ?></div></td>
                                    <td><div class=""><?= $tasks_row['task_name'] ?></div></td>
                                    <td><div class=""><i class="fa-solid fa-paper-plane"></i> <?= $tasks_row['first_name']." ".$tasks_row['last_name']?></div></td>
                                    <td><div class=""><i class="fa-solid fa-hourglass"></i>　<?= $tasks_row['deadline'] ?></div></td>
                                    <td><div class=""><span class="bg-secondary p-1"><?= $tasks_row['task_status'] ?></span></div></td>
                                    <td><div class=""><a href="task-detail.php?task_id=<?= $tasks_row['task_id'] ?>"><i class="fa-solid fa-angles-right"></i></a></div></td>
                                    </tr>
                            <?php                                        
                            }
                            ?>      
                        </tbody>
                    </table>
                </p>
            </div> 

        </div>

        <div class="mt-3"><a href="dashboard-user.php"><i class="fa-solid fa-angle-left"></i></a></div>
    </main>

</div>
</body>
</html>