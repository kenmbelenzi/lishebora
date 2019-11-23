<?php
if(isset($_POST)) {
    $formulaname=$_POST["formulaname"];
    $formulanameArr = json_decode($_POST["formulaname"]);
    $ingredientArr = json_decode($_POST["ingredient"]);
    $quantityArr = json_decode($_POST["quantity"]);

    $priceArr = json_decode($_POST["price"]);

    $con = mysqli_connect("localhost", "root", "", "lishebora");
    /* Check connection */
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    for ($i = 0; $i < count($ingredientArr); $i++) {

        if (($ingredientArr[$i] != "")) {   /* not allowing empty values and the row which has been removed. */
            $sql = "INSERT INTO formulations (ingredient,quantity,price,formulaname)
    VALUES
    ('$ingredientArr[$i]','$quantityArr[$i]','$priceArr[$i]','$formulanameArr[$i]')";
            if (!mysqli_query($con, $sql)) {
                die('Error: ' . mysqli_error($con));
            }
        }
    }
    Print  "Data added Successfully";


    header("location:/lishebora/simplex/test.php");

    mysqli_close($con);
}
?>