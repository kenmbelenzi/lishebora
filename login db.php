<?php
session_start();
$user = 'root';
$pass = '';
$db = new PDO('mysql:host=localhost;dbname=lishebora', $user, $pass);
if (isset($_POST)){
    $form = $_GET;

    $Email = $form['Email'];
    $Password = $form['Password'];


    $query = "SELECT Role FROM users WHERE Email = :Email AND Password = :Password";
    $statement= $db->prepare($query);
    $statement->execute(
        array(
            'Email' => $Email,
            'Password' => $Password
        )
    );

    $count= $statement->rowCount();
    $row=$statement->fetch(PDO::FETCH_ASSOC);
    if($count == 1) {
        $role=$row['Role'];
        switch ($role){
            case 'Admin':
                header( "Location:../src/Admin.php");

                break;
            case 'Nurse':
                header( "Location:../src/Index.php");


                break;
            case 'donor':
                echo 'donor';
                break;

        }

    }

    else{
        $error = "username/password incorrect please <a href='../src/Login.php'>login again</a>";
        $_SESSION["$error"] = $error;
        echo $error;

    }
}


