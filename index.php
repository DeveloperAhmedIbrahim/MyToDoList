<!doctype html>
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

    <?php require "partials/_dbconnect.php"; ?>

    <div class="container text-center my-5">

        <h5> &nbsp; </h5>

    </div>



    <div class="container col-md-4">

        <form action="partials/_getask.php" method="POST" class="row g-3">
            <div class="col-md-8 float-end">
                <input type="text" class="form-control" id="task" value="" placeholder="Write Task" name="task">
            </div>
            <div class="col-auto float-end">
                <button type="submit" class="btn btn-primary mb-3" style="width: 200%;"><i class="fa fa-edit"
                        style="font-size: larger;"></i></button>;
            </div>
        </form>

    </div>


    <div class="container my-5"> &nbsp; </div>

    <div class="container col-md-8">

        <table class="table  table-warning table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Taks</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>

                <?php 
                      $query ="SELECT * FROM `tasktable` ORDER BY `task_id` DESC";
                      $result = mysqli_query($con,$query);
                      $count = 0;
                      while($row = mysqli_fetch_assoc($result)){ 
                        
                        $count++;
                        $task = $row['task_name'];
                        $id = $row['task_id'];  ?>
                <tr>
                    <th scope="row"><?php echo $count; ?></th>
                    <td class="col-md-10"><?php echo $task; ?></td>
                    <td>

                        <a href="/web/MyToDoList/index.php/?edit_id=<?php echo $id; ?>" class="btn btn-success  my-1"> <i
                                class="fas fa-pen-alt" style="font-size: larger;"></i>
                        </a>
                        <a href="/web/MyToDoList/index.php/?delete_id=<?php echo $id; ?>" class="btn btn-danger my-1"> <i class="fas fa-trash-alt" style="font-size: larger;"></i>
                        </a>

                    </td>
                </tr>

                <?php } ?>


            </tbody>
        </table>

    </div>

    <?php 

      $task = "";
      $insert = true;
      $edit = false;

      require "partials/_dbconnect.php";

      if(isset($_GET['edit_id'])){

        $edit_id = $_GET['edit_id'];
        $query = "SELECT * FROM `tasktable` WHERE `task_id` = '$edit_id'";
        $result = mysqli_query($con,$query);
        while($row = mysqli_fetch_assoc($result)){

            $task = $row['task_name'];
            $edit = true;
        }

      }
  
    ?>

    <?php if($edit == true) {?>
    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                </div>
                <div class="modal-body">

                    <form action="/web/MyToDoList/partials/_getedit.php" method="POST" class="row g-3">
                        <div class="col-md-8 float-end">
                            <input type="text" class="form-control" id="task_id" hidden value="<?php echo $edit_id?>"
                                placeholder="Write Task" name="task_id">
                            <input type="text" class="form-control" id="task" value="<?php echo $task?>"
                                placeholder="Write Task" name="task">
                        </div>
                        <div class="col-auto float-end">
                            <button type="submit" class="btn btn-primary mb-3" style="width: 200%;"><i
                                    class="far fa-edit" style="font-size: larger;"></i></button>


                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="/web/MyToDoList" type="button" class="btn btn-secondary" onclick="closemodal()"
                        data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>



    <?php 

        $delete = false;

        if(isset($_GET['delete_id'])){

            $delete_id = $_GET['delete_id'];
            $delete = true;
            $edit = false;    

        }

    ?>    

    <?php if($delete == true) {?>    
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog bg-danger">
            <div class="modal-content">
                <div class="modal-body">
                    <h4 class="text-danger">Do you really want to delete task !</h4>
                </div>
                <div class="modal-footer">

                <a href="/web/MyToDoList/partials/_getdelete.php/?delete_id=<?php echo $delete_id; ?>" type="button" class="btn btn-danger" 
                        >Yes</a>
                    <a href="/web/MyToDoList" type="button" class="btn btn-secondary" onclick="closemodal()"
                        data-dismiss="modal">No</a>

                </div>
            </div>
        </div>
    </div>
    <?php } ?>





    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>


    <script>
    $(document).ready(function() {

        $('#editModal').modal('show');
        $('#deleteModal').modal('show');

    })


    function closemodal() {

        $('#editModal').modal('hide');
        $('#deleteModal').modal('hide');

    }
    </script>
</body>

</html>