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
		<link href='https://fonts.googleapis.com/css?family=Raleway:400,700,600,500,300,800,900' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,400italic,500,300,300italic,500italic,700' rel='stylesheet' type='text/css'>
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
        <!-- Select2 -->
    	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>

        <style>
            body { font-family: 'Sarabun', sans-serif; }
            .checkout-area .billing-address .form-group { margin-bottom: 16px; }
            .checkout-area .billing-address .control-label { font-size: 18px; font-weight: 600; color: #333; }
            .checkout-area .billing-address .form-control { font-size: 16px; height: 42px; padding: 8px 12px; border-radius: 6px; }
            .checkout-area .btn { font-size: 18px; padding: 12px 20px; border-radius: 8px; font-weight: 700; }
            .checkout-area h3 { font-size: 28px; font-weight: 700; margin-top: 10px; margin-bottom: 10px; }
            .checkout-area ol { font-size: 18px; color: #444; }
            .breadcurb-area .breadcrumb { font-size: 18px; color: #666; }
            .breadcurb-area .breadcrumb li, 
            .breadcurb-area .breadcrumb a { font-weight: 600; }
            .auth-section { padding: 30px 0; }
            .auth-card { background: #fff; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,.08); padding: 28px; }
            .auth-title { font-size: 30px; font-weight: 700; margin-bottom: 16px; color:#2b82ad; }
            .auth-subtitle { font-size: 18px; color:#666; margin-bottom: 24px; line-height: 1.8; }
            .auth-form .form-group { margin-bottom: 18px; }
            .auth-form label { display: block; font-size: 18px; font-weight: 600; color: #333; margin-bottom: 6px; }
            .auth-form .form-control { font-size: 16px; height: 46px; padding: 10px 14px; border-radius: 8px; border: 1px solid #ddd; }
            .btn-auth { font-size: 19px; padding: 12px 22px; border-radius: 8px; font-weight: 700; }
            .register-info ol { font-size: 18px; color: #444; margin-left: 0; list-style: none; padding-left: 0; }
            .register-info .btn { font-size: 16px; padding: 10px 18px; border-radius: 8px; margin-top: 12px; }
            @media (max-width: 767px) {
                .auth-title { font-size: 28px; }
                .breadcurb-area .breadcrumb { font-size: 16px; }
            }
        </style>
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
					<li>เข้าสู่ระบบ</li>
				</ul>
			</div>
		</div>

		<!-- Checkout AREA -->
        <div class="checkout-area auth-section">
			<div class="container">
				<div class="row">
					<div class="col-md-4">
                        <div class="auth-card">
                            <?php if (!empty($_GET['act']) && $_GET['act']=='login_error') { ?>
                            <div class="alert alert-danger" role="alert" style="margin-bottom:15px;">ไม่มีข้อมูล</div>
                            <?php } ?>
                            <form action="chk_login.php" method="post" class="auth-form">
                                <div class="form-group">
                                    <label>อีเมล</label>
                                    <input type="text" class="form-control" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label>รหัสผ่าน</label>
                                    <input type="password" class="form-control" name="pass" required>
                                </div>
                                <button class="btn btn-warning btn-auth" type="submit">เข้าสู่ระบบ</button>
                            </form>
						</div>
					</div>
					<div class="col-md-3"></div>
					<div class="col-md-5">
                        <div class="auth-card register-info">
                            <div class="auth-title">ลงทะเบียนสมาชิกใหม่</div>
                            <p class="auth-subtitle">รับสิทธิประโยชน์มากมาย</p>
                            <a href="register.php" class="btn btn-info">ลงทะเบียนสมาชิกใหม่</a>
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
                		if ($_GET['act']=='login_error') {
        		?>
        			Swal.fire({
		                title: '',
		                text: 'ไม่มีข้อมูล',
		                icon: 'error',
		                confirmButtonText: 'ตกลง'
		            });
		        <?php } else if ($_GET['act']=='login_pls') { ?>
		        	Swal.fire({
		                title: 'กรุณาเข้าสู่ระบบก่อน',
		                icon: 'warning',
		                confirmButtonText: 'ตกลง'
		            });
        		<?php } } ?>
			});
		</script>
    </body>
</html>
