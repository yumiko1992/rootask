<?php

session_start();
$user_id = $_SESSION['user_id'];

require_once "../classes/task.php";

$task_id = $_GET['task_id'];

$task = new Task;
$task_result = $task->getTaskDetails($task_id);
$task_row = $task_result->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
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

    <main class="card w-50 mx-auto border-0 my-4">
    <div class="card-header bg-white border-0">
        <h2 class="card-title text-center text-danger h4 mb-0">Delete Task</h2>
    </div>

    <div class="card-body">
        <div class="text-center mb-4">
            <i class="fas fa-exclamation-triangle text-warning display-4 d-block mb-2"></i>
          
            <p class="fw-bold mb-0">Are you sure you want to delete "<?= $task_row['task_name'] ?>"</p>
    
       </div>

       <div class="row">
           <div class="col">
               <a href="task-view.php" class="btn btn-secondary w-100">Cancel</a>
           </div>
           <div class="col">
               <form action="../actions/task.php?task_id=<?= $task_id ?>" method="post">
                   <button type="submit" class="btn btn-outline-danger w-100" name="btn_task_delete">Delete</button>
               </form>
           </div>
       </div>
    </div>
    </main>
    
</body>
</html>