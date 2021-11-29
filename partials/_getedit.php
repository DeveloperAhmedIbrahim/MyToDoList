<?php 

    require "_dbconnect.php";


    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $id = $_POST['task_id'];
        $task = $_POST['task'];

        $query = "UPDATE `tasktable` SET `task_name` = '$task' WHERE `task_id` = '$id'";

        $result = mysqli_query($con,$query);

        

        header('location: /web/MyToDoList');
    }





?>