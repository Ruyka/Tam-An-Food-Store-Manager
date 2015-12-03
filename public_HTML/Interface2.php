<?php include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

<!doctype html>
<html>

<?php require_once(VIEW_PATH . "head.php");?>
<style>
	#qlmh {
		float: left;
		width: 50%;
	}
	.verticalLine {
    border-right: 1px solid black;
	height: 100%;
	}
	td {
		padding:0 15px 0 15px;
		
		
	}
	p {
		padding:15px 0 0 15px;
	}
	<!--tr.row2 td {
    padding-top: 40px; -->
}

</style>
<body>
<?php require_once(VIEW_PATH."header.php");?>
	
	<div id="qlmh" class="verticalLine">
		<form method="post" action=<?php echo CONFIG_PATH('view')."switch_task.php";?>>
			<select name="task1" style="margin:10px;">
				<option value="1">In hóa đơn</option>
				<option value="2">Quản lý nhập</option>
				<option value="3">Quản lý dư</option>
				</select>			
		</form>
		
		
		
		<table>
			
			<tr class="row1"><td>Thêm mới:</td><td> <button type="button">+1</button> </td> <td> <button type="button">Hàng loạt từ file</button> </td>

		</table>
		
		<table>
			<tr class="row2"><td>Tra cứu</td><td> <input type="text" placeholder="Lọc|"/> </td> <td padding-right:"0px"> <input type="text" placeholder="Tìm..." /> </td> <td padding-left:"0px"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button> </td>

		</table>
		<p> Kết Quả </p>
		<div contenteditable="true">
		<table class="table table-striped table-bordered" id="tb1">
			<tr ><th contenteditable="false">STT</th><th contenteditable="false"> Tên </th><th contenteditable="false"> Giá mua </th><th contenteditable="false"> % Chi phí </th><th contenteditable="false"> Giá bán </th><th contenteditable="false"> <input type="checkbox" onClick="toggle(this)" /> Toggle All<br/>  </th> </tr>
			<tr><td contenteditable="false">1</td><td contenteditable="true">Lọc xanh</td><td></td><td></td><td>20.000</td><td><input type="checkbox" name="foo" value="bar1"><br/></td>
			<tr><td contenteditable="false">2</td><td>Lọc đỏ</td><td></td><td></td><td>10.000</td><td><input type="checkbox" name="foo" value="bar1"><br/></td>
			<tr><td contenteditable="false">3</td><td>Bột lọc</td><td>10.000</td><td>150</td><td>15.000</td><td><input type="checkbox" name="foo" value="bar1"><br/></td>
			<tr><td contenteditable="false">4</td><td>Cá lóc</td><td></td><td></td><td>5.000</td><td><input type="checkbox" name="foo" value="bar1"><br/></td>

			
		</table>
		</div>
		
		<table>
			
			<tr ><td>Hành động:</td><td> <button type="button">Xóa mục đã chọn</button> </td> <td> <button type="button">Xuất file</button> </td>

		</table>
		
		<script language="JavaScript">
function toggle(source) {
  checkboxes = document.getElementsByName('foo');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>



		
		
	</div>
	<div id="fuck">
	
		<form method="post" action=<?php echo CONFIG_PATH('view')."switch_task.php";?>>
			<select name="task1" style="margin:10px;">
				<option value="1">In hóa đơn</option>
				<option value="2">Quản lý nhập</option>
				<option value="3">Quản lý dư</option>
				</select>			
		</form>
	</div>
	
</body>
</html>