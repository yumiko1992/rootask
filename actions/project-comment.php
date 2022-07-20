<?php

include "../classes/comment.php";

session_start();
$user_id = $_SESSION['user_id'];

$project_id = $_GET['project_id'];

$comment = $_POST['comment'];

$project_comment = new Comment;
$project_comment->addProjectComment($user_id, $project_id, $comment);

?>