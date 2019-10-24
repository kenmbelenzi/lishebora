<?php


$connect = new PDO("mysql:host=localhost;dbname=lishebora", "root", "");
function fill_unit_select_box($connect)
{
    $output = '';
    $query = "SELECT * FROM formulations ORDER BY formulaname ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output .= '<option value="'.$row["formulaname"].'">'.$row["formulaname"].'</option>';
    }
    return $output;
}

?>

<form action="savedformulations.php" method="post">
<!--<td><select id="formula" name="item_unit[] formula" class="form-control formula"><option value="">Select formula</option>--><?php //echo fill_unit_select_box($connect); ?><!--</select></td>-->
    <input class="text" type="text" name="formula" placeholder="Username" required="">

    <button class=""> submit </button>
</form>