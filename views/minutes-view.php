<?php

session_start();
$user_id = $_SESSION['user_id'];

require "../classes/minutes.php";

// $minutes = new Minutes;
// $minutes_result = $minutes->getUserMinutes($user_id);

$minutes = new Minutes;

$per_page_record =5;  // Number of entries to show in a page.   
        // Look for a GET variable page if not found default is 1.        
if (isset($_GET["page"])) {    
    $page  = $_GET["page"];    
}    
else {    
    $page=1;    
}    

$start_from = ($page-1) * $per_page_record;     
$minutes_result = $minutes->getMinutesForPagenation($user_id, $start_from, $per_page_record);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minutes View</title>
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
        <h1 class="text-center">Minutes View</h1>

            <div class="col mb-2">
                <a href="minutes-add.php" class="text-decoration-none">
                <button type="button" class="btn btn-secondary d-block me-auto"><i class="fa-solid fa-circle-plus"></i> Add Minutes</button></a>
            </div>
            
        <?php
        // require_once "../classes/minutes.php";
        // $minutes = new Minutes;
        // $minutes_result = $minutes->getMinutesForView($user_id);


        while($minutes_row = $minutes_result->fetch_assoc()){
        ?>

            <div class="card mb-3">
                <div class="card-body p-2">    
                    <div class="row">
                        <div class="col-8">
                            <span class="ms-2"><?= $minutes_row['mtg_date'] ?></span><span class="fs-5 fw-bold ms-3"><?=$minutes_row['title']?></span>
                            <!-- for task number -->
                            <!-- <span class="ms-auto">(3)</span> -->
                            
                        </div>
                        <div class="col-3">
                            <div class="text-end"><i class="fa-solid fa-diagram-project"></i> <?= $minutes_row['project_name'] ?></div>
                        </div>
                        <div class="col-1">
                            <div class="text-end me-3"><a href="minutes-detail.php?minutes_id=<?= $minutes_row['minutes_id'] ?>"><i class="fa-solid fa-angle-right"></i></a></div> 
                        </div>
                    </div>         
                </div>
            </div>

        <?php
        } 
        ?>

        <!-- pagenation -->
        <div class="text-center">    
            <?php         
                $result = $minutes->countMinutes($user_id);  
                $row = $result->fetch_row();   
                $total_records = $row[0];

                echo "<br>";     
                // Number of pages required.   
                $total_pages = ceil($total_records / $per_page_record);     
                $pagLink = "";       
                //prev
                if($page>=2){   
                    echo "<span class='border border-1 text-center px-1 me-1'><a href='minutes-view.php?page=".($page-1)."'>  <i class='fa-solid fa-angle-left'></i> </span></a>";   
                }       
                        
                for ($i=1; $i<=$total_pages; $i++) {   
                if ($i == $page) {   
                    $pagLink .= "<span class='border border-1 px-1 me-1 bg-secondary'><a class = 'active text-decoration-none text-white' href='minutes-view.php?page=" .$i."'>".$i." </span></a>";   
                }               
                else  {   
                    $pagLink .= "<span class='border border-1 px-1 me-1'><a class='text-decoration-none' href='minutes-view.php?page=".$i."'> ".$i." </span></a>";     
                }   
                };     
                echo $pagLink;   
                //next
                if($page<$total_pages){   
                    echo "<span class='border border-1 px-1 me-1'><a href='minutes-view.php?page=".($page+1)."'> <i class='fa-solid fa-angle-right'></i> </span></a>";   
                }   
            ?>    
        </div>

                
        <div><a href="dashboard-user.php"><i class="fa-solid fa-angle-left"></i></a></div>

        </div> 


    </main>


</div>
</body>
</html>