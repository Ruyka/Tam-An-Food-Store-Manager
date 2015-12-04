<?php require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');?>
<script type="text/javascript" src="<?php echo CONFIG_PATH('lib')."sorttable.js"; ?>"></script>
<script type="text/javascript" src="<?php echo CONFIG_PATH('js')."alter_product_function.js"; ?>"></script>
<!-- use 1 table to display Add more Product and Search-->
<div class="table-responsive"> 
	<table class="table">
		<tr>
			<td class= "cell-title">Thêm mới:</td>
			<td> 
				<button type="button" class="btn btn-primary" tabindex="-1">
					<span class="glyphicon glyphicon-plus"></span>
					1
				</button> 
				<button type="button" class="btn btn-primary" tabindex="-1">Hàng loạt từ file</button> 
			</td>
		</tr>
		<tr>
			<td class= "cell-title">Tra cứu:</td>
			<td> <input type="text" placeholder="Lọc" style="width:100%;font-size: 15px;padding:5px;"/> </td> 
			<td> 
				<button style="font-size = 10px"class="btn btn-default" tabindex="-1">
				Tìm <span class="glyphicon glyphicon-search" ></span></button> 
			</td>
		</tr>
	</table>
</div>
<!-- THis table hold the result of searching-->
<p class= "cell-title"> Kết Quả </p>
<div class="table-responsive"> 

	<table id="product-table" class="table sortable table-striped table-bordered" >
		<thead>
		<tr class="success"><th>STT</th><th>Tên</th><th>Giá mua</th><th>% Chi phí</th><th>Giá bán</th><th class="sorttable_nosort"> <input type="checkbox" tabindex="-1" onClick="toggle(this)" /></th> </tr>
		</thead>
		<tbody id="alter-product-list">
			<tr>
				<td class="STT-product">1</td>
				<td><input id ="alter-product-name" class="form-control product-list" value = "Lọc xanh" style="width:100%; min-width:200px"></td>
				<td><input id ="alter-product-bought" class="form-control" style="width:100%; min-width:100px" onchange="alter_product_observe(0,'')"></td>
				<td><input id ="alter-product-percentage" class="form-control" style="width:100%; min-width:70px" onchange="alter_product_observe(1,'')"></td>
				<td><input id ="alter-product-sale" class="form-control" value = "20.000" style="width:100%; min-width:80px " onchange="alter_product_observe(2,'')"></td>
				<td><input type="checkbox" name="foo" value="bar1" style ="margin-top:10px;" tabindex="-1"><br/></td>
			</tr>
			
		</tbody>
	</table>

</div>
<div class="table-responsive"> 
	<table class="table">

		<tr >
			<td class= "cell-title">Hành động:</td>
			<td>
				<button type="button" class="btn btn-primary" tabindex="-1">Xóa mục đã chọn</button> 
				<button type="button" class="btn btn-primary" tabindex="-1">Xuất file</button>
				<button type="button" class="btn btn-primary" tabindex="-1">Lưu</button>
			</td>
		</tr>
	</table>

</div>

	<script language="JavaScript">
	function toggle(source) {
		checkboxes = document.getElementsByName('foo');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
		}
	}
	</script>