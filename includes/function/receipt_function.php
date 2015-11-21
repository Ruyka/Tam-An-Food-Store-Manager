<?php 
    require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 
    require_once(CLASS_PATH."AllClass.php");
    require_once(CLASS_PATH."Management.php");
?>

<!-- PHP function here -->
<?php 
// Alter print div upon submition succesful
function make_print_section(){

}

function get_receipt_data_from_server(){
        $manager = new Management();
        $data = $manager->get_list_of_product_info();
        $receipt = new Receipt();
        $receipt->get_data_from_array($data);
        return $receipt;
}

$data = get_receipt_data_from_server();
?>

<!-- Javascript function here -->
<script type="text/javascript">
// Fake data
test = <?php echo $data->json_encode(); ?> ;
alert(JSON.stringify(test));
product_list = ['ProductA','ProductB','ProductC'];
product_price = [10,15,20];
option_list = "";
for(var i in product_list){
    option_list = option_list + "<option value='"+i+"'>"+product_list[i]+"</option>";
}
$(".product-list").append(option_list);

// Add new input field for the receipt
next = 1;
wrapper = $("#receipt-product-list");
$(document).ready(function(){
    $(".product-list").select2();
    $("#product_price").html(product_price[0]);
    observe_change('');
    $("#receipt-form").submit(function(e) {
        e.preventDefault();
    });
});

function add_more(id){
    // generate new row
    var product = '<td><select id="product'+next+'" name="product'+next+'" onchange="observe_change('+next+')" id="select2-product'+next+'-list" class="product-list">'+option_list+'</select></td>';
    var price  = '<td><p id="product'+next+'_price" class="product-price form-control">Product Price</p></td>';
    var quantity = '<td><input id="product'+next+'_quantity" class="form-control" name="product'+next+'_quantity" onchange="observe_change('+next+')" type="number" min="0" placeholder="Số lượng"></td>';
    var total = '<td><p id="product'+next+'_total" class="total-price  form-control">Total price</p></td>';
    var button = '<td><p id="add'+next+'"></p></td>';
    var row = '<tr id="receipt-row'+(next + 1)+'" class="receipt-row">' + product + price + quantity + total + button + '</tr>';
    $(wrapper).append(row);
    // change current button to remove button
    $("#add"+id).replaceWith('<button class="btn btn-danger btn-add form-control" type="button" onclick="row_delete('+next+')" tabindex="-1"><span class="glyphicon glyphicon-minus"></span></button>');
    // generate select2
    $("#product"+next).select2();
    // attach observer
    observe_change(next);
    // increase
    next++;
}

// delete row
function row_delete(row_id){
 $("#receipt-row"+row_id).remove();
}

// observe changes from select list and quantity
function observe_change(id){
    var pid = document.getElementById("product"+id);
    var pval = product_price[pid.value];
    var ppid = document.getElementById("product"+id+"_quantity");
    var ppval = $(ppid).val();
    if(isNaN(ppval)){
        ppval = 0;
    } else if(id == (next - 1)){
        add_more(id);
    }
    var total = pval*ppval;
    $("#product"+id+"_price").html(pval);
    $("#product"+id+"_total").html(total.toString());
}
</script>

