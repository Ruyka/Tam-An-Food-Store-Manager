// get user name
user_name = get_username();

// get receipt_function.php path
receipt_path = get_path('function', 'receipt_function.php');

// get data from database
function get_data(){
    var tmp = null;
    $.ajax({
        async: false,
        url: receipt_path,
        type: "get",
        data: "q="+JSON.stringify({action:'get_receipt_data_from_server'}),
        success: function (data) {
          tmp = JSON.parse(data);
      }  
  });
    return tmp;
}



// pass data to variable
product_data = get_data();
// get product list from data
if (typeof product_data['list_product'] !== 'undefined') {
    // the variable is defined
    list_product = product_data['list_product'];
}
else{
    list_product = "";
}
// make option list for select
option_list = make_optionlist(list_product);
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
        // default value of receipt_list
        var receipt_list = "";
        // check if server return error
        var isError = false;
        // send receipt list to server
        $.ajax({
            async: false,
            url: receipt_path+"?q="+JSON.stringify({action:'get_data_from_submit', max:next, isPrint:1}),
            type: "post",
            data: $('#receipt-form').serialize(),
            // if server is not return error, get data from server
            success: function (data) {
              receipt_list = JSON.parse(data);
          },          
          // if there has been an error, log it into console and set isError to true
          error: function (data) {  
            isError = true;              
            console.log(data);
        }  
    });
        if(isError){
            make_print_section("");
            make_toast("There has been a error",2000);
        }
        else{
            make_print_section(receipt_list);
            window.print();
        }
    }



    // preview button
    function preview_button(){
        var receipt_list = "";
        var isError = false;
        $.ajax({
            async: false,
            url: receipt_path+"?q="+JSON.stringify({action:'get_data_from_submit', max:next, isPrint:0}),
            type: "post",
            data: $('#receipt-form').serialize(),
            success: function (data) {
              receipt_list = JSON.parse(data);
          },          
          error: function (data) {  
            isError = true;              
            console.log(data);
        }  
    });        
        if(isError){
            make_print_section("");
            $("#preview_section").html($("#print_here").html());
            make_toast("There has been a error",2000);
        }
        else{
            make_print_section(receipt_list);
            $("#preview_section").html($("#print_here").html());
        }
    }



    // preview print
    function preview_print(){
        isError = false;
        $.ajax({
            async: false,
            url: receipt_path,
            type: "post",
            data: {action:'send_data_to_server'},
            error: function (data) {  
                isError = true;              
                console.log(data);
            }  
        });    
        if(!isError)
            window.print();  
        else
            make_toast("There has been a error",3000);
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
    // get current price
    var oldTotal = parseFloat(numberWithoutCommas($("#product"+id+"_total").html()));
    // observer total price
    Oberser_total_price(-oldTotal);
    $("#receipt-row"+id).remove();
}

// observe changes from select list and quantity
function observe_change(id){
    // add new if it's the bottom row
    if(id == (next - 1)){
        add_more(id);
    }
    // get element of #product with "id"
    var pid = document.getElementById("product"+id);
    // get key
    var key = JSON.parse(pid.value)['key'];
    if(key == -1){
        var oldTotal = 0;
        if($("#product"+id+"_total").html() != "Total price"){
            oldTotal = parseFloat(numberWithoutCommas($("#product"+id+"_total").html()));
        }
        $("#product"+id+"_price").html(0);
        $("#product"+id+"_total").html(0);
        Oberser_total_price(-oldTotal);
        return;
    }
    // get corresponding price in list_product
    var pval = list_product[key]['unit']['price'];
    // change field "Price per product" to corresponding price
    $("#product"+id+"_price").html(numberWithCommas(pval));

    //document.getElementById("td"+id+"_price").setAttribute("sorttable_customkey", numberWithCommas(pval) );
    // get element of product quantity with "id"
    var ppid = document.getElementById("product"+id+"_quantity");
    // get quantity
    var ppval = $(ppid).val();
    $("#td"+id+"_quantity").attr("sorttable_customkey",ppval);
    // check if quantity is a number
    if(isNaN(ppval)){
        ppval = 0;  
        $(ppid).val(0);
    }
    // check if it does not exceed max quantity
    // if(ppval > parseInt(list_product[key]['total_number'])){
    //     // print error msg if it realy exceed
    //     $("#product"+id+"_total").html("Không đủ sản phẩm (Còn lại:"+list_product[key]['total_number']+")");
    //     return;
    // }
    // calculate total value
    var oldTotal = 0;
    if($("#product"+id+"_total").html() != "Total price"){
        oldTotal = parseFloat(numberWithoutCommas($("#product"+id+"_total").html()));
    }
    var total = Math.round(pval*ppval);
    // set "Total" to the calculated value
    $("#product"+id+"_total").html(numberWithCommas(total));
    // calculated total receipt price
    Oberser_total_price(total - oldTotal);
}



// Observer for total receipt price 
function Oberser_total_price(price){
    Total_all = Total_all + price;
    $("#Total_all").html(numberWithCommas(Total_all));
}



// make option list for select
function make_optionlist(product_list){
    // return if product list is empty
    if(product_list == "")
        return "";    
    // get product list length
    var len = product_list.length;
    // make string to find into regular expressions
    var re_value = new RegExp('%VALUE%', 'g');
    var re_name = new RegExp('%NAME%', 'g');
    var re_unitname = new RegExp('%UNITNAME%', 'g');
    // replace value with id
    var option_list = html_option.replace(re_value, "{\"id\":\"-1\",\"key\":-1}");
    option_list = option_list.replace(re_name, "");
    option_list = option_list.replace(re_unitname, "");
    // make options
    for(var i = 0; i < len; i++ ){
        // replace value with id
        var new_option = html_option.replace(re_value, "{\"id\":\""+product_list[i]['product_id']+"\",\"key\":"+i+"}");
        new_option = new_option.replace(re_name, product_list[i]['name']);
        if(product_list[i]['unit']['unit_name'] != "")
            new_option = new_option.replace(re_unitname, "("+product_list[i]['unit']['unit_name']+")");    
        else
            new_option = new_option.replace(re_unitname, "");     
        option_list = option_list + new_option;
    }
    return option_list;
}

// add comma to money
function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

// remove comma from money
function numberWithoutCommas(x) {
    return x.replace(/\,/g,"");
}

// make printable receipt
function make_print_section(receipt_list){
    // return on empty
    if (receipt_list == ""){
        $("#print_here").html("Error: Receipt is empty.");
        return;
    }
    // make string to find into regular expressions
    var re_object1 = new RegExp('%OBJECT1%', 'g');
    var re_object2 = new RegExp('%OBJECT2%', 'g');
    var re_object3 = new RegExp('%OBJECT3%', 'g');

    // info
    var re_address = new RegExp('%ADDRESS%', 'g');
    var re_tel = new RegExp('%TEL%', 'g');
    var re_receiptid = new RegExp('%RECEIPTID%', 'g');
    var re_date = new RegExp('%DATE%', 'g');
    var re_time = new RegExp('%TIME%', 'g');
    var re_cashier = new RegExp('%CASHIER%', 'g');

    // get date & time
    var date = new Date();
    var receipt_date = date.getDate()+"/"+(date.getMonth()+1)+"/"+date.getFullYear();
    var receipt_time = date.getHours()+":"+date.getMinutes();
    // start making receipt
    var receipt_logo = scaled_logo;
    var receipt_info = receipt_info_table;
    var receipt_quote = receipt_thanks;

    // make infomation section
    receipt_info = receipt_info.replace(re_address, "Tam An");
    receipt_info = receipt_info.replace(re_tel, "");
    // receipt_info = receipt_info.replace(re_receiptid, "-1");
    receipt_info = receipt_info.replace(re_date, receipt_date);
    receipt_info = receipt_info.replace(re_time, receipt_time);
    receipt_info = receipt_info.replace(re_cashier, user_name);

    // make printable div
    var len = receipt_list.length;
    var total = 0;

    // first line of table has to have dashed line
    var key = receipt_list[0][0]['key'];
    var quantity = receipt_list[0][1];
    var price = parseFloat(list_product[key]['unit']['price'] * quantity);
    total = total + price;
    var receipt_rows = "";

    var new_row = receipt_dashed_row.replace(re_object2, list_product[key]['name'] + "("+list_product[key]['unit']['unit_name']+")");
    new_row = new_row.replace(re_object1, quantity);
    new_row = new_row.replace(re_object3, numberWithCommas(price));
    receipt_rows = receipt_rows + new_row;
    for(var i = 1; i < len; i++){
        key = receipt_list[i][0]['key'];
        quantity = receipt_list[i][1];
        price = parseFloat(list_product[key]['unit']['price'] * quantity);
        total = total + price;

        new_row = receipt_row.replace(re_object2, list_product[key]['name'] + "("+list_product[key]['unit']['unit_name']+")");
        new_row = new_row.replace(re_object1, quantity);
        new_row = new_row.replace(re_object3, numberWithCommas(price));

        receipt_rows = receipt_rows + new_row;
    }
    var receipt_total = receipt_dashed_row.replace(re_object1, "");
    receipt_total = receipt_total.replace(re_object2, "Tổng cộng");
    receipt_total = receipt_total.replace(re_object3, numberWithCommas(total));

    receipt_rows = receipt_rows + receipt_total;

    var receipt_list_table = "<table class='tri-receipt-table'>" + receipt_rows + "</table>";

    var full_receipt = receipt_logo + receipt_info + receipt_list_table + receipt_quote;
    $("#print_here").html(full_receipt);
}