<?php
// include the class
include "../classes/user.php";


if(isset($_POST['btn_sign_up'])){
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $avatar = "profile.jpg";

    // Create an object
    //Userクラスをインスタン化し、$userに入れる
    $user = new User;

    // Call the method
    //インスタン化し$userに入っているクラス内のcreateUserにアクセス　※Arguments（引数）
    $user->createUser($first_name, $last_name, $email, $username, $password, $avatar);

}

?>