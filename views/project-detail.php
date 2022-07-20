<?php

$project_id = $_GET['project_id'];

require_once "../classes/project.php";
$project = new Project;


$manager = $project->getAProject($project_id);
$manager_row = $manager->fetch_assoc();
$manager_id = $manager_row['manager_id'];
// print_r($manager_id);

$project_manager = $project->getManager($project_id);
$project_member_1_row = $project->getMember1($project_id);
$project_member_2_row = $project->getMember2($project_id);
$project_member_3_row = $project->getMember3($project_id);
$project_member_4_row = $project->getMember4($project_id);
$project_member_5_row = $project->getMember5($project_id);
$project_member_6_row = $project->getMember6($project_id);


// //for project-detail.php
// if(isset($_POST['btn_status_change'])){

//     $project_id = $_GET['project_id'];
//     $project_status = $_POST['project_status'];

//     $project = new Project;
//     $project->updateProjectStatus($project_id, $project_status);
// }

session_start();
$user_id = $_SESSION['user_id'];

//for project-detail.php
if(isset($_POST['btn_status_change'])){

    $project_id = $_GET['project_id'];
    $project_status = $_POST['project_status'];

    //承認用データ
    $project_name = $project_row['project_name'];

    $todays_date = date('Y-m-d');

    $project = new Project;
    $project->updateProjectStatus($project_id, $project_status, $user_id, $manager_id, $project_name, $todays_date);
}


$project_id = $_GET['project_id'];
// print_r($project_id);

require_once "../classes/project.php";
$project = new Project;

$project_result = $project->getAProject($project_id);
$project_row = $project_result->fetch_assoc();
$project_user_id = $project_row['user_id'];

$manager_id = $project_row['manager_id'];
// print_r($manager_id);

$project_manager = $project->getManager($project_id);
$project_member_1_row = $project->getMember1($project_id);
$project_member_2_row = $project->getMember2($project_id);
$project_member_3_row = $project->getMember3($project_id);
$project_member_4_row = $project->getMember4($project_id);
$project_member_5_row = $project->getMember5($project_id);
$project_member_6_row = $project->getMember6($project_id);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Detail</title>
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
        <h1 class="text-center">Project Detail</h1>
        
        <!-- status -->
        <div class="row w-50 mx-auto my-4">
                <div class="col-10">
                        <form action="" method="post">
                        <select class="form-select" name="project_status" id="">

                        <option selected value="<?= $project_row['project_status']?>"> <?=$project_row['project_status'] ?> </option>
                        <option value="planning">planning</option>
                        <option value="ongoing">ongoing</option>
                        <option value="pending">pending</option>
                        <option value="postpone">postpone</option>
                        <option value="canceled">canceled</option>
                        <option value="done">done</option>
                        
                        <!-- for Admin -->
                        <?php

                        require_once "../classes/project.php";
                        $project = new Project;
                        
                        $manager = $project->getAProject($project_id);
                        $manager_row = $manager->fetch_assoc();
                        $manager_id = $manager_row['manager_id'];

                        if($manager_id == $user_id){
                            echo "<option value='approved'>approved</option>";
                        }
                        
                        ?>
                        
                        </select>
                </div>
                
                <div class="col-2">
                            <button type="submit" class="btn" name="btn_status_change">CHANGE</button>         
                        </form>
                </div>
            </div>   

        <div class="card">
            <div class="card-body">
            <div class="row">
                <div class="col-8">
                    
                    <h4 class="fs-1 m-2 fw-bold"><?= $project_row['project_name'] ?></h4>
                </div>
                <div class="col-4">
                    <p class="text-end">
                    <?php
                        // print_r($user_id);
                        $project_user_id = $project_row['user_id'];
                        // print_r($project_user_id);
                        $project_user_id = $project_row['user_id'];

                        if($user_id == $project_row['user_id']){
                        ?>
                        <a href="project-edit.php?project_id=<?= $project_id ?>"><i class="fa-solid fa-pen-to-square"></i></a> <a href="project-delete.php?project_id=<?=$project_id?>"> <i class="fa-solid fa-trash-can"></i></a></p>
                            
                        <?php
                        }
                        ?>
                
                    <h6 class="text-end"><i class="fa-solid fa-calendar-days"></i><?= $project_row['project_start'] ?> ~ <?= $project_row['project_end'] ?></h6>
                </div>
            
                <p class="card-text">
                    
                    <div class="row">
                        <div class="col-9">
                            <div>
                                MANAGER : </span><span class="text-primary"><?= $project_manager['first_name']." ".$project_manager['last_name'] ?></span>
                            </div>
                            <div>
                                MEMBER : </span><span class="text-primary"><?= $project_member_1_row['first_name'] ." ". $project_member_1_row['last_name'] ?>,
                                <span class="text-primary"><?= $project_member_2_row['first_name'] ." ". $project_member_2_row['last_name'] ?>,
                                <span class="text-primary"><?= $project_member_3_row['first_name'] ." ". $project_member_3_row['last_name'] ?>,
                                <span class="text-primary"><?= $project_member_4_row['first_name'] ." ". $project_member_4_row['last_name'] ?>,
                                <span class="text-primary"><?= $project_member_5_row['first_name'] ." ". $project_member_5_row['last_name'] ?>,
                                <span class="text-primary"><?= $project_member_6_row['first_name'] ." ". $project_member_6_row['last_name'] ?>,

                            </div>
                        </div>
                        <div class="col-3 text-end">
                        <td>
                                <?php
                                    if($project_row['project_status'] == "ongoing"){
                                ?>
                                        <span class="text-center bg-info p-1"><?=$project_row['project_status']?></span>
                                <?php
                                    }elseif($project_row['project_status'] == "planning"){
                                ?>
                                        <span class="text-center bg-primary p-1"><?=$project_row['project_status']?></span>
                                <?php
                                    }elseif($project_row['project_status'] == "pending"){
                                ?>
                                        <span class="text-center bg-success p-1"><?=$project_row['project_status']?></span>
                                <?php
                                    }elseif($project_row['project_status'] == "postpone"){
                                ?>
                                    <span class="text-center bg-warning p-1"><?=$project_row['project_status']?></span>                                        
                                <?php
                                    }elseif($project_row['project_status'] == "canceled"){
                                ?>
                                    <span class="text-center bg-danger p-1"><?=$project_row['project_status']?></span>                                        
                                <?php
                                    }elseif($project_row['project_status'] == "done"){
                                ?>
                                    <span class="text-center bg-secondary p-1"><?=$project_row['project_status']?></span>
                                    <?php
                                    }
                                    ?>
                                </td>
                            <!-- <p class="text-center bg-info p-1"><?= $project_row['project_status'] ?></p> -->
                        </div>

                        <p class="border p-2 m-2 mb-4"><?= $project_row['note'] ?></p>
                    </div>



                    <div class="mt-5 fs-5 fw-bold">TASKS</div>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <tbody>
                                <?php
                                require_once "../classes/task.php";

                                $task = new Task;
                                $specific_tasks_result = $task->getSpecificTasks($project_id);
                                // $specific_tasks_row = $specific_tasks_result->fetch_assoc();
                                // print_r($specific_tasks_row);

                                while($specific_tasks_row = $specific_tasks_result->fetch_assoc()){
                                
                                    if($specific_tasks_row['task_status'] != 'done' && $specific_tasks_row['task_status'] != 'canceled'){
                                    ?>
                                        <tr>
                                        <!-- task status condition -->
                                        <td scope="row">
                                        <?php
                                            if($specific_tasks_row['task_status'] == "ongoing"){
                                        ?>
                                                <a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-none text-black"><span class="text-center bg-info"><?=$specific_tasks_row['task_status']?></span></a>
                                        <?php
                                            }elseif($specific_tasks_row['task_status'] == "planning"){
                                        ?>
                                                <a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-none text-black"><span class="text-center bg-primary"><?=$specific_tasks_row['task_status']?></span></a>
                                        <?php
                                            }elseif($specific_tasks_row['task_status'] == "pending"){
                                        ?>
                                                <a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-none text-black"><span class="text-center bg-success"><?=$specific_tasks_row['task_status']?></span></a>
                                        <?php
                                            }elseif($specific_tasks_row['task_status'] == "postpone"){
                                        ?>
                                                <a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-none text-black"><span class="text-center bg-warning"><?=$specific_tasks_row['task_status']?></span></a>                                      
                                        <?php
                                            }elseif($specific_tasks_row['task_status'] == "canceled"){
                                        ?>
                                                <a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-none text-black"><span class="text-center bg-danger"><?=$specific_tasks_row['task_status']?></span></a>                                       
                                        <?php
                                            }elseif($specific_tasks_row['task_status'] == "done"){
                                        ?>
                                                <a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-none text-black"><span class="text-center bg-secondary"><?=$specific_tasks_row['task_status']?></span></a>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        
                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-none text-black"><?= $specific_tasks_row['task_name'] ?></a></td>
                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-none text-black"><?= $specific_tasks_row['first_name'] ?></a></td>
                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-none text-black"><i class="fa-solid fa-arrow-right"></i></a></td>

                                        <!-- <?php
                                        $task_id = $specific_tasks_row['task_id'];

                                        $task_assign = new Task;

                                        $specific_tasks_assign = $task_assign ->getAssignName($task_id);
                                        $specific_assign_row = $specific_tasks_assign->fetch_assoc();
                                        ?> -->

                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-none text-black"><?= $specific_assign_row['first_name']?></a></td>
                                        <td><i class="fa-solid fa-hourglass"></i> <?= $specific_tasks_row['deadline'] ?></td>
                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>"><i class="fa-solid fa-circle-chevron-right"></i></a></td>
                                        <td></td>
                                        </tr>

                                    <?php
                                    }else{
                                    ?>
                                        <tr>
                                        <!-- <th></th> -->
                                        <td scope="row"><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-line-through text-black"><span class="bg-secondary"><?= $specific_tasks_row['task_status'] ?></span></a></td>
                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-line-through text-black"><?= $specific_tasks_row['task_name'] ?></a></td>
                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-line-through text-black"><?= $specific_tasks_row['first_name'] ?></a></td>
                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-line-through text-black"><i class="fa-solid fa-arrow-right"></i></a></td>

                                        <!-- <?php
                                        $task_id = $specific_tasks_row['task_id'];

                                        $task_assign = new Task;

                                        $specific_tasks_assign = $task_assign ->getAssignName($task_id);
                                        $specific_assign_row = $specific_tasks_assign->fetch_assoc();
                                        ?> -->

                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-line-through text-black"><?= $specific_assign_row['first_name']?></a></td>
                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>" class="text-decoration-line-through text-black"><i class="fa-solid fa-hourglass"></i> <?= $specific_tasks_row['deadline'] ?></a></td>
                                        <td><a href="task-detail.php?task_id=<?= $specific_tasks_row['task_id'] ?>"><i class="fa-solid fa-circle-chevron-right"></i></a></td>
                                        <td></td>
                                        </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </tbody>   
                        </table>
                    </div>
                    

                    <div class="row mt-5 mb-2">
                        <div class="col-2">
                            <span class="">COMMENT</span> 
                        </div>
                    </div>
                    
                    <form action="../actions/project-comment.php?project_id=<?= $project_id ?>" method="post">
                        <div class="hstack gap-3 mb-4">
                        <textarea class="form-control me-auto" name="comment" placeholder="comment here..."></textarea>
                        <button type="submit" class="btn btn-secondary" name="comment_submit">Submit</button>
                        </div>
                    </form>

                    <?php
                    require_once "../classes/comment.php";

                    $comment = new Comment;
                    $comment_result = $comment->getProjectComment($project_id);

                    while($comment_row = $comment_result->fetch_assoc()){

                    ?>

                    <span><i class="fa-solid fa-circle-user mb-2"></i> <?= $comment_row['first_name'] ?> <span class="text-primary"></span> <span class="fw-lighter"> <?= $comment_row['time'] ?></span><span class="fw-lighter text-end"></span>
                    
                    <p class="ms-4 h6"><?= $comment_row['comment'] ?></p>

                    <?php
                    }
                    ?>


                    <!-- <span><i class="fa-solid fa-circle-user mb-2"></i> : </span><span class="text-primary">username</span> <span class="fw-lighter"> 15:25 2021.06.01</span>
                    <p class="ms-4 h6">comment comment comment comment comment comment comment comment comment comment comment comment</p> -->
                </p>
                </div>
                </div>
            </div>

        <p class="text-white mt-4"><a href="project-view.php"><i class="fa-solid fa-angle-left"></i></a></p>
    </main>

    

</div>
</body>
</html>