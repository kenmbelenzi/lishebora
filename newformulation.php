<!DOCTYPE html>
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
    $query = "SELECT * FROM raw_materials ORDER BY ingredient ASC";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output .= '<option value="'.$row["ingredient"].'">'.$row["ingredient"].'</option>';
    }
    return $output;
}




?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<form id="form1" name="form1" method="post" action="saveFormulation.php">

    <div class="form-group">
        <label for="formulaname">formulaname</label>
        <input type="text" name="formulaname" class="form-control" id="formulaname">
    </div>

    <div class="form-group">
        <label for="ingredient">ingredient</label>
      <select id="ingredient" name="ingredient"<option id="ingredient" name="ingredient" value="">Select Unit</option><?php echo fill_unit_select_box($connect); ?></select>
    </div>
    <div class="form-group">
        <label for="quantity">quantity</label>
        <input type="text" name="quantity" class="form-control" id="quantity">
    </div>
    <div class="form-group">
        <label for="price">price</label>
        <input type="text" name="price" class="form-control" id="price">
    </div>
    <input type="button" name="send" class="btn btn-primary" value="add data" id="butsend">
    <input type="submit" name="save" class="btn btn-primary" value="Save to database" id="butsave">
</form>

<table id="table1" name="table1" class="table table-bordered">
    <tbody>

    <tr>
        <th>ID</th>
        <th>Ingredient</th>
        <th>Quantity</th>
        <th>Price (per kg)</th>

    <th hidden>Formulaname</th>
        <th>Action</th>


    <tr>

    </tbody>
</table>
<script>
    $(document).ready(function() {
        var id = 1;
        /* Assigning id and class for tr and td tags for separation. */

        $("#butsend").click(function() {
            var newid = id++;
            $("#table1").append('<tr valign="top" id="'+newid+'">\n\
            <td width="100px" >' + newid + '</td>\n\
            <td width="100px" class="ingredient'+newid+'">' + $("#ingredient").val() + '</td>\n\
            <td width="100px" class="quantity'+newid+'">' + $("#quantity").val() + '</td>\n\
            <td width="100px" class="price'+newid+'">' + $("#price").val() + '</td>\n\
            <td hidden width="100px" class="formulaname'+newid+'">' + $("#formulaname").val() + '</td>\n\
            <td width="100px"><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\
        </tr>');

        });

        var serializedData = $('#form1').serialize();

        $.ajax({
            url: "saveFormulation.php",
            type: "post",
            data: serializedData
        });

        $("#table1").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
        });

        /* crating new click event for save button*/

        $("#butsave").click(function() {
            var lastRowId = $('#table1 tr:last').attr("id"); /* finds id of the last row inside table */


            var ingredient = new Array();
            var quantity = new Array();
            var price=new Array();
            var formulaname = new Array();
            for ( var i = 1; i <= lastRowId; i++) {
                ingredient.push($("#"+i+" .ingredient"+i).html());  /* pushing all the names listed in the table */
                quantity.push($("#"+i+" .quantity"+i).html());   /* pushing all the ages listed in the table */
                price.push($("#"+i+" .price"+i).html());  /* pushing all the price s listed in the table */
                formulaname.push($("#"+i+" .formulaname"+i).html())

            }
            var sendIngredient = JSON.stringify(ingredient);
            var sendQuantity = JSON.stringify(quantity);
            var sendPrice=JSON.stringify(price);
            var sendFormulaname=JSON.stringify(formulaname);




            $.ajax({
                url: "saveFormulation.php",
                type: "post",
                data: {ingredient : sendIngredient , quantity : sendQuantity , price : sendPrice ,formulaname : sendFormulaname},
                success : function(data){
                    alert(data);    /* alerts the response from php. */

                }
            });
        });
    });
</script>
</body>
</html>