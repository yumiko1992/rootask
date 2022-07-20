<?php

session_start();
$user_id = $_SESSION['user_id'];

require_once "../classes/user.php";
$user = new User;
$user_result = $user->getSpecificUser($user_id);
$user_row = $user_result->fetch_assoc();
// print_r($user_row);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
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
    <main class="h-100 w-50 mx-auto mt-5">
        <h1 class="text-center">Profile</h1>
        <div class="card">
            <div class="card-body">
            <div class="text-end me-3"><a href="profile-edit.php?user_id=<?= $user_id ?>"><i class="fa-solid fa-pen-to-square"></i></a></div>
                <p class="card-text">
                    <div class="container mx-auto">
                        <div class="row">
                        <form action="" method="post">  
                            <div class="col">
                                <div class="row">
                                    <div class="col-md-7 col-xs-12">
                                        <p><i class="fa-solid fa-user"></i> : <?= $user_row['first_name']?> <?=$user_row['last_name']?></p>
                                        <p><i class="fa-solid fa-circle-user"></i> : <?=$user_row['username']?></p>
                                        <p><i class="fa-solid fa-envelope"></i> :  <?= $user_row['email']?></p>
                                        <p><i class="fa-solid fa-building"></i> : <?= $user_row['division']?></p>
                                        <p><i class="fa-solid fa-universal-access"></i> : <?= $user_row['position']?></p>
                                    
                                    </div>

                                    <div class="col-md-5 col-xs-12">
                                        <?php
                                        if($user_row['avatar'] != 'profile.jpg'){
                                            echo "<img class='d-block mx-auto img-fluid'  src='../assets/profile/".$user_row['avatar']."' alt='profile' style='width: 150px; height:150px; object-fit: cover'>";

                                        }else{
                                            echo "<img class='d-block mx-auto img-fluid'  src='../assets/profile/".$user_row['avatar']."' alt='profile' style='width: 150px; height:150px; object-fit: cover'>";
                                        }   
                                        ?>
                                    </div>

                                </div>
                            </div>
                        </form>    
                        <div> 
                    </div>  
                </p>
            </div>
            <!-- <a href="#"><i class="fa-solid fa-angle-left"></i></a> -->
        </div>
    </main>
</div>
</body>
</html>