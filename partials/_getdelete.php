<?php 
require "_dbconnect.php";

if(isset($_GET['delete_id'])){

    $delete_id = $_GET['delete_id'];

    $query = "DELETE FROM `tasktable` WHERE `task_id` = '$delete_id'";
    $result = mysqli_query($con,$query);

    header("location: /web/MyToDoList");

}

?> 