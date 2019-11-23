<?php
//
//if (isset( $_POST)) {
//    $user = 'root';
//    $pass = '';
//    $mysqli= new mysqli('localhost',"root",'','lishebora');
//    }


if (isset( $_POST)) {
    $user = "root";
    $pass = "";
    $db = new PDO("mysql:host=localhost;dbname=lishebora", $user, $pass);
}
