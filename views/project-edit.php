<?php

$project_id = $_GET['project_id'];

require_once "../classes/project.php";
$project = new Project;
$project_result = $project->getAProject($project_id);
$project_row = $project_result->fetch_assoc();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Project</title>
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

<div  class="container-fluid">
        <main class="h-100 w-50 mx-auto mt-5">
        <h1 class="text-center">Edit Project</h1>
            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">
                        <form action="../actions/project.php?project_id=<?= $project_id ?>" method="post">

                        <label for="project-name">PROJECT NAME</label>
                        <input type="text" name="project_name" id="project-name" placeholder="" class="form-control mb-3" value="<?= $project_row['project_name'] ?>" required>

                        <label for="manager">PROJECT MEMBER</label>
                        <div class="border rounded p-3 mb-3">
                            <div class="row">
                                <div class="col-3 text-center my-auto">
                                    <p>MANAGER</p>
                                </div>

                                <div class="col-9">
                                    <!-- select manager -->
                                    <select name="manager_id" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MANAGER</option>

                                    <?php

                                    require_once "../classes/user.php";

                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();

                                
                                    while($selectuser_row = $selectuser_result->fetch_assoc()){

                                        if($project_row['manager_id'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$project_row['manager_id'] ."'>" .$project_row['first_name'] ." ". $project_row['last_name'] . "</option>";
                                        }else{
                                            echo "

                                            <option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }

                                    ?>
                                    </select>           
                                </div>


                                <div class="col-3 text-center my-auto">
                                    <p>MEMBER</p>
                                </div>
                                <div class="col-3">
                                    <!-- select member1 -->
                                    <select name="member_id_1" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MEMBER</option>

                                    <?php
                                    require_once "../classes/user.php";

                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();

                                    $project_member_1_row = $project->getMember1($project_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){

                                        if($project_member_1_row['member_id_1'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$project_member_1_row['member_id_1']."'>" .$project_member_1_row['first_name'] ." ". $project_member_1_row['last_name'] . "</option>";
                                        }else{
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                </div>

                                <div class="col-3">
                                    <!-- select member2 -->
                                    <select name="member_id_2" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MEMBER</option>

                                    <?php
                                    require_once "../classes/user.php";

                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();

                                    $project_member_2_row = $project->getMember2($project_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){

                                        if($project_member_2_row['member_id_2'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$project_member_2_row['member_id_2']."'>" .$project_member_2_row['first_name'] ." ". $project_member_2_row['last_name'] . "</option>"; 
                                        }else{
                                            // echo "<option selected value='null'>SELECT USER</option>"; 
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                                
                                <div class="col-3">
                                    <!-- select member -->
                                    <select name="member_id_3" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MEMBER</option>
                                    
                                    <?php
                                    require_once "../classes/user.php";

                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();

                                    $project_member_3_row = $project->getMember3($project_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        if($project_member_3_row['member_id_3'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$project_member_3_row['member_id_3']."'>" .$project_member_3_row['first_name'] ." ". $project_member_3_row['last_name'] . "</option>"; 
                                        }else{
                                            // echo "<option selected value='null'>SELECT USER</option>"; 
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>             
                                </div>

                                <!-- member 2行目 -->
                                <div class="col-3 text-center my-auto">

                                </div>
                                <div class="col-3">
                                    <!-- select member -->
                                    <select name="member_id_4" id="assign-id" class="form-select">
                                    <option selected value="null">SELECT MEMBER</option>
                                    
                                    <?php
                                    require_once "../classes/user.php";

                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();

                                    $project_member_4_row = $project->getMember4($project_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        if($project_member_4_row['member_id_4'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$project_member_4_row['member_id_4']."'>" .$project_member_4_row['first_name'] ." ". $project_member_4_row['last_name'] . "</option>"; 
                                        }else{
                                            // echo "<option selected value='null'>SELECT USER</option>"; 
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>             
                                </div>
                                <div class="col-3">
                                    <!-- select member -->
                                    <select name="member_id_5" id="assign-id" class="form-select">
                                    <option selected value="null">SELECT MEMBER</option>
                                    
                                    <?php
                                    require_once "../classes/user.php";

                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();

                                    $project_member_5_row = $project->getMember5($project_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        if($project_member_5_row['member_id_5'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$project_member_5_row['member_id_5']."'>" .$project_member_5_row['first_name'] ." ". $project_member_5_row['last_name'] . "</option>"; 
                                        }else{
                                            // echo "<option selected value='null'>SELECT USER</option>"; 
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>             
                                </div>
                                <div class="col-3">
                                    <!-- select member -->
                                    <select name="member_id_6" id="assign-id" class="form-select">
                                    <option selected value="null">SELECT MEMBER</option>
                                    
                                    <?php
                                    require_once "../classes/user.php";

                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();

                                    $project_member_6_row = $project->getMember6($project_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        if($project_member_6_row['member_id_6'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$project_member_6_row['member_id_6']."'>" .$project_member_6_row['first_name'] ." ". $project_member_6_row['last_name'] . "</option>"; 
                                        }else{
                                            // echo "<option selected value='null'>SELECT USER</option>"; 
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>             
                                </div>
                            </div>
                        </div>


                            <div class="row">
                                <div class="col-5">
                                <label for="start-date">START DATE</label>
                                    <input type="date" name="start_date" id="start-date" class="form-control mb-3" value="<?= $project_row['project_start'] ?>">
                                </div>
                                <div class="col-2 m-auto">
                                    <p class="text-center my-auto">〜</p>
                                </div>
                                <div class="col-5">
                                    <label for="end-date">END DATE</label>
                                    <input type="date" name="end_date" id="end-date" class="form-control mb-3" value="<?= $project_row['project_end'] ?>">
                                </div>
                            </div>
                
                            <label for="note" class="form-label">NOTE</label>
                            <textarea class="form-control mb-3" id="note" name="note" rows="4"><?= $project_row['note'] ?></textarea>

                            <!-- <label for="STATUS">STATUS</label>
                            <select class="form-select mb-3" name="status" id="status" required>
                                <option selected>SELECT STATUS</option>
                                <option value="planning">planning</option>
                                <option value="ongoing">ongoing</option>
                                <option value="pending">pending</option>
                                <option value="postpone">postpone</option>
                                <option value="canceled">canceled</option>
                                <option value="done">done</option>
                                <option value="#">waiting for an approval</option>
                            </select>  -->


                            <label for="STATUS">STATUS</label>
                                <?php
                                require_once "../classes/project.php";

                                $getproject = new Project;
                                $getproject_result = $project->getProject();
                                // $getproject_row = $getproject_result->fetch_assoc();
                                // print_r($getproject_row);
                                ?>

                                <select class="form-select mb-3" name="status" id="status" required>

                                <?php
                                while($getproject_row = $getproject_result->fetch_assoc()){
                                    if($getproject_row['project_status'] == $project_row['project_status']){
                                        echo "<option selected value=".$project_row['project_status'].">" .$project_row['project_status'] ."</option>";
                                    }else{
                                        echo "<option value=". $getproject_row['project_status'] .">" . $getproject_row['project_status'] . "</option>";
                                    }
                                }
                                ?>
                            </select>

                            <input type="submit" name="btn_update_project" class="btn w-100" value="Update">
                        </form>

                    </p>
                </div>
            </div> 

            <div><a href="dashboard-user.php"><i class="fa-solid fa-angle-left"></i></a></div>

        </main>
</div>
</body>
</html>