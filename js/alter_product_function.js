//get list of product from server
list_product = get_list_of_product();

$(document).ready(function(){
    $("#alter-product-list").append(alter_product_make_list_product());
});

function alter_product_make_list_product(){
  var str;
  for (i = 0; i< list_product.length; ++i){
    str = "";

    for (j=0; j< ALTER_PRODUCT_ROW.length; ++j){
      var row = ALTER_PRODUCT_ROW[j]; 
      
      row = row.replace(new RegExp("%ID%", 'g'), i);
      
      str += row;
    }
  }
  alert(str);
  return;
}

function alter_product_observe(source, id){
    var bought_price= parseFloat($("#alter-product"+ id + "-bought").val());
    var percentage = parseFloat($("#alter-product" + id + "-percentage").val());
    var sale =parseFloat($("#alter-product"+ id + "-sale").val());
    if (isNaN(sale))
      $("#alter-product"+ id + "-sale").val(0);
    
    switch (source) {
      case 0:
      case 1:
        if (!isNaN(percentage) && !isNaN(bought_price)){
          $("#alter-product"+ id + "-sale").val( bought_price *percentage/100);
        }
        break;
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
}