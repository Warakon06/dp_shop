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
								<?php 
									$lat = 18.096722652810982;
									$lng = 100.19892036998444;
									$zoom = 21;
								?>
								<?php 
									$mapSrc = !empty($contact['map_src']) ? $contact['map_src'] : "https://maps.google.com/maps?q=".$lat.",".$lng."&t=k&z=".$zoom."&hl=th&output=embed";
								?>
								<iframe id="contactMapFrame" src="<?php echo htmlspecialchars($mapSrc); ?>" style="width:100%;height:450px;border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
								<div class="map-controls">
									<button type="button" class="btn btn-default btn-xs" data-dir="n">↑</button>
									<button type="button" class="btn btn-default btn-xs" data-dir="s">↓</button>
									<button type="button" class="btn btn-default btn-xs" data-dir="w">←</button>
									<button type="button" class="btn btn-default btn-xs" data-dir="e">→</button>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-6">
							<div class="contact-details">
								<div class="contact-head">
									<h2>ติดต่อเรา</h2>
								</div>
								<?php 
									$contact = ['phone'=>'','email'=>'','website'=>'','address'=>'','map_src'=>''];
									try {
										$stmtc = $con->query("SELECT phone,email,website,address,map_src FROM site_settings WHERE id=1");
										$rowc = $stmtc->fetch();
										if ($rowc) { $contact = $rowc; }
									} catch (Exception $e) {}
								?>
								<div class="contact-bottom">
									<p><span><i class="fa fa-phone"></i></span> โทร: <?php echo !empty($contact['phone']) ? htmlspecialchars($contact['phone']) : '-'; ?></p>
									<p><span><i class="fa fa-envelope"></i></span> อีเมล: <?php echo !empty($contact['email']) ? htmlspecialchars($contact['email']) : '-'; ?></p>
									<p><span><i class="fa fa-link"></i></span> เว็บไซต์: <?php if (!empty($contact['website'])) { ?><a href="<?php echo htmlspecialchars($contact['website']); ?>"><?php echo htmlspecialchars($contact['website']); ?></a><?php } else { echo '-'; } ?></p>
									<p><span><i class="fa fa-map-marker"></i></span> ที่ตั้ง: <?php echo !empty($contact['address']) ? htmlspecialchars($contact['address']) : '-'; ?></p>
								</div>
								<?php 
									$social = ['fb_link'=>'','tw_link'=>'','gp_link'=>'','ln_link'=>'','pt_link'=>'','vm_link'=>''];
									try {
										$st = $con->query("SELECT fb_link,tw_link,gp_link,ln_link,pt_link,vm_link FROM site_settings WHERE id=1");
										$rss = $st->fetch();
										if ($rss) { $social = $rss; }
									} catch (Exception $e) {}
								?>
								<div class="contact-social-icon footer-social-icon">
									<ul class="list-inline">
										<?php if (!empty($social['fb_link'])) { ?><li><a href="<?php echo htmlspecialchars($social['fb_link']); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php } ?>
										<?php if (!empty($social['tw_link'])) { ?><li><a href="<?php echo htmlspecialchars($social['tw_link']); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php } ?>
										<?php if (!empty($social['gp_link'])) { ?><li><a href="<?php echo htmlspecialchars($social['gp_link']); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php } ?>
										<?php if (!empty($social['ln_link'])) { ?><li><a href="<?php echo htmlspecialchars($social['ln_link']); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php } ?>
										<?php if (!empty($social['pt_link'])) { ?><li><a href="<?php echo htmlspecialchars($social['pt_link']); ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a></li><?php } ?>
										<?php if (!empty($social['vm_link'])) { ?><li><a href="<?php echo htmlspecialchars($social['vm_link']); ?>" target="_blank"><i class="fa fa-vimeo"></i></a></li><?php } ?>
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
		
		<script>
		(function(){
			var lat = <?php echo $lat; ?>;
			var lng = <?php echo $lng; ?>;
			var step = 0.00005;
			function updateFrame(){
				var src = "https://maps.google.com/maps?q=" + lat + "," + lng + "&t=k&z=<?php echo $zoom; ?>&hl=th&output=embed";
				document.getElementById('contactMapFrame').src = src;
			}
			var buttons = document.querySelectorAll('.map-controls button');
			for (var i=0;i<buttons.length;i++){
				buttons[i].addEventListener('click', function(){
					var dir = this.getAttribute('data-dir');
					if (dir==='n') { lat += step; }
					else if (dir==='s') { lat -= step; }
					else if (dir==='e') { lng += step; }
					else if (dir==='w') { lng -= step; }
					updateFrame();
				});
			}
		})();
		</script>
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
		
		
		
    </body>
</html>
