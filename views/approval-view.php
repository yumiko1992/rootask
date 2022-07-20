<?php

session_start();
$user_id = $_SESSION['user_id'];



require "../classes/project.php";
$projects = new Project;

$per_page_record =10;  // Number of entries to show in a page.   
        // Look for a GET variable page if not found default is 1.        
if (isset($_GET["page"])) {    
    $page  = $_GET["page"];    
}    
else {    
    $page=1;    
}    

$start_from = ($page-1) * $per_page_record;     
$projects_result = $projects->getAwaitingApprovalProjectsForPagination($user_id, $start_from, $per_page_record);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AWAITING APPROVAL PROJECT VIEW</title>
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
        <h1 class="text-center">AWAITING <br> YOUR APPROVAL</h1>

        <div class="row mb-2">
            <div class="col">
                
            </div>
            <div class="col">
                <input class="form-control w-25 ms-auto mb-2" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
                <datalist id="datalistOptions">
                <option value="San Francisco">
                <option value="New York">
                <option value="Seattle">
                <option value="Los Angeles">
                <option value="Chicago">
                </datalist>            
            </div>
        </div>

        <?php
        // require_once "../classes/project.php";
        // $project = new Project;
        // $project_result = $project->getAwaitingApprovalProject($user_id);
        
        while($project_row = $projects_result->fetch_assoc()){
        ?>

            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-8">
                            <span class="fs-6 fw-bold"><?= $project_row['project_name'] ?></span> 
                            <span>(
                                <?php
                                $project_id = $project_row['project_id'];
                                
                                $project_count_task = $projects->countTask($project_id);
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


        <div class="text-center">    
            <?php         
                $result = $projects->countAwaitingApprovalProjects($user_id);  
                $row = $result->fetch_row();   
                $total_records = $row[0];

                echo "</br>";     
                // Number of pages required.   
                $total_pages = ceil($total_records / $per_page_record);     
                $pagLink = "";       
                //prev
                if($page>=2){   
                    echo "<span class='border border-1 px-1 me-1'><a href='approval-view.php?page=".($page-1)."'>  <i class='fa-solid fa-angle-left'></i> </span></a>";   
                }       
                        
                for ($i=1; $i<=$total_pages; $i++) {   
                if ($i == $page) {   
                    $pagLink .= "<span class='border border-1 px-1 me-1 bg-secondary'><a class = 'active text-decoration-none text-white' href='approval-view.php?page=" .$i."'>".$i." </span></a>";   
                }               
                else  {   
                    $pagLink .= "<span class='border border-1 px-1 me-1'><a class='text-decoration-none' href='approval-view.php?page=".$i."'> ".$i." </span></a>";     
                }   
                };     
                echo $pagLink;   
                //next
                if($page<$total_pages){   
                    echo "<span class='border border-1 px-1 me-1'><a href='approval-view.php?page=".($page+1)."'> <i class='fa-solid fa-angle-right'></i> </span></a>";   
                }   
            ?>    
        </div>





        <div class="row">
            <div class="col">
                <div><a href="dashboard-user.php"><i class="fa-solid fa-angle-left"></i></a></div>
            </div>
            <div class="col">
                <div class="text-end"><a href="project-past.php" class="text-decoration-none"> <i class="text-light fa-solid fa-clock-rotate-left"></i> <a href="approval-past.php" class="text-light text-decoration-none">PAST</a></div>    
            </div>
        </div>
                
    </main>


</div>
</body>
</html>