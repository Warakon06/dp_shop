<?php
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 
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
		<link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@500&display=swap" rel="stylesheet"> 
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
        <style type="text/css" media="screen">
	        body {
	            font-family: 'Sarabun', sans-serif;
	        }
	    </style>
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <!-- Select2 -->
    	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    	<!-- Sweet alert 2 -->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.14.5/dist/sweetalert2.all.min.js"></script>
    </head>
    <body class="">
               
        <!-- HEADER AREA -->
        <?php include 'template/header.php'; ?>
        <!-- END HEADER -->

        <!-- MAIN MENU AREA -->
		<?php include 'template/menu.php'; ?>
		<!-- END MENU -->

        <!-- Breadcurb AREA -->
		<div class="breadcurb-area">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="index.php">หน้าแรก</a></li>
					<li>ลงทะเบียนสมาชิก</li>
				</ul>
			</div>
		</div>

		<!-- Checkout AREA -->
		<div class="checkout-area">
			<div class="container">
				<form action="save_register.php" method="post" accept-charset="utf-8">
				<div class="row">
					<div class="col-md-12">
						<div class="billing-address">
							<div class="checkout-head">
								<h2>ข้อมูลส่วนบุคคล</h2>
							</div>
							<div class="checkout-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ชื่อ <sup>*</sup></label>
											<input type="text" class="form-control" name="fname" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">นามสกุล <sup>*</sup></label>
											<input type="text" class="form-control" name="lname" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">เบอร์โทรศัพท์ <sup>*</sup></label>
											<input type="text" class="form-control" name="pnumber" required>
										</div>
									</div>
								</div>
							</div>
							<div class="checkout-head">
								<h2>ที่อยู่สำหรับจัดส่งสินค้า</h2>
							</div>
							<div class="checkout-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">บ้านเลขที่ <sup>*</sup></label>
											<input type="text" class="form-control" name="homeno" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">หมู่บ้าน/อาคาร </label>
											<input type="text" class="form-control" name="village">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ซอย</label>
											<input type="text" class="form-control" name="soi">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ถนน </label>
											<input type="text" class="form-control" name="road">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">จังหวัด <sup>*</sup></label>
											<select name="province" id="province" class="form-control select2" onchange="chLocal('province', this.value)" required>
												<option value="">- เลือก -</option>
												<?php 
													$query2 = 'select * from province ';
													$result2 = $con->prepare($query2);
													$result2->execute();
													if ($result2->rowCount()>0) {
														foreach ($result2 as $key => $rs2) {
															echo '<option value="'.$rs2['province_id'].'">'.$rs2['name_th'].'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">อำเภอ/เขต </label>
											<select name="district" id="district" class="form-control select2" onchange="chLocal('district', this.value)" required>
												<option value="">- เลือก -</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ตำบล / แขวง <sup>*</sup></label>
											<select name="subdistrict" id="subdistrict" class="form-control select2" onchange="chLocal('subdistrict', this.value)" required>
												<option value="">- เลือก -</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">รหัสไปรษณีย์ </label>
											<input type="text" class="form-control" name="postcode" id="postcode" required>
										</div>
									</div>
								</div>
							</div>
							<div class="checkout-head">
								<h2>ข้อมูลการเข้าใช้งานระบบ</h2>
							</div>
							<div class="checkout-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">อีเมล <sup>*</sup></label>
											<input type="text" class="form-control" name="email" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">รหัสผ่าน <sup>*</sup></label>
											<input type="password" class="form-control" name="pass" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-warning">ยืนยัน</button>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END -->
				</div>
				</form>
			</div>
		</div>
		<!-- END -->

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
        	$('.select2').select2();

        	<?php 
            	if (!empty($_GET['act'])) { 
                	if ($_GET['act']=='save_success') {
        	?>
	        	Swal.fire({
	                title: 'ลงทะเบียนสำเร็จแล้ว',
	                icon: 'success',
	                confirmButtonText: 'ตกลง',
	                allowOutsideClick: false,
	                allowEscapeKey: false
	            }).then((result) => {
				  	if (result.isConfirmed) {
				    	top.window.location='login.php';
				  	}
				});
			<?php } else if ($_GET['act']=='save_error') { ?>
	            Swal.fire({
	                title: 'เกิดข้อผิดพลาด!',
	                text: 'ไม่สามารถบันทึกข้อมูลได้',
	                icon: 'error',
	                confirmButtonText: 'ตกลง'
	            });
        	<?php } else if ($_GET['act']=='email_duplicate') { ?>
	            Swal.fire({
	                title: 'ไม่สามารถลงทะเบียนได้!',
	                text: 'อีเมลซ้ำ',
	                icon: 'warning',
	                confirmButtonText: 'ตกลง'
	            });
        	<?php } } ?>
        });

        function chLocal (objName, Value) {
        	$.ajax({
	            type : "post",
	            url  : "select_location.php",
	            data : {obj:objName, data:Value},
	            success: function(response){
	                //console.log(response);

	                if (objName=='province') {
	                    $('#district').empty();
	                    $('#district').append(response);
	                } else if (objName=='district') {
	                    $('#subdistrict').empty();
	                    $('#subdistrict').append(response);
	                } else if (objName=='subdistrict') {
	                    $('#postcode').val(response);
	                }
	                $('.select2').select2();
	            }
	        });
        }
        </script>
    </body>
</html>
