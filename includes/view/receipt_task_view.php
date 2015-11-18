<div class="receipt-view">
	<form id="myform" action="" method="post" onsubmit="callModal">
		<input type="submit" value="Print" class="btn btn-primary pull-right bigBtn">
		<input type="submit" value="Preview" class="btn btn-primary pull-right bigBtn">
		<input type="submit" value="Cancel" class="btn btn-primary pull-right bigBtn" >
		<p class="clear"></p>
		<!-- select2  -->
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

