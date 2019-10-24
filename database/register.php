<?php
include('db.php');
//
//$form=$_POST;
//$FirstName=$form['FirstName'];
//$MiddleName=$form['MiddleName'];
//$LastName=$form['LastName'];
//$Password=$form['RepeatPassword'];
//$Email=$form['Email'];
//$Role=$form['Role'];
//
//$sql="insert into users (FirstName, MiddleName, LastName, Email, Password, Role) VALUES (:FirstName,:MiddleName,:LastName,:Email,:Password,:Role)";
//$query =$db->prepare($sql);
//$result = $query->execute(array(':FirstName'=>$FirstName,':MiddleName'=>$MiddleName,':LastName'=>$LastName,':Email'=>$Email,':Password'=>$Password,':Role'=>$Role));
//if ($result){
//    echo "Registration Complete";
//
//
//}else{
//    echo"Failed to register";



//if (isset( $_POST)) {
//    $user = 'root';
//    $pass = '';
//    $db = new PDO('mysql:host=localhost;dbname=lishebora', $user, $pass);
//}

    $form=$_POST;
    $username=$_POST['username'];
    $password=$_POST['password'];
    $p2=$_POST['p2'];
    $email=$_POST['email'];
//$form=$_POST;
//$username="ken";
//$password="mbaya";
//$p2="mbaya";
//$email="kenmbelenzi@gmail.com";

    if($p2 != $password){
        $error ="your passwords don't match";
        echo "$error";
    }
    else {
        //gen v key
        $vkey = md5(time() . $username);

        //check if username is taken
        $query = "SELECT * FROM register_user WHERE username = :username ";
        $statement = $db->prepare($query);
        $statement->execute(
            array(
                'username' => $username

            )
        );

        $count = $statement->rowCount();

        if ($count > 0) {
            echo "username is already taken choose another one";


        } else {


            $sql = "INSERT INTO register_user (username, password, email, vkey) VALUES (:username,:password,:email,:vkey)";
            $query = $db->prepare($sql);
            $result = $query->execute(array(':username' => $username, ':password' => $password, ':email' => $email, ':vkey' => $vkey));
            if ($result) {
                echo "registration success";
                //sendingemail
                $to = $email;
                $subject = "email verification";
                $message = "kindly use the following key to register your account $vkey";
                $headers = "from:kenmbelenzi@gmail.com \r\n";
                $headers .= "MIME-Version: 1.0" . "r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "r\n";

                mail("$to", "$subject", "$message", "$headers");

                header("Location:../Verificationlogin.php");

                echo "sent";

            } else {
                echo "registration failed";
            }
        }
    }


