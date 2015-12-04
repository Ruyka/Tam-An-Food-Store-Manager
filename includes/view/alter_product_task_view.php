<?php require_once($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');?>
<script type="text/javascript" src="<?php echo CONFIG_PATH('js')."alter_product_function.js"; ?>"></script>
<!-- use 1 table to display Add more Product and Search-->
<div class="table-responsive"> 
	<table class="table">
		<tr>
			<td class= "cell-title">Thêm mới:</td>
			<td> 
				<button type="button" id= "add_one_more_product" class="btn btn-primary" 
						data-toggle="modal" data-target="#add_one_product_modal" tabindex="-1">
					<span class="glyphicon glyphicon-plus"></span>
					1
				</button> 
				<button type="button" class="btn btn-primary" tabindex="-1">Hàng loạt từ file</button> 
			</td>
		</tr>
		<tr>
			<td class= "cell-title">Tra cứu:</td>
			<td> <input type="text" id ="product-search" placeholder="Lọc" style="width:100%;font-size: 15px;padding:5px;"/> </td> 
			<td> 
				<button style="font-size = 10px"class="btn btn-default" tabindex="-1" onclick="alter_product_search_product()">
				Tìm <span class="glyphicon glyphicon-search" ></span></button> 
			</td>
		</tr>
	</table>
</div>

<!-- THis table hold the result of searching-->
<p class= "cell-title"> Kết Quả </p>
<div class="table-responsive restrict-table-area"> 

	<table id="product-table" class="table sortable table-striped table-bordered  table-fixed " >
		<thead>
		<tr class="success">
			
			<th id="alter-product-id-column" class="sorttable_numeric">STT
				<span class="glyphicon glyphicon-arrow-up" onclick="alter_product_sort('ASC','alter-product-id-column')" ></span><span class="glyphicon glyphicon-arrow-down" onclick="alter_product_sort('DESC','alter-product-id-column')" ></span> 
			</th>
				
			<th id="alter-product-name-column">Tên
				<span class="glyphicon glyphicon-arrow-up" onclick="alter_product_sort('ASC','alter-product-name-column')" ></span><span class="glyphicon glyphicon-arrow-down" onclick="alter_product_sort('DESC','alter-product-name-column')" ></span> 
			</th>

			<th class="sorttable_numeric" id="alter-product-bought-column">Giá mua
				<span class="glyphicon glyphicon-arrow-up" onclick="alter_product_sort('ASC','alter-product-bought-column')" ></span><span class="glyphicon glyphicon-arrow-down" onclick="alter_product_sort('DESC','alter-product-bought-column')" ></span> 
			</th>
			
			<th class="sorttable_numeric" id="alter-product-percentage-column">% Chi phí
				<span class="glyphicon glyphicon-arrow-up" onclick="alter_product_sort('ASC','alter-product-percentage-column')" ></span><span class="glyphicon glyphicon-arrow-down" onclick="alter_product_sort('DESC','alter-product-percentage-column')" ></span> 
			</th>
			
			<th class="sorttable_numeric" id="alter-product-sale-column">Giá bán
				<span class="glyphicon glyphicon-arrow-up" onclick="alter_product_sort('ASC','alter-product-sale-column')" ></span><span class="glyphicon glyphicon-arrow-down" onclick="alter_product_sort('DESC','alter-product-sale-column')" ></span> 
			</th>
			<th class="sorttable_nosort"> <input type="checkbox" tabindex="-1" onClick="toggle(this)" /></th> </tr>
		</thead>
		
		<tbody id="alter-product-list">
			
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

<!-- press add one more and toogle this-->
<div class="modal fade" id="add_one_product_modal" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Preview</h4>
				</div>
				
				<div class="modal-body">
					<div class="table-responsive"> 

						<table id="product-table" class="table sortable table-striped table-bordered  table-fixed " >
							<thead>
								<tr class="success"><th>Tên</th><th >Giá mua</th><th>% Chi phí</th><th>Giá bán</th></tr>
							</thead>
							
							<tbody>
								<tr>
									<td><input class="form-control product-list" id="modal-focus" ></td>
									<td><input class="form-control" ></td>
									<td><input class="form-control" ></td>
									<td><input class="form-control" ></td>
								</tr>
							</tbody>
						</table>

					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal">Thêm</button>
					<button type="button" class="btn btn-info" data-dismiss="modal">Hủy Bỏ</button>
				</div>
			</div>

		</div>
	</div>
</div>
	



	<script language="JavaScript">
	function toggle(source) {
		checkboxes = document.getElementsByName('foo');
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
		}
	}
	</script>