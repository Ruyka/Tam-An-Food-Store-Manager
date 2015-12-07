
global_alter_product_log = [];
global_list_product_HTML = "";
global_list_new_product =[];
// if add one more product modal show, focus on that
$('#add_one_product_modal').on('shown.bs.modal', function () {
    $('#alter-product-add-name').focus();
});
//
$('#add_one_more_product').on('focus', function () {
    $('#product-search').focus();
});



//readyy
$(document).ready(function(){
  //no search at beginning, hide it
  $('#alter-product-search-area').hide();
  //hide the last column, action column
  $('#alter-product-search-area td:nth-child(7),th:nth-child(7)').hide();
  //hide the switch to search button
  $('#alter_product_search_btn').hide();
  
  //addd table to sortable
  var newTableObject = document.getElementById("product-table");
  sorttable.makeSortable(newTableObject);
  
});

//show the modified history of user
function alter_product_show(option){
  $('#alter-product-search-area').show();
  // if option is change, switch to show changes
  if (option==='change'){

    //save the current serach result
    global_list_product_HTML = $('#alter-product-list').html();
      
    //show the action column
    $('#alter-product-search-area td:nth-child(7),th:nth-child(7)').show();
    //show switch to search button
    $('#alter_product_search_btn').show();
    // hide switch to see change button
    $('#alter_product_change_btn').hide();
    //hide the tick column
    $('#alter-product-search-area td:nth-child(6),th:nth-child(6)').hide();
    //hide remove item button
    $('#alter_product_remove_btn').hide();

    var tmp = make_show_changes_html();
    show_if_not_equal(tmp,'', tmp,'Không có thay đổi gần đây.');
  }
  else{
    //hide the action column
    $('#alter-product-search-area td:nth-child(7),th:nth-child(7)').hide();
    //hide switch to search button
    $('#alter_product_search_btn').hide();
    // show switch to see change button
    $('#alter_product_change_btn').show();
    //show the tick column
    $('#alter-product-search-area td:nth-child(6),th:nth-child(6)').show(); 
    //hide remove item button
    $('#alter_product_remove_btn').show();
    
    $('#alter-product-list').html(global_list_product_HTML);

  }

}


//search list product
function alter_product_search_product(){
  //show the search result table 
  $('#alter-product-search-area').show();
  alter_product_show('search');
  //get list of product from server
  var query =  $('#product-search').val();
  list_product = get_list_of_product(query);

  //console.log(list_product);
  show_if_not_equal(list_product,'No data', alter_product_make_list_product(list_product),'Không có thay đổi gần đây.');
}

//explicitly sort by JS
function alter_product_sort(sort_type, column){
  var myTH = document.getElementById(column);

  sorttable.innerSortFunction.apply(myTH, [sort_type]);
}

//make the HTML code of List Product
function alter_product_make_list_product(list_product){
  var str = "";
  
  var PRODUCT_HTML = "";
  //scan all the Const sentence that make the HTML  
  for (j=0; j< ALTER_PRODUCT_ROW.length; ++j){
      //merge in one string
      PRODUCT_HTML += ALTER_PRODUCT_ROW[j];
  }

  //scan all product in the list
  for (i = 0; i< list_product.length; ++i){
    
    var new_product_tr = PRODUCT_HTML;  
    var alter_data = global_alter_product_log[list_product[i]['product_id']];

    if (typeof alter_data !== 'undefined') {    
      if (alter_data['action']==='Xóa sản phẩm'){
        new_product_tr ="";  
      }
      else
      new_product_tr = replace_token(new_product_tr, list_product[i]['product_id']
                    , alter_data['name'],alter_data['bought'], alter_data['percentage']
                    , parseFloat(alter_data['sale']));
    }
    else{
      new_product_tr = replace_token(new_product_tr, list_product[i]['product_id']
                    , list_product[i]['name'],"","", parseFloat(list_product[i]['unit']['price']));
    }
    str += new_product_tr;
  }

  return str;
}

//observe the change from user
function alter_product_observe(source, id){
    //get value
    var bought_price= parseFloat($("#alter-product"+ id + "-bought").val());
    var percentage = parseFloat($("#alter-product" + id + "-percentage").val());
    var sale =parseFloat($("#alter-product"+ id + "-sale").val());
    
    //sale price is not allowed to be empty
    if (isNaN(sale)){
      $("#alter-product"+ id + "-sale").val(0);
      $("#alter-product"+ id + "-sale").attr("sorttable_customkey", 0);
    }
  
    switch (source) {
      //the case 0 is change on product bought price
      //affect percentage value
      case 0:
        if (!isNaN(bought_price) && bought_price!=0){
          $("#alter-product"+ id + "-percentage").val( sale*100/bought_price);
        }
      //and affect sale
      
      case 1:
      //the case 1 is changed on percentage value
      //change on sale price
        if (!isNaN(percentage) && !isNaN(bought_price)){
          $("#alter-product"+ id + "-sale").val( bought_price *percentage/100);
        }
        break;

      //case 2 change on product price
      //affect the percentage of the product
      case 2:
        if (sale ==0){
          $("#alter-product" + id + "-percentage").val(0);
        }
        else
        if (!isNaN(bought_price) && bought_price!=0){
          $("#alter-product" + id + "-percentage").val(sale/bought_price *100);
        }
        break;
    }

    //assign value to every input box
    alter_product_assign_val_to_input(id, 
                                      $("#alter-product"+ id + "-name").val(),
                                      $("#alter-product"+ id + "-bought").val(),
                                      $("#alter-product"+ id + "-percentage").val(),
                                      $("#alter-product"+ id + "-sale").val());
    

    $('#alter-product-search-area td:nth-child(6),th:nth-child(6)').hide();
    //get change
    
    global_alter_product_log[id] = {'id' : id,
                                    'name': $("#alter-product"+ id + "-name").val(),
                                    'bought':$("#alter-product"+ id + "-bought").val(),
                                    'percentage':$("#alter-product"+ id + "-percentage").val(),
                                    'sale':$("#alter-product"+ id + "-sale").val(),
                                    'html' : $("#alter-product"+ id).html(),
                                    'action': 'Đổi giá trị.'
                                    };
    
    $('#alter-product-search-area td:nth-child(6),th:nth-child(6)').show();
}


function alter_product_assign_val_to_input(id, name, bought, percentage, sale){
    //change value to sort
    $("#alter-product"+ id + "-name").attr("sorttable_customkey", name);
    $("#alter-product"+ id + "-bought").attr("sorttable_customkey", bought);
    $("#alter-product"+ id + "-percentage").attr("sorttable_customkey", percentage);
    $("#alter-product"+ id + "-sale").attr("sorttable_customkey", sale);
    //put real value to it
    $("#alter-product"+ id + "-name").attr("value", name);
    $("#alter-product"+ id + "-bought").attr("value", bought);
    $("#alter-product"+ id + "-percentage").attr("value", percentage);
    $("#alter-product"+ id + "-sale").attr("value", sale);

}
//onclick remove button
function alter_product_remove_item(){
  
  $('.alter-product-check-box:checkbox:checked').each(function () {
      var id = $(this).val();
      
      $('#alter-product-search-area td:nth-child(6),th:nth-child(6)').hide();
      set_all_input_readonly(id, true);
      
      //get change
      
      global_alter_product_log[id] = {'id' : id,
                                      'name': $("#alter-product"+ id + "-name").val(),
                                      'bought':$("#alter-product"+ id + "-bought").val(),
                                      'percentage':$("#alter-product"+ id + "-percentage").val(),
                                      'sale':$("#alter-product"+ id + "-sale").val(),
                                      'html' : $("#alter-product"+ id).html(),
                                      'action': 'Xóa sản phẩm'
                                      };
      
      $('#alter-product-search-area td:nth-child(6),th:nth-child(6)').show();
      set_all_input_readonly(id, false);
      deleteRow("alter-product"+ id);
  });  
}

//delete row in the table
function deleteRow(rowid)  
{   
    var row = document.getElementById(rowid);
    var table = row.parentNode;
    while ( table && table.tagName != 'TABLE' )
        table = table.parentNode;
    if ( !table )
        return;
    table.deleteRow(row.rowIndex);
}

function set_all_input_readonly(id, val){
  $("#alter-product"+ id + "-name").prop('readonly', val);
  $("#alter-product"+ id + "-bought").prop('readonly', val);
  $("#alter-product"+ id + "-percentage").prop('readonly', val);
  $("#alter-product"+ id + "-sale").prop('readonly', val);

}

// if cod1 == cod2 show error msg else
// show val
function show_if_not_equal(cod1, cod2, val, msg){
  if (cod1===cod2){
      $("#alter-product-list").html('');
      $("#not-found").hide();
      $("#not-found").html(msg);
      $("#not-found").show("fast");
    }
    else{
      $("#not-found").html('');
      $('#alter-product-list').html(val);
    }
}



function replace_token(str, id, name, bought, percentage, sale){
  // replace the %PRODUCT_ID% with the product real ID
    str = str.replace(new RegExp("%PRODUCT_ID%", 'g'), id);
    // replace the %PRODUCT_NAME% with the product real NAME
    str = str.replace(new RegExp("%PRODUCT_NAME%", 'g'), name);
    // replace the %PRODUCT_NAME% with the product real BOUGHT
    str = str.replace(new RegExp("%PRODUCT_BOUGHT%", 'g'), bought);
    // replace the %PRODUCT_NAME% with the product real PERCENTAGE
    str = str.replace(new RegExp("%PRODUCT_PERCENTAGE%", 'g'), percentage);
    // replace the %PRODUCT_SALE% with the product real PRICE
    str = str.replace(new RegExp("%PRODUCT_SALE%", 'g'), sale);
    return str;
}


//make html from global_alter_product_log
function make_show_changes_html(){
  var result = "";
  
  //check in list of new product 
  var PRODUCT_HTML = "";
  //scan all the Const sentence that make the HTML  
  for (j=0; j< ALTER_PRODUCT_ROW.length; ++j){
      //merge in one string
      PRODUCT_HTML += ALTER_PRODUCT_ADD_NEW_PRODUCT_ROW[j];
  }
  for (key in global_list_new_product) {
    var product = global_list_new_product[key];
    result += create_new_product_html(key, PRODUCT_HTML,product);
  }

  //check in alter product log
  for (key in global_alter_product_log) {
    var product = global_alter_product_log[key];
    result += '<tr id ="alter-product'+product['id']+'">' + product['html'];
    result = result + '<td>' + product['action'] + '</td>' +'</tr>';
  }
  
  return result;
}

// creat HTML for new product
function create_new_product_html(id, str, product){
  var result = "";
  result = replace_token(str,id, product['name'],product['bought'],product['percentage'],product['sale']);
  result = result.replace(new RegExp("%ACTION%", 'g'), product['action']);
  return result;
}

//add one product function
function add_one_product(){
  var name = $('#alter-product-add-name').val();
  var bought = $('#alter-product-add-bought').val();
  var percentage = $('#alter-product-add-percentage').val();
  var sale = $('#alter-product-add-sale').val();
  add_new_product(name, bought, percentage, sale);
  //console.log(global_list_new_product);
}

function add_new_product(name, bought, percentage, sale){
  global_list_new_product.push({
                                'name': name,
                                'bought':bought,
                                'percentage': percentage,
                                'sale':sale,
                                'action': 'Thêm sản phẩm'
                                });
}


//save data to serverr
function save_data(){
  save_alter_change(global_alter_product_log);
  global_alter_product_log = [];
  save_new_product(global_list_new_product);
  global_list_new_product = [];
}


//observe the change from user
function alter_add_product_observe(source, id){
    //get value
    var bought_price= parseFloat($("#alter-product-no-id"+ id + "-bought").val());
    var percentage = parseFloat($("#alter-product-no-id" + id + "-percentage").val());
    var sale =parseFloat($("#alter-product-no-id"+ id + "-sale").val());
    alert("aaa");
    //sale price is not allowed to be empty
    if (isNaN(sale)){
      $("#alter-product-no-id"+ id + "-sale").val(0);
      $("#alter-product-no-id"+ id + "-sale").attr("sorttable_customkey", 0);
    }
  
    switch (source) {
      //the case 0 is change on product bought price
      //affect percentage value
      case 0:
        if (!isNaN(bought_price) && bought_price!=0){
          $("#alter-product-no-id"+ id + "-percentage").val( sale*100/bought_price);
        }
      //and affect sale
      
      case 1:
      //the case 1 is changed on percentage value
      //change on sale price
        if (!isNaN(percentage) && !isNaN(bought_price)){
          $("#alter-product-no-id"+ id + "-sale").val( bought_price *percentage/100);
        }
        break;

      //case 2 change on product price
      //affect the percentage of the product
      case 2:
        if (sale ==0){
          $("#alter-product-no-id" + id + "-percentage").val(0);
        }
        else
        if (!isNaN(bought_price) && bought_price!=0){
          $("#alter-product-no-id" + id + "-percentage").val(sale/bought_price *100);
        }
        break;
    }

    //get change
    global_list_new_product[id] = {
                                    'name': $("#alter-product-no-id"+ id + "-name").val(),
                                    'bought':$("#alter-product-no-id"+ id + "-bought").val(),
                                    'percentage':$("#alter-product-no-id"+ id + "-percentage").val(),
                                    'sale':$("#alter-product-no-id"+ id + "-sale").val(),
                                    'action': 'Thêm mới'
                                    };
  
}

function restore(){
  $("#alter-product-add-name").val('');
  $("#alter-product-add-bought").val('');
  $("#alter-product-add-percentage").val('');
  $("#alter-product-add-sale").val('');
}