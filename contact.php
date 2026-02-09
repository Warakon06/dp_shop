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
					<li>ติดต่อเรา</li>
				</ul>
			</div>
		</div>

		<!-- Contact-us area -->
		<div class="contact-us-area">
			<!-- <div class="map-area">
				<div class="contact-map">
					<div id="googleMap"></div>
				</div>
			</div> -->
			<div class="contact-information">
				<div class="container">
					<div class="row">
						<div class="col-md-6 col-sm-6">
							<div class="contact-map">
								<div id="googleMap"></div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="contact-details">
								<div class="contact-head">
									<h2>ติดต่อเรา</h2>
									<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parent montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa.</p>
								</div>
								<div class="contact-bottom">
									<p><span><i class="fa fa-phone"></i></span> โทร: +8800 186-70-592-70</p>
									<p><span><i class="fa fa-envelope"></i></span> อีเมล: raminbd96@gmail.com</p>
									<p><span><i class="fa fa-link"></i></span> เว็บไซต์: <a href="#">www.bootexpert.com</a></p>
									<p><span><i class="fa fa-map-marker"></i></span> ที่ตั้ง: Opposite 123 Avenue, London, United Kingdom</p>
								</div>
								<div class="contact-social-icon footer-social-icon">
									<ul class="list-inline">
										<li><a href="#"><i class="fa fa-facebook"></i></a></li>
										<li><a href="#"><i class="fa fa-twitter"></i></a></li>
										<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
										<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
										<li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
										<li><a href="#"><i class="fa fa-vimeo"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
						<!-- <div class="col-md-6 col-sm-6">
							<div class="contact-leave-message">
								<div class="contact-head">
									<h2>Leave A MESSAGE</h2>
								</div>
								<form action="#" class="form-horizontal">
									<div class="form-group col-md-6">
										<label class="control-label">
											Subject
										</label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label class="control-label">
											E-mail
										</label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label class="control-label">
											Order reference
										</label>
										<input type="text" class="form-control">
									</div>
									<div class="form-group col-md-6">
										<label class="control-label">
											Attach File
										</label>
										<input type="file" class="form-control">
									</div>
									<div class="form-group col-md-12">
										<label class="control-label">
											Message
										</label>
										<textarea rows="5" class="form-control"></textarea>
									</div>
									<button class="btn">Send Message</button>
								</form>
							</div>
						</div> -->
					</div>
				</div>
			</div>
		</div>
		<!-- END Contact-us  -->

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
		
		
		<!-- Google Map js -->
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script>
            function initialize() {
              var mapOptions = {
                zoom: 15,
                scrollwheel: false,
                center: new google.maps.LatLng(40.663293, -73.956351)
              };

              var map = new google.maps.Map(document.getElementById('googleMap'),
                  mapOptions);


              var marker = new google.maps.Marker({
                position: map.getCenter(),
                animation:google.maps.Animation.BOUNCE,
                icon: 'img/map-marker.png',
                map: map
              });

            }

            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
    </body>
</html>
