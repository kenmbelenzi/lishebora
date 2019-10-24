<? require 'database/db.php';

include "adminsidenav.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Lishe Bora</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Lishe Bora </div>
        <div class="list-group list-group-flush">
            <a href="test/calculator.php" class="list-group-item list-group-item-action bg-light">Create new formulation</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Insert new raw materials</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">View saved formulations</a>

        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">



        <div class="container">
            <table border="1" cellspacing="5" cellpadding="5" width="100%" class="table table-dark">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>First Name</th>
                    <th>email</th>
                    <th>Actions</th>

                </tr>
                </thead>
                <tbody>
                <?php
                require_once('database/db.php');
                $result = $db->prepare("SELECT * FROM register_user ORDER BY id ASC");
                $result->execute();
                for($i=0; $row = $result->fetch(); $i++){
                    ?>
                    <tr>
                        <td><label><?php echo $row['id']; ?></label></td>
                        <td><label><?php echo $row['username']; ?></label></td>
                        <td><label><?php echo $row['email']; ?></label></td>
                        <td>
                            <a href="database/update.php?id=<?php echo $row['id'];?>"
                               class="btn btn-info">Edit</a>
                            <a href="database/delete.php?id=<?php echo $row['id'];?>"
                               class="btn btn-danger">delete</a>
                        </td>


                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    </div>
    <!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>



















