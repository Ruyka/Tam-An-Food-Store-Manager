<?php include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php'); ?>

<!doctype html>
<html>
    
    <?php require_once(VIEW_PATH . "head.php");?>
    
<body>
        <div id="container"> 
            <?php require_once(VIEW_PATH."header.php");?>	
            
            <div id="InHoaDon">
    			<input type="text" name="product" list="productName1" value="In hóa đơn" class="option2" />
    				<datalist id="productName1" >
    					<option value="Pen">Pen</option>
    					<option value="Pencil">Pencil</option>
    					<option value="Paper">Paper</option>
    				</datalist>
    			
                <p id="p4"> Người thu ngân
       				<input type="text" name="product" list="productName" value="qmtri(default)" />
        				<datalist id="productName" >
        					<option value="thtrieu">thtrieu</option>
        					<option value="vdvinh">vdvinh</option>
        					<option value="hhphat">hhphat</option>
        					<option value="knthanh">knthanh</option>	
        				</datalist>
       				<button onclick="myFunction()" id ="but1">Xem trước</button>
       				<button id ="but2">In</button>
       				<script>
      					function myFunction() {
     						alert("Hello! I am an alert box!");
      					}
       				</script>
    			</p>
    			
                <input type="text" name="product" list="productName1" value="Rau muống (bó)" class="option1" />
    				<datalist id="productName1" >
    					<option value="Pen">Pen</option>
    					<option value="Pencil">Pencil</option>
    					<option value="Paper">Paper</option>
    				</datalist>
    			<input type="NUMBER" min="0" max="100" step="2" value="6" size="6" class="option2">
    			
                <div class="break"> </div>
    			
                <input type="text" name="product" list="productName1" value="Cá hú (con)" class="option1"/>
    				<datalist id="productName1" >
    					<option value="Pen">Pen</option>
    					<option value="Pencil">Pencil</option>
    					<option value="Paper">Paper</option>
    				</datalist>
    			
                <input type="NUMBER" min="0" max="100" step="2" value="6" size="6" class="option2">	
    			
                <div class="break"> </div>
    			
                <input type="text" name="product" list="productName1" value="Thịt (kg)" class="option1"/>
    				<datalist id="productName1" >
    					<option value="Pen">Pen</option>
    					<option value="Pencil">Pencil</option>
    					<option value="Paper">Paper</option>
    				</datalist>
    			<input type="NUMBER" min="0" max="100" step="2" value="6" size="6" class="option2" >
    			
                <div class="break"> </div>
    			
                <input type="text" name="product" list="productName1" value="Sữa (lít)" class="option1" />
    				<datalist id="productName1" >
    					<option value="Pen">Pen</option>
    					<option value="Pencil">Pencil</option>
    					<option value="Paper">Paper</option>
    				</datalist>
    			<input type="NUMBER" min="0" max="100" step="2" value="6" size="6" class="option2">	
			
            </div>
    </div>

		
    <div id="QuanLy">
		<input type="text" name="product" list="productName1" value="Quản lý" class="option2" />
		  <datalist id="productName1" >
		      <option value="Pen">Pen</option>
		      <option value="Pencil">Pencil</option>
		      <option value="Paper">Paper</option>
		  </datalist>
		<p> book </p>
    </div>
		


</body>



</html>