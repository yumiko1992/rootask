<?php

require_once "database.php";


class Minutes extends Database {


    //projedct_add.php
    public function addMinutes($user_id, $minutes_title, $mtg_date, $project_id, $participant_manager_id, $participant_member_id_1, $participant_member_id_2, $participant_member_id_3, $participant_member_id_4,  $participant_member_id_5, $participant_member_id_6, $minutes){

        $sql_minutes = "INSERT INTO `minutes` (`project_id`, `mtg_date`, `title`, `minutes`, `participant_manager_id`, `participant_member_id_1`, `participant_member_id_2`, `participant_member_id_3`, `participant_member_id_4`, `participant_member_id_5`, `participant_member_id_6`) VALUES ($project_id, '$mtg_date', '$minutes_title', '$minutes', $participant_manager_id, $participant_member_id_1, $participant_member_id_2, $participant_member_id_3, $participant_member_id_4, $participant_member_id_5, $participant_member_id_6)";
     
        if($this->conn->query($sql_minutes)){
            header("location: ../views/minutes-view.php");
            // header("location: ../views/minutes-view.php?user_id=$user_id");
            exit;
        }else{
            die("Error in minutes table:" . $this->conn->error);
        }
    }


    //minutesとpuroject
    public function getMinutes(){

        $sql = "SELECT minutes.project_id, minutes.minutes_id, minutes.task_id, minutes.mtg_date, minutes.title, minutes.minutes, minutes.participant_manager_id, minutes.participant_member_id_1, minutes.participant_member_id_2, minutes.participant_member_id_3, minutes.participant_member_id_4, minutes.participant_member_id_5, minutes.participant_member_id_6 FROM `minutes` INNER JOIN `projects` ON minutes.project_id = projects.project_id";

        if($result = $this->conn->query($sql)){
            return $result;
            exit;
        }else{
            die("Error in minutes table:" . $this->conn->error);
        }
    }

    public function getMinutesForView($user_id){

        $sql = "SELECT minutes.project_id, minutes.minutes_id, minutes.task_id, minutes.mtg_date, minutes.title, minutes.minutes, minutes.participant_manager_id, minutes.participant_member_id_1, minutes.participant_member_id_2, minutes.participant_member_id_3, minutes.participant_member_id_4, minutes.participant_member_id_5, minutes.participant_member_id_6, projects.project_name FROM `minutes` INNER JOIN `projects` ON minutes.project_id = projects.project_id WHERE participant_manager_id = $user_id OR participant_member_id_1 = $user_id OR participant_member_id_2 = $user_id OR participant_member_id_3 = $user_id OR participant_member_id_4 = $user_id OR participant_member_id_5 = $user_id OR participant_member_id_6 = $user_id ORDER BY `mtg_date` DESC";

        if($result = $this->conn->query($sql)){
            return $result;
            exit;
        }else{
            die("Error in minutes table:" . $this->conn->error);
        }
    }

    public function getUserMinutes($user_id){

        $sql = "SELECT minutes.project_id, minutes.minutes_id, minutes.task_id, minutes.mtg_date, minutes.title, minutes.minutes, minutes.participant_manager_id, minutes.participant_member_id_1, projects.project_name FROM `minutes` INNER JOIN `projects` ON minutes.project_id = projects.project_id WHERE participant_manager_id = $user_id OR participant_member_id_1 = $user_id OR participant_member_id_2 = $user_id OR participant_member_id_3 = $user_id OR participant_member_id_4 = $user_id OR participant_member_id_5 = $user_id OR participant_member_id_6 = $user_id ORDER BY `mtg_date` DESC";

        if($result = $this->conn->query($sql)){
            return $result;
            exit;
        }else{
            die("Error in minutes table:" . $this->conn->error);
        }
    }


    public function getSpecificMinutes($minutes_id){

        $sql = "SELECT minutes.project_id, minutes.minutes_id, minutes.task_id, minutes.mtg_date, minutes.title, minutes.minutes, minutes.participant_manager_id, minutes.participant_member_id_1, minutes.participant_member_id_2, minutes.participant_member_id_3, minutes.participant_member_id_4, minutes.participant_member_id_5, minutes.participant_member_id_6, projects.project_name FROM `minutes` INNER JOIN `projects` ON minutes.project_id = projects.project_id WHERE minutes_id = $minutes_id";

        if($result = $this->conn->query($sql)){
            return $result;
            exit;
        }else{
            die("Error in minutes table:" . $this->conn->error);
        }
    }


    public function updateMinutes($minutes_id, $minutes_title, $mtg_date, $project_id, $participant_manager_id, $participant_member_id_1, $participant_member_id_2, $participant_member_id_3, $participant_member_id_4, $participant_member_id_5, $participant_member_id_6, $minutes){

         $sql = "UPDATE `minutes` SET `title` = '$minutes_title', `mtg_date` = '$mtg_date', `project_id` = $project_id, `participant_manager_id` = $participant_manager_id, `participant_member_id_1` = $participant_member_id_1, `participant_member_id_2` = $participant_member_id_2, `participant_member_id_3` = $participant_member_id_3, `participant_member_id_4` = $participant_member_id_4, `participant_member_id_5` = $participant_member_id_5, `participant_member_id_6` = $participant_member_id_6, `minutes` = '$minutes' WHERE `minutes_id` = $minutes_id";
     
        if($this->conn->query($sql)){
            header("location: ../views/minutes-detail.php?minutes_id=$minutes_id");
            exit;
        }else{
            die("Error in minutes table:" . $this->conn->error);
        }
    }


    public function deleteMinutes($minutes_id){

        $sql = "DELETE FROM `minutes` WHERE `minutes_id` = $minutes_id";
    
        if($this->conn->query($sql)){
            header("location: ../views/minutes-view.php");
            exit;
        }else{
            die("Error delete task:" . $this->conn->error);
        }
    }

    public function getManager($minutes_id){
        $sql = "SELECT minutes.participant_manager_id, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON minutes.participant_manager_id = users.user_id WHERE minutes.minutes_id = $minutes_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMember1($minutes_id){
        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_1, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON minutes.participant_member_id_1 = users.user_id WHERE minutes.minutes_id = $minutes_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMember2($minutes_id){
        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_2, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON minutes.participant_member_id_2 = users.user_id WHERE minutes.minutes_id = $minutes_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMember3($minutes_id){
        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_3, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON minutes.participant_member_id_3 = users.user_id WHERE minutes.minutes_id = $minutes_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMember4($minutes_id){
        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_4, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON minutes.participant_member_id_4 = users.user_id WHERE minutes.minutes_id = $minutes_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMember5($minutes_id){
        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_5, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON minutes.participant_member_id_5 = users.user_id WHERE minutes.minutes_id = $minutes_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMember6($minutes_id){
        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_6, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON minutes.participant_member_id_6 = users.user_id WHERE minutes.minutes_id = $minutes_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMinutesParticipantMan($minutes_id){

        $sql = "SELECT minutes.minutes_id, minutes.participant_manager_id, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON users.user_id = minutes.participant_manager_id WHERE minutes_id = $minutes_id";
        

        if($result = $this->conn->query($sql)){
            return $result_man = $result->fetch_assoc();
        }
    }


    public function getMinutesParticipantMem1($minutes_id){

        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_1, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON users.user_id = minutes.participant_member_id_1 WHERE minutes_id = $minutes_id";
        

        if($result = $this->conn->query($sql)){
            return $result_mem1 = $result->fetch_assoc();
        }
    }

    public function getMinutesParticipantMem2($minutes_id){

        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_2, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON users.user_id = minutes.participant_member_id_2 WHERE minutes_id = $minutes_id";
        

        if($result = $this->conn->query($sql)){
            return $result_mem2 = $result->fetch_assoc();
        }
    }

    public function getMinutesParticipantMem3($minutes_id){

        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_3, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON users.user_id = minutes.participant_member_id_3 WHERE minutes_id = $minutes_id";
        

        if($result = $this->conn->query($sql)){
            return $result_mem3 = $result->fetch_assoc();
        }
    }

    public function getMinutesParticipantMem4($minutes_id){

        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_4, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON users.user_id = minutes.participant_member_id_4 WHERE minutes_id = $minutes_id";
        

        if($result = $this->conn->query($sql)){
            return $result_mem4 = $result->fetch_assoc();
        }
    }

    public function getMinutesParticipantMem5($minutes_id){

        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_5, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON users.user_id = minutes.participant_member_id_5 WHERE minutes_id = $minutes_id";
        

        if($result = $this->conn->query($sql)){
            return $result_mem5 = $result->fetch_assoc();
        }
    }

    public function getMinutesParticipantMem6($minutes_id){

        $sql = "SELECT minutes.minutes_id, minutes.participant_member_id_6, users.first_name, users.last_name FROM `minutes` INNER JOIN `users` ON users.user_id = minutes.participant_member_id_6 WHERE minutes_id = $minutes_id";
        

        if($result = $this->conn->query($sql)){
            return $result_mem6 = $result->fetch_assoc();
        }
    }

    public function getMinutesForPagenation($user_id, $start_from, $per_page_record){
        $sql = "SELECT * FROM `minutes` INNER JOIN `projects` ON minutes.project_id = projects.project_id WHERE participant_manager_id = $user_id OR participant_member_id_1 = $user_id OR participant_member_id_2 = $user_id OR participant_member_id_3 = $user_id OR participant_member_id_4 = $user_id OR participant_member_id_5 = $user_id OR participant_member_id_6 = $user_id ORDER BY `mtg_date` DESC LIMIT $start_from, $per_page_record";     
        $rs_result = $this->conn->query($sql); 

        return $rs_result;
    }

    public function countMinutes($user_id){
        $sql = "SELECT COUNT(*) FROM `minutes` INNER JOIN `projects` ON minutes.project_id = projects.project_id WHERE participant_manager_id = $user_id OR participant_member_id_1 = $user_id OR participant_member_id_2 = $user_id OR participant_member_id_3 = $user_id OR participant_member_id_4 = $user_id OR participant_member_id_5 = $user_id OR participant_member_id_6 = $user_id ORDER BY `mtg_date` DESC"; 

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
        // $rs_result = $this->conn->query($sql);          
        // return $rs_result;       
    }


}


?>