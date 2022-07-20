<?php

require_once "database.php";


class Project extends Database {

    public function addProject($user_id, $project_name, $manager_id, $member_id_1, $member_id_2, $member_id_3, $member_id_4, $member_id_5, $member_id_6, $start_date, $end_date, $note, $status){

        $new_note = $this->conn->real_escape_string($note);

        $sql_project = "INSERT INTO `projects`(`user_id`, `project_name`, `manager_id`, `project_start`, `project_end`, `note`, `project_status`) VALUES ($user_id, '$project_name', $manager_id, '$start_date', '$end_date', '$new_note', '$status')";
        // echo $sql_accounts;
        // exit;

        if($this->conn->query($sql_project)){
            $project_id = $this->conn->insert_id;

            $sql_manager = "INSERT INTO `manager`(`manager_id`, `project_id`) VALUES ($manager_id, $project_id)";

            if($manager = $this->conn->query($sql_manager)){

                $project_man_id = $this->conn->insert_id;

                $sql_member = "INSERT INTO `member`(`project_man_id`, `project_id`, `member_id_1`, `member_id_2`, `member_id_3`, `member_id_4`, `member_id_5`, `member_id_6`) VALUES ($project_man_id, $project_id, $member_id_1, $member_id_2, $member_id_3, $member_id_4, $member_id_5, $member_id_6)";

                if($member = $this->conn->query($sql_member)){
                    header("location: ../views/project-view.php?user_id=$user_id");
                    exit;
                }else{
                    die("Error insert member:" . $this->conn->error);
                }
            }else{
                die("Error insert manager:" . $this->conn->error);
            }
        }else{
           die("Error in projects table:" . $this->conn->error);
       }
    }


    
    public function getProject(){
        $sql = "SELECT * FROM `projects`";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getDashboardProject($user_id){
        $sql = "SELECT projects.project_id, projects.user_id, projects.project_name, projects.manager_id, projects.project_start, projects.project_end, projects.note, projects.project_status, member.project_id FROM `projects` INNER JOIN `member` ON projects.project_id = member.project_id WHERE manager_id = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_1 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_2 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_3 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled'  OR member_id_4 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_5 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_6 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' ORDER BY `project_end` LIMIT 5";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    //for projects view
    public function getUserProject($user_id){
        $sql = "SELECT projects.project_id, projects.user_id, projects.project_name, projects.manager_id, projects.project_start, projects.project_end, projects.note, projects.project_status, member.project_id FROM `projects` INNER JOIN `member` ON projects.project_id = member.project_id WHERE manager_id = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_1 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_2 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_3 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_4 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_5 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_6 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' ORDER BY `project_end`";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }


    //for past projects
    public function getUserPastProject($user_id){
        $sql = "SELECT projects.project_id, projects.user_id, projects.project_name, projects.manager_id, projects.project_start, projects.project_end, projects.note, projects.project_status, member.project_id FROM `projects` INNER JOIN `member` ON projects.project_id = member.project_id WHERE manager_id = $user_id AND `project_status` = 'approved' OR `project_status` = 'canceled' OR member_id_1 = $user_id AND `project_status` = 'approved' OR `project_status` = 'canceled' OR member_id_2 = $user_id AND `project_status` = 'approved' OR `project_status` = 'canceled' OR member_id_3 = $user_id AND `project_status` = 'approved' OR `project_status` = 'canceled' OR member_id_4 = $user_id AND `project_status` = 'approved' OR `project_status` = 'canceled' OR member_id_5 = $user_id AND `project_status` = 'approved' OR `project_status` = 'canceled' OR member_id_6 = $user_id AND `project_status` = 'approved' OR `project_status` = 'canceled' ORDER BY `project_end` DESC";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    //for awaiting approval project view
    public function getAwaitingApprovalProject($user_id){
        $sql = "SELECT projects.project_id, projects.user_id, projects.project_name, projects.manager_id, projects.project_start, projects.project_end, projects.note, projects.project_status, member.project_id FROM `projects` INNER JOIN `member` ON projects.project_id = member.project_id WHERE manager_id = $user_id AND `project_status` = 'done' ORDER BY `project_end` DESC";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    //for past approval (approval.php)
    public function getApprovedProject($user_id){
        $sql = "SELECT projects.project_id, projects.user_id, projects.project_name, projects.manager_id, projects.project_start, projects.project_end, projects.note, projects.project_status, member.project_id FROM `projects` INNER JOIN `member` ON projects.project_id = member.project_id WHERE manager_id = $user_id AND `project_status` = 'approved'";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }


    public function getAProject($project_id){
        $sql = "SELECT * FROM `projects` WHERE projects.project_id = $project_id";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }


    public function updateProject($user_id, $project_name, $manager_id, $member_id_1, $member_id_2, $member_id_3, $member_id_4, $member_id_5, $member_id_6, $start_date, $end_date, $note, $status, $project_id){

        $new_note = $this->conn->real_escape_string($note);

        $sql_project = "UPDATE `projects` SET `user_id` = $user_id, `project_name` = '$project_name', `manager_id` = $manager_id, `project_start` = '$start_date', `project_end` = '$end_date', `note` = '$new_note', `project_status` = '$status' WHERE `project_id` = $project_id";
        // echo $sql_accounts;
        // exit;

        if($this->conn->query($sql_project)){

            $sql_manager = "UPDATE `manager` SET `manager_id` = $manager_id WHERE `project_id` = $project_id";
            
            if($this->conn->query($sql_manager)){
                $sql_member = "UPDATE `member` SET `member_id_1` = $member_id_1, `member_id_2` = $member_id_2, `member_id_3` = $member_id_3, `member_id_4` = $member_id_5, `member_id_5` = $member_id_5, `member_id_6` = $member_id_6 WHERE `project_id` = $project_id";

                if($this->conn->query($sql_member)){
                    header("location: ../views/project-detail.php?project_id=$project_id");
                    exit;
                }else{
                    die("Error in member table:" . $this->conn->error);
                }
            }else{
                die("Error in manager table:" . $this->conn->error);
            }  
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }


    public function deleteProject($project_id){

        $sql = "DELETE FROM `projects` WHERE `project_id` = $project_id";

        if($this->conn->query($sql)){
            header("location: ../views/project-view.php");
            exit;
        }else{
            die("Error delete task:" . $this->conn->error);
        }
    }

    public function getManager($project_id){
        $sql = "SELECT projects.manager_id, users.first_name, users.last_name FROM `projects` INNER JOIN `users` ON projects.manager_id = users.user_id WHERE projects.project_id = $project_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }


    public function getMember1($project_id){
        $sql = "SELECT member.project_id, member.member_id_1, users.first_name, users.last_name FROM `member` INNER JOIN `users` ON member.member_id_1 = users.user_id WHERE member.project_id = $project_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMember2($project_id){
        $sql = "SELECT member.project_id, member.member_id_2, users.first_name, users.last_name FROM `member` INNER JOIN `users` ON member.member_id_2 = users.user_id WHERE member.project_id = $project_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMember3($project_id){
        $sql = "SELECT member.project_id, member.member_id_3, users.first_name, users.last_name FROM `member` INNER JOIN `users` ON member.member_id_3 = users.user_id WHERE member.project_id = $project_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projectsss table:" . $this->conn->error);
        }
    }

    public function getMember4($project_id){
        $sql = "SELECT member.project_id, member.member_id_4, users.first_name, users.last_name FROM `member` INNER JOIN `users` ON member.member_id_4 = users.user_id WHERE member.project_id = $project_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMember5($project_id){
        $sql = "SELECT member.project_id, member.member_id_5, users.first_name, users.last_name FROM `member` INNER JOIN `users` ON member.member_id_5 = users.user_id WHERE member.project_id = $project_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    public function getMember6($project_id){
        $sql = "SELECT member.project_id, member.member_id_6, users.first_name, users.last_name FROM `member` INNER JOIN `users` ON member.member_id_6 = users.user_id WHERE member.project_id = $project_id";

        if($result = $this->conn->query($sql)){
            return $result->fetch_assoc();
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }

    
   //doneが選択された際マネージャーに確認のタスクが飛ぶ条件を追加
    public function updateProjectStatus($project_id, $project_status, $user_id, $manager_id, $project_name, $todays_date){

        //もしプロジェクトステータスがdoneだった場合、マネージャーのタスクが作成される
        if($project_status == 'done'){

            //SQL for add task
            $sql_add_task = "INSERT INTO `tasks`(`project_id`, `user_id`, `task_name`, `assign_id`, `deadline`, `task_status`,`note`) VALUES ($project_id, $user_id, 'Your project has been completed.', $manager_id, '$todays_date', 'ongoing', 'Your project now has been completed. If your final checks show no problems, please change the status of the project to Approved.')";

            if($this->conn->query($sql_add_task)){

                $sql_update = "UPDATE `projects` SET `project_status` = '$project_status' WHERE `project_id` = $project_id";
                             
                if($this->conn->query($sql_update)){
                    echo "<div class='alert alert-success' role='alert'>You have successfully updated project status. Please wait for the manager's approval.</div>";
                }else{
                    die("Error upload status <div class='alert alert-danger' role='alert'>Error uploading status:" . $this->conn->error ."</div>");
                } 
            }else{
                die("Error upload status <div class='alert alert-danger' role='alert'>Error uploading status:" . $this->conn->error ."</div>");
            }
        }else{
            $sql_update = "UPDATE `projects` SET `project_status` = '$project_status' WHERE `project_id` = $project_id";

            if($this->conn->query($sql_update)){
                echo "<div class='alert alert-success' role='alert'>You have successfully updated project status.</div>";
            }else{
                die("Error upload status <div class='alert alert-danger' role='alert'>Error uploading status:" . $this->conn->error ."</div>");
            }
        }
    }


    public function countTask($project_id){

        $sql = "SELECT COUNT(*) AS record_count FROM `tasks` WHERE `project_id` = $project_id AND `task_status` != 'done' AND `task_status` != 'canceled'";

        if($result = $this->conn->query($sql)){
            $task_number = $result->fetch_assoc();
            return $task_number['record_count'];
        }else{
            die("Error in retrieving task number:" . $this->conn->error);
        }
    }


    public function getProjectsForPagination($user_id, $start_from, $per_page_record){
        $sql = "SELECT * FROM `projects` INNER JOIN `member` ON projects.project_id = member.project_id WHERE manager_id = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_1 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_2 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_3 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled'  OR member_id_4 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_5 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_6 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' ORDER BY `project_end` DESC LIMIT $start_from, $per_page_record";  

        $rs_result = $this->conn->query($sql); 

        return $rs_result;
    }


    public function countProjects($user_id){
        $sql = "SELECT COUNT(*) FROM `projects` INNER JOIN `member` ON projects.project_id = member.project_id WHERE manager_id = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_1 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_2 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_3 = $user_idAND `project_status` != 'approved' AND `project_status` != 'canceled'  OR member_id_4 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_5 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_6 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' ORDER BY `project_end` DESC"; 

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error count project:" . $this->conn->error);
        }
        // $rs_result = $this->conn->query($sql);          
        // return $rs_result;       
    }




    //for approval-view.php pagenation
    public function getAwaitingApprovalProjectsForPagination($user_id, $start_from, $per_page_record){
        $sql = "SELECT * FROM `projects` INNER JOIN `member` ON projects.project_id = member.project_id WHERE manager_id = $user_id AND `project_status` = 'done' ORDER BY `project_end` DESC LIMIT $start_from, $per_page_record";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error in projects table:" . $this->conn->error);
        }
    }
    
    //for approval-view.php pagenation
    public function AwaitingApprovalcountProjects($user_id){
        $sql = "SELECT COUNT(*) FROM `projects` INNER JOIN `member` ON projects.project_id = member.project_id WHERE manager_id = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_1 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_2 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_3 = $user_idAND `project_status` != 'approved' AND `project_status` != 'canceled'  OR member_id_4 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_5 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_6 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' ORDER BY `project_end` DESC"; 

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error count project:" . $this->conn->error);
        }
        // $rs_result = $this->conn->query($sql);          
        // return $rs_result;       
    }


    public function countAwaitingApprovalProjects($user_id){
        $sql = "SELECT COUNT(*) FROM `projects` INNER JOIN `member` ON projects.project_id = member.project_id WHERE manager_id = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_1 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_2 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_3 = $user_idAND `project_status` != 'approved' AND `project_status` != 'canceled'  OR member_id_4 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_5 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' OR member_id_6 = $user_id AND `project_status` != 'approved' AND `project_status` != 'canceled' ORDER BY `project_end` DESC"; 

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error count project:" . $this->conn->error);
        }
    }


    



}

?>