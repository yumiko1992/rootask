<?php

session_start();
$user_id = $_SESSION['user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAST PROJECTS</title>
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

    <main class="w-50 mx-auto m-4">
        <h1 class="text-center">PAST PROJECTS</h1>

            <div class="col mb-2">
                <a href="project-add.php" class="text-decoration-none">
                <button type="button" class="btn btn-secondary d-block me-auto"><i class="fa-solid fa-circle-plus"></i> Add Project</button></a>
            </div>
        

        <?php
        require_once "../classes/project.php";

        $project = new Project;
        $project_result = $project->getUserPastProject($user_id);
        
        while($project_row = $project_result->fetch_assoc()){
        ?>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <span class="fs-6 fw-bold"><?= $project_row['project_name'] ?></span> 
                            <span>(
                                <?php
                                    $project_id = $project_row['project_id'];
                                    $project_count_task = $project->countTask($project_id);
                                    print_r($project_count_task);                     
                                ?>    
                                )</span>
                            <span class=""> <?= $project_row['project_start'] ?> ~ <?= $project_row['project_end'] ?> </span>
                        </div>
                        <div class="col-3">
                            <span class="bg-info p-1 text-center my-auto fs-6"><?= $project_row['project_status'] ?></span>
                        </div>
                        <div class="col-1">
                            <a href="project-detail.php?project_id=<?= $project_row['project_id'] ?>"><i class="fa-solid fa-angle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        
        <?php
        }
        ?>

        
        <!-- <div class="card mb-3">
            <div class="card-body">
                This is some text within a card body.
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                This is some text within a card body.
            </div>
        </div> -->
                

        <div><a href="dashboard-user.php"><i class="fa-solid fa-angle-left"></i></a></div>

        </div> 


    </main>


</div>
</body>
</html>