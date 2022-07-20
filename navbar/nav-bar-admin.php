<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <div class="container">
        <!-- BRAND -->
        <a href="dashboard-user.php" class="navbar-brand fs-2">Rootask</a>

        <!-- BUTTON -->
        <button type="button" class="navbar-toggler" data-bs-target="#menu" data-bs-toggle="collapse">
            <!-- icon -->
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="navbar-collapse collapse" id="menu">
            <!-- MENU  -->
            <ul class="navbar-nav">
                <!-- <li class="nav-item">
                    <a href="dashboard-user.php" class="nav-link active">Dashboard</a>
                </li> -->
                <li class="nav-item">
                    <a href="task-view.php" class="nav-link active">Tasks</a>
                </li>
                <li class="nav-item">
                    <a href="project-view.php" class="nav-link active">Project</a>
                </li>
                <li class="nav-item">
                    <a href="minutes-view.php" class="nav-link active">Minutes</a>
                </li>
                <li class="nav-item">
                    <a href="approval-view.php" class="nav-link active">Approval</a>
                </li>
                <li class="nav-item">
                    <a href="member.php" class="nav-link active">Member</a>
                </li>
            </ul>
            <!-- 2nd set of menu -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <?php                    
                    echo "<a href='profile.php?user_id=".$user_id."' class='nav-link active'><i class='fa-solid fa-user'></i>" .$result_user['first_name']." ".$result_user['last_name']. "</a>"
                    ?>
                
                </li>
                <li class="nav-item">
                    <a href="../actions/sign-out.php" class="nav-link active"><i class="fa-solid fa-right-from-bracket"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>