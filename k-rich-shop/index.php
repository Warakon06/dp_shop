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
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body class="home-2">
        <!-- HEADER AREA -->
        <?php include 'template/header.php'; ?>
        <!-- END HEADER -->

        <!-- MAIN MENU AREA -->
		<?php include 'template/menu.php'; ?>
		<!-- END MAIN MENU -->

        <!-- Slider AREA -->
		<div class="slider-area">
			<div class="container">
				<div class="row">
					<div class="col-md-9 col-sm-9">
						<!-- Main Slider -->
						<div class="main-slider">
							<div class="slider">
								<div id="mainSlider-2" class="nivoSlider slider-image">
									<img src="img/slider/s311.jpg" alt="main slider" title="#htmlcaption1"/>
									<img src="img/slider/CPU INTEL 1700 CORE I3-12100F 3.3GHz 4C 8T.jpg" alt="main slider" title="#htmlcaption2"/>
									<img src="img/slider/RAM GeIL ORION 16GB (8x2) DDR4 3200MHz GREY (GAOG416GB3200C22DC) (LT).jpg" alt="main slider" title="#htmlcaption3"/>
								</div>
								<div id="htmlcaption1" class="nivo-html-caption slider-caption-1">
									<div class="slider-progress"></div>					
									<div class="slide-text slide2-text">
										<div class="middle-text">
											<div class="cap-title wow slideInRight" data-wow-duration=".9s" data-wow-delay="0s">
												<h2>New Collection</h2>
											</div>
											<div class="cap-dec wow slideInRight" data-wow-duration="1.1s" data-wow-delay="0s">
												<p>Save Up to</p>
												<h1>37% Off</h1>
											</div>	
											<div class="cap-readmore animated bounceIn" data-wow-duration="1.5s" data-wow-delay=".5s">
												<a href="http://localhost/k-rich-shop/product.php">Shop Now</a>
											</div>	
										</div>	
									</div>
									<div class="slide-image slide2-image">
										<img class="wow slideInUp"  data-wow-duration="1.5s" data-wow-delay="0s" src="img/slider/CPU AMD AM4 RYZEN 5 5600 3.5GHz 6C 12T.jpg" alt="slider caption" />
									</div>
								</div>
								<div id="htmlcaption2" class="nivo-html-caption slider-caption-2">
									<div class="slider-progress"></div>									
									<div class="slide-text">
										<div class="middle-text">
											<div class="cap-title wow slideInRight" data-wow-duration=".9s" data-wow-delay="0s">
												<h2>New Collection</h2>
											</div>
											<div class="cap-dec wow slideInRight" data-wow-duration="1.1s" data-wow-delay="0s">
												<p>Save Up to</p>
												<h1>37% Off</h1>
											</div>	
											<div class="cap-readmore animated bounceIn" data-wow-duration="1.5s" data-wow-delay=".5s">
												<a href="#">View details</a>
											</div>	
										</div>	
									</div>
									<div class="slide-image slide2-image">
										<img class="wow slideInUp"  data-wow-duration="1.5s" data-wow-delay="0s" src="img/slider/CPU AMD AM4 RYZEN 5 5600 3.5GHz 6C 12T.jpg" alt="slider caption" />
									</div>
								</div>
								<div id="htmlcaption3" class="nivo-html-caption slider-caption-3">
									<div class="slider-progress"></div>					
									<div class="slide-text">
										<div class="middle-text">
											<div class="cap-title wow slideInRight" data-wow-duration=".9s" data-wow-delay="0s">
												<h2>New Collection</h2>
											</div>
											<div class="cap-dec wow slideInRight" data-wow-duration="1.1s" data-wow-delay="0s">
												<p>Save Up to</p>
												<h1>37% Off</h1>
											</div>	
											<div class="cap-readmore animated bounceIn" data-wow-duration="1.5s" data-wow-delay=".5s">
												<a href="#">Shop Now</a>
											</div>	
										</div>	
									</div>
									<div class="slide-image slide2-image">
										<img class="wow slideInUp"  data-wow-duration="1.5s" data-wow-delay="0s" src="img/slider/CPU AMD AM4 RYZEN 5 5600 3.5GHz 6C 12T.jpg" alt="slider caption" />
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3 col-sm-3">
						<div class="right-banner">
							<div class="right-banner-img single-add">
								<a href="http://localhost/k-rich-shop/product_detail.php?pid=24"><img src="img/banner/RAM GeIL ORION 16GB (8x2) DDR4 3200MHz GREY (GAOG416GB3200C22DC) (LT).jpg" alt="slider"></a>
							</div>
							<div class="right-banner-img single-add">
								<a href="http://localhost/k-rich-shop/product_detail.php?pid=22"><img src="img/banner/CPU AMD AM4 RYZEN 5 5600 3.5GHz 6C 12T.jpg" alt="slider"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END Slider -->

		<!-- offer AREA -->
		<div class="offer-area">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="single-offer">
							<div class="sigle-offer-icon">
								<p><i class="fa fa-phone"></i></p>
							</div>
							<div class="sigle-offer-content">
								<h2>ติดต่อได้ตลอด 24/7</h2>
								<p>มีพนักงานคอยแก้ปัญหาให้คุณตลอด</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="single-offer">
							<div class="sigle-offer-icon">
								<p><i class="fa fa-bitcoin"></i></p>
							</div>
							<div class="sigle-offer-content">
								<h2>คืนเงินได้ใน 30 วัน</h2>
								<p>ไม่พอใจสินค้าขอคืนได้</p>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<div class="single-offer">
							<div class="sigle-offer-icon">
								<p><i class="fa fa-truck"></i></p>
							</div>
							<div class="sigle-offer-content">
								<h2>ฟรีค่าจัดส่ง </h2>
								<p>สั่งซื้อขั้นต่ำ 2,000 บาท</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END offer -->

		<!-- Featured Product AREA -->
		<!-- <div class="featured-product-area">
			<div class="container">
				<div class="feature-product-header">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#feature-product" data-toggle="tab">มาใหม่</a></li>
						<li><a href="#best-sellers" data-toggle="tab">ขายดี</a></li>
						<li><a href="#specials" data-toggle="tab">ลดราคา</a></li>
					</ul>
				</div>
				<div class="feature-product-body">
					<div class="tab-content">
						<div class="tab-pane active" id="feature-product">
							<div class="row">
								<div id="owl-feature" class="owl-carousel">
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-1.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="product_detail.php">ดูรายละเอียด</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">หยิบใส่ตะกร้า</a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-4.jpg" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-6.jpg" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-5.jpg" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-1.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-1.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-1.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-1.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="best-sellers">
							<div class="row">
								<div id="owl-spacial" class="owl-carousel">
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-3.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-3.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-3.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-3.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-3.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-3.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-3.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-3.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="tab-pane" id="specials">
							<div class="row">
								<div id="owl-best-sell" class="owl-carousel">
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-2.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-1.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-2.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-1.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-2.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-1.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-2.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-1.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-2.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-1.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-2.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-1.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-1.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
									<div class="col-md-3 product-col">
										<div class="single-featured-product">
											<div class="fiture-product-img">
												<a href="#">
													<img class="primary-img" src="img/product/feture-product-1.png" alt="product">
													<img class="secondary-img" src="img/product/feture-product-2.png" alt="product">
												</a>
												<div class="feture-product-action">
													<a href="#">Quick View</a>
												</div>
											</div>
											<div class="fiture-product-content">
												<a href="#"><h2>Platinum League Dress for Kids</h2></a>
												<div class="best-product-rating">
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star-o"></i></a>
												</div>
												<h3>$27.00</h3>
											</div>
											<div class="new-sell">
												<p class="new">New</p>
												<p class="sell">Sale</p>
											</div>
											<div class="add-to-chart">
												<ul class="list-inline">
													<li><a href="#" class="add-chart">Add to chart</a></li>
													<li><a href="#"><i class="fa fa-heart"></i></a></li>
													<li><a href="#"><i class="fa fa-random"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- END Featured Product -->

		<!-- Add Banner AREA -->
		<!-- <div class="add-banner-area">
			<div class="container">
				<div class="add-banner">
					<div class="row">
						<div class="col-md-8 col-sm-8">
							<div class="add-banner-left">
								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="row">
											<div class="col-md-6 col-sm-6">
												<div class="add-banner-img single-add">
													<a href="#"><img src="img/banner/add-banner-1.jpg" alt="add"></a>
												</div>
											</div>
											<div class="col-md-6 col-sm-6">
												<div class="add-banner-img single-add">
													<a href="#"><img src="img/banner/add-banner-2.jpg" alt="add"></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12 add-banner-bottom">
										<div class="add-banner-img single-add">
											<a href="#"><img src="img/banner/add-banner-3.jpg" alt="add"></a>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-4">
							<div class="add-banner-right">
								<div class="add-banner-img single-add">
									<a href="#"><img src="img/banner/add-banner-4.jpg" alt="add"></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- END Banner -->

		<!-- Single Producnt Slider AREA -->
		<!-- <div class="single-product-slider">
			<div class="container">
				<div class="row">
					<div class="col-md-4 col-sm-4">
						<div class="single-product-heading">
							<h2><span>Men</span></h2>
						</div>
						<div id="bag-men-carousel" class="owl-carousel">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-1.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-7.jpg" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-2.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-1.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-1.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12 col-sm-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-1.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="single-product-heading">
							<h2><span>Women</span></h2>
						</div>
						<div id="bag-women-carousel" class="owl-carousel">
							<div class="row">
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-5.jpg" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-3.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-6.jpg" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-6.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-1.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-1.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-4 col-sm-4">
						<div class="single-product-heading">
							<h2><span>Kids</span></h2>
						</div>
						<div id="bag-kids-carousel" class="owl-carousel">
							<div class="row">
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-4.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-8.jpg" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-9.jpg" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-1.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-1.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
								<div class="col-md-12">
									<div class="single-product-bag">
										<div class="single-bag-img">
											<a href="#"><img src="img/product/bag-1.png" alt="add"></a>
										</div>
										<div class="single-bag-content">
											<a href="#"><h2>New style handbag</h2></a>
											<h3>$25.00</h3>
											<div class="best-product-rating">
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star"></i></a>
												<a href="#"><i class="fa fa-star-o"></i></a>
											</div>
										</div>
										<div class="single-product-bag-action">
											<a href="#"><i class="fa fa-search"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- END Single Producnt -->

		<!-- Blog AREA -->
		<!-- <div class="blog-area">
			<div class="container">
				<div class="blog-heading">
					<h2><span>Blog page</span></h2>
				</div>
				<div class="row">
					<div id="blog-carousel" class="owl-carousel">
						<div class="col-md-4">
							<div class="single-blog">
								<div class="blog-img single-add">
									<a href="#"><img src="img/blog/blog-1.jpg" alt="blog"></a>
								</div>
								<div class="blog-content">
									<h2><a href="#">New style travel bag</a></h2>
									<p>Lorem ipsum dolor sit amet, consectetuer adiping elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
									<a href="#">Continue Reading <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="single-blog">
								<div class="blog-img single-add">
									<a href="#"><img src="img/blog/blog-2.jpg" alt="blog"></a>
								</div>
								<div class="blog-content">
									<h2><a href="#">Latest travel bag</a></h2>
									<p>Lorem ipsum dolor sit amet, consectetuer adiping elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
									<a href="#">Continue Reading <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="single-blog">
								<div class="blog-img single-add">
									<a href="#"><img src="img/blog/blog-3.jpg" alt="blog"></a>
								</div>
								<div class="blog-content">
									<h2><a href="#">Modern style travel bag</a></h2>
									<p>Lorem ipsum dolor sit amet, consectetuer adiping elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
									<a href="#">Continue Reading <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="single-blog">
								<div class="blog-img single-add">
									<a href="#"><img src="img/blog/blog-1.jpg" alt="blog"></a>
								</div>
								<div class="blog-content">
									<h2><a href="#">New style travel bag</a></h2>
									<p>Lorem ipsum dolor sit amet, consectetuer adiping elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
									<a href="#">Continue Reading <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="single-blog">
								<div class="blog-img single-add">
									<a href="#"><img src="img/blog/blog-2.jpg" alt="blog"></a>
								</div>
								<div class="blog-content">
									<h2><a href="#">Latest travel bag</a></h2>
									<p>Lorem ipsum dolor sit amet, consectetuer adiping elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
									<a href="#">Continue Reading <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="single-blog">
								<div class="blog-img single-add">
									<a href="#"><img src="img/blog/blog-3.jpg" alt="blog"></a>
								</div>
								<div class="blog-content">
									<h2><a href="#">Modern style travel bag</a></h2>
									<p>Lorem ipsum dolor sit amet, consectetuer adiping elit. Aenean commodo ligula eget dolor. Aenean massa.</p>
									<a href="#">Continue Reading <i class="fa fa-caret-right"></i></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- END Blog -->

		<!-- Claint AREA -->
		<!-- <div class="claint-area">
			<div class="container">
				<div class="row">
					<div id="owl-claint" class="owl-carousel">
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-1.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-2.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-3.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-4.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-5.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-1.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-1.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-2.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-3.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-4.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-5.png" alt="claint"></a>
							</div>
						</div>
						<div class="col-md-2">
							<div class="claint-img">
								<a href="#"><img src="img/claint/claint-1.png" alt="claint"></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<!-- END Claint -->

		<!-- Product Item AREA -->
		<div class="product-item-area">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="product-item-list">

							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="product-item-heading">
										<div class="item-heading-title">
											<h2>&nbsp;</h2>
										</div>
									</div>
								</div>
							</div>

							<div class="row">
								<?php 
									//คิวนี่เพื่อดึงข้อมูลสินค้าโดยให้ทำการสุ่มสินค้าขึ้นมา 8 ชิ้น
									$query = 'select
										a.product_id, a.name, a.price, b.photo 
										from product as a 
										left outer join product_photo as b on a.product_id = b.product_id 
										and b.active = 1 
										order by rand() limit 8 ';
									$result = $con->prepare($query);
									$result->execute();
									//ถ้ามีข้อมูลฃสินค้า
									if ($result->rowCount()>0) {
										//ทำการวนลูปเพื่อดึงข้อมูลสินค้าขึ้นมาแสดง
										foreach ($result as $key => $rs) {
								?>
								<div class="col-md-3" >
									<div class="single-item-area">
										<div class="single-item">
											<div class="product-item-img">
												<a href="product_detail.php?pid=<?php echo $rs['product_id']; ?>" title="ดูรายละเอียด">
													<img class="primary-img" src="img/product/<?php echo $rs['photo']; ?>" alt="item" class="img-thumbnail">
													<!-- <img class="secondary-img" src="img/shop/item-2.jpg" alt="item"> -->
												</a>
												<div class="product-item-action">
													<a href="product_detail.php?pid=<?php echo $rs['product_id']; ?>" title="ดูรายละเอียด"><i class="fa fa-external-link"></i></a>
													<a href="cart.php?act=add&pid=<?php echo $rs['product_id']; ?>" title="หยิบใส่ตะกร้า"><i class="fa fa-shopping-cart"></i></a>
												</div>
											</div>
											<div class="single-item-content" style="height:100px;">
												<!-- <h3><a href="product_detail.php?pid=<?php echo $rs['product_id']; ?>"><?php echo $rs['name']; ?></a></h3>
												<h3><?php echo number_format($rs['price'], 2); ?> ฿</h3> -->
												<h2><a href="product_detail.php?pid=<?php echo $rs['product_id']; ?>"><?php echo $rs['name']; ?></a></h2>
												<?php
													$query3 = 'select count(a.review_id) as sum_review, 
														(select count(review_id) from review_product 
															where score = 5 and product_id = a.product_id) as score5,
														(select count(review_id) from review_product 
															where score = 4 and product_id = a.product_id) as score4, 
														(select count(review_id) from review_product 
															where score = 3 and product_id = a.product_id) as score3, 
														(select count(review_id) from review_product 
															where score = 2 and product_id = a.product_id) as score2, 
														(select count(review_id) from review_product 
															where score = 1 and product_id = a.product_id) as score1
														from review_product as a 
														where a.product_id = :pid ';
													$result3 = $con->prepare($query3);
													$result3->execute(['pid'  => $rs['product_id']]); 
													if ($result3->rowCount()>0) {
														$rs3 = $result3->fetch();
														$score = ((5 * $rs3['score5']) + (4 * $rs3['score4']) + (3 * $rs3['score3']) + (2 * $rs3['score2']) + (1 * $rs3['score1']));
														if ($score!=0) {
															$score = $score / $rs3['sum_review'];
												?>
												<br>
												<div class="best-product-rating">
													<?php if ($score==5) { ?>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													(<?php echo $rs3['sum_review']; ?>)
													<?php } else if ($score==4) { ?>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
													(<?php echo $rs3['sum_review']; ?>)
													<?php } else if ($score==3) { ?>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
													<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
													(<?php echo $rs3['sum_review']; ?>)
													<?php } else if ($score==2) { ?>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
													<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
													<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
													(<?php echo $rs3['sum_review']; ?>)
													<?php } else if ($score==1) { ?>
													<a href="#"><i class="fa fa-star"></i></a>
													<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
													<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
													<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
													<a href="#"><i class="fa fa-star" style="color: #b0b0b0;"></i></a>
													(<?php echo $rs3['sum_review']; ?>)
													<?php } ?>
												</div>
												<?php } } ?>
												<h3><?php echo number_format($rs['price'], 2); ?> ฿</h3>
											</div>
										</div>
									</div>
								</div>
								<?php } } ?>

							</div>
						</div>
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
    </body>
</html>
