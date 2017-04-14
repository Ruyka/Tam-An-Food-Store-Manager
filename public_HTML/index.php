<?php 
	include($_SERVER["DOCUMENT_ROOT"] . 'Tam-An-Food-Store-Manager/'. 'config.php');
	require_once(FUNCTION_PATH. "general_function.php");
	//first when going to home page
	//we check if user is login or not. if not go to login page
	// if a login of user has sucess or the user is not log out in the previous time
	// get the User Info to GLOBal variable
	if (isset($_SESSION['is_login'])){
		$USER_NAME = $_SESSION['username'];
		$ID = $_SESSION['user_id'];
	}
	else {
		redirect_to(CONFIG_PATH('public_HTML')."login/");
	}
?>

<!doctype html>
<html>

<?php require_once(VIEW_PATH . "head.php");?>
<style type="text/css">
	.main-screen:before{	
	  background-image: url("<?php echo CONFIG_PATH('image').'test3.jpg'; ?>");
	}
</style>

<body >		
	<div class="no-print main-screen"> 
		<?php require_once(VIEW_PATH."header.php");?>

		<div id ="loadpanel1" class="container">
			
			<div class="inner-content">
				<select id="task1" tabindex="-1" class="form-control " onchange="switch_task(1)">
					<option value="receipt">In hóa đơn</option>
					<option value="alter-product">Chỉnh sửa sản phẩm</option>
				</select>	

				<div id="load1">
					
				</div>		
			</div>
		</div>
	</div>
	<div  class="no-print">
		<!-- make a toast here -->
		<div id="toast" style="display:none">Toast event</div>			
	</div>
	<!-- Only the latest submit print is accepted  -->
	<div id="print_here" class="print-blocks">IF YOU SEE THIS THEN PRINT FUNCTION IS NOT WORKING</div>
</body>
</html>