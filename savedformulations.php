<?php
include 'database/db.php';
$form=$_POST;
$k=$form['formula'];

$result = $db->prepare("SELECT * FROM formulations where formulaname = :k");


$result->execute(
    array(
        'k' => $k

    )
);
$count = $result->rowCount();

if ($count > 0) {

//    for ($i = 0;
         $row = $result->fetch();
//         $i++) {

        $row1 = json_decode($row['ingredient']);
        $row2 = json_decode($row['quantity']);
        $row3 = json_decode($row['price']);


        ?>
        <tr>
        <td><label><p>ingredients</p<?php echo print_r($row1); ?> ></label></td>

        <br>
        <br>
        <td><label><p>quantity</p><?php echo print_r($row2); ?></label></td>

        <br>
        <br>
        <td><label><p>price</p> <?php echo print_r($row3); ?></label></td>
        <td>


        <?php
//    }
}
?>