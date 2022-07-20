<?php

require_once "database.php";

class Member extends Database {

    //使用先：projedct_add.php
    public function getMembers(){

        $sql = "SELECT * FROM `users` INNER JOIN `accounts` ON accounts.account_id = users.account_id";

        if($result = $this->conn->query($sql)){
            return $result;
        }else{
            die("Error in retrieving task number:" . $this->conn->error);
        }
    }

    public function  getPrivilege($user_id){
        $sql = "SELECT * FROM `users` INNER JOIN `accounts` ON accounts.account_id = users.account_id WHERE users.user_id = $user_id";

        if($result = $this->conn->query($sql)){
            return $privilege_row = $result->fetch_assoc();
        }else{
            die("Error in retrieving privilege number:" . $this->conn->error);
        }
    }


    public function  updatePrivilege($account_id, $privilege){

        $sql = "UPDATE `accounts` SET `role` =  '$privilege' WHERE `account_id` = $account_id";

        if($result = $this->conn->query($sql)){
            echo "<div class='alert alert-success' role='alert'>You have successfully updated privilege.</div>";
        }else{
            die("Error upload file <div class='alert alert-danger' role='alert'>Error uploading privilege:"  .$this->conn->error ."</div>");
        }
    }


    public function getMembersForPagination($user_id, $start_from, $per_page_record){
        $sql = "SELECT * FROM `users` INNER JOIN `accounts` ON accounts.account_id = users.account_id LIMIT $start_from, $per_page_record";     
        $rs_result = $this->conn->query($sql); 

        return $rs_result;
    }

    public function countMembers($user_id){
        $sql = "SELECT COUNT(*) FROM `users` INNER JOIN `accounts` ON accounts.account_id = users.account_id"; 

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