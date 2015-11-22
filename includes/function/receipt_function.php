<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 
require_once(CLASS_PATH."AllClass.php");
require_once(CLASS_PATH."Management.php");
?>

<!-- PHP function here -->
<?php 
// Alter print div upon submition succesful
function get(){

}

// get data from server
function get_receipt_data_from_server(){
    $manager = new Management();
    $data = $manager->get_list_of_product_info();
    $receipt = new Receipt();
    $receipt->get_data_from_array($data);
    return $receipt;
}
// global data
$data = get_receipt_data_from_server();
?>

<!-- Javascript function here -->
<script type="text/javascript">
// Fake data
data = <?php echo $data->json_encode(); ?>;
list_product = data['list_product'];
option_list = make_datalist(list_product);
console.log(list_product);


// Add new input field for the receipt
next = 1;
wrapper = $("#receipt-product-list");
$(document).ready(function(){
    // add options
    $("#product").append(option_list);
    // init first select
    $("#product").select2();
    // attract observer
    observe_change('');
});

$(window).keydown(function(event){
    if((event.which== 13) && ($(event.target)[0]!=$("textarea")[0])) {
      event.preventDefault();
      return false;
  }
});

$("#print").click(function(){
    $("#receipt-form").submit();
    alert(<?php print_r($_POST); ?>);
});

function add_more(id){
    // generate new row
    var product = '<td><select id="product'+next+'" class="product-list form-control" name="product'+next+'" onchange="observe_change('+next+')"></select></td>';
    var quantity = '<td><input id="product'+next+'_quantity" class="form-control" name="product'+next+'_quantity" onchange="observe_change('+next+')" type="number" min="0" placeholder="Số lượng"></td>';
    var price  = '<td><p id="product'+next+'_price" class="product-price form-control">Product Price</p></td>';
    var total = '<td><p id="product'+next+'_total" class="total-price  form-control">Total price</p></td>';
    var button = '<td><p id="add'+next+'"></p></td>';
    var row = '<tr id="receipt-row'+(next + 1)+'" class="receipt-row">' + product + quantity + price + total + button + '</tr>';
    $(wrapper).append(row);
    // change current button to remove button
    $("#add"+id).replaceWith('<button class="btn btn-danger btn-add form-control" type="button" onclick="row_delete('+next+')" tabindex="-1"><span class="glyphicon glyphicon-minus"></span></button>'); 
    // add product options
    $("#product"+next).append(option_list);
    // attrach select2
    $("#product"+next).select2();
    // attrach observer
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
    var pval = list_product[pid.value]['unit']['price'];
    $("#product"+id+"_price").html(pval);
    var ppid = document.getElementById("product"+id+"_quantity");
    var ppval = $(ppid).val();
    if(isNaN(ppval)){
        ppval = 0;
    } else if(id == (next - 1)){
        add_more(id);
    }
    if(ppval > parseInt(list_product[pid.value]['total_number'])){
        $("#product"+id+"_total").html("Không đủ sản phẩm (Còn lại:"+list_product[pid.value]['total_number']+")");
        return;
    }
    var total = pval*ppval;
    $("#product"+id+"_total").html(total.toString());
}

function make_datalist(product_list){
    var len = product_list.length;
    if(len < 1)
        return "";
    var html_option = "<option value='"+0+"' selected='selected'>" + product_list[0]['name']+"</option>";
    for(var i = 1; i < len; i++ )
        html_option = html_option + "<option value='"+i+"'>" + product_list[i]['name']+"</option>";
    return html_option;
}

// validate form
function form_validation(){
    return false;
}
</script>