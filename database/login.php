<?php
session_start();
include('db.php');
if (isset($_POST)){
    $form = $_GET;

    $username = $form['username'];
    $Password = $form['password'];



    $query = "SELECT * FROM register_user WHERE username = :username AND Password = :password";
    $statement= $db->prepare($query);
    $statement->execute(
        array(
            'username' => $username,
            'password' => $Password,

        )
    );

    $count= $statement->rowCount();

    if($count >0) {
        $count= $statement->rowCount();
        $row=$statement->fetch(PDO::FETCH_ASSOC);
        if($count == 1) {
            $verification = $row['verified'];
            $role = $row['role'];
            if ($verification ==1) {

                        header("Location:../adminindex.php");
                $_SESSION["role"] = $role;

                }
            }
            else{
                $error = "account not verified please enter the verification code that was sent to your email and <a href='../Verificationlogin.php'>login again</a>";

                echo $error;
            }
        }


//        $query="update register_user set verified = '1' WHERE username = :username AND Password = :password AND vkey= :vkey";
//        $statement= $db->prepare($query);
//        $statement->execute(
//            array(
//                'username' => $username,
//                'password' => $Password,
//                'vkey' =>$vkey
//            )
//        );
//


        $_SESSION["name"] = $username;


//        header("Location:farmer.php");

    }

    else{
        $error = "username/password incorrect please <a href='../Verificationlogin.php'>login again</a>";
        $_SESSION["$error"] = $error;
        echo $error;

    }



