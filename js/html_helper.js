	// generate new row
    // perform by manually add html codes in variable and piece it together
    var product = '<td><select id="product%ID%" class="product-list form-control" name="product%ID%" onchange="observe_change(\'%ID%\')"></select></td>';
    // make input quantity
    var quantity = '<td><input id="product%ID%_quantity" class="form-control" name="product%ID%_quantity" onfocus="observe_change(\'%ID%\')" onchange="observe_change(\'%ID%\')" style="width: 80px" type="number" min="0" value="0" placeholder="Số lượng"></td>';
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
    // receipt first row
    var receipt_dashed_row = "<tr><td class='tri_dashed_line'>%OBJECT1%</td><td class='tri_dashed_line'>%OBJECT2%</td><td class='tri_dashed_line'>%OBJECT3%</td></tr>";
    // receipt row
    var receipt_row = "<tr><td>%OBJECT1%</td><td>%OBJECT2%</td><td>%OBJECT3%</td></tr>";
    // receipt information table
    // temp: "<table><tr><td><b>Địa Chỉ: </b></td><td>%ADDRESS%</td></tr><tr><td><b>Điện thoại: </b></td><td>%TEL%</td></tr><tr><td><b>Hóa đơn số: </b></td><td>%RECEIPTID%</td></tr><tr><td><b>Ngày: </b></td><td>%DATE%  %TIME%</td></tr><tr><td><b>Thu ngân: </b></td><td>%CASHIER%</td></tr></table>"
    var receipt_info_table = "<table><tr><td><b>Địa Chỉ: </b></td><td>%ADDRESS%</td></tr><tr><td><b>Điện thoại: </b></td><td>%TEL%</td></tr><tr><td><b>Ngày: </b></td><td>%DATE%  %TIME%</td></tr><tr><td><b>Thu ngân: </b></td><td>%CASHIER%</td></tr></table>";
    // thank you quote
    var receipt_thanks = "<br /><p><b> Cám ơn và hẹn gặp lại! </b></p>";
    // scaled logo
    var scaled_logo = "<img src='scaled_logo.jpg' id='tri_img' />";