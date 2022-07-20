<!-- データベースに接続するためのクラス　
この後、アクションの度に毎回データベースに接続する必要があるためこれを親クラスにして継承させる -->

<?php
class Database {
    private $server_name = "localhost";
    private $username = "root";
    private $password = "root";    
    private $db_name = "rootask";
    //子クラスからアクセスするためprotectedにする
    
    protected $conn; //↓のメソッド内でmysqlデータベースにアクセスするクエリを実行し$connに入れる


    //Databaseクラス（or 子クラス）がインスタンス化されるごとに以下のconstructが自動的に稼動される
    public function __construct(){
        $this->conn = new mysqli($this->server_name, $this->username, $this->password, $this->db_name);

        if($this->conn->connect_error){
            die("Unable to connect to database " . $this->db_name . ": " . $this->conn->connect_error);
        }
    }
}

//  $conn is declared as protected so other inheriting classes can use it
//  $this->conn --- object
//  $connect_error --- property. a member of class mysqli. holds a String value of the connection error
?>