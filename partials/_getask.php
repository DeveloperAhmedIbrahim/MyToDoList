<?php 

    require "_dbconnect.php";

    echo $_SERVER['REQUEST_METHOD'];
    echo $_GET['task']; 

    if($_SERVER['REQUEST_METHOD'] == "POST"){

        $task = $_POST['task'];
        $query = "INSERT INTO `tasktable`(task_name) VALUES('$task')";

        $result = mysqli_query($con,$query);

        

        header('location: /web/MyToDoList/index.php');
    }





?>