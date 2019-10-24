<?php
include('db.php');
include('register.php');
if (isset($_GET['vkey'])){
//    process verification
    $vkey=$_GET['vkey'];

    $resultSet = $db->query("select verified,vkey from register_user WHERE verified=0 AND vkey='$vkey' LIMIT 1");
if ($resultSet){
    //validate email
    $update=$db->query("update register_user set verified= 1 WHERE vkey='$vkey' LIMIT 1");
    if($update){
        echo"veri success";
    }
    else{
        echo $db->errorInfo();
    }
}
else{
    echo"invalid";
}
}else{
    die('dead');
}