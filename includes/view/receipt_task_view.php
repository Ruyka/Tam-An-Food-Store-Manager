<?php require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

<script type="text/javascript" src="<?php echo CONFIG_PATH('js')."receipt_function.js"; ?>"></script>
<!-- Receipt task view -->
<div class="receipt-view">
	<form id="receipt-form" action="<?php echo CONFIG_PATH('function').'process_submit.php'; ?>" method="post" role="form">
		<div class="form-group">
			<input type="button" value="Print" onclick="print_button()" id="print" class="btn btn-primary pull-right bigBtn" tabindex="-1">
			<input type="button" value="Preview" onclick="preview_button()" id="preview" class="btn btn-primary pull-right bigBtn" data-toggle="modal" data-target="#preview_modal" tabindex="-1">
			<input type="button" value="Clear" id="cancel" class="btn btn-primary pull-right bigBtn" tabindex="-1">
			<p class="clear"></p>		
		</div>
		<!-- select2  -->
		<table id="receipt-product-list" class="table table-striped table-bordered">
			<tr class="success"><th>Sản phẩm</th><th>Số lượng</th><th>VND / sản phẩm</th><th>Tổng cộng</th><th></th></tr>
			<tr id="receipt-row">
				<!-- product list -->
				<td><select id="product"  class="product-list form-control" name="product" onchange="observe_change('')"></select></td>
				<!-- quantity -->
				<td><input id="product_quantity" class="form-control" name="product_quantity" onfocus="observe_change('')" onchange="observe_change('')" type="number" min="0" value="0" placeholder="Số lượng"></td>
				<!-- price each -->
				<td><p id="product_price" class="product-price form-control">Product Price</p></td>
				<!-- total price -->
				<td><p id="product_total" class="total-price form-control">Total price</p></td>
				<!-- add/remove button -->
				<td><button id="add" class="btn btn-default btn-add form-control" tabindex="-1" style="opacity:0"<span class="glyphicon glyphicon-plus"></span></button></td>
			</tr>
			<tr>
				<td></td><td></td><td><p>Thành tiền</p></td><td><p id="Total_all" class="total-price form-control"></p></td><td></td>
			</tr>
		</table>
	</form>

	<!-- Modal -->
	<div class="modal fade" id="preview_modal" role="dialog">
		<div class="modal-dialog">

			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Preview</h4>
				</div>
				
				<div class="modal-body">
					<div id="preview_section"></div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-info" data-dismiss="modal" onclick="print_button()">Print</button>
				</div>
			</div>

		</div>
	</div>

	<!-- make a toast here -->
	<div id="toast" style="display:none">Toast event</div>
</div>
