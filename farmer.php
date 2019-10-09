<?php
//login_success.php
session_start();
if(isset($_SESSION["name"]))
{
    echo '<h3>Login Success, Welcome - '.$_SESSION["name"].'</h3>';
    echo '<br /><br /><a href="logout.php">Logout</a>';
}
else
{
    echo"failed";
}
?>