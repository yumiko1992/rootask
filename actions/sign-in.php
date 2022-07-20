<?php

// include the class
include "../classes/user.php";

if(isset($_POST['signin'])){

$username = $_POST['username'];
$password = $_POST['password'];

$user = new User;

$user->signin($username, $password);

}

?>