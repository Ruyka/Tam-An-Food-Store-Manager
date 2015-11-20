<?php include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

<!doctype html>
<html>

<?php require_once(VIEW_PATH . "head.php");?>

<body>
	<div class="container"> 
		<?php require_once(VIEW_PATH."header.php");?>
		<?php require_once(VIEW_PATH."print_receipt.php");?>

		<div class="TacVu">
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

		<div class="TacVu">
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
	</div>
	<p> fuck </p>
</body>
</html>