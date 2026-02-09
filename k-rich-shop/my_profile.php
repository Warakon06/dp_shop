<?php
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//ตรวจสอบการเข้าสู่ระบบ
if (empty($_SESSION['member_id'])) {
	//ไปที่หน้า login
	gotopage('login.php?act=login_pls');
//ถ้ามีการเข้าสู่ระบบ
} else {
	//ดึงข้อมูลสมาชิก
	$query = 'select * from member where member_id = :mid ';
	$result = $con->prepare($query);
	$result->execute(['mid'  => $_SESSION['member_id']]);
	if ($result->rowCount()>0) {
		$rs = $result->fetch();
	} else {
		gotopage('login.php?act=login_pls');
	}
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
					<li>ข้อมูลสมาชิก</li>
				</ul>
			</div>
		</div>

		<!-- Checkout AREA -->
		<div class="checkout-area">
			<div class="container">
				<form action="update_profile.php" method="post" accept-charset="utf-8" enctype="multipart/form-data">
				<div class="row">
					<div class="col-md-12">
						<div class="billing-address">
							<div class="checkout-head">
								<h2>ข้อมูลส่วนบุคคล</h2>
							</div>
							<div class="checkout-head">
								<h2>รูปโปรไฟล์</h2>
							</div>
							<div class="checkout-form">
								<?php 
									$defaultPhoto = 'img/product/product-avarta.jpg';
									$photoPath = $defaultPhoto;
									if (!empty($rs['photo'])) { $photoPath = 'img/member/'.$rs['photo']; }
								?>
								<div class="row" style="align-items:center;">
									<div class="col-md-3">
										<img src="<?php echo $photoPath; ?>" alt="profile" style="height:100px;width:100px;object-fit:cover;border-radius:50%;">
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<label class="control-label">อัปโหลดรูปใหม่</label>
											<input type="file" class="form-control" name="photo" accept="image/*">
										</div>
										<?php if (!empty($rs['photo'])) { ?>
										<div class="form-group">
											<label><input type="checkbox" name="remove_photo" value="1"> ลบรูปปัจจุบัน</label>
										</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="checkout-form">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ชื่อ <sup>*</sup></label>
											<input type="text" class="form-control" name="fname" value="<?php echo $rs['first_name']; ?>" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">นามสกุล <sup>*</sup></label>
											<input type="text" class="form-control" name="lname" value="<?php echo $rs['last_name']; ?>" required>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">เบอร์โทรศัพท์ <sup>*</sup></label>
											<input type="text" class="form-control" name="pnumber" value="<?php echo $rs['phone_number']; ?>" required>
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
											<input type="text" class="form-control" name="homeno" value="<?php echo $rs['home_no']; ?>" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">หมู่บ้าน/อาคาร </label>
											<input type="text" class="form-control" name="village" value="<?php echo $rs['village']; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ซอย</label>
											<input type="text" class="form-control" name="soi" value="<?php echo $rs['soi']; ?>">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ถนน </label>
											<input type="text" class="form-control" name="road" value="<?php echo $rs['road']; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">จังหวัด <sup>*</sup></label>
											<select name="province" id="province" class="form-control select2" onchange="chLocal('province', this.value)" required>
												<?php 
													$query2 = 'select * from province where province_id = :pid ';
													$result2 = $con->prepare($query2);
													$result2->execute(['pid' => $rs['province_id']]);
													$rs2 = $result2->fetch();
													echo '<option value="'.$rs2['province_id'].'">'.$rs2['name_th'].'</option>';

													$query2 = 'select * from province where province_id != :pid ';
													$result2 = $con->prepare($query2);
													$result2->execute(['pid'  => $rs['province_id']]);
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
												<?php 
													$query2 = 'select * from district where district_id = :did ';
													$result2 = $con->prepare($query2);
													$result2->execute(['did' => $rs['district_id']]);
													$rs2 = $result2->fetch();
													echo '<option value="'.$rs2['district_id'].'">'.$rs2['name_th'].'</option>';

													$query2 = 'select * from district where district_id != :did and province_id = :pid ';
													$result2 = $con->prepare($query2);
													$result2->execute([
														'did'  => $rs['district_id'], 
														'pid'  => $rs['province_id'] 
													]);
													if ($result2->rowCount()>0) {
														foreach ($result2 as $key => $rs2) {
															echo '<option value="'.$rs2['district_id'].'">'.$rs2['name_th'].'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">ตำบล / แขวง <sup>*</sup></label>
											<select name="subdistrict" id="subdistrict" class="form-control select2" onchange="chLocal('subdistrict', this.value)" required>
												<?php 
													$query2 = 'select * from subdistrict where subdistrict_id = :subdid ';
													$result2 = $con->prepare($query2);
													$result2->execute(['subdid' => $rs['subdistrict_id']]);
													$rs2 = $result2->fetch();
													echo '<option value="'.$rs2['subdistrict_id'].'">'.$rs2['name_th'].'</option>';

													$query2 = 'select * from subdistrict where 
													subdistrict_id != :subdid 
													and district_id = :did ';
													$result2 = $con->prepare($query2);
													$result2->execute([
														'subdid'  	=> $rs['subdistrict_id'], 
														'did'  		=> $rs['district_id']
													]);
													if ($result2->rowCount()>0) {
														foreach ($result2 as $key => $rs2) {
															echo '<option value="'.$rs2['subdistrict_id'].'">'.$rs2['name_th'].'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">รหัสไปรษณีย์ </label>
											<input type="text" class="form-control" name="postcode" id="postcode" value="<?php echo $rs['post_code']; ?>" required>
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
											<input type="text" class="form-control" name="email" value="<?php echo $rs['email']; ?>" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">รหัสผ่าน <sup>*</sup></label>
											<input type="password" class="form-control" name="pass">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<button type="submit" class="btn btn-warning">แก้ไขข้อมูล</button>
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
	                title: 'บันทึกข้อมูลเรียบร้อย',
	                icon: 'success',
	                confirmButtonText: 'ตกลง',
	                allowOutsideClick: false,
	                allowEscapeKey: false
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
