<?php 
include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
?>

<!doctype html>
<html>

<?php require_once(VIEW_PATH . "head.php");?>
<body>
	<script type="text/javascript">
		// on document ready load default task
		// might need cookie or chace in the near future
		$(document).ready(function(){
			$("#task1").parent().find("div.load").load('<?php echo CONFIG_PATH("view")."receipt_task_view.php"; ?>');
		});
		// Switch task upon selected task
		function switch_task(task_id) {
			var task = document.getElementById(task_id);
			var taskid = task_id.charAt(task_id.length-1);
			var val = task.value;

			if(val == "receipt")
				$("#"+task_id).parent().find("div.load").load('<?php echo CONFIG_PATH("view")."receipt_task_view.php"; ?>');
			else 
				$("#"+task_id).parent().find("div.load").load('<?php echo CONFIG_PATH("view")."blank.php"; ?>');
		}
		</script>
		<div class="khung no-print"> 
			<?php require_once(VIEW_PATH."header.php");?>
			<div id="TacVu1" class="TacVu col-md-6">
				<select id="task1" class="no-print" onchange="switch_task('task1')" style="margin:10px;">
					<option value="receipt">In hóa đơn</option>
					<option value="2">Quản lý nhập</option>
					<option value="3">Quản lý dư</option>
				</select>	

				<div class="load">IF YOU SEE THIS THEN SWITCH TASK FUNCTION IS NOT WORKING</div>		
			</div>

			<div id="TacVu1" class="TacVu col-md-6">
				<select id="task2" class="no-print" style="margin:10px;">
					<option value="receipt">In hóa đơn</option>
					<option value="2">Quản lý nhập</option>
					<option value="3">Quản lý dư</option>
				</select>
				<div class="load">THIS FUNCTION HAS NOT BEEN IMPLEMENTED</div>	
			</div>
		</div>
		<!-- Only the latest submit print is accepted  -->
		<div id="print_here" class="print-blocks">IF YOU SEE THIS THEN PRINT FUNCTION IS NOT WORKING</div>
	</body>
	</html>