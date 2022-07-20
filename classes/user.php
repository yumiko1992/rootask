<?php
require_once "database.php";

//①database.phpで作ったDatabaseクラスを継承し、Userという子クラスを作る
//②その子クラス内にSELECT、UPDATE、INSERTなどが行えるメソッドを加えていく
//③一度そのメソッドを作ってしまえば、その後はこのUserクラスをインスタン化し、そのなかのメソッドに->でアクセスするだけでそのメソッド（ファンクション）が実行できる

class User extends Database {

    //index.php
    public function createUser($first_name, $last_name, $email, $username, $password, $avatar){

        $sql_accounts = "INSERT INTO `accounts`(`username`, `password`) VALUES ('$username','$password')";
        // echo $sql_accounts;
        // exit;

        if($this->conn->query($sql_accounts)){
            
            //insert_id：最後にINSERTされたIDを取得する
            $account_id = $this->conn->insert_id;
    
            $sql_users="INSERT INTO `users`(`first_name`, `last_name`, `email`, `avatar`,`account_id`) VALUES ('$first_name','$last_name','$email', '$avatar', $account_id)";
    
                if($this->conn->query($sql_users)){
                    header ("location: ../views/index.php");
                    exit;
                }else{
                    die("Error in USERS Table:" . $this->conn->error);
                }
        }else{
            die("Error in ACCOUNTS Table:" . $this->conn->error);
        }
    }


    public function signin($username, $password){
        //①accountsテーブルからusernameが一致するrowを選択する
        $sql = "SELECT accounts.account_id, accounts.username, accounts.password, accounts.role, users.user_id, users.first_name, users.last_name, users.email, users.avatar, users.division, users.position FROM `accounts` INNER JOIN `users` ON  accounts.account_id = users.account_id WHERE accounts.username = '$username'";
        // $sql = "SELECT * FROM accounts WHERE username = '$username'";
        // echo $sql;
        // exit;


        //②上記sqlを実行し、$resultに挿入
        if($result = $this->conn->query($sql)){
            //③「もし、この$resultが１rowなら」というconditionを追加する
            if($result->num_rows == 1){
                //④データとしてその１rowを取り出す
                $user_details = $result->fetch_assoc();
                echo $password;
                // var_dump($user_details);
                // $user_details is an associative array
                // print_r($user_details);
                //⑤入力されたパスワードと取り出したrow[password]が同じかどうかを確認（認証する）一緒ならセッションスタート
                if(password_verify($password, $user_details['password'])){
                    session_start();
                    $_SESSION['account_id'] = $user_details['account_id'];
                    $_SESSION['user_id'] = $user_details['user_id'];
                    $_SESSION['username'] = $user_details['username'];
                    $_SESSION['role'] = $user_details['role'];

                    if($user_details['role'] == 'A'){
                        header("location: ../views/dashboard-user.php");
                        exit;
                    }else{
                        header("location: ../views/dashboard-user.php");
                        exit; //処理を終了させる
                    }

                }else{
                    // Password is incorrect
                    die("Password is incorrect."); //die:exitと同じ機能だが、PHPスクリプト終了時にメッセージを出力できる
                }
            }else{
                // Username is not existing
                die("Username not found.");
            }
        }else{
            die("Error logging in: " . $this->conn->error);
        }
    }
    

    public function getUser(){

        $sql = "SELECT * FROM `users`";

        if($result = $this->conn->query($sql)){
            return $result;
        }
    }


    public function getSpecificUser($user_id){

        $sql = "SELECT users.first_name, users.last_name, users.avatar, users.email, users.division, users.position, users.avatar, accounts.username, accounts.account_id FROM `users` INNER JOIN `accounts` ON users.account_id = accounts.account_id WHERE users.user_id = $user_id";

        if($result = $this->conn->query($sql)){
            return $result;
        }
    }


    
            
}


?>