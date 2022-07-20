<?php

session_start();
$user_id = $_SESSION['user_id'];

$minutes_id = $_GET['minutes_id'];
// print_r($minutes_id);

require_once "../classes/minutes.php";

$minutes = new Minutes;
$minutes_result = $minutes->getSpecificMinutes($minutes_id);
$minutes_row = $minutes_result->fetch_assoc();


require_once "../classes/user.php";

$participant_menager_result = $minutes->getMinutesParticipantMan($minutes_id);
$participant_member_result1 = $minutes->getMinutesParticipantMem1($minutes_id);
$participant_member_result2 = $minutes->getMinutesParticipantMem2($minutes_id);
$participant_member_result3 = $minutes->getMinutesParticipantMem3($minutes_id);
$participant_member_result4 = $minutes->getMinutesParticipantMem4($minutes_id);
$participant_member_result5 = $minutes->getMinutesParticipantMem5($minutes_id);
$participant_member_result6 = $minutes->getMinutesParticipantMem6($minutes_id);

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minutes Detail</title>
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


    <main class="h-100 w-75 mx-auto mt-5">
        <h1 class="text-center">Minutes Detail</h1>

        <div class="card">
            <div class="card-body">
                <p class="card-text">
                <div class="row">
                    <div class="col-6">
                        <h4 class="fs-2 fw-bold"><?= $minutes_row['title'] ?></h4>
                    </div>
                        <div class="col-6">
                        <p class="text-end">
                        <a href="minutes-edit.php?minutes_id=<?= $minutes_id ?>">
                        <i class="fa-solid fa-pen-to-square"></i></a> <a href="minutes-delete.php?minutes_id=<?=$minutes_id?>"> <i class="fa-solid fa-trash-can"></i></a></p>

                        <div class="text-end"><i class="fa-solid fa-calendar-days"></i> <?= $minutes_row['mtg_date'] ?></div>
                        <p class="fw-lighter text-end">PROJECT : <a href="project-detail.php?project_id=<?= $minutes_row['project_id'] ?>"><?= $minutes_row['project_name'] ?></a></p>
                    </div>
                </div> 
                    
                    
                <div class="row">
                    <div class="col-3">
                        <div>PARTICIPANT</div>
                    </div>
                    <div class="col-9">
                        <div>MANAGER : 
                            <span class="text-primary"><?= $participant_menager_result['first_name'] . " " .$participant_menager_result['last_name'] ?></span>,</div>

                        <div>MEMBER : 
                            <span class="text-primary"><?= $participant_member_result1['first_name'] . " " . $participant_member_result1['last_name'] ?></span>, 

                            <span class="text-primary"><?= $participant_member_result2['first_name'] . " " . $participant_member_result2['last_name'] ?></span>,

                            <span class="text-primary"><?= $participant_member_result3['first_name'] . " " . $participant_member_result3['last_name'] ?></span>,

                            <span class="text-primary"><?= $participant_member_result4['first_name'] . " " . $participant_member_result4['last_name'] ?></span>,  

                            <span class="text-primary"><?= $participant_member_result5['first_name'] . " " . $participant_member_result5['last_name'] ?></span>,  

                            <span class="text-primary"><?= $participant_member_result6['first_name'] . " " . $participant_member_result6['last_name'] ?></span>
                        </div>
                    </div>
                </div>
                
                
    

                <p class="border p-2 mt-2 mb-5"><?= $minutes_row['minutes'] ?></p>


                
                <div class="row mt-5 mb-2">
                    <span class="">COMMENT</span>   
                </div>
                
                <form action="../actions/minutes-comment.php?minutes_id=<?= $minutes_id ?>" method="post">
                    <div class="hstack gap-3 mb-4">
                    <textarea class="form-control me-auto" name="comment" placeholder="comment here..."></textarea>
                    <button type="submit" class="btn btn-secondary" name="minutes_comment_submit">Submit</button>
                    </div>
                </form>

                <?php
                require_once "../classes/comment.php";

                $comment = new Comment;
                $comment_result = $comment->getMinutesComment($minutes_id);

                while($comment_row = $comment_result->fetch_assoc()){

                ?>

                <span><i class="fa-solid fa-circle-user mb-2"></i> <?= $comment_row['first_name'] ?> </span><span class="text-primary"></span> <span class="fw-lighter"> <?= $comment_row['time'] ?></span>
                <p class="ms-4 h6"><?= $comment_row['comment'] ?></p>

                <?php
                }
                ?>

            </div>
        </div>

        <p class="text-white mt-4"><a href="project-view.php"><i class="fa-solid fa-angle-left"></i></a></p>
    </main>

    

</div>
</body>
</html>