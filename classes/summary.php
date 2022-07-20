<?php

require_once "database.php";

class Summary extends Database{
    public function countAllTask($table, $user_id){

        $sql = "SELECT COUNT(*) AS record_count FROM $table WHERE `assign_id` = $user_id AND `task_status` != 'done' AND `task_status` != 'canceled'";

        if($result = $this->conn->query($sql)){
            $task_number = $result->fetch_assoc();
            return $task_number['record_count'];
        }else{
            die("Error in retrieving task number:" . $this->conn->error);
        }
    }


    //TODAY AND Specific User
    public function countTodayTask($table, $user_id){

        $sql = "SELECT COUNT(*) AS record_count FROM $table WHERE `deadline` = CURRENT_DATE() AND `assign_id` = $user_id AND `task_status` != 'done' AND `task_status` != 'canceled' ";


        if($result = $this->conn->query($sql)){
            $today_task_number = $result->fetch_assoc();
            return $today_task_number['record_count'];
        }else{
            die("Error in retrieving today task number:" . $this->conn->error);
        }
    }


    public function countRequestTodayTask($table, $user_id){

        $sql = "SELECT COUNT(*) AS record_count FROM $table WHERE `deadline` = CURRENT_DATE() AND `user_id` = $user_id AND `task_status` != 'done' AND `task_status` != 'canceled'";

        if($result = $this->conn->query($sql)){
            $task_number = $result->fetch_assoc();
            return $task_number['record_count'];
        }else{
            die("Error in retrieving request task number:" . $this->conn->error);
        }
    }


    public function countRequestALLTask($table, $user_id){

        $sql = "SELECT COUNT(*) AS record_count FROM $table WHERE `user_id` = $user_id AND `task_status` != 'done' AND `task_status` != 'canceled'";

        if($result = $this->conn->query($sql)){
            $task_number = $result->fetch_assoc();
            return $task_number['record_count'];
        }else{
            die("Error in retrieving request task number:" . $this->conn->error);
        }
    }

}



?>