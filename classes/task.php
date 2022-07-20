<?php
ob_start(); //参考：https://ryoheiobayashi.com/archives/721
?>

<?php

require_once "database.php";

class Task extends Database {

    public function addTask($project_id, $user_id, $task_name, $assign_id, $deadline, $note){

    $sql = "INSERT INTO `tasks`(`project_id`, `user_id`, `task_name`, `assign_id`, `deadline`, `note`) VALUES ($project_id, $user_id, '$task_name', $assign_id, '$deadline', '$note')";

        if($this->conn->query($sql)){
            header("location: ../views/summary-request-all.php?user_id=$user_id");
            exit;
        }else{
            die("Error in tasks table:" . $this->conn->error);
        }
    }


    public function getTasks(){

        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = projects.user_id";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }

    public function getUserTasks($user_id){

        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE tasks.assign_id = $user_id";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }


    //for navbar tasks menu(task-view.php)
    public function getallTasks($user_id){

        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE tasks.assign_id = $user_id AND tasks.task_status != 'done' AND tasks.task_status != 'canceled' OR tasks.user_id = $user_id AND tasks.task_status != 'done' AND tasks.task_status != 'canceled' ORDER BY `deadline`";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }


    //for past tasks
    public function getPastTasks($user_id){

        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE tasks.assign_id = $user_id AND tasks.task_status = 'done' OR tasks.task_status = 'canceled' OR tasks.user_id = $user_id AND tasks.task_status = 'done' OR tasks.task_status = 'canceled' ORDER BY `deadline` DESC";


        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }


    //for sumarry-all.php (summary of all task)
    public function getallUserTasks($user_id){

        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE tasks.assign_id = $user_id AND `task_status` != 'done' AND `task_status` != 'canceled' ORDER BY `deadline`";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }


    public function getTodayUserTasks($user_id){

        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE `deadline` = CURRENT_DATE() AND tasks.assign_id = $user_id AND `task_status` != 'done' AND `task_status` != 'canceled' ORDER BY `deadline`";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }



    public function getRequestingUserTasks($user_id){

        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE `deadline` = CURRENT_DATE() AND tasks.user_id = $user_id ORDER BY `deadline`";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }


    public function getRequestTodayUserTasks($user_id){

        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE `deadline` = CURRENT_DATE() AND tasks.user_id = $user_id AND `task_status` != 'done' AND `task_status` != 'canceled' ORDER BY `deadline`";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }


    public function getRequestAllTasks($user_id){

        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE tasks.user_id = $user_id AND `task_status` != 'done' AND `task_status` != 'canceled' ORDER BY `deadline`";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }



    public function getDashboardTasks($user_id){

        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = projects.user_id WHERE tasks.assign_id = $user_id AND tasks.task_status != 'canceled' AND tasks.task_status != 'done' ORDER BY `deadline` LIMIT 5";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }

    public function getRequestUser($task_id){

        $sql = "SELECT tasks.task_id, users.first_name, users.last_name FROM tasks INNER JOIN users ON users.user_id = tasks.user_id WHERE tasks.task_id = $task_id";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving user_id:" . $this->conn->error);
        }
    }


    public function getTaskDetails($task_id){

        //INNER JOIN "tasks" "projects" "users"
        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.user_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, projects.project_id, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE tasks.task_id = $task_id";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task details:" . $this->conn->error);
        }
    }


    public function getSpecificTasks($project_id){

        //INNER JOIN "tasks" "projects" "users"
        $sql = "SELECT tasks.task_id, tasks.project_id, tasks.task_name, tasks.assign_id, tasks.date_posted, tasks.deadline, tasks.task_status, tasks.note, projects.project_name, users.first_name, users.last_name FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE projects.project_id = $project_id";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving specific task:" . $this->conn->error);
        }
    }

    public function getAssignName($task_id){

        //INNER JOIN "tasks" "projects" "users"
        $sql = "SELECT tasks.assign_id, users.first_name, users.last_name FROM tasks INNER JOIN users ON users.user_id = tasks.assign_id WHERE tasks.task_id = $task_id";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving assign name:" . $this->conn->error);
        }
    }

    public function changeTaskStatus($task_id, $project_status){

        $task_id = $_GET['task_id'];

        $sql = "UPDATE `tasks` SET `task_status` =  '$project_status' WHERE `task_id` = $task_id";

        if($result = $this->conn->query($sql)){
            header("location: ../views/task-view.php");
            exit;
        }else{
            die("Error update task status:" . $this->conn->error);
        }
    }


    public function deleteTask($task_id){

        $sql = "DELETE FROM `tasks` WHERE `task_id` = $task_id";

        if($result = $this->conn->query($sql)){
            header("location: ../views/task-view.php");
            exit;
        }else{
            die("Error delete task:" . $this->conn->error);
        }
    }



    public function updateTask($task_id, $project_id, $user_id, $task_name, $assign_id, $deadline, $note){

        $sql = "UPDATE `tasks` SET `project_id` = $project_id, `user_id` = $user_id, `task_name` = '$task_name', `assign_id` = $assign_id, `deadline` = '$deadline', `note` ='$note' WHERE `task_id` = $task_id";
    
        if($this->conn->query($sql)){
            header("location: ../views/task-detail.php?task_id=$task_id");
            exit;
        }else{
            die("Error in tasks table:" . $this->conn->error);
        }
    
    }

    public function getTaskStatus(){

        $sql = "SELECT * FROM `tasks`";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
    }

    public function getTasksForPagination($user_id, $start_from, $per_page_record){
        $sql = "SELECT * FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE tasks.assign_id = '$user_id' AND tasks.task_status != 'done' AND tasks.task_status != 'canceled' OR tasks.user_id = '$user_id' AND tasks.task_status != 'done' AND tasks.task_status != 'canceled' ORDER BY tasks.deadline DESC LIMIT $start_from, $per_page_record";

        $rs_result = $this->conn->query($sql); 

        return $rs_result;
    }

    public function countTasks($user_id){
        $sql = "SELECT COUNT(*) FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE tasks.assign_id = $user_id AND tasks.task_status != 'done' AND tasks.task_status != 'canceled' OR tasks.user_id = $user_id AND tasks.task_status != 'done' AND tasks.task_status != 'canceled' ORDER BY `deadline` DESC"; 

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
        // $rs_result = $this->conn->query($sql);          
        // return $rs_result;       
    }

    public function searchStatus($user_id, $status){
        $sql = "SELECT * FROM tasks INNER JOIN projects ON tasks.project_id = projects.project_id INNER JOIN users ON users.user_id = tasks.user_id WHERE tasks.assign_id = $user_id AND tasks.task_status = '$status' ORDER BY tasks.deadline DESC";   

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error retrieving task:" . $this->conn->error);
        }
        // $_SESSION["status"] = 1;
    }

}


?>