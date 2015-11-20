<?php include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

<!doctype html>
<html>

<?php require_once(VIEW_PATH . "head.php");?>
 <link href="css/bootstrap.min.css" rel="stylesheet">
 <style>
	.box {
		border: 1px solid grey;
		background-color:#d3d3d3
	}
	#tb1 {
		margin-top: 50px;
	}
</style>
<body>
	<div class="container"> 
		<?php require_once(VIEW_PATH."header.php");?>
		<?php require_once(VIEW_PATH."print_receipt.php");?>
	<div class="row">
		<div class="TacVu col-md-6 box">
			<form method="post" action=<?php echo CONFIG_PATH('view')."switch_task.php";?>>
				<select name="task1" style="margin:10px;">
					<option value="1">In hóa đơn</option>
					<option value="2">Quản lý nhập</option>
					<option value="3">Quản lý dư</option>
				</select>
				<input type="submit" value="Check" />
			</form>
			<form action="" method="post">
				<table>
					<?php 
					$num = $GLOBALS['defaultNum'];
					while($num--)
						createNew();
					?>
					<?php 
					$check = "product".strval($curNum-1);
					if(isset($_POST[$check]) != 'Chọn sản phẩm')
						createNew();
					?>
				</table>
				<input type="submit" name="submit" value="Submit" />
			</form>
		</div>

		<div class="TacVu col-md-6 box">
			<select name="task2" style="margin:10px;">
				<option value="1">In hóa đơn</option>
				<option value="2">Quản lý nhập</option>
				<option value="3">Quản lý dư</option>
			</select>
			<form action="" method="post">
				<table>
					<?php 
					$num = $GLOBALS['defaultNum'];
					while($num--)
						createNew();
					?>
					<?php 
					$check = "product".strval($curNum-1);
					if(isset($_POST[$check]) != 'Chọn sản phẩm')
						createNew();
					?>
				</table>
				<input type="submit" name="submit" value="Submit" />
			</form>
		</div>
		
		<table class="table table-striped table-bordered" id="tb1">
			<tr class="success"><th>Name</th><th> Age </th> </tr>
			<tr><td>TriQuach</td><td> 20 </td>
			<tr><td class="danger">KNThanh</td><td> 18 </td>
			<tr><td>HHPhat</td><td> 19 </td>
			
		</table>
		
		
	</div>
</div>
</body>
</html>