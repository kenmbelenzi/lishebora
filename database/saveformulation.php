<?php
//insert.php;

$ingredient=$_POST['item_name'];
$quantity=$_POST['quantity'];
$price = $_POST['price'];



    $connect = new PDO("mysql:host=localhost;dbname=lishebora", "root", "");


    foreach ($ingredient as $row){
        $ingredient = json_encode( $ingredient);
        $quantity=json_encode($quantity);
        $price=json_encode($price);






        }
$query = "INSERT INTO formulations
(ingredient, quantity, price)
VALUES (:ingredient, :quantity, :price)";
$statement= $connect->prepare($query);

$statement->execute(
    array(

        ':ingredient'  =>  $ingredient,
        ':quantity' => $quantity,
        ':price'  => $price
    )
);
    $result = $statement->fetchAll();
    if(isset($result)) {
        echo 'ok';


    }
