<?php
include "config.php";

$request = $_POST['request'];   // request

// Get username list
if($request == 1){
    $search = $_POST['search'];

    $query = "SELECT * FROM raw_materials WHERE raw_materials.ingredient like'%".$search."%'";
    $result = mysqli_query($con,$query);

    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['id'],"label"=>$row['ingredient']);
    }

    // encoding array to json format
    echo json_encode($response);
    exit;
}

// Get details
if($request == 2){
    $userid = $_POST['userid'];
    $sql = "SELECT * FROM raw_materials WHERE id=".$userid;

    $result = mysqli_query($con,$sql);

    $users_arr = array();

    while( $row = mysqli_fetch_array($result) ){
        $userid = $row['id'];
        $fullname = $row['ingredient'];
        $email = $row['price'];


        $users_arr[] = array("id" => $userid, "ingredient" => $fullname,"price" => $email);
    }

    // encoding array to json format
    echo json_encode($users_arr);
    exit;
}
