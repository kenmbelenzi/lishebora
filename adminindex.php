<?require 'db.php';

include "adminsidenav.php";
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Lishe Bora</title>
</head>
<body>

<div class="main">
<!--<div class="sidenav">-->
<!--<ul class="nav flex-column">-->
<!--    <li class="nav-item">-->
<!--        <a class="nav-link active" href="#">view users</a>-->
<!--    </li>-->
<!--    <li class="nav-item">-->
<!--        <a class="nav-link" href="#">add new user</a>-->
<!--    </li>-->
<!--    <li class="nav-item">-->
<!--        <a class="nav-link" href="#">add new formula</a>-->
<!--    </li>-->
<!---->
<!--    <li class="nav-item">-->
<!--        <a class="nav-item" href="#">add new raw material</a>-->
<!--    </li>-->
<!--    <li class="nav-item">-->
<!--        <a class="nav-item" href="#">view all materials</a>-->
<!--    </li>-->
<!--    <li class="nav-item">-->
<!--        <a class="nav-item" href="#">view all saved formulas</a>-->
<!--    </li>-->
<!---->
<!---->
<!--</ul>-->
<!--</div>-->
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
    require_once('db.php');
    $result = $db->prepare("SELECT * FROM register_user ORDER BY id ASC");
    $result->execute();
    for($i=0; $row = $result->fetch(); $i++){
        ?>
        <tr>
            <td><label><?php echo $row['id']; ?></label></td>
            <td><label><?php echo $row['username']; ?></label></td>
            <td><label><?php echo $row['email']; ?></label></td>
            <td>
                                <a href="update.php?id=<?php echo $row['id'];?>"
                                   class="btn btn-info">Edit</a>
                                <a href="delete.php?id=<?php echo $row['id'];?>"
                                   class="btn btn-danger">delete</a>
                            </td>


        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
</div>
</body>