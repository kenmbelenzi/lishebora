<?php
/**
 * Created by PhpStorm.
 * User: Ken
 * Date: 10/11/2019
 * Time: 3:16 PM
 */
//insert.php;

if(isset($_POST["ingredient"]))
{
    $connect = new PDO("mysql:host=localhost;dbname=lishebora", "root", "");
    $order_id = uniqid();
    for($count = 0; $count < count($_POST["ingredient"]); $count++)
    {
        $query = "INSERT INTO raw_materials 
  (ingredient) 
  VALUES (:ingredient)
  ";
        $statement = $connect->prepare($query);
        $statement->execute(
            array(
//                ':order_id'   => $order_id,
                ':ingredient'  => $_POST["ingredient"][$count],
//                ':item_quantity' => $_POST["item_quantity"][$count],
//                ':item_unit'  => $_POST["item_unit"][$count]
            )
        );
    }
    $result = $statement->fetchAll();
    if(isset($result))
    {
        echo 'ok';
    }
}
?>