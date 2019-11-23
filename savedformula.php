<?php


session_start();
if(isset($_SESSION["name"])) {
    $role = $_SESSION["role"];
    if (strcmp($role, 'admin') == 0) {
        include 'adminsidenav.php';
    } else {
        include 'farmersidenav.php';
    }
}
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

<form action="../lishebora/showformulation/show.php" method="post">
<td><select id="formulaname" name="formulaname" class="form-control formula"><option name="formulaname"value="">Select formula</option><?php echo fill_unit_select_box($connect); ?></select></td>


    <button class=""> submit </button>
</form>