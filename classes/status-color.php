<?php

class Status{
    public function changeColor(){
        if($task_status == 'done'){
            return $result = "<span class='bg-secondary p-1'> "$tasks_row['task_status']"</span>";

        }elseif($task_status == 'ongoing'){
            return echo "<span class='bg-info p-1'>" $tasks_row['task_status']"</span>";
        }  
    }
}

?>