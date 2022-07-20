<?php
    class Database{
        private $server_name = "localhost";
        private $username = "root";
        $password = "root"; // For MAMP users, password is "root"
        $db_name = "rootask";

        //create a connection
        $conn = new mysqli($server_name, $username, $password, $db_name);
        //  $conn holds the connection, it serves as the bus that transports the information
        //  mysqli - contains different functions and variables that connects to your database

        // check the connection
        if($conn->connect_error){
            // there is error
            die("Connection failed: " . $conn->connect_error);
            // die() display and exit from code, terminate from php
        } else {
            // No error in the connection
            return $conn;
        }
    }
