<?php
session_start();
include('db.php');
if (isset($_POST)){
    $form = $_GET;

    $username = $form['username'];
    $Password = $form['password'];
    $vkey = $form['vkey'];


    $query = "SELECT * FROM register_user WHERE username = :username AND Password = :password AND vkey= :vkey";
    $statement= $db->prepare($query);
    $statement->execute(
        array(
            'username' => $username,
            'password' => $Password,
            'vkey' =>$vkey
        )
    );

    $count= $statement->rowCount();

    if($count >0) {
        $count= $statement->rowCount();
        $row=$statement->fetch(PDO::FETCH_ASSOC);
        if($count == 1) {
            $role = $row['role'];
            switch ($role) {
                case 'admin':
                    header("Location:../adminindex.php");

                    break;
                case 'farmer':
                    header("Location:../farmer.php");


                    break;
                case 'donor':
                    echo 'donor';
                    break;

            }
        }
        echo "success";

        $query="update register_user set verified = '1' WHERE username = :username AND Password = :password AND vkey= :vkey";
        $statement= $db->prepare($query);
        $statement->execute(
            array(
                'username' => $username,
                'password' => $Password,
                'vkey' =>$vkey
            )
        );



        $_SESSION["name"] = $username;

//        header("Location:farmer.php");

    }

    else{
        $error = "username/password incorrect please <a href='../Verificationlogin.php'>login again</a>";
        $_SESSION["$error"] = $error;
        echo $error;

    }
}


