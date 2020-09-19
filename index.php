<?php include "config.php"; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <title> Pagination</title>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center">All users</h1>
        <?php

        if(isset($_SESSION['success']))
            echo "<div class='alert alert-success' role='alert'>" . $_SESSION['success']  . "</div>";
            unset($_SESSION['success']);
        ?>
        <button type="button" class="btn btn-primary m-3" data-toggle="modal" data-target="#userModal" data-whatever="@getuser">Add User</button>
        <table class="table table-hover table-bordered ">
            <thead>
                <tr>
                    <th>id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $limit = 30;

                if(!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                $start_from = ($page - 1) * $limit;

                $result = mysqli_query($connection,"SELECT * FROM users  LIMIT $start_from,$limit");
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                    <td> <?php echo $row['id']; ?>  </td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['last_name']; ?> </td>
                    <td><?php echo $row['email']; ?> </td>
                    <td><?php echo $row['gender']; ?> </td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><input type="button" name="edit" value="Edit" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs edit_data" /></td> 
                    <td><a class="btn btn-danger btn-xs" href="delete.php?delete=<?php echo $row['id']; ?>">Delete</a></td>
                    </tr>

                <?php
                    }

                ?>
            </tbody>
        </table>
       
        <?php

                $result_db = mysqli_query($connection,"SELECT COUNT(id) FROM users");
                $row_db = mysqli_fetch_row($result_db);
                $total_records = $row_db[0];  

                $total_pages = ceil($total_records / $limit); 

                
                $pagLink = "<ul class='pagination justify-content-center'>";  
                for ($i=1; $i<=$total_pages; $i++) {
                            $pagLink .= "<li class='page-item'><a class='page-link' href='index.php?page=".$i."'>".$i."</a></li>";	
                }
                echo $pagLink . "</ul>";  
                

        ?>
        <!-- <ul class="pagination">
                <li class="page-item m-3"><a href="?page=1">First</a></li>
                <li class="page-item m-3 <?php //if($page <= 1){ echo 'disabled'; } ?>">
                    <a href="<?php //if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>">Prev</a>
                </li>
                <li class=" page-item m-3 <?php //if($page >= $total_pages){ echo 'disabled'; } ?>">
                    <a href="<?php //if($page >= $total_pages){ echo '#'; } else { echo "?page=".($page + 1); } ?>">Next</a>
                </li>
                <li class="page-item m-3"><a href="?page=<?php //echo $total_pages; ?>">Last</a></li>
         </ul> -->
    </div>
    <div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">New message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="add_user.php" method="POST">
                        <div class="form-group">
                            <label for="fname" class="col-form-label">First Name:</label>
                            <input type="text" class="form-control" id="first_name" name="fname" placeholder="John">
                        </div>
                        <div class="form-group">
                            <label for="lname" class="col-form-label">Last Name:</label>
                            <input type="text" class="form-control" id="last_name" name="lname" placeholder="Doe">
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="johndoe@gmail.com">
                        </div>
                        <div class="form-group">
                            <label for="gender" class="col-form-label">Gender:</label>
                            <select name="gender" id="gender" class="form-control">
                                <option value="none">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="address" class="col-form-label">Address:</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="751 Dunning Pass">
                        </div>
                        <div class="form-group">
                            <label for="phone" class="col-form-label">Phone:</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="+233 (533) 532-5803">
                            <input type="hidden" name="user_id" id="user_id" />
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="add_user" id="add_user" class="btn btn-primary" value="Add User"/>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(document).on("click",'.edit_data',function() {
                var user_id = $(this).attr('id');
                $.ajax({
                    url: 'fetch.php',
                    method: 'POST',
                    data:{user_id:user_id},
                    dataType: "json",
                    success:function(data){
                        $("#first_name").val(data.first_name);
                        $("#last_name").val(data.last_name);
                        $("#gender").val(data.gender);
                        $("#address").val(data.address);
                        $("#phone").val(data.phone);
                        $("#email").val(data.email);
                        $("#user_id").val(data.id);
                        $("#add_user").val("Update");
                        $('#userModal').modal('show');  
                    }
                });
            });
        });
    </script>
</body>

</html>