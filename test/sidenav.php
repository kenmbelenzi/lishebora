<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Simple Sidebar - Start Bootstrap Template</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/simple-sidebar.css" rel="stylesheet">

</head>

<body>

<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
        <div class="sidebar-heading">Lishe Bora </div>
        <div class="list-group list-group-flush">
            <a href="#" class="list-group-item list-group-item-action bg-light">Create new formulation</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">Insert new raw materials</a>
            <a href="#" class="list-group-item list-group-item-action bg-light">View saved formulations</a>

        </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">


        <div class="container">
            <div class="table-responsive">
                <table id="purchaseItems" name="purchaseItems" align="center" class="table table-bordered">
                    <tr>
                        <th>Raw material</th>
                        <th>Quantity</th>
                        <th>Price per kg </th>
                        <th>Total price ($)</th>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" name="rawmaterial[]" class="next" required />
                        </td>
                        <td>
                            <input type="text" name="quantity[]" class="next" required />
                        </td>
                        <td>
                            <input type="text" name="price[]" class="next" required />
                        </td>
                        <td>
                            <input type="text" name="amount[]" class="next last" required />
                        </td>
                        <td>
                            <input type="button" name="addRow[]" class="add btn btn-success btn-sm add glyphicon glyphicon-plus" value='+' />
                        </td>
                        <td>
                            <input type="button" name="addRow[]" class="removeRow btn btn-danger btn-sm remove glyphicon glyphicon-minus" value='-' />
                        </td>
                    </tr>
                    <tr>
                        <th>Total :</th>
                        <td colspan='2' id="totalPrice"></td>
                    </tr>
                </table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $(document).on('click', '#purchaseItems .add', function() {
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
                    })
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
