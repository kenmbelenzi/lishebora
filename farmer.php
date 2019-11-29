<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">

</head>
<div id="page-content-wrapper">

<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Lishe Bora </div>
        <div class="list-group list-group-flush">
            <a href="./test/save.php" class="list-group-item list-group-item-action bg-light">Create new formulation</a>
            <a href="./newrawmaterial.php" class="list-group-item list-group-item-action bg-light">Insert new raw materials</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">View saved formulations</a>

        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

        <?php
        //login_success.php
        session_start();
        if(isset($_SESSION["name"]))
        {
            $role=$_SESSION["role"];
            if(strcmp($role,'admin') == 0){
            echo '<h3>Login Success, Welcome - '.$_SESSION["role"].'</h3>';
            echo '<br /><br /><a href="logout.php">Logout</a>';
                }
                else{
                header("location:index.php");
                }
        }
        else
        {
            header("location:index.php");
        }

        ?>


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
</div>

</html>
