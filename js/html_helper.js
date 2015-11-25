	// generate new row
    // perform by manually add html codes in variable and piece it together
	var product = '<td><select id="product%ID%" class="product-list form-control" name="product%ID%" onchange="observe_change(\'%ID%\')"></select></td>';
    // make input quantity
    var quantity = '<td><input id="product%ID%_quantity" class="form-control" name="product%ID%_quantity" onfocus="observe_change(\'%ID%\')" onchange="observe_change(\'%ID%\')" type="number" min="0" value="0" placeholder="Số lượng"></td>';
    // price of product
    var price  = '<td><p id="product%ID%_price" class="product-price form-control">Product Price</p></td>';
    // total price
    var total = '<td><p id="product%ID%_total" class="total-price  form-control">Total price</p></td>';
    // add button (guess it's not need now) lol :v
    var button = '<td><p id="add%ID%" class="btn btn-default btn-add form-control" tabindex="-1" style="opacity:0"><span class="glyphicon glyphicon-plus"></span></button></td>';
    // piece every thing together
    var row = '<tr id="receipt-row%ID%">' + product + quantity + price + total + button + '</tr>';
    // select option
    var html_option = "<option value=\'%VALUE%\'> %NAME% (%UNITNAME%)</option>";
    // print receipt row
    var receipt_row = "<tr><td>%QUANTITY%</td><td>%PRODUCT%</td><td>%PRICE%</td></tr>";