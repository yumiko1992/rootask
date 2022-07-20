<?php

session_start();
$user_id = $_SESSION['user_id'];

// print_r($user_id);

require_once "../classes/user.php";
$user = new User;
$user_result = $user->getSpecificUser($user_id);
$user_row = $user_result->fetch_assoc();

// print_r($user_row['user_id']);
// print_r($user_row['first_name']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
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
        <h1 class="text-center">Add Task</h1>

            <div class="card">
                <div class="card-body">
                    <p class="card-text">
                        <form action="../actions/task.php" method="post">
                            <select class="form-select mb-3" name="project_id" id="" required>
                                <option selected>SELECT PROJECT</option>

                                <?php
                                require_once "../classes/project.php";
                                $project = new Project;
                                $project_result = $project->getProject();

                                while($project_row = $project_result->fetch_assoc()){
                                ?>

                                <option value="<?= $project_row['project_id'] ?>"><?= $project_row['project_name'] ?></option>

                                <?php
                                }
                                ?>
                                <!-- <option value="2">2</option>  -->
                                <!-- <option value="3">3</option> -->
                            </select>
                
                            <input type="text" name="task_name" id="" placeholder="TITLE" class="form-control mb-3" required>


                            <div class="row">
                                <div class="col">
                                <span>FROM : </span><span class="text-primary"><?= $user_row['first_name'] ." ". $user_row['last_name'] ?> </span></span><i class="fa-solid fa-angles-right"></i><i class="fa-solid fa-angles-right"></i>


                                <!-- Select assign -->
                                <select name="assign_id" id="assign-id" class="form-select mb-3">
                                    <option selected>SELECT USER</option>
                                    <?php
                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){
                                    ?>

                                    <option value="<?=$selectuser_row['user_id']?>"><?=$selectuser_row['first_name'] ." ". $selectuser_row['last_name']?></option>

                                    <?php
                                    }
                                    ?>
                                </select>

                                <!-- <input type="text" name="to_name" id="" placeholder="TO : username" class="form-control mb-3"> -->
                                </div>
                                <div class="col">
                                    <label for="deadline">DEADLINE</label>
                                    <input type="date" name="deadline" id="deadline" placeholder="DEAD LINE" class="form-control mb-3">
                                </div>
                            </div>
                
                            <label for="note" class="form-label">NOTE</label>
                            <textarea class="form-control" id="note" rows="5" name="note"></textarea>


                            <button type="submit" class="btn w-100 mt-4" name="add_task">Add</button>
                        </form>
                    </p>
                </div>
            </div> 

            <div><a href="dashboard-user.php"><i class="fa-solid fa-angle-left mt-3"></i></a></div>
        </main>
</div>
</body>
</html>