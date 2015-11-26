// config url location
config_url = "http://localhost/Tam-An-Food-Store-Manager/includes/function/general_function.php";



// get receipt_function.php path
receipt_path = null;
$.ajax({
    async: false,
    url: config_url,
    type: "post",
    data: {action:'JS_CONFIG_PATH', directory:'function', file:'receipt_function.php'},
    success: function (data) {
      receipt_path = data;
  }  
});



// get data from database
function get_data(){
    var tmp = null;
    $.ajax({
        async: false,
        url: receipt_path,
        type: "post",
        data: {action:'get_receipt_data_from_server'},
        success: function (data) {
          tmp = JSON.parse(data);
      }  
  });
    return tmp;
}



// pass data to variable
product_data = get_data();
// get product list from data
list_product = product_data['list_product'];
// make option list for select
option_list = make_optionlist(list_product);
// throw out console debug
console.log(list_product);
// Total price of receipt
Total_all = 0;

// make_print_section();
// Add new input field for the receipt
// current id
next = 1;



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
    $("#receipt-form").submit(function(event){
      event.preventDefault();
  });
});



    // print  button
    function print_button(){
        var receipt_list = null;
        $.ajax({
            async: false,
            url: receipt_path+"?"+$('#receipt-form').serialize(),
            type: "post",
            data: {action:'get_data_from_submit', max:next},
            success: function (data) {
              receipt_list = JSON.parse(data);
              console.log(receipt_list);
          }  
      });
        make_print_section(receipt_list);
        window.print();
    }



    // preview button
    function preview_button(){
        var receipt_list = null;
        $.ajax({
            async: false,
            url: receipt_path+"?"+$('#receipt-form').serialize(),
            type: "post",
            data: {action:'get_data_from_submit', max:next},
            success: function (data) {
              receipt_list = JSON.parse(data);
              console.log(receipt_list);
          }  
      });
        make_print_section(receipt_list);
        $("#preview_section").html($("#print_here").html());
    }


    // add new input
    function add_more(id){
    // form wraper
    var wrapper = $("#receipt-product-list");
    // set %ID% as regular expression
    var re = new RegExp('%ID%', 'g');
    // find and replace all appearence of %ID% to next
    var newRow = row.replace(re, next);
    // make row  
    $("#receipt-row"+id).after(newRow);
    // change current button to remove button
    $("#add"+id).replaceWith('<button class="btn btn-danger btn-add form-control" type="button" onclick="row_delete(\''+id+'\')" tabindex="-1"><span class="glyphicon glyphicon-minus"></span></button>'); 
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
function row_delete(id){
    var price = $("#product"+id+"_total").html();
    Oberser_total_price(-price);
    $("#receipt-row"+id).remove();
}



// observe changes from select list and quantity
function observe_change(id){
    // get element of #product with "id"
    var pid = document.getElementById("product"+id);
    // get key
    var key = JSON.parse(pid.value)['key'];
    // get corresponding price in list_product
    var pval = list_product[key]['unit']['price'];
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
    if(ppval > parseInt(list_product[key]['total_number'])){
        // print error msg if it realy exceed
        $("#product"+id+"_total").html("Không đủ sản phẩm (Còn lại:"+list_product[key]['total_number']+")");
        return;
    }
    // calculate total value
    var total = pval*ppval;
    // set "Total" to the calculated value
    $("#product"+id+"_total").html(total);
    // calculated total receipt price
    Oberser_total_price(total);
}



// Observer for total receipt price 
function Oberser_total_price(price){
    Total_all = Total_all + price;
    $("#Total_all").html(Total_all);
}



// make option list for select
function make_optionlist(product_list){
    // get product list length
    var len = product_list.length;
    // return if product list is empty
    if(len < 1)
        return "";    
    // make string to find into regular expressions
    var re_value = new RegExp('%VALUE%', 'g');
    var re_name = new RegExp('%NAME%', 'g');
    var re_unitname = new RegExp('%UNITNAME%', 'g');
    // replace value with id
    var option_list = html_option.replace(re_value, "{\"id\":\""+product_list[0]['product_id']+"\",\"key\":0}");
    option_list = option_list.replace(re_name, product_list[0]['name']);
    option_list = option_list.replace(re_unitname, product_list[0]['unit']['unit_name']);
    // make options
    for(var i = 1; i < len; i++ ){
        // replace value with id
        var new_option = html_option.replace(re_value, "{\"id\":\""+product_list[i]['product_id']+"\",\"key\":"+i+"}");
        new_option = new_option.replace(re_name, product_list[i]['name']);
        new_option = new_option.replace(re_unitname, product_list[i]['unit']['unit_name']);    
        option_list = option_list + new_option;
    }
    return option_list;
}

// validate form
function form_validation(){
    return false;
}

// make printable receipt
function make_print_section(receipt_list){
    // return on empty
    if (receipt_list.length == 0){
        $("#print_here").html("Error: Receipt is empty.");
        return;
    }
    // make string to find into regular expressions
    var re_product = new RegExp('%PRODUCT%', 'g');
    var re_quantity = new RegExp('%QUANTITY%', 'g');
    var re_price = new RegExp('%PRICE%', 'g');

    // make printable div
    var len = receipt_list.length;
    var total = 0;

    var receipt_rows = "";
    for(var i = 0; i < len; i++){
        var key = receipt_list[i][0]['key'];
        var quantity = receipt_list[i][1];
        var price = parseFloat(list_product[key]['unit']['price'] * quantity);
        total = total + price;

        var new_row = receipt_row.replace(re_product, list_product[key]['name'] + " ("+list_product[key]['unit']['unit_name']+")");
        new_row = new_row.replace(re_quantity, quantity);
        new_row = new_row.replace(re_price, price);

        receipt_rows = receipt_rows + new_row;
    }
    var receipt_final = "<table>" + receipt_rows + "<tr><td></td><td>Total:</td><td>"+total+"</td></tr></table>";
    $("#print_here").html(receipt_final);
}

// function to make a toast like in android
function make_toast(Msg,time){
    // set message
    $("#toast").html(Msg);
    // set toast time
    $("#toast").fadeIn(400).delay(time).fadeOut(400);
}