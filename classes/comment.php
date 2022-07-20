<?php

require_once "database.php";

class Comment extends Database {

    //使用先：projedct_add.php
    public function addProjectComment($user_id, $project_id, $comment){

        $new_comment = $this->conn->real_escape_string($comment);

        $sql = "INSERT INTO `comments_project`(`user_id`, `project_id`, `comment`) VALUES ($user_id, $project_id, '$new_comment')";

        if($this->conn->query($sql)){
            header("location: ../views/project-detail.php?project_id=$project_id");
            exit;
        }else{
            die("Error in Project comment tables:" . $this->conn->error);
        }
    }

    
    public function getProjectComment($project_id){

        $sql = "SELECT comments_project.comment_id, comments_project.user_id, comments_project.project_id, comments_project.time, comments_project.comment, users.first_name, users.last_name, users.avatar, users.division, users.position FROM `comments_project` INNER JOIN `users` ON comments_project.user_id = users.user_id WHERE comments_project.project_id = $project_id";
        // echo $sql_accounts;
        // exit;

        if($result = $this->conn->query($sql)){
            return $result;
            exit;
        }else{
            die("Error in comment table:" . $this->conn->error);
        }
    }


    public function addMinutesComment($user_id, $minutes_id, $comment){

        $sql = "INSERT INTO `comments_minutes`(`user_id`, `minutes_id`, `comment`) VALUES ($user_id, $minutes_id, '$comment')";

        if($this->conn->query($sql)){
            
            header("location: ../views/minutes-detail.php?minutes_id=$minutes_id");
            exit;
        }else{
            die("Error in comment_minutes table:" . $this->conn->error);
        }
    }


    public function getMinutesComment($minutes_id){

        $sql = "SELECT comments_minutes.comment_id, comments_minutes.user_id, comments_minutes.minutes_id, comments_minutes.time, comments_minutes.comment, users.first_name, users.last_name, users.avatar, users.division, users.position FROM `comments_minutes` INNER JOIN `users` ON comments_minutes.user_id = users.user_id WHERE comments_minutes.minutes_id = $minutes_id";    

        if($result = $this->conn->query($sql)){
            return $result;
            exit;
        }else{
            die("Error in comment_minutes table:" . $this->conn->error);
        }
    }




} 

?>