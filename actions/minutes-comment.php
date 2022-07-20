<?php

include "../classes/comment.php";


// session_start();
// $user_id = $_SESSION['user_id'];


// if(isset($_POST['minutes_comment_submit'])){

//     $comment = $_POST['comment'];

//     $project = new Comment;

//     $project->addComment($user_id, $project_id, $comment);

// }


// if(isset($_POST['minutes_comment_submit'])){

    session_start();
    $user_id = $_SESSION['user_id'];

    //require_once "../views/minutes-detail.php";
    $minutes_id = $_GET['minutes_id'];
    $comment = $_POST['comment'];

    $minutes = new Comment;
    $minutes->addMinutesComment($user_id, $minutes_id, $comment);

// }


?>