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

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<form>
    <table class="table table-bordered table-hover" id="driver">
        <thead>
        <tr>
            <th class="text-center text-info">
                #
            </th>
            <th class="text-center text-info">
                ingredient
            </th>
            <th class="text-center text-info">
                quantity
            </th>

            <th class="text-center text-info">
               price
            </th>
            <th class="text-center text-info">
                total price
            </th>
            <th class="text-center text-info">
                Action
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                1
            </td>
            <td>
                <input type="text" name='ingredient' placeholder='ingredient' class="form-control" />
            </td>
            <td>
                    <input type="text" name='quantity' placeholder='quantity' class="form-control" />
            </td>
            <td>
                <input type="text" name='price' placeholder='price' class="form-control" />
            </td>

            <td>
                <input type="text" name='total' placeholder='total' class="form-control" />
            </td>
            <td>
            <td>
                <input type="button" name="addRow" class="add btn btn-success btn-sm add glyphicon glyphicon-plus" value='+' />
            </td>
            <td>
                <input type="button" name="removeRow" class="removeRow btn btn-danger btn-sm remove glyphicon glyphicon-minus" value='-' />
            </td>
            </td>
        </tr>

        </tbody>
    </table>
    <input type="button" name="g" value="Submit" id="submit">
    <pre id="output"></pre>
</form>
<script>

    $(document).on('click', '#driver .add', function() {
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
    $(document).on('click', '#driver .removeRow', function() {
        if ($('#driver .add').length > 1) {
            $(this).closest('tr').remove();
        }
    });
    document.querySelector('#submit').addEventListener("click", (function(event) {
                var newFormData = [];
                jQuery('#driver tr:not(:first) ').each(function(i) {
                    var tb = jQuery(this);
                    var obj = {};
                    tb.find('input').each(function() {
                        obj[this.name] = this.value;
                    });
                    obj['row'] = i;
                    newFormData.push(obj);
                });
                console.log(newFormData);
                document.getElementById('output').innerHTML = JSON.stringify(newFormData);
                let savedata=JSON.stringify(newFormData);
                    $.ajax({
                        url: "db.php",
                        type: "post",
                        data: {formulation : savedata },
                        success : function(data){
                            alert(data);    /* alerts the response from php. */
                        }
                    });
                event.preventDefault();
            }));




</script>
