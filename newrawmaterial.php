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


?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>

<form id="form1" name="form1" method="post" >

    <div class="form-group">
        <label for="email">ingredient</label>
        <input type="text" name="ingredient" class="form-control" id="ingredient">
    </div>
    <div class="form-group">
        <label for="protein">Protein Level</label>
        <input type="text" name="protein" class="form-control" id="protein">
    </div>
    <div class="form-group">
        <label for="me">Metabolize Energy</label>
        <input type="text" name="me" class="form-control" id="me">
    </div>
    <div class="form-group">
        <label for="ca">Calcium Level</label>
        <input type="text" name="ca" class="form-control" id="ca">
    </div>
    <div class="form-group">
        <label for="lysine">Lysine Level</label>
        <input type="text" name="lysine" class="form-control" id="lysine">
    </div>
    <div class="form-group">
        <label for="price">Price (per kg)</label>
        <input type="text" name="price" class="form-control" id="price">
    </div>
    <div class="form-group">
        <label for="fat">fat level</label>
        <input type="text" name="fat" class="form-control" id="fat">
    </div>
    <div class="form-group">
        <label for="methionine">methionine level</label>
        <input type="text" name="methionine" class="form-control" id="methionine">
    </div>
    <div class="form-group">
        <label for="fiber">Fiber Level</label>
        <input type="text" name="price" class="form-control" id="fiber">
    </div>
    <div class="form-group">
        <label for="phosphorous">Phosphorous level</label>
        <input type="text" name="phosphorous" class="form-control" id="phosphorous">
    </div>
    <input type="button" name="send" class="btn btn-primary" value="add data" id="butsend">
    <input type="submit" name="save" class="btn btn-primary" value="Save to database" id="butsave">
</form>

<table id="table1" name="table1" class="table table-bordered">
    <tbody>

    <tr>
        <th>ID</th>
        <th>Ingredient</th>
        <th>Protein Level</th>
        <th>Metabolize Energy</th>
        <th>Calcium Level</th>
        <th>Lysine level</th>
        <th>Price (per kg)</th>
        <th>Fat Level</th>
        <th>Methionine Level</th>
        <th>Fiber level</th>
        <th>Phosphorous Level</th>
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
            <td width="100px" class="protein'+newid+'">' + $("#protein").val() + '</td>\n\
            <td width="100px" class="me'+newid+'">' + $("#me").val() + '</td>\n\
            <td width="100px" class="ca'+newid+'">' + $("#ca").val() + '</td>\n\
            <td width="100px" class="lysine'+newid+'">' + $("#lysine").val() + '</td>\n\
            <td width="100px" class="price'+newid+'">' + $("#price").val() + '</td>\n\
            <td width="100px" class="fat'+newid+'">' + $("#fat").val() + '</td>\n\
            <td width="100px" class="methionine'+newid+'">' + $("#methionine").val() + '</td>\n\
            <td width="100px" class="fiber'+newid+'">' + $("#fiber").val() + '</td>\n\
            <td width="100px" class="phosphorous'+newid+'">' + $("#phosphorous").val() + '</td>\n\
            <td width="100px"><a href="javascript:void(0);" class="remCF">Remove</a></td>\n\
        </tr>');

        });

        var serializedData = $('#form1').serialize();

        $.ajax({
            url: "save.php",
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
            var protein = new Array();
            var me=new Array();
            var ca=new Array();
            var lysine=new Array();
            var price=new Array();
            var fat=new Array();
            var methionine=new Array();
            var fiber=new Array();
            var phosphorous = new Array();
            for ( var i = 1; i <= lastRowId; i++) {
                ingredient.push($("#"+i+" .ingredient"+i).html());  /* pushing all the names listed in the table */
                protein.push($("#"+i+" .protein"+i).html());   /* pushing all the ages listed in the table */
                me.push($("#"+i+" .me"+i).html());  /* pushing all the me listed in the table */
                ca.push($("#"+i+" .ca"+i).html());  /* pushing all the ca s listed in the table */
                lysine.push($("#"+i+" .lysine"+i).html());  /* pushing all the lysine s listed in the table */
                price.push($("#"+i+" .price"+i).html());  /* pushing all the price s listed in the table */
                fat.push($("#"+i+" .fat"+i).html());
                methionine.push($("#"+i+" .methionine"+i).html());
                fiber.push($("#"+i+" .fiber"+i).html());
                phosphorous.push($("#"+i+" .phosphorous"+i).html());

            }
            var sendIngredient = JSON.stringify(ingredient);
            var sendProtein = JSON.stringify(protein);
            var sendMe= JSON.stringify(me);
            var sendCa=JSON.stringify(ca);
            var sendLysine=JSON.stringify(lysine);
            var sendPrice=JSON.stringify(price);
            var sendFat=JSON.stringify(fat);
            var sendMethionine = JSON.stringify(methionine);
            var sendFiber = JSON.stringify(fiber);
            var sendPhosphorous= JSON.stringify(phosphorous);


            $.ajax({
                url: "save.php",
                type: "post",
                data: {ingredient : sendIngredient , protein : sendProtein , me : sendMe , ca : sendCa , lysine : sendLysine , price : sendPrice,
                fat : sendFat , methionine : sendMethionine , fiber : sendFiber,phosphorous : sendPhosphorous},
                success : function(data){
                    alert(data);    /* alerts the response from php. */
                }
            });
        });
    });
</script>
</body>
</html>