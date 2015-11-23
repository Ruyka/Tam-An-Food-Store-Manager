<?php 
session_start();
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
function get_posted_product(){
    if(isset($_SESSION['encrypted'])){    
        $KEY=md5("dob1depatodop7lipdaig7bebeaion9d");
        $IV=md5("asdkjhfalkwjehfklsndvfakjsgasdkj");
        $arr = $_SESSION['encrypted'];
        return decrypt_get_url($arr, $IV, $KEY);
    }
    return "";
}

function decrypt_get_url($arr, $IV, $KEY){
    $arr=str_replace(array('-','_','.'),array('+','/','='),$arr);
    $ENCRYPTEDDATA=base64_decode($arr);
    $M=mcrypt_module_open('rijndael-256','','cbc','');
    mcrypt_generic_init($M,$KEY,$IV);
    $SERIAL=mdecrypt_generic($M,$ENCRYPTEDDATA);
    mcrypt_generic_deinit($M);
    mcrypt_module_close($M);
    $ARRAY=unserialize($SERIAL);

    return $ARRAY;
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

$posted = get_posted_product();
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

make_print_section();
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
    // cancel button
    $("#cancel").click(function(){
        window.location.reload();
    });
});

// disable enter button in textarea
$(window).keydown(function(event){
    if((event.which== 13) && ($(event.target)[0]!=$("textarea")[0])) {
      event.preventDefault();
      return false;
  }
});

    // print  button
    function print_button(){
        $("#submit_type").val("print");
        $("#current_id").val(next-1);
        $("#receipt-form").submit();
    }

    // preview button
    function preview_button(){
        $("#submit_type").val("preview");
        $("#current_id").val(next-1);
        $("#receipt-form").submit();    
    }

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

// make printable receipt
function make_print_section(product_list){
    // get receipt list
    var receipt_list = <?php echo json_encode($GLOBALS['posted']); ?>;
    // return on empty
    if (receipt_list == "")
        return;
    // logo
    var logo = '<div id="logodiv"><img id="logo" src="<?php echo CONFIG_PATH("image")."logo.jpg"?>" /></div><br />';
    // date
    var currentdate = new Date();
    var date_out = "<table><tr><th>"+ currentdate.getDate() + "/"
                + (currentdate.getMonth()+1)  + "/" 
                + currentdate.getFullYear() +"</th><th>|"
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds()+"</th></tr></table>";
    // product list
    var receipt_product = "<table><tr><th>product</th><th>quantity</th><th>price</th></tr>"
    // make printable div
    var len = receipt_list.length;
    var row = "";    
    var total = 0;
    for(var i = 0; i < len; i++){
        var quantity = receipt_list[i]['quantity'];
        var pval = quantity * list_product[receipt_list[i]['id']]['unit']['price'];
        total = total + pval;
        row = row + "<tr><td>"+list_product[receipt_list[i]['id']]['name']+"</th><td>"+quantity+"</td><td>"+pval+"</td></tr>";
    }
    receipt_product = receipt_product + row + "<tr><td></td><td>Total:</td><td>"+total+"</td></tr></table>";
    var receipt_section = logo + date_out + receipt_product;
    $("#print_here").html(receipt_section);
}

// function to make a toast like in android
function make_toast(Msg,time){
    // set message
    $("#toast").html(Msg);
    // set toast time
    $("#toast").fadeIn(400).delay(time).fadeOut(400);
}
</script>