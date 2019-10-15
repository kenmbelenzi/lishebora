<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/main.css">
</head>
<?php
//login_success.php
session_start();
include "adminsidenav.php";
?>
<div class="main">
    <?
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
</div>