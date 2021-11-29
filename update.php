<?php
require("partials/_dbconnect.php");
if (isset($_GET['edit_id'])) {
    $id = $_GET['edit_id'];
    $query = "SELECT * FROM `tasktable` WHERE `task_id` = $id";
    $result = mysqli_query($con,$query);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
        header("location: ../MyToDoList");        
    }else{
        $query = "SELECT * FROM `tasktable` WHERE `task_id` = $id";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_assoc($result)){
    
            $task = $row['task_name'];
    
        }
    }
    
}
else{
    header("location: ../MyToDoList");
}
if (isset($_POST['task'])) {
    $task = $_POST['task'];
    $query =  "UPDATE `tasktable` SET `task_name` = '$task' WHERE `task_id` = $id";
    $result = mysqli_query($con,$query);
    header("location: ../MyToDoList");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>My To Do List</title>
</head>

<body>
    <div class="container col-md-4 mt-5">

        <form action="" method="POST" class="row g-3">
            <div class="col-md-8 float-end">
                <input type="text" class="form-control" id="task" value="<?php echo $task; ?>" placeholder="Write Task" name="task">
            </div>
            <div class="col-auto float-end">
                <button type="submit" class="btn btn-primary mb-3" style="width: 200%;"><i class="fa fa-edit"
                        style="font-size: larger;"></i></button>;
            </div>
        </form>

    </div>
</body>

</html>