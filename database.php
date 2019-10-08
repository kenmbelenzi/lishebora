<?php
session_start();
include ('db.php');

$username='';
$location='';
$update='false';
$id=0;
if (isset($_POST['save'])){
    $username = $_POST ['username'];
    $location = $_POST['useremail'];



    $mysqli -> query ("insert into data (name, location) VALUES ('$name','$location')") or die($mysqli->error);
    $_SESSION['message']='record saved';
    $_SESSION['msg_type'] = 'success';

    header('location:adminindex.php');
}

if (isset($_GET['delete'])){

    $id = $_GET['delete'];
    $mysqli->query("delete from register_user WHERE id=$id") or die($mysqli->error);
    $_SESSION['message']='record deleted';
    $_SESSION['msg_type'] = 'danger';
}

if (isset($_GET['edit'])){
    $id =$_GET['edit'];
    $result=$mysqli->query("Select* from register_user where id=$id") or die($mysqli->error);

    if(count($result)==1){
        $row=$result->fetch_array();
        $name=$row['username'];
        $location=$row['useremail'];
    }
}

if (isset($_POST['update'])){

    $id=$_POST['id'];
    $name = $_POST['username'];
    $location =$_POST['useremail'];
    $mysqli->query("update data set name='$name', location='$location' where id=$id") or die($mysqli->error);
    $_SESSION['message'] = 'record updated';
    $_SESSION ['msg_type']='warning';

    header('location:adminindex.php');
}