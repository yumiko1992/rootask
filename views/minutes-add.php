<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Minutes</title>
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
        <h1 class="text-center">Add Minutes</h1>

            <div class="card mb-3">
                <div class="card-body">
                    <p class="card-text">
                        <form action="../actions/minutes.php" method="post">

                            <label for="project-name">TITLE</label>
                                <input type="text" name="minutes_title" id="minutes-title" placeholder="" class="form-control mb-3" required>

                            <div class="row">
                                <div class="col">
                                    <label for="date">DATE OF THE MEETING</label>
                                    <input type="date" class="form-control mb-3" name="mtg_date" id="date" required>
                                </div>
                                <div class="col">
                                    <label for="project">PROJECT</label>
                                    <select class="form-select mb-3" name="project_id" id="project" required>
                                        <option selected>SELECT PROJECT</option>

                                        <?php
                                         require_once "../classes/project.php";
                                         $project = new Project;
                                         $project_result = $project->getProject();
                                         while($project_row = $project_result->fetch_assoc()){

                                        ?>

                                        <option value="<?=$project_row['project_id']?>"><?=$project_row['project_name']?></option>

                                        <?php
                                        }
                                        ?>

                                        <!-- <option value="#">2</option>
                                        <option value="#">3</option>
                                        <option value="#">4</option>
                                        <option value="#">waiting for an approval</option> -->
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
                                        <select name="participant_manager_id" id="" class="form-select mb-3">
                                        <option selected value="">SELECT MANAGER</option>
                                        
                                        <?php
                                        require_once "../classes/user.php";

                                        $selectuser = new User;
                                        $selectuser_result = $selectuser->getUser();

                                        while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        ?>

                                        <option value="<?= $selectuser_row['user_id'] ?>"><?= $selectuser_row['first_name'] ." ". $selectuser_row['last_name'] ?></option>

                                        <?php
                                        }
                                        ?>
                                        </select>           
                                    </div>

                                    <div class="col-3 text-center my-auto">
                                        <p>MEMBER</p>
                                    </div>
                                    <div class="col-3">
                                        <!-- select member -->
                                        <select name="participant_member_id_1" id="assign-id" class="form-select mb-3">
                                        <option selected value="null">SELECT MANAGER</option>
                                        
                                        <?php
                                        require_once "../classes/user.php";

                                        $selectuser = new User;
                                        $selectuser_result = $selectuser->getUser();

                                        while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        ?>

                                        <option value="<?=$selectuser_row['user_id']?>"><?=$selectuser_row['first_name'] ." ". $selectuser_row['last_name']?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>             
                                    </div>
                                    <div class="col-3">
                                        <!-- select member -->
                                        <select name="participant_member_id_2" id="assign-id" class="form-select mb-3">
                                        <option selected value="null">SELECT MANAGER</option>
                                        
                                        <?php
                                        require_once "../classes/user.php";

                                        $selectuser = new User;
                                        $selectuser_result = $selectuser->getUser();

                                        while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        ?>

                                        <option value="<?=$selectuser_row['user_id']?>"><?=$selectuser_row['first_name'] ." ". $selectuser_row['last_name']?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>             
                                    </div>
                                    <div class="col-3">
                                        <!-- select member -->
                                        <select name="participant_member_id_3" id="assign-id" class="form-select mb-3">
                                        <option selected value="null">SELECT MANAGER</option>
                                        
                                        <?php
                                        require_once "../classes/user.php";

                                        $selectuser = new User;
                                        $selectuser_result = $selectuser->getUser();

                                        while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        ?>

                                        <option value="<?=$selectuser_row['user_id']?>"><?=$selectuser_row['first_name'] ." ". $selectuser_row['last_name']?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>             
                                    </div>

                                    <!-- member 2行目 -->
                                    <div class="col-3 text-center my-auto">

                                    </div>
                                    <div class="col-3">
                                        <!-- select member -->
                                        <select name="participant_member_id_4" id="assign-id" class="form-select">
                                        <option selected value="null">SELECT MANAGER</option>
                                        
                                        <?php
                                        require_once "../classes/user.php";

                                        $selectuser = new User;
                                        $selectuser_result = $selectuser->getUser();

                                        while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        ?>

                                        <option value="<?=$selectuser_row['user_id']?>"><?=$selectuser_row['first_name'] ." ". $selectuser_row['last_name']?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>             
                                    </div>
                                    <div class="col-3">
                                        <!-- select member -->
                                        <select name="participant_member_id_5" id="assign-id" class="form-select">
                                        <option selected value="null">SELECT MANAGER</option>
                                        
                                        <?php
                                        require_once "../classes/user.php";

                                        $selectuser = new User;
                                        $selectuser_result = $selectuser->getUser();

                                        while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        ?>

                                        <option value="<?=$selectuser_row['user_id']?>"><?=$selectuser_row['first_name'] ." ". $selectuser_row['last_name']?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>             
                                    </div>
                                    <div class="col-3">
                                        <!-- select member -->
                                        <select name="participant_member_id_6" id="assign-id" class="form-select">
                                        <option selected value="null">SELECT MANAGER</option>
                                        
                                        <?php
                                        require_once "../classes/user.php";

                                        $selectuser = new User;
                                        $selectuser_result = $selectuser->getUser();

                                        while($selectuser_row = $selectuser_result->fetch_assoc()){
                                        ?>

                                        <option value="<?=$selectuser_row['user_id']?>"><?=$selectuser_row['first_name'] ." ". $selectuser_row['last_name']?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>             
                                    </div>
                            </div>
                        </div>

            
                                    
                            <label for="minutes" class="form-label">MINUTES</label>
                            <textarea class="form-control mb-3" id="minutes" name="minutes" rows="10"></textarea>



                            <!-- タスク追加機能いれる・・・？ -->
                            



                            <button type="submit" class="btn w-100 mt-4" name="add_minutes">Add</button>
                        </form>
                    </p>
                </div>   
            </div> 
                <div><a href="dashboard-user.php"><i class="fa-solid fa-angle-left"></i></a></div>
        </main>
</div>
</body>
</html>