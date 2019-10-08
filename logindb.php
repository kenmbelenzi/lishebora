<?php
include ('db.php');
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
    $row=$statement->fetch(PDO::FETCH_ASSOC);
    if($count == 1) {
//        $role=$row['Role'];
//        switch ($role){
//            case 'Admin':
//                header( "Location:../src/Admin.php");
//
//                break;
//            case 'Nurse':
//                header( "Location:../src/Index.php");
//
//
//                break;
//            case 'donor':
//                echo 'donor';
//                break;
//
//        }
        $update=$db->query("update register_user set verified= 1 WHERE vkey='$vkey'");
        $statement= $db->prepare($query);
        $statement->execute(
            array(
                'vkey' => $vkey
        )
        );
        echo "login success";

    }

    else{
        $error = "username/password incorrect please <a href='../src/Login.php'>login again</a>";
        $_SESSION["$error"] = $error;
        echo $error;

    }
}


