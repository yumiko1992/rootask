<?php

require_once "../classes/task.php";

session_start();
$user_id = $_SESSION['user_id'];

require_once "../classes/user.php";
$user = new User;
$user_result = $user->getUser($user_id);
$user_row = $user_result->fetch_assoc();

$task_id = $_GET['task_id'];

//specificなタスクを取得する
$task_details = new Task;
$specific_task_result = $task_details->getTaskDetails($task_id);
$specific_task_row = $specific_task_result->fetch_assoc();

//get assign name
$task_assign = $task_details->getAssignName($task_id);
$task_assign_row = $task_assign->fetch_assoc();


require_once "../classes/project.php";
$project = new Project;
$project_result = $project->getProject();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Detail</title>
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
        <h1 class="text-center">Task Detail</h1>

            <div class="row w-50 mx-auto my-4">
                <div class="col-10">
                        <form action="../actions/task-status.php?task_id=<?= $task_id ?>" method="post">
                        <select class="form-select" name="project_status" id="">

                        <option selected value="<?= $specific_task_row['task_status']?>"> <?=$specific_task_row['task_status'] ?> </option>
                        <option value="planning">planning</option>
                        <option value="ongoing">ongoing</option>
                        <option value="pending">pending</option>
                        <option value="postpone">postpone</option>
                        <option value="canceled">canceled</option>
                        <option value="done">done</option>
                        </select>   

                </div>
                <div class="col-2">
                            <button type="submit" class="btn" name="btn_status_change">CHANGE</button>         
                        </form>
                </div>
            </div>           
        </form>


        <div class="card">
            <div class="card-body">
                <p class="card-text">
                <div class="row">
                    <div class="col-6">
                        <h4 class="fw-bold"><?= $specific_task_row['task_name'] ?></h4>
                    </div>
                    
                    <div class="col-6">
                        <?php
                        if($user_id == $specific_task_row['user_id']){
                        ?>
                            <div class="text-end"><a href="task-edit.php?task_id=<?= $task_id ?>"><i class="fa-solid fa-pen-to-square"></i></a> <a href="task-delete.php?task_id=<?=$task_id?>"> <i class="fa-solid fa-trash-can"></i></a></div>
                        <?php
                        }
                        ?>

                    </div>       
                </div>

                <div class="col">
                    <h5 class="text-end fs-6"><a href="project-detail.php?project_id=<?= $specific_task_row['project_id'] ?>"><i class="fa-solid fa-diagram-project"></i><?= $specific_task_row['project_name'] ?></a></h5>
                </div>

                <div class="row">
                    <div class="col-8">
                        <span>FROM : </span><span class="text-primary"><?= $specific_task_row['first_name']. " " .$specific_task_row['last_name'] ?>  </span></span><i class="fa-solid fa-angles-right"></i><i class="fa-solid fa-angles-right"></i><span>  TO : </span><span class="text-primary"><?= $task_assign_row['first_name'] ." ". $task_assign_row['last_name']?></span>
                    </div>
                    <div class="col-4">
                        <div class="text-end">
                            <td>
                            <?php
                                if($specific_task_row['task_status'] == "ongoing"){
                            ?>
                                    <span class="text-center bg-info p-1"><?=$specific_task_row['task_status']?></span>
                            <?php
                                }elseif($specific_task_row['task_status'] == "planning"){
                            ?>
                                    <span class="text-center bg-primary p-1"><?=$specific_task_row['task_status']?></span>
                            <?php
                                }elseif($specific_task_row['task_status'] == "pending"){
                            ?>
                                    <span class="text-center bg-success p-1"><?=$specific_task_row['task_status']?></span>
                            <?php
                                }elseif($specific_task_row['task_status'] == "postpone"){
                            ?>
                                <span class="text-center bg-warning p-1"><?=$specific_task_row['task_status']?></span>                                        
                            <?php
                                }elseif($specific_task_row['task_status'] == "canceled"){
                            ?>
                                <span class="text-center bg-danger p-1"><?=$specific_task_row['task_status']?></span>                                        
                            <?php
                                }elseif($specific_task_row['task_status'] == "done"){
                            ?>
                                <span class="text-center bg-secondary p-1"><?=$specific_task_row['task_status']?></span>
                                <?php
                                }
                                ?>
                            </td>
                        </div>
                    </div>
                </div>

                <p>DEADLINE : <?= $specific_task_row['deadline'] ?></p>  
                <p class="border p-2"><?= $specific_task_row['note'] ?></p>
                

                    <!-- <p class="text-center mt-3 small"><a href="#">Back</a></p> -->
                </p>
            </div>
        </div>

        <div class="mt-3"><a href="task-view.php"><i class="fa-solid fa-angle-left"></i></a></div>
    </main>

</div>
</body>
</html>