<?php
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ตรวจสอบการเข้าสู่ระบบ
if (empty($_SESSION['member_id'])) {
	//ไปที่หน้า login
	gotopage('login.php?act=login_pls');
}
?>
<!DOCTYPE html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $shop_name; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon
		============================================ -->
		<link rel="shortcut icon" type="image/x-icon" href="img/K-Rich-Photoroom.png">
		<!-- Fonts
		============================================ -->
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,700,600,500,300,800,900' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,300,300italic,500italic,700' rel='stylesheet' type='text/css'>
 		<!-- CSS  -->
		<!-- Bootstrap CSS
		============================================ -->      
        <link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- font-awesome.min CSS
		============================================ -->      
        <link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Mean Menu CSS
		============================================ -->      
        <link rel="stylesheet" href="css/meanmenu.min.css">
		<!-- owl.carousel CSS
		============================================ -->      
        <link rel="stylesheet" href="css/owl.carousel.css">
		<!-- owl.theme CSS
		============================================ -->      
        <link rel="stylesheet" href="css/owl.theme.css">
		<!-- owl.transitions CSS
		============================================ -->      
        <link rel="stylesheet" href="css/owl.transitions.css">
		<!-- Price Filter CSS
		============================================ --> 
        <link rel="stylesheet" href="css/jquery-ui.min.css">	
		<!-- nivo-slider css
		============================================ --> 
		<link rel="stylesheet" href="css/nivo-slider.css">
 		<!-- animate CSS
		============================================ -->         
        <link rel="stylesheet" href="css/animate.css">
		<!-- jquery-ui-slider CSS
		============================================ --> 
		<link rel="stylesheet" href="css/jquery-ui-slider.css">
 		<!-- normalize CSS
		============================================ -->        
        <link rel="stylesheet" href="css/normalize.css">
        <!-- main CSS
		============================================ -->          
        <link rel="stylesheet" href="css/main.css">
        <!-- style CSS
		============================================ -->          
        <link rel="stylesheet" href="style.css">
        <!-- responsive CSS
		============================================ -->          
        <link rel="stylesheet" href="css/responsive.css">
        <!-- Select2 -->
    	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <!-- Sweet alert 2 -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>

    </head>
    <body class="">   
        <!-- HEADER AREA -->
        <?php include 'template/header.php'; ?>
        <!-- ENd HEADER -->

        <!-- MAIN MENU AREA -->
        <?php include 'template/menu.php'; ?>
		<!-- END MENU -->

        <!-- Breadcurb AREA -->
		<div class="breadcurb-area">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="index.php">หน้าแรก</a></li>
					<li>เปลี่ยนรหัสผ่าน</li>
				</ul>
			</div>
		</div>

		<!-- Checkout AREA -->
		<div class="checkout-area">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="billing-address">
							<div class="checkout-form">
								<form action="save_password.php" method="post" class="form-horizontal" id="chPassForm">
									<div class="form-group">
										<label class="control-label col-md-5">รหัสผ่านเดิม <sup>*</sup></label>
										<div class="col-md-7">
											<input type="password" class="form-control" name="oldpass" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">รหัสผ่านใหม่ <sup>*</sup></label>
										<div class="col-md-7">
											<input type="password" class="form-control" name="newpass1" id="newpass1" required>
										</div>
									</div>
									<div class="form-group">
										<label class="control-label col-md-5">ยืนยันรหัสผ่านใหม่ <sup>*</sup></label>
										<div class="col-md-7">
											<input type="password" class="form-control" name="newpass2" id="newpass2" required>
										</div>
									</div>
									<button class="btn btn-warning" type="submit">เปลี่ยนรหัสผ่าน</button>
								</form>
							</div>
						</div>
					</div>
					<!-- END -->
				</div>
				<div class="row">
					<div class="col-md-12">
						<p>&nbsp;</p>
					</div>
				</div>
			</div>
		</div>
		<!-- Footer AREA -->
		<?php include 'template/footer.php'; ?>
		<!-- END Footer -->
        <!-- JS -->
 		<!-- jquery-1.11.3.min js
		============================================ -->         
        <script src="js/vendor/jquery-1.11.3.min.js"></script>
 		<!-- bootstrap js
		============================================ -->         
        <script src="js/bootstrap.min.js"></script>
		<!-- nivo slider js
		============================================ --> 
		<script src="js/jquery.nivo.slider.pack.js"></script>
 		<!-- Mean Menu js
		============================================ -->         
        <script src="js/jquery.meanmenu.min.js"></script>
   		<!-- owl.carousel.min js
		============================================ -->       
        <script src="js/owl.carousel.min.js"></script>
		<!-- jquery price slider js
		============================================ --> 		
		<script src="js/jquery-price-slider.js"></script>
		<!-- wow.js
		============================================ -->
        <script src="js/wow.js"></script>		
		<script>
			new WOW().init();
		</script>
   		<!-- plugins js
		============================================ -->         
        <script src="js/plugins.js"></script>
   		<!-- main js
		============================================ -->           
        <script src="js/main.js"></script>
        <!-- Select2 -->
		<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
		<script language="javascript">
			$(function() {
				<?php 
            		if (!empty($_GET['act'])) { 
                		if ($_GET['act']=='wrong_old_pass') {
        		?>
        			Swal.fire({
		                title: 'ผิดพลาด',
		                text: 'รหัสผ่านเก่าผิด',
		                icon: 'error',
		                confirmButtonText: 'ตกลง'
		            });
		        <?php } else if ($_GET['act']=='save_success') { ?>
		        	Swal.fire({
		                title: 'เปลี่ยนหรัสผ่านสำเร็จ',
		                icon: 'success',
		                confirmButtonText: 'ตกลง'
		            });
		       	<?php } else if ($_GET['act']=='save_error') { ?>
		       		Swal.fire({
		                title: 'เกิดข้อผิดพลาด!',
		                text: 'ไม่สามารถบันทึกข้อมูลได้',
		                icon: 'error',
		                confirmButtonText: 'ตกลง'
		            });
        		<?php } } ?>
			}); 

			chPassForm.addEventListener('submit', function(event) {
		        event.preventDefault(); 
		        let isValid = true;

		        if ($('#newpass1').val() != $('#newpass2').val()) {
		            isValid = false;
		        }

		        if (isValid==true) {
		            //console.log('Form submitted successfully!');
		            chPassForm.submit();
		        } else {
		            //console.log('Form validation failed.');
		            Swal.fire({
		                title: 'รหัสผ่านไม่ตรงกัน!',
		                text: 'กรุณาป้อนใหม่',
		                icon: 'error',
		                confirmButtonText: 'ตกลง'
		            });
		        }
		    });
		</script>
    </body>
</html>
