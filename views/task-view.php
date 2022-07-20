<?php

session_start();
$user_id = $_SESSION['user_id'];

require "../classes/task.php";
$task = new Task;
// $tasks_result = $task->getallTasks($user_id);


$per_page_record =5;  // Number of entries to show in a page.   
        // Look for a GET variable page if not found default is 1.        
if (isset($_GET["page"])) {    
    $page  = $_GET["page"];    
}    
else {    
    $page=1;    
}    

$start_from = ($page-1) * $per_page_record;     
$tasks_result = $task->getTasksForPagination($user_id, $start_from, $per_page_record);

// print_r($tasks_result);

// if(isset($_POST['btn_search']) || isset($_SESSION["status"] == 1)){
//     $status = $_POST['status'];

//     $tasks_result = $task->searchStatus($user_id, $start_from, $per_page_record, $status);
// }else{
    
//     $_SESSION["status"] == 0;
// }


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALL TASKS</title>
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

    <main class="h-100 w-50 mx-auto m-4">
        <h1 class="text-center">ALL TASKS</h1>

        <div class="row mb-2">
            <div class="col">
                <a href="task-add.php" class="text-decoration-none">
                <button type="button" class="btn btn-secondary d-block me-auto"><i class="fa-solid fa-circle-plus"></i> Add Task</button></a>
            </div>
        </div>
        
        <!-- <form action="" method="post">     
            <div class="row"> 
                <div class="col-6 ms-auto">
                    <select class="form-control " name="status" placeholder="Type to search...">
                        <option value="ongoing">ongoing</option>
                        <option value="planning">planning</option>
                        <option value="pending">pending</option>
                        <option value="postpone">postpone</option>
                    </select>
                </div>
                <div class="col-2 me-auto">
                    <button type="submit" class="btn btn-secondary" name="btn_search">search</button>                     
                </div>
                
            </div>
        </form> -->
            
        

        <div class="card">
            <div class="card-body">
                <p class="card-text m-3">
                    <div class="table-responsive">
                    <table class="table">
                    
                        <tbody>
                            
                            <?php
                            // $ctr = 0;
                            while($tasks_row = $tasks_result->fetch_assoc()){
                            // $ctr++;
                            ?>
                                    <tr>
                                    <td hidden><?= $tasks_row['task_id'] ?></td>
                                    <td><?= $tasks_row['task_name'] ?></td>
                                    <td><i class="fa-solid fa-paper-plane"></i> <?= $tasks_row['first_name']." ".$tasks_row['last_name']?></td>
                                    <td><i class="fa-solid fa-hourglass"></i>　<?= $tasks_row['deadline'] ?></td>
                                    <!-- status -->
                                    <!-- <td><span class="bg-info p-1"><?= $tasks_row['task_status'] ?></span></td> -->

                                <td>
                                <?php
                                    if($tasks_row['task_status'] == "ongoing"){
                                ?>
                                        <div class="text-center bg-info"><?=$tasks_row['task_status']?></div>
                                <?php
                                    }elseif($tasks_row['task_status'] == "planning"){
                                ?>
                                        <div class="text-center bg-primary"><?=$tasks_row['task_status']?></div>
                                <?php
                                    }elseif($tasks_row['task_status'] == "pending"){
                                ?>
                                        <div class="text-center bg-success"><?=$tasks_row['task_status']?></div>
                                <?php
                                    }elseif($tasks_row['task_status'] == "postpone"){
                                ?>
                                    <div class="text-center bg-warning"><?=$tasks_row['task_status']?></div>                                        
                                <?php
                                    }elseif($tasks_row['task_status'] == "canceled"){
                                ?>
                                    <div class="text-center bg-danger"><?=$tasks_row['task_status']?></div>                                        
                                <?php
                                    }elseif($tasks_row['task_status'] == "done"){
                                ?>
                                    <div class="text-center bg-secondary"><?=$tasks_row['task_status']?></div>
                                    <?php
                                    }
                                    ?>
                                </td>

                                    <td>
                                        <a href="task-detail.php?task_id=<?= $tasks_row['task_id'] ?>"><i class="fa-solid fa-angles-right"></i></a></td>
                                    </tr>
                            <?php                                      
                            }
                            ?>

                            
                        </tbody>
                        
                    
                    </table>
                    </div>
                </p>
            </div> 
            <div class="card-footer mx-auto bg-white border-white">               
                <div class="pagination">    
                    <?php  
                       
                        $result = $task->countTasks($user_id); 
                        // print_r($result);
                        $row = $result->fetch_row();   
                    
                        $total_records = $row[0];

                        echo "</br>";     
                        // Number of pages required.   
                        $total_pages = ceil($total_records / $per_page_record);     
                        $pagLink = "";       
                        //prev
                        if($page>=2){   
                            echo "<span class='border border-1 px-1 me-1'><a href='task-view.php?page=".($page-1)."'>  <i class='fa-solid fa-angle-left'></i> </span></a>";   
                        }       
                                
                        for ($i=1; $i<=$total_pages; $i++) {   
                        if ($i == $page) {   
                            $pagLink .= "<span class='border border-1 px-1 me-1 bg-secondary'><a class = 'active text-decoration-none text-white' href='task-view.php?page=" .$i."'>".$i." </span></a>";   
                        }               
                        else  {   
                            $pagLink .= "<span class='border border-1 px-1 me-1'><a class='text-decoration-none' href='task-view.php?page=".$i."'> ".$i." </span></a>";     
                        }   
                        };     
                        echo $pagLink;   
                        //next
                        if($page<$total_pages){   
                            echo "<span class='border border-1 px-1 me-1'><a href='task-view.php?page=".($page+1)."'> <i class='fa-solid fa-angle-right'></i> </span></a>";   
                        }   
                
                    ?>    
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col">
                <div class="mt-3"><a href="dashboard-user.php?user_id=<?php?>"><i class="fa-solid fa-angle-left"></i></a></div>
            </div>
            <div class="col">
                <div class="mt-3 text-end"><a href="task-past.php?user_id=<?= $user_id ?>" class="text-decoration-none"> <i class="text-light fa-solid fa-clock-rotate-left"></i> <a href="task-past.php?user_id=<?= $user_id ?>" class="text-light text-decoration-none">PAST</a></div>    
            </div>
        </div>
    </main>

</div>
</body>
</html>