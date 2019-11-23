<?php
if(isset($_POST)) {
  $formulaname=json_encode($_POST['formulation']);



    $con = mysqli_connect("localhost", "root", "", "lishebora");
    /* Check connection */
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }else{
            $sql = "INSERT INTO save (formulation)
VALUES
('$formulaname')";
            if (!mysqli_query($con, $sql)) {
                die('Error: ' . mysqli_error($con));
            }
        }

    Print  "Data added Successfully !";
    mysqli_close($con);
}

?>