<?php
// include the class
include_once "../classes/task.php";

session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['add_task'])){

    $project_id = $_POST['project_id'];
    $task_name = $_POST['task_name'];
    $assign_id = $_POST['assign_id'];
    $deadline = $_POST['deadline'];
    $note = $_POST['note'];

    // Create an object
    //Userクラスをインスタン化し、$userに入れる
    $task = new Task;

    // Call the method
    //インスタン化し$userに入っているクラス内のcreateUserにアクセス　※Arguments（引数）
    $task->addTask($project_id, $user_id, $task_name, $assign_id, $deadline, $note);
}



if(isset($_POST['btn_task_delete'])){

    $task_id = $_GET['task_id'];
    
    $task = new Task;

    $task->deleteTask($task_id);
}


if(isset($_POST['btn_update_task'])){

    $task_id = $_GET['task_id'];

    $project_id = $_POST['project_id'];
    $task_name = $_POST['task_name'];
    $assign_id = $_POST['assign_id'];
    $deadline = $_POST['deadline'];
    $note = $_POST['note'];
    
    $task = new Task;
    $task->updateTask($task_id, $project_id, $user_id, $task_name, $assign_id, $deadline, $note);
}

?>