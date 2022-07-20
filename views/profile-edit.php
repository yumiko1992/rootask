<?php

session_start();
$user_id = $_SESSION['user_id'];
$account_id = $_SESSION['account_id'];

require_once "../classes/user.php";
require_once "../classes/profile.php";

//photo uploadaction
if(isset($_POST['btn_upload_photo'])){
    
    //get the name of data
    //$_FILES-> <input>タグからfile情報を得る。['photo']は<imput>で指定した name=""
    $file_name = $_FILES['photo']['name']; //file名
    $tmp = $_FILES['photo']['tmp_name']; //fileのtmp保存先

   
    $profile = new Profile;
    $profile->uploadPhoto($user_id, $file_name, $tmp);  
}

$profile = new User;
$profile_result = $profile->getSpecificUser($user_id);
$profile_row = $profile_result->fetch_assoc();
// print_r($profile_row);


//update profile
if(isset($_POST['btn_update_profile'])){
    //get the name of data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $division = $_POST['division'];
    $position = $_POST['position'];

    // $username = $_POST['username'];
    // $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $profile = new Profile;
    $profile->updateProfile($account_id, $user_id, $first_name, $last_name, $email, $division, $position);

}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- style sheet -->
    <link rel="stylesheet" href="../styles/style.css">
</head>
<body>

<?php
if($_SESSION['role'] == "U"){
    require_once "../navbar/nav-bar-user.php";
}else{
    require_once "../navbar/nav-bar-admin.php";
}
?>

<div class="container-fluid">
    <main class="h-100 w-75 mx-auto mt-5">
        <h1 class="text-center">Edit Profile</h1>

        <div class="card mb-5">
            <div class="card-body">
                <p class="card-text">
                
                <a href="profile.php"><i class="mt-3 fa-solid fa-angle-left"></i></a>

                    <div class="container mx-auto">
                    <div class="row">
                    <!-- 画像アップロードの為の enctype="multipart/form-data" を追加-->
                    <!-- <form action="../actions/profile.php?user_id=<?= $user_id ?>" method="post" enctype="multipart/form-data"> -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="col">
                            <div class="row">
                                <div class="col-md-7 col-xs-12">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="first-name">First Name</label>
                                            <input type="text" name="first_name" id="first-name" placeholder="FIRST NAME" class="form-control mb-3"  value="<?=$profile_row['first_name']?>" required autofocus>
                                        </div>
                                        <div class="col-6">
                                            <label for="last-name">Last Name</label>
                                            <input type="text" name="last_name" id="last-name" placeholder="FIRST NAME" class="form-control mb-3"    value="<?=$profile_row['last_name']?>" required>
                                        </div>
                                    

                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label for="email">E-mail Adress</label>
                                            <input type="email" name="email" class="form-control mb-3"  id="" placeholder="E-MAIL ADRESS" value="<?=$profile_row['email']?>" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6">
                                            <label for="division">Division</label>
                                            <input type="text" name="division" id="division" placeholder="DIVISION" class="form-control mb-3" value="<?=$profile_row['division']?>">
                                        </div>
                                        <div class="col-6">
                                            <label for="position">Position</label>
                                            <input type="position" name="position" placeholder="POSITION" class="form-control mb-3" value="<?=$profile_row['position']?>">
                                        </div>
                                    </div>

                                    <!-- <div class="row">
                                        <div class="col-8">
                                            <label for="email">UserName</label>
                                            <input type="text" name="username" id="username" placeholder="USERNAME" class="form-control mb-3" value="<?=$profile_row['username']?>" required>
                                        </div>

                                        <div class="col-8">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" placeholder="PASSWORD" class="form-control mb-4" value="<?=$profile_row['password']?>"required>
                                        </div>

                                        <div class="col-8">
                                            <label for="email">Comfirm Password</label>
                                            <input type="password" name="password" placeholder="COMFIRM PASSWORD" class="form-control mb-4" required>
                                        </div>
                                    </div> -->

                                </div>
                                
                                <!-- Photo -->
                                <div class="col-md-5 col-xs-12 mb-4">

                                    <?php
                                    if($profile_row['avatar'] != 'profile.jpg'){
                                        echo "<img class='d-block mx-auto img-fluid'  src='../assets/profile/".$profile_row['avatar']."' alt='profile' style='width: 150px; height:150px; object-fit: cover'>";

                                    }else{
                                        echo "<img class='d-block mx-auto img-fluid'  src='../assets/profile/profile.jpg' alt='profile' style='width: 150px; height:150px; object-fit: cover'>";
                                    }
                                    
                                    ?>

                                    <div class="row mt-3 mx-auto">
                                        <div class="col-10 px-1">
                                            <!-- <input> for file -->
                                            <input type="file" name="photo" class="form-control" aria-lavel="Choose Photo">
                                        </div>
                                        <div class="col-2 px-1">
                                            <button type="submit" class="btn btn-outline-secondary" name="btn_upload_photo"><i class="fa-solid fa-arrow-up-from-bracket"></i></button>
                                        </div>  
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="btn btn-outline-secondary w-100 mt-3" name="btn_update_profile">Update</button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </form>    
                    <div>
                    </div>  
                </p>
            </div>
        </div>
    </main>
</body>
</html>