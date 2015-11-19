<!-- Javascript function here -->
<script type="text/javascript">
// Add new input field for the receipt
$(document).ready(function(){
	var next = 1;
	$(".add-more").click(function(e){
		e.preventDefault();
		var newAut = '<td class="row-auto-increment">'+(next+1)+'</td>';
		var newAuto = $(newAut);
		var newPL = '<td><select name="product'+next+'" class="product-list"></select></td>';
		var newProList = $(newPL);
		var newP = '<td><p name="product'+next+'_price" class="product-price">Product Price</p></td>';
		var newPrice = $(newP);
		var newQ = '<td><input name="product'+next+'_quantity" type="number" min="0" placeholder="Số lượng"></td>';
		var newQuantity = $(newQ);
		var newT = '<td><p name="product'+next+'_total" class="total-price">Total price</p></td>';
		var newTotal = $(newT);
		var addBtn = '<button id="b' + next + '" class="btn btn-danger add-more" >+</button></div><div id="field">';
		var addButton = $(addBtn);
		var newR = '<tr id="receipt-row'+next+'" class="receipt-row">' + newAuto + newProList + newPrice + newQuantity + newTotal + addButton + '</tr>';
		var newRow = $(newR);
		next = next + 1;

		$("#receipt-product-list").append(newRow);

		$('.remove-me').click(function(e){
			e.preventDefault();
			var fieldNum = this.id.charAt(this.id.length-1);
			var fieldID = "#field" + fieldNum;
			$(this).remove();
			$(fieldID).remove();
		});
	});
});
</script>


<!-- PHP function here -->
<?php 
	// Alter print div upon submition succesful
function make_print_section(){

}
?>