<?php
include('../database/db.php');
$formulaname='ken';

$query = "SELECT * FROM formulations WHERE formulaname = :formulaname";
$statement = $db->prepare($query);
$result=$statement->execute([':formulaname'=>$formulaname]);
if($result){
    while ($row = $result->){
        echo $row['ingredient'];
        echo $row['price'];
    }
}

//$row=$result->rowCount();
//$result= array();
// for ($i=0;$i<$row;$i++){
//
//    $fp = fopen('studRecords.json', 'w');
//    //fwrite($fp, json_encode($data_array));
//
//    if (!fwrite($fp, json_encode($result))) {
//        die('Error : File Not Opened. ' . mysql_error());
//    } else {
//        echo "Data Retrieved Successully!!!";
//    }
//    fclose($fp);
//}

