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
			<td> <input type="text" id ="product-search" placeholder="Tìm Kiếm" onkeydown =""style="width:100%;font-size: 15px;padding:5px;"/> </td> 
			<td> 
				<button style="font-size = 10px"class="btn btn-default" tabindex="-1" onclick="alter_product_search_product()">
				Tìm <span class="glyphicon glyphicon-search" ></span></button> 
			</td>
		</tr>
	</table>
</div>

<!-- THis table hold the result of searching-->
<div id ="alter-product-search-area">
	<p class= "cell-title" style="margin-bottom:30px"> Kết Quả 
		<button id ="alter_product_change_btn" style="float:right" type="button" class="btn btn-default" onclick ="alter_product_show('change')" tabindex="-1">Xem thay đổi</button>
		<button id ="alter_product_search_btn" style="float:right" type="button" class="btn btn-default" onclick ="alter_product_show('search')" tabindex="-1">Xem tìm kiếm</button>
	</p>
	<div class="break"> </div>
	<div class="table-responsive restrict-table-area"> 
		
		<table id="product-table" class="table sortable table-striped table-bordered  table-fixed " >
			<thead>
			<tr class="success">
				
				<th id="alter-product-id-column" class="sorttable_numeric">STT
					<span class="glyphicon glyphicon-arrow-up btn btn-small sort-button"  onclick="alter_product_sort('ASC','alter-product-id-column')" ></span><span class="glyphicon glyphicon-arrow-down btn btn-small sort-button" onclick="alter_product_sort('DESC','alter-product-id-column')" ></span> 
				</th>
					
				<th id="alter-product-name-column">Tên
					<span class="glyphicon glyphicon-arrow-up btn btn-small sort-button" onclick="alter_product_sort('ASC','alter-product-name-column')" ></span><span class="glyphicon glyphicon-arrow-down btn btn-small sort-button" onclick="alter_product_sort('DESC','alter-product-name-column')" ></span> 
				</th>

				<th class="sorttable_numeric" id="alter-product-bought-column">Giá mua
					<span class="glyphicon glyphicon-arrow-up btn btn-small sort-button" onclick="alter_product_sort('ASC','alter-product-bought-column')" ></span><span class="glyphicon glyphicon-arrow-down btn btn-small sort-button" onclick="alter_product_sort('DESC','alter-product-bought-column')" ></span> 
				</th>
				
				<th class="sorttable_numeric" id="alter-product-percentage-column">% Chi phí
					<span class="glyphicon glyphicon-arrow-up btn btn-small sort-button" onclick="alter_product_sort('ASC','alter-product-percentage-column')" ></span><span class="glyphicon glyphicon-arrow-down btn btn-small sort-button" onclick="alter_product_sort('DESC','alter-product-percentage-column')" ></span> 
				</th>
				
				<th class="sorttable_numeric" id="alter-product-sale-column">Giá bán
					<span class="glyphicon glyphicon-arrow-up btn btn-small sort-button" onclick="alter_product_sort('ASC','alter-product-sale-column')" ></span><span class="glyphicon glyphicon-arrow-down btn btn-small sort-button" onclick="alter_product_sort('DESC','alter-product-sale-column')" ></span> 
				</th>
				<th class="sorttable_nosort" style="padding-bottom:10px"> <input type="checkbox" style="width:40px;" tabindex="-1" onClick="toggle(this)" /></th> 
				<th class="sorttable_nosort" style="width:100px; padding-bottom:20px"> Hành Động </th></tr>
			</thead>
			
			<tbody id="alter-product-list">
				
			</tbody>
		</table>
		<div id = "not-found">
			
		</div>
	</div>

	<div class="table-responsive" > 
		<table class="table">

			<tr style="margin-top:20px;">
				<td class= "cell-title" style ="width:150px">Hành động:</td>
				<td>
					<button id ="alter_product_remove_btn" type="button" class="btn btn-primary" 
							onclick ="confirm('Xóa sản phẩm này khỏi danh sách? (Không thể phục hồi)');alter_product_remove_item();" tabindex="-1">Xóa mục đã chọn</button> 
					<button type="button" class="btn btn-primary" tabindex="-1">Xuất file</button>
					
					<button type="button" class="btn btn-primary" onclick ="save_data()" tabindex="-1">Lưu</button>
				</td>
				
			</tr>
		</table>

	</div>
</div>
<!-- press add one more and toogle this-->
<div class="modal fade" id="add_one_product_modal" role="dialog">
		<div class="modal-dialog">

			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Thêm Mới</h4>
				</div>
				
				<div class="modal-body">
					<div class="table-responsive"> 

						<table id="product-table" class="table sortable table-striped table-bordered  table-fixed " >
							<thead>
								<tr class="success"><th>Tên</th><th >Giá mua</th><th>% Chi phí</th><th>Giá bán</th></tr>
							</thead>
							
							<tbody>
								<tr>
									<td><input id ="alter-product-add-name" class="form-control product-list" id="modal-focus" ></td>
									<td><input id ="alter-product-add-bought" class="form-control" ></td>
									<td><input id ="alter-product-add-percentage" class="form-control" ></td>
									<td><input id ="alter-product-add-sale" class="form-control" ></td>
								</tr>
							</tbody>
						</table>

					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-info" data-dismiss="modal" 
							onclick="add_one_product();alter_product_show('change');restore();">Thêm</button>
					<button type="button" class="btn btn-info" data-dismiss="modal"
							onclick="restore();">Hủy Bỏ</button>
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