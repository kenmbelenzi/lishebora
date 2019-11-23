<!DOCTYPE html>
<?php
//index.php

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
//        $output2 .= '<option value="'.$row["recepie"].'">'.$row["recepie"].'</option>';
    }
    return $output;
    //    return $output2;
}

include 'adminsidenav.php'
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/simple-sidebar.css" rel="stylesheet">


</head>

<body>


<!-- Page Content -->
<div id="page-content-wrapper">

    <form>
        <div class="container">
            <div class="table-responsive">
                <table id="purchaseItems" name="purchaseItems" align="center" class="table table-bordered">
                    <tr>
                        <th class="id">id</th>
                        <th>Raw material</th>
                        <th>Quantity</th>
                        <th>Price per kg </th>
                        <th>Total price </th>
                    </tr>
                    <tr>
                        <td class="ids"></td>

                        <td><input type='text' class='ingredient' id='ingredient' placeholder='Enter ingredient'></td>


                        <td>
                            <input id="quantity" type="text" name="quantity" class="next" required />
                        </td>
                        <td>
                            <input id="price" type="text" name="price" class="next" x-placement="" />
                        </td>
                        <td>
                            <input type="text" name="amount" class="next last" required />
                        </td>
                        <td>
                            <input type="button" name="addRow" class="add btn btn-success btn-sm add glyphicon glyphicon-plus" value='+' />
                        </td>
                        <td>
                            <input type="button" name="addRow" class="removeRow btn btn-danger btn-sm remove glyphicon glyphicon-minus" value='-' />
                        </td>
                    </tr>
                    <tr>
                        <th>Total :</th>
                        <td colspan='2' id="totalPrice"></td>
                    </tr>
                </table>
                <div align="center">
                    <input type="submit" id="submit" class="btn btn-info" value="Insert"  >
                    <p id="info"></p>
                </div>
            </div>
        </div>
    </form>

    <script>

        $(document).ready(function() {
            $(document).on('keydown', '.username', function() {

                var id = this.id;
                var splitid = id.split('_');
                var index = splitid[1];

                $( '#'+id ).autocomplete({
                    source: function( request, response ) {
                        $.ajax({
                            url: "getDetails.php",
                            type: 'post',
                            dataType: "json",
                            data: {
                                search: request.term,request:1
                            },
                            success: function( data ) {
                                response( data );
                            }
                        });
                    },
                    select: function (event, ui) {
                        $(this).val(ui.item.label); // display the selected text
                        var userid = ui.item.value; // selected id to input

                        // AJAX
                        $.ajax({
                            url: 'getDetails.php',
                            type: 'post',
                            data: {userid:userid,request:2},
                            dataType: 'json',
                            success:function(response){

                                var len = response.length;

                                if(len > 0){
                                    var id = response[0]['id'];
                                    var name = response[0]['ingredient'];
                                    var email = response[0]['price'];

                                    document.getElementById('quantity'+index).value = name;

                                    document.getElementById('price'+index).value = email;


                                }

                            }
                        });

                        return false;
                    }
                });
            });


            $(document).on('click', '#purchaseItems .add', function() {
                var id= 1;
                var newid = id++;
                var row = $(this).parents('tr');
                var clone = row.clone();

                // clear the values
                var tr = clone.closest('tr');
                tr.find('input[type=text]').val('');


                $(this).closest('tr').after(clone);
                var total = 0;
                $(".last").each(function() {
                    if (!$(this).val() == '') {
                        total = total + parseFloat($(this).val());
                    }
                });
                $("#totalPrice").html("$" + total);

            });
            $(document).on("blur", ".last", function() {
                var total = 0;
                $(".last").each(function() {
                    if (!$(this).val() == '') {
                        total = total + parseFloat($(this).val());
                    }
                })
                $("#totalPrice").html("$" + total);
            });
            $(document).on('focus', ".last", function() {
                var $qty = $(this).parents("tr").find("input[name^='quantity']");
                var $pr = $(this).parents("tr").find("input[name^='price']");
                var $amnt = $(this).parents("tr").find("input[name^='amount']");
                var a = 0;
                if ($qty.val() == '' || $pr.val() == '') {
                    console.log("No values found.");
                    return false;
                } else {
                    console.log("Converting: ", $qty.val(), $pr.val());
                    var q = parseInt($qty.val());
                    var p = parseFloat($pr.val());
                    console.log("Values found: ", q, p);
                }
                a = q * p;
                $amnt.val(Math.round(a * 100) / 100);
            });
            $(document).on('click', '#purchaseItems .removeRow', function() {
                if ($('#purchaseItems .add').length > 1) {
                    $(this).closest('tr').remove();
                }
            });
            $("#submit").click(function() {

                var lastRowId = $('#purchaseItems tr:last').attr("id"); /* finds id of the last row inside table */


                var ingredient = new Array();
                var quantity = new Array();

                var total=new Array();

                var price=new Array();
                for ( var i = 1; i <= lastRowId; i++) {
                    ingredient.push($("#"+i+" .ingredient"+i).html());  /* pushing all the names listed in the table */
                    quantity.push($("#"+i+" .quantity"+i).html());   /* pushing all the ages listed in the table */
                    price.push($("#"+i+" .price"+i).html());  /* pushing all the me listed in the table */
                    tota.push($("#"+i+" .total"+i).html());  /* pushing all the price s listed in the table */

                }
                var sendIngredient = JSON.stringify(ingredient);
                var sendPrice=JSON.stringify(price);
                var sendTotal = JSON.stringify(total);


                console.log('sucess');

                $.ajax({
                    url: "saveFormulation.php",
                    type: "post",
                    data: {ingredient : sendIngredient , price : sendPrice },
                    success : function(data){
                        alert(data);    /* alerts the response from php. */
                    }
                });
            });
        });






    </script>


</div>
<!-- /#page-content-wrapper -->

</div>
<!-- /#wrapper -->

<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

</body>

</html>
