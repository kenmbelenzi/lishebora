<?php
include('db.php');
$form = $_POST;
$id=$form['id'];
$username = $form['username'];
$email = $form['email'];
$vkey=$form['vkey'];

$sql = "update register_user SET username=:username,email=:email,vkey=:vkey WHERE id=$id";
$query = $db->prepare($sql);
$result = $query->execute(array(':username' => $username, ':email' => $email, ':vkey' => $vkey));
if ($result) {
    echo "success";
    header("Location:../adminindex.php");
}
else{
    echo"error";
}
;
