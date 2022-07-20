<?php

include "../classes/minutes.php";

session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['add_minutes'])){

    $minutes_title = $_POST['minutes_title'];
    $mtg_date = $_POST['mtg_date'];
    $project_id = $_POST['project_id'];
    $participant_manager_id = $_POST['participant_manager_id'];
    $participant_member_id_1 = $_POST['participant_member_id_1'];
    $participant_member_id_2 = $_POST['participant_member_id_2'];
    $participant_member_id_3 = $_POST['participant_member_id_3'];
    $participant_member_id_4 = $_POST['participant_member_id_4'];
    $participant_member_id_5 = $_POST['participant_member_id_5'];
    $participant_member_id_6 = $_POST['participant_member_id_6'];
    $minutes = $_POST['minutes'];

    $addminutes = new Minutes;

    $addminutes->addMinutes($user_id, $minutes_title,$mtg_date, $project_id, $participant_manager_id, $participant_member_id_1, $participant_member_id_2, $participant_member_id_3,  $participant_member_id_4,  $participant_member_id_5,  $participant_member_id_6, $minutes);

}


if(isset($_POST['btn_update_minutes'])){

    $minutes_id = $_GET['minutes_id'];

    $minutes_title = $_POST['minutes_title'];
    $mtg_date = $_POST['mtg_date'];
    $project_id = $_POST['project_id'];
    $participant_manager_id = $_POST['participant_manager_id'];
    $participant_member_id_1 = $_POST['participant_member_id_1'];
    $participant_member_id_2 = $_POST['participant_member_id_2'];
    $participant_member_id_3 = $_POST['participant_member_id_3'];
    $participant_member_id_4 = $_POST['participant_member_id_4'];
    $participant_member_id_5 = $_POST['participant_member_id_5'];
    $participant_member_id_6 = $_POST['participant_member_id_6'];
    $minutes = $_POST['minutes'];

    $minutes_update = new Minutes;

    $minutes_update->updateMinutes($minutes_id, $minutes_title, $mtg_date, $project_id, $participant_manager_id, $participant_member_id_1, $participant_member_id_2, $participant_member_id_3, $participant_member_id_4, $participant_member_id_5, $participant_member_id_6, $minutes);

}


if(isset($_POST['btn_minutes_delete'])){

    $minutes_id = $_GET['minutes_id'];
    
    $minutes = new Minutes;
    $minutes->deleteMinutes($minutes_id);

}



?>