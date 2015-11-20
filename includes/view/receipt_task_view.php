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
		<table id="receipt-product-list">
			<tr id="receipt-row1" class="receipt-row">
				<!-- auto increment -->
				<td class="row-auto-increment">1</td>
				<!-- product list -->
				<td><select name="product1" class="product-list"></select></td>
				<!-- price each -->
				<td><p name="product1_price" class="product-price">Product Price</p></td>
				<!-- quantity -->
				<td><input name="product1_quantity" type="number" min="0" placeholder="Số lượng"></td>
				<!-- total price -->
				<td><p name="product1_total" class="total-price">Total price</p></td>
				<!-- add/remove button -->
				<td><button id="b1" class="btn add-more" type="button">+</button></td>
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
