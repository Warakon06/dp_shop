<?php
//เรียกใช้ไฟล์ที่เชื่อต่อกับฐานข้อมูล
include 'include/connect_db.php';
//เรียกใช้ไฟล์ที่เก็บตัวแปรและฟังก์ชัน
include 'include/function.php'; 

//กำหนดจำนวนสินค้าที่ให้แสดงผลต่อ 1 หน้า
$each = 12; 
//ตรวจสอบตัวแปรหน้าที่ส่งมา
if (!empty($_GET['page'])) { $page=$_GET['page']; } else { $page=1; }
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
		<!-- END -->

        <!-- Breadcurb AREA -->
		<div class="breadcurb-area">
			<div class="container">
				<ul class="breadcrumb">
					<li><a href="index.php">หน้าแรก</a></li>
					<li>สินค้า</li>
				</ul>
			</div>
		</div>

		<!-- Product Item AREA -->
		<div class="product-item-area">
			<div class="container">
				<div class="row">
					<!-- LEFT SIDE -->
					<div class="col-md-3 col-sm-4">
						<div class="product-item-categori">
							<div class="product-type">
								<h2>หมวดหมู่สินค้า</h2>
								<ul>
									<?php
										//คิวรี่ดึงข้อมูลหมวดหมู่สินค้า
										$query2 = 'select * from category ';
										$result2 = $con->prepare($query2);
										$result2->execute();
										if ($result2->rowCount()>0) {
										foreach ($result2 as $key => $rs2) {
									?>
									<li><a href="product.php?cat=<?php echo $rs2['category_id']; ?>"><i class="fa fa-angle-right"></i><?php echo $rs2['name']; ?></a></li>
									<?php } } ?>
								</ul>
							</div>
						</div>
						<!-- <div class="price-filter">
							<h2>กำหนดช่วงราคา</h2>
							<div id="slider-range"></div>
							<button class="btn btn-default">แสดงผล</button>
							<p>
							  <label for="amount">ช่วงราคา:</label>
							  <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
							</p>
						</div> -->
						<!-- <div class="filter-size-area">
							<h2>Filter by Size</h2>
							<div class="filter-size">
								<div class="filter-size-left">
									<a href="#"><p>M (6)</p></a>
									<a href="#"><p>X (7)</p></a>
									<a href="#"><p>XS (10)</p></a>
								</div>
								<div class="filter-size-right">
									<a href="#"><p>M (6)</p></a>
									<a href="#"><p>X (7)</p></a>
									<a href="#"><p>XS (10)</p></a>
								</div>
							</div>
						</div> -->
						<div class="add-shop">
							<div class="add-kids single-add">
								<a href="https://ihavecpu.com/"><img src="img/banner/logo.jpg" alt="add"></a>
							</div>
							<div class="add-dress single-add">
								<a href="https://www.bnn.in.th/th"><img src="img/banner/site-logo.9ca15bd.jpg" alt="add"></a>
							</div>
						</div>
					</div>
					<!-- ENd LEFT SIDE -->
					
					<!-- RIGHT SIDE -->
					<div class="col-md-9 col-sm-8">
						<div class="product-item-list">
							<div class="row">
								<div class="col-md-12 col-sm-12">
									<div class="product-item-heading">

										<div class="item-heading-title">
											<h2>
												<?php 
													//ถ้ามีตัวแปรหมวดหมู่ส่งมา 
													if (!empty($_GET['cat'])) {
														//คิวรี่สำหรับดุงข้อมูลหมวดหมู่ที่เลือกมาแสดง
														$query2 = 'select * from category where category_id = :catid ';
														$result2 = $con->prepare($query2);
														$result2->execute(['catid'  => $_GET['cat']]);
														if ($result2->rowCount()>0) {
															$rs2=$result2->fetch();
															echo '<b>หมวดหมู่ : </b>'.$rs2['name'];
														}
													}
												?>
											</h2>
										</div>

										<!-- <div class="result-short-view">
											<div class="result-short">
												<p>Showing 1-9 of 18 results </p>
												<div class="result-short-selection">
													<select>
														<option>Default sorting</option>
														<option>Sort by popularity</option>
														<option>Sort by average rating</option>
														<option>Sort by newness</option>
														<option>Sort by price: low to high</option>
														<option>Sort by price: high to low</option> 
													</select>
													<i class="fa fa-sort-alpha-asc"></i>
												</div>
											</div>
											<div class="view-mode">
												<a href="shop.html" class="active"><i class="fa fa-th-large"></i></a>
												<a href="single-shop.html"><i class="fa fa-th-list"></i></a>
											</div>
										</div> -->

									</div>
								</div>
							</div>

							<div class="row">
								<?php 
									//ถ้ามีการเลือกหมวดหมู่สินค้า
									if (!empty($_GET['cat'])) {
										//คิวรี่ดึงข้อมูลสินค้าตามหมวดหมู่ที่เลือกมา
										$query = 'select * from product where category_id = :catid';
										$result = $con->prepare($query);
										$result->execute(['catid' => $_GET['cat']]);
										$rs = $result->fetch();

										//คำนวณสินค้าเพื่อแบ่งหน้าสินค้า
										$total = $result->rowCount();
										$totalpage = ceil($total / $each);
										$goto = ($page-1) * $each;

										//คิวรี่สินค้าอีกรอบโดยให้ทำการดึงสินค้าออกมา 
										//และแบ่งแสดงจำนวนสินค้าตามตัวแปรที่กำหนดไว้
										$query = 'select 
											a.product_id, a.name, a.price, b.photo 
											from product as a 
											left outer join product_photo as b on a.product_id = b.product_id 
											and b.active = 1 
											where category_id = :catid 
											limit '.$goto.','.$each;
										$result = $con->prepare($query);
										$result->execute(['catid' => $_GET['cat']]);
									} else {
										//คิวรี่ดึงข้อมูลสินค้าทั้งหมเด
										$query = 'select * from product ';
										$result = $con->prepare($query);
										$result->execute();

										//คำนวณสินค้าเพื่อแบ่งหน้าสินค้า
										$total = $result->rowCount();
										$totalpage = ceil($total / $each);
										$goto = ($page-1) * $each;

										//คิวรี่สินค้าอีกรอบโดยให้ทำการดึงสินค้าออกมา 
										//และแบ่งแสดงจำนวนสินค้าตามตัวแปรที่กำหนดไว้
										$query = 'select 
										a.product_id, a.name, a.price, b.photo 
										from product as a 
										left outer join product_photo as b on a.product_id = b.product_id 
										and b.active = 1 
										limit '.$goto.','.$each;
										$result = $con->prepare($query);
										$result->execute();
									}
									if ($result->rowCount()>0) {
										foreach ($result as $key => $rs) {
								?>
								<div class="col-md-4">
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
												<!-- <h2><a href="product_detail.php?pid=<?php echo $rs['product_id']; ?>"><?php echo $rs['name']; ?></a></h2>
												<h3>ราคา: <span class="text-success"><?php echo number_format($rs['price'], 2); ?></span> ฿</h3> -->
												<h2><a href="product_detail.php?pid=<?php echo $rs['product_id']; ?>"><?php echo $rs['name']; ?></a></h2>
												<?php
													//ดึงข้อมูลคะแนนสินค้า
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
							<!-- End row -->
						</div>

						<!-- Pagination -->
						<div class="shop-pagination floatright">
							<ul class="pagination">
								<!-- ถ้าหน้าทั้งหมดมีแค่ 1 -->
								<?php if ($totalpage==1) { ?>
								<li class="disabled"><a href="#"><i class="fa fa-angle-left"></i></a></li>
								<li><a href="#">1</a></li>
								<li class="disabled"><a href="#"><i class="fa fa-angle-right"></i></a></li>
								<!-- ภ้าหน้าทั้งหมดมีมากกว่า 1 -->
								<?php } else { ?>
									<!-- และหน้าปัจจุบันเป็นหน้าแรก -->
									<?php if ($page==1) { ?>
									<li><a href="#" class="disabled"><i class="fa fa-angle-left"></i></a></li>
									<!-- ถ้าหน้าปัจจุบันไม่ใช่หน้าแรก จะสามารถกดย้อนหลังได้ 1 หน้า -->
									<?php } else { ?>
									<li><a href="product.php?page=<?php echo $page-1; if (!empty($_GET['cat'])) { echo '&cat='.$_GET['cat']; } ?>"><i class="fa fa-angle-left"></i></a></li>
									<?php } ?>
									<!-- วนลูปเพื่อแสดงหน้าทั้งหมด -->
									<?php for ($i=1;$i<=$totalpage;$i++) { ?>
									<li <?php if ($page==$i) { ?>class="active"<?php } ?>><a href="product.php?page=<?php echo $i; if (!empty($_GET['cat'])) { echo '&cat='.$_GET['cat']; } ?>"><?php echo $i; ?></a></li>
									<?php } ?>
									<!-- ถ้าหน้านี้ไม่ได้เป้นหน้าสุดท้าย จะสามารถกดเลื่อนไปข้างหน้าได้อีก 1 หน้า -->
									<?php if ($page!=$totalpage) { ?>
									<li><a href="product.php?page=<?php echo $page+1; if (!empty($_GET['cat'])) { echo '&cat='.$_GET['cat']; } ?>"><i class="fa fa-angle-right"></i></a></li>
									<?php } ?>
								<?php } ?>
							</ul>
						</div>
						<!-- END Pagination -->
					</div>
					<!-- END RIGHT -->
				</div>
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
    </body>
</html>
