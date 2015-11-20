<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 
?>

<!-- Javascript function here -->
<script type="text/javascript">
        $(".product-list").select2();
// Add new input field for the receipt
next = 1;
wrapper = $("#receipt-product-list");

function add_more(button_id){
        // generate new field
        var product = '<td><select name="product'+next+'" class="product-list"></select></td>';
        var price  = '<td><p name="product'+next+'_price" class="product-price">Product Price</p></td>';
        var quantity = '<td><input name="product'+next+'_quantity" type="number" min="0" placeholder="Số lượng"></td>';
        var total = '<td><p name="product'+next+'_total" class="total-price">Total price</p></td>';
        var button = '<td><button id="add'+next+'" class="btn btn-success btn-add" type="button" onclick="add_more(\'add'+next+'\')"><span class="glyphicon glyphicon-plus"></span></button></td>';
        var row = '<tr id="receipt-row'+(next + 1)+'" class="receipt-row">' + autoInc + product + price + quantity + total + button + '</tr>';
        $(wrapper).append(row);

        $("#"+button_id).replaceWith('<td><button class="btn btn-danger btn-add" type="button" onclick="row_delete(\'receipt-row'+next+'\')"><span class="glyphicon glyphicon-minus"></span></button></td>');
        next++;
    }
    function row_delete(row_id){
     $("#"+row_id).remove();
 }
 </script>

 <!-- PHP function here -->
 <?php 
// Alter print div upon submition succesful
 function make_print_section(){

 }


 ?>