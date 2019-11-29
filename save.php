    <?php
    if(isset($_POST)) {
    //    $formulaname = json_decode($_POST['formulaname']);
        $ingredientArr = json_decode($_POST["ingredient"]);
        $proteinArr = json_decode($_POST["protein"]);
        $meArr = json_decode($_POST["me"]);
        $caArr = json_decode($_POST["ca"]);
        $lysineArr = json_decode($_POST["lysine"]);
        $priceArr = json_decode($_POST["price"]);
        $fatArr = json_decode($_POST["fat"]);
        $methionineArr = json_decode($_POST["methionine"]);
        $fiberArr = json_decode($_POST['fiber']);
        $phosphorousArr= json_decode($_POST["phosphorous"]);

        $con = mysqli_connect("localhost", "root", "", "lishebora");
        /* Check connection */
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        for ($i = 0; $i < count($ingredientArr); $i++) {

            if (($ingredientArr[$i] != "")) {   /* not allowing empty values and the row which has been removed. */
                $sql = "INSERT INTO raw_materials (ingredient,protein,me,calcium,lysine,price,fat,methionine,fiber,phosphorous)
    VALUES
    ('$ingredientArr[$i]','$proteinArr[$i]','$meArr[$i]','$caArr[$i]','$lysineArr[$i]','$priceArr[$i]','$fatArr[$i]',
    '$methionineArr[$i]','$fiberArr[$i]','$phosphorousArr[$i]')";
                if (!mysqli_query($con, $sql)) {
                    die('Error: ' . mysqli_error($con));
                }
            }
        }
        Print  "Data added Successfully !";
        mysqli_close($con);
    }
    ?>