<?php 
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] . 'Tam-An-Food-Store-Manager/'. 'config.php'); 

?>

<script type="text/javascript" src="<?php echo CONFIG_PATH('js')."receipt_function.js"; ?>"></script>


<div class="receipt-view">

	<form id="receipt-form" method="post" role="form">

		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar2" >
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar black-icon-bar"></span>
			<span class="icon-bar black-icon-bar"></span>
			<span class="icon-bar black-icon-bar"></span>   
		</button>

		<div class="form-group collapse navbar-collapse navbar2" style ="padding:0;">

			<input type="button" value="In" onclick="print_button()" id="print" class="btn btn-primary pull-right bigBtn" tabindex="-1">
			<input type="button" value="Xem trước" onclick="preview_button()" id="preview" class="btn btn-primary pull-right bigBtn" data-toggle="modal" data-target="#preview_modal" tabindex="-1">
			<input type="button" value="Xóa" id="cancel" class="btn btn-primary pull-right bigBtn" tabindex="-1">

		</div>

		<div class="table-responsive"> 
			<table id="receipt-product-list" class="table table-striped table-bordered">
				<thead><tr class="success"><th>Sản phẩm</th><th>Số lượng</th><th>VND / sản phẩm</th><th>Tổng cộng</th><th></th></tr></thead> 
				<tbody>
					<tr id="receipt-row">

						<td><select id="product" class="receipt-product-list form-control" name="product" onchange="observe_change('')"></select></td>

						<td id="td_quantity"><input id="product_quantity" class="receipt-product-quantity form-control" name="product_quantity" onfocus="observe_change('')" onchange="observe_change('')" type="number" min="0" value="0" placeholder="Số lượng"></td>

						<td><p id="product_price" class="receipt-product-price form-control">Product Price</p></td>

						<td><p id="product_total" class="receipt-product-total form-control">Total price</p></td>

						<td><button id="add" class="btn btn-default btn-add form-control" tabindex="-1" style="opacity:0"<span class="glyphicon glyphicon-plus"></span></button></td>
					</tr>
				</tbody>
				<tfoot >
					<tr class="table-footer-row">
						<td colspan="3" style="text-align:right"><p>Thành tiền</p></td><td><p id="Total_all" class="product-total form-control"></p></td><td><input  class="hide" type="checkbox" name="VAT" value="VAT"><span  class="hide"receipt->VAT</span></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</form>


	<div class="modal fade" id="preview_modal" role="dialog">
		<div class="modal-dialog">


			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Xem trước</h4>
				</div>
				
				<div class="modal-body">
					<div id="preview_section"></div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-info" data-dismiss="modal" onclick="preview_print()">Print</button>
				</div>
			</div>

		</div>
	</div>
</div>
