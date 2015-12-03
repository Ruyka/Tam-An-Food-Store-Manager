<?php require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');?>

<table class="sortable table">

	<tr class="row1">
		<td style ="font-weight: bold;">Thêm mới:</td>
		<td> 
			<button type="button" class="btn btn-primary">
				<span class="glyphicon glyphicon-plus"></span>
				1
			</button> 
			<button type="button" class="btn btn-primary">Hàng loạt từ file</button> 
		</td>
	</tr>
	<tr class="row2">
		<td>Tra cứu</td>
		<td> <input type="text" placeholder="Lọc" style="width:100%"/> </td> 
		<td> 
			<button type="submit" class="btn btn-default">
			Tìm danh sách <span class="glyphicon glyphicon-search"></span></button> 
		</td>
	</tr>
</table>

<p> Kết Quả </p>
<div contenteditable="true">
	<table class="table table-striped table-bordered" id="tb1">
		<tr >
			<th contenteditable="false">STT</th>
			<th contenteditable="false"> Tên </th>
			<th contenteditable="false"> Giá mua </th>
			<th contenteditable="false"> % Chi phí </th>
			<th contenteditable="false"> Giá bán </th>
			<th contenteditable="false"> <input type="checkbox" onClick="toggle(this)" /> Toggle All<br/>  </th> 
		</tr>
		<tr>
			<td contenteditable="false">1</td>
			<td contenteditable="true">Lọc xanh</td>
			<td></td><td></td><td>20.000</td>
			<td><input type="checkbox" name="foo" value="bar1"><br/></td>
		<tr>
			<td contenteditable="false">2</td>
			<td>Lọc đỏ</td>
			<td></td><td></td><td>10.000</td>
			<td><input type="checkbox" name="foo" value="bar1"><br/></td>
		</tr>
		<tr>
			<td contenteditable="false">3</td>
			<td>Bột lọc</td>
			<td>10.000</td>
			<td>150</td>
			<td>15.000</td>
			<td><input type="checkbox" name="foo" value="bar1"><br/></td>
		</tr>
		<tr>
			<td contenteditable="false">4</td>
			<td>Cá lóc</td>
			<td></td><td></td><td>5.000</td>
			<td><input type="checkbox" name="foo" value="bar1"><br/></td>
		</tr>

	</table>
	</div>

		<table>

			<tr >
				<td>Hành động:</td>
				<td> <button type="button">Xóa mục đã chọn</button> </td> 
				<td> <button type="button">Xuất file</button> </td>
			</tr>
		</table>

	<script language="JavaScript">
	function toggle(source) {
		checkboxes = document.getElementsByName('foo');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
		}
	}
	</script>