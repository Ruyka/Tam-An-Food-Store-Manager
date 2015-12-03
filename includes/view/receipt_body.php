
<form id="receipt-form%TASK%" method="post" role="form">
	<input type="hidden">

	<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar2" >
		<span class="sr-only">Toggle navigation</span>
		<span class="icon-bar black-icon-bar"></span>
		<span class="icon-bar black-icon-bar"></span>
		<span class="icon-bar black-icon-bar"></span>   
	</button>

	<div class="form-group collapse navbar-collapse navbar2" style ="padding:0;">

		<input type="button" value="In" 		onclick="print_button(\'%TASK%\')" 	id="print%TASK%" 	class="btn btn-primary pull-right bigBtn" tabindex="-1">
		<input type="button" value="Xem trước" 	onclick="preview_button(\'%TASK%\')" 	id="preview%TASK%" 	class="btn btn-primary pull-right bigBtn" data-toggle="modal" data-target="#preview_modal%TASK%" tabindex="-1">
		<input type="button" value="Xóa" 									id="cancel%TASK%" 	class="btn btn-primary pull-right bigBtn" tabindex="-1">

	</div>

	<div class="table-responsive"> 
		<table class="sortable table table-striped table-bordered receipt-product-list">
			<thead><tr class="success"><th>Sản phẩm</th><th class="sorttable_numeric">Số lượng</th><th>VND / sản phẩm</th><th>Tổng cộng</th><th></th></tr></thead> 
			<tbody>
				<tr id="receipt-row%TASK%">

					<td><select id="product%TASK%" class="product-list form-control" name="product" onchange="observe_change('%TASK%')"></select></td>

					<td><input id="product_quantity%TASK%" class="form-control" name="product_quantity" onfocus="observe_change(\'%TASK%\')" onchange="observe_change(\'%TASK%\')" type="number" min="0" value="0" placeholder="Số lượng" style="width: 80px"></td>
					
					<td><p id="product_price%TASK%" class="product-price form-control">Product Price</p></td>

					<td><p id="product_total%TASK%" class="total-price form-control">Total price</p></td>

					<td><button id="add%TASK%" class="btn btn-default btn-add form-control" tabindex="-1" style="opacity:0"<span class="glyphicon glyphicon-plus"></span></button></td>
				</tr>
			</tbody>
			<tfoot >
				<tr class="table-footer-row">
					<td colspan="4" style="text-align:right"><p>Thành tiền</p></td><td><p id="Total_all%TASK%" class="total-price form-control"></p></td>
				</tr>
			</tfoot>
		</table>
	</div>
</form>


<div class="modal fade" id="preview_modal%TASK%" role="dialog">
	<div class="modal-dialog">


		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Preview</h4>
			</div>

			<div class="modal-body">
				<div id="preview_section%TASK%"></div>
			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-info" data-dismiss="modal" onclick="preview_print()">Print</button>
			</div>
		</div>

	</div>
</div>