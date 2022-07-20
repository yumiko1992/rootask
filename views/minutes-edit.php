<?php

$minutes_id = $_GET['minutes_id'];

require_once "../classes/minutes.php";

$getminutes = new Minutes;

//特定のminutesデータを取得
$getminutes_reslut = $getminutes->getSpecificMinutes($minutes_id);
$getminutes_row = $getminutes_reslut->fetch_assoc();



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Minutes</title>
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
        <h1 class="text-center">Edit Minutes</h1>

            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">
                        <form action="../actions/minutes.php?minutes_id=<?= $minutes_id ?>" method="post">

                            <label for="project-name">TITLE</label>
                                <input type="text" name="minutes_title" id="minutes-title" placeholder="" value="<?= $getminutes_row['title'] ?>" class="form-control mb-3" required>

                            <div class="row">
                                <div class="col">
                                    <label for="date">DATE OF THE MEETING</label>
                                    <input type="date" class="form-control mb-3" name="mtg_date" id="date" value="<?= $getminutes_row['mtg_date'] ?>" required>
                                </div>
                                <div class="col">
                                    <label for="project">PROJECT</label>
                                    
                                    
                                    <?php

                                    require_once "../classes/project.php";

                                    $project = new Project;
                                    $project_result = $project->getProject();

                                    ?>

                                    <select class="form-select mb-3" name="project_id" id="project" required>

                                    <?php
                                    while($project_row = $project_result->fetch_assoc()){
                                        if($getminutes_row['project_id'] == $minutes_row['project_id']){
                                
                                            echo "<option selected value=" .$getminutes_row['project_id'] .">" . $getminutes_row['project_name'] . "</option>";
                                  
                                        }else{
                                            echo "<option value=" .$project_row['project_id'] .">" .$project_row['project_name'] . "</option>";
                                        }
                                    }
                                    ?>

                                    </select>      
                                </div>
                            </div>


                            <label for="manager">PARTICIPANT</label>
                            <div class="border rounded p-3 mb-3">
                            <div class="row">
                                <div class="col-3 text-center my-auto">
                                    <p>MANAGER</p>
                                </div>

                                <div class="col-9">
                                    <!-- select manager -->
                                    <select name="participant_manager_id" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MANAGER</option>

                                    <?php
                                    $getminutes = new Minutes;
                                    $manager_result = $getminutes->getManager($minutes_id);
                                    
                                    require_once "../classes/user.php";
                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();
                                
                                    while($selectuser_row = $selectuser_result->fetch_assoc()){

                                        if($manager_result['participant_manager_id'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$manager_result['participant_manager_id'] ."'>" .$manager_result['first_name'] ." ". $manager_result['last_name'] . "</option>";
                                        }else{
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
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
                                    <select name="participant_member_id_1" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MEMBER</option>

                                    <?php
                                    require_once "../classes/user.php";
                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();
                                    
                                    $getminutes = new Minutes;
                                    $member_result_1 = $getminutes->getMember1($minutes_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){

                                        if($member_result_1['participant_member_id_1'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$member_result_1['participant_member_id_1']."'>" .$member_result_1['first_name'] ." ". $member_result_1['last_name'] . "</option>";
                                        }else{
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                </div>

                                <div class="col-3">
                                    <!-- select member2 -->
                                    <select name="participant_member_id_2" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MEMBER</option>

                                    <?php
                                    require_once "../classes/user.php";
                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();
                                    
                                    $getminutes = new Minutes;
                                    $member_result_2 = $getminutes->getMember2($minutes_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){

                                        if($member_result_2['participant_member_id_2'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$member_result_2['participant_member_id_2']."'>" .$member_result_2['first_name'] ." ". $member_result_2['last_name'] . "</option>";
                                        }else{
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                                
                                <div class="col-3">
                                    <!-- select member3 -->
                                    <select name="participant_member_id_3" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MEMBER</option>

                                    <?php
                                    require_once "../classes/user.php";
                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();
                                    
                                    $getminutes = new Minutes;
                                    $member_result_3 = $getminutes->getMember3($minutes_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){

                                        if($member_result_3['participant_member_id_3'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$member_result_3['participant_member_id_3']."'>" .$member_result_3['first_name'] ." ". $member_result_3['last_name'] . "</option>";
                                        }else{
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
                                    <!-- select member4 -->
                                    <select name="participant_member_id_4" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MEMBER</option>

                                    <?php
                                    require_once "../classes/user.php";
                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();
                                    
                                    $getminutes = new Minutes;
                                    $member_result_4 = $getminutes->getMember4($minutes_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){

                                        if($member_result_4['participant_member_id_4'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$member_result_4['participant_member_id_4']."'>" .$member_result_4['first_name'] ." ". $member_result_4['last_name'] . "</option>";
                                        }else{
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                                <div class="col-3">
                                    <!-- select member5 -->
                                    <select name="participant_member_id_5" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MEMBER</option>

                                    <?php
                                    require_once "../classes/user.php";
                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();
                                    
                                    $getminutes = new Minutes;
                                    $member_result_5 = $getminutes->getMember5($minutes_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){

                                        if($member_result_5['participant_member_id_5'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$member_result_5['participant_member_id_5']."'>" .$member_result_5['first_name'] ." ". $member_result_5['last_name'] . "</option>";
                                        }else{
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                                <div class="col-3">
                                    <!-- select member6 -->
                                    <select name="participant_member_id_6" id="assign-id" class="form-select mb-3">
                                    <option selected value="null">SELECT MEMBER</option>

                                    <?php
                                    require_once "../classes/user.php";
                                    $selectuser = new User;
                                    $selectuser_result = $selectuser->getUser();
                                    
                                    $getminutes = new Minutes;
                                    $member_result_6 = $getminutes->getMember6($minutes_id);

                                    while($selectuser_row = $selectuser_result->fetch_assoc()){

                                        if($member_result_6['participant_member_id_6'] == $selectuser_row['user_id']){
                                            echo "<option selected value='" .$member_result_6['participant_member_id_6']."'>" .$member_result_6['first_name'] ." ". $member_result_6['last_name'] . "</option>";
                                        }else{
                                            echo "<option value='".$selectuser_row['user_id']."'>". $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                </div>
                            </div> 
                            </div>
                            
                    
                            <label for="minutes" class="form-label">MINUTES</label>
                            <textarea class="form-control mb-3" id="minutes" name="minutes" rows="10"><?= $getminutes_row['minutes'] ?></textarea>


                            <!-- タスク追加機能いれる・・・？ -->
                            
                            <button type="submit" class="btn w-100 mt-4" name="btn_update_minutes">Update</button>
                        </form>
                    </p>
                </div>   
            </div> 
                <div><a href="dashboard-user.php"><i class="fa-solid fa-angle-left"></i></a></div>
        </main>
</div>
</body>
</html>