<?php

require_once "database.php";

class Profile extends Database {
    public function uploadPhoto($user_id, $file_name, $tmp){

        $sql_photo = "UPDATE `users` SET `avatar` = '$file_name' WHERE user_id = $user_id";

    
        if($this->conn->query($sql_photo)){
            $distination = "../assets/profile/$file_name";
            move_uploaded_file($tmp, $distination);

            echo "<div class='alert alert-success' role='alert'>You have successfully updated your profile picture.</div>";
        }else{
            die("Error upload file <div class='alert alert-danger' role='alert'>Error uploading photo:"  .$this->conn->error ."</div>");
        }
    }


    public function updateProfile($account_id, $user_id, $first_name, $last_name, $email, $division, $position){

        $sql = "UPDATE `users` SET `first_name` = '$first_name', `last_name` = '$last_name', `email` = '$email', `division` = '$division', `position` = '$position' WHERE `user_id` = $user_id";

        if($this->conn->query($sql)){
            header("location: ../views/profile.php?user_id=$user_id");
            exit;
        }else{
            die("Error insert accounts:" . $this->conn->error);
        }
        die("Error update profile:" . $this->conn->error);
    }

}