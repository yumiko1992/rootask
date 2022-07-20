<?php


if(isset($_POST['btn_status_change'])){

require_once "../views/task-detail.php";
$task_id = $_GET['task_id'];

$project_status = $_POST['project_status'];

$task = new Task;

$task->changeTaskStatus($task_id, $project_status);
}


?>