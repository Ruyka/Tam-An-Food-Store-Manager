<?php 
require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 
require_once(CLASS_PATH."AllClass.php");
require_once(CLASS_PATH."Management.php");
?>


<!-- ************************ -->
<!-- ************************ -->
<!-- PHP function here        -->
<!-- ************************ -->
<!-- ************************ -->
<?php 
// $_get value to know which type
if(isset($_GET)){

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

<!-- ************************ -->
<!-- ************************ -->
<!-- Javascript function here -->
<!-- ************************ -->
<!-- ************************ -->
<script type="text/javascript">
// get data from php
data = <?php echo $data->json_encode(); ?>;
// get product list from data
list_product = data['list_product'];
// make option list for select
option_list = make_optionlist(list_product);
// throw out console debug
console.log(list_product);

// Add new input field for the receipt
// current id
next = 1;
// form wraper
wrapper = $("#receipt-product-list");
// function execute on form ready
$(document).ready(function(){
    // add options
    $("#product").append(option_list);
    // init first select
    $("#product").select2();
    // attract observer
    observe_change('');
});

// disable enter button in textarea
$(window).keydown(function(event){
    if((event.which== 13) && ($(event.target)[0]!=$("textarea")[0])) {
      event.preventDefault();
      return false;
  }
});

// print  button
$("#print").click(function(){
    $("#submit_type").val("print");
    $("#receipt-form").submit();
});

// preview button
$("#preview").click(function(){
    $("#submit_type").val("preview");
    $("#receipt-form").submit();
});

// cancel button
$("#cancel").click(function(){
    window.location.reload();
});

function add_more(id){
    // generate new row
    // perform by manually add html codes in variable and piece it together
    // make input select
    var product = '<td><select id="product'+next+'" class="product-list form-control" name="product'+next+'" onchange="observe_change('+next+')"></select></td>';
    // make input quantity
    var quantity = '<td><input id="product'+next+'_quantity" class="form-control" name="product'+next+'_quantity" onchange="observe_change('+next+')" type="number" min="0" placeholder="Số lượng"></td>';
    // price of product
    var price  = '<td><p id="product'+next+'_price" class="product-price form-control">Product Price</p></td>';
    // total price
    var total = '<td><p id="product'+next+'_total" class="total-price  form-control">Total price</p></td>';
    // add button (guess it's not need now) lol :v
    var button = '<td><p id="add'+next+'"></p></td>';
    // piece every thing together
    var row = '<tr id="receipt-row'+(next + 1)+'" class="receipt-row">' + product + quantity + price + total + button + '</tr>';
    // append to wraper
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
    // get element of #product with "id"
    var pid = document.getElementById("product"+id);
    // get corresponding price in list_product
    var pval = list_product[pid.value]['unit']['price'];
    // change field "Price per product" to corresponding price
    $("#product"+id+"_price").html(pval);
    // get element of product quantity with "id"
    var ppid = document.getElementById("product"+id+"_quantity");
    // get quantity
    var ppval = $(ppid).val();
    // check if quantity is a number
    if(isNaN(ppval)){
        ppval = 0;
    }
    // add new if it's the bottom row
    else if(id == (next - 1)){
        add_more(id);
    }
    // check if it does not exceed max quantity
    if(ppval > parseInt(list_product[pid.value]['total_number'])){
        // print error msg if it realy exceed
        $("#product"+id+"_total").html("Không đủ sản phẩm (Còn lại:"+list_product[pid.value]['total_number']+")");
        return;
    }
    // calculate total value
    var total = pval*ppval;
    // set "Total" to the calculated value
    $("#product"+id+"_total").html(total.toString());
}

// make option list for select
function make_optionlist(product_list){
    // get product list length
    var len = product_list.length;
    // return if product list is empty
    if(len < 1)
        return "";
    // make the first in list to be the default option
    var html_option = "<option value='"+0+"' selected='selected'>" + product_list[0]['name']+"</option>";
    // make options
    for(var i = 1; i < len; i++ )
        html_option = html_option + "<option value='"+i+"'>" + product_list[i]['name']+"</option>";
    return html_option;
}

// validate form
function form_validation(){
    return false;
}

// function to make a toast like in android
function make_toast(Msg,time){
    // set message
    $("#toast").html(Msg);
    // set toast time
    $("#toast").fadeIn(400).delay(time).fadeOut(400);
}
</script>