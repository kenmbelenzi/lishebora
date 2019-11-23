    <?php
    if(isset($_POST)) {
    //    $formulaname = json_decode($_POST['formulaname']);
        $ingredientArr = json_decode($_POST["ingredient"]);
        $proteinArr = json_decode($_POST["protein"]);
        $meArr = json_decode($_POST["me"]);
        $caArr = json_decode($_POST["ca"]);
        $lysineArr = json_decode($_POST["lysine"]);
        $priceArr = json_decode($_POST["price"]);

        $con = mysqli_connect("localhost", "root", "", "lishebora");
        /* Check connection */
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        for ($i = 0; $i < count($ingredientArr); $i++) {

            if (($ingredientArr[$i] != "")) {   /* not allowing empty values and the row which has been removed. */
                $sql = "INSERT INTO raw_materials (ingredient,protein,me,calcium,lysine,price)
    VALUES
    ('$ingredientArr[$i]','$proteinArr[$i]','$meArr[$i]','$caArr[$i]','$lysineArr[$i]','$priceArr[$i]')";
                if (!mysqli_query($con, $sql)) {
                    die('Error: ' . mysqli_error($con));
                }
            }
        }
        Print  "Data added Successfully !";
        mysqli_close($con);
    }
    ?>