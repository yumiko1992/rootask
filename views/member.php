<?php

require_once "../classes/member.php";

$member = new Member;
// $member_result = $member->getMembers();
// $member_row = $member_result->fetch_assoc();
// print_r($member_row);


$per_page_record =10;  // Number of entries to show in a page.   
        // Look for a GET variable page if not found default is 1.        
if (isset($_GET["page"])) {    
    $page  = $_GET["page"];    
}    
else {    
    $page=1;    
}    

$start_from = ($page-1) * $per_page_record;     
$member_result = $member->getMembersForPagination($user_id, $start_from, $per_page_record);
// print_r($tasks_result);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMBERS</title>
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

    <main class="h-100 w-75 mx-auto m-4">
        <h1 class="text-center">MEMBERS</h1>

        <input class="form-control w-25 ms-auto mb-1" list="datalistOptions" id="exampleDataList" placeholder="Type to search...">
        <datalist id="datalistOptions">
        <option value="San Francisco">
        <option value="New York">
        <option value="Seattle">
        <option value="Los Angeles">
        <option value="Chicago">
        </datalist>

        <div class="card">
            <div class="card-body">
                <p class="card-text m-3">
                    <div class="table-responsive">
                    <table class="table text-center ">
                        <thead>
                            <tr>
                            <th scope="col">NAME</th>
                            <th scope="col">DIVISION</th>
                            <th scope="col">POSITION</th>
                            <th scope="col">PRIVILEGE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while($member_row = $member_result->fetch_assoc()){
                            ?>
                                <tr>
                                <td><a href="member-detail.php?user_id=<?= $member_row['user_id'] ?>" class="text-decoration-none text-black"><?= $member_row['first_name']." ".$member_row['last_name']?></a></td>
                                <td><a href="member-detail.php?user_id=<?= $member_row['user_id'] ?>" class="text-decoration-none text-black"><span><?= $member_row['division'] ?></span></a></td>
                                <td><a href="member-detail.php?user_id=<?= $member_row['user_id'] ?>" class="text-decoration-none text-black"><span><?= $member_row['position'] ?></span></a></td>
                                <?php
                                    if($member_row['role'] == 'U'){
                                        echo " <td><span class='p-1 bg-info text-white'>USER</span></td>";
                                    }else{
                                        echo " <td><span class='p-1 bg-danger text-white'>ADMIN</span></td>";
                                    }
                                ?>
                                <td><a href="member-detail.php?user_id=<?= $member_row['user_id'] ?>"><i class="fa-solid fa-angles-right"></i></a></td>
                                </tr>
                            <?php
                            }
                            ?>                            
                        </tbody>
                    </table>
                    </div>
                </p>
            </div>

            <div class="card-footer mx-auto bg-white border-white">               
                <div class="pagination">    
                    <?php  
                       
                        $result = $member->countMembers($user_id); 
                        $row = $result->fetch_row();   
                    
                        $total_records = $row[0];

                        echo "</br>";     
                        // Number of pages required.   
                        $total_pages = ceil($total_records / $per_page_record);     
                        $pagLink = "";       
                        //prev
                        if($page>=2){   
                            echo "<span class='border border-1 px-1 me-1'><a href='member.php?page=".($page-1)."'>  <i class='fa-solid fa-angle-left'></i> </span></a>";   
                        }       
                                
                        for ($i=1; $i<=$total_pages; $i++) {   
                        if ($i == $page) {   
                            $pagLink .= "<span class='border border-1 px-1 me-1 bg-secondary'><a class = 'active text-decoration-none text-white' href='member.php?page=" .$i."'>".$i." </span></a>";   
                        }               
                        else  {   
                            $pagLink .= "<span class='border border-1 px-1 me-1'><a class='text-decoration-none' href='member.php?page=".$i."'> ".$i." </span></a>";     
                        }   
                        };     
                        echo $pagLink;   
                        //next
                        if($page<$total_pages){   
                            echo "<span class='border border-1 px-1 me-1'><a href='member.php?page=".($page+1)."'> <i class='fa-solid fa-angle-right'></i> </span></a>";   
                        }   
                
                    ?>    
                </div>
            </div>







        </div>

        <div class="mt-3"><a href="dashboard-user.php"><i class="fa-solid fa-angle-left"></i></a></div>
    </main>

</div>
</body>
</html>