// config url location
receipt_url = "http://localhost/Tam-An-Food-Store-Manager/includes/function/receipt_function.php";
// process_url = "http://localhost/Tam-An-Food-Store-Manager/includes/function/process_submit.php";
// get data from php
product_data = null;
$.ajax({
    async: false,
    url: receipt_url,
    type: "post",
    data: {action:'get_receipt_data_from_server'},
    success: function (data) {
      product_data = JSON.parse(data);
  }  
});
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
        $("#submit_type").val("print");
        $("#current_id").val(next-1);
        alert("Under construction");
    }

    // preview button
    function preview_button(){
        $("#submit_type").val("preview");
        $("#current_id").val(next-1);
        alert("Under construction");    
    }

    function add_more(id){
    // form wraper
    var wrapper = $("#receipt-product-list");
    var find = '%ID%';
    var re = new RegExp(find, 'g');
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
    // make the first in list to be the default option
    var html_option = "<option value='"+0+"' selected='selected'>" + product_list[0]['name']+" ("+product_list[0]['unit']['unit_name']+")</option>";
    // make options
    for(var i = 1; i < len; i++ )
        html_option = html_option + "<option value='"+i+"'>" + product_list[i]['name']+" ("+product_list[i]['unit']['unit_name']+")</option>";
    return html_option;
}

// validate form
function form_validation(){
    return false;
}

// make printable receipt
// function make_print_section(product_list){
//     // get receipt list
//     var receipt_list = <?php echo json_encode($GLOBALS['posted']); ?>;
//     // return on empty
//     if (receipt_list == "")
//         return;
//     // logo
//     var logo = '<div id="logodiv"><img id="logo" src="<?php echo CONFIG_PATH("image")."logo.jpg"?>" /></div><br />';
//     // date
//     var currentdate = new Date();
//     var date_out = "<table><tr><th>"+ currentdate.getDate() + "/"
//     + (currentdate.getMonth()+1)  + "/" 
//     + currentdate.getFullYear() +"</th><th>|"
//     + currentdate.getHours() + ":"  
//     + currentdate.getMinutes() + ":" 
//     + currentdate.getSeconds()+"</th></tr></table>";
//     // product list
//     var receipt_product = "<table><tr><th>product</th><th>quantity</th><th>price</th></tr>"
//     // make printable div
//     var len = receipt_list.length;
//     var row = "";    
//     var total = 0;
//     for(var i = 0; i < len; i++){
//         var quantity = receipt_list[i]['quantity'];
//         var pval = quantity * list_product[receipt_list[i]['id']]['unit']['price'];
//         total = total + pval;
//         row = row + "<tr><td>"+list_product[receipt_list[i]['id']]['name']+"</th><td>"+quantity+"</td><td>"+pval+"</td></tr>";
//     }
//     receipt_product = receipt_product + row + "<tr><td></td><td>Total:</td><td>"+total+"</td></tr></table>";
//     var receipt_section = logo + date_out + receipt_product;
//     $("#print_here").html(receipt_section);
// }

// function to make a toast like in android
function make_toast(Msg,time){
    // set message
    $("#toast").html(Msg);
    // set toast time
    $("#toast").fadeIn(400).delay(time).fadeOut(400);
}