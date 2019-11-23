<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION["name"])) {
    $role = $_SESSION["role"];
    if (strcmp($role, 'admin') == 0) {
        include '../adminsidenav.php';
    } else {
        include '../farmersidenav.php';
    }
}
?>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.css">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>Lishe Bora</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">



    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/simple-sidebar.css" rel="stylesheet">

</head>
<div class="container">
    <table class="table table-dark">
        <thead>
        <tr>

            <th>Ingredient</th>
            <th>Quantity</th>


        </tr>
        </thead>
        <tbody>
        <?php
        require_once'db.php';
        if (isset($_POST)){
        $form = $_POST;

        $formulaname = $form['formulaname'];

        $result = $db->prepare("SELECT * FROM formulations WHERE formulaname=:formulaname");
        $result->execute([':formulaname' => $formulaname]);
        for ($i = 0; $row = $result->fetch(); $i++) {
            ?>
            <tr>
                <td><label><?php echo $row['ingredient']; ?></label></td>
                <td><label><?php echo $row['quantity']; ?></label></td>


            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>
<?php
include_once 'db.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
$formulaname = $form['formulaname'];

$query = $db->prepare("SELECT * FROM formulations WHERE formulaname=:formulaname");

$query->execute([':formulaname' => $formulaname]);
$count = $query->rowCount();

while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
    $ingredient = $row['ingredient'];
    $quantity = $row['quantity'];


    $newquery = $db->prepare("SELECT * FROM raw_materials WHERE ingredient=:ingredient");
    $newquery->execute([':ingredient' => $ingredient]);

    while ($newrow = $newquery->fetch(PDO::FETCH_ASSOC)) {
        //calculate protein level
        $protein = $newrow['protein'];
        $feedprotein = $quantity * $protein + $feedprotein;

        //calculate calcium level
        $calcium = $newrow['calcium'];
        $feedcalcium = $quantity * $calcium + $feedcalcium;

        //calculate me level
        $me = $newrow['me'];
        $feedme = $quantity * $me + $feedme;

        //calculate lysine level
        $lysine = $newrow['lysine'];
        $feedlysine = $quantity * $lysine + $feedlysine;


    }
}

$query = $db->prepare("SELECT sum(quantity) FROM formulations WHERE formulaname=:formulaname");
$query->execute([':formulaname' => $formulaname]);
$result = $query->fetchAll();
foreach ($result as $item) {
    $feedquantity = $item['sum(quantity)'];
}
echo "feedprotein " . $feedprotein . '<br>';
echo "calcium level " . $feedcalcium . '<br>';
echo "Metabolize Energy " . $feedme . '<br>';
echo "Lysine level " . $feedlysine . '<br>';
echo "Total Quantity " . $feedquantity . '<br>';
}

else{
            echo "error";
}






