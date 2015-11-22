<?php require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

<?php require_once(FUNCTION_PATH. "receipt_function.php"); ?>
<!-- Receipt task view -->
<div class="receipt-view">
	<form id="receipt-form" method="post" role="form">
		<div class="form-group">
			<input type="button" value="Print" id="print" class="btn btn-primary pull-right bigBtn" tabindex="-1">
			<input type="button" value="Preview" id="preview" class="btn btn-primary pull-right bigBtn" tabindex="-1">
			<input type="button" value="Cancel" id="cancel" class="btn btn-primary pull-right bigBtn" tabindex="-1">
			<p class="clear"></p>		
		</div>
		<!-- select2  -->
		<table id="receipt-product-list" class="table table-striped table-bordered">
			<tr class="success"><th>Product</th><th>Quantity</th><th>Price per product</th><th>Total</th><th></th></tr>
			<tr id="receipt-row1" class="receipt-row">
				<!-- product list -->
				<td><select id="product"  class="product-list form-control" name="product" onchange="observe_change('')"></select></td>
				<!-- quantity -->
				<td><input id="product_quantity" class="form-control" name="product_quantity" onchange="observe_change('')" type="number" min="0" placeholder="Số lượng"></td>
				<!-- price each -->
				<td><p id="product_price" class="product-price form-control">Product Price</p></td>
				<!-- total price -->
				<td><p id="product_total" class="total-price form-control">Total price</p></td>
				<!-- add/remove button -->
				<td><p id="add"></p></td>
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
