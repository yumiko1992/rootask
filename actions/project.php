<?php

include "../classes/project.php";

session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['add_project'])){

    $project_name = $_POST['project_name'];
    $manager_id = $_POST['manager_id'];
    $member_id_1 = $_POST['member_id_1'];
    $member_id_2 = $_POST['member_id_2'];
    $member_id_3 = $_POST['member_id_3'];
    $member_id_4 = $_POST['member_id_4'];
    $member_id_5 = $_POST['member_id_5'];
    $member_id_6 = $_POST['member_id_6'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $note = $_POST['note'];
    $status = $_POST['status'];

    $project_add = new Project;
    
    $project_add->addProject($user_id, $project_name, $manager_id, $member_id_1, $member_id_2, $member_id_3, $member_id_4, $member_id_5, $member_id_6, $start_date, $end_date, $note, $status);
}


if(isset($_POST['btn_update_project'])){

    $project_id = $_GET['project_id'];

    $project_name = $_POST['project_name'];
    $manager_id = $_POST['manager_id'];
    $member_id_1 = $_POST['member_id_1'];
    $member_id_2 = $_POST['member_id_2'];
    $member_id_3 = $_POST['member_id_3'];
    $member_id_4 = $_POST['member_id_4'];
    $member_id_5 = $_POST['member_id_5'];
    $member_id_6 = $_POST['member_id_6'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $note = $_POST['note'];
    $status = $_POST['status'];

    $project = new Project;

    $project->updateProject($user_id, $project_name, $manager_id, $member_id_1, $member_id_2, $member_id_3, $member_id_4, $member_id_5, $member_id_6, $start_date, $end_date, $note, $status, $project_id);
}


if(isset($_POST['btn_project_delete'])){

    $project_id = $_GET['project_id'];
    
    $project = new Project;
    $project->deleteProject($project_id);
}



?>