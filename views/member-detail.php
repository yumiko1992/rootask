<?php

$user_id = $_GET['user_id'];

require_once "../classes/user.php";
$user = new User;
$user_result = $user->getSpecificUser($user_id);
$user_row = $user_result->fetch_assoc();
$account_id = $user_row['account_id'];


//for privilege change
if(isset($_POST['btn_privilege_change'])){

    $privilege = $_POST['privilege'];

    require_once "../classes/member.php";
    $privilege_update = new Member;
    $privilege_update->updatePrivilege($account_id, $privilege);
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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

<div class="container-fluid">
    <main class="h-100 w-50 mx-auto mt-5">
        <h1 class="text-center"><?= $user_row['first_name'] ." ". $user_row['last_name']?></h1>
        <div class="card">
            <div class="card-body">
                <p class="card-text">
                    <div class="container mx-auto">
                        <div class="row">
                        <form action="" method="post">  
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-7 col-xs-12">
                                        <p><i class="fa-solid fa-user"></i> : <?= $user_row['first_name']?> <?=$user_row['last_name']?></p>
                                        <p><i class="fa-solid fa-circle-user"></i> : <?=$user_row['username']?></p>
                                        <p><i class="fa-solid fa-envelope"></i> :  <?= $user_row['email']?></p>
                                        <p><i class="fa-solid fa-building"></i> : <?= $user_row['division']?></p>
                                        <p><i class="fa-solid fa-universal-access"></i> : <?= $user_row['position']?></p>
                                    
                                    </div>

                                    <div class="col-md-5 col-xs-12">
                                        

                                        <div class="text-center mb-3">
                                            <?php
                                                require_once "../classes/member.php";

                                                $user_id = $_GET['user_id'];

                                                $get_privilege = new Member;
                                                $privilege_result = $get_privilege->getPrivilege($user_id);
                                                $role = $privilege_result['role'];
                                                // print_r($role);

                                                if($role == 'U'){
                                                    echo " <td><span class='p-1 bg-info text-white'>USER</span></td>";
                                                }else{
                                                    echo " <td><span class='p-1 bg-danger text-white'>ADMIN</span></td>";
                                                }
                                            ?>
                                        </div>


                                        <?php
                                        if($user_row['avatar'] != 'profile.jpg'){
                                            echo "<img class='d-block mx-auto img-fluid'  src='../assets/profile/".$user_row['avatar']."' alt='profile' style='width: 150px; height:150px; object-fit: cover'>";

                                        }else{
                                            echo "<img class='d-block mx-auto img-fluid'  src='../assets/profile/".$user_row['avatar']."' alt='profile' style='width: 150px; height:150px; object-fit: cover'>";
                                        }   
                                        ?>

                                    

                                        <!-- privilege  change-->
                                        <div class="row mt-3">
                                                <div class="col">
                                                    <form action="" method="post">
                                                        <select class="form-select-sm w-100" name="privilege" id="">
                                                        
                                                        <?php
                                                    
                                                            if($privilege_result['role'] == 'U'){
                                                                echo "<option selected value='U'>USER</option>";
                                                                echo "<option value='A'>Admin</option>";
                                                                    
                                                            }else{
                                                                echo "<option selected value='A'>ADMIN</option>";
                                                                echo "<option value='U'>USER</option>";
                                                            }

                                                        ?>
                                                        </select>

                                                </div>
                                                
                                                <div class="col">
                                                    <button type="submit" class="btn btn-sm" name="btn_privilege_change">CHANGE</button>         
                                                </form>      
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </form> 
                        
                        <div class="col-3 mt-5 mb-4 bg-secondary w-100">
                            <div class="fw-bold text-white ms-2">PROJECTS</div> 
                        </div>

                        <div>
                        <!-- table -->
                        <table class="table table-sm">
                            <!-- <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col">NAME</th>
                                    <th scope="col">START</th>
                                    <th scope="col"></th>
                                    <th scope="col">END</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead> -->
                            <tbody>
                                <tr>
                        <?php
                        require "../classes/project.php";
                        
                        $project = new Project;
                        $project_details = $project->getUserProject($user_id); 
                                    
                        while($project_row = $project_details->fetch_assoc()){
                        ?>  
                                    <td hidden><?= $project_row['project_id'] ?></td>
                                    <td><i class="fa-solid fa-diagram-project"></i></td>
                                    <td><?= $project_row['project_name'] ?></td>
                                    <td><?= $project_row['project_start'] ?></td>
                                    <td>~</td>
                                    <td><?= $project_row['project_end'] ?></td>
                                    <td><a href="project-detail.php?project_id=<?= $project_row['project_id'] ?>"><i class="fa-solid fa-circle-chevron-right"></i></a></td>
                                </tr> 
                        <?php
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>


                    <div class="col-3 my-4 bg-secondary w-100">
                        <div class="fw-bold text-white ms-2">TASKS</div> 
                    </div>
                    <div>
                        <table class="table table-sm">
                        <tbody>
                            <?php

                                require_once "../classes/task.php";

                                $task = new Task;
                                $task_details = $task->getallUserTasks($user_id);
                                // $task_row = $task_details->fetch_assoc();
                                // print_r($task_details);

                                while($task_row = $task_details->fetch_assoc()){         
                            ?>
                                <tr>
                                <th scope="row"> □</th>
                                <td><?= $task_row['task_name'] ?></td>
                                <!-- <td><?= $task_row['from_name'] ?></td> -->
                                <td><i class="fa-solid fa-hourglass"></i>　<?= $task_row['deadline'] ?></td>
                                <th scope="row"> <a href="task-detail.php?task_id=<?= $task_row['task_id'] ?>" class="text-decoration-none"><i class="fa-solid fa-angles-right"></i></a></th>
                                </tr>
                                <tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                        


                    </div>  
                </p>
            </div>
            <a href="member.php"><i class="fa-solid fa-angle-left"></i></a>
        </div>
    </main>
</div>
</body>
</html>