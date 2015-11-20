<?php require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

<?php require_once(FUNCTION_PATH. "receipt_function.php"); ?>
<!-- Receipt task view -->
<div class="receipt-view">
	<form id="myform" action="" method="post" onsubmit="callModal">
		<input type="submit" value="Print" class="btn btn-primary pull-right bigBtn">
		<input type="submit" value="Preview" class="btn btn-primary pull-right bigBtn">
		<input type="submit" value="Cancel" class="btn btn-primary pull-right bigBtn" >
		<p class="clear"></p>
		<!-- select2  -->
		<table id="receipt-product-list" class="table table-striped table-bordered">
			<tr class="success"><th>Product</th><th>Price per product</th><th>Quantity</th><th>Total</th><th></th></tr>
			<tr id="receipt-row1" class="receipt-row">
				<!-- product list -->
				<td><select name="product" class="product-list"></select></td>
				<!-- price each -->
				<td><p name="product_price" class="product-price">Product Price</p></td>
				<!-- quantity -->
				<td><input name="product_quantity" type="number" min="0" placeholder="Số lượng"></td>
				<!-- total price -->
				<td><p name="product_total" class="total-price">Total price</p></td>
				<!-- add/remove button -->
				<td><button id="add" class="btn btn-success btn-add" type="button" onclick="add_more('add')"><span class="glyphicon glyphicon-plus"></span></button></td>
				<!-- add/remove button -->
				<td></td>
			</tr>
		</table>
	</form>

	<!-- Modal -->
	<div class="modal fade" id="preview" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Preview</h4>
				</div>
				<form class="form-horizontal" role="form" method="post" action="">
					<div class="modal-body">				
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</form>
			</div>

		</div>
	</div>

</div>
