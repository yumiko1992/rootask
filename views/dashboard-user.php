<?php

require_once "../classes/task.php";

session_start();
$user_id = $_SESSION['user_id'];
// print_r($user_id);

require_once "../classes/user.php";
$user = new User;
$user_result = $user->getSpecificUser($user_id);
$user_row = $user_result->fetch_assoc();

// $username = $user_row['username'];
// print_r($username);
// $first_name = $user_row['first_name'];
// $last_name = $user_row['last_name'];
// print_r($username);



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

    <!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Lobster&family=Pacifico&family=Sacramento&display=swap" rel="stylesheet">


</head>

<body>

<?php

// require_once "../navbar/nav-bar-user.php";

if($_SESSION['role'] == "U"){
    require_once "../navbar/nav-bar-user.php";
}else{
    require_once "../navbar/nav-bar-admin.php";
}


?>

<div  class="container-fluid">

    <main class="container mb-4">
        <h1 class="mt-4">DASHBOARD</h1>
        <div class="row">
            <div class="col bg-white m-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="">YOUR TASKS</h3>
                        </div>
                        <div class="col">
                            <a href="task-add.php" class="text-decoration-none">
                            <button type="button" class="btn btn-secondary d-block ms-auto bg-pink"><i class="fa-solid fa-circle-plus"></i></button></a>
                        </div>
                    </div>


                    <table class="table table-sm mt-3">
                        <tbody>
                            <?php

                                $task = new Task;
                                $task_details = $task->getDashboardTasks($user_id);
                                // $task_row = $task_details->fetch_assoc();
                                // print_r($task_details);

                                $today_date = date('Y-m-d');
                                $date1 = strtotime($today_date);
                                // echo $today_date;

                                while($task_row = $task_details->fetch_assoc()){
                                    $deadline = strtotime($task_row['deadline']);

                                    if($deadline < $date1){
                                    ?>
                                        <tr>
                                        <th scope="row" class="text-danger"> □</th>
                                        <td class="text-danger"><?= $task_row['task_name'] ?></td>
                                        <?php
                                        $task_id = $task_row['task_id'];
                                        $username = $task->getRequestUser($task_id);
                                        $username_row = $username->fetch_assoc();
                                        ?>
                                        <td class="text-danger"><i class="fa-solid fa-paper-plane"></i> <?= $username_row['first_name'] ?></td>
                                        <!-- deadline -->
                                        <?php
                                            //月日のみ表示に変更
                                            $date = $task_row['deadline'];
                                            $day_month = date('d M', strtotime($date));

                                            echo "<td class='text-danger'><i class='fa-solid fa-hourglass'></i>" .$day_month."</td>";  
                                        ?>
                                        <td class="text-danger"><i class="fa-solid fa-diagram-project text-danger"></i> <?= $task_row['project_name'] ?></td>
                                        <th scope="row"> <a href="task-detail.php?task_id=<?= $task_row['task_id'] ?>" class="text-decoration-none text-danger"><i class="fa-solid fa-circle-chevron-right"></i></a></th>
                                        </tr>
                                        <tr>                                        
                                    <?php
                                    }else{
                                    ?>
                                        <tr>
                                        <th scope="row"> □</th>
                                        <td><?= $task_row['task_name'] ?></td>
                                        <?php
                                        $task_id = $task_row['task_id'];
                                        $username = $task->getRequestUser($task_id);
                                        $username_row = $username->fetch_assoc();
                                        ?>
                                        <td><i class="fa-solid fa-paper-plane"></i> <?= $username_row['first_name'] ?></td>
                                        <!-- deadline -->
                                        <?php
                                            $date = $task_row['deadline'];
                                            $day_month = date('d M', strtotime($date));

                                            echo "<td><i class='fa-solid fa-hourglass'></i>" .$day_month."</td>";  
                                        ?>
                                        <td><i class="fa-solid fa-diagram-project"></i> <?= $task_row['project_name'] ?></td>
                                        <th scope="row"> <a href="task-detail.php?task_id=<?= $task_row['task_id'] ?>" class="text-decoration-none"><i class="fa-solid fa-circle-chevron-right"></i></a></th>
                                        </tr>
                                        <tr> 
                                    <?php
                                    }
                                    ?>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <a href="summary-all.php?user_id=<?= $user_id ?>" class="float-end mb-3 text-decoration-none"><span class="text-black">VIEW MORE </span><i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            </div>

            <div class="col bg-white m-3">
                <div class="card-body text-center">
                <h3 class="text-start mb-1">SUMMARY</h3>

                    <?php
                    require_once "../classes/summary.php";

                    $table = 'tasks';

                    $summary = new Summary;
                    $summary_all = $summary->countAllTask($table, $user_id);

                    $summary_today = $summary->countTodayTask($table, $user_id);

                    $summary_request_all = $summary->countRequestALLTask($table, $user_id);

                    $summary_request_today = $summary->countRequestTodayTask($table, $user_id);



                    // $summary_request = $summary->requestTask($table, $user_id);



                    //watingのファンクションをつくるべし 
                    ?>

                    <div class="test-center text-secondary">YOUR TASK</div>
                    <div class="border rounded p-1 mb-1">
                        <div class="row">  
                            <div class="col">
                                <p class="m-0 text-decoration-underline">DUE TODAY</p>
                                <span class="fs-1"><?= $summary_today ?> <a href="summary-today.php?user_id=<?= $user_id ?>"><i class="fa-solid fa-angles-right"></i></a></span>
                                <!-- <a href="#" class="text-decoration-none">
                                <button type="button" class="btn btn-outline-none-sm btn-sm">Detail<i class="fa-solid fa-angles-right"></i></button></a> -->
                            </div>
                            <div class="col">
                                <p class="m-0 text-decoration-underline">ALL</p>
                                <span class="fs-1"><?= $summary_all ?> <a href="summary-all.php?user_id=<?= $user_id ?>"><i class="fa-solid fa-angles-right"></i></a></span>
                                <!-- <a href="#" class="text-decoration-none">
                                <button type="button" class="btn btn-outline-none-sm btn-sm">Detail <i class="fa-solid fa-angles-right"></i></button></a> -->
                            </div>
                        </div>
                    </div>
                  
                    <div class="test-center text-secondary mt-2">YOUR REQUEST</div>
                    <div class="border rounded p-1 mb-1">
                        <div class="row">
                            <div class="col">
                                <p class="m-0 text-decoration-underline"> DUE TODAY</p>
                                <span class="fs-1"><?= $summary_request_today ?> <a href="summary-request-today.php?user_id=<?= $user_id ?>"><i class="fa-solid fa-angles-right"></i></a></span>
                                <!-- <a href="#" class="text-decoration-none">
                                <button type="button" class="btn btn-outline-none-sm btn-sm">Detail <i class="fa-solid fa-angles-right"></i></button></a> -->
                            </div>

                            <div class="col">
                                <p class="m-0 text-decoration-underline">ALL</p>
                                <span class="fs-1"><?= $summary_request_all ?> <a href="summary-request-all.php?user_id=<?= $user_id ?>"><i class="fa-solid fa-angles-right"></i></a></span>
                                <!-- <a href="#" class="text-decoration-none">
                                <button type="button" class="btn btn-outline-none-sm btn-sm">Detail <i class="fa-solid fa-angles-right"></i></button></a> -->
                            </div>
                        </div>   
                    </div> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col bg-white m-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="">PROJECT</h3>
                        </div>
                        <div class="col">
                            <a href="project-add.php" class="text-decoration-none">
                            <button type="button" class="btn btn-secondary d-block ms-auto"><i class="fa-solid fa-circle-plus"></i></button></a>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <!-- table -->
                        <div class="table-responsive">
                        <table class="table table-sm table-borderless">
                            <thead>
                                <tr>
                                <th scope="col" hidden>#</th>
                                <th scope="col">NAME</th>
                                <th scope="col">TASK</th>
                                <th scope="col" class="text-center">START</th>
                                <th scope="col"></th>
                                <th scope="col" class="text-center">END</th>
                                <th scope="col">STATUS</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                        <?php
                        require "../classes/project.php";
                        
                        $project = new Project;
                        $project_details = $project->getDashboardProject($user_id); 

                        
                        while($project_row = $project_details->fetch_assoc()){
                        ?>
                            <tbody>
                                <tr>
                                <th hidden><?= $project_row['project_id'] ?></th>
                                <td><?= $project_row['project_name'] ?></td>
                
                                <td><div class="text-center">(
                                <?php
                                    $project_id = $project_row['project_id'];
                                    $project_count_task = $project->countTask($project_id);
                                    print_r($project_count_task);                     
                                ?>    
                                )</div></td>
                                <?php
                                $date_projedct_start = $project_row['project_start'];
                                $day_month_start = date('d M', strtotime($date_projedct_start));

                                $date_projedct_end = $project_row['project_end'];
                                $day_month_end = date('d M', strtotime($date_projedct_end));
                                ?>
                                <td><?= $day_month_start ?></td>
                                <td>~</td>
                                <td><?= $day_month_end ?></td>
                                <td>
                                <?php
                                    if($project_row['project_status'] == "ongoing"){
                                ?>
                                        <div class="text-center bg-info"><?=$project_row['project_status']?></div>
                                <?php
                                    }elseif($project_row['project_status'] == "planning"){
                                ?>
                                        <div class="text-center bg-primary"><?=$project_row['project_status']?></div>
                                <?php
                                    }elseif($project_row['project_status'] == "pending"){
                                ?>
                                        <div class="text-center bg-success"><?=$project_row['project_status']?></div>
                                <?php
                                    }elseif($project_row['project_status'] == "postpone"){
                                ?>
                                    <div class="text-center bg-warning"><?=$project_row['project_status']?></div>                                        
                                <?php
                                    }elseif($project_row['project_status'] == "canceled"){
                                ?>
                                    <div class="text-center bg-danger"><?=$project_row['project_status']?></div>                                        
                                <?php
                                    }elseif($project_row['project_status'] == "done"){
                                ?>
                                    <div class="text-center bg-secondary"><?=$project_row['project_status']?></div>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td><a href="project-detail.php?project_id=<?= $project_row['project_id'] ?>"><i class="fa-solid fa-circle-chevron-right"></i></a></td>
                                </tr>
                            </tbody> 
                        <?php
                        }
                        ?>
                        </table>
                        </div>
                    </div>

                    <a href="project-view.php?user_id=<?= $user_id ?>" class="float-end mb-3 text-decoration-none"><span class="text-black">VIEW MORE </span><i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            </div>


            <div class="col bg-white m-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3 class="">MINUTES</h3>
                        </div>
                        <div class="col">
                                <a href="minutes-add.php" class="text-decoration-none">
                                <button type="button" class="btn btn-secondary d-block ms-auto"><i class="fa-solid fa-circle-plus"></i></button></a>
                        </div>

                        <table class="table table-sm table-striped">
                            <thead>
                                <tr>
                                <th scope="col">DATE</th>
                                <th scope="col">TITLE</th>
                                <th scope="col">PROJECT</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                require_once "../classes/minutes.php";

                                $minutes = new Minutes;
                                $minutes_result = $minutes->getUserMinutes($user_id);

                                while($minutes_row = $minutes_result->fetch_assoc()){

                                ?>

                                <tr>
                                <th scope="row"><?= $minutes_row['mtg_date'] ?></th>
                                <td><?= $minutes_row['title'] ?></td>
                                <td><?= $minutes_row['project_name'] ?></td>
                                <td><a href="minutes-detail.php?minutes_id=<?= $minutes_row['minutes_id'] ?>"><i class="fa-solid fa-circle-chevron-right"></i></a></td>
                                </tr>

                                <?php
                                }
                                ?>

                                <!-- <tr>
                                <th scope="row">2022.6.2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td><a href="#"><i class="fa-solid fa-circle-chevron-right"></i></a></td>
                                </tr>
                                <tr>
                                <th scope="row">2022.6.3</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td><a href="#"><i class="fa-solid fa-circle-chevron-right"></i></a></td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>

                    <a href="minutes-view.php" class="float-end mb-3 text-decoration-none"><span class="text-black">VIEW MORE </span><i class="fa-solid fa-arrow-right-long"></i></a>
                </div>
            </div>
        </div>


    
    </main>
</div>
</body>
</html>