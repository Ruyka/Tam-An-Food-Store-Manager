<?php include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

<!doctype html>
<html>

<?php require_once(VIEW_PATH . "head.php");?>

<body>
	<?php require_once(VIEW_PATH."header.php");?>
	<div class="khung"> 
	<div class="row">
		<div class="TacVu col-md-6">
			<form method="post" action=<?php echo CONFIG_PATH('view')."switch_task.php";?>>
				<select name="task1" style="margin:10px;">
					<option value="1">In hóa đơn</option>
					<option value="2">Quản lý nhập</option>
					<option value="3">Quản lý dư</option>
				</select>
				<input type="submit" value="Check" />
			</form>
			<table class="table table-striped table-bordered" id="tb1">
			<tr class="success"><th>Name</th><th> Age </th> </tr>
			<tr><td>TriQuach</td><td> 20 </td>
			<tr class="danger"><td>KNThanh</td><td> 18 </td>
			<tr><td>HHPhat</td><td> 19 </td>
			
		</table>
		</div>

		<div class="TacVu col-md-6">
			<select name="task2" style="margin:10px;">
				<option value="1">In hóa đơn</option>
				<option value="2">Quản lý nhập</option>
				<option value="3">Quản lý dư</option>
			</select>

		</div>	
	</div>
</div>
</body>
</html>