<?require 'db.php'?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Lishe Bora</title>
</head>
<body>

<?php require_once 'database.php';?>

<?php
if(isset($_SESSION['message']))?>
<div class="alert alert-<?=$_SESSION['msg_type']?>">


    <?php
    echo $_SESSION['message'];
    unset ($_SESSION ['message']);
    ?>
</div>
<?php //endif ?>
<div class="darkcontainer">
<?php
include 'db.php';
$mysqli= new mysqli('localhost',"root",'','lishebora');
$result= $mysqli ->query("select * from register_user");
//pre_r($result);
?>
<div class="row justify-content-center">
    <table class="table">
        <thead>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th colspan="2">Action</th>
        </tr>
        </thead>
        <?php
        while ($row=$result->fetch_assoc()):
        ?>
        <tr>
            <td><?php echo $row ['username'];?></td>
            <td><?php echo $row ['useremail'];?></td>
            <td>
                <a href="adminindex.php?edit=<?php echo $row['id'];?>"
                   class="btn btn-info">Edit</a>
                <a href="adminindex.php?delete=<?php echo $row['id'];?>"
                   class="btn btn danger">delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>
<?php
pre_r($result->fetch_assoc());

function pre_r($array){
    echo '<pre>';
    print_r($array);
    echo '</pre';
}
?>
<div class="row justify-content-center">
  <form action="database.php" method="post">
<input type="hidden" name="id" value="<?php echo $id ?>">

    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" value="<?php echo $name?>" name="name" id="name" placeholder="Input your name">
    </div>
    <div class="form-group">
        <label for="location">Email</label>
        <input type="text" class="form-control" value="<?php  ?>" name="useremail" id="location" placeholder="Input your email">
    </div>

      <div class="form-group">
          <?php
          if ($update == true):
          ?>
          <button type="submit" name="update" class="btn btn-primary">update</button>
          <?php
          else:
          ?>
<div class="form-group">
          <button type="submit" name="save" class="btn btn-primary">Save</button>
</div>
          <?php
          endif
          ?>

      </div>






</form>
</div>
</div>
</body>