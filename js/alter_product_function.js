
// if add one more product modal show, focus on that
$('#add_one_product_modal').on('shown.bs.modal', function () {
    $('#modal-focus').focus();
});
$('#add_one_more_product').on('focus', function () {
    $('#product-search').focus();
});

$(document).ready(function(){
  //addd table to sortable
  var newTableObject = document.getElementById("product-table");
  sorttable.makeSortable(newTableObject);
});


//search list product
function alter_product_search_product(){
  //get list of product from server
  
  var query =  $('#product-search').val();
  if (query==='')
    list_product = get_list_of_product();
  else
    list_product = get_list_of_product(query);
  
  if (list_product ==='No data')
    alert('No data bitch');
  else
  $("#alter-product-list").html(alter_product_make_list_product(list_product));
}

//explicitly sort by JS
function alter_product_sort(sort_type, column){
  var myTH = document.getElementById(column);

  sorttable.innerSortFunction.apply(myTH, [sort_type]);
}

//make the HTML code of List Product
function alter_product_make_list_product(list_product){
  var str = "";

  //scan all product in the list
  for (i = 0; i< list_product.length; ++i){
    
    var new_product_tr = "";
    //scan all the Const sentence that make the HTML
    for (j=0; j< ALTER_PRODUCT_ROW.length; ++j){
      var row = ALTER_PRODUCT_ROW[j]; 
      //replace %ID% with the id of the row
      row = row.replace(new RegExp("%ID%", 'g'), i);
      //merge in one string
      new_product_tr += row;
    }
    
    // replace the %PRODUCT_ID% with the product real ID
    new_product_tr = new_product_tr.replace(new RegExp("%PRODUCT_ID%", 'g'), list_product[i]['product_id']);
    // replace the %PRODUCT_NAME% with the product real NAME
    new_product_tr = new_product_tr.replace(new RegExp("%PRODUCT_NAME%", 'g'), list_product[i]['name']);
    // replace the %PRODUCT_SALE% with the product real PRICE
    new_product_tr = new_product_tr.replace(new RegExp("%PRODUCT_SALE%", 'g'), parseFloat(list_product[i]['unit']['price']));
    
    str += new_product_tr;
  }

  return str;
}

function alter_product_observe(source, id){
    //get vvalue
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
    //change value to sort
    $("#alter-product"+ id + "-name").attr("sorttable_customkey", $("#alter-product"+ id + "-name").val());
    $("#alter-product"+ id + "-bought").attr("sorttable_customkey", $("#alter-product"+ id + "-bought").val());
    $("#alter-product"+ id + "-percentage").attr("sorttable_customkey", $("#alter-product"+ id + "-percentage").val());
    $("#alter-product"+ id + "-sale").attr("sorttable_customkey", $("#alter-product"+ id + "-sale").val());
}