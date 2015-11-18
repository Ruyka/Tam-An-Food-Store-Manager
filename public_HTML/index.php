<?php include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

<!doctype html>
<html>

<?php require_once(VIEW_PATH . "head.php");?>
<body>
	<script type="text/javascript">
	$(document).ready(function(){		
		var data = [{ id: 0, text: 'enhancement' }, { id: 1, text: 'bug' }, { id: 2, text: 'duplicate' }, { id: 3, text: 'invalid' }, { id: 4, text: 'wontfix' }];

		$(".js-example-data-array").select2({
			data: data
		});
	});
	</script>
	<div class="khung"> 
		<?php require_once(VIEW_PATH."header.php");?>
		<?php require_once(FUNCTION_PATH."print_receipt.php");?>
		<div class="TacVu">
			<select name="task1" method="post" style="margin:10px;">
				<option value="1">In hóa đơn</option>
				<option value="2">Quản lý nhập</option>
				<option value="3">Quản lý dư</option>
			</select>
			<form id="myform" action="" method="post" onsubmit="callModal">
				<input id="print" type="submit" value="Print" onclick="submit_now()" class="btn btn-primary pull-right bigBtn">
				<input type="submit" value="Cancel" class="btn btn-primary pull-right bigBtn" >
				<p class="clear"></p>
				<!-- select2  -->
				<select class="product "></select>
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
								<?php makePreview(); ?>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="TacVu">
		<select name="task2" style="margin:10px;">
			<option value="1">In hóa đơn</option>
			<option value="2">Quản lý nhập</option>
			<option value="3">Quản lý dư</option>
		</select>
	</div>
</body>
</html>