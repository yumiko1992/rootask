<?php

session_start();
$user_id = $_SESSION['user_id'];

require_once "../classes/user.php";
$user = new User;
$user_result = $user->getSpecificUser($user_id);
$user_row = $user_result->fetch_assoc();

$selectuser_result = $user->getUser();


$task_id = $_GET['task_id'];

require_once "../classes/task.php";
$task = new Task;
$task_specific_result = $task->getTaskDetails($task_id);
$task_specific_row = $task_specific_result->fetch_assoc();                           
                             
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
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

        <main class="h-100 w-50 mx-auto mt-5">
        <h1 class="text-center">Edit Task</h1>

            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        <form action="../actions/task.php?task_id=<?= $task_id ?>" method="post">

                            <label for="project">Project</label>
                            <select class="form-select mb-3" name="project_id" id="prpject" required>

                                <?php
                                require_once "../classes/project.php";
                                $project = new Project;
                                $project_result = $project->getProject();

                                while($project_row = $project_result->fetch_assoc()){
                                    if($task_row['project_id'] == $project_row['project_id']){
                                        echo "<option selected value=". $project_row['project_id'] ."> " .$project_row['project_name'] . "</option>";
                                    }else{
                                        echo "<option value=" . $project_row['project_id'] . ">" . $project_row['project_name'] . "</option>";
                                    }
                                }
                                ?>

                                <!-- <option value="2">2</option>  -->
                                <!-- <option value="3">3</option> -->
                            </select>
                            
                            <label for="task-name">Task Name</label>
                            <input type="text" name="task_name" id="task-name" placeholder="TITLE" class="form-control mb-3"  value="<?= $task_specific_row['task_name'] ?>" required>

                            <!-- test -->
                            <div class="row">
                                <div class="col">
                                    From : <span class="text-primary"><?= $user_row['first_name'] ." ". $user_row['last_name'] ?> </span><i class="fa-solid fa-angles-right"></i><i class="fa-solid fa-angles-right"></i>

                                    <!-- select member -->

                                    <select name="assign_id" id="assign-id" class="form-select mb-3" placeholder="TO : username">

                                    <?php
                                    while($task_row = $selectuser_result->fetch_assoc()){
                                        if($task_specific_row['assign_id'] == $task_row['user_id']){
                                    
                                        echo "<option selected value=". $task_row['user_id'] .">" .$task_row['first_name'] ." ". $task_row['last_name']. "</option>";

                                        }else{
                                        
                                        echo "<option value=" .$task_row['user_id'] .">" .$task_row['first_name'] ." ". $task_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </div>
                               
                                <div class="col">
                                    <label for="deadline">Deadline</label>
                                        <input type="date" name="deadline" id="deadline" placeholder="DEAD LINE" class="form-control mb-3" value="<?= $task_specific_row['deadline'] ?>">
                                </div>
                            </div>
                            
            
                
                            <label for="note" class="form-label">Note</label>
                            <textarea class="form-control" id="note" rows="5" name="note"><?= $task_specific_row['note'] ?></textarea>


                            <button type="submit" class="btn w-100 mt-4" name="btn_update_task">Update</button>
                        </form>
                    </p>
                </div>
            </div> 

            <div><a href="dashboard-user.php"><i class="fa-solid fa-angle-left mt-3"></i></a></div>
        </main>
</div>
</body>
</html>