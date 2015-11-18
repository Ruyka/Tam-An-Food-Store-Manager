<?php include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

<!doctype html>
<html>

<?php require_once(VIEW_PATH . "head.php");?>
<body>
	<script type="text/javascript">
		// on document ready load default task
		$(document).ready(function(){
			$("#task1").parent().find("div.load").load('<?php echo CONFIG_PATH("view")."receipt_task_view.php"; ?>');
			$("#task2").parent().find("div.load").load('<?php echo CONFIG_PATH("view")."receipt_task_view.php"; ?>');
			});
		// Switch task upon selected task in select
		function switch_task(task_id) {
			var task = document.getElementById(task_id);
			var val = task.value;

			if(val == "receipt")
				$("#"+task_id).parent().find("div.load").load('<?php echo CONFIG_PATH("view")."receipt_task_view.php"; ?>');
			else 
				$("#"+task_id).parent().find("div.load").load('<?php echo CONFIG_PATH("view")."blank.php"; ?>');
		}
		</script>
		<div class="khung"> 
			<?php require_once(VIEW_PATH."header.php");?>
			<?php require_once(FUNCTION_PATH."print_receipt.php");?>
			<div class="TacVu">
				<select id="task1" onchange="switch_task('task1')" style="margin:10px;">
					<option value="receipt">In hóa đơn</option>
					<option value="2">Quản lý nhập</option>
					<option value="3">Quản lý dư</option>
				</select>	
				<div class="load"></div>		
			</div>

			<div class="TacVu">
				<select id="task2" onchange="switch_task('task2')" style="margin:10px;">
					<option value="receipt">In hóa đơn</option>
					<option value="2">Quản lý nhập</option>
					<option value="3">Quản lý dư</option>
				</select>
				<div class="load"></div>	
			</div>
		</div>
	</body>
	</html>