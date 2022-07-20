<?php

require "../classes/task.php";

session_start();
$user_id = $_SESSION['user_id'];

require_once "../classes/summary.php";
$task = new Task;
$tasks_result = $task->getRequestTodayUserTasks($user_id);

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DUE TODAY REQUESTING TASKS</title>
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
        <h1 class="text-center">DUE TODAY <br> REQUESTING TASKS</h1>

        <input class="form-control w-25 ms-auto mb-1" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
        <datalist id="datalistOptions">
        <option value="San Francisco">
        <option value="New York">
        <option value="Seattle">
        <option value="Los Angeles">
        <option value="Chicago">
        </datalist>

        <div class="card">
            <div class="card-body">
                <p class="card-text m-3">
                    <table class="table">
                        <tbody>
                            <?php
                            while($tasks_row = $tasks_result->fetch_assoc()){
                            ?>
                                <tr>
                                <td hidden><?= $tasks_row['task_id'] ?></td>
                                <td><?= $tasks_row['task_name'] ?></td>
                                <td><i class="fa-solid fa-paper-plane"></i> <?= $tasks_row['first_name']." ".$tasks_row['last_name']?></td>
                                <td><i class="fa-solid fa-hourglass"></i>　<?= $tasks_row['deadline'] ?></td>
                                <td>
                                <?php
                                    if($tasks_row['task_status'] == "ongoing"){
                                ?>
                                        <span class="text-center bg-info p-1"><?=$tasks_row['task_status']?></span>
                                <?php
                                    }elseif($tasks_row['task_status'] == "planning"){
                                ?>
                                        <span class="text-center bg-primary p-1"><?=$tasks_row['task_status']?></span>
                                <?php
                                    }elseif($tasks_row['task_status'] == "pending"){
                                ?>
                                        <span class="text-center bg-success p-1"><?=$tasks_row['task_status']?></span>
                                <?php
                                    }elseif($tasks_row['task_status'] == "postpone"){
                                ?>
                                    <span class="text-center bg-warning p-1"><?=$tasks_row['task_status']?></span>                                        
                                <?php
                                    }elseif($tasks_row['task_status'] == "canceled"){
                                ?>
                                    <span class="text-center bg-danger p-1"><?=$tasks_row['task_status']?></span>                                        
                                <?php
                                    }elseif($tasks_row['task_status'] == "done"){
                                ?>
                                    <span class="text-center bg-secondary p-1"><?=$tasks_row['task_status']?></span>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><a href="task-detail.php?task_id=<?= $tasks_row['task_id'] ?>"><i class="fa-solid fa-angles-right"></i></a></td>
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