<?php
//insert.php;

$ingredient=$_POST['item_name'];
$quantity=$_POST['quantity'];
$price = $_POST['price'];



    $connect = new PDO("mysql:host=localhost;dbname=lishebora", "root", "");


    foreach ($ingredient as $_row) {

        $ingredient = $_row['item_name'];
        $quantity = $_row['quantity'];
        $price = $_row['price'];

echo $ingredient;
    }

//        $query = "INSERT INTO formulations
//(ingredient, quantity, price)
//VALUES (:ingredient, :quantity, :price)";
//        $statement= $connect->prepare($query);
//
//        $statement->execute(
//            array(
//
//                ':ingredient'  =>  $ingredient,
//                ':quantity' => $quantity,
//                ':price'  => $price
//            )
//        );
//        $result = $statement->fetchAll();
//        if(isset($result)) {
//            echo 'ok';
//
//
//        }
//
//
//        }
