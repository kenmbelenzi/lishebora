<?php
//
//if (isset( $_POST)) {
//    $user = 'root';
//    $pass = '';
//    $mysqli= new mysqli('localhost',"root",'','lishebora');
//    }

//
if (isset( $_POST)) {
    $user = 'root';
    $pass = '';
    $db = new PDO('mysql:host=localhost;dbname=lishebora', $user, $pass);
}
//$host = "localhost"; /* Host name */
//$user = "root"; /* User */
//$password = ""; /* Password */
//$dbname = "lishebora"; /* Database name */
//
//$con = mysqli_connect($host, $user, $password,$dbname);
//// Check connection
//if (!$con) {
//    die("Connection failed: " . mysqli_connect_error());
//}